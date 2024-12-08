<?php
include "function.php";
include "config.php";

var_dump($_SESSION);
if(isLogged()){
    unset($_SESSION['user']);
    header("Location: ../index.php");
}