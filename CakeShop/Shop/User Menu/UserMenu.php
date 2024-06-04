<?php
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
    <title>Акаунт</title>
    <link rel="icon" type="image/x-icon" href="../../Pictures/Main/Logo.png">
</head>
<body>
<?php
    require_once("../../Tools/header.php");
    if(!isset($_SESSION['User'])){?>
        <script>window.location.href = "../../"</script>
    <?php
    }
    if(isset($_SESSION['Edit_Success'])){
        echo "<script>window.onload = function(){alert('Успешно редактиране')}</script>";
        unset($_SESSION['Edit_Success']);
    }
    if(isset($_SESSION['Edit_Error'])){
        echo "<script>window.onload = function(){alert('{$_SESSION['Edit_Error']}')}</script>";
        unset($_SESSION['Edit_Error']);
    }
    $user = unserialize($_SESSION['User']);
    ?>
    <div class="edit_user_div">
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
            <ul class="list-unstyled p-0 mb-0">
                <li><a href="<?php echo $paths->get_path(); ?>Shop/User Menu/UserMenu.php"><i class="fa-solid fa-house">Профил</i></a></li>
                <li><a href="<?php echo $paths->get_path(); ?>Shop/User Menu/OrderMenu.php"><i class="fa-solid fa-check">Поръчки</i></a></li>
            </ul>
        </div>

        <form action="UpdateUserDetails.php" method="post" class="edit_user">
            <input type="hidden" name="id" value="<?php echo $user->get_id();?>">
            <label for="name">Име*</label><br>
            <input type="text" name="name" id="name" value="<?php echo $user->get_name();?>" autocomplete="off" required><br>

            <label for="surname">Фамилия*</label><br>
            <input type="text" name="surname" id="surname" value="<?php echo $user->get_surname();?>" autocomplete="off" required><br>

            <label for="email">Имейл*</label><br>
            <input type="email" name="email" id="email" value="<?php echo $user->get_email();?>" autocomplete="off" required><br>

            <label for="phone">Телефон*</label><br>
            <input type="text" name="phone" id="phone" value="<?php echo $user->get_phone();?>" pattern="^0[\d]{9}$" autocomplete="off" required><br>

            <input type="submit" value="Запази">
        </form>

        <form action="ChangePassword.php" method="post" class="edit_user">
            <input type="hidden" name="id" value="<?php echo $user->get_id();?>">
            <label for="password">Парола*</label><br>
            <input type="password" name="password_e" id="password_e" autocomplete="off" required><br>

            <label for="password_rp">Потвърди парола*</label><br>
            <input type="password" name="password_rp_e" id="password_rp_e" autocomplete="off" required><br>

            <input type="submit" value="Запази">
        </form>
    </div>
</body>
</html>