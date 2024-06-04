<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <link rel="stylesheet" href="../CSS/OneProduct.css">
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
    <title>Продукт</title>
</head>
<body>
    <?php
        include_once("../PHP/Product/Utilities.php");

        require_once("../PHP/Paths.php");
        $paths = new Paths();
        $paths->back("../",false);
        require_once("../Tools/header.php");
        
        if($_GET){
            $product = get_one_product($_GET['id']);
            ?>
            <h3 class="text-center product_name"><?php echo $product->get_name();?></h3>
            <div class="product">
                <img src="<?php echo $paths->get_picture();echo $product->get_picture();?>" alt="Picture">
                <div>
                    <p>Тип: <?php echo $product->get_category();?></p>
                    <?php
                        if($product->get_pieces() != null){?>
                            <p>Парчета: <?php echo $product->get_pieces();?> бр.</p>
                        <?php
                        }
                        if($product->get_weight() != null && $product->get_measurement() != null){?>
                            <p>Тежест: <?php echo $product->get_weight() . " " . $product->get_measurement();?></p>
                        <?php
                        }
                        if($product->get_description() != null){?>
                        <p>Описание: <?php echo $product->get_description();?></p>
                        <?php
                        }
                        ?>
                </div>
                <?php
                    if($product->get_status_id() == 1){?>
                        <div>
                            <p>Цена: <?php echo $product->get_price();?> лв</p>
                            <select name="count" id="count">
                                <?php
                                    for ($i=1; $i <= 20; $i++) { 
                                        ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?> бр.</option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <button class="cart" onclick="add_to_cart(<?php echo $product->get_id(); ?>)"><i class="fa-solid fa-cart-shopping"></i></button>
                        </div>
                <?php
                }else{?>
                    <div>
                        <p>Неналичен</p>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
        }
    ?>
</body>
</html>