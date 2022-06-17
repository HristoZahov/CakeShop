<?php
    include_once '../../../PHPUtilities/Connection.php';
    include_once '../../../PHPUtilities/Errors.php';
    include_once '../../../PHPUtilities/Pictures.php';
    include_once '../../../PHPUtilities/Product.php';
    session_start();

    if($_POST){
        $id = $_SESSION['id'];
        unset($_SESSION['id']);

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

        $error = editProductError($name, $price, $type, $pieces, $description);

        if(count($error) == 0){
            $conn = openConnection();
            $path = "../../../Pictures/Products/";

            if(!empty($_FILES['file']['name'])){
                deletePicture($id,$path);
                $image = $_FILES['file'];

                addPicture($image,$path);
                editProductWithPicture($name,$price,$type,$pieces,$description,$image,$id);
            }else{
                editProductWithOutPicture($name,$price,$type,$pieces,$description,$id);
            }

            $conn = null;

            header("Location: ../ShowProducts.php"); 
        }else{
            $_SESSION['edit_error'] = $error;
            header("Location: ../EditProduct.php?id=$id");
        }
    }else{
        header("Location: ../ShowProducts.php");
    }
?>