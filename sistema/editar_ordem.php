<?php 
include("class/protect.php");
protect();
?>
<?php 
include("class/conexao.php");

if(!isset($_SESSION))

    session_start();
                //se nao existir uma sessao ativa, crie-a
    ini_set('session.gc_maxlifetime', 3600); // 1 hora
    ini_set('session.cookie_lifetime', 3600);
foreach($_POST as $chave => $valor) {
                            //criar uma variavel session para cada variavel post
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
}

$id = intval($_GET['id']);

$busca = "SELECT emitir_ordem.emit_id, provider.name_pr, order_marcas.marcas, order_size.size, emitir_ordem.order_sign, emitir_ordem.qtyentry, emitir_ordem.qtyexit, emitir_ordem.qtysaldo, order_status.status FROM emitir_ordem 
LEFT JOIN user ON user.id_user = emitir_ordem.cod_user
LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas
LEFT JOIN order_size ON order_size.size_id = emitir_ordem.cod_size
LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status
WHERE emit_id = '$id'"; 
$sql_query = $mysqli->query($busca) or die($mysqli->error);
$row = $sql_query->fetch_assoc();


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
                            <div class="card">
                                <?php
                                if (isset($erro)) {
                                    if (count($erro) > 0){  
                                        echo "<div class='alert alert-danger'>";
                                        foreach ($erro as $valor) 
                                            echo "$valor <br>";
                                        echo "</div>";
                                    }
                                } ?>
                                <div class="media">
                                    <div class="card-body card-block">
                                        <form method="POST" action="salvar_ordem.php"  name="cadastro" id="cadastro">

                                            <div class="form-group"><strong>Nome do Prestador</strong>
                                                <input readonly="true" value="<?php echo $row['name_pr']; ?>" id="name_pr" class="au-input au-input--full" type="text" name="name_pr">
                                            </div>

                                            <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
                                            
                                            <div class="form-group"><strong>Marca e Tamanho:</strong>
                                                <span class="role user" readonly="true"  id="marcar" class="au-input au-input--full" type="text"><?php echo strtoupper($row['marcas']); ?></span>
                                                <span class="role user" readonly="true"  id="size" class="au-input au-input--full" type="text"><?php echo strtoupper($row['size']); ?></span>
                                            </div>

                                            <div class="form-group"><strong>Entrada:</strong>
                                                <span class="role member" readonly="true" name="qtyentry" id="qtyentry" class="au-input au-input--full" type="text"><?php echo $row['qtyentry']; ?> Peças</span>
                                            </div>

                                            <div class="form-group"><strong>Saida</strong>
                                                <input value="<?php echo $row['qtyexit']; ?>" required="required" class="au-input au-input--full" type="number" name="qtyexit" id="qtyexit" placeholder="Digite a quantidade da saida">
                                            </div>    

                                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="confirmar" type="submit" value="editar">SALVAR</button><p>
                                                <button href="index.php" type="button" class="btn btn-secondary btn-lg btn-block">Voltar</button>  
                                            </form>
                                        </div>
                                    </div>
                                </div>

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
<script src="vendor/slick/slick.min.js"></script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js"></script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>

<!-- Main JS-->
<script src="js/main.js"></script>
</body>
</html>