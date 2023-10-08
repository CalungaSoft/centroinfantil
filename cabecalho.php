
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
        <a class="nav-link" <?php if ($painellogado=="secretaria1" || $painellogado=="secretaria2"  || $painellogado=="administrador"){ ?>  href="index.php" <?php }else if ($painellogado=="professor" ) {?>  href="indexpedagogico.php" <?php }else if ($painellogado=="areapedagogica" ) {?>  href="indexdireitor.php" <?php } ?> >
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dia de Hoje</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

    
<?php
 
 $anolectivo_cabecalho=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo, titulo from anoslectivos where vigor='Sim'"));
  $anodehoje_cabecalho=date('Y');
  $mesdehoje_cabecalho=date('m');

  $diadehoje_cabecalho=date('d');
  
?>

        <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="areapedagogica"  || $painellogado=="secretaria2"){ ?>

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#atendimento" aria-expanded="true" aria-controls="atendimento">
            <i class="fas fa-fw fa-donate"></i>
              <span>Atendimento</span>
            </a>
            <div id="atendimento" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tipo de Atendimento:</h6>
                 <?php if($painellogado=="administrador" || $painellogado=="areapedagogica"){ ?>
                <a class="collapse-item" href="cadastraraluno.php" title="Novos alunos com registro de finança">Matrícula</a>
                <a class="collapse-item" href="escolheralunoatl.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" title="">Matrícula no ATL</a>  
                <a class="collapse-item" href="escolheralunotransporte.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" title="">Matrícula no Transporte</a>  
                <a class="collapse-item" href="escolheraluno.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" title="Alunos já cadastrados no sistema em anos lectivos passados">Confirmação</a>  
                
                 <?php } ?>
                  <?php if($painellogado!="areapedagogica"){ ?>
                <a class="collapse-item" href="pagarpropina.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Pagar Propina</a> 
                <a class="collapse-item" href="pagarpropinadoatl.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Pagar Propina ATL</a> 
                <a class="collapse-item" href="pagarpropinadotransporte.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" title="Pagar Mensalidade dos alunos de transporte">Pagar Propina Transp.</a> 
                <?php } ?>
                <a class="collapse-item" href="vender.php">Comprar Material</a>
             
                <a class="collapse-item" href="tratardocumentos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Tratar documentos</a> 
                <a class="collapse-item" href="justificarfaltas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Justificação de falta</a> 
                   <a class="collapse-item" href="descadastrar.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" title="para os casos em que o aluno ter sido expulso, ter desistido, suspenso, inativo, ou falecido" >Descadastrar</a> 

                  <h6 class="collapse-header">Outras Opções</h6> 

                <a class="collapse-item" href="cadastrosimples.php" title="Alunos novos mas sem registro nas finanças">Cadastro Símples</a> 
                <a class="collapse-item" href="cadastromaissimples.php" title="insirir simplesmente o aluno no sistema sem fazer Matrícula ou Confirmação">Inserir Alunos Antigos</a>

              </div>
            </div>
          </li>

          <?php } ?>
          

     <?php if($painellogado=="administrador"){ ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dadosavancados" aria-expanded="true" aria-controls="dadosavancados">
            <i class="fas fa-fw fa-cog"></i>
              <span>Opções Avançadas</span>
            </a>
            <div id="dadosavancados" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded"> 
                <a class="collapse-item" href="configuracaodeprecosmanuntencao.php">Dados da Instituição</a>
                <a class="collapse-item" href="historico.php">Histórico de Alteração</a> 
                <a class="collapse-item" href="administradores.php" >Permissão de acesso</a>
                <a class="collapse-item" href="gestaodebd.php">Banco de Dados</a>  

                 <a class="collapse-item" href="gestaodegastos.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Gestão de Saídas</a> 
                <a class="collapse-item" href="gestaodeimpostos.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Gestão de Impostos</a> 
                <a class="collapse-item" href="gestaodecontas.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Formas de Pagamento</a> 

                     <h6 class="collapse-header">Área Pedagógica</h6> 
                <a class="collapse-item" href="listadeanolectivos.php">Ano Lectivo</a>
                <a class="collapse-item" href="listadeperiodos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Períodos</a> 
                <a class="collapse-item" href="listadeciclos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Ciclos</a> 
                 <a class="collapse-item" href="listadecursos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Cursos</a>
                <a class="collapse-item" href="listadeclasses.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Classes</a> 
                 <a class="collapse-item" href="listadesalas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Salas</a> 
                <a class="collapse-item" href="listadeturmas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Turmas</a>
                <a class="collapse-item" href="categoriadedisciplinas.php">Categoria de Disciplinas</a>


              </div>
            </div>
          </li>
          

     <?php } ?>
      <!-- Divider -->

           <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="meuperfil.php">
        <i class="fas fa-fw fa-male"></i>
          <span>Meu Perfil</span></a>
      </li>


      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Controlo
      </div>

     <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-chart-line"></i>
          <span>Relatório Financeiro</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Entradas</h6>
            <a class="collapse-item" href="entradas.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Registros</a>
            <a class="collapse-item" href="contaseusuariosdiario.php?mesdevenda=<?php echo $mesdehoje_cabecalho; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>&diadevenda=<?php echo $diadehoje_cabecalho; ?>">Relatório Diário</a>
              <?php if($painellogado=="administrador" ||   $painellogado=="secretaria2"){ ?>

            <a class="collapse-item" href="contaseusuarios.php?mesdevenda=<?php echo $mesdehoje_cabecalho; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>">Relatório Mensal</a>
          
           <a class="collapse-item" href="contaseusuariosanual.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>">Relatório Anual</a>
           <?php } ?>
            <a class="collapse-item" href="dividas.php">Dívida</a>
           
             <h6 class="collapse-header">Saída</h6>

            <a class="collapse-item" href="saidas.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Registros</a>
              <a class="collapse-item" href="relatoriodesaidadiario.php?mesdevenda=<?php echo $mesdehoje_cabecalho; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>&diadevenda=<?php echo $diadehoje_cabecalho; ?>">Relatório Diário</a>
                <?php if($painellogado=="administrador"   || $painellogado=="secretaria2"){ ?>

            <a class="collapse-item" href="relatoriodesaidamensal.php?mesdevenda=<?php echo $mesdehoje_cabecalho; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>">Relatório Mensal</a>
              <a class="collapse-item" href="relatoriodesaidaanual.php?mesdevenda=<?php echo $mesdehoje_cabecalho; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>">Relatório Anual</a>

              <?php } ?>
            <a class="collapse-item" href="naoconsolidada.php">Não Consolidadas</a> 
           
        
                <h6 class="collapse-header">Entradas e Saída</h6>

                <?php

                $anor=mysqli_fetch_array(mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas order by datadaentrada asc"))[0];
                $mesr=mysqli_fetch_array(mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes from entradas order by datadaentrada asc"))[0];

                 $ano_f=mysqli_fetch_array(mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas order by datadaentrada desc"))[0];
                $mes_f=mysqli_fetch_array(mysqli_query($conexao,"SELECT  DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes from entradas order by datadaentrada desc"))[0];


                ?>
               
              <a class="collapse-item" href="financasdiario.php?mesdevenda=<?php echo $mesdehoje_cabecalho; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>&diadevenda=<?php echo $diadehoje_cabecalho; ?>">Relatório Diário</a> 

              <?php if($painellogado=="administrador" || $painellogado=="secretaria2"){ ?>

                <a class="collapse-item" href="financas.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Relatório Mensal</a> 
                 

                 <a class="collapse-item" href="relatorioanual.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&anoinicio=<?php echo $anor; ?>&mesinicio=<?php echo $mesr; ?>&anofim=<?php echo $ano_f; ?>&mesfim=<?php echo $mes_f; ?>">Fluxo de caixa anual</a> 

                 <?php } ?>
          </div>
        </div>
      </li>

      <?php } ?>

        <?php if($painellogado=="administrador"  || $painellogado=="secretaria2"){ ?>

 
 <!-- Nav Item - Pages Collapse Menu -->
   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-chart-bar"></i>
          <span>Estatísticas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
             
             
            <a class="collapse-item" href="alunosestatistica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Matrícula de Alunos</a>
             <a class="collapse-item" href="propinaestatisticaematraso.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Propinas</a>
            <a class="collapse-item" href="estatisticaaquisicao.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>" title="Qual mês recebemos mais alunos">Aquisição de Alunos</a>
            <a class="collapse-item" href="estatisticapormeses.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>" title="Qual mês deu-se mais entradas">Receitas</a> 
            <a class="collapse-item" href="estatisticadespesa.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>" title="Qual mês deu-se mais Saídas">Despesa</a> 
            <a class="collapse-item" href="estatisticacaixa.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>" title="Qual mês Tivemos maior valor em caixa (Caixa=Receitas-Saídas)">Fluxo de Caixa</a> 
            <a class="collapse-item" href="estatisticadivida.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>" title="Qual Mês do Ano os Alunos mais se individam">Dívidas</a> 
            
           
          </div>
        </div>
      </li> 
<!-- Nav Item - Utilities Collapse Menu -->

<?php } ?>

  <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" || $painellogado=="areapedagogica"){ ?>

<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-id-badge"></i>
          <span>Funcionários</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Funcionários</h6>

            <a class="collapse-item" href="funcionarios.php">Lista / cadastrar </a>
          <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>
            <a class="collapse-item" href="presenca.php?anodesalario=<?php echo $anodehoje_cabecalho; ?>&mesdesalario=<?php echo $mesdehoje_cabecalho; ?>">Folha de Presença</a>
            <?php } ?>
              <?php if($painellogado=="administrador"  || $painellogado=="secretaria2"){ ?>

            <a class="collapse-item" href="folhadesalario.php?anodesalario=<?php echo $anodehoje_cabecalho; ?>&mesdesalario=<?php echo $mesdehoje_cabecalho; ?>">Folha de Salário</a> 
            <?php } ?>
               <h6 class="collapse-header">Professores</h6>

            <a class="collapse-item" href="professores.php">Lista</a>
            <a class="collapse-item" href="presencaprofessores.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Presença</a>
              <?php if($painellogado=="administrador"  || $painellogado=="secretaria2" || $painellogado=="areapedagogica"){ ?>

            <a class="collapse-item" href="professoresfolhadesalario.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Folha de Salário</a>
            <?php } ?>

          </div>
        </div>
      </li>

      <?php } ?>
      
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#alunoscar" aria-expanded="true" aria-controls="alunoscar">
          <i class="fas fa-fw fa-user"></i>
          <span>Estudantes</span>
        </a>
        <div id="alunoscar" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded"> 
          <a class="collapse-item" href="listadealunos.php">Lista</a>
            <?php if($painellogado=="administrador"    || $painellogado=="areapedagogica"  || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>
            <a class="collapse-item" href="alunosestatistica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Estatísticas</a>
            <?php } ?>
            <a class="collapse-item" href="listadeestudantes.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Inscritos em turmas</a>
       
            <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>
      
            <a class="collapse-item" href="listadeestudantesbolseiro.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Bolseiros</a>
            <a class="collapse-item" href="listadeestudantescomdesconto.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Com Desconto</a>

            <?php } ?>
            <a class="collapse-item" href="desistente.php">Fora Do Sistema</a>
          </div>
        </div>
      </li>
      
      <?php 

       $totaldeaniversariantes=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where MONTH(datadenascimento)=MONTH(curdate())"));

            $totaldeActividades=mysqli_num_rows(mysqli_query($conexao, "select * from agenda where Week(datainicio)=Week(curdate())")); 


             $totaldelembretes=mysqli_num_rows(mysqli_query($conexao, "select * from lembretes where Week(datadolembrete)=Week(curdate())")); 
            
            ?>
       <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendaria" aria-expanded="true" aria-controls="calendaria">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Calendário</span>
        </a>
        <div id="calendaria" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded"> 
            <a class="collapse-item" href="aniversariantes.php">Aniversariantes <sup><?php echo "$totaldeaniversariantes"; ?></sup> </a>
            <a class="collapse-item" href="agenda.php">Actividades <sup><?php echo "$totaldeActividades"; ?></sup></a> 
              <?php if($painellogado=="administrador"  || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>
            <a class="collapse-item" href="lembretes.php">Lembretes <sup><?php echo "$totaldelembretes"; ?></sup></a>
            <?php } ?> 
          </div>
        </div>
      </li>

      <?php if($painellogado=="administrador"    || $painellogado=="areapedagogica"  || $painellogado=="professor"){ ?>

      
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendaria2" aria-expanded="true" aria-controls="calendaria2">
          <i class="fas fa-fw fa-book"></i>
          <span>Área Pedagógica</span>
        </a>
        <div id="calendaria2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="listadeturmas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Turmas</a>  
            <a class="collapse-item" href="listadedisciplinas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Disciplinas</a> 
            <a class="collapse-item" href="disciplinasareapedagogica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Lançar Notas">Lançar Notas</a>
            <a class="collapse-item" href="disciplinasareapedagogica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Lançar Faltas">Lançar Faltas</a> 
            <a class="collapse-item" href="disciplinasareapedagogica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Minipauta">Minipauta</a> 
             <a class="collapse-item" href="avaliacoescontinuas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Avaliações Contínuas</a> 
            <a class="collapse-item" href="turmasareapedagogica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Ver Pauta">Pautas</a>
              <a class="collapse-item" href="disciplinasareapedagogica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Ver Faltas">Faltas</a> 
              <a class="collapse-item" href="relatoriodiariogeral.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Relatório Diário</a> 


            <a class="collapse-item" href="alunoscadeirantes.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Disciplina em Atrasos</a> 
            <a class="collapse-item" href="quadrodehonra.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Quadro de Honra</a> 

            <a class="collapse-item" href="mapadeaproveitamento.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Mapa de Aproveitamento</a> 
 
          </div>
        </div>
      </li>

      <?php } ?>
      <!-- Nav Item - Utilities Collapse Menu -->

      <?php if($painellogado=="administrador"  || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendaria9" aria-expanded="true" aria-controls="calendaria9">
          <i class="fas fa-fw fa-money"></i>
          <span>Propinas</span>
        </a>
        <div id="calendaria9" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded"> 
          <a class="collapse-item" href="pagarpropina.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Pagar Propina</a> 
           <?php if($painellogado=="administrador"  ||   $painellogado=="secretaria2" ){ ?>
           <a class="collapse-item" href="propinaestatisticaematraso.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Estatística</a>

                <a class="collapse-item" href="relatoriodepropinas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Relatório de Pagamentos</a> 

               
                     <?php } ?>
                
                 <a class="collapse-item" href="alunoscompropinasirregulares.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Propinas em Atraso</a>

                  

                <a class="collapse-item" href="alunoscompropinasregulares.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Propinas Regulares</a> 
 

                <a class="collapse-item" href="listadeestudantesbolseiro.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Isentos de Propinas</a> 


          </div>
        </div>
      </li>


        
  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#atl" aria-expanded="true" aria-controls="atl">
          <i class="fas fa-fw fa-book"></i>
          <span>ATL</span>
        </a>
        <div id="atl" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">ATL</h6>
            <a class="collapse-item" href="listadeatl.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Cadastro/Lista</a>
            <a class="collapse-item" href="listadeestudantesdoatl.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Lista de Alunos</a>
            <a class="collapse-item" href="pagarpropinadoatl.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Pagar Mensalidade</a> 
            <a class="collapse-item" href="relatoriodepropinasatl.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Ver Relatórios</a> 
             
          </div>
        </div>
      </li>

           
  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transporte" aria-expanded="true" aria-controls="transporte">
          <i class="fas fa-fw fa-book"></i>
          <span>Transportes</span>
        </a>
        <div id="transporte" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Transportes</h6>
            <a class="collapse-item" href="listadetransporte.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Cadastro/Lista</a>
            <a class="collapse-item" href="listadeestudantesdotransporte.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Lista de Alunos</a>
            <a class="collapse-item" href="pagarpropinadotransporte.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" title="Pagar Mensalidade dos alunos de transporte">Pagar Mensalidade</a> 
            <a class="collapse-item" href="relatoriodepropinastransporte.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Ver Relatórios</a> 
             
          </div>
        </div>
      </li>

      

      <?php } ?>
      
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#calendaria3" aria-expanded="true" aria-controls="calendaria3">
          <i class="fas fa-fw fa-group"></i>
          <span>Organização</span>
        </a>
        <div id="calendaria3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded"> 
            <a class="collapse-item" href="listadeanolectivos.php">Ano Lectivo</a>
                <a class="collapse-item" href="listadeperiodos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Períodos</a> 
              <a class="collapse-item" href="listadeciclos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">Ciclos</a> 
                 <a class="collapse-item" href="listadecursos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Cursos</a>
                <a class="collapse-item" href="listadeclasses.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Classes</a> 
                 <a class="collapse-item" href="listadesalas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Salas</a> 
                <a class="collapse-item" href="listadeturmas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>" >Turmas</a> 
          </div>
        </div>
      </li>
      
  <?php if($painellogado=="administrador"    || $painellogado=="areapedagogica"  || $painellogado=="professor"){ ?>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="listadedisciplinas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
          <i class="fas fa-fw fa-pencil-square-o"></i>
          <span>Disciplinas</span></a>
      </li>

<?php } ?>
  <?php if($painellogado=="administrador"    || $painellogado=="areapedagogica"  || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="pedidosdedocumentos.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
          <i class="fas fa-fw fa-print"></i>
          <span>Pedidos de Documentos</span></a>
      </li>

<?php } ?>
        <?php if($painellogado=="administrador"  || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#produzindo" aria-expanded="true" aria-controls="produzindo">
          <i class="fas fa-fw fa-book"></i>
          <span>Material Escolar</span>
        </a>
        <div id="produzindo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Material Escolar</h6>
            <a class="collapse-item" href="produtos.php?anodevenda=<?php echo $anodehoje_cabecalho; ?>&mesdevenda=<?php echo $mesdehoje_cabecalho; ?>">Cadastro/Lista</a>
            <a class="collapse-item" href="produtosesgotados.php">Esgotados</a> 
            <a class="collapse-item" href="produtosnuncavendidos.php">Nunca Vendidos</a>
            <a class="collapse-item" href="produtosexpirados.php">Expirados</a>
            <?php if($painellogado=="administrador"){ ?>
            <a class="collapse-item" href="historicodedepositos.php">Histórico de Depósitos</a>
            <?php } ?>
          </div>
        </div>
      </li>
      
<?php } ?>
 
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="compararturmas.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>">
          <i class="fas fa-fw fa-weight"></i>
          <span>Comparar Turmas</span></a>
      </li> 

<?php if($painellogado=="administrador"  ||  $painellogado=="secretaria2" ){ ?>
       <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="metas.php">
          <i class="fas fa-fw fa-business-time"></i>
          <span>Metas</span></a>
      </li>
<?php } ?>

<!-- <li class="nav-item">
        <a class="nav-link" href="listadesicronizacao.php">
          <i class="fas fa-fw fa-business-time"></i>
          <span>Sicronização online</span></a>
      </li> -->


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

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" action="">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

             
            <div class="topbar-divider d-none d-sm-block"></div>
            <?php
                                      $dadospessoais=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM funcionarios where idfuncionario='$idlogado' ")) ;
                                   
                              ?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome; ?></span>
                <img class="img-profile rounded-circle" src="upload/<?php echo $dadospessoais["fotografia"] ?>" alt="">
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

  

