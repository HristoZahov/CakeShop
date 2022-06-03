<?php
    include '../PHPUtilities/Connection.php';
    include '../PHPUtilities/Errors.php';
    include '../PHPUtilities/Pictures.php';
    include '../PHPUtilities/Utilities.php';
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

            if(!empty($_FILES['file']['name'])){
                deletePicture($id);
                $image = $_FILES['file'];

                addPicture($image);
                editProductWithPicture($name,$price,$type,$pieces,$description,$image,$id);
            }else{
                editProductWithOutPicture($name,$price,$type,$pieces,$description,$id);
            }

            $conn = null;

            header("Location: showProducts.php"); 
        }else{
            $_SESSION['edit_error'] = $error;
            header("Location: editProduct.php?id=$id");
        }
    }else{
        header("Location: showProducts.php");
    }
?>