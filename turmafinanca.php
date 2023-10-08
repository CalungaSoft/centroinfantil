<?php 
include("conexao.php");

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
 
$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

$idturma=isset($_GET['idturma'])?$_GET['idturma']:"";
    

if(isset($_POST['editardadosdaturma'])){

      $titulo=mysqli_escape_string($conexao,$_POST['titulo']); 
      $idperiodo=mysqli_escape_string($conexao,$_POST['idperiodo']); 
      $idcurso=mysqli_escape_string($conexao,$_POST['idcurso']);
      $idsala=mysqli_escape_string($conexao,$_POST['idsala']);
      $idclasse=mysqli_escape_string($conexao,$_POST['idclasse']);
      $matricula=mysqli_escape_string($conexao,$_POST['matricula']);
      $reconfirmacao=mysqli_escape_string($conexao,$_POST['reconfirmacao']);
      $propina=mysqli_escape_string($conexao,$_POST['propina']);
      $eclassedeexame=mysqli_escape_string($conexao,$_POST['eclassedeexame']);
      $classificacaopositiva=mysqli_escape_string($conexao,$_POST['classificacaopositiva']);
      $classificacaonegativa=mysqli_escape_string($conexao,$_POST['classificacaonegativa']);
       
  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM turmas where titulo='$titulo' and idturma!='$idturma'"))==0){ 

    $classificacoes=mysqli_fetch_array(mysqli_query($conexao," SELECT classificacaonegativa, classificacaopositiva FROM turmas where idturma='$idturma'"));
 
    $salvar= mysqli_query($conexao,"UPDATE `turmas` SET `titulo` = '$titulo', `idperiodo` = '$idperiodo', `idcurso` = '$idcurso', `idsala` = '$idsala', `idclasse` = '$idclasse', `propina` = '$propina', `reconfirmacao` = '$reconfirmacao', `matricula` = '$matricula', `eclassedeexame` = '$eclassedeexame', `classificacaopositiva` = '$classificacaopositiva', `classificacaonegativa` = '$classificacaonegativa' WHERE `turmas`.`idturma` = '$idturma'");




                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

    
      $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `turma` = '$titulo',`curso` = '$curso',`sala` = '$sala',`periodo` = '$periodo',`classe` = '$classe'  WHERE idturma = '$idturma'");


      $classificacaopositiva_antiga=$classificacoes["classificacaopositiva"];
      $classificacaonegativa_antiga=$classificacoes["classificacaonegativa"];

      if($classificacaopositiva!=$classificacaopositiva_antiga){

           $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `classificacaofinal` = '$classificacaopositiva' WHERE idturma = '$idturma' and classificacaofinal='$classificacaopositiva_antiga'");

      }
   
      if($classificacaonegativa!=$classificacaonegativa_antiga){

                 $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `classificacaofinal` = '$classificacaonegativa'  WHERE idturma = '$idturma' and classificacaofinal='$classificacaonegativa_antiga'");
      
      }
      


    
    if($salvar){
      $acertos[]="Alterações salvas com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outra turma com esse Nome";
   }


  }

        include("cabecalho.php") ; ?>

<?php
                                   
                  $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                           $turma=$dadosdaturma["titulo"]; 
                           $idperiodo=$dadosdaturma["idperiodo"];
                           $idcurso=$dadosdaturma["idcurso"];
                           $idsala=$dadosdaturma["idsala"];
                           $idclasse=$dadosdaturma["idclasse"];
                           $idanolectivo=$dadosdaturma["idanolectivo"];

                           $propina=$dadosdaturma["propina"];
                           $matricula=$dadosdaturma["matricula"];
                           $reconfirmacao=$dadosdaturma["reconfirmacao"];
 


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados Financeiros da Turma</h1>
      <a href="turma.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Voltar</a>  <br><br>
          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

