<?php
    include_once 'Connection.php';

    function deletePicture($id){
        try{
            $conn = openConnection();

            $sql = "SELECT Picture_Name From product Where Id = ?";

            $stmt= $conn->prepare($sql);
            $stmt->execute([$id]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();

            $oldimgpath = "../Pictures/Products/".$data[0]['Picture_Name'];
            unlink( $oldimgpath );
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn->close();
        }
    }

    function addPicture($image){
        $picture = $image['name'];
        move_uploaded_file($image['tmp_name'],"../Pictures/Products/".$image['name']);
    }
?>