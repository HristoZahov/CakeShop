<?php
function get_all_orders(){
    $db = new DataBase();

    $sql = "SELECT o.Id,u.Name,u.Surname,o.Date,o.All_Price,s.Id AS Status_Id,s.Name AS Status_Name,o.Description,o.Address
    FROM (cakeshop_db.order o LEFT JOIN cakeshop_db.user u
    ON o.User_Id = u.Id)LEFT JOIN cakeshop_db.status s
    ON o.Status_Id = s.Id;";
    $data = $db->select($sql,array());

    $db = null;
    return $data;
}
function get_user_orders($id){
    $db = new DataBase();

    $sql = "SELECT o.Id,u.Name,u.Surname,o.Date,o.All_Price,s.Id AS Status_Id,s.Name AS Status_Name,o.Description,o.Address
    FROM (cakeshop_db.order o LEFT JOIN cakeshop_db.user u
    ON o.User_Id = u.Id)LEFT JOIN cakeshop_db.status s
    ON o.Status_Id = s.Id
    WHERE u.Id = ?
    Order By o.Id desc;";
    $data = $db->select($sql,array($id));

    $db = null;
    return $data;
}

function get_searched_orders($id){
    $db = new DataBase();

    $sql = "SELECT o.Id,u.Name,u.Surname,o.Date,o.All_Price,s.Id AS Status_Id,s.Name AS Status_Name,o.Description,o.Address
    FROM (cakeshop_db.order o LEFT JOIN cakeshop_db.user u
    ON o.User_Id = u.Id)LEFT JOIN cakeshop_db.status s
    ON o.Status_Id = s.Id
    WHERE s.Id = ?;";
    $data = $db->select($sql,array($id));

    $db = null;
    return $data;
}

function get_orders_statuses(){
    $db = new DataBase();

    $sql = "SELECT * FROM cakeshop_db.status WHERE Id > 2;";
    $data = $db->select($sql,array());

    $db = null;
    $statuses = array();
    foreach ($data as $key => $value) {
        $status = new Universal($value["Id"],$value["Name"]);
        $statuses[] = $status;
    }

    return $statuses;
}

function get_order($id){
    $db = new DataBase();

    $sql = "SELECT o.Id,u.Name,u.Surname,u.Email,u.Phone,o.Address,o.Date,o.All_Price,o.Description,s.Name AS Status_Name
    FROM (cakeshop_db.order o LEFT JOIN cakeshop_db.status s
    ON o.Status_Id = s.Id)LEFT JOIN cakeshop_db.user u
    ON o.User_Id = u.Id
    WHERE o.Id = ?;";
    $data = $db->select($sql,array($id));

    $db = null;
    return $data;
}


function get_products_for_order($id){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Picture,h.Count,h.Price
    FROM cakeshop_db.order_has_product h LEFT JOIN cakeshop_db.product p
    ON h.Product_Id = p.Id
    WHERE h.Order_Id = ?;";
    $data = $db->select($sql,array($id));

    $db = null;
    return $data;
}
?>