<?php 
            if(!empty($acertos)):
                        foreach($acertos as $acertos):
                          echo '<div class="alert alert-success">'.$acertos.'</div>';
                        endforeach;
                      endif;

                      
            ?>



          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados da turma</h6>
                  <div class="dropdown no-arrow">
                     
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">


                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">turma</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="turma.php?idturma=<?php echo $dadosdaturma["idturma"] ; ?>">Turma: <?php echo $dadosdaturma["titulo"] ; ?></a></div> <br>

                                            <?php

                                            $idanolectivo=$dadosdaturma["idanolectivo"];

                                               $anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM anoslectivos where idanolectivo='$idanolectivo' "))[0];

                                              ?>


                                                  Ano Lectivo: <strong> <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo; ?> </a><br></strong>
                                                 
                                                  Curso: <strong> <a href="curso.php?idcurso=<?php echo $idcurso; ?>"> <?php echo $curso; ?> </a><br></strong>

                                                 Classe: <strong> <a href="classe.php?idclasse=<?php echo $idclasse; ?>"> <?php echo $classe; ?> </a><br></strong>

                                                  Período: <strong> <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br></strong>

                                                    Sala: <strong> <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a><br></strong>  

                                              


                                                <br>








                                                </div>

                                              
                                    </div>
                                    </div> 
                                </div>
                                </div>
                            </div>
                            </div>
   
                                                      
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outros Dados</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma' and tipo='Matrícula'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma' and tipo='Confirmação'")); 

                                           $numerodedisciplinas=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM disciplinas where idturma='$idturma'"));


                                          $numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "select distinct(idprofessor) FROM disciplinas where idturma='$idturma'")); 

                                          $numerodeprofessoresauxiliar=mysqli_num_rows(mysqli_query($conexao, "select distinct(idprofessorauxiliar) FROM disciplinas where idturma='$idturma'")); 

                                          $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where idturma='$idturma'"))[0]+0;

                                          $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(divida) FROM entradas where idturma='$idturma'"))[0]+0;

                                          $valoragregado=number_format($valoragregado,2,",", ".");
                                          $valoremdivida=number_format($valoremdivida,2,",", ".");

                                          $precodapropina=number_format($dadosdaturma["propina"],2,",", ".");
                                          $precodamatricula=number_format($dadosdaturma["matricula"],2,",", ".");
                                          $precodareconfirmacao=number_format($dadosdaturma["reconfirmacao"],2,",", ".");
  
                                      ?>


                                       Preço da Propina: <strong> <?php echo $precodapropina; ?> </strong>   <br> 


                                       Preço da Matrícula: <strong> <?php echo $precodamatricula; ?> </strong>   <br> 


                                       Preço da Confirmação: <strong> <?php echo $precodareconfirmacao; ?> </strong>   <br> 


                                        <br>  Número de Estudantes: <strong>  <?php echo $numerodeestudantes; ?> <br> </strong>
                                 
                                               Valor Agregado: <strong>  <?php echo $valoragregado; ?> Kz<br></strong>
                                               Valor em Dívida: <strong>  <?php echo $valoremdivida; ?> Kz<br>  </strong>

                                        </div>

                            
                                        </div>
                                        </div> 
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>



                 
      </div>
      <!-- End of Main Content -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Registros de Finanças da turma</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                   
                   
                    
                <a href="turma.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-user"></i> Ver Lista de Aluno</a> 
                  
                    <a href="" id="verdisciplina" class="d-sm-inline-block btn btn-sm btn-secondary" ><i class="fas fa-fw fa-book"></i> Ver Disciplinas e Professores </a> 
  

                  <a href="turmafinanca.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-money"></i> Ver Finanças</a>  

                   <a href="turmapauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Ver Pauta</a>  <br><br>
                   


              <span id="resultado"> 

              <h2>Registros Financeiros</h2>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Funcionário</th>  
                      <th>Aluno</th>  
                      <th>Descrição</th>  
                      <th>Categoria</th>
                      <th>Valor</th>
                      <th>Dívida</th>
                      <th>Data</th>
                      <th>Opção</th> 
                    </tr>
                  </thead> 
                  <tbody>
                  <?php
             
                       
                          $registrosdeentradas=mysqli_query($conexao, "select entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios where funcionarios.idfuncionario=entradas.idfuncionario and idturma='$idturma' order by entradas.identrada  desc");
                         
                      
 
                   while($exibir = $registrosdeentradas->fetch_array()){
                   
                    $idaluno=$exibir["idaluno"];
                  
                 
                   $nomecompleto=mysqli_fetch_array(mysqli_query($conexao,"SELECT  nomecompleto  FROM alunos where idaluno='$idaluno'"))[0]; 

                      ?>

                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td> 
                      <td><a href="aluno.php?idaluno=<?php echo $exibir['idaluno']; ?>"><?php echo $nomecompleto; ?></a></td> 
                      
                      <td><?php echo $exibir["descricao"]; ?></td> 
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <td     title="<?php  $valor=number_format($exibir["valor"],2,",", ".");  echo $valor; ?>"><?php echo $exibir["valor"]; ?></td>
                      <td  title="<?php  $divida=number_format($exibir["divida"],2,",", "."); echo $divida; ?>"><?php echo $exibir["divida"]; ?></td>
                      <td><?php echo $exibir["datadaentrada"]; ?></td>
                      <td>
                      <?php  
                        if (($exibir["tipo"]=="Propina")) { ?>
                          <a href="entradapropina.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php  }
                        if ($exibir["tipo"]=="Matrícula" || $exibir["tipo"]=="Confirmação" || $exibir["tipo"]=="Rematrícula") { ?>
                          <a href="entradamatricula.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Material Escolar") { ?>
                          <a href="detalhesdacompra.php?idtipo=<?php echo $exibir["idtipo"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 
                       if ($exibir["tipo"]=="Justificação de Faltas") { ?>
                          <a href="detalhesdafalta.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                       if ($exibir["tipo"]=="Inserção no Sistema") { ?>
                          <a href="insercao.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                       if ($exibir["tipo"]=="Tratar Documento") { ?>
                          <a href="detalhestratardocumentos.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 



                       if ($exibir["tipo"]=="Outras") { ?>
                          <a href="entradasoutras.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 
                        ?>
                           
                     
                      
                     </td>
                    </tr> 
                   <?php }    ?>
                   </tbody> 
                </table>
                </span>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
    
              
            <script>
                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idturma=<?php echo $idturma; ?>;
                                                                if(confirm("Tens certeza que queres eliminar essa turma?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deleteturma.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idturma:idturma 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })


                                                             $(document).on("click", "#verdisciplina", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idturma=<?php echo $idturma; ?>;
                                                                
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/listadedisciplinasdaturma.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idturma:idturma 
                                                                    },
                                                                    success: function(data){
                                                                        $("#resultado").html(data);
                                                          
                                                                    }

                                                                })
                                                               
                                                               
                                                            })

            </script>
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
