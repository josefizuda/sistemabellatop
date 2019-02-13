<?php
$servername = "127.0.0.1";
$username = "bella_user";
$password = "Frame1233##@";
$dbname = "sistema_bella";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 =>'emitir_ordem.emit_id',
	1 =>'provider.name_pr',
	2 =>'order_marcas.marcas',
	3 =>'emitir_ordem.order_sign',
	4 =>'emitir_ordem.qtyentry',
	5 =>'emitir_ordem.qtyexit',
	6 =>'emitir_ordem.qtysaldo',
	7 =>'order_status_id'
);

//Obtendo registros de número total sem qualquer pesquisa
$sql = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, emitir_ordem.order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status WHERE 1=1";

$resultado_user =mysqli_query($conn,$sql) or trigger_error(mysqli_error($conn));
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, emitir_ordem.order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( emitir_ordem.emit_id LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR provider.name_pr LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR order_marcas.marcas LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR emitir_ordem.order_sign LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR emitir_ordem.qtyentry LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR emitir_ordem.qtyexit LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR emitir_ordem.qtysaldo LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR order_status.status LIKE '".$requestData['search']['value']."%' )";
}

$resultado_usuarios = mysqli_query($conn, $result_usuarios);
$totalFiltered   = mysqli_num_rows($resultado_usuarios);
//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios= mysqli_query($conn,$result_usuarios) or trigger_error(mysqli_error($conn));



// Ler e criar o array de dados
$dados = array();
while( $row_usuarios = mysqli_fetch_array($resultado_usuarios) ) {
	
	$row_usuarios['qtysaldo'] = $row_usuarios['qtyentry'] - $row_usuarios['qtyexit'];
	$status_codigo = intval($row_usuarios["emit_id"]);
	$sql_code = "UPDATE emitir_ordem 
	SET qtysaldo=".$row_usuarios['qtysaldo']."
	WHERE emitir_ordem.emit_id =".$status_codigo."";


	if ($row_usuarios['qtysaldo'] === 0 && $row_usuarios['qtyentry'] = $row_usuarios['qtyexit']){ 
                            $valorStatus =  2; 
                            }
                            else if ($row_usuarios['qtyexit'] < $row_usuarios['qtyentry']) {
                            $sql_code = "UPDATE emitir_ordem 
	SET qtysaldo=".$row_usuarios['qtysaldo']."
	WHERE emitir_ordem.emit_id =".$status_codigo."";
                            }else {
                                $sql_code = "UPDATE emitir_ordem 
	SET qtysaldo=".$row_usuarios['qtysaldo']."
	WHERE emitir_ordem.emit_id =".$status_codigo."";
                            } 

	$dado = array(); 
	$dado[] = $row_usuarios["emit_id"];
	$dado[] = strtoupper($row_usuarios['name_pr']);
	$dado[] = $row_usuarios["marcas"];
	$dado[] = date('d/m/Y', strtotime($row_usuarios['order_sign']));
	$dado[] = $row_usuarios["qtyentry"];
	$dado[] = $row_usuarios["qtyexit"];
	$dado[] = $row_usuarios["qtysaldo"];
	$dado[] = $row_usuarios["status"];
	$dados[] = $dado;


}



//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json
