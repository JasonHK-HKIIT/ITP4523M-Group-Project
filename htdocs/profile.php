<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/_global.php");

ensure_client();
ensure_logged_in();

$client = [];
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $statement = $database->prepare("SELECT `cpassword` FROM `customer` WHERE `cid` = ? LIMIT 1");
    $statement->bind_param("i", $_SESSION["user_id"]);
    $statement->execute();

    $result = $statement->get_result();
    $cpassword = $result->fetch_object()->cpassword;

    if ((empty($_POST["cpassword"]) || ($_POST["cpassword"] == $cpassword))
        && ((empty($_POST["cpassword_new"]) && empty($_POST["cpassword_confirm"])) || (!empty($_POST["cpassword"]) && (strlen($_POST["cpassword_new"]) <= 255) && !empty($_POST["cpassword_confirm"]) && ($_POST["cpassword_new"] === $_POST["cpassword_confirm"])))
        && (empty($_POST["ctel"]) || is_telephone($_POST["ctel"]))
        && (empty($_POST["caddr"]) || (strlen($_POST["caddr"]) <= 65535)))
    {

    }
    else
    {
        $client["ctel"] = $_POST["ctel"];
        $client["caddr"] = $_POST["caddr"];

        if (!empty($_POST["cpassword_new"]) && empty($_POST["cpassword"]))
        {
            $error_messages["cpassword"] = "This field is required";
        }
        else if (!empty($_POST["cpassword"]) || ($_POST["cpassword"] != $cpassword))
        {
            $error_messages["cpassword"] = "The password is incorrect";
        }

        else if (!empty($_POST["cpassword_new"]) && strlen($_POST["cpassword_new"]) > 255)
        {
            $error_messages["cpassword_new"] = "The password is too long";
        }

        if (!empty($_POST["cpassword_new"]) && empty($_POST["cpassword_confirm"]))
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
    }
}
else
{
    $statement = $database->prepare("SELECT `cid`, `cpassword`, `cname`, `company`, `ctel`, `caddr` FROM `customer` WHERE `cid` = ? LIMIT 1");
    $statement->bind_param("i", $_SESSION["user_id"]);
    $statement->execute();

    $result = $statement->get_result();
    $client = $result->fetch_assoc();
}

render_page("/profile.tpl.php", "Profile", compact("client"));
