<?php require_once("./functions/init.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "UPDATE orders SET is_deleted = 1 WHERE id = ?";
        $run = $conn->prepare($sql);
        $run->bind_param("i", $id);
        $run->execute();

        redirect_close_db("Oreder finished", "dashboard.php");

    }
}