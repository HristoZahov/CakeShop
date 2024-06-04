<?php
    include_once("../../Tools/Links.html");
    include_once("../../PHP/DataBase.php");
    include_once("../../PHP/OrderUtilities.php");
    session_start();

    if(!isset($_SESSION['Admin'])){
        header("location: ../../");
    }
    $id = $_GET['Id'];
    $order = get_order($id);
    $products = get_products_for_order($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Add_Edit.css">
    <link rel="icon" type="image/x-icon" href="../../Pictures/Main/Logo.png">
    <title>Поръчка</title>
</head>
<body>
    <?php require_once("../Menu.php");?>
    <div class="float-start panel">
        <p>Номер на поръчка: <?php echo $order[0]["Id"];?></p>
        <p>Дата: <?php echo $order[0]["Date"];?></p>
        <p>Потребител: <?php echo $order[0]["Name"]." ".$order[0]["Surname"];?></p>
        <p>Имейл: <?php echo $order[0]["Email"];?></p>
        <p>Телефон: <?php echo $order[0]["Phone"];?></p>
        <p>Адрес: <?php echo $order[0]["Address"];?></p>
        <p>Статус: <?php echo $order[0]["Status_Name"];?></p>
    </div>
    <table class="float-start panel">
        <thead>
            <tr>
                <th>№</th>
                <th>Продукт</th>
                <th>Цена</th>
                <th>Брой</th>
                <th>Общо</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            foreach ($products as $key => $value) {?>
                <tr>
                    <td><?php echo $i;$i++;?></td>
                    <td><img src="../../Pictures/Products/<?php echo $value["Picture"];?>" alt="picture" width="100px" height="fit-content"><?php echo $value["Name"];?></td>
                    <td><?php echo $value["Price"];?> лв.</td>
                    <td><?php echo $value["Count"];?></td>
                    <td>
                    <?php 
                    $price = $value["Count"]*$value["Price"];
                    $price = number_format($price, 2, '.', '');
                    echo $price;?> лв.
                    </td>
                </tr>
            <?php
            }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end">Обща цена: <?php echo $order[0]["All_Price"];?> лв.</td>
            </tr>
        </tfoot>
    </table>
    <script src="../../JavaScript/AdminPanel/Add_Edit.js"></script>
</body>
</html>