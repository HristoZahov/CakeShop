<?php
session_start();

if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = htmlspecialchars( $email, ENT_QUOTES );
    $password = htmlspecialchars( $password, ENT_QUOTES );

    $login_errors = array();

    if(!$email){
        $login_errors[] = "Моля въведете имейл.";
    }else if ( ! preg_match( "/^[a-zA-Z0-9]+([_\.\-]+|[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+|\-[a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/", $email) ) {
        $register_errors[] = "Имейлът е навалиден.";
    }
    
    if(!$password){
        $login_errors[] = "Моля въведете парола.";
    }

    if(count($login_errors) == 0){
        try {
            $servername = "localhost";
            $database = "computer_shop_db";
            $username = "root";
            $passwordSQL = "";
    
            $PDO = new PDO("mysql:host=$servername;dbname=$database", $username, $passwordSQL);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $PDOStatement = $PDO->prepare("SELECT * FROM $database.user Where Email = ? and Password = ?;");
            $PDOStatement->execute([$email, $password]);
    
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $data = $PDOStatement->fetchAll();
            
            if(!empty($data)){
                header("location: ../Shop.php");
            }else{
                $login_errors = "Тези данни не съвпадат с нашите записи.";
                $_SESSION['login_errors'] = $login_errors;
                header("location: Login.php");
            }
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }else{
        $_SESSION['login_errors'] = $login_errors;
        header("location: Login.php");
    }
}
?>