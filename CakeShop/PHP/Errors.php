<?php
    function editProductError($name, $price, $type){
        $errors = array();

        if(empty($name)){
            $errors[] = "Името е задължително";
        }

        if(empty($price)){
            $errors[] = "Цената е задължителна";
        }else if(!preg_match("/^[0-9]+.[0-9]{2}$/", $price)){
            $errors[] = "Невалидна цена";
        }

        if(empty($type)){
            $errors[] = "Типът е задължителен";
        }

        return $errors;
    }

    function registerError($first_name, $last_name, $email, $phone, $password, $psw_repeat){
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

        if(!$phone){
            $register_errors[] = "Моля въведете телефон."; 
        }else if(! preg_match( "/^0[\d]{9}$/", $phone)){
            $register_errors[] = "Невалиден телефон."; 
        }

        if(!$password){
            $register_errors[] = "Моля въведете парола."; 
        }else if ( ! preg_match( "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@#$%^&*()_+{}:<>?]{8,}$/", $password) ) {
            // if (strlen($password) < 8) {
            //     $register_errors[] = "Паролата трябва да е поне 8 символа";
            // if(!preg_match("/[A-Z]/", $password)){
            //     $register_errors[] = "Паролата трябва да има поне една главна";
            // }
            // if(!preg_match("/[a-z]/", $password)){
            //     $register_errors[] = "Паролата трябва да има поне една малка";
            // }
            // if(!preg_match("/[0-9]/", $password)){
            //     $register_errors[] = "Паролата трябва да има поне еднo число";
            // }
            $register_errors[] = "Невалидна парола.";
        }else if($password != $psw_repeat){
            $register_errors[] = "Паролата и потвърждаването й не съвпадат.";
        }

        return $register_errors;
    }

    function loginError($email, $password){
        $login_errors = array();

        if(!$email){
            $login_errors[] = "Моля въведете имейл.";
        }else if ( ! preg_match( "/^[a-zA-Z0-9]+([_\.\-]+|[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+|\-[a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/", $email) ) {
            $login_errors[] = "Имейлът е навалиден.";
        }
        
        if(!$password){
            $login_errors[] = "Моля въведете парола.";
        }

        return $login_errors;
    }
?>