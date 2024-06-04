<?php
session_start();
include_once '../../PHP/Database.php';
include_once '../../PHP/Universal/Universal.php';
include_once '../../PHP/User/User.php';
include_once '../../PHP/User/Utilities.php';

if($_POST && $_SESSION['User']){
    // Вземане на променливите
    $id = $_POST['id'];
    $first_name = $_POST['name'];
    $last_name = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Проверка за спецялни символи /скриптове/
    $id = htmlspecialchars( $id, ENT_QUOTES );
    $firts_name = htmlspecialchars( $first_name, ENT_QUOTES );
    $last_name = htmlspecialchars($last_name, ENT_QUOTES);
    $email = htmlspecialchars($email, ENT_QUOTES);
    $phone = htmlspecialchars($phone, ENT_QUOTES);

    // Отваряне на връзка с базата данни
    $db = new DataBase();

    // Потребителят се вкарва в базата данни
    $sql = "UPDATE `cakeshop_db`.`user` SET
    `Name` = ?,Surname = ?,Email = ?,Phone = ?
    WHERE Id = ?;";
    // Изпълняване на заявката
    $db->query($sql,array($firts_name, $last_name, $email, $phone, $id));

    $db = null;

    $user = get_one_user($id);
    $_SESSION["User"] = serialize($user);
    $_SESSION['Edit_Success'] = true;
    
    header("location: UserMenu.php");
}else{
    header("location: ../../AdminPanel.php");
}
?>