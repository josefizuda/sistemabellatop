<?php 
	include("class/conexao.php");

	$ordem_codigo = intval($_GET['id']);

	$sql_code = "DELETE FROM emitir_ordem WHERE emit_id = '$ordem_codigo' AND cod_order_status = 1";
	$sql_query = $mysqli->query($sql_code) or die($mysqli->error);

	if($sql_query){
		//se a query de certo o user vai para o index
		echo "<script type='text/javascript'>location.href='listar_ordens.php';</script>";
	}
	else{
		echo "
			<script type='text/javascript'>
				alert('Nao foi possivel deletar a ordem');
				location.href='index.php?p=inicial';
			</script>";
	}

 ?>