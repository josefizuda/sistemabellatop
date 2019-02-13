<?php

$host = "127.0.0.1";
$usuario = "bella_user";
$senha = "Frame1233##@";
$bd = "sistema_bella";

$mysqli = new mysqli($host, $usuario, $senha, $bd);

if($mysqli->connect_errno)
  echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;


?>