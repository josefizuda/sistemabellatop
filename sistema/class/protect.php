<?php
 
 //verificando se nao existe a funcao protect
 if(!function_exists("protect")){

  function protect(){
   if(!isset($_SESSION)){
    session_start();
   }

   if(!isset($_SESSION['usuario_bella']) || !is_numeric($_SESSION['usuario_bella'])){
    header('Location: login.php');
   }

  } 

 }

protect();
?>