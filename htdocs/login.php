<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/_global.php";

$field_values = [];
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if (!empty($_POST["uid"]) && !empty($_POST["password"]))
    {
        if ($_POST["user_type"] === USER_STAFF)
        {
            $statement = $database->prepare("SELECT `sid` FROM `staff` WHERE `sid` = ? AND `spassword` = ?");
            $statement->execute([$_POST["uid"], $_POST["password"]]);
            $result = $statement->get_result();
            if ($result->num_rows === 1)
            {
                $user = $result->fetch_assoc();
                $_SESSION["user_type"] = USER_STAFF;
                $_SESSION["user_id"] = $user["sid"];

                header(sprintf("Location: /%s", $_GET["return"] ?? "admin"), true, 307);
                exit;
            }

            $field_values["user_type"] = USER_STAFF;
        }
        else
        {

            $statement = $database->prepare("SELECT `cid` FROM `customer` WHERE `cid` = ? AND `cpassword` = ?");
            $statement->execute([$_POST["uid"], $_POST["password"]]);
            $result = $statement->get_result();
            if ($result->num_rows === 1)
            {
                $user = $result->fetch_assoc();
                $_SESSION["user_type"] = USER_CLIENT;
                $_SESSION["user_id"] = $user["cid"];

                header(sprintf("Location: /%s", $_GET["return"] ?? ""), true, 307);
                exit;
            }

            $field_values["user_type"] = USER_CLIENT;
        }

        $field_values["uid"] = $_POST["uid"];
        $error_messages["password"] = "User ID or password is incorrect";
    }
    else
    {
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

render_page("/login.tpl.php", "Login", compact("field_values", "error_messages"));
