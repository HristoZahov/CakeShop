<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <?php
        include_once '../PHPUtilities/Product.php';

       if($_GET){
            $id = $_GET['id'];
            $cake = getOneProduct($id);
            ?>
            <img src="../Pictures/Products/<?php echo $cake['Picture']; ?>" alt="picture" width="400px" height="400px">
            <?php
       }else{
        header("location: Shop.php");
       }
    ?>
</body>
</html>