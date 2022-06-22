<?php
    include_once 'Connection.php';
    include_once 'Type.php';

    function editProductWithPicture($name,$price,$type,$pieces,$weight,$measurement,$description,$image,$id){
        try{
            $conn = openConnection();

            $type = getTypeId($type);
            $sql = "UPDATE product SET Name = ?, Price = ?, Type_Id = ?, Pieces = ?, Weight = ?, Measurement = ?, Description = ?, Picture = ? WHERE id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$name,$price,$type,$pieces,$weight,$measurement,$description,$image['name'],$id]);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }

    function editProductWithOutPicture($name,$price,$type,$pieces,$weight,$measurement,$description,$id){
        try{
            $conn = openConnection();

            $type = getTypeId($type);
            $sql = "UPDATE product SET Name = ?, Price = ?, Type_Id = ?, Pieces = ?, Weight = ?, Measurement = ?, Description = ? WHERE id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$name,$price,$type,$pieces,$weight,$measurement,$description,$id]);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }

    function addProduct($name,$price,$type,$weight,$measurement,$pieces,$description,$image){
        try{
            $conn = openConnection();

            $type = getTypeId($type);
            $sql = "INSERT INTO product (Name, Price, Type_Id, Weight, Measurement, Pieces, Description, Picture) VALUES (?,?,?,?,?,?,?,?);";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$name,$price,$type,$weight,$measurement,$pieces,$description,$image['name']]);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }

    function deleteProduct($id){
        try{
            $conn = openConnection();

            $sql = "DELETE FROM product WHERE Id = ?;";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$id]);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }

    function getAllProducts(){
        $conn = openConnection();

        $PDOStatement = $conn->prepare("SELECT p.Id,p.Name,p.Price,t.Name AS Type,p.Weight,p.Measurement,p.Pieces,p.Description,p.Picture 
        FROM cakeshopdb.product AS p LEFT JOIN cakeshopdb.type AS t
        ON p.Type_Id = t.Id;");
        $PDOStatement->execute();

        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $PDOStatement->fetchAll();

        return $data;
    }

    function getFilterProducts($type){
        $conn = openConnection();

        $PDOStatement = $conn->prepare("SELECT p.Id,p.Name,p.Price,t.Name AS Type,p.Weight,p.Measurement,p.Pieces,p.Description,p.Picture 
        FROM cakeshopdb.product AS p LEFT JOIN cakeshopdb.type AS t
        ON p.Type_Id = t.Id
        Where t.Name = ?;");
        $PDOStatement->execute([$type]);

        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $PDOStatement->fetchAll();

        return $data;
    }

    function getSearchProducts($search){
        $conn = openConnection();

        $PDOStatement = $conn->prepare("SELECT p.Id,p.Name,p.Price,t.Name AS Type,p.Weight,p.Measurement,p.Pieces,p.Description,p.Picture 
        FROM cakeshopdb.product AS p LEFT JOIN cakeshopdb.type AS t
        ON p.Type_Id = t.Id
        Where p.Name like ? OR p.Description = ?;");
        $PDOStatement->execute(["%".$search."%","%".$search."%"]);

        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $PDOStatement->fetchAll();

        return $data;
    }

    function getOneProduct($id){
        $conn = openConnection();
      
        $stmt = $conn->prepare("SELECT p.Id,p.Name,p.Price,t.Name AS Type,p.Weight,p.Measurement,p.Pieces,p.Description,p.Picture 
        FROM cakeshopdb.product AS p LEFT JOIN cakeshopdb.type AS t
        ON p.Type_Id = t.Id 
        WHERE p.Id = ?;");
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();

        return $data[0];
    }
?>