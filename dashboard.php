<?php
    require_once("./functions/init.php");

    $role_whitelist = [1, 2];
    
    if(!isset($_SESSION["user_id"])){
        redirect_message("Access denied", "index.php", true);
    }
    $user_id = $_SESSION["user_id"];
    $user = get_user($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Restaruant Good Foodys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container">
        <header>
            <?php if(isset($_SESSION["message"])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="text-success"><?=$_SESSION["message"]?></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION["message"]) ?>
                </div>
            <?php endif; ?>

            <nav class="border border-secondary border-top-0 border-start-0 border-end-0 py-3 text-center d-flex justify-content-between align-items-center">
                <div class="text-start">
                    <p>Howdy, <?= $user['username']?> <br> <?= strtoupper($user['role']) ?></p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
                <div>
                    <?php if($user["role_id"] == 1): ?>
                        <a href="#">Actions</a>
                    <?php endif ?>
                </div>  
                <div>
                    <?php if(in_array($user["role_id"], $role_whitelist)) : ?>
                    <form action="create_order.php" method="post">
                        <input type="hidden" name="user_id" value="<?= $user_id?>" />
                        <button class="btn btn-success">New order</button>
                    </form>
                    <?php endif; ?>
                </div>
            </nav>
            
        </header>

        <main>
            <div class="row mt-5">
            <?php 
                $orders = fetch_orders();
                if(!$orders){
                    echo "No orders available";
                    return;
                }
                $orders_element = [];
                foreach($orders as $order){
                    $orders_element[$order['id']]['id']=$order['id'];
                    $orders_element[$order['id']]['username'] = $order['username'];
                    $orders_element[$order['id']]['created'] = $order['created'];
                    $orders_element[$order['id']]['foods'][]=array('foods'=>$order['foods']);
                }

                foreach($orders_element as $element) : $id = $element["id"] ?>
                <div class="col-md-3">
                <div class="card" style="width: 18rem;" id="<?= $id ?>">
                        <div class="card-body">
                            <h5 class="card-title">Order no. <?= $id ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $element["username"]?></h6>
                            <hr>
                            <ol>
                                <?php
                                    $foods = $element["foods"];
                                    foreach($foods as $food){
                                        echo '<li class="card-text">'.$food["foods"].'</li>';
                                    }
                                ?>
                            </ol> 
                            <hr>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Order created: <?= date('H:i:s, d. F', strtotime($element["created"]))?></h6>
                            <hr>
                            <a href="remove_order.php?id=<?=$id?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                </div>
                    
                <?php endforeach;?>
            </div>
            
            
        </main>
    </div>

    <?php $conn->close(); ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>