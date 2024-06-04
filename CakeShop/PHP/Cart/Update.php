<?php
    include_once("../Database.php");
    include_once("../Universal/Universal.php");
    include_once("../Product/Product.php");
    include_once("../User/User.php");
    include_once("Utilities.php");
    session_start();

    if(isset($_SESSION['User'])){
        $db = new DataBase();
        $basket = json_decode($_COOKIE['basket'],true);

        $method = $_GET['Method'];
        $product_id = $_GET['Id'];
        $user_id = unserialize($_SESSION['User'])->get_id();

        switch ($method) {
            case "add":
                $sql = "INSERT INTO `cakeshop_db`.`basket` (`User_Id`, `Product_Id`, `Count`) VALUES (?, ?, ?);";
                $db->query($sql,array($user_id,$product_id,$basket[$product_id]));
                
                $db = null;
                break;
            case "delete":
                $sql = "DELETE FROM `cakeshop_db`.`basket` WHERE (`User_Id` = ?) and (`Product_Id` = ?);";
                $db->query($sql,array($user_id,$product_id));
                
                $db = null;
                break;
            case "update":
                $sql = "UPDATE `cakeshop_db`.`basket` SET `Count` = ? WHERE (`User_Id` = ?) and (`Product_Id` = ?);";
                $db->query($sql,array($basket[$product_id],$user_id,$product_id));
                
                $db = null;
                break;
            case "clear":
                $sql = "DELETE FROM `cakeshop_db`.`basket` WHERE `User_Id` = ?;";
                $db->query($sql,array($user_id));
                
                $db = null;
                break;
        }
    }
    
    show_basket();
?>