<?php
session_start();
include_once("../../../PHP/Database.php");

if($_GET && $_SESSION["Admin"]){
    $db = new Database();
    $id = $_GET["Id"];

    $sql = "DELETE FROM `order_has_product` WHERE `Order_Id` = ?;";
    $db->query($sql,array($id));

    $sql = "DELETE FROM `order` WHERE `Id` = ?;";
    $db->query($sql,array($id));

    $db = null;
}
?>