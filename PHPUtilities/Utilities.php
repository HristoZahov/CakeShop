<?php
    function weightFilter($weight){
        $arr = explode (".", $weight); 
        if($arr[1] == "00"){
            return $arr[0];
        }
        return $weight;
    }
?>