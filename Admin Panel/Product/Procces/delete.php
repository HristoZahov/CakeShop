<?php
    include_once '../../../PHPUtilities/Pictures.php';
    include_once '../../../PHPUtilities/Product.php';
    
    if($_GET){
        $id = $_GET["id"];

        $id = htmlspecialchars( $id, ENT_QUOTES );

        $path = "../../../Pictures/Products/";
        deletePicture($id,$path);
        deleteProduct($id);
    }
    header("Location: ../ShowProducts.php");
?>