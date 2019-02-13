<?php 
include("class/protect.php");
protect();
?>
<?php
include("class/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Josef Weslley">
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
            <?php include ("headerdesktop.php"); ?>
            <!-- END HEADER DESKTOP-->

                <!-- BREADCRUMB-->
                <?php include ("breadcrumb.php"); ?>
                <!-- END BREADCRUMB-->

            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        <?php
                                        $query = $mysqli->prepare("SELECT * FROM provider");
                                        $query->execute();
                                        $query->store_result();

                                        $rows = $query->num_rows;

                                        echo $rows;

                                        ?>
                                    </h2>
                                    <span class="desc">Colaboradores</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        <?php
                                        $sql_code = "SELECT SUM(qtyentry) FROM emitir_ordem WHERE cod_order_status = 1"; //formando a query
                                        $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                        $row = $sql_query->fetch_assoc(); //extraindo os do objeto
                                        echo $row['SUM(qtyentry)'];
                                        ?>
                                    </h2>
                                    <span class="desc">Em Produçao</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        <?php
                                        $sql_code = "SELECT count(cod_order_status) FROM emitir_ordem WHERE cod_order_status = 1"; //formando a query
                                        $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                        $row = $sql_query->fetch_assoc(); //extraindo os do objeto
                                        echo $row['count(cod_order_status)'];
                                        ?>
                                    </h2>
                                    <span class="desc">Ordens Abertas</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        <?php
                                        $sql_code = "SELECT provider.name_pr, SUM(qtyentry), emitir_ordem.cod_order_status FROM emitir_ordem LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider WHERE emitir_ordem.cod_order_status = 2 GROUP BY name_pr ORDER BY SUM(qtyentry) DESC LIMIT 1
"; //formando a query
                                        $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                        $row = $sql_query->fetch_assoc(); //extraindo os do objeto
                                        echo ucfirst($row['name_pr']);
                                        ?>
                                    </h2>
                                    <span class="desc">Prestador do mês</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-8">
                                <!-- RECENT REPORT 2-->
                               <!--  <div class="recent-report2">
                                    <h3 class="title-3">recent reports</h3>
                                    <div class="chart-info">
                                        <div class="chart-info__left">
                                            <div class="chart-note">
                                                <span class="dot dot--blue"></span>
                                                <span>products</span>
                                            </div>
                                            <div class="chart-note">
                                                <span class="dot dot--green"></span>
                                                <span>Services</span>
                                            </div>
                                        </div>
                                        <div class="chart-info-right">
                                            <div class="rs-select2--dark rs-select2--md m-r-10">
                                                <select class="js-select2" name="property">
                                                    <option selected="selected">All Properties</option>
                                                    <option value="">Products</option>
                                                    <option value="">Services</option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                            <div class="rs-select2--dark rs-select2--sm">
                                                <select class="js-select2 au-select-dark" name="time">
                                                    <option selected="selected">All Time</option>
                                                    <option value="">By Month</option>
                                                    <option value="">By Day</option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recent-report__chart">
                                        <canvas id="recent-rep2-chart"></canvas>
                                    </div>
                                </div> -->
                                <!-- END RECENT REPORT 2  -->
                            </div>
                            <div class="col-xl-4">
                                <!-- TASK PROGRESS-->
                                <!-- <div class="task-progress">
                                    <h3 class="title-3">task progress</h3>
                                    <div class="au-skill-container">
                                        <div class="au-progress">
                                            <span class="au-progress__title">Web Design</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="<?php
                                        $sql_code = "SELECT count(cod_marcas) FROM emitir_ordem WHERE cod_marcas = 3"; //formando a query
                                        $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                        $row = $sql_query->fetch_assoc(); //extraindo os do objeto
                                        echo $row['count(cod_marcas)'];
                                        ?>">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-progress">
                                            <span class="au-progress__title">HTML5/CSS3</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="85">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-progress">
                                            <span class="au-progress__title">WordPress</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-progress">
                                            <span class="au-progress__title">Support</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- END TASK PROGRESS-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="title-1 m-b-25">Ultimas Ordens</h2>
                                <div class="table-responsive table--no-card m-b-40">

                                    <table id="tabela" class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Ordem ID</th>
                                                <th>Data</th>
                                                <th>Prestador</th>
                                                <th class="text-right">Status</th>
                                                <th class="text-right">Quantidade</th>
                                                <th class="text-right">Usuario</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql_code = "
                                        SELECT emitir_ordem.emit_id, emitir_ordem.order_sign, provider.name_pr, order_status_id, emitir_ordem.qtyentry, user.name FROM emitir_ordem

                                        LEFT JOIN user ON user.id_user = emitir_ordem.cod_user 
                                        LEFT JOIN provider ON provider.provider_id = emitir_ordem.cod_provider
                                        LEFT JOIN order_status ON order_status.order_status_id = emitir_ordem.cod_order_status
                                        ORDER BY order_sign DESC LIMIT 10"; //formando a query
                                        $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                        $row = $sql_query->fetch_assoc(); //extraindo os do objeto

            $cod_cad_status[2] = "Finalizado";
            $cod_cad_status[1] = '<div style="color: #ff4b5a;">EM PRODÇÃO</div>';
            $cod_cad_status[3] = '<div style="color: #ff4b5a;">DADOS INCORRETOS</div>';
                                        ?> <?php 
                                        do {
                                            ?>                                                                               
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="editar_ordem.php?id=<?php echo $row['emit_id'];?>">
                                                    <?php echo $row['emit_id']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="editar_ordem.php?id=<?php echo $row['emit_id'];?>">
                                                    <?php echo date('d/m/Y', strtotime($row['order_sign'])); ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $row['name_pr']; ?></a></td>
                                                <td class="text-right"><?php echo $cod_cad_status[$row['order_status_id']]; ?></td>
                                                <td class="text-right"><?php echo $row['qtyentry']; ?></td>
                                                <td class="text-right"><?php echo $row['name']; ?></td>
                                                
                                            </tr>
                                        </tbody>
                                        <?php }while($row = $sql_query->fetch_assoc()); ?>                                        
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">Quantidade por Marcas</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <?php
                                                    $sql_code = "SELECT order_marcas.marcas, SUM(qtyentry) FROM emitir_ordem LEFT JOIN order_marcas ON order_marcas.marcas_id = emitir_ordem.cod_marcas WHERE emitir_ordem.cod_order_status = 2 GROUP BY cod_marcas ORDER BY SUM(qtyentry) DESC"; //formando a query
                                                    $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //executando a query e colocando o resultado em um objeto
                                                    $row = $sql_query->fetch_assoc(); //extraindo os do objeto

                                                    ?> <?php 
                                                    do {
                                                ?> 
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $row['marcas']; ?></td>
                                                        <td class="text-right"><?php echo $row['SUM(qtyentry)']; ?></td>
                                                    </tr>
                                                </tbody>
                                                <?php }while($row = $sql_query->fetch_assoc()); ?> 
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        </div>
                    </section>

                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="copyright">
                                        <p>Copyright © 2018 josefizuda. todos os direitos Reservados. Template by <a href="https://infiniteflame.com.br">INFINITE FLAME</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- END PAGE CONTAINER-->
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
            <script src="vendor/vector-map/jquery.vmap.js"></script>
            <script src="vendor/vector-map/jquery.vmap.min.js"></script>
            <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
            <script src="vendor/vector-map/jquery.vmap.world.js"></script>

            <!-- Main JS-->
            <script src="js/main.js"></script>

        </body>

        </html>
<!-- end document-->