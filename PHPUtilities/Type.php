<?php
    include_once 'Connection.php';

    function getAllTypes(){
        $conn = openConnection();

        $PDOStatement = $conn->prepare("SELECT Id,Name AS Type FROM cakeshopdb.type;");
        $PDOStatement->execute();

        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $PDOStatement->fetchAll();

        $conn = null;
        return $data;
    }

    function getTypeId($type){
        $conn = openConnection();

        $PDOStatement = $conn->prepare("SELECT Id FROM cakeshopdb.type Where Name = ?;");
        $PDOStatement->execute([$type]);

        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $data = $PDOStatement->fetchAll();

        $conn = null;
        return $data[0]['Id'];
    }
?>