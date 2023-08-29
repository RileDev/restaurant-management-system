<?php
    require_once("./functions/init.php");

    if(!$_SERVER["REQUEST_METHOD"] == "POST" || !isset($_POST["user_id"])){
        redirect_message(null, "index.php", true);
    }

    $user_id = $_POST["user_id"];
    $user = get_user($user_id);

    $sql = "INSERT INTO orders(user_id) VALUE(?)";
    $run = $conn->prepare($sql);
    $run->bind_param("i", $user_id);
    $run->execute();

    $sql = "SELECT * FROM `orders` WHERE is_deleted = 0 order by id desc LIMIT 1";
    $run = $conn->query($sql);
    $order = $run->fetch_all(MYSQLI_ASSOC);
    $_SESSION["order_id"] = $order[0]["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .available-foods{
            width: 100%;
            height: 450px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>

    <div class="container">
        <header class="text-center pt-3">
            <h3>New Order - Order no. <?= $order[0]["id"]?></h3>
            <p>User: <?= $user["username"]?></p>
            <p>Created at: <?= $order[0]["created_at"]?></p>
            <button class="btn btn-danger" id="clearItems">Clear items</button>
            <hr>
        </header>

        <div class="available-foods">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-center">Meals</h6>
                    <div class="row mx-3">
                        <?php 
                            $foods = fetch_foods(1);
                            foreach($foods as $food){
                                echo "<button class='btn btn-warning my-3 text-uppercase' id='foodsBtn' data-id='".$food['id']."' onclick='fetchFoods(this)'>".$food['name']."</button>";
                            }
                            ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="text-center">Drinks</h6>
                    <div class="row mx-3">
                        <?php 
                            $foods = fetch_foods(2);
                            foreach($foods as $food){
                                echo "<button class='btn btn-primary my-3 text-uppercase' id='foodsBtn' data-id='".$food['id']."' onclick='fetchFoods(this)'>".$food['name']."</button>";
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="selected-foods">
            <div class="row">
                <h6>Selected Foods</h6>
                <ul>
                    
                </ul>
            </div>
        </div>

        <hr>
        <div class="actions my-5">
            <form action="finish_order.php" method="post">
                <input type="hidden" name="foods-array" id="foods-array">
                <button class="btn btn-success" onclick="createOrder()">Create Order</button>
            </form>
            
        </div>
        
    </div>

    <?php $conn->close() ?>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>
</html>