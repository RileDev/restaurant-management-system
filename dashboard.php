<?php
    require_once("./functions/init.php");
    
    if(!isset($_SESSION["user_id"])){
        redirect_message("Access denied", "index.php", true);
    }
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT users.username, users.email, users.created_at, roles.id as role_id, roles.name as 'role' FROM `users` JOIN roles ON users.role_id = roles.id WHERE users.id = $user_id";
    $run = $conn->query($sql);
    $user = $run->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Restaruant Good Foodys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <header>
            <?php if(isset($_SESSION["message"])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="text-success"><?=$_SESSION["message"]?></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION["message"]) ?>
                </div>
            <?php endif; ?>

            <nav class="border border-secondary border-top-0 border-start-0 border-end-0 py-3 text-center d-flex justify-content-between align-items-center">
                <div class="text-start">
                    <p>Howdy, <?= $user['username']?> <br> <?= strtoupper($user['role']) ?></p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
                <div>
                    <?php if($user["role_id"] == 1) : ?>
                    <form action="create_order.php" method="post">
                        <input type="hidden" name="user_id" value="<?= $user_id?>" />
                        <button class="btn btn-success">New order</button>
                    </form>
                    <?php endif; ?>
                </div>
            </nav>
            
        </header>

        <main>
        
            
        </main>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>