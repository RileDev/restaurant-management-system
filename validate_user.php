<?php require_once("./functions/init.php");

if(!isset($_SESSION["user_id"])){
    redirect_message("Access denied", "index.php", true);
}

$user_id = $_SESSION["user_id"];
$user = get_user($user_id);

$is_admin = role_checklist($user["role_id"]);

if(!$is_admin){
    redirect_message("Access denied", "index.php", true);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(
        isset($_POST["username"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["role"])
    ){
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
        $role = $_POST["role"];

        $errors = validate_user($username, $email, $password);

        if(empty($errors)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            create_user($username, $email, $password, $role);
            redirect_message("User added successfully", "user_management.php", true);
        }else{
            $messages = "";

            foreach($errors as $error){
                $messages .= "<li>" . $error . "</li>\n";
            }

            redirect_message($messages, "user_management.php", true);
        }

    }
}