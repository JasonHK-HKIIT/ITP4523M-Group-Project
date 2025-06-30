<?php
// Entrypoint: /login.php
//
// Handle user login. The was shared by both customers and staff members. User will be redirected to its default
// landing page unless ?return=/path/to/page param was set.

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

ensure_logged_out();

$user = [];
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    // Input validations
    if (!empty($_POST["uid"]) && !empty($_POST["password"]))
    {
        if ($_POST["user_type"] === USER_STAFF)
        {
            $statement = $database->prepare("SELECT `sid` FROM `staff` WHERE `sid` = ? AND `spassword` = ?");
            $statement->bind_param("ss", $_POST["uid"], $_POST["password"]);
            $statement->execute();

            $result = $statement->get_result();
            if ($result->num_rows == 1)
            {
                $user = $result->fetch_assoc();
                $_SESSION["user_type"] = USER_STAFF;
                $_SESSION["user_id"] = $user["sid"];

                header(sprintf("Location: /%s", $_GET["return"] ?? "admin"), true, 307);
                exit;
            }

            $user["user_type"] = USER_STAFF;
        }
        else
        {

            $statement = $database->prepare("SELECT `cid` FROM `customer` WHERE `cid` = ? AND `cpassword` = ?");
            $statement->bind_param("ss", $_POST["uid"], $_POST["password"]);
            $statement->execute();

            $result = $statement->get_result();
            if ($result->num_rows == 1)
            {
                $user = $result->fetch_assoc();
                $_SESSION["user_type"] = USER_CLIENT;
                $_SESSION["user_id"] = $user["cid"];

                header(sprintf("Location: /%s", $_GET["return"] ?? ""), true, 307);
                exit;
            }

            $user["user_type"] = USER_CLIENT;
        }

        $user["uid"] = $_POST["uid"];
        $error_messages["password"] = "User ID or password is incorrect";
    }
    else
    {
        // Error messages generation

        if (empty($_POST["uid"]))
        {
            $error_messages["uid"] = "This field is required";
        }
        
        if (empty($_POST["password"]))
        {
            $error_messages["password"] = "This field is required";
        }
    }
}

render_page("/login.tpl.php", "Login", compact("user", "error_messages"));
