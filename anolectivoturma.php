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

  


$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
     

        include("cabecalho.php") ; ?>

<?php
                                      $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados do Ano Lectivo</h1>
     
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
                  <h6 class="m-0 font-weight-bold text-primary">Dados do Ano Lectivo</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ano Lectivo</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="anolectivo.php?idanolectivo=<?php echo $dadosdoanolectivo["idanolectivo"] ; ?>">Ano Lectivo <?php echo $dadosdoanolectivo["titulo"] ; ?></a></div> 
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Histórico</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Matrícula'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Confirmação'")); 

  
                                      ?>

                                        <br>  Número de Estudantes:  <?php echo $numerodeestudantes; ?> <br> 
                                               Número de Matrículas:  <?php echo $numerodematriculas; ?>  <br> 
                                               Número de Confimações:  <?php echo $numerodereconfirmacoes; ?> <br>
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
              <h6 class="m-0 font-weight-bold text-primary">Lista de Estudantes deste ano lectivo</h6>
            </div>
            <div class="card-body"> 
              <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-group"></i> Agrupar em Turmas</a>  <br><br>
                   

              <div class="table-responsive">
               
                    
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Nome Completo</th>
                      <th>Tipo</th>
                      <th>Turma</th> 
                      <th>Periodo</th>  
                      <th>Status</th>
                      <th>Data</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idanolectivo='$idanolectivo'"); 

                         while($exibir = $lista->fetch_array()){
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 

                      <td><?php echo $exibir['tipo']; ?></td>
                      <td><?php echo $exibir['turma']; ?></td> 
                      <td><?php echo $exibir['periodo']; ?></td> 
                      <td><?php echo $exibir['estatus']; ?></td>
                      <td><?php echo $exibir['data']; ?></td> 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>
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
                  <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar esse anolectivo</span></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample2">
                  <div class="card-body" style="color: red">
                                 Essa Opção serve para ELIMINAR TODOS OS DADOS DESSE anolectivo NO SISTEMA <br> O anolectivo  será eliminado
                                 
                                 <?php if($painellogado=="administrador"){ ?>
                                 <div class="form-group"><br>
                                     <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá eliminar todos os dados gerais">Eliminar Esse anolectivo</a>
                                  </div> 
                                 <?php } else{ echo "<br>Você não tem permissão de eliminar um anolectivo do sistema, contacte o administrador!"; }?>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->
              
            <script>
                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idanolectivo=<?php echo $idanolectivo; ?>;
                                                                if(confirm("Tens certeza que queres eliminar esse anolectivo?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deleteanolectivo.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idanolectivo:idanolectivo 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
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
