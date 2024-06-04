<?php
function get_one_category($id){
    $db = new DataBase();

    $sql = "SELECT * 
    FROM cakeshop_db.category
    WHERE Id = ?;";
    $data = $db->select($sql,array($id));
    
    $db = null;
    $category = new Universal($data[0]["Id"],$data[0]["Name"]);

    return $category;
}

function get_all_types(){
    $db = new DataBase();

    $sql = "SELECT * FROM cakeshop_db.type;";
    $data = $db->select($sql,array());
    
    $db = null;
    $types = array();
    foreach ($data as $key => $value) {
        $type = new Universal($value['Id'],$value['Name']);
        $types[] = $type;
    }

    return $types;
}
?>