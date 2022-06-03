<?php
    function editPrductError($name, $price, $type, $pieces, $description){
        $error = array();

        if(empty($name)){
            $error[] = "Името е задължително";
        }

        if(empty($price)){
            $error[] = "Цената е задължителна";
        }else if(!preg_match("/[0-9]+.[0-9]{2,}/", $price)){
            $error[] = "Невалидна цена";
        }

        if(empty($type)){
            $error[] = "Типът е задължителен";
        }

        if(empty($pieces)){
            $error[] = "Парчетата са задължителни";
        }else if(!preg_match("/[0-9]+/", $pieces)){
            $error[] = "Невалидно число";
        }

        if(empty($description)){
            $description = null;
        }

        return $error;
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
        }else if ( ! preg_match( "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9!@№$%€§*-]{8,}$/", $password) ) {
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