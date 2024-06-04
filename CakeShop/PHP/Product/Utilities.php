<?php
function getAllCategories(){
    $db = new DataBase();

    $sql = "SELECT Id,Name AS Category FROM category;";
    $data = $db->select($sql,array());

    $db = null;

    $category = null;
    $categories = array();

    foreach ($data as $key => $value) {
        $category = new Universal($value['Id'],$value['Category']);
        $categories[] = $category;
    }

    return $categories;
}

function get_all_products(){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Price,
    c.Id AS Category_Id,c.Name AS Category_Name,
    s.Id AS Status_Id,s.Name AS Status_Name,
    p.Pieces,p.Picture,p.Weight,p.Measurement,p.Description
    FROM (cakeshop_db.product p LEFT JOIN cakeshop_db.category c 
    ON p.Category_Id = c.Id) LEFT JOIN cakeshop_db.status s 
    ON p.Status_Id = s.Id
    ORDER BY p.Name;";
    $data = $db->select($sql,array());

    $products = make_object_cake_pr($data);

    return $products;
}

function get_category_products($name){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Price,
    c.Id AS Category_Id,c.Name AS Category_Name,
    s.Id AS Status_Id,s.Name AS Status_Name,
    p.Pieces,p.Picture,p.Weight,p.Measurement,p.Description
    FROM (cakeshop_db.product p LEFT JOIN cakeshop_db.category c 
    ON p.Category_Id = c.Id) LEFT JOIN cakeshop_db.status s 
    ON p.Status_Id = s.Id
    WHERE c.Name = ?
    ORDER BY p.Name;";
    $data = $db->select($sql,array($name));

    $products = make_object_cake_pr($data);

    return $products;
}

function get_searched_products($text){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Price,
    c.Id AS Category_Id,c.Name AS Category_Name,
    s.Id AS Status_Id,s.Name AS Status_Name,
    p.Pieces,p.Picture,p.Weight,p.Measurement,p.Description
    FROM (cakeshop_db.product p LEFT JOIN cakeshop_db.category c 
    ON p.Category_Id = c.Id) LEFT JOIN cakeshop_db.status s 
    ON p.Status_Id = s.Id
    WHERE concat(p.Name,p.Description,c.Name,p.Pieces) LIKE ? and Status_Id = 1;
    ORDER BY p.Name;";
    $data = $db->select($sql,array("%".$text."%"));

    $products = make_object_cake_pr($data);

    return $products;
}

function get_cart_products($id){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Picture,p.Name,p.Price,b.Count
    FROM cakeshop_db.basket b LEFT JOIN cakeshop_db.product p 
    ON b.Product_Id = p.Id
    WHERE User_Id = ?;";
    $data = $db->select($sql,array($id));

    return $data;
}

function get_all_products_admin_panel(){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Price,
    c.Id AS Category_Id,c.Name AS Category_Name,
    s.Id AS Status_Id,s.Name AS Status_Name,
    p.Pieces,p.Picture,p.Weight,p.Measurement,p.Description
    FROM (cakeshop_db.product p LEFT JOIN cakeshop_db.category c 
    ON p.Category_Id = c.Id) LEFT JOIN cakeshop_db.status s 
    ON p.Status_Id = s.Id
    ORDER BY p.Id desc;";
    $data = $db->select($sql,array());

    $products = make_object_cake_pr($data);

    return $products;
}

function get_one_product($id){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Price,
    c.Id AS Category_Id,c.Name AS Category_Name,
    s.Id AS Status_Id,s.Name AS Status_Name,
    p.Pieces,p.Picture,p.Weight,p.Measurement,p.Description
    FROM (cakeshop_db.product p LEFT JOIN cakeshop_db.category c 
    ON p.Category_Id = c.Id) LEFT JOIN cakeshop_db.status s 
    ON p.Status_Id = s.Id
    WHERE p.Id = ?;";
    $data = $db->select($sql,array($id));

    $product = make_object_cake_pr($data)[0];

    return $product;
}

function get_last_product_id(){
    $db = new DataBase();

    $sql = "SELECT Id 
    FROM cakeshop_db.product 
    ORDER BY Id desc 
    limit 1;";
    $data = $db->select($sql,array());

    return $data;
}

function make_object_cake_pr($data){
    $products = array();
    foreach ($data as $key => $value) {
        $category = new Universal($value["Category_Id"],$value["Category_Name"]);
        $status = new Universal($value["Status_Id"],$value["Status_Name"]);
        $product = new Cake($value["Id"],$value["Name"],$value["Price"],$category,$status,$value["Picture"],$value["Pieces"],$value["Weight"],$value["Measurement"],$value["Description"]);
        $products[] = $product;
    }
    return $products;
}

function addProduct($name,$price,$type, $weight, $measurement,$pieces,$description,$image){
    $db = new DataBase();

    $sql = "INSERT INTO `cakeshop_db`.`product` 
    (`Name`, `Price`, `Category_Id`, `Picture`, `Pieces`, `Weight`, `Measurement`, `Description`)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $db->query($sql,array($name,$price,$type,$image,$pieces,$weight,$measurement,$description));

    $db = null;
}

function editProductWithImage($id,$name,$price,$type, $weight, $measurement,$pieces,$description,$image){
    $db = new DataBase();

    $sql = "UPDATE `cakeshop_db`.`product` SET
    `Name` = ?, `Price` = ?, `Category_Id` = ?, `Picture` = ?, `Pieces` = ?, `Weight` = ?, `Measurement` = ?, `Description` = ?
    WHERE Id = ?;";
    $db->query($sql,array($name,$price,$type,$image,$pieces,$weight,$measurement,$description,$id));

    $db = null;
}

function editProduct($id,$name,$price,$type, $weight, $measurement,$pieces,$description){
    $db = new DataBase();

    $sql = "UPDATE `cakeshop_db`.`product` SET
    `Name` = ?, `Price` = ?, `Category_Id` = ?, `Pieces` = ?, `Weight` = ?, `Measurement` = ?, `Description` = ?
    WHERE Id = ?;";
    $db->query($sql,array($name,$price,$type,$pieces,$weight,$measurement,$description,$id));

    $db = null;
}
?>