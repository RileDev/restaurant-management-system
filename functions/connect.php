<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "db_restaurant";

    $conn = mysqli_connect($host, $username, $password, $db);

    if(!$conn){
        echo "Err. no.: " . mysqli_errno($conn) . " " . mysqli_error($conn);
        exit();
    }else{
        return $conn;
    }