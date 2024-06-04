<?php
session_start();
include_once("../../PHP/Database.php");

if($_GET && $_SESSION["Admin"]){
    $db = new Database();

    $id = $_GET["Id"];
    $type = $_GET["Type"];

    $sql = "UPDATE `cakeshop_db`.`user` SET `Type_Id` = ? WHERE `Id` = ?;";
    $db->query($sql,array($type,$id));

    $db = null;
}
?>