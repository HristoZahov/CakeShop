<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delight</title>
    <link rel="icon" type="image/x-icon" href="Pictures/Main/Logo.png">
    <link rel="stylesheet" href="CSS/MainPage.css">
</head>
<body>
    <?php 
        include_once("PHP/Product/Utilities.php");

        require_once("PHP/paths.php");
        $paths = new Paths();
        require_once("Tools/header.php");
    ?>
    <div class="products">
        <?php
        if(isset($_POST['category'])){
            $products = get_category_products($_POST['category']);
        }else if(isset($_POST['search'])){
            $products = get_searched_products($_POST['search']);
        }else{
            $products = get_all_products();
        }
        
        if(!empty($products)){
            foreach($products as $product){
                if($product->get_status_id() == 1){
                ?>
                <a class="product" href="Shop/OneProduct.php?id=<?php echo $product->get_id(); ?>">
                    <img src="<?php echo $paths->get_picture();echo $product->get_picture();?>" alt="Picture">
                    <h3 class="text-center"><?php echo $product->get_name();?></h3>
                    <div class="bottom">
                        <p>Тип: <?php echo $product->get_category();?></p>
                        <p>Цена: <?php echo $product->get_price();?> лв</p>
                        <p><button class="cart" onclick="add_to_cart(<?php echo $product->get_id(); ?>);return false"><i class="fa-solid fa-cart-shopping"></i></button></p>
                    </div>                    
                </a>
                <?php
                }
            }
        }else{?>
            <p class="not_items">Няма намерени продукти</p>
        <?php
        }
        ?>
    </div>
</body>
</html>