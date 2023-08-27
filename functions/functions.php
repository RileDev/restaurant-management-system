<?php

    function clean($str){
        return htmlentities($str);
    }

    function redirect($location){
        header("location: $location");
    }

    function redirect_message($message, $location, $exit = false){
        $_SESSION["message"] = $message;
        redirect($location);
        if($exit){
            exit();
        }
    }

    function redirect_close_db($message, $location){
        global $conn;
        $conn->close();
        redirect_message($message, $location);
    }

    function fetch_orders() {
        global $conn;

        $sql = "SELECT orders.id as id, users.username as username, foods.name as foods, categories.name as category, orders.created_at as created FROM `foods_orders` JOIN foods ON foods_orders.foods_id = foods.id JOIN orders ON foods_orders.orders_id = orders.id JOIN users ON orders.user_id = users.id JOIN categories ON foods.category_id = categories.id WHERE orders.is_deleted = 0 ORDER BY orders.created_at DESC;";
    
        $run = $conn->query($sql);
        $results = $run->fetch_all(MYSQLI_ASSOC);
        
        if(!empty($results)){
            return $results;
        
        }else{
            return false;
        }
    }