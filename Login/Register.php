<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="../CSS/Register.css?<?php echo time(); ?>">
</head>
<body>
    <div class="conteiner">
        <h1>Регистрация</h1>
        <form action="RegisterCheck.php" method="post">
            <?php
            if(isset($_SESSION["register_errors"])){
                $errors = $_SESSION["register_errors"];
                ?><div class="error"><?php

                foreach ($errors as $key => $value) {
                    ?>
                    <p><?php echo $value;?></p>
                    <?php
                }
                ?></div><?php
                unset($_SESSION["register_errors"]);
            }
            ?>
            <!-- First Name -->
            <input type="text" placeholder="Име" id="first_name" name="first_name" autocomplete="off" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][0];} ?>"><br>

            <!-- Lats Name -->
            <input type="text" placeholder="Фамилия" id="last_name" name="last_name" autocomplete="off" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][1];} ?>"><br>

            <!-- Email -->
            <input type="text" placeholder="E-Mail адрес" id="email" name="email" autocomplete="on" value="<?php if(isset($_SESSION['data'])){echo $_SESSION['data'][2];} ?>"><br>

            <!-- Password -->
            <input type="password" placeholder="Парола" id="password" name="password" autocomplete="off"><br>

            <!-- Repeat Password -->
            <input type="password" placeholder="Потвърди паролата" id="psw-repeat" name="psw-repeat" autocomplete="off"><br>

            <input type="submit" value="Регистрирай">
            <a href="Login.php">Вече съм регистриран</a>
        </form>
            <?php
                unset($_SESSION['data']);
            ?>
    </div>
</body>
</html>