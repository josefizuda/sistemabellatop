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
        if (strlen($_SESSION['name_pr']) == 0)
            $erro[] = "Preencha o Nome.";

        if (strlen($_SESSION['tel_pr']) == 0)
            $erro[] = "Preencha telefone.";

        if (strlen($_SESSION['rua_pr']) == 0)
            $erro[] = "Preencha a Rua.";

        if (strlen($_SESSION['numero_end_pr']) == 0)
            $erro[] = "Preencha a Numero.";    

        if (strlen($_SESSION['bairro_pr']) == 0)
            $erro[] = "Preencha o Bairro.";

        if (strlen($_SESSION['cidade_pr']) == 0)
            $erro[] = "Preencha o Cidade.";

        if (strlen($_SESSION['estado_pr']) == 0)
            $erro[] = "Preencha o Estado.";
        
        //contagem de erro e validação
        if (count($erro) == 0) {


            //2- Inserindo no banco de dados e redirecionando

            $sql_code = "INSERT INTO provider (
            name_pr, 
            tel_pr, 
            cep,
            rua_pr, 
            numero_end_pr, 
            bairro_pr, 
            cidade_pr, 
            estado_pr,
            obs_pr,
            cod_cad_status,
            sign_date)
            VALUES(
            '$_SESSION[name_pr]',
            '$_SESSION[tel_pr]',
            '$_SESSION[cep]',
            '$_SESSION[rua_pr]',
            '$_SESSION[numero_end_pr]',
            '$_SESSION[bairro_pr]',
            '$_SESSION[cidade_pr]',
            '$_SESSION[estado_pr]',
            '$_SESSION[obs_pr]',
            '$_SESSION[cod_cad_status]',
             NOW()
            )";


            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

            if($confirma){
                unset(
                    $_SESSION['name_pr'],
                    $_SESSION['tel_pr'],
                    $_SESSION['cep'],
                    $_SESSION['rua_pr'],
                    $_SESSION['numero_end_pr'],
                    $_SESSION['bairro_pr'],
                    $_SESSION['cidade_pr'],
                    $_SESSION['estado_pr'],
                    $_SESSION['obs_pr'],
                    $_SESSION['cod_cad_status']);

                echo "<script> location.href='prestadores.php'; </script>";

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

    <!-- Adicionando Javascript pesquisa cep -->
    <script type="text/javascript" >

        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua_pr').value=("");
            document.getElementById('bairro_pr').value=("");
            document.getElementById('cidade_pr').value=("");
            document.getElementById('estado_pr').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua_pr').value=(conteudo.logradouro);
            document.getElementById('bairro_pr').value=(conteudo.bairro);
            document.getElementById('cidade_pr').value=(conteudo.localidade);
            document.getElementById('estado_pr').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua_pr').value="...";
                document.getElementById('bairro_pr').value="...";
                document.getElementById('cidade_pr').value="...";
                document.getElementById('estado_pr').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
    // fim pesquisa cep
</script>

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
                                        <strong>Cadastro</strong> Prestador de Serviço
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <!-- nome -->
                                            <div class="row form-group">
                                                <div class="col-12 col-md-9">
                                                   <input type="text" value="<?php if(isset($_SESSION['name_pr'])) echo $_SESSION['name_pr'] ?>" id="name_pr" name="name_pr" placeholder="Nome do Prestador de Serviço" class="form-control">
                                                   <small class="form-text text-muted"></small>
                                               </div>
                                           </div>
                                           <!-- telefone -->
                                           <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <input value="<?php if(isset($_SESSION['tel_pr'])) echo $_SESSION['tel_pr'] ?>" type="Tel" id="tel_pr" name="tel_pr" placeholder="Telefone para Contato" class="form-control" maxlength="11">
                                                <small class="help-block form-text"></small>
                                            </div>
                                        </div>
                                        <!-- cep -->
                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="cep" name="cep" placeholder="Cep" class="form-control" value="<?php if(isset($_SESSION['cep'])) echo $_SESSION['cep'] ?>" maxlength="9"
                                                onblur="pesquisacep(this.value);" />
                                                <small class="help-block form-text">Preenchimento de endereço automatico</small>
                                            </div>
                                        </div>
                                        <!-- Rua -->
                                        <div class="row form-group">
                                            <div class="col-12 col-lg-6">
                                                <input value="<?php if(isset($_SESSION['rua_pr'])) echo $_SESSION['rua_pr'] ?>" type="text" id="rua_pr" name="rua_pr" placeholder="Rua" class="form-control">
                                            </div>
                                            <br>
                                            <div class="col-12 col-lg-3">
                                                <input value="<?php if(isset($_SESSION['numero_pr'])) echo $_SESSION['numero_pr'] ?>" required="required" type="number" id="numero_end_pr" name="numero_end_pr" placeholder="Numero" class="form-control" min="1"><small class="help-block form-text">Numero da Casa</small>
                                            </div>
                                        </div>                                                                            
                                        <!-- Bairro -->
                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <input value="<?php if(isset($_SESSION['bairro_pr'])) echo $_SESSION['bairro_pr'] ?>" type="text" id="bairro_pr" name="bairro_pr" placeholder="Bairro" class="form-control">
                                            </div>
                                        </div>
                                        <!-- Cidade -->
                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <input value="<?php if(isset($_SESSION['cidade_pr'])) echo $_SESSION['cidade_pr'] ?>" type="text" id="cidade_pr" name="cidade_pr" placeholder="Cidade" class="form-control">
                                            </div>
                                        </div>
                                        <!-- Estado -->
                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <input value="<?php if(isset($_SESSION['estado_pr'])) echo $_SESSION['estado_pr'] ?>" type="text" id="estado_pr" name="estado_pr" placeholder="Estado" class="form-control" maxlength="2">
                                            </div>
                                        </div>
                                                                                                                                      
                                        <!-- Observações -->                                       
                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <textarea value="<?php if(isset($_SESSION['obs_pr'])) echo $_SESSION['obs_pr'] ?>" name="obs_pr" id="obs_pr" rows="4" placeholder="Observações..." class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <!-- estado cadastro -->
                                        <div class="row form-group">
                                            <div class="col-12 col-md-9">
                                                <select value="<?php if(isset($_SESSION))echo $_SESSION['cod_cad_status'] ?>" name="cod_cad_status" class="form-control-lg form-control">
                                                    <option value="">Selecione estado do cadastro</option>
                                                    <option  value="1">ATIVO</option>
                                                    <option  value="2">DESATIVADO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- botoes -->
                                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="confirmar" id="confirmar" value="confirmar">Confirmar</button>
                                        <button href="index.php?p=inicial" type="button" class="btn btn-secondary btn-lg btn-block">Voltar</button>
                                    </form>
                                </div>
                                <div class="card-footer">
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
