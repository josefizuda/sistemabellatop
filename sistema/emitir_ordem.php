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

        //validação de dados
		if (strlen($_SESSION['qtyentry']) == 0)
			$erro[] = "Preencha a Quantidade.";

        //contagem de erro e validação
		if (count($erro) == 0) {

          $sql_code = "SELECT  id_user FROM user WHERE email = '$_SESSION[email]'";
          $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
          $dado = $sql_query->fetch_assoc();
          $total = $sql_query->num_rows;
          $_SESSION['usuario_bella'] = $dado['id_user'];
          $usuario_bella = $_SESSION['usuario_bella'];	
            //2- Inserindo no banco de dados e redirecionando

          $sql_code = "INSERT INTO emitir_ordem (
          cod_provider, 
          cod_marcas, 
          cod_size,
          qtyentry,
          qtyexit,
          qtysaldo, 
          cod_order_status, 
          cod_user,
          order_sign)
          VALUES(
          '$_SESSION[cod_provider]',
          '$_SESSION[cod_marcas]',
          '$_SESSION[cod_size]',
          '$_SESSION[qtyentry]',
          0,
          0,
          1,
          '$usuario_bella',
          NOW()
      )";


      $confirma = $mysqli->query($sql_code) or die($mysqli->error);

      if($confirma){
         unset(
            $_SESSION['cod_provider'],
            $_SESSION['cod_marcas'],
            $_SESSION['cod_size'],
            $_SESSION['qtyentry'],
            $_SESSION['cod_order_status'],
            $_SESSION['order_sign']);

         echo "<script> location.href='listar_ordens.php'; </script>";

     }else{
         $erro[] = $confirma;
     }   
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
								<?php
								if (isset($erro)) {
									if (count($erro) > 0){  
										echo "<div class='alert alert-danger'>";
										foreach ($erro as $valor) 
											echo "$valor <br>";
										echo "</div>";
									}
								}
								?>
								<div class="card">
									<div class="card-header">
										<strong>Emitir</strong> Ordem
									</div>
									<div class="card-body card-block">
										<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
											<!-- name provider -->
											<div class="row form-group">
												<div class="col-12 col-md-9">
													<select id="select_provider" value="" name="cod_provider" class="form-control-lg form-control">
														<option value="">Selecione o prestador</option>
														<?php
                                                            $sql_code = "SELECT * FROM provider WHERE cod_cad_status = 1"; //formando a query
                                                            $sql_query = $mysqli->query($sql_code) or die($mysqli->error); 
                                                            //executando a query e colocando o resultado em um objeto
                                                            $linha = $sql_query->fetch_assoc(); 
                                                            //extraindo os do objeto
                                                            ?><?php 
                                                            do {
                                                            	?>
                                                            	<option  value="<?php echo $linha['provider_id']; ?>"><?php echo $linha['name_pr']; ?>
                                                            </option>
                                                        <?php }while($linha = $sql_query->fetch_assoc()); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- select brand -->
                                            <div class="row form-group">
                                            	<div class="col-12 col-md-9">
                                            		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
                                            		<select  id="mySelect" name="cod_marcas" class="form-control-lg form-control">
                                            			<option>Selecione a Marca</option>
                                            			<?php
                                                            $sql_code = "SELECT * FROM order_marcas"; //formando a query
                                                            $sql_query = $mysqli->query($sql_code) or die($mysqli->error); 
                                                            //executando a query e colocando o resultado em um objeto
                                                            $linha = $sql_query->fetch_assoc(); 
                                                            //extraindo os do objeto
                                                            ?>                                
                                                            <?php 
                                                            do {
                                                            	?>
                                                            	<option  value="<?php echo $linha['marcas_id']; ?>"><?php echo $linha['marcas']; ?></option>
                                                            <?php }while($linha = $sql_query->fetch_assoc()); ?>
                                                            <option value="outros">outros</option>                                                                
                                                        </select>

                                                    </div>

                                                </div>

                                                <!-- outras marcas input -->

                                                <div class="row form-group">
                                                   <div id="inputOculto" class="col-12 col-md-9">
                                                      <input type="text"  name="qty" placeholder="Numero da O.C" class="form-control">
                                                  </div>
                                              </div>

                                              <!-- select size-->
                                              <div class="row form-group">
                                               <div class="col-12 col-md-9">
                                                  <select   value="" name="cod_size" class="form-control-lg form-control">
                                                     <option value="">Selecione o tamanho</option>
                                                     <?php
                                                            $sql_code = "SELECT * FROM order_size"; //formando a query
                                                            $sql_query = $mysqli->query($sql_code) or die($mysqli->error); 
                                                            //executando a query e colocando o resultado em um objeto
                                                            $linha = $sql_query->fetch_assoc(); 
                                                            //extraindo os do objeto
                                                            ?>
                                                            <?php 
                                                            do {
                                                            	?>
                                                            	<option  value="<?php echo $linha['size_id']; ?>"><?php echo $linha['size']; ?></option>
                                                            <?php }while($linha = $sql_query->fetch_assoc()); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <!-- Quantidades -->
                                                <div class="row form-group">
                                                   <div class="col-12 col-md-9">
                                                      <input value="<?php if(isset($_SESSION['qtyentry'])) echo $_SESSION['qtyentry'] ?>" required="required" type="number" id="numero_end_pr" name="qtyentry" placeholder="Quantidade de peças" class="form-control" min="1"><small class="help-block form-text">Quantidade de peças</small>
                                                  </div>
                                              </div>
                                              <!-- botoes -->   
                                              <button  class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="confirmar" id="confirmar" value="confirmar">Confirmar</button></a>
                                              <button href="index.php?p=inicial" type="button" class="btn btn-secondary btn-lg btn-block">Voltar</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
               $(document).ready(function() {
                  $('#inputOculto').hide();
                  $('#mySelect').change(function() {
                     if ($('#mySelect').val() == 'outros') {
                        $('#inputOculto').show();
                    } else {
                        $('#inputOculto').hide();
                    }
                });
              });
          </script>
      </div>
      <!-- Jquery JS -->
      <script src="vendor/jquery-3.2.1.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="vendor/bootstrap-4.1/popper.min.js"></script>
      <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
      <!-- Vendor JS -->
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
  <!-- end document-->
