<?php
    include_once("../../Tools/Links.html");
    include_once("../../PHP/DataBase.php");
    include_once("../../PHP/User/User.php");
    include_once("../../PHP/Universal/Universal.php");
    include_once("../../PHP/User/Utilities.php");
    session_start();

    if(!isset($_SESSION['Admin'])){
        header("location: ../../");
    }

    $id = $_GET['Id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Add_Edit.css">
    <link rel="icon" type="image/x-icon" href="../../Pictures/Main/Logo.png">
    <title>Редактиране</title>
</head>
<body>
    <?php require_once("../Menu.php");?>
    <?php $user = get_one_user($id);?>
    <form action="Process/edit.php" method="post">
        <table class="float-start panel">
            <tbody>
                <input type="hidden" name="id" value="<?php echo $user->get_id();?>">
                <tr>
                    <td><label for="first_name">Име:</label></td>
                    <td><input type="text" name="first_name" id="first_name" value="<?php echo $user->get_name();?>" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="last_name">Фамилия:</label></td>
                    <td><input type="text" name="last_name" id="last_name" value="<?php echo $user->get_surname();?>" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="email">Имейл:</label></td>
                    <td><input type="text" name="email" id="email" value="<?php echo $user->get_email();?>" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Телефон:</label></td>
                    <td><input type="text" name="phone" id="phone" value="<?php echo $user->get_phone();?>" autocomplete="off"></td>
                </tr>
                <?php
                $main_user = unserialize($_SESSION['Admin']);
                if($main_user->get_type_id() == 3){?>
                <tr>
                    <td><label for="password">Парола:</label></td>
                    <td><input type="password" name="password" id="password" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="psw-repeat">Потвърди парола:</label></td>
                    <td><input type="password" name="psw-repeat" id="psw-repeat" autocomplete="off"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"><input class="exit" type="submit" value="Редактирай"></td>
                </tr>
            </tfoot>
        </table>
    </form>
    <?php
        if(isset($_SESSION['Edit_Success'])){
            echo "<script>window.onload = function(){alert('Успешно редактиране')}</script>";
            unset($_SESSION['Edit_Success']);
        }
        if(isset($_SESSION['Edit_Error'])){
            echo "<script>window.onload = function(){alert('{$_SESSION['Edit_Error']}')}</script>";
            unset($_SESSION['Edit_Error']);
        }
    ?>
</body>
<script src="../../JavaScript/AdminPanel/Add_Edit.js"></script>
</html>