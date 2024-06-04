<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Влизане</title>
    <?php 
        require_once "../Tools/Links.html"; 
    ?>
    <link rel="stylesheet" href="../CSS/Register_Login.css?<?php echo time();?>">
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
</head>
<body>
    <?php 
    require_once("../PHP/Paths.php");
    $paths = new Paths();
    $paths->back("../", true);
    // Вземане на навигационното меню
    require_once("../Tools/header.php");
    ?>
    <div class="register d-flex justify-content-center">
        <form class="text-center" action="LoginCheck.php" method="post">
            <!-- Header -->
            <h2>Вход</h2>
            <?php
            // Ако има грешки да се покажат
            if(isset($_SESSION['login_errors'])){   
                //Вземане на грешките
                $errors = $_SESSION["login_errors"];
    
                // Принтиране
                ?><div class="error"><?php
                foreach ($errors as $key => $value) {
                    ?>
                    <p><?php echo $value;?></p>
                    <?php
                }
                ?></div><?php
                // Изчистване на грешките
                unset($_SESSION["login_errors"]);
            }
            ?>
            <!-- Email -->
            <input type="email" name="email" placeholder="E-Mail адрес" value="<?php
                // Ако има грешки да се покажат предишните въведени данни
                if(isset($_SESSION['login_data'])){
                    echo $_SESSION['login_data'][0];
                    unset($_SESSION['login_data']);
                    } 
            ?>"><br>
            <!-- Password -->
            <div class="position-relative">
                <input type="password" name="password" id="login_password" placeholder="Парола">
                <i id="login_togglePassword" class="fa-solid fa-eye-slash eye-position"></i>
            </div>
            <!-- Buttons -->
            <input type="submit" value="Вход">
            <input type="button" onclick="window.location.href='Register.php'" value="Нова регистрация">
        </form>
    </div>
    <script src="../JavaScript/Login/Login.js?<?php echo time();?>"></script>
    <script>
        // Сменяне на окото при паролата
        togglePassword("login_togglePassword","login_password")
    </script>
</body>
</html>