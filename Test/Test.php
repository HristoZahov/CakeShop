<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="Shop.css?<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header><h1 class="text-center text-head">Delight</h1></header>
    <div class="links">
        <button class="button float-start"><a href=""><img src="../Pictures/Icons/Lines.png" alt=""></a></button>
        <button class="button float-start"><a href=""><img src="../Pictures/Icons/Search.png" alt=""></a></button>
        <button class="button float-end"><a href=""><img src="../Pictures/Icons/Profile.png" alt=""></a></button>
        <button class="button float-end"><a href=""><img src="../Pictures/Icons/Cart.png" alt=""></a></button>
        <button id="about" class="button float-end"><a href="">За нас</a></button>
    </div>

    <div class="d-flex justify-content-center flex-wrap">
        <?php
        include_once "../PHPUtilities/Product.php";

        $products = getAllProducts();

        foreach ($products as $key => $value) {
            ?>
            <div class="contain">
                <a style="text-decoration: none;color: white;" href="ProductInfo.php?id=<?php echo $value['id']; ?>">
                    <img src="../Pictures/Products/<?php echo $value['Picture']; ?>" alt="cake picture" width="400px" height="300px">
                    <div class="">
                        <h3><?php echo $value['Name']; ?></h3>
                        <p>Цена: <?php echo $value['Price']; ?> лв.</p>
                        <!-- <p><?php //echo $value['Weight']; ?></p> -->
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>