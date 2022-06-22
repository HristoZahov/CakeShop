<?php
include '../PHPUtilities/Errors.php';
include '../PHPUtilities/Connection.php';

session_start();

if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = htmlspecialchars( $email, ENT_QUOTES );
    $password = htmlspecialchars( $password, ENT_QUOTES );

    $login_data = array($email);
    $login_errors = loginError($email, $password);

    if(count($login_errors) == 0){
        try {
            $conn = openConnection();
    
            $PDOStatement = $conn->prepare("SELECT * FROM user Where Email = ?");
            $PDOStatement->execute([$email]);
    
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $data = $PDOStatement->fetchAll();

            if(!empty($data) && password_verify($password, $data[0]['Password'])){
                $_SESSION['user'] = $data;
                header("location: ../ShopPage/Shop.php");
            }else{
                $login_errors[] = "Тези данни не съвпадат с нашите записи.";
                $_SESSION['login_data'] = $login_data;
                $_SESSION['login_errors'] = $login_errors;
                header("location: Login.php");
            }
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }else{
        $_SESSION['login_data'] = $login_data;
        $_SESSION['login_errors'] = $login_errors;
        header("location: Login.php");
    }
}
?>