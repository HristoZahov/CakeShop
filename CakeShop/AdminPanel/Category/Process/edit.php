<?php
include_once("../../../PHP/Database.php");
session_start();

if($_POST && isset($_SESSION['Admin'])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $name = htmlspecialchars($name, ENT_QUOTES );

    $db = new DataBase();

    $sql = "UPDATE `cakeshop_db`.`category` SET
    `Name` = ?
    WHERE Id = ?;";
    $db->query($sql,array($name,$id));

    $_SESSION['Edit_Success'] = true;
    $db = null;
}

header("Location: ../../AdminPanel.php");
?>