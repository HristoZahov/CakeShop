<?php
    include_once 'Connection.php';

    function deletePicture($id,$path){
        try{
            $conn = openConnection();

            $sql = "SELECT Picture From product Where Id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$id]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();

            $imgPath = $path.$data[0]['Picture'];
            
            $count = checkImigeExist($data[0]['Picture']);
            if (file_exists($imgPath) && $count == 1) {
                unlink($imgPath);
            }
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }

    function addPicture($image,$path){
        // $picture = $image['name'];
        move_uploaded_file($image['tmp_name'],$path.$image['name']);
    }

    function checkImigeExist($picture){
        try{
            $conn = openConnection();

            $sql = "SELECT count(Id) AS Count FROM cakeshopdb.product Group BY Picture having Picture = ?;";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$picture]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();

            return $data[0]['Count'];
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }
?>