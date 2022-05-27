<?php
    if($_GET){
        //$id = $_GET['id'];
        $name = $_GET["name"];
        $price = $_GET["price"];
        $type = $_GET["type"];
        $pieces = $_GET["pieces"];
        $description = $_GET["description"];
        $picture = $_GET["picture"];

        $servername = "localhost";
        $dbusername = "root";
        $database = "cakeshopdb";
        $dbPassword = "";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE product SET Name = ?, Price = ?, Type = ?, Pieces = ?, Description = ?, Picture_Name = ? WHERE id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$name,$price,$type,$pieces,$description,$picture,1]);

            header("Location: showProducts.php");
            die();  
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } 
    
    }else{
        header("Location: editProduct.php");
    }
?>