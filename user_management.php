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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
            <h1 class="title py-3">Manage Users</h1>
            <p>User: <?=$user["username"]?></p>
            <a href="dashboard.php">Return to dashboard</a>
        </nav>
    </header>

    <section class="container">
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Add User</button>
        <div class="all_users">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach (fetch_users() as $user){
                ?>
                <tr>
                    <th scope="row"><?=$user["id"]?></th>
                    <td><?=$user["username"]?></td>
                    <td><?=$user["email"]?></td>
                    <td><?=$user["role"]?></td>
                    <td><?=$user["created_at"]?></td>
                    <td>
                        <?php if($user["id"] != $user_id): ?>
                            <?php if ($user["is_deleted"] == 0) : ?>
                                <a href="delete_user.php?id=<?=$user["id"]?>" class="badge bg-danger text-decoration-none"><i class="fa-solid fa-trash"></i></a>
                            <?php else: ?>
                                <a href="enable_user.php?id=<?=$user["id"]?>" class="badge bg-primary text-decoration-none"><i class="fa-solid fa-check"></i></a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="badge bg-secondary text-decoration-none" disabled><i class="fa-solid fa-trash"></i></a>
                        <?php endif; ?>
                        <a href="edit_user.php?id=<?=$user["id"]?>" class="badge bg-primary text-decoration-none"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>

                <?php }?>
                </tbody>
            </table>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>