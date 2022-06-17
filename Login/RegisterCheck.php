<?php
session_start();
include '../PHPUtilities/Errors.php';
include '../PHPUtilities/Connection.php';

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

    $register_data = array($first_name, $last_name, $email);
    $register_errors = registerError($first_name, $last_name, $email, $password, $psw_repeat);

    if(count($register_errors) == 0){
        try {
            $conn = openConnection();

            $PDOStatement = $conn->prepare("SELECT * FROM `user` Where Email = ?;");
            $PDOStatement->execute([$email]);

            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $data = $PDOStatement->fetchAll();

            if(empty($data)){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $PDOStatement = $conn->prepare("INSERT INTO `user` (`FristName`, `LastName`, `Email`, `Password`) VALUES (?, ?, ?, ?);");
                $PDOStatement->execute([$firts_name, $last_name, $email, $password]);

                header("location: Login.php");
            }else{
                $register_errors[] = "С този имейл вече има направена регистрация.";
                $_SESSION["register_errors"] = $register_errors;
                
                header("location: Register.php");
            }
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }finally{
            $conn = null;
        }
    }else{
        $_SESSION['data'] = $register_data;
        $_SESSION["register_errors"] = $register_errors;
        header("location: Register.php");
    }
}
?>