<?php
    session_start();
    if(isset($_SESSION['User'])){
        unset($_SESSION['User']);
    }

    if(isset($_SESSION['Admin'])){
        unset($_SESSION['Admin']);
    }

    if(isset($_SESSION['Back'])){
        unset($_SESSION["Back"]);
    }
?>
<script>clear_cart()</script>