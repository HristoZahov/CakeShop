<?php
include_once("../PHP/Database.php");
include_once("../PHP/User/User.php");
session_start();

if(isset($_POST) && $_SESSION['User']){
    $user = unserialize($_SESSION['User']);
    $basket = get_basket($user->get_id());
    $date = date("Y-m-d H:i:s");
    $all_price = get_all_price($basket);

    $address = $_POST["address"];
    $description = $_POST["description"];

    $address = htmlspecialchars( $address, ENT_QUOTES );
    $description = htmlspecialchars( $description, ENT_QUOTES );

    if(empty($description)){
        $description = null;
    }

    if(!empty($address)){
        insert_order($user->get_id(),$date,$all_price,$description,$address);
        $order_id = get_order_id();
        insert_products_in_order($order_id,$basket);
        deleteBasketOnOrder($user->get_id());?>
        <script src="../JavaScript/Basket.js"></script>
        <script>
            setCookie(basket_name,JSON.stringify({}),20)
            window.location.href = "Order.php?Id=<?php echo $order_id;?>"
        </script>
        <?php
    }else{
        $_SESSION["order_error"] = true;
        header("location: Basket.php");
    }
}else{
    header("location: ../");
}

function get_all_price($basket){
    $all_price = 0;
    foreach ($basket as $key => $value) {
        $all_price += $value["Count"]*$value["Price"];
    }

    return $all_price;
}

function get_basket($user_Id){
    $db = new DataBase();

    $sql = "SELECT b.Product_Id,b.Count,p.Price 
    FROM cakeshop_db.basket AS b 
    LEFT JOIN cakeshop_db.product AS p
    ON b.Product_Id = p.Id
    WHERE User_Id = ?;";

    $data = $db->select($sql,array($user_Id));
    $db = null;
    return $data;
}

function get_order_id(){
    $db = new DataBase();

    $sql = "SELECT Id FROM cakeshop_db.order order by Id desc limit 1;";
    $data = $db->select($sql,array());

    $db = null;

    $order_id = $data[0]['Id'];
    return $order_id;
}

function insert_order($user_Id,$date,$all_price,$description,$address){
    $db = new DataBase();

    $sql = "INSERT INTO `cakeshop_db`.`order` (`User_Id`, `Date`, `All_Price`, `Description`,`Address`) VALUES (?, ?, ?, ?, ?);";
    $db->query($sql,array($user_Id,$date,$all_price,$description,$address));

    $db = null;
}

function insert_products_in_order($order_id,$basket){
    $db = new DataBase();

    $sql = "INSERT INTO `cakeshop_db`.`order_has_product` (`Order_Id`, `Product_Id`, `Price`, `Count`) VALUES ";
    for ($i=0; $i < count($basket); $i++) { 
        if($i == 0){
            $sql .= "(".$order_id.",".$basket[$i]["Product_Id"].",".$basket[$i]["Price"].",".$basket[$i]["Count"].")"; 
        }else{
            $sql .= ",(".$order_id.",".$basket[$i]["Product_Id"].",".$basket[$i]["Price"].",".$basket[$i]["Count"].")";
        }
    }

    $db->query($sql,array());

    $db = null;
}

function deleteBasketOnOrder($user_Id){
    $db = new DataBase();

    $sql = 'DELETE FROM `cakeshop_db`.`basket` WHERE (`User_Id` = ? );';
    $db->query($sql,array($user_Id));

    $db = null;
}
?>