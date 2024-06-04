<?php
    require_once("../PHP/DataBase.php");
    require_once("../PHP/User/User.php");
    require_once("../PHP/Cart/Utilities.php");
    require_once("../PHP/Product/Utilities.php");
    session_start();
    $user = unserialize($_SESSION['User']);
    show_basket_in_file($user->get_id());
?>