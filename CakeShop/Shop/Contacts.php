<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Contacts.css">
    <link rel="icon" type="image/x-icon" href="../Pictures/Main/Logo.png">
    <title>Контакти</title>
</head>
<body>
<?php
    require_once("../PHP/paths.php");
    $paths = new Paths();
    $paths->back("../",false);
    require_once("../Tools/header.php");
?>

<div class="contacts">
    <h3>Начини да се свържете с нас</h3>
    <p>Телефон: <a href="tel:+359899253333" target="_blank">0899253333</a></p>
    <p class="d-inline">Имейл: </p><a class="email" href="mailto:18527@uktc-bg.com" target="_blank">18527@uktc-bg.com</a>
    <p>Работно време: 8:00 - 20:00 часа</p>
</div>
</body>
</html>