<?php
session_start();
include_once("../../../PHP/Database.php");
include_once("../../../PHP/Pictures.php");

if($_GET && $_SESSION["Admin"]){
    $db = new Database();
    $id = $_GET["Id"];

    $sql = "SELECT * FROM cakeshop_db.order_has_product WHERE Product_Id = ?;";
    $data = $db->select($sql,array($id));

    if(empty($data)){
        $sql = "DELETE FROM `cakeshop_db`.`basket` WHERE `Product_Id` = ?;";
        $db->query($sql,array($id));

        deletePicture($id,"../../../Pictures/Products/");

        $sql = "DELETE FROM `cakeshop_db`.`product` WHERE `Id` = ?;";
        $db->query($sql,array($id));    
    }else{
        echo "<script>alert('Продуктът не може да бъде изтрит!')</script>";
    }

    $db = null;
}
?>