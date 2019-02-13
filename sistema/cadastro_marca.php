<?php 

include("class/protect.php");
protect();

include("class/conexao.php");

    //entra aqui se o botao de name confirmar foi clicado
if( isset($_POST["confirmar"])){
        //1- Registro dos dados


    if(!isset($_SESSION))
                //se nao existir uma sessao ativa, crie-a
        session_start();
    foreach($_POST as $chave => $valor) {
                            //criar uma variavel session para cada variavel post
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    }


    if($_POST) {
        
            //2- Inserindo no banco de dados e redirecionando

            $sql_code = "INSERT INTO order_marcas (
            marcas)
            VALUES(
            '$_SESSION[marcas]'
        )";


        $confirma = $mysqli->query($sql_code) or die($mysqli->error);

        if($confirma){
            unset(
                $_SESSION['marcas']);
            echo "<script> location.href='cadastro_marca.php'; </script>";

        }else{
            $erro[] = $confirma;
        }   
    }
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
        <title>Olá <?php echo $_SESSION['name']; ?> | Bella Admin</title>

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
        <style type="text/css">
        .table-earning tbody td {
            padding: 12px 25px!important;
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
                        <div class="row">
                            <div class="col-lg-6">
                                <?php 
                                $sql_code = "SELECT * FROM order_marcas"; //formando a query
                                $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                $linha = $sql_query->fetch_assoc(); //extraindo os do objeto

    ?>
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro </strong> de Marcas
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">
                                            <!-- Cadastro de Tamanhos -->
                                            <div class="form-group">
                                                <input required="required" value="" id="marcas" class="au-input au-input--full" type="text" name="marcas" placeholder="Informe a marca">
                                            </div>
                                            <!-- botoes -->
                                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="confirmar" id="confirmar" value="confirmar">Confirmar</button>
                                            <button href="index.php?p=inicial" type="button" class="btn btn-secondary btn-lg btn-block">Voltar</button>
                                        </form>
                                    </div>    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Marcas Cadastradas</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        do {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td ><?php echo $linha['marcas']; ?></td>

                                                    <td>
                                                        <div class="table-data-feature">
                                                            <a href="javascript: if(confirm('Tem certeza que deseja deletar a <?php echo $linha['marcas']; ?> ?'))   location.href='deletar_marcas.php?p=deletar&id=<?php echo $linha['marcas_id']; ?>';">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Deletar">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php }while($linha = $sql_query->fetch_assoc()); ?>    
                                    </table>
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
