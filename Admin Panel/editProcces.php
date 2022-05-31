<?php
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

        $error = array();
        if(empty($name)){
            $error[] = "Името е задължително";
        }

        if(empty($price)){
            $error[] = "Цената е задължителна";
        }else if(!preg_match("/[0-9]+.[0-9]{2,}/", $price)){
            $error[] = "Невалидна цена";
        }

        if(empty($type)){
            $error[] = "Типът е задължителен";
        }

        if(empty($pieces)){
            $error[] = "Парчетата са задължителни";
        }else if(!preg_match("/[0-9]+/", $pieces)){
            $error[] = "Невалидно число";
        }

        if(empty($description)){
            $description = null;
        }
    
        if(count($error) == 0){
            $servername = "localhost";
            $dbusername = "root";
            $database = "cakeshopdb";
            $dbPassword = "";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                if($_FILES['file']){
                    //Delete
                    $sql = "SELECT Picture_Name From product Where Id = ?";

                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$id]);

                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $data = $stmt->fetchAll();

                    $oldimgpath = "../Pictures/Products/".$data[0]['Picture_Name'];
                    unlink( $oldimgpath );

                    //Add
                    $image = $_FILES['file'];
                    $picture = $image['name'];
                    move_uploaded_file($image['tmp_name'],"../Pictures/Products/".$image['name']);
                    $sql = "UPDATE product SET Name = ?, Price = ?, Type = ?, Pieces = ?, Description = ?, Picture_Name = ? WHERE id = ?";

                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$name,$price,$type,$pieces,$description,$picture,$id]);
                }else{
                    $sql = "UPDATE product SET Name = ?, Price = ?, Type = ?, Pieces = ?, Description = ? WHERE id = ?";

                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$name,$price,$type,$pieces,$description,$id]);
                }

                header("Location: showProducts.php");
                die();  
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            } 
        }else{
            $_SESSION['edit_error'] = $error;
            header("Location: editProduct.php?id=$id");
        }
    }else{
        header("Location: editProduct.php?id=$id");
    }
?>