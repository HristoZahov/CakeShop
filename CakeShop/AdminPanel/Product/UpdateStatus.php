<?php
session_start();
include_once("../../PHP/Database.php");

if($_GET && $_SESSION["Admin"]){
    $db = new Database();

    $id = $_GET["Id"];
    $status = $_GET["Status"];

    $sql = "UPDATE `cakeshop_db`.`product` SET `Status_Id` = ? WHERE `Id` = ?;";
    $db->query($sql,array($status,$id));

    if($status == 2){
        $sql = "DELETE FROM `cakeshop_db`.`basket` WHERE `Product_Id` = ?;";
        $db->query($sql,array($id));
    }

    $db = null;
}
?>