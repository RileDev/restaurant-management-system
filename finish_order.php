<?php 
    require_once("./functions/init.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['foods-array']) && isset($_SESSION["order_id"])){
            $items = json_decode($_POST['foods-array'], true);
            $order_id = $_SESSION["order_id"];

            foreach($items as $item){
                $sql = "INSERT INTO `foods_orders`(foods_id, quantity, orders_id) VALUE(?, ?, ?)";
                $run = $conn->prepare($sql);
                $run->bind_param("isi", $item["id"], $item["quantity"], $order_id);
                $run->execute();
            }
            
            // $array= $_POST['foods-array'];

            // $items = explode(",", $array);
            
            // foreach($items as $item){
            //     $sql = "INSERT INTO `foods_orders`(foods_id, orders_id) VALUE(?, ?)";
            //     $run = $conn->prepare($sql);
            //     $run->bind_param("ii", $item, $order_id);
            //     $run->execute();
            // }

            redirect_close_db("Order no. $order_id has successfully created", "dashboard.php");
        }
    }

    redirect("index.php");

