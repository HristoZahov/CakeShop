<?php
    include_once("../Tools/Links.html");
    include_once("../PHP/DataBase.php");
    include_once("../PHP/OrderUtilities.php");
    include_once("../PHP/User/User.php");
    include_once("../PHP/User/Utilities.php");
    include_once("../PHP/Universal/Universal.php");
    include_once("../PHP/Universal/Utilities.php");
    include_once("../PHP/Product/Product.php");
    include_once("../PHP/Product/Utilities.php");
    session_start();

    if(!isset($_SESSION['Admin'])){
        header("location: ../");
    }

    if(isset($_SESSION['Add_Success'])){
        echo "<script>window.onload = function(){alert('Успешно добавяне')}</script>";
        unset($_SESSION['Add_Success']);
    }
    if(isset($_SESSION['Edit_Success'])){
        echo "<script>window.onload = function(){alert('Успешно редактиране')}</script>";
        unset($_SESSION['Edit_Success']);
    }
    $user = unserialize($_SESSION['Admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="180">
    <title>Админ Панел</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
    <link rel="stylesheet" href="../CSS/AdminPanel.css">
</head>
<body>
    <ul class="float-start" type="none" id="navbar">
        <li>Продукти</li>
        <li>Категории</li>
        <li>Поръчки</li>
        <li>Потребители</li>
        <li><button class="exit" onclick="exit('../')">Изход</button></li>
    </ul>

    <div class="panel float-start overflow-auto" style="margin-left: 1em">
        <?php
        require_once("Product/AllProducts.php");
        require_once("Category/AllCategories.php");
        require_once("Order/AllOrders.php");
        require_once("User/AllUsers.php");
        ?>
    </div>
    <div id="info"></div>
</body >
<script src="../JavaScript/AdminPanel/AdminPanel.js"></script>
<script>
    let visible = "<?php
        if(isset($_SESSION["Back"])){
            echo $_SESSION["Back"];
        }else{
            echo 0;
        }
    ?>";
    update_visible(visible)
</script>
</html>