<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="../CSS/Shop.css?<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        session_start();
        include_once "../PHPUtilities/Product.php";
        include_once "../PHPUtilities/Type.php";
        include_once "../PHPUtilities/Utilities.php";
        if(isset($_SESSION['user'])){
            require_once("header.php");
    ?>
    <div class="d-flex justify-content-center flex-wrap">
    <?php 
        if($_GET){
            $type = $_GET['search'];
            $products = getFilterProducts($type);
        }else if($_POST){
            $search = $_POST['filter'];
            $products = getSearchProducts($search);
        }else{
            $products = getAllProducts();
        }

        foreach ($products as $key => $value) {
            ?>
            <div class="contain">
                <a style="text-decoration: none;color: white;" href="ProductInfo.php?id=<?php echo $value['Id'] ?>">
                    <img src="../Pictures/Products/<?php echo $value['Picture']; ?>" alt="cake picture">
                    <div>
                        <h3><?php echo $value['Name'] ?></h3>
                        <p>Тип: <?php echo $value['Type'] ?></p>
                        <?php if($value['Type'] == "Парче"){?>
                        <p>Тегло: <?php echo weightFilter($value['Weight']); if($value['Measurement'] == "kg"){ echo " кг";}else{ echo " гр";}?></p>
                        <?php
                        }else if($value['Type'] == "Торта"){
                        ?>
                        <p>Парчета: <?php echo $value['Pieces']?> бр.</p>
                        <?php
                        }
                        ?>
                        <p>Цена: <?php echo $value['Price'] ?> лв.</p>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    }else{
        header("location: ../Login/Login.php");
    }
    ?>
</body>
</html>