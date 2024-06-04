<?php
function get_all_users(){
    $db = new Database();

    $sql = "SELECT u.Id,u.Name,u.Surname,u.Email,u.Phone,t.Id AS Type_Id,u.Password,t.Name AS Type 
    FROM cakeshop_db.user AS u 
    LEFT JOIN cakeshop_db.type AS t 
    ON u.Type_Id = t.Id;";

    $data = $db->select($sql,array());

    $db = null;

    $users = array();
    foreach ($data as $key => $value) {
        $type = new Universal($value['Type_Id'],$value['Type']);
        $user = new User($value['Id'],$value['Name'],$value['Surname'],$value['Email'],$value['Phone'],$type);
        $users[] = $user;
    }

    return $users;
}

function get_one_user($id){
    $db = new Database();

    $sql = "SELECT u.Id,u.Name,u.Surname,u.Email,u.Phone,t.Id AS Type_Id,u.Password,t.Name AS Type 
    FROM cakeshop_db.user AS u 
    LEFT JOIN cakeshop_db.type AS t 
    ON u.Type_Id = t.Id
    WHERE u.Id = ?;";

    $data = $db->select($sql,array($id));

    $db = null;

    $type = new Universal($data[0]['Type_Id'],$data[0]['Type']);
    $user = new User($data[0]['Id'],$data[0]['Name'],$data[0]['Surname'],$data[0]['Email'],$data[0]['Phone'],$type);

    return $user;
}
?>