<?php 
    require_once("./functions/init.php");

    $username = "Mira123";
    $email = "mmira@mail.com";
    $password = password_hash("admin123", PASSWORD_DEFAULT);
    $role_id = 2;

    $sql = "INSERT INTO users(username, email, password, role_id) VALUES(?, ?, ?, ?)";
    $run = $conn->prepare($sql);
    $run->bind_param("sssi", $username, $email, $password, $role_id);
    // $run->execute();

    $conn->close();