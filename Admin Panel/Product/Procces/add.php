<?php
include_once '../../../PHPUtilities/Connection.php';
include_once '../../../PHPUtilities/Errors.php';
include_once '../../../PHPUtilities/Pictures.php';
include_once '../../../PHPUtilities/Product.php';
session_start();

if($_POST){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $type = $_POST["type"];
    $pieces = $_POST["pieces"];
    $description = $_POST["description"];

    $name = htmlspecialchars( $name, ENT_QUOTES );
    $price = htmlspecialchars($price, ENT_QUOTES);
    $type = htmlspecialchars($type, ENT_QUOTES);
    $pieces = htmlspecialchars($pieces, ENT_QUOTES);
    $description = htmlspecialchars($description, ENT_QUOTES);

    $data = array($name, $price, $type, $pieces, $description);
    $error = editProductError($name, $price, $type, $pieces, $description);

    if(empty($_FILES['file']['name'])){
        $error[] = "Снимката е задължителна";
    }

    if(count($error) == 0){
        $image = $_FILES['file'];
        $path = "../../../Pictures/Products/";
        addPicture($image,$path);
        addProduct($name,$price,$type,$pieces,$description,$image);

        header("Location: ../showProducts.php"); 
    }else{
        $_SESSION['add_data'] = $data;
        $_SESSION['add_error'] = $error;
        header("Location: ../AddProduct.php");
    }
}else{
    header("Location: ../ShowProducts.php");
}
?>