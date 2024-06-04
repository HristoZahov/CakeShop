<?php
session_start();
include_once '../../PHP/Database.php';

if($_POST && $_SESSION['User']){
    // Вземане на променливите
    $id = $_POST['id'];
    $password = $_POST['password_e'];
    $psw_repeat = $_POST['password_rp_e'];

    // Проверка за спецялни символи /скриптове/
    $id = htmlspecialchars( $id, ENT_QUOTES );
    $password = htmlspecialchars($password, ENT_QUOTES);
    $psw_repeat = htmlspecialchars($psw_repeat, ENT_QUOTES);

    // Отваряне на връзка с базата данни
    $db = new DataBase();

    if($psw_repeat == $password){
        if(preg_match( "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@#$%^&*()_+{}:<>?]{8,}$/", $password)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Потребителят се вкарва в базата данни
            $sql = "UPDATE `cakeshop_db`.`user` SET
            Password = ?
            WHERE Id = ?;";
            // Изпълняване на заявката
            $data = $db->select($sql,array($password, $id));
            $_SESSION['Edit_Success'] = true;
        }else{
            $_SESSION['Edit_Error'] = "Невалидна парола.";
        }
    }else{
        $_SESSION['Edit_Error'] = "Паролите не съвпадат!";
    }

    $db = null;

    header("location: UserMenu.php");
}else{
    header("location: ../../AdminPanel.php");
}
?>