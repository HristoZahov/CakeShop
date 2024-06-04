<?php
    include_once("../PHP/OrderUtilities.php");
    require_once("../PHP/Paths.php");
    $paths = new Paths();
    $paths->back("../",false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
    <title>Поръчка</title>
</head>
<body>
<?php
    require_once("../Tools/header.php");
    if(!isset($_SESSION['User'])){?>
        <script>window.location.href = "../"</script>
    <?php
    }
    $user = unserialize($_SESSION['User']);

    $id = $_GET["Id"];
    $order = get_order($id);
    $products = get_products_for_order($id);
    ?>
    <div class="see_orders">
        <div class="menu">
            <form>
                <h5><?php 
                if (isset($_SESSION['User'])) {
                    $user = unserialize($_SESSION['User']);
                    echo $user->get_name() . " " . $user->get_surname();
                }
                ?></h5>
                <button onclick="exit('<?php echo $paths->get_path();?>');return false"><i class="fa-solid fa-right-from-bracket"></i>Изход</button>
            </form>
            <ul class="list-unstyled p-0" style="margin-bottom: 0;">
                <li><a href="<?php echo $paths->get_path(); ?>Shop/User Menu/UserMenu.php"><i class="fa-solid fa-house">Профил</i></a></li>
                <li><a href="<?php echo $paths->get_path(); ?>Shop/User Menu/OrderMenu.php"><i class="fa-solid fa-check">Поръчки</i></a></li>
            </ul>
        </div>
        <div class="text-start orders">
            <p>Номер на поръчка: <?php echo $order[0]["Id"];?></p>
            <p>Дата: <?php echo explode(" ",$order[0]["Date"])[0];?></p>
            <p>Потребител: <?php echo $order[0]["Name"]." ".$order[0]["Surname"];?></p>
            <p>Имейл: <?php echo $order[0]["Email"];?></p>
            <p>Телефон: <?php echo $order[0]["Phone"];?></p>
            <p>Адрес: <?php echo $order[0]["Address"];?></p>
            <p>Статус: <?php echo $order[0]["Status_Name"];?></p>
        </div>
        <table class="orders">
            <thead>
                <tr>
                    <th>№</th>
                    <th colspan='2' class='text-start'>Продукт</th>
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
                        <td><img src='../Pictures/Products/<?php echo $value["Picture"]; ?>' alt='picture' width="100px" height='fit-content'></td>
                        <td><a href='OneProduct.php?id=<?php echo $value["Id"];?>'><?php echo $value["Name"];?></a></td>
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
                    <td colspan="6" class="text-end">Обща цена: <?php echo $order[0]["All_Price"];?> лв.</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>