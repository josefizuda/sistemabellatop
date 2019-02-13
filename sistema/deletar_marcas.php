<?php 
	include("class/conexao.php");

	$marcas_codigo = intval($_GET['id']);

	$sql_code = "DELETE FROM order_marcas WHERE marcas_id = '$marcas_codigo'";
	$sql_query = $mysqli->query($sql_code) or die($mysqli->error);

	if($sql_query){
		//se a query de certo o user vai para o index
		echo "<script type='text/javascript'>location.href='cadastro_marca.php';</script>";
	}
	else{
		echo "
			<script type='text/javascript'>
				alert('Nao foi possivel deletar a marca');
				location.href='index.php?p=inicial';
			</script>";
	}

 ?>