<?php
session_start();
include_once '../../../PHP/Database.php';

if($_POST && $_SESSION['Admin']){
    // Вземане на променливите
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Проверка за спецялни символи /скриптове/
    $firts_name = htmlspecialchars( $first_name, ENT_QUOTES );
    $last_name = htmlspecialchars($last_name, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    $phone = htmlspecialchars($phone, ENT_QUOTES);
    $password = htmlspecialchars($password, ENT_QUOTES);

    if(empty($phone)){
        $phone = null;
    }

    // Отваряне на връзка с базата данни
    $db = new DataBase();
    
    // Заявка дали има съществуващата регистрация с този имейл
    $sql = "SELECT * FROM `user` Where Email = ?;";
    // Изпълняване на заявката
    $data = $db->select($sql,array($email));

    // Ако няма вече направена регистрация
    if(empty($data)){
        // Паролата се хешира
        $password = password_hash($password, PASSWORD_DEFAULT);
        // Потребителят се вкарва в базата данни
        $sql = "INSERT INTO `user` (`Name`, `Surname`, `Email`, `Password`, `Phone`) VALUES (?, ?, ?, ?, ?);";
        // Изпълняване на заявката
        $data = $db->select($sql,array($firts_name, $last_name, $email, $password, $phone));

        // Затваряне на връзката с базата
        $db = null;
        $_SESSION['Add_Success'] = true;

        header("location: ../AddUser.php");
    }else{
        // Ако има се връща грешка
        $register_errors[] = "С този имейл вече има направена регистрация.";
        $_SESSION["register_errors"] = $register_errors;
        
        // Затваряне на връзката с базата
        $db = null;
        
        // Връщане в регистрацията
        header("location: ../AddUser.php");
    }
}else{
    header("location: ../../AdminPanel.php");
}
?>