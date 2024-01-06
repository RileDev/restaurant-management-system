<?php require_once("./functions/init.php");

if(!isset($_SESSION["user_id"])){
    redirect_message("Access denied", "index.php", true);
}

$user_id = $_SESSION["user_id"];
$user = get_user($user_id);

$is_admin = role_checklist($user["role_id"]);

if(!$is_admin){
    redirect_message("Access denied", "index.php", true);
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "UPDATE foods SET is_deleted = 1 WHERE id = ?";
        $run = $conn->prepare($sql);
        $run->bind_param("i", $id);
        $run->execute();

        redirect_close_db("Item updated", "food_management.php");

    }
}