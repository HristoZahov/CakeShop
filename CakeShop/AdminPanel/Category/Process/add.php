<?php
include_once("../../../PHP/Database.php");
session_start();

if($_POST && isset($_SESSION['Admin'])){
    if(!empty($_POST["category"])){
        $category = $_POST["category"];
        $category = htmlspecialchars($category, ENT_QUOTES );

        $db = new Database();

        $sql = "INSERT INTO `category` (Name) VALUES (?);";
        $db->query($sql,array($category));

        $db = null;
        $_SESSION['Add_Success'] = true;
    }
    $_SESSION['Back'] = "categories";
}

header("Location: ../../AdminPanel.php");
?>