<?php require_once("./functions/init.php");

if(!isset($_SESSION["user_id"])){
    redirect_message("Access denied", "index.php", true);
}
$user_id = $_SESSION["user_id"];
$user = get_user($user_id);

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "UPDATE orders SET is_deleted = 1 WHERE id = ?";
        $run = $conn->prepare($sql);
        $run->bind_param("i", $id);
        $run->execute();

        redirect_close_db("Order removed", "dashboard.php");

    }
}