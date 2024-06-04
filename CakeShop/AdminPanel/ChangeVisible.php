<?php
session_start();
if($_GET && $_SESSION["Admin"]){
    $status = $_GET['change'];
    $_SESSION["Back"] = $status;
}
?>