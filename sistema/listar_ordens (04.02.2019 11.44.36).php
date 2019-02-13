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
                            //criar uma variavel session contato@infiniteflame.com.brpara cada variavel post
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



    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    

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

                        <!-- sql mostrar ordens -->


                        <?php
                        include("class/conexao.php"); 
                        $sql_code = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, emitir_ordem.order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status_id FROM emitir_ordem 
                        LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
                        LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
                        LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
                        LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
                        LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status

                    ORDER BY emit_id DESC"; //formando a query

            $result = $mysqli->query($sql_code) or die($mysqli->error);  //executando a query e colocando o resultado em um objeto


            $cod_cad_status[2] = "Finalizado";
            $cod_cad_status[1] = '<div style="color: #ff4b5a;">EM PRODÇÃO</div>';
            $cod_cad_status[3] = '<div style="color: #ff4b5a;">DADOS INCORRETOS</div>';
            ?>

            



            

            <div class="table-responsive table-responsive-data2">
                <table id="tabela" class="display" style="width:100%">
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
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" style="text-align:right">Total:</th>
                            

                            <th></th>
                        </tr>
                    </tfoot>
                </table>

                <script type="text/javascript" language="javascript">

                    $(document).ready(function() {
                        $('#tabela').DataTable({
                            "oLanguage": {

                                "sInfo": "EXIBINDO _START_ DE _END_ - TOTAL: _TOTAL_",
                                "sInfoEmpty": "Tabela vazia",
                                "sProcessing":   "PESQUISANDO...",
                                "sLengthMenu":   "Mostrar _MENU_ registros",
                                "sZeroRecords":  "Não foram encontrados resultados",
                                "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                                "sSearch" : "Pesquisar",

                                "sInfoFiltered" : "",
                                "oPaginate": {
                                    "sFirst":    "Primeiro",
                                    "sPrevious": "Anterior",
                                    "sNext":     "Seguinte",
                                    "sLast":     "Último"
                                },
                                "oAria": {
                                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                                    "sSortDescending": ": Ordenar colunas de forma descendente"
                                }    

                            },            
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": "proc_pesq_ordens.php",
                                "type": "POST"
                            },

                            "footerCallback": function ( row, data, start, end, display ) {
                                var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                i : 0;
            };

            // Total over all pages
            total = api
            .column( 5 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            // Total over this page
            pageTotal = api
            .column( 5, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            // Update footer
            $( api.column( 5 ).footer() ).html(
                pageTotal +' peças'
                );
        }
    });

                    } );

                </script>
            </div>
            <script>
                $('input#txt_consulta').quicksearch('table#tabela tbody tr');
            </script>



            <!-- END DATA TABLE -->
            <td>
            </td>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Infinite Flame</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>

<!-- Jquery JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>




<!-- Bootstrap JS -->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>

<!-- Vendor JS -->

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
