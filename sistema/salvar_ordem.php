<?php
include("class/conexao.php");


$saida = $_POST['qtyexit'];
$entrada = $_POST['qtyentry'];
$saldo   = $entrada - $_POST['qtyexit'];
$id = $_POST['id'];
	
    
    $sql_code  = "UPDATE emitir_ordem SET qtyexit = $saida WHERE emit_id = $id";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    
    $sql_code2 = "UPDATE emitir_ordem SET qtysaldo = $saldo WHERE emit_id = $id";
    $sql_query = $mysqli->query($sql_code2) or die($mysqli->error);
    echo "<script>location.href='listar_ordens.php'; </script>";


?>