<?php
include '../PHP/Errors.php';
include '../PHP/Database.php';
include '../PHP/Universal/Universal.php';
include '../PHP/User/User.php';
include '../PHP/Cart/Utilities.php';

session_start();

if($_POST){
    // Вземане на променливите
    $email = $_POST['email'];
    $password;

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }else{
        $password = $_POST['login_password'];
    }

    // Проверка за спецялни символи /скриптове/
    $email = htmlspecialchars( $email, ENT_QUOTES );
    $password = htmlspecialchars( $password, ENT_QUOTES );

    // Текущите данни се запазват в масив
    $login_data = array($email);
    // Проверки за грешки по полетата
    $login_errors = loginError($email, $password);

    // Ако няма грешки
    if(count($login_errors) == 0){
        // Отваряне на връзка с базата данни
        $db = new DataBase();
    
        // Заявка дали има съществуващата регистрация с този имейл
        $sql = "SELECT u.Id,u.Name,u.Surname,u.Email,u.Phone,t.Id AS Type_Id,u.Password,t.Name AS Type 
        FROM cakeshop_db.user AS u 
        LEFT JOIN cakeshop_db.type AS t 
        ON u.Type_Id = t.Id
        Where u.Email = ?";
        // Изпълняване на заявката
        $data = $db->select($sql,array($email));

        // Затваряне на връзката с базата
        $db = null;
        $user = null; 

        // Ако има такава регистрация и паролата е правилна
        if(!empty($data) && password_verify($password, $data[0]['Password'])){
            // Създаве тип на потребителя
            $type = new Universal($data[0]['Type_Id'],$data[0]['Type']);
            // Създаване на потребител
            $user = new User($data[0]['Id'],$data[0]['Name'],$data[0]['Surname'],$data[0]['Email'],$data[0]['Phone'],$type);
            if($user->get_type_id() == 1){
                // Запазване на потребителя
                $_SESSION['User'] = serialize($user);
                // Зареждане на количката
                fill_cart($user->get_id());
                // Влизане като регистриран в главната страница
                header("location: ../index.php");
            }else{
                // Запазване на админа
                $_SESSION['Admin'] = serialize($user);
                // Влизане като регистриран в главната страница
                header("location: ../AdminPanel/AdminPanel.php");
            }
        }else{
            // Ако има имейла или паролата не съвпадат с базата
            $login_errors[] = "Тези данни не съвпадат с нашите записи.";
            // Връща се имейла и грешката
            $_SESSION['login_data'] = $login_data;
            $_SESSION['login_errors'] = $login_errors;

            // Връщане във Влизането
            header("location: Login.php");
        }
    }else{
        // Ако има грешки се връщат заедно с въведената информация
        $_SESSION['login_data'] = $login_data;
        $_SESSION['login_errors'] = $login_errors;

        // Връщане във Влизането
        header("location: Login.php");
    }
}else{
    header("location: Login.php");
}
?>