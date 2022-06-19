<?php
    function openConnection(){
        $servername = "localhost:3310";
        $dbusername = "root";
        $database = "cakeshopdb";
        $dbPassword = "";

        try{
            $conn = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } 
        
        return $conn;
    }
    
?>