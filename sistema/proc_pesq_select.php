<?php
//fetch.php
include("class/conexao.php");
$conn = new mysqli($host, $usuario, $senha, $bd);
$column = array("product.id", "product.name", "category.category_name", "product.price");
$query = "
 SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status
";
$query .= " WHERE ";
if($_POST["is_category"] == "yes")
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
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY emitir_ordem.emit_id DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$resultado_usuarios = mysqli_query($conn, $query);
$totalFiltered   = mysqli_num_rows($resultado_usuarios);

$result = mysqli_query($conn, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["category_name"];
 $sub_array[] = $row["price"];
 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status WHERE ";
 $resultado_usuarios=mysqli_query($conn, $query);
 return mysqli_num_rows($resultado_usuarios);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  intval( $qnt_linhas ),
 "recordsFiltered" => intval( $totalFiltered ),
 "data"    => $data
);

echo json_encode($output);

?>