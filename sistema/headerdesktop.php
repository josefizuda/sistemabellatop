<!-- HEADER DESKTOP -->
<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a href="index.php">
                        <img src="images/icon/logo_white.png" alt="Bella top" />
                    </a>
                </div>
                <div class="header-button2">
                    <!-- <div class="header-button-item has-noti js-item-menu">
                        <i class="zmdi zmdi-notifications"></i>
                        <div class="notifi-dropdown js-dropdown">
                            <div class="notifi__title">
                                <p>You have 3 Notifications</p>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c1 img-cir img-40">
                                    <i class="zmdi zmdi-email-open"></i>
                                </div>
                                <div class="content">
                                    <p>You got a email notification</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c2 img-cir img-40">
                                    <i class="zmdi zmdi-account-box"></i>
                                </div>
                                <div class="content">
                                    <p>Your account has been blocked</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__item">
                                <div class="bg-c3 img-cir img-40">
                                    <i class="zmdi zmdi-file-text"></i>
                                </div>
                                <div class="content">
                                    <p>You got a new file</p>
                                    <span class="date">April 12, 2018 06:50</span>
                                </div>
                            </div>
                            <div class="notifi__footer">
                                <a href="#">All notifications</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="header-button-item mr-0 js-sidebar-btn">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="edit_perfil.php">
                                    <i class="zmdi zmdi-account"></i>Minha Conta</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Configurações</a>
                                    </div>
<!--                                     <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-globe"></i>Language</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-pin"></i>Location</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-email"></i>Email</a>
                                                    </div>
                                                    <div class="account-dropdown__item">
                                                        <a href="#">
                                                            <i class="zmdi zmdi-notifications"></i>Notificações</a>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                                <div class="logo">
                                    <a href="index.<?php  ?>">
                                        <img src="images/icon/logo_white.png" alt="Bella Top" />
                                    </a>
                                </div>
                                <div class="menu-sidebar2__content js-scrollbar2">
                                    <div class="account2">
                                        <div class="image img-cir img-120">
                                            <img src="images/<?php echo $_SESSION['photo_user']; ?>" />
                                        </div>
                                        <h4 class="name">Olá <?php echo $_SESSION['name']; ?></h4>
                                        <a href="logout.php">SAIR</a>
                                    </div>
                                    <nav class="navbar-sidebar2">
                                        <ul class="list-unstyled navbar__list">
                                            <li class="active has-sub">
                                                <a class="js-arrow" href="#">
                                                    <i class="fas fa-tachometer-alt"></i>Painel de Controle</a>
                                                </li>
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
                                        <li class="disabled">
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
                                                <i class="fas fa-user
                                                "></i>Perfil
                                                <span class="arrow">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>
                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                                                                    <a href="cadastro_cor.php">
                                                                        <i class="fas fa-tint"></i>Cor do TNT</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="cadastro_fechamento.php">
                                                                            <i class="fas fa-adjust"></i>Fechamento</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="cadastro_gramatura.php">
                                                                                <i class="fas fa-bolt"></i>Gramatura</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="cadastro_marca.php">
                                                                                    <i class="fas fa-ticket"></i>Marcas</a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                        </aside>
            <!-- END HEADER DESKTOP -->           