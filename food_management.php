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

    $meals = fetch_foods(1, false);
    $drinks = fetch_foods(2, false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php if(isset($_SESSION["message"])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="text-success"><?=$_SESSION["message"]?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php unset($_SESSION["message"]) ?>
        </div>
    <?php endif; ?>

    <header>
        <nav class="text-center">
            <h1 class="title py-3">Manage Food</h1>
            <p>User: <?=$user["username"]?></p>
            <a href="dashboard.php">Return to dashboard</a>
        </nav>
    </header>

    <section class="container">
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#foodsModal"><i class="fa-solid fa-plus"></i> Add Food</button>
        <div class="meals">
            <ul class="list-group">
            <h3>Meals List</h3>
            <?php 
                foreach($meals as $meal){
                    ?>
                        <li id="<?=$meal["id"]?>" class="list-group-item d-flex justify-content-between align-items-center <?= $meal["is_deleted"] == 1 ? "text-secondary" : ""?>">ID: <?=$meal["id"]?> <?=$meal["name"]?> 
                        <?php if ($meal["is_deleted"] == 0) : ?>
                        <a href="delete_food.php?id=<?=$meal["id"]?>" class="badge bg-danger text-decoration-none"><i class="fa-solid fa-trash"></i></a>
                        <?php else: ?>
                        <a href="enable_food.php?id=<?=$meal["id"]?>" class="badge bg-primary text-decoration-none"><i class="fa-solid fa-check"></i></a>
                        <?php endif; ?>
                    </li>
                    <?php
                }
            ?>
            </ul>

            <ul class="list-group py-5">
            <h3>Drinks List</h3>
            <?php 
                foreach($drinks as $drink){
                    ?>
                        <li id="<?=$drink["id"]?>" class="list-group-item d-flex justify-content-between align-items-center <?= $drink["is_deleted"] == 1 ? "text-secondary" : ""?>">ID: <?=$drink["id"]?> <?=$drink["name"]?> 
                        <?php if ($drink["is_deleted"] == 0) : ?>
                        <a href="delete_food.php?id=<?=$drink["id"]?>" class="badge bg-danger text-decoration-none"><i class="fa-solid fa-trash"></i></a>
                        <?php else: ?>
                        <a href="enable_food.php?id=<?=$drink["id"]?>" class="badge bg-primary text-decoration-none"><i class="fa-solid fa-check"></i></a>
                        <?php endif; ?>
                    </li>
                    <?php
                }
            ?>
            </ul>
        </div>
    </section>

    <div class="modal fade" id="foodsModal" tabindex="-1" aria-labelledby="foodsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="foodsModalLabel">Add food</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                napraviti formu za naziv hrane i odabir kategorije
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <?php $conn->close() ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>