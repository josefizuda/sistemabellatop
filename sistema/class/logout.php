<?php
session_start();
unset($_SESSION['usuario_bella']);
session_destroy();
?>
<script>location.href='../index.php';</script> 
<?php exit('Redirecionando...'); ?>
