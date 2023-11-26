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

 


$idactividade=isset($_GET['idactividade'])?$_GET['idactividade']:"";
    

if(isset($_POST['editardados_do_atl'])){

      $titulo=mysqli_escape_string($conexao,$_POST['titulo']); 
      $matricula=mysqli_escape_string($conexao,$_POST['matricula']); 
      $descricao=mysqli_escape_string($conexao,$_POST['descricao']); 
      $propina=mysqli_escape_string($conexao,$_POST['propina']); 

      $idcoordenador=mysqli_escape_string($conexao,$_POST['idcoordenador']);
       
       
  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM actividades where titulo='$titulo' and idactividade!='$idactividade'"))==0){ 
 
    $salvar= mysqli_query($conexao,"UPDATE `actividades` SET `titulo` = '$titulo',`descricao` = '$descricao', `propina` = '$propina', `matricula` = '$matricula', `idcoordenador` = '$idcoordenador' WHERE `actividades`.`idactividade` = '$idactividade'");

   

    
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
                                   
                  $dados_do_atl= mysqli_fetch_array(mysqli_query($conexao, "select * from actividades where idactividade='$idactividade' limit 1")); 

                           $turma=$dados_do_atl["titulo"];  
                           $idanolectivo=$dados_do_atl["idanolectivo"]; 

                           $propina=$dados_do_atl["propina"];
                           $matricula=$dados_do_atl["matricula"]; 
  

     ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados da Turma</h1>
      <a href="pdf/pdflistadaturmaactividades.php?idactividade=<?php echo $idactividade; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir Lista da Turma</a>  <br><br>
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
                  <h6 class="m-0 font-weight-bold text-primary">Dados da actividade extra curricular</h6>
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
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="">Actividade: <?php echo $dados_do_atl["titulo"] ; ?></a></div> <br>

                                            <?php

                                            $idanolectivo=$dados_do_atl["idanolectivo"];
                                             $idcoordenador=$dados_do_atl["idcoordenador"];

                                               $anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM anoslectivos where idanolectivo='$idanolectivo' "))[0];

                                               $nomedocoordenador=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedofuncionario FROM funcionarios where idfuncionario='$idcoordenador' "))[0];



                                              ?>


                                                  Descrição: <strong> <?php echo $dados_do_atl["descricao"]; ?> </a><br></strong>
                                             
                                                  Ano Lectivo: <strong> <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo; ?> </a><br></strong>
                                             

                                                       Coordenador de Turma: <strong> <?php echo $nomedocoordenador; ?> </strong>   <br> 




                                                <br>








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
                          <?php

                                $lista=mysqli_query($conexao, "select * from actividades"); 
                        
                          ?>
                      <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control"  placeholder="Título para a actividade" required="" value="<?php echo $dados_do_atl["titulo"]; ?>">
                      <datalist id="datalist2">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 

                    <div class="form-group">
                         <span>Descrição</span>
                        <textarea name="descricao" rows="2" class="form-control " title="Descreva a actividade" ><?php echo $dados_do_atl['descricao']; ?></textarea>
                    </div>

                  <div class="form-group">
                  <span>Preço da Matrícula</span>
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(matricula) from actividades"); 
                        
                          ?>
                      <input type="number" name="matricula" min="0" autocomplete="off" list="listamatricula" class="form-control"  placeholder="Preço da Matrícula" required="" value="<?php echo $dados_do_atl["matricula"]; ?>">
                      <datalist id="listamatricula">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['matricula']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div>  


                       <div class="form-group">
                        <span>Propina</span>
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(propina) from actividades"); 
                        
                          ?>
                      <input type="number" name="propina" min="0" autocomplete="off" list="listapropina" class="form-control"  placeholder="Preço da Propina" required="" value="<?php echo $dados_do_atl["propina"]; ?>">
                      <datalist id="listapropina">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['propina']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 


               

                     

                <div class="form-group">
                         <span>Coordenador de Turma</span>
                                  <select name="idcoordenador"    class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from funcionarios");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option <?php if($dados_do_atl["idcoordenador"]==$exibir["idfuncionario"]){ echo "selected";} ?> value="<?php echo $exibir["idfuncionario"]; ?>"><?php echo $exibir["nomedofuncionario"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                      </div>
                                                      

                                                      <div class="form-group">
                                                          <input type="submit" name="editardados_do_atl" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outros Dados</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idactividade FROM matriculaactividades where idactividade='$idactividade'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idactividade FROM matriculaactividades where idactividade='$idactividade'")); 

                                        
                                        
                                          $precodapropina=number_format($dados_do_atl["propina"],2,",", ".");
                                          $precodamatricula=number_format($dados_do_atl["matricula"],2,",", ".");
                                        
                                      ?>

                                        <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>

                                       Preço da Propina: <strong> <?php echo $precodapropina; ?> </strong>   <br> 


                                       Preço da Matrícula: <strong> <?php echo $precodamatricula; ?> </strong>   <br> 

 
                                      <?php } ?>

                                        <br>  Número de Estudantes: <strong>  <?php echo $numerodeestudantes; ?> <br> </strong>
                                          
                                    
                                         
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
              <h6 class="m-0 font-weight-bold text-primary">Lista de Estudantes desta turma</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
              

              <span id="resultado"> 

              <h2>Lista de Alunos</h2>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Nome Completo</th> 
                      <th>Status</th>
                      <th>Data</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaactividades.* from matriculaactividades, alunos where matriculaactividades.idaluno=alunos.idaluno and matriculaactividades.idactividade='$idactividade'"); 

                         while($exibir = $lista->fetch_array()){
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 
 
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
                  <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar essa turma</span></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample2">
                  <div class="card-body" style="color: red">
                                 Essa Opção serve para ELIMINAR TODOS OS DADOS DESSA turma NO SISTEMA <br> a turma  será eliminada
                                 
                                <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" || $painellogado=="areapedagogica"){ ?>
                                 <div class="form-group"><br>
                                     <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá eliminar todos os dados dessa turma, ou seja, essa turma deixará de existir">Eliminar Essa turma</a>
                                  </div> 
                                 <?php } else{ echo "<br>Você não tem permissão de eliminar uma turma do sistema, contacte o administrador!"; }?>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->
              
            <script>
                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idactividade=<?php echo $idactividade; ?>;
                                                                if(confirm("Tens certeza que queres eliminar essa turma?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deleteturmaatl.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idactividade:idactividade 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })


                                                             $(document).on("click", "#verdisciplina", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idactividade=<?php echo $idactividade; ?>;
                                                                
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/listadedisciplinasdaturma.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idactividade:idactividade 
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
