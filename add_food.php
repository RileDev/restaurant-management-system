<?php

    require_once("./functions/init.php");
    
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
        if(isset($_POST["food"]) && $_POST["cat"]){
            $food_name = $_POST["food"];
            $category = $_POST["cat"];

            echo $food_name . " " . $category;

            $sql = "INSERT INTO `foods`(`name`, `category_id`) VALUES (?, ?)";
            $run = $conn->prepare($sql);
            $run->bind_param('si', $food_name, $category);
            $run->execute();

            unset($_POST);
            redirect_close_db("Item added", "food_management.php");

        }
    }