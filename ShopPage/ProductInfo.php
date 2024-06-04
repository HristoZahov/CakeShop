<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="../CSS/Shop.css?<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        session_start();
        include_once '../PHPUtilities/Product.php';
        include_once "../PHPUtilities/Utilities.php";
        require_once("header.php");

       if($_GET){
            $id = $_GET['id'];
            $cake = getOneProduct($id);
            ?>
            <div class="text-white p-5 center">
                <h2 class="text-center h2-header"><?php echo $cake['Name'] ?></h2>
                <div style="width: 100%;">
                    <img class="product-img" src="../Pictures/Products/<?php echo $cake['Picture'] ?>" alt="picture" >
                    <div class="description price">
                        <form action="" >
                            <p>Цена: <?php echo $cake['Price'] ?> лв.</p>
                            <p><input class="w-2-5" type="number" step="1" value="1"> бр.</p>
                            <br>
                            <button type="submit"><p><img src="../Pictures/Icons/Cart.png" alt="">Добави</p></button>
                        </form>
                    </div>
                </div>
                <div class="text-center">
                    <div class="description bot-line">
                        <p>Тегло: <?php echo weightFilter($cake['Weight']); if($cake['Measurement'] == "kg"){ echo " кг";}else{ echo " гр";}?></p>
                        <p>Парчета: <?php echo $cake['Pieces']?> бр.</p>
                        <p>Тип: <?php echo $cake['Type']?></p>
                        <p>Описание: <?php echo $cake['Description']?></p>
                    </div>
                </div>
            </div>
            <?php
       }else{
        header("location: Shop.php");
       }
    ?>
</body>
</html>