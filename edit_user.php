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

$user_to_edit_id = null;
$user_to_edit = null;

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $user_to_edit_id = $_GET["id"];
        $user_to_edit = get_user($user_to_edit_id);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit user - <?=$user_to_edit["username"]?></title>
</head>
<body>
    <div class="container">
        <h3 class="mt-3">Edit user</h3>
        <a href="user_management.php">Return to list</a>
        <hr>
        <h6>ID: <?=$user_to_edit_id?></h6>
        <h6>Username: <?=$user_to_edit["username"]?></h6>
        <h6>E-mail: <?=$user_to_edit["email"]?></h6>
        <h6>Created at: <?=$user_to_edit["created_at"]?></h6>
        <h6>Role ID: <?=$user_to_edit["role_id"]?></h6>
        <h6>Role: <?=$user_to_edit["role"]?></h6>
        <hr>
        <form action="update_user_data.php" method="post">
            <label for="username">Username</label>
            <input class="form-control" type="text" id="username" name="username" value="<?=$user_to_edit["username"]?>" required> <br>
            <label for="email">E-mail</label> <br>
            <input class="form-control" type="email" id="email" name="email" value="<?=$user_to_edit["email"]?>" required> <br>
            <input type="checkbox" class="form-check-input" id="change_pass">
            <label for="change_pass">Change password</label>
            <br>
            <div class="password_fields_container">

            </div>

            <label for="roles" class="my-3">Roles: </label> <br>
            <?php foreach(fetch_roles() as $role) :?>
                <input class="form-check-input" type="radio" name="role" id="<?=$role["name"]?>" value="<?=$role["id"]?>" <?php if($role["id"] == $user_to_edit["role_id"]) echo "checked";?>>
                <label for="<?=$role["name"]?>" style="text-transform: capitalize"><?=$role["name"]?></label> <br>
            <?php endforeach; ?>

            <input type="submit" class="btn btn-primary mt-4" value="Apply changes">
        </form>

    </div>

    <script src="togglePasswordChange.js"></script>

</body>
</html>
