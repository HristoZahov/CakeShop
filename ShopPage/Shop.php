<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="../CSS/Shop.css?<?php echo time(); ?>">
</head>
<body>
    <p class="intro">My cakes!</p>
    <div class="products">
        <?php
        include '../PHPUtilities/Product.php';

        $products = getAllProducts();

        foreach ($products as $key => $value) {
        ?>
        <div class="conteiner">
            <a href="ProductInfo.php?id=<?php echo $value['Id']; ?>">
                <img src="../Pictures/Products/<?php echo $value['Picture']; ?>" alt="picture">
                <div class="info">
                    <h2><?php echo $value['Name']; ?></h2>
                    <p>Цена: <?php echo $value['Price']; ?> лв.</p>
                    <p>Тип: <?php echo $value['Type']; ?></p>
                </div>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
</body>

<script type="text/javascript">
    const links = document.getElementsByTagName('a');

    for (let i = 0; i < links.length; i++) {
        const element = links[i];
        if(element.pathname == window.location.pathname){
            element.classList.add('active');
        }
    }
</script>
</html>