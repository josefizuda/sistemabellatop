


<!-- MENU SIDEBAR USUARIO ADMIN-->
<aside class="menu-sidebar2">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo_white.png" alt="Bella Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="images/<?php echo $_SESSION['photo_user']; ?>" />
            </div>
            <h4 class="name">
                Olá <?php echo $_SESSION['name']; ?>

            </h4>
            <a href="logout.php">Sair</a>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="index.php">
                        <i class="fas fa-tachometer-alt"></i>Painel de Controle
                    </a>
                </li>
                <li>
<!--                     <a href="inbox.php">
                        <i class="fas fa-chart-bar"></i>Mensagens</a>
                        <span class="inbox-num">3</span>
                    </li> -->

                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-users"></i>Prestador de Serviço
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="cadastrocolaborador.php">
                                    <i class="fas fa-plus-circle"></i>Cadastro</a>
                                </li>
                                <li>
                                    <a href="prestadores.php">
                                        <i class="far fa-user"></i>Prestadores</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Ordens
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="emitir_ordem.php">
                                            <i class="fas fa-plus-circle"></i>Emitir Ordem</a>
                                        </li>
                                        <li>
                                            <a href="register.php">
                                                <i class="fas fa-check"></i>Baixar Ordem</a>
                                            </li>
                                            <li>
                                                <a href="listar_ordens.php">
                                                    <i class="fas fa-tasks"></i>Lista de Ordens</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-user"></i>Perfil
                                                <span class="arrow">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>
                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                <li>
                                                    <a href="register.php">
                                                        <i class="fas fa-user"></i>Registro de Usuário</a>
                                                    </li>
                                                    <li>
                                                        <a href="edit_perfil.php?id=<?php echo $_SESSION['usuario_bella'] ?>">
                                                            <i class="fas fa-edit (alias)"></i>Editar Perfil</a>
                                                        </li>    
                                                    </ul>
                                                </li>

                                                <li class="has-sub">
                                                    <a class="js-arrow" href="#">
                                                        <i class="fas  fa-shopping-cart"></i>Produtos
                                                        <span class="arrow">
                                                            <i class="fas fa-angle-down"></i>
                                                        </span>
                                                    </a>
                                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                        <li>
                                                            <a href="button.html">
                                                                <i class="fas fa-plus-circle"></i>Cadastro</a>
                                                            </li>
                                                            <li>
                                                                <a href="progress-bar.php">
                                                                    <i class="fas fa-tasks"></i>Lista de Produtos</a>
                                                                </li>
                                                                <li>
                                                                    <a href="cadastro_tamanho.php">
                                                                        <i class="fas fa-arrows-alt"></i>Tamanhos</a>
                                                                    </li>
                                                                                <li>
                                                                                    <a href="cadastro_marca.php">
                                                                                        <i class="fas fa-spinner"></i>Marcas</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </nav>
                                                                </div>
                                                            </aside>
<!-- END MENU SIDEBAR-->