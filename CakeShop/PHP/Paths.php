<?php
class Paths{
    private $path;
    // Пътища към CSS файловете
    private $css;
    // Пътища към Bootstrap файловете
    private $links;
    // Пътища към PHP файловете
    private $product_utilities;
    private $database;
    private $user;
    private $universal;
    private $product;
    // Пътища към JavaScript файловете
    private $headJs;
    private $loginJs;
    private $main_page;
    // Пътища за менюто
    private $login;
    private $picture;
    // Пътища за количката
    private $basket_utilities;
    private $basketJs;
    private $update;

    function __construct(){
        $this->css = "CSS/Head.css?";
        $this->links = "Tools/Links.html";
        $this->product_utilities = "PHP/Product/Utilities.php";
        $this->database = 'PHP/Database.php';
        $this->user = 'PHP/User/User.php';
        $this->universal = 'PHP/Universal/Universal.php';
        $this->product = 'PHP/Product/Product.php';
        $this->headJs = "JavaScript/Head.js";
        $this->loginJs = "JavaScript/Login/Login.js";    
        $this->main_page = "index.php";   
        $this->path = ""; 
        $this->login = "Login/"; 
        $this->picture = "Pictures/Products/"; 
        $this->basket_utilities = "PHP/Cart/Utilities.php";
        $this->basketJs = "JavaScript/Basket.js";
        $this->update = "PHP/Cart/Update.php?Id=";
    }

    function back($path, $login){
        $this->path = $path;
        $this->css = $path . $this->css;
        $this->links = $path . $this->links;
        $this->product_utilities = $path . $this->product_utilities;
        $this->headJs = $path . $this->headJs;
        $this->loginJs = $path . $this->loginJs;
        $this->database = $path . $this->database;
        $this->user = $path . $this->user;
        $this->universal = $path . $this->universal;
        $this->product = $path . $this->product;
        $this->main_page = $path . $this->main_page;
        $this->picture = $path . $this->picture;
        $this->basket_utilities = $path . $this->basket_utilities;
        $this->basketJs = $path . $this->basketJs;
        $this->update = $path . $this->update;
        if($login == true){
            $this->login = "";
        }else{
            $this->login = $path . $this->login;
        }
    }

    function get_css(){
        return $this->css;
    }
    function get_links(){
        return $this->links;
    }
    function get_product_utilities(){
        return $this->product_utilities;
    }
    function get_headJs(){
        return $this->headJs;
    }
    function get_loginJs(){
        return $this->loginJs;
    }
    function get_database(){
        return $this->database;
    }
    function get_user(){
        return $this->user;
    }
    function get_universal(){
        return $this->universal;
    }
    function get_main_page(){
        return $this->main_page;
    }
    function get_path(){
        return $this->path;
    }
    function get_login_nav(){
        return $this->login;
    }
    function get_picture(){
        return $this->picture;
    }
    function get_basket_utilities(){
        return $this->basket_utilities;
    }
    function get_basketJs(){
        return $this->basketJs;
    }
    function get_update(){
        return $this->update;
    }
    function get_product(){
        return $this->product;
    }
}
?>