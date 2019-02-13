<?php 
	include("class/conexao.php");

	$status_codigo = intval($_GET['id']);
	if cod_order_status = 
	$sql_code = "UPDATE emitir_ordem 
	SET cod_order_status = '$_SESSION[cod_order_status]' 
	WHERE cod_order_status = '$status_codigo' AND cod_order_status = 1";

	if ($row_usuarios['qtysaldo'] === 0 && $row_usuarios['qtyentry'] = $row_usuarios['qtyexit']){ 
                            $valorStatus =  2; 
                            }
                            else if ($row_usuarios['qtyexit'] < $row_usuarios['qtyentry']) {
                            $sql_code2 = "UPDATE emitir_ordem 
	SET qtysaldo=".$row_usuarios['qtysaldo']."
	WHERE emitir_ordem.emit_id =".$status_codigo."";
                            }else {
                                $sql_code2 = "UPDATE emitir_ordem 
	SET qtysaldo=".$row_usuarios['qtysaldo']."
	WHERE emitir_ordem.emit_id =".$status_codigo."";
                            } 


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
 ?>