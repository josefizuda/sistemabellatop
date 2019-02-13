<!-- jquery boot e quicksearch -->
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <!-- plugin quicksearch -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script> 
 <!-- HEADER DESKTOP -->        
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo_white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Painel de Controle</a>
                            </li>
                            <li>
                                <a href="chart.html">
                                    <i class="fas fa-chart-bar"></i>Charts</a>
                                </li>
                                <li>
                                    <a href="table.html">
                                        <i class="fas fa-table"></i>Tables</a>
                                    </li>
                                    <li>
                                        <a href="form.html">
                                            <i class="far fa-check-square"></i>Forms</a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                                            </li>
                                            <li>
                                                <a href="map.html">
                                                    <i class="fas fa-map-marker-alt"></i>Maps</a>
                                                </li>
                                                <li class="has-sub">
                                                    <a class="js-arrow" href="#">
                                                        <i class="fas fa-copy"></i>Pages</a>
                                                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                                            <li>
                                                                <a href="login.html">Login</a>
                                                            </li>
                                                            <li>
                                                                <a href="register.html">Register</a>
                                                            </li>
                                                            <li>
                                                                <a href="forget-pass.html">Forget Password</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="has-sub">
                                                        <a class="js-arrow" href="#">
                                                            <i class="fas fa-desktop"></i>UI Elements</a>
                                                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                                                <li>
                                                                    <a href="typo.html">Typography</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </header>
                                        <script>
                                $('input#txt_consulta').quicksearch('table#tabela tbody tr');
                            </script>    