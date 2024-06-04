<?php
    function deletePicture($id,$path){
        try{
            $db = new DataBase();

            $sql = "SELECT Picture From product Where Id = ?";
            $data = $db->select($sql,array($id));

            $imgPath = $path.$data[0]['Picture'];
            
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $db = null;
        }
    }

    function addPicture($picture,$path,$id){
        $picture_name = createPictureName($picture,$id);
        move_uploaded_file($picture['tmp_name'],$path.$picture_name);
    }

    function createPictureName($picture,$id){
        $extension = explode(".",$picture["name"]);
        $extension = $extension[count($extension)-1];
        return "Product ".$id.".".$extension;
    }
?>