<?php 
    require_once("./functions/init.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['foods-array']) && isset($_SESSION["order_id"])){
            $array= $_POST['foods-array'];
            $order_id = $_SESSION["order_id"];

            $items = explode(",", $array);
            
            foreach($items as $item){
                $sql = "INSERT INTO `foods_orders`(foods_id, orders_id) VALUE(?, ?)";
                $run = $conn->prepare($sql);
                $run->bind_param("ii", $item, $order_id);
                $run->execute();
            }

            redirect_close_db("Order no. $order_id has successfully created", "dashboard.php");
        }
    }

    redirect("index.php");

