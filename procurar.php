<?php  include("conexao.php"); 
   
       
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
   $filtro=isset($_GET['filtro'])?$_GET['filtro']:"";
   
   $registrosdealunos=mysqli_query($conexao, "select idaluno, nomecompleto, nomedoencarregado, numerodeprocesso, telefone FROM alunos where (nomecompleto like '%$filtro%' OR nomedoencarregado like '%$filtro%') or numerodeprocesso='$filtro' limit 10"); 

   $entradas=mysqli_query($conexao, "select * FROM entradas  where (descricao like '%$filtro%')   limit 40"); 

   $saidas=mysqli_query($conexao, "select * FROM saidas  where (descricao like '%$filtro%')   limit 40"); 
  
   include("cabecalho.php"); ?>

<h1 class="h3 mb-2 text-gray-800"> Buscas </h1>
          <p class="mb-4">Registros Encontrados com o termo: <span style="font-size:45px">| <?php echo $filtro;?></span></p>


          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">

                       
                          <?php 
                                while($exibir = $registrosdealunos->fetch_array()){ ?>
                        <!-- Earnings (Monthly) Card Example -->
                            <div class="row">
  
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col">
                             <a href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"><div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Alunos</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                            <?php echo $exibir["nomecompleto"]; ?> | Nº de Proc. <strong> <?php echo $exibir["numerodeprocesso"]; ?> </strong> <br>
                                            Telefone: <?php echo $exibir["telefone"]; ?> <br>
                                             Nome do Encarregado: <?php echo $exibir["nomedoencarregado"]; ?>
                                        </div>
                                    </div> 
                                </div>
                                </div> 
                                </div> 
                                </div> 
                                </div></a> 
                                </div>  
                             <?php } ?>
                                <!--end==================================================--> 
                                <?php 
                                while($exibir = $entradas->fetch_array()){ ?>
                        <!-- Earnings (Monthly) Card Example -->
                            <div class="row">
  
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col">
                          
                           <?php  
                        if (($exibir["tipo"]=="Propina")) { ?>
                          <a href="entradapropina.php?identrada=<?php echo $exibir["identrada"]; ?>">
                       <?php  }
                        if ($exibir["tipo"]=="Matrícula" || $exibir["tipo"]=="Confirmação" || $exibir["tipo"]=="Rematrícula") { ?>
                          <a href="entradamatricula.php?identrada=<?php echo $exibir["identrada"]; ?>">
                       <?php } 

                        if ($exibir["tipo"]=="Material Escolar") { ?>
                          <a href="detalhesdacompra.php?idtipo=<?php echo $exibir["idtipo"]; ?>">
                       <?php } 
                       if ($exibir["tipo"]=="Justificação de Faltas") { ?>
                          <a href="detalhesdafalta.php?identrada=<?php echo $exibir["identrada"]; ?>">
                       <?php } 

                       if ($exibir["tipo"]=="Inserção no Sistema") { ?>
                          <a href="insercao.php?identrada=<?php echo $exibir["identrada"]; ?>">
                       <?php } 

                       if ($exibir["tipo"]=="Tratar Documento") { ?>
                          <a href="detalhestratardocumentos.php?identrada=<?php echo $exibir["identrada"]; ?>">
                       <?php } 



                       if ($exibir["tipo"]=="Outras") { ?>
                          <a href="entradasoutras.php?identrada=<?php echo $exibir["identrada"]; ?>">
                       <?php } 

                       $idaluno=$exibir["idaluno"];
                  
                 
                   $nomecompleto=mysqli_fetch_array(mysqli_query($conexao,"SELECT  nomecompleto  FROM alunos where idaluno='$idaluno'"))[0]; 
                        ?>

                        <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Entradas</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                            <?php echo $exibir["descricao"]; ?> <br>
                                            | Valor Pago: <?php echo $exibir["valor"]; ?> <br>
                                            | Dívida <?php echo $exibir["divida"]; ?><br>
                                            | Data <?php echo $exibir["datadaentrada"]; ?><br>
                                            Aluno: <?php echo $nomecompleto; ?>
                                        </div>
                                    </div> 
                                </div>
                                </div> 
                                </div> 
                                </div> 
                                </div> </a>
                                </div>  
                             <?php } ?>
                                <!--end==================================================--> 

 
                             
                                <?php 
                                while($exibir = $saidas->fetch_array()){ ?>
                        <!-- Earnings (Monthly) Card Example -->
                            <div class="row">
  
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col">

                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saídas</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                            <?php echo $exibir["descricao"]; ?> <br>
                                            |  Valor de Saída: <?php echo $exibir["valor"]; ?><br>
                                            |  Valor para consolidação: <?php echo $exibir["divida"]; ?>
                                            |  <?php echo $exibir["datadasaida"]; ?><br>
                                        </div>
                                    </div> 
                                </div>
                                </div> 
                                </div> 
                                </div> 
                                </div>  
                                </div>  
                             <?php } ?>
                                <!--end==================================================--> 

                                

                  
          </div> 

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      </div>
      <!-- End of Main Content -->


<?php include("rodape.php") ?>
