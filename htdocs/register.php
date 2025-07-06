<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

ensure_logged_out();

$client = [];
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (((!empty($_POST["cpassword"]) && (strlen($_POST["cpassword"]) <= 255)) && !empty($_POST["cpassword_confirm"]) && ($_POST["cpassword"] === $_POST["cpassword_confirm"]))
        && (!empty($_POST["cname"]) && (strlen($_POST["cname"]) <= 255))
        && (empty($_POST["company"]) || (strlen($_POST["company"]) <= 255))
        && (empty($_POST["ctel"]) || is_telephone($_POST["ctel"]))
        && (empty($_POST["caddr"]) || (strlen($_POST["caddr"]) <= 65535)))
    {
        $ctel = $_POST["ctel"] ?: null;
        $company = $_POST["company"] ?: null;
        
        $statement = $database->prepare("INSERT INTO `customer` (`cname`, `cpassword`, `ctel`, `caddr`, `company`) VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("ssiss", $_POST["cname"], $_POST["cpassword"], $ctel, $_POST["caddr"], $company);
        $statement->execute();

        $result = $statement->store_result();
        if ($statement->affected_rows == 0)
        {
            http_response_code(500);
            render_error_page("Internal Server Error", "The request failed due to unknown reason.");
            exit;
        }

        $_SESSION["user_type"] = USER_CLIENT;
        $_SESSION["user_id"] = $statement->insert_id;

        header(sprintf("Location: /%s", $_GET["return"] ?? ""), true, 303);
        exit;
    }
    else
    {
        $client["cname"] = $_POST["cname"];
        $client["ctel"] = $_POST["ctel"];
        $client["caddr"] = $_POST["caddr"];
        $client["company"] = $_POST["company"];

        if (empty($_POST["cname"]))
        {
            $error_messages["cname"] = "This field is required";
        }
        else if (strlen($_POST["cname"]) > 255)
        {
            $error_messages["cname"] = "The name is too long";
        }

        if (empty($_POST["cpassword"]))
        {
            $error_messages["cpassword"] = "This field is required";
        }
        else if (strlen($_POST["cpassword"]) > 255)
        {
            $error_messages["cpassword"] = "The password is too long";
        }

        if (empty($_POST["cpassword_confirm"]))
        {
            $error_messages["cpassword_confirm"] = "This field is required";
        }
        else if ($_POST["cpassword_confirm"] !== $_POST["cpassword"])
        {
            $error_messages["cpassword_confirm"] = "The password does not match";
        }

        if (!empty($_POST["ctel"]) && !is_telephone(empty($_POST["ctel"])))
        {
            $error_messages["ctel"] = "Invalid telephone number";
        }

        if (!empty($_POST["caddr"]) && (strlen($_POST["caddr"]) > 65535))
        {
            $error_messages["caddr"] = "The address is too long";
        }

        if (!empty($_POST["company"]) && (strlen($_POST["company"]) > 255))
        {
            $error_messages["company"] = "The company name is too long";
        }
    }
}

render_page("/register.tpl.php", "Register", compact("client", "error_messages"));
