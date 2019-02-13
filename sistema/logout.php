<?php
session_start();
session_destroy();
unset( $_SESSION['user'],$_SESSION['name'], $_SESSION['cod_acess_level'], $_SESSION['password'] );
?>
<script>location.href='login.php';</script>