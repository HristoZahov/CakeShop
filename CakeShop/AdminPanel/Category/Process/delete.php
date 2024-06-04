<?php
session_start();
include_once("../../../PHP/Database.php");

if($_GET && $_SESSION["Admin"]){
    $db = new Database();
    $id = $_GET["Id"];

    $sql = "SELECT * FROM cakeshop_db.product WHERE Category_Id = ?;";
    $data = $db->select($sql,array($id));

    if(empty($data)){
        $sql = "DELETE FROM `category` WHERE `Id` = ?;";
        $db->query($sql,array($id));
    }else{
        echo "<script>alert('Категорията не може да бъде изтрита!')</script>";
    }
    $db = null;
}
?>