<?php
    if($_GET){
        $id = $_GET["id"];

        $id = htmlspecialchars( $id, ENT_QUOTES );

        $servername = "localhost";
        $dbusername = "root";
        $database = "cakeshopdb";
        $dbPassword = "";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM product WHERE id = ?";
            $stmt= $conn->prepare($sql);

            $stmt->execute([$id]);

            header("Location: showProducts.php");
            die();  
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } 
    }else{
        header("Location: showProducts.php");
    }
?>