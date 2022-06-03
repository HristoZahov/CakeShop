<?php
    include_once 'Connection.php';

    function editProductWithPicture($name,$price,$type,$pieces,$description,$image,$id){
        try{
            $conn = openConnection();

            $sql = "UPDATE product SET Name = ?, Price = ?, Type = ?, Pieces = ?, Description = ?, Picture_Name = ? WHERE id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$name,$price,$type,$pieces,$description,$image['name'],$id]);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn->close();
        }
    }

    function editProductWithOutPicture($name,$price,$type,$pieces,$description,$id){
        try{
            $conn = openConnection();

            $sql = "UPDATE product SET Name = ?, Price = ?, Type = ?, Pieces = ?, Description = ? WHERE id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$name,$price,$type,$pieces,$description,$id]);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn->close();
        }
    }
?>