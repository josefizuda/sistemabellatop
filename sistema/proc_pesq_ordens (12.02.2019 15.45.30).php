<?php
//conexao
include("class/conexao.php");
$conn = new mysqli($host, $usuario, $senha, $bd);
if(!isset($_SESSION))
                   //se nao existir uma sessao ativa, crie-a
 session_start();
//colunas
$columns = array(
'emitir_ordem.emit_id', 
'provider.name_pr', 
'order_marcas.marcas', 
'emitir_ordem.order_sign',
'emitir_ordem.qtyentry',
'emitir_ordem.qtyexit',
'emitir_ordem.qtysaldo', 
'order_status.status');
//query
$query = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status WHERE ";
                     
//is date
if($_POST["is_date_search"] == "yes")
{
 $query .= 'order_sign BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}
if(isset($_POST["search"]["value"]))
{
 $query .= '
  (emitir_ordem.emit_id LIKE "%'.$_POST["search"]["value"].'%" 
  OR provider.name_pr LIKE "%'.$_POST["search"]["value"].'%" 
  OR order_marcas.marcas LIKE "%'.$_POST["search"]["value"].'%"
  OR order_size.size LIKE "%'.$_POST["search"]["value"].'%"
  OR emitir_ordem.order_sign LIKE "%'.$_POST["search"]["value"].'%"
  OR emitir_ordem.qtyentry LIKE "%'.$_POST["search"]["value"].'%"
  OR emitir_ordem.qtyexit LIKE "%'.$_POST["search"]["value"].'%"
  OR emitir_ordem.qtysaldo LIKE "%'.$_POST["search"]["value"].'%"  
  OR order_status.status LIKE "%'.$_POST["search"]["value"].'%")
 ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY emitir_ordem.emit_id DESC ';
}
$query1 = '';
if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$resultado_usuarios = mysqli_query($conn, $query);
$totalFiltered   = mysqli_num_rows($resultado_usuarios);
$result = mysqli_query($conn, $query . $query1);
$data = array();
   if ($_SESSION['acess_level'] == 2) {
    while($row = mysqli_fetch_array($result))
{
$saldo = $row["qtyentry"] - $row["qtyexit"];
$sub_array = array();
$sub_array[] = $row["emit_id"];
$sub_array[] = strtoupper($row['name_pr']);
$sub_array[] = '<b>'.$row['marcas'].'</b></br>'.$row['size'].'</br>';
$sub_array[] = date('d/m/Y', strtotime($row['order_sign'])); 
$sub_array[] = $row["qtyentry"];
$sub_array[] = $row["qtyexit"];
$sub_array[] = $saldo;
$sub_array[] = $row["status"];
$sub_array[]='<a href="editar_ordem.php?id='.$row['emit_id'].'" class="btn btn-success"><i class="glyphicon glyphicon-pencil">&nbsp;</i>BAIXAR</a><br>
                <a href="deletar_ordem.php?p=deletar&id='.$row['emit_id'].'" onclick="return confirm(\'Você tem certeza ?\')" class="btn btn-danger"><i class="glyphicon glyphicon-trash">&nbsp;</i>Deletar</a>';
 $data[] = $sub_array;
}
  }
  else {
   while($row = mysqli_fetch_array($result))
{
$saldo = $row["qtyentry"] - $row["qtyexit"];
$sub_array = array();
$sub_array[] = $row["emit_id"];
$sub_array[] = strtoupper($row['name_pr']);
$sub_array[] = '<b>'.$row['marcas'].'</b></br>'.$row['size'].'</br>';
$sub_array[] = date('d/m/Y', strtotime($row['order_sign'])); 
$sub_array[] = $row["qtyentry"];
$sub_array[] = $row["qtyexit"];
$sub_array[] = $saldo;
$sub_array[] = $row["status"];
$sub_array[]='<a href="editar_ordem.php?id='.$row['emit_id'].'" class="btn btn-success"><i class="glyphicon glyphicon-pencil">&nbsp;</i>BAIXAR</a><br>';
 $data[] = $sub_array;
}   
 }
function get_all_data($conn)
{
 $query = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, emitir_ordem.order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status ";
 $resultado_usuarios=mysqli_query($conn, $query);
 return mysqli_num_rows($resultado_usuarios);
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $totalFiltered,
 "data"    => $data
);
echo json_encode($output);
?>