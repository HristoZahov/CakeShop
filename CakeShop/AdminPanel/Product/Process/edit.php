<?php
include_once("../../../PHP/Database.php");
include_once("../../../PHP/Pictures.php");
include_once("../../../PHP/Errors.php");
include_once("../../../PHP/Product/Utilities.php");
session_start();

if($_POST && isset($_SESSION['Admin'])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $type = $_POST["category"];
    $pieces = $_POST["pieces"];
    $weight = $_POST["weight"];
    $measurement = $_POST["measurement"];
    $description = $_POST["description"];

    $id = htmlspecialchars($id, ENT_QUOTES );
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
    if(count($error) == 0){
        if(empty($_FILES['file']['name'])){
            editProduct($id,$name,$price,$type, $weight, $measurement,$pieces,$description);
        }else{
            $image = $_FILES['file'];
            $path = "../../../Pictures/Products/";

            deletePicture($id,$path);
            addPicture($image,$path,$id);

            $picture_name = createPictureName($image,$id);
            editProductWithImage($id,$name,$price,$type, $weight, $measurement,$pieces,$description,$picture_name);
        }

        $_SESSION['Edit_Success'] = true;
        header("Location: ../EditProduct.php?Id=".$id); 
    }else{
        header("Location: ../EditProduct.php?Id=".$id);
    }
}else{
    header("Location: ../AdminPanel.php");
}
?>