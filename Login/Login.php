<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>
  <link rel="stylesheet" href="../CSS/Register.css?<?php echo time(); ?>">
  </head>
<body>
  <div class="conteiner">
    <form action="LoginCheck.php" method="post">
      <h1>Вход</h1>
      <?php
      session_start();

      if(isset($_SESSION['login_errors'])){   
        $errors = $_SESSION["login_errors"];

        ?><div class="error"><?php
        foreach ($errors as $key => $value) {
          ?>
          <p><?php echo $value;?></p>
          <?php
        }
        ?></div><?php
      }
      unset($_SESSION["login_errors"]);
      ?> 
      <input type="text" id="email" name="email" placeholder="E-Mail адрес" value="<?php if(isset($_SESSION['login_data'])){echo $_SESSION['login_data'][0];unset($_SESSION['login_data']);} ?>"><br>

      <input type="password" id="password" name="password" placeholder="Парола"><br>
      <input type="submit" value="Вход">
      <a href="Register.php">Нова регистрация</a>
    </form>
  </div>
</body>
</html>