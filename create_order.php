<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id = $_POST["user_id"];
        echo "User ID: " . $user_id; 
    }