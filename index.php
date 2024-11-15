<?php 
require_once("./functions/init.php");
if(isset($_SESSION["user_id"])){
    redirect("dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Login - Restaruant Good Foodys</title>
    <style>
        input{
            max-width: 320px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <form action="user_login.php" method="post" class="d-flex flex-column justify-content-center align-items-center mt-5">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <input type="submit" class="btn btn-primary mt-3" />
        </form>

        <?php if(isset($_SESSION["message"])) : ?>
            <p class="pt-3 text-danger"><?=$_SESSION["message"]?></p>
            <?php unset($_SESSION["message"]) ?>
        <?php endif; ?>
    </div>

   
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>