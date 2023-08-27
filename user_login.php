<?php

require_once("./functions/init.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = clean($_POST["email"]);
    $password = clean($_POST['password']);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $sql = 'SELECT * FROM `users` WHERE email = ? AND is_deleted = 0';

    $run = $conn->prepare($sql);
    $run->bind_param("s", $email);
    $run->execute();

    $results = $run->get_result();

    if($results->num_rows != 0){
        $user = $results->fetch_assoc();
        if(password_verify($password, $user["password"])){
            $_SESSION["user_id"] = $user["id"];
            redirect_close_db("User successfully logged in :D", "dashboard.php");
        }else{
            redirect_close_db("Wrong password", "index.php");
        }

    }else{
        redirect_close_db("User not found", "index.php");
    }

}