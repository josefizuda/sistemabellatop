<?php 
include("class/conexao.php");

if(!isset($_GET['id'])){
    echo "<script> location.href='index.php?p=inicial';  </script>";
}else{

    $usu_codigo = intval($_GET['id']); //recebendo o codigo do usuario por get
    

    if( isset($_POST["confirmar"])){
        //1- Registro dos dados
        if(!isset($_SESSION)){
        ini_set('session.gc_maxlifetime', 3600); // 1 hora
        ini_set('session.cookie_lifetime', 3600);
        session_start();
        }

        foreach($_POST as $chave => $valor) {
            $_SESSION[$chave] = $mysqli->real_escape_string($valor);
            }


        // validação
        if (substr_count($_SESSION['email'], '@') != 1 || substr_count($_SESSION['email'], '.') > 2)
        $erro[] = "Preencha seu e-mail corretamente.";

        if (strlen($_SESSION['password']) < 8 || strlen($_SESSION['password']) > 16)
        $erro[] = "Preencha a senha corretamente.";

        if (strcmp($_SESSION['password'], $_SESSION['repassword']) != 0)
        $erro[] = "Senhas não conferem.";

        if (count($erro) == 0) {
        

        //2- Inserindo no banco de dados e redirecionando
        $password = md5($_SESSION['password']);

        $sql_code = "UPDATE user SET 
            email = '$_SESSION[email]', 
            password ='$password' 
            WHERE id_user = '$usu_codigo'";

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);

        if($confirma){
            unset($_SESSION[email],
                $_SESSION[password]);

            echo "<script>location.href='index.php?p=inicial'; </script>";

        }else

            $erro[] = $confirma;
        }

    }else{


        $sql_code = "SELECT * FROM user WHERE id_user = '$usu_codigo'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linha = $sql_query->fetch_assoc();

        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION['email']    = $linha['email'];
        $_SESSION['password'] = $linha['password'];

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

                                       <div class="card-header user-header alt bg-dark" style="background-color: #4272d7!important; ">
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
                                        <div class="media">
                                            <a href="#">
                                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/<?php echo $_SESSION['photo_user']; ?>">
                                            </a>
                                            <div class="media-body">
                                                <h2 class="text-light display-6"><?php echo "{$_SESSION['name'] } {$_SESSION['last_name']}";  ?></h2>
                                                <p style="color: #fff;">Data de Cadastro: <?php echo date('d/m/Y', strtotime($_SESSION['sign_date'])); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="card-body card-block">
                                                <form action="index.php?p=edit_perfil&usuario_bella=<?php echo $usu_codigo; ?>" name="cadastro" id="cadastro" method="post">

                                                <div class="form-group"><strong>Nome</strong>
                                                    <input readonly="true" value="<?php echo $_SESSION['name']; ?>" id="name" class="au-input au-input--full" type="text" name="name">
                                                </div>

                                                <div class="form-group"><strong>Sobrenome</strong>
                                                    <input readonly="true" value="<?php echo $_SESSION['last_name']; ?>"  id="last_name" class="au-input au-input--full" type="text" name="last_name">
                                                </div>

                                                <div class="row form-group"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexo</strong>
                                                    <div class="col-12 col-md-12">
                                                        <select   name="gender" class="form-control-lg form-control">
                                                            <?php 
                                                            if ($_SESSION['gender'] == 1) {
                                                                echo "<option>Masculino</option>";
                                                            }
                                                            else {
                                                                echo "<option>Feminino</option>";   
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group"><strong>Email de Cadastro</strong>
                                                    <input value="<?php echo $_SESSION['email']; ?>" required="required" class="au-input au-input--full" type="email" name="email" id="email">
                                                </div>

                                                <div class="row form-group"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo de Usuário</strong>
                                                    <div class="col-12 col-md-12">
                                                        <select  name="cod_acess_level" class="form-control-lg form-control">
                                                            <?php 
                                                            if ($_SESSION['cod_acess_level'] == 1) {
                                                                echo "<option >Básico</option>";
                                                            }
                                                            else {
                                                                echo "<option>Admin</option>";   
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group"><strong>Senha</strong>
                                                    <input  class="au-input au-input--full" type="password" name="password" placeholder="password" id="password">
                                                </div>
                                                <div class="form-group"><strong>Repita Senha</strong>
                                                    <input class="au-input au-input--full" type="password" name="repassword" placeholder="Digite sua senha novamente" id="repassword">
                                                </div>                                  
                                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="confirmar" id="confirmar" value="confirmar">SALVAR</button><p>
                                                    <button href="index.php?p=inicial" type="button" class="btn btn-secondary btn-lg btn-block">Voltar</button>
                                                        
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
                                                        <?php 

    } //fim do primeiro else
    
    ?>        

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