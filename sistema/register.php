<?php 
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
        if (strlen($_SESSION['name']) == 0)
        $erro[] = "Preencha o Nome.";

        if (strlen($_SESSION['last_name']) == 0)
        $erro[] = "Preencha seu Sobrenome.";

        if (substr_count($_SESSION['email'], '@') != 1 || substr_count($_SESSION['email'], '.') > 2)
        $erro[] = "Preencha seu e-mail corretamente.";

        if (strlen($_SESSION['cod_acess_level']) == 0)
        $erro[] = "Selecione o Tipo de Usuário.";

        if (strlen($_SESSION['password']) < 8 || strlen($_SESSION['password']) > 16)
        $erro[] = "Preencha a senha corretamente.";

        if (strcmp($_SESSION['password'], $_SESSION['repassword']) != 0)
        $erro[] = "Senhas não conferem.";
        
        //contagem de erro e validação
        if (count($erro) == 0) {
                $foto          = $_FILES['photo_user'];

            // Se a foto estiver sido selecionada
            if (isset($foto['tmp_name']) && empty($foto['tmp_name']) == false) {

            // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
                
            // Gera um nome único para a imagem
                $nome_imagem = md5(time().rand(0,99)).".".$ext[1];
                
            // Faz o upload da imagem para seu respectivo caminho
                move_uploaded_file($foto['tmp_name'], 'images/'.$nome_imagem);
            }   

                    //2- Inserindo no banco de dados e redirecionando
            $password = md5($_SESSION['password']);

            $sql_code = "INSERT INTO user (
            name, 
            last_name, 
            gender, 
            email, 
            password, 
            cod_acess_level, 
            photo_user,
            sign_date)
            VALUES(
            '$_SESSION[name]',
            '$_SESSION[last_name]',
            '$_SESSION[gender]',
            '$_SESSION[email]',
            '$password',
            '$_SESSION[cod_acess_level]',
            '$nome_imagem',
            NOW()
        )";

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);

        if($confirma){
            unset(
                $_SESSION['name'],
                $_SESSION['last_name'],
                $_SESSION['gender'],                
                $_SESSION['email'],
                $_SESSION['password'],
                $_SESSION['cod_acess_level'],
                $_FILES['photo_user'],
                $_SESSION['sign_date']);
            echo "<script> location.href='index.php?p='; </script>";

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
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Cadastro | Controle de Fechamento</title>

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

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <?php
                        if (isset($_SESSION)) {
                        if (count($erro) > 0){  
                            echo "<div class='alert alert-danger'>";
                         foreach ($erro as $valor) 
                            echo "$valor <br>";
                        echo "</div>";
                        }
                        }
                        ?>
                        <div class="login-form">
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <input value="<?php if(isset($_SESSION))echo $_SESSION['name'] ?>" id="name" class="au-input au-input--full" type="text" name="name" placeholder="Nome">
                                </div>

                                <div class="form-group">
                                    <input value="<?php if(isset($_SESSION))echo $_SESSION['last_name'] ?>" id="last_name" class="au-input au-input--full" type="text" name="last_name" placeholder="Sobrenome">
                                </div>

                                
                                <div class="row form-group">
                                    <div class="col-12 col-md-12">
                                        <select value="<?php if(isset($_SESSION))echo $_SESSION['gender'] ?>" name="gender" class="form-control-lg form-control">
                                            <option value="">Selecione seu Sexo</option>
                                            <option value="1">Masculino</option>
                                            <option value="2">Feminino</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <input value="<?php if(isset($_SESSION))echo $_SESSION['email'] ?>" class="au-input au-input--full" type="email" name="email" placeholder="Email" id="email">
                                </div>

                                <div class="row form-group">
                                    <div class="col-12 col-md-12">
                                        <select value="<?php if(isset($_SESSION))echo $_SESSION['cod_acess_level'] ?>" name="cod_acess_level" class="form-control-lg form-control">
                                            <option value="">Selecione Nivel de Acesso</option>
                                            <option value="1">Básico</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Foto de Perfil</label>
                                    <input type="file" name="photo_user" accept="image/png, image/jpeg" class="form-control-file" id="photo_user">
                                </div>

                                <div class="form-group">
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="password" id="password"><small class="form-text text-muted">As senhas devem conter de 8 a 16 caracteres</small>
                                </div>

                                <div class="form-group">
                                    <input class="au-input au-input--full" type="password" name="repassword" placeholder="Digite sua senha novamente" id="repassword">
                                </div>                                

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="confirmar" id="confirmar" value="confirmar">Confirmar</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Já tem uma conta?
                                    <a href="login.php">Login</a>
                                </p>
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