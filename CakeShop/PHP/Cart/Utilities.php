<?php
function get_products($ids){
    $db = new DataBase();

    $sql = "SELECT p.Id,p.Name,p.Price,
    c.Id AS Category_Id,c.Name AS Category_Name,
    s.Id AS Status_Id,s.Name AS Status_Name,
    p.Pieces,p.Picture,p.Weight,p.Measurement,p.Description
    FROM (cakeshop_db.product p LEFT JOIN cakeshop_db.category c 
    ON p.Category_Id = c.Id) LEFT JOIN cakeshop_db.status s 
    ON p.Status_Id = s.Id
    WHERE p.Id IN(". $ids .");";
    $data = $db->select($sql,array());

    $products = make_object_cake($data);

    return $products;
}

function make_object_cake($data){
    $products = array();
    foreach ($data as $key => $value) {
        $category = new Universal($value["Category_Id"],$value["Category_Name"]);
        $status = new Universal($value["Status_Id"],$value["Status_Name"]);
        $product = new Cake($value["Id"],$value["Name"],$value["Price"],$category,$status,$value["Picture"],$value["Pieces"],$value["Weight"],$value["Measurement"],$value["Description"]);
        $products[] = $product;
    }
    return $products;
}

function prepare_products_to_show($products,$basket){
    $text = "";
    $path = $_SESSION["basket_img_path"];

    $text .= "<div class='basket_products'>";
    $text .=    "<table>";
    foreach ($products as $product) {
        $text .=    "<tr class='basket_product'>";
        $text .=        "<td><img src='" . $path . $product->get_picture() ."' alt='Picture'></td>";
        $text .=        "<td>" . $product->get_name() . "</td>";
        $text .=        "<td>" . $product->get_price() . " лв.</td>";
        $text .=        "<td><select class='count' name='count' id='count_bs' onchange='edit_cart(event,{$product->get_id()})'>";
                            for ($i=1; $i <= 20; $i++){
        $text .=                "<option value=". $i ;
                            if($i == $basket[$product->get_id()]){
        $text .=                 " selected";       
                             }
        $text .=                ">". $i ." бр.</option>";
                            }
        $text .=        "</select></td>";
        $text .=        "<td><button class='btn btn-danger' onclick='delete_item_in_cart(". $product->get_id() .")'><i class='fa-solid fa-trash'></i></button><td>";
        $text .=    "</tr>";
    }
    $text .=    "</table>";
    $text .= "</div>";
    return $text;
}

function get_all_price($products,$basket){
    $price = 0;
    foreach ($products as $product) {
        $price += $product->get_price() * $basket[$product->get_id()];
    }

    $price = number_format($price, 2, '.', '');
    return "<p class='m-0 text-end'>Обща цена: " . $price . " лв.</p>";
}

function show_basket(){
    if(isset($_COOKIE['basket'])){
        $basket = json_decode($_COOKIE['basket'],true);
        if(!empty($basket)){
            $keys = array_keys($basket);
            $ids = implode(",", $keys);
            $path = $_SESSION["path"];

            $products = get_products($ids);
            echo prepare_products_to_show($products,$basket);
            echo get_all_price($products,$basket);
            echo "<form>";
            echo    "<button class='float-end basket-btn' onclick='window.location.href = \"{$path}Shop/Basket.php\";return false'>Поръчай</button>";
            echo    "<button class='float-start basket-btn' onclick='clear_cart();return false'>Изчисти</button>";
            echo "</form>";
        }else{
            echo "<p class='text-center m-0'>Няма продукти</p>";
        }
    }else{
        echo "<p class='text-center m-0'>Няма продукти</p>";
    }
}

