<?php
    include_once("../../PHP/OrderUtilities.php");
    require_once("../../PHP/Paths.php");
    $paths = new Paths();
    $paths->back("../../",false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
    <title>Поръчки</title>
</head>
<body>
<?php
    require_once("../../Tools/header.php");
    if(!isset($_SESSION['User'])){?>
        <script>window.location.href = "../../"</script>
    <?php
    }
    $user = unserialize($_SESSION['User']);
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
        <table class="orders">
            <?php
            $orders = get_user_orders($user->get_id());
            if(!empty($orders)){?>
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <?php
                foreach ($orders as $key => $value) {?>
                    <tr>
                        <td><?php echo $value["Id"];?></td>
                        <td><?php echo explode(" ",$value["Date"])[0];?></td>
                        <td><?php echo $value["Status_Name"];?></td>
                        <td><?php echo $value["All_Price"];?> лв.</td>
                        <td><button onclick="window.location.href = '../Order.php?Id=<?php echo $value['Id'];?>'">Виж</button></td>
                    </tr>
                <?php
                }
            }else{?>
                <p class="not_items">Нямя намерени поръчки</p>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>