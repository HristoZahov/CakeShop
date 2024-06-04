<?php
    include_once("../PHP/Product/Utilities.php");

    require_once("../PHP/Paths.php");
    $paths = new Paths();
    $paths->back("../",false);

    if(isset($_SESSION["order_error"])){
        echo "<script>window.onload = function(){alert('Адресът е задължителен!')}</script>";
        unset($_SESSION["order_error"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Basket.css?<?php echo time();?>">
    <title>Количка</title>
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
</head>
<body>
    <?php
    require_once("../Tools/header.php");
    if(!isset($_SESSION['User'])){?>
        <script>window.location.href = "../Login/Login.php"</script>
    <?php
    }
    $user = unserialize($_SESSION['User']);
    ?>
    <div id="page_basket">
        <?php show_basket_in_file($user->get_id());?>
    </div>
    <script>
        function delete_item_in_basket(product_id){
            delete_item_in_cart(product_id)
            jQuery.ajax({url: "RefreshPageBasket.php",success: function(result){
                $("#page_basket").html(result)
            }})
        }
    </script>
</body>
</html>