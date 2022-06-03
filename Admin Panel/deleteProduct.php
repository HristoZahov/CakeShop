<?php
    include '../PHPUtilities/*';
    if($_GET){
        $id = $_GET["id"];

        $id = htmlspecialchars( $id, ENT_QUOTES );

        deletePicture($id);
        $image = $_FILES['file'];
        addPicture($image);
    }else{
        header("Location: showProducts.php");
    }
?>