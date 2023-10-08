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

 


$idaluno=isset($_GET['idaluno'])?$_GET['idaluno']:"";
     
        include("cabecalho.php") ; ?>

<?php
                                   
                  $dadosdoaluno= mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1")); 
 
                           
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Finanças  do aluno</h1>
     
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
                  <h6 class="m-0 font-weight-bold text-primary">Dados do aluno</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">aluno</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"] ; ?>"><?php echo $dadosdoaluno["nomecompleto"] ; ?></a></div> <br>

                                            Sexo: <strong> <?php echo $dadosdoaluno["sexo"]; ?> </strong> <br>

                                            Nome do Pai: <strong> <?php echo $dadosdoaluno["nomedopai"]; ?> </strong> <br>

                                            Nome da Mãe: <strong> <?php echo $dadosdoaluno["nomedamae"]; ?> </strong> <br>

                                            Data de Nascimento: <strong> <?php echo $dadosdoaluno["datadenascimento"]; ?> </strong> <br>
  
                                            <hr> <br>
 



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
                                        <p id="mostra1">  <br>
                                        

                                         Número de processo: <strong> <?php echo $dadosdoaluno["numerodeprocesso"]; ?> </strong> <br>
 
                                            Data de Cadastro no sistema: <strong> <?php echo $dadosdoaluno["datadecadastro"]; ?> </strong> <br>

                                            OBS: <strong> <?php echo $dadosdoaluno["obs"]; ?> </strong> <br> <hr> <br>

                                         
                                               
                                          
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
              <h6 class="m-0 font-weight-bold text-primary">Lista de Estudantes desto aluno</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                        
                    
              <a href="aluno.php?idaluno=<?php echo $idaluno; ?>" id="veralunos" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-table"></i> Ver Anos Lectivo</a>  
              

                <a href="alunofinanca.php?idaluno=<?php echo $idaluno; ?>"  class="d-sm-inline-block btn btn-sm btn-info " ><i class="fas fa-fw fa-money"></i> Ver Finanças</a>  
              
                <br><br>
                   
                   


              <span id="mensagemdealerta">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Funcionário</th>  
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
              
                          $registrosdeentradas=mysqli_query($conexao, "select entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios where funcionarios.idfuncionario=entradas.idfuncionario and entradas.idaluno='$idaluno' order by entradas.identrada desc");
                        
 
                   while($exibir = $registrosdeentradas->fetch_array()){
                   
                    $idaluno=$exibir["idaluno"];
                  
                  

                      ?>

                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>  
                      <td  <?php if($exibir["tipo"]=="Outras"){?>  contenteditable <?php } ?> ><?php echo $exibir["descricao"]; ?></td> 
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <td  <?php if($exibir["tipo"]=="Outras"){?>  contenteditable <?php } ?>  title="<?php  $valor=number_format($exibir["valor"],2,",", ".");  echo $valor; ?>"><?php echo $exibir["valor"]; ?></td>
                      <td <?php if($exibir["tipo"]=="Outras"){?>  contenteditable <?php } ?>  title="<?php  $divida=number_format($exibir["divida"],2,",", "."); echo $divida; ?>"><?php echo $exibir["divida"]; ?></td>
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


                        if ($exibir["tipo"]=="Propina do ATL") { ?>
                          <a href="entradapropinadoatl.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Matrícula ATL") { ?>
                          <a href="entradadamatriculadoatl.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                          if ($exibir["tipo"]=="Mensalidade do transporte") { ?>
                          <a href="entradapropinadotransporte.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Matrícula transporte") { ?>
                          <a href="entradadamatriculadotransporte.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
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
      <!-- End of Main Content -->
        <br><br><br>
      <span id="mensagemdealertadeeliminacao"></span> 
                    <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
                  <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar esse aluno</span></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample2">
                  <div class="card-body" style="color: red">
                                 Essa Opção serve para ELIMINAR TODOS OS DADOS DESSE aluno NO SISTEMA <br> o aluno  será eliminado
                                 
                                 <?php if($painellogado=="administrador"){ ?>
                                 <div class="form-group"><br>
                                     <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá eliminar todos os dados gerais">Eliminar Esse aluno</a>
                                  </div> 
                                 <?php } else{ echo "<br>Você não tem permissão de eliminar um aluno do sistema, contacte o administrador!"; }?>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->
              
            <script>
                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idaluno=<?php echo $idaluno; ?>;
                                                                if(confirm("Tens certeza que queres eliminar esse aluno?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deletealuno.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idaluno:idaluno 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })




                                                             $(document).on("click", "#verfinancasdoaluno", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idaluno=<?php echo $idaluno; ?>; 
                                                                
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/verfinancaaluno.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idaluno
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
