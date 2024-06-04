<?php
session_start();
include_once '../../../PHP/Database.php';

if($_POST && $_SESSION['Admin']){
    // Вземане на променливите
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $psw_repeat = $_POST['psw-repeat'];

    // Проверка за спецялни символи /скриптове/
    $id = htmlspecialchars( $id, ENT_QUOTES );
    $firts_name = htmlspecialchars( $first_name, ENT_QUOTES );
    $last_name = htmlspecialchars($last_name, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    $phone = htmlspecialchars($phone, ENT_QUOTES);
    $password = htmlspecialchars($password, ENT_QUOTES);
    $psw_repeat = htmlspecialchars($psw_repeat, ENT_QUOTES);

    if(empty($phone)){
        $phone = null;
    }

    // Отваряне на връзка с базата данни
    $db = new DataBase();

    if(!empty($password)){
        if($psw_repeat == $password){
            if(preg_match( "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@#$%^&*()_+{}:<>?]{8,}$/", $password)){
                $password = password_hash($password, PASSWORD_DEFAULT);
                // Потребителят се вкарва в базата данни
                $sql = "UPDATE `cakeshop_db`.`user` SET
                `Name` = ?,Surname = ?,Email = ?,Password = ?,Phone = ?
                WHERE Id = ?;";
                // Изпълняване на заявката
                $data = $db->select($sql,array($firts_name, $last_name, $email, $password, $phone, $id));
                $_SESSION['Edit_Success'] = true;
            }else{
                $_SESSION['Edit_Error'] = "Невалидна парола.";
            }
        }else{
            $_SESSION['Edit_Error'] = "Паролите не съвпадат!";
        }
    }else{
        // Потребителят се вкарва в базата данни
        $sql = "UPDATE `cakeshop_db`.`user` SET
        `Name` = ?,Surname = ?,Email = ?,Phone = ?
        WHERE Id = ?;";
        // Изпълняване на заявката
        $data = $db->select($sql,array($firts_name, $last_name, $email, $phone, $id));
        $_SESSION['Edit_Success'] = true;
    }   

    $db = null;

    header("location: ../EditUser.php?Id=".$id);
}else{
    header("location: ../../AdminPanel.php");
}
?>