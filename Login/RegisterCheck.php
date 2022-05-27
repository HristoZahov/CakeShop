<?php
session_start();

if($_POST){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $psw_repeat = $_POST['psw-repeat'];

    $firts_name = htmlspecialchars( $first_name, ENT_QUOTES );
    $last_name = htmlspecialchars($last_name, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    $password = htmlspecialchars($password, ENT_QUOTES);
    $psw_repeat = htmlspecialchars($psw_repeat, ENT_QUOTES);

    $register_errors = array();

    if(!$first_name){
        $register_errors[] = "Моля въведете име."; 
    }
    if(!$last_name){
        $register_errors[] = "Моля въведете фамилия."; 
    }

    if(!$email){
        $register_errors[] = "Моля въведете имейл."; 
    }else if ( ! preg_match( "/^[a-zA-Z0-9]+([_\.\-]+|[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+|\-[a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/", $email) ) {
        $register_errors[] = "Имейлът е навалиден.";
    }

    if(!$password){
        $register_errors[] = "Паролата е задължителна."; 
    }else if (strlen($password) < 8) {
        $register_errors[] = "Паролата трябва да е поне 8 символа";
    }else if ( ! preg_match( "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@№$%€§*-]{8,}$/", $password) ) {
        $register_errors[] = "Паролата трябва да има поне една главна и малка буква.";
    }else if($password != $psw_repeat){
        $register_errors[] = "Паролата и потвърждаването й не съвпадат.";
    }

    if(count($register_errors) == 0){
        try {
            $servername = "localhost";
            $database = "computer_shop_db";
            $username = "root";
            $passwordSQL = "";
        
            $PDO = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordSQL);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $PDOStatement = $PDO->prepare("INSERT INTO $database.`user` (`FristName`, `LastName`, `Email`, `Password`) VALUES (?, ?, ?, ?);
            ");
            $PDOStatement->execute([$firts_name, $last_name, $email, $password]);

            header("location: Login.php");
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }else{
        //unset($_SESSION["register_errors"]);
        $_SESSION["register_errors"] = $register_errors;
        header("location: Register.php");
    }
}

?>