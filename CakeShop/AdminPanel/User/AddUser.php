<?php
    include_once("../../Tools/Links.html");
    include_once("../../PHP/DataBase.php");
    include_once("../../PHP/Universal/Universal.php");
    include_once("../../PHP/Product/Product.php");
    include_once("../../PHP/Product/Utilities.php");
    session_start();

    if(!isset($_SESSION['Admin'])){
        header("location: ../../");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Add_Edit.css">
    <title>Добавяне</title>
    <link rel="icon" type="image/x-icon" href="../../Pictures/Main/Logo.png">
</head>
<body>
    <?php require_once("../Menu.php");?>
    <form action="Process/add.php" method="post">
        <table class="float-start panel">
            <tbody>
                <tr>
                    <td><label for="first_name">Име:</label></td>
                    <td><input type="text" name="first_name" id="first_name" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="last_name">Фамилия:</label></td>
                    <td><input type="text" name="last_name" id="last_name" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="email">Имейл:</label></td>
                    <td><input type="email" name="email" id="email" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Телефон:</label></td>
                    <td><input type="text" name="phone" id="phone" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="password">Парола:</label></td>
                    <td><input type="text" name="password" id="password" autocomplete="off" required></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"><input class="exit" type="submit" value="Добави"></td>
                </tr>
            </tfoot>
        </table>
        <?php
            if(isset($_SESSION['Add_Success'])){
                echo "<script>window.onload = function(){alert('Успешно добавяне')}</script>";
                unset($_SESSION['Add_Success']);
            }
        ?>
    </form>
</body>
<script src="../../JavaScript/AdminPanel/Add_Edit.js"></script>
</html>