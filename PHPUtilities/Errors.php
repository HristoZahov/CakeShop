<?php
    function editProductError($name, $price, $type, $weight, $pieces, $description){
        $errors = array();

        if(empty($name)){
            $errors[] = "Името е задължително";
        }

        if(empty($price)){
            $errors[] = "Цената е задължителна";
        }else if(!preg_match("/[0-9]+.[0-9]{2,}/", $price)){
            $errors[] = "Невалидна цена";
        }

        if(empty($type)){
            $errors[] = "Типът е задължителен";
        }

        if(empty($weight)){
            $register_errors[] = "Грамажът е задължителен"; 
        }

        if(empty($pieces)){
            $errors[] = "Парчетата са задължителни";
        }else if(!preg_match("/[0-9]+/", $pieces)){
            $errors[] = "Невалидно число";
        }

        if(empty($description)){
            $errors[] = "Описанието е задължително";
        }

        return $errors;
    }

    function registerError($first_name, $last_name, $email, $password, $psw_repeat){
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
        }else if ( ! preg_match( "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@#$%^&*()_+{}:<>?]{8,}$/", $password) ) {
            $register_errors[] = "Паролата трябва да има поне една главна и малка буква.";
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
            $register_errors[] = "Имейлът е навалиден.";
        }
        
        if(!$password){
            $login_errors[] = "Моля въведете парола.";
        }

        return $login_errors;
    }
?>