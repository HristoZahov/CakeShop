<?php
class DataBase{
    private $conn;
    function open(){
        $servername = "localhost:3310";
        $dbusername = "root";
        $database = "cakeshop_db";
        $dbPassword = "";
        try{
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $dbusername, $dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } 
    }
    
    function close(){
        $this->conn = null;
    }

    function query($sql, $array){
        try{
            $this->open();

            $stmt= $this->conn->prepare($sql);
            $stmt->execute($array);
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $this->close();
        }
    }
    
    function select($sql, $array){
        $data = "";
        try{
            $this->open();

            $stmt= $this->conn->prepare($sql);
            $stmt->execute($array);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $this->close();
        }

        return $data;
    }
}
?>