function fill_cart($user_id){
    $db = new DataBase();

    $sql = "SELECT Product_Id,Count 
    FROM cakeshop_db.basket
    WHERE User_Id = ?;";
    $data = $db->select($sql,array($user_id));

    $basket = json_decode($_COOKIE['basket'],true);
    $exist = array();

    // Добавяне на предишните продукти
    foreach($data as $product){
        $id = $product['Product_Id'];
        $count = intval($product['Count']);
        
        if(array_key_exists($id, $basket)){
            array_push($exist,$id);
            $basket[$id] += $count;
            if($basket[$id] > 20){
                $basket[$id] = 20;
            }
        }else{
            $basket[$id] = $count;
        }
    }
    
    if(!empty($basket)){
        // Запазване на новата количка в бисквитката
        $cookie_name = "basket";
        $cookie_value = json_encode($basket);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 20), "/"); // 86400 = 1 day


        // Актуализиране на базата данни
        foreach($basket as $product_id => $count){
            if(in_array($product_id, $exist)){
                $sql = "UPDATE `cakeshop_db`.`basket` SET `Count` = ? WHERE (`User_Id` = ?) and (`Product_Id` = ?);";
                $db->query($sql,array($count,$user_id,$product_id));
            }else{
                $sql = "INSERT INTO `cakeshop_db`.`basket` (`User_Id`, `Product_Id`, `Count`) VALUES (?, ?, ?);";
                $db->query($sql,array($user_id,$product_id,$count));
            }
        }
        $db = null;
    }
}

function show_basket_in_file($id){
    $products = get_cart_products($id);
    $n = 1;
    $all_price = 0;

    if(!empty($products)){
        $text = "<div class='basket'>";
        $text .= "<h3>Продукти</h3>";
        $text .= "<div>";
        $text .= "<table class='w-100 b-table'>";
        $text .=     "<thead>";
        $text .=        "<tr>";
        $text .=            "<th>№</th>";
        $text .=            "<th class='text-start'>Продукт</th><th></th>";
        $text .=            "<th>Цена</th>";
        $text .=            "<th>Количество</th>";
        $text .=            "<th>Общо</th>";
        $text .=        "</tr>";
        $text .=     "</thead>";
        $text .=     "<tbody>";
        foreach ($products as $key => $value) {
            $text .= "<tr>";
            $text .=    "<td>{$n}</td>";
            $text .=    "<td><img src='../Pictures/Products/{$value["Picture"]}' alt='picture' height='fit-content'></td><td><a href='OneProduct.php?id={$value["Id"]}'>{$value["Name"]}</a></td>";
            
            $price = $value["Count"]*$value["Price"];
            $all_price += $price;
            $price = number_format($price, 2, '.', '');

            $text .=    "<td>{$price} лв.</td>";
            $text .=    "<td><select onchange='edit_cart(event,{$value["Id"]})'>";
                        for ($i=1; $i <= 20; $i++) { 
            $text .=        "<option value='{$i}'";
                            if($i == $value["Count"]){
            $text .=            "selected";
                            }
            $text .=        ">{$i} бр.</option>";
                        }
            $text .=    "</select></td>";
            $text .=    "<td>{$value["Price"]} лв.</td>";
    
            $text .=    "<td><button class='btn btn-danger' onclick='delete_item_in_basket({$value["Id"]})'><i class='fa-solid fa-trash'></i></button></td>";
            $text .= "</tr>";
            $n++;
        }
        $text .=     "</tbody>";
        $text .=     "<tfoot>";
        $all_price = number_format($all_price, 2, '.', '');
        $text .=        "<tr><td colspan='6' class='text-end'>Обща цена: {$all_price} лв.</td></tr>";
        $text .=    "</tfoot>";
        $text .= "</table>";
        $text .=    "<form action='MakeOrder.php' method='post' id='order'>";
        $text .=        "<table class='w-100 mk_order'>";
        $text .=            "<tr><td class='text-end'><label for='address'>Адрес: <label></td>";
        $text .=            "<td><input class='w-100' type='text' name='address' id='address' required></td></tr>";
        $text .=            "<tr><td class='text-end'><label for='description'>Допълнителна информация: <label></td>";
        $text .=            "<td><textarea name='description' id='description' form='order'></textarea></td></tr>";
        $text .=            "<tr><td class='text-center' colspan='2'><input class='cart' type='submit' value='Поръчай'></td></tr>";
        $text .=        "</table>";
        $text .=    "</form>";
        $text .= "</div>";
        $text .= "</div>";

        echo $text;
    }else{
        echo "<p class='.not_items'>Количката е празна!<p>";
    }
}
?>