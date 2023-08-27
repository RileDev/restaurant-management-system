<?php
    require_once("./functions/init.php");


    if(!isset($_SESSION["user_id"])){
        redirect_message("Access Denied", "index.php", true);
    }

    unset($_SESSION["user_id"]);
    redirect_message("Logged out successfully!", "index.php", true);