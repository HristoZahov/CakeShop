<?php
class Cake{
    private $id;
    private $name;
    private $price;
    private $category;
    private $status;
    private $picture;
    private $pieces;
    private $weight;
    private $measurement;
    private $description;

    function __construct($id,$name,$price,$category,$status,$picture,$pieces,$weight,$measurement,$description){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->status = $status;
        $this->picture = $picture;
        $this->pieces = $pieces;
        $this->weight = $weight;
        $this->measurement = $measurement;  
        $this->description = $description;      
    }

    function get_id(){
        return $this->id;
    }
    function get_name(){
        return $this->name;
    }
    function get_price(){
        return $this->price;
    }
    function get_category(){
        return $this->category->get_name();
    }
    function get_status(){
        return $this->status->get_name();
    }
    function get_status_id(){
        return $this->status->get_id();
    }
    function get_picture(){
        return $this->picture;
    }
    function get_weight(){
        return $this->weight;
    }
    function get_pieces(){
        return $this->pieces;
    }
    function get_measurement(){
        return $this->measurement;
    }
    function get_description(){
        return $this->description;
    }

    function __toString(){
        return "Id: ".$this->id.
        "<br>Name: ".$this->name.
        "<br>Price: ".$this->price.
        "<br>Category: ".$this->get_category().
        "<br>Status: ".$this->get_status().
        "<br>Picture: ".$this->picture.
        "<br>Weight: ".$this->weight.
        "<br>Pieces: ".$this->pieces.
        "<br>Measurement: ".$this->measurement.
        "<br>Description: ".$this->description."<br>";
    }
}
?>