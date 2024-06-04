<?php
class User{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $type;
    function __construct($id,$name,$surname,$email,$phone,$type){
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->type = $type;
    }
    
    function get_id(){
       return $this->id;
    }
    
    function get_name(){
        return $this->name;
    }

    function get_surname(){
        return $this->surname;
    }
     
    function get_email(){
        return $this->email;
    }

    function get_phone(){
    return $this->phone;
    }
    
    function get_type_id(){
        return $this->type->get_id();
    }

    function get_type(){
        return $this->type->get_name();
    }

    function __toString(){
        return "Id: ". $this->id."<br>Name: ". $this->name.
        "<br>Surname: ". $this->surname."<br>Email: ".$this->email.
        "<br>Phone: ". $this->phone."<br>Type: ".$this->get_name();
    }
}
?>