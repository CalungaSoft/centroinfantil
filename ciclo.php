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

 


$idciclo=isset($_GET['idciclo'])?$_GET['idciclo']:"";
    
if(isset($_POST['editardadosdociclo'])){

  $titulo=mysqli_escape_string($conexao, $_POST['titulo']); 

  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM ciclos where titulo='$titulo' and idciclo!='$idciclo'"))==0){ 

   
    $salvar=mysqli_query($conexao,"UPDATE `ciclos` SET `titulo` = '$titulo' WHERE `ciclos`.`idciclo` = '$idciclo'");

  
        if($salvar){

          $acertos[]="Alterações salvas com sucesso!";

        }else{

          $erros[]="ocorreu algum erro!";

        } 

   
  }else {
      $erros[]="Já Existe um Outre Ciclo com esse Nome";
   }


  }


        include("cabecalho.php") ; ?>

<?php
                                   
                  $dadosdaciclo= mysqli_fetch_array(mysqli_query($conexao, "select * from ciclos where idciclo='$idciclo' limit 1")); 

                           $ciclo=$dadosdaciclo["titulo"]; 
                           
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados do período</h1>
     
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
                  <h6 class="m-0 font-weight-bold text-primary">Dados do período</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Período</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="ciclo.php?idciclo=<?php echo $dadosdaciclo["idciclo"] ; ?>"> <?php echo $dadosdaciclo["titulo"] ; ?></a></div>  
 

 


                                                </div>

                                                  <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" || $painellogado=="areapedagogica"){ ?>

                                              <!-- Collapsable Card Example -->
                                              <div class="card shadow mb-6">
                                              <!-- Card Header - Accordion -->
                                              <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Editar Informações</h6>
                                              </a>
                                              <!-- Card Content - Collapse -->
                                              <div class="collapse in" id="collapseCardExample">
                                                <div class="card-body">
                                                <form action="" method="post" class="user">
                                                      
                                                      <div class="form-group">
                                                          <label>Título:</label>
                                                        <input type="text" name="titulo" class="form-control  "  value="<?php echo $dadosdaciclo["titulo"] ; ?>">
                                                      </div> 

                                                       

                                                      <div class="form-group">
                                                          <input type="submit" name="editardadosdociclo" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                                                      </div> 
                                  
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- Collapsable Card Example -->

                                          
                                          <?php } ?>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Histórico</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(matriculaseconfirmacoes.idaluno) FROM matriculaseconfirmacoes, turmas where turmas.idciclo='$idciclo' and matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.estatus='activo'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "SELECT idaluno FROM matriculaseconfirmacoes, turmas where turmas.idciclo='$idciclo' and matriculaseconfirmacoes.idturma=turmas.idturma and tipo='Matrícula' and matriculaseconfirmacoes.estatus='activo'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "SELECT matriculaseconfirmacoes.idaluno FROM matriculaseconfirmacoes, turmas where turmas.idciclo='$idciclo' and matriculaseconfirmacoes.idturma=turmas.idturma and tipo='Confirmação' and matriculaseconfirmacoes.estatus='activo'")); 

                                          $numeroderematricula=mysqli_num_rows(mysqli_query($conexao, "SELECT matriculaseconfirmacoes.idaluno FROM matriculaseconfirmacoes, turmas where turmas.idciclo='$idciclo' and matriculaseconfirmacoes.idturma=turmas.idturma and tipo='Rematrícula' and matriculaseconfirmacoes.estatus='activo'")); 
 
                                      ?>

                                        <br>  Número de Estudantes: <strong>  <?php echo $numerodeestudantes; ?> <br> </strong>
                                               Número de Matrículas: <strong>  <?php echo $numerodematriculas; ?>  <br> </strong>
                                               Número de Confimações: <strong>  <?php echo $numerodereconfirmacoes; ?> <br></strong>
                                               Número de Rematrícula: <strong>  <?php echo $numeroderematricula; ?> <br></strong>

                                       
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
              <h6 class="m-0 font-weight-bold text-primary">Lista de Estudantes deste ciclo</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                

              <span id="resultado">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Nome Completo</th>
                      <th>Tipo</th>   
                      <th>Ano Lectivo</th>
                      <th>Turma</th>
                      <th>Classe</th>
                      <th>Curso</th>
                      <th>Status</th>
                      <th>Data</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "SELECT matriculaseconfirmacoes.*, turmas.idclasse, turmas.idcurso FROM matriculaseconfirmacoes, turmas where turmas.idciclo='$idciclo' and matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.estatus='activo'"); 

                         while($exibir = $lista->fetch_array()){

                             $idaluno=$exibir["idaluno"];

                            $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto from alunos where idaluno='$idaluno'"))[0];


                            $idanolectivo=$exibir["idanolectivo"];

                            $tituloAnoLectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];
   
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $nomedoaluno; ?> </a></td> 
                      <td><?php echo $exibir['tipo']; ?></td>  
                      <td><a href="anolectivo.php?idanolectivo=<?php echo $exibir["idanolectivo"]; ?>"><?php echo $tituloAnoLectivo; ?></a></td> 
                       <td><a href="turma.php?idturma=<?php echo $exibir["idturma"]; ?>"><?php echo $exibir['turma']; ?></a></td>  
                       <td><a href="classe.php?idclasse=<?php echo $exibir["idclasse"]; ?>"><?php echo $exibir['classe']; ?></a></td>  
                        <td><a href="curso.php?idcurso=<?php echo $exibir["idcurso"]; ?>"><?php echo $exibir['curso']; ?></a></td>  
                      <td><?php echo $exibir['estatus']; ?></td>
                      <td><?php echo $exibir['data']; ?></td> 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>
                </span> 
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
      <!-- End of Main Content -->
        <br><br><br>
      <span id="mensagemdealertadeeliminacao"></span> 
                    <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
                  <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar esse ciclo</span></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample2">
                  <div class="card-body" style="color: red">
                                 Essa Opção serve para ELIMINAR TODOS OS DADOS DESSe ciclo NO SISTEMA <br> e ciclo  será eliminado
                                 
                                 <?php if($painellogado=="administrador" || $painellogado=="areapedagogica"){ ?>
                                 <div class="form-group"><br>
                                     <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá eliminar todos os dados gerais">Eliminar Esse ciclo</a>
                                  </div> 
                                 <?php } else{ echo "<br>Você não tem permissão de eliminar um ciclo do sistema, contacte o administrador!"; }?>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->
              
            <script>
                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idciclo=<?php echo $idciclo; ?>;
                                                                if(confirm("Tens certeza que queres eliminar esse ciclo?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deleteciclo.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idciclo:idciclo 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })



                                                               $(document).on("click", "#agruparporturma", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idciclo=<?php echo $idciclo; ?>;
                                                                
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/turmasdaciclo.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idciclo:idciclo 
                                                                    },
                                                                    success: function(data){
                                                                        $("#resultado").html(data);
                                                          
                                                                    }

                                                                })
                                                               
                                                               
                                                            })


                                                           $(document).on("click", "#verdisciplinaseprofessores", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idciclo=<?php echo $idciclo; ?>;
                                                                
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/disciplinaseprofessoresdaciclo.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idciclo:idciclo 
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
