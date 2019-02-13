<?php 
include("class/protect.php");
protect();
?>

<?php 
include("class/conexao.php");

    $sql_code = "SELECT * FROM provider"; //formando a query
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
    $linha = $sql_query->fetch_assoc(); //extraindo os do objeto

    $estado_cadastro[1] = "ATIVO";
    $estado_cadastro[2] = '<div style="color: #ff4b5a;" >BLOQUEADO</div>';

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
    <title>Olá <?php echo $_SESSION['name']; ?></title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

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
                    <h3 class="title-5 m-b-35">Prestadores de Serviço</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <a href="cadastrocolaborador.php" style="color: #fff;"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Adicionar Prestador</button></a>
                            </div>
                        </div>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Data de Cadastro</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php 
                                do {
                                    ?>
                                    <tbody>
                                        <tr class="tr-shadow">
                                            <td><?php echo $linha['name_pr']; ?></td>
                                            <td>
                                                <span class="block-email"><?php echo $linha['tel_pr']; ?></span>
                                            </td>
                                            <td class="desc"><button style="background-color: #4272d7;
                                            color: #fff;
                                            border-color: #365cad;" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-map-marker"></i>&nbsp; Visualizar</button>
                                        </td>

                                <td><?php echo date('d/m/Y', strtotime($linha['sign_date'])); ?></td>
                                <td>
                                    <span class="status--process"><?php echo $estado_cadastro[$linha['estado_cadastro']]; ?></span>
                                </td>

                                <td>
                                    <div class="table-data-feature">
                                        
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <a href="javascript: if(confirm('Tem certeza que deseja deletar <?php echo $linha['name_pr']; ?> ?'))   location.href='deletar_pr.php?p=deletar&id=<?php echo $linha['id']; ?>';">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Deletar">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button></a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        </tbody>
                    <?php }while($linha = $sql_query->fetch_assoc()); ?>
                </table>
            </div>
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
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
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
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
