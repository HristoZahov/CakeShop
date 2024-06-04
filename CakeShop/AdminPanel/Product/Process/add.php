<?php
include_once("../../../PHP/Database.php");
include_once("../../../PHP/Pictures.php");
include_once("../../../PHP/Errors.php");
include_once("../../../PHP/Product/Utilities.php");
session_start();

if($_POST && isset($_SESSION['Admin'])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $type = $_POST["category"];
    $pieces = $_POST["pieces"];
    $weight = $_POST["weight"];
    $measurement = $_POST["measurement"];
    $description = $_POST["description"];

    $name = htmlspecialchars($name, ENT_QUOTES );
    $price = htmlspecialchars($price, ENT_QUOTES);
    $type = htmlspecialchars($type, ENT_QUOTES);
    $pieces = htmlspecialchars($pieces, ENT_QUOTES);
    $weight = htmlspecialchars($weight, ENT_QUOTES);
    $measurement = htmlspecialchars($measurement, ENT_QUOTES);
    $description = htmlspecialchars($description, ENT_QUOTES);

    $error = editProductError($name, $price, $type);

    if(empty($pieces)){
        $pieces = null;
    }

    if(empty($weight)){
        $weight = null;
        $measurement = null;
    }

    if(empty($description)){
        $description = null;
    }

    if(empty($_FILES['file']['name'])){
        $error[] = "Снимката е задължителна";
    }

    if(count($error) == 0){
        $image = $_FILES['file'];
        $path = "../../../Pictures/Products/";
        addProduct($name,$price,$type,$weight,$measurement,$pieces,$description,$image['name']);

        $id = get_last_product_id()[0]["Id"];
        addPicture($image,$path,$id);

        $picture_name = createPictureName($image,$id);
        editProductWithImage($id,$name,$price,$type,$weight,$measurement,$pieces,$description,$picture_name);

        $_SESSION['Add_Success'] = true;
        header("Location: ../AddProduct.php");
    }else{
        header("Location: ../AddProduct.php");
    }
}else{
   header("Location: ../../AdminPanel.php");
}
?>