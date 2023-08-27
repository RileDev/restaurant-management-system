<?php

    function clean($str){
        return htmlentities($str);
    }

    function redirect($location){
        header("location: $location");
    }

    function redirect_message($message, $location, $exit = false){
        $_SESSION["message"] = $message;
        redirect($location);
        if($exit){
            exit();
        }
    }

    function redirect_close_db($message, $location){
        global $conn;
        $conn->close();
        redirect_message($message, $location);
    }