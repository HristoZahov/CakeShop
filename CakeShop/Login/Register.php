<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <?php 
        require_once("../PHP/Paths.php");
        $paths = new Paths();
        $paths->back("../", true);
        require_once "../Tools/Links.html"; 
    ?>
    <link rel="stylesheet" href="../CSS/Register_Login.css?<?php echo time();?>">
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
</head>
<body>
    <?php require_once("../Tools/header.php");?>
    <div class="register d-flex justify-content-center">
        <form class="text-center" action="RegisterCheck.php" method="post">
            <!-- Header -->
            <h2>Регистрация</h2>
            <?php
            // Ако има грешки да се покажат
            if(isset($_SESSION["register_errors"])){
                //Вземане на грешките
                $errors = $_SESSION["register_errors"];

                // Принтиране
                ?>
                <div class="error"><?php
                foreach ($errors as $key => $value) {?>
                    <p><?php echo $value;?></p><?php
                }
                ?>
                </div><?php
                // Изчистване на грешките
                unset($_SESSION["register_errors"]);
            }
            ?>
            <!-- First Name -->
            <input type="text" name="first_name" placeholder="Име" autocomplete="off" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][0];} ?>"><br> <!-- class="border-3 rounded-pill ps-3 w-100 mb-1" -->
            <!-- Last Name -->
            <input type="text" name="last_name" placeholder="Фамилия" autocomplete="off" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][1];} ?>"><br>
            <!-- Email -->
            <input type="email" name="email" placeholder="Имейл" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][2];} ?>"><br>
            <input type="tel" name="phone" placeholder="Телефон" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][3];} ?>" pattern="^0[\d]{9}$"><br>
            <?php
                unset($_SESSION['data']);
            ?>
            <!-- Password -->
            <div class="position-relative">
                <input type="password" name="password" id="reg_password" placeholder="Парола">
                <i id="reg_togglePassword" class="fa-solid fa-eye-slash eye-position"></i>
            </div>
            <!-- Password Requirements -->
            <div id="requirements">
                <p id="lenght"><i class="fa-solid fa-x"></i> Поне 8 символа</p>
                <p id="upperCase"><i class="fa-solid fa-x"></i> Поне 1 главна буква</p>
                <p id="lowerCase"><i class="fa-solid fa-x"></i> Поне 1 малка буква</p>
                <p id="number"><i class="fa-solid fa-x"></i> Поне 1 цифра</p>
            </div>
            <!-- Repeat Password -->
            <input type="password" name="psw-repeat" placeholder="Потвърди парола"><br>
            <!-- Buttons -->
            <input type="submit" value="Регистрирай">
            <input type="button" onclick="window.location.href='Login.php'" value="Вече съм регистриран">
        </form>
    </div>
    <script type="text/javascript" src="../JavaScript/Login/Register.js?<?php echo time();?>"></script>
    <script src="../JavaScript/Login/Login.js?<?php echo time();?>"></script>
    <script>
        togglePassword("reg_togglePassword","reg_password")
    </script>
</body>
</html>