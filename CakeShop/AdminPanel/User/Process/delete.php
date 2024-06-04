<?php
session_start();
include_once("../../../PHP/Database.php");

if($_GET && $_SESSION["Admin"]){
    $db = new Database();
    $id = $_GET["Id"];

    $sql = "SELECT * FROM cakeshop_db.order WHERE User_Id = ?;";
    $data = $db->select($sql,array($id));

    if(empty($data)){
        $sql = "DELETE FROM `cakeshop_db`.`basket` WHERE `User_Id` = ?;";
        $db->query($sql,array($id));

        $sql = "DELETE FROM `user` WHERE `Id` = ?;";
        $db->query($sql,array($id));
    }else{
        echo "<script>alert('Потребителят не може да бъде изтрит!')</script>";
    }

    $db = null;
}
?>