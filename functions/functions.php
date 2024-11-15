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

        $sql = "SELECT orders.id as id, users.username as username, foods.name as foods, categories.name as category, foods_orders.quantity as quantity, orders.created_at as created FROM `foods_orders` JOIN foods ON foods_orders.foods_id = foods.id JOIN orders ON foods_orders.orders_id = orders.id JOIN users ON orders.user_id = users.id JOIN categories ON foods.category_id = categories.id WHERE orders.is_deleted = 0 ORDER BY orders.created_at DESC;";
    
        $run = $conn->query($sql);
        $results = $run->fetch_all(MYSQLI_ASSOC);
        
        if(!empty($results)){
            return $results;
        
        }else{
            return false;
        }
    }

    function fetch_foods($cat, $filter_deleted = true){
        global $conn;
        $cat = filter_var($cat, FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT * FROM `foods` WHERE category_id = $cat";
        if($filter_deleted){
            $sql .= " AND is_deleted = 0";
        }
        $run = $conn->query($sql);
        $results = $run->fetch_all(MYSQLI_ASSOC);
        
        if($run->num_rows > 0){
           return $results;
        }

        $conn->close();
    }

    function fetch_users(){
        global $conn;
        $sql = "SELECT users.id, users.username, users.email, users.created_at, roles.id as role_id, roles.name as 'role', users.is_deleted FROM `users` JOIN roles ON users.role_id = roles.id;";
        
        $run = $conn->query($sql);
        $results = $run -> fetch_all(MYSQLI_ASSOC);
        
        if($run->num_rows > 0){
           return $results;
        }

        $conn->close();
    }


    function get_user($user_id){
        global $conn;
        $sql = "SELECT users.username, users.email, users.created_at, roles.id as role_id, roles.name as 'role' FROM `users` JOIN roles ON users.role_id = roles.id WHERE users.id = $user_id";
        $run = $conn->query($sql);
        return $run->fetch_assoc();
    }

    function role_checklist($role_id, $role_whitelist = [1]){
        return in_array($role_id, $role_whitelist);
    }