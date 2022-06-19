<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="Shop.css?<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        include_once '../PHPUtilities/Product.php';

       if($_GET){
            require_once("header.html");
            $id = $_GET['id'];
            $cake = getOneProduct($id);
            ?>
            <img src="../Pictures/Products/<?php echo $cake['Picture']; ?>" alt="picture" >
            <?php
       }else{
        header("location: Shop.php");
       }
    ?>
</body>
</html>