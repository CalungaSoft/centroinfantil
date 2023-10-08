
<!DOCTYPE html>
<html lang="en">

<head> 

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php  $nomedaEscola= mysqli_fetch_array(mysqli_query($conexao, "select nome from dadosdaempresa where iddadosdaempresa='1' limit 1"))[0]; 
        echo "CalungaSOFT - $nomedaEscola";
  ?> </title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="js/sweet-alert.min.js"></script>
  
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css"> 
    
	
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
     
    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">


    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
  <script src="graficos/Chart.min.js"></script>
	<script src="graficos/samples/utils.js"></script>
     	<script src="graficos/Chart.min.js"></script>
	<script src="graficos/samples/utils.js"></script>
  <style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		.chart-container {
			width: 500px;
			margin-left: 0px;
			margin-right: 0px;
      margin-bottom: 100px;
		}
		.container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: center;
		}
	</style>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" <?php if ($painellogado=="secretaria1" || $painellogado=="secretaria2"  || $painellogado=="administrador"){ ?>  href="index.php" <?php }else if ($painellogado=="professor" ) {?>  href="indexpedagogico.php" <?php }else if ($painellogado=="areapedagogica" ) {?>  href="indexdireitor.php" <?php } ?>>
        <div class="sidebar-brand-icon">
          <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Escola </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Home -->
      <li class="nav-item active">
        <a class="nav-link"  href="indexaluno.php?id=<?php echo $idalunologado; ?>"  >
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Painel</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

       <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="alunopainel.php">
        <i class="fas fa-fw fa-male"></i>
          <span>Meus Dados</span></a>
      </li>
      



 <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="meuperfil.php">
        <i class="fas fa-fw fa-cog"></i>
          <span>Mudar senha</span></a>
      </li>
      

    
<?php
 
 $anolectivo_cabecalho=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo, titulo from anoslectivos where vigor='Sim'"));
  $anodehoje_cabecalho=date('Y');
  $mesdehoje_cabecalho=date('m');

  $diadehoje_cabecalho=date('d');
  
?>

   

          <!-- Nav Item - Tables -->
          <li class="nav-item">
        <a class="nav-link" href="alunorelatorio.php">
        <i class="fas fa-fw fa-user"></i>
          <span>Relatório Diários</span></a>
      </li>




  <!-- Nav Item - Tables -->
  <li class="nav-item">
        <a class="nav-link" href="alunosfinancas.php">
        <i class="fas fa-fw fa-donate"></i>
          <span>Histórico Financeiro</span></a>
      </li>

      
  <!-- Nav Item - Tables -->
  <li class="nav-item">
        <a class="nav-link" href="alunopropina.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
        <i class="fas fa-fw fa-money"></i>
          <span>Propinas</span></a>
      </li>

 
       

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pedagógico
      </div>

   
   
      
 
      
 
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="pedidosdedocumentos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Faltas</span></a>
      </li>

 
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendar" aria-expanded="true" aria-controls="calendar">
          <i class="fas fa-fw fa-book"></i>
          <span>Notas</span>
        </a>
        <div id="calendar" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="alunonota.php" >Mini-Pauta</a>  
            <a class="collapse-item" href="listadedisciplinas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Pauta</a> 
 
          </div>
        </div>
      </li>
       <!-- Nav Item - Utilities Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendaria2" aria-expanded="true" aria-controls="calendaria2">
          <i class="fas fa-fw fa-pencil-square-o"></i>
          <span>Disciplinas</span>
        </a>
        <div id="calendaria2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded"> 
          <a class="collapse-item" href="alunoscadeirantes.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Todas</a>   
            <a class="collapse-item" href="alunoscadeirantes.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Em Atrasos</a>   
 
          </div>
        </div>
      </li>
     
  


<!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="pedidosdedocumentos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
          <i class="fas fa-fw fa-print"></i>
          <span>Pedidos de Documentos</span></a>
      </li>

 
        
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="quadrodehonra.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
          <i class="fas fa-fw fa-weight"></i>
          <span>Quadro de Honra</span></a>
      </li> 

 

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="procurar.php" method="get">
            <div class="input-group">
              <input type="text" name="filtro" class="form-control bg-light border-0 small" placeholder="Procurar por..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

          

             
            <div class="topbar-divider d-none d-sm-block"></div>
          
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome; ?></span>
                <img class="img-profile rounded-circle" src="upload/" alt="">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
            
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

  

