<?php
include("class/protect.php");
protect();
?>
<?php
include("class/conexao.php");
if(!isset($_SESSION))
                   //se nao existir uma sessao ativa, crie-a
 session_start();
foreach($_POST as $chave => $valor) {
                               //criar uma variavel session contato@infiniteflame.com.brpara cada variavel post
 $_SESSION[$chave] = $mysqli->real_escape_string($valor);
}
$conn = new mysqli($host, $usuario, $senha, $bd);
$query = "SELECT * FROM provider WHERE cod_cad_status = 1 ORDER BY name_pr ASC";
$result = mysqli_query($conn, $query);            
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Title Page-->
  <title>Olá<?php echo $_SESSION['name'];?></title>
  <!-- Fontfaces CSS-->
  <link href="css/font-face.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
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
      <!-- DATA TABLE -->
      <h3 class="title-5 m-b-35">Lista de Ordens</h3>
      <div class="table-data__tool">
        <a href="emitir_ordem.php" style="color: #fff;">
          <button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-plus"></i>Adicionar Ordem
          </button>
        </a>
      </div>




      <div class="row">
       <div class="input-daterange">
        <div class="col-md-4">
         <input type="text" name="start_date" id="start_date" class="form-control" readonly="" />
       </div>
       <div class="col-md-4">
         <input type="text" name="end_date" id="end_date" class="form-control" readonly="" />
       </div>      
     </div>
     <div class="col-md-4">
      <input type="button" name="search" id="search" value="Pesquisar" class="btn btn-info" />
    </div>

  </div>
    <br />
  <div class="col-md-4">
  <select name="category" id="category" class="form-control">
           <option value="">Prestador</option>
           <?php 
           while($row = mysqli_fetch_array($result))
           {
            echo '<option value="'.$row["provider_id"].'">'.$row["name_pr"].'</option>';
          }
          ?>
        </select>
      </div>
  <br />  <br />
  <div class="col-md-12">

    <div class="table-responsive m-b-40">
      <!-- tabela de ordens -->
      <table id="tabela" class="table table-striped table-bordered" style="width:100%">
       <!-- thead datatable -->
       <thead>
        <tr>
         <th nowrap="nowrap" width="5%"> Codigo</th>
      <th nowrap="nowrap" width="10%"> Prestador</th>
      <th nowrap="nowrap" width="10%"> Marca e Tamanhos</th>
      <th nowrap="nowrap" width="10%"> Data da ordem</th>
      <th nowrap="nowrap" width="10%"> ENTRADA</th>
      <th nowrap="nowrap" width="10%"> SAIDA</th>
      <th nowrap="nowrap" width="10%"> SALDO</th>
      <th nowrap="nowrap" width="10%"> STATUS</th>
      <th nowrap="nowrap" width="25%"></th>
    </tr>
  </thead>
  <!-- tfooter -->
  <tfoot>
    <tr>
     <th nowrap="nowrap" width="5%"> Codigo</th>
     <th nowrap="nowrap" width="20%"> Prestador</th>
     <th nowrap="nowrap" width="10%"> Marca</th>
     <th nowrap="nowrap" width="10%"> Data da ordem</th>
     <th nowrap="nowrap" width="10%"><span colspan="5">Total:</span></th>
     <th nowrap="nowrap" width="10%"><span colspan="5">Total:</span></th>
     <th nowrap="nowrap" width="10%"><span colspan="5">Total:</span></th>
     <th nowrap="nowrap" width="10%"> STATUS</th>
     <th nowrap="nowrap" width="25%"></th>
   </tr>
 </tfoot>
</table>
</div>
</div>


</div>
</div>

<!-- script datepicker e datatable -->
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
  
  $('.input-daterange').datepicker({  
     todayBtn:'linked',
     format: "yyyy-mm-dd",
     autoclose: true
   });
 
 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#tabela').DataTable({
   "oLanguage": {

         "sInfo": "EXIBINDO _START_ DE _END_ - TOTAL: _TOTAL_",
         "sProcessing":   "PESQUISANDO...",
         "sLengthMenu":   "Mostrar _MENU_ registros_ ",
         "sZeroRecords":  "Não foram encontrados resultados",
         "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
         "sSearch" : "Pesquisar",

         "sInfoFiltered" : "",
         "oPaginate": {
           "sFirst":    "Primeiro",
           "sPrevious": "Anterior",
           "sNext":     "Seguinte",
           "sLast":     "Último"
         },
         "oAria": {
           "sSortAscending": ": Ordenar colunas de forma ascendente",
           "sSortDescending": ": Ordenar colunas de forma descendente"
         }    

       },
    
   "processing":true,
   "serverSide":true,
   "order":[],
   dom: 'lBfrtip',
   "buttons": ['print', 'pdf'],
   "columnDefs":[
       {
         "targets":[1,8],
         "orderable":false,
       },
       ],
   "deferRender": true, 
   "ajax":{
    url:"proc_pesq_ordens.php",
    type:"POST",
    data:{is_date_search:is_date_search, start_date:start_date, end_date:end_date
         },
       },
   //initial callback
       "footerCallback": function ( row, data, start, end, display ) {
         var api = this.api(), data;

               // Remove the formatting to get integer data for summation
               var intVal = function ( i ) {
                 return typeof i === 'string' ?
                 i.replace(/[\$,]/g, '')*1 :
                 typeof i === 'number' ?
                 i : 0;
               };
               
               // Total over all pages page 6
               total = api
               .column( 6, )
               .data()
               .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
               }, 0 );
               
               // Total over this page page 6
               pageTotal = api
               .column( 6, { page: 'current'} )
               .data()
               .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
               }, 0 );
               
               // Update footer page 6
               $( api.column( 6,  ).footer() ).html(
                 'Total: <div style="color: #ff4b5a;">'+pageTotal +'</div> peças'
                 );
               
               // Total over all pages page 5
               total = api
               .column( 5, )
               .data()
               .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
               }, 0 );
               
               // Total over this page page 5
               pageTotal = api
               .column( 5, { page: 'current'} )
               .data()
               .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
               }, 0 );
               
               // Update footer page 5
               $( api.column( 5,  ).footer() ).html(
                 'Total: <div style="color: #0044cc;">'+pageTotal +'</div> peças'
                 );
               
               // Total over all pages
               total = api
               .column( 4, )
               .data()
               .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
               }, 0 );
               
               // Total over this page
               pageTotal = api
               .column( 4, { page: 'current'} )
               .data()
               .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
               }, 0 );
               
               // Update footer
               $( api.column( 4,  ).footer() ).html(
                 'Total: <div style="color: #37692e;">'+pageTotal +'</div> peças'
                 );
               }//end footer callback
    
  });
 }

 $(document).on('change', '#category', function(){
  var category = $(this).val();
  $('#tabela').DataTable().destroy();
  if(category != '')
  {
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
  
$('#search').click(function(){
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      if(start_date != '' && end_date !='')
      {
       $('#tabela').DataTable().destroy();
       fetch_data('yes', start_date, end_date);
     }
     else
     {
       alert("Por Favor selecione uma data");
     }
   });   
  
  
});
</script>
</div>
<!-- END DATA TABLE -->
</div>
<!-- Jquery JS-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<!-- Bootstrap JS -->
<!-- <script src="vendor/bootstrap-4.1/popper.min.js"></script> -->
<!-- Vendor JS -->
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js"></script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
</script>
<!-- Main JS-->
<script src="js/main.js"></script>
</body>
</html>
<!-- end document-->