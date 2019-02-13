<?php 
include("class/protect.php");
protect();
?>

<?php 
include("class/conexao.php");

if(!isset($_SESSION))
                //se nao existir uma sessao ativa, crie-a
        session_start();
    foreach($_POST as $chave => $valor) {
                            //criar uma variavel session para cada variavel post
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    }

?>  

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">  

    <!-- Title Page-->
    <title>Olá<?php echo $_SESSION['name']; ?></title>

    <!-- jquery boot e quicksearch -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- plugin quicksearch -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
    

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <style>
    .modal-backdrop {
        position: relative!important;
    }

    .modal{
        position: fixed!important;
        top: 40%!important;
        right: 0%!important;
    }
</style>



</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include ("headermobile.php");?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php 
        if ($_SESSION['acess_level'] == 1) {
            include ("menusidebar_padrao.php");
        }
        else {
           include ("menusidebar.php");   
       }
       ?>
       <!-- END MENU SIDEBAR-->

       <!-- PAGE CONTAINER-->
       <div class="page-container2">

        <!-- HEADER DESKTOP-->
        <?php include ("headerdesktop.php");?>
        <!-- END HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Lista de Ordens</h3>
                    <div class="table-data__tool">
                        <a href="emitir_ordem.php" style="color: #fff;">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Adicionar Ordem</button></a>
                            </div>
                        </div>
                       <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search">Procurar</i></span>
                        <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
                        </div>

            <!-- sql mostrar ordens -->


            <?php
            $sql_code = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, emitir_ordem.order_sign, emitir_ordem.qty, order_status_id FROM emitir_ordem 
            LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
            LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
            LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
            LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
            LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status
                    
                    ORDER BY emit_id DESC"; //formando a query
            $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
            $linha = $sql_query->fetch_assoc(); //extraindo os do objeto

            $cod_cad_status[2] = "Finalizado";
            $cod_cad_status[1] = '<div style="color: #ff4b5a;">EM PRODÇÃO</div>';
            ?>




            
                <table id="tabela" class="table">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Prestador</th>
                            <th>Marca</th>
                            <th>Data da ordem</th>
                            <th>ENTRADA</th>
                            <th>SAIDA</th>
                            <th>SALDO</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php 
                    do {
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $linha['emit_id']; ?></td>
                                <td>
                                    <?php echo strtoupper($linha['name_pr']); ?>
                                </td>
                                <td>
                                    <?php echo strtoupper($linha['marcas'])."<br><b>".$linha['size']; ?>
                                </td>


                                <td><?php echo date('d/m/Y', strtotime($linha['order_sign'])); ?>
                            </td>
                            <td><?php echo $linha['qty']; ?></td>
                            <td><?php 
                            $qtyexit = 10;
                            echo $qtyexit; ?></td>

                            <td><?php 
                                $qtysaldo = $linha['qty'] - $qtyexit; 
                                echo $qtysaldo;
                                ?></td>
                        <td>
                            <span class="status--process">
                            <?php
                            if ($qtysaldo === 0){ 
                            echo  $cod_cad_status[2]; 
                            }
                            else if ($qtysaldo < $qtyexit) {
                            echo  $cod_cad_status[1];
                            }
                            else {
                            echo  $cod_cad_status[1];
                            }
                            ?>
                            </span>
                        </td>

                        <td>
                            <div class="table-data-feature">
                                <a href="javascript: if(confirm('Tem certeza que deseja Alterar o status ordem Nº <?php echo $linha['emit_id']; ?> ?'))   location.href='deletar_ordem.php?p=deletar&id=<?php echo $linha['emit_id']; ?>';">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                    <a href="javascript: if(confirm('Tem certeza que deseja deletar a ordem Nº <?php echo $linha['emit_id']; ?> ?'))   location.href='deletar_ordem.php?p=deletar&id=<?php echo $linha['emit_id']; ?>';">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Deletar">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button></a>
                                    </div>
                                </td>
                            </tr>
                        
                        </tbody>
                    <?php }while($linha = $sql_query->fetch_assoc()); ?>
                </table>
                        <script>
            $('input#txt_consulta').quicksearch('table#tabela tbody tr');
        </script>
                    <script type="text/javascript">
        $(document).ready( function () {
    $('#tabela').DataTable();
} );
    </script>

            
            <!-- END DATA TABLE -->
            <td>
                <!-- Modal -->
                <div  class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Endereço</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim modal -->
    </td>
    <div class="row">
        <div class="col-md-12">
            <div class="copyright">
                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

</div>

<!-- Jquery JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>




<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>

<!-- Vendor JS       -->

<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
</script>

<!-- Main JS-->
<script src="js/main.js"></script>
</body>

</html>
<!-- end document-->
