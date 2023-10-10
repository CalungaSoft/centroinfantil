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
    

if(isset($_POST['editardadosdoanolectivo'])){

  $titulo=mysqli_escape_string($conexao, $_POST['titulo']);  
  $vigor=mysqli_escape_string($conexao, $_POST['vigor']); 
  $posicao=mysqli_escape_string($conexao, $_POST['posicao']); 
  $precodafalta=mysqli_escape_string($conexao, $_POST['precodafalta']); 
  $datainicio=mysqli_escape_string($conexao, $_POST['datainicio']); 
  $datafim=mysqli_escape_string($conexao, $_POST['datafim']); 
  $datafimexame=mysqli_escape_string($conexao, $_POST['datafimexame']); 
  $diadamulta=mysqli_escape_string($conexao, $_POST['diadamulta']); 
  $precodamulta=mysqli_escape_string($conexao, $_POST['precodamulta']); 
  
  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM anoslectivos where titulo='$titulo' and idanolectivo!='$idanolectivo'"))==0){ 
 
 if($vigor=='Sim'){
   $salvar= mysqli_query($conexao,"UPDATE `anoslectivos` SET  vigor='Não'  WHERE 1=1");

 }
  


    $salvar= mysqli_query($conexao,"UPDATE `anoslectivos` SET titulo='$titulo', vigor='$vigor', posicao='$posicao', precodafalta='$precodafalta', datainicio='$datainicio', datafim='$datafim', datafimexame='$datafimexame', diadamulta='$diadamulta', precodamulta='$precodamulta'  WHERE `anoslectivos`.`idanolectivo` = '$idanolectivo'");

    
    if($salvar){
      $acertos[]="Alterações salvas com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outro anolectivo com esse Nome";
   }


  }

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

             <?php if($painellogado=="administrador"    || $painellogado=="areapedagogica" ){ ?>

      
  <a href="anolectivonotas.php?idanolectivo=<?php echo $idanolectivo; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-edit"></i> Notas e Provas</a>  <br><br>

<?php } ?>
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
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="anolectivo.php?idanolectivo=<?php echo $dadosdoanolectivo["idanolectivo"] ; ?>">Ano Lectivo <?php echo $dadosdoanolectivo["titulo"] ; ?></a></div> <br>
                                                   Em Vigor?: <strong><?php echo $dadosdoanolectivo["vigor"]; ?></strong><br>
                                                   Posição: <strong> <?php echo $dadosdoanolectivo["posicao"]; ?> </strong><br>
                                                   Data Início Ano Lectivo: <strong> <?php echo $dadosdoanolectivo["datainicio"]; ?> </strong><br>
                                                   Data Fim do Ano Lectivo: <strong> <?php echo $dadosdoanolectivo["datafim"]; ?> </strong><br>
                                                   Data Fim do Ano Lectivo Classes de Exames: <strong> <?php echo $dadosdoanolectivo["datafimexame"]; ?> </strong><br>
                                             <br>
                                                </div>
                                                  <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>


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
                                                        <input type="text" name="titulo" class="form-control  "  value="<?php echo $dadosdoanolectivo["titulo"] ; ?>">
                                                      </div> 

                                                      
                                                      <div class="form-group">
                                                          <label>Em vigor?:</label>
                                                          <select  name="vigor" class="form-control"> 
                                                                  <option <?php if($dadosdoanolectivo["vigor"]=="Sim") { ?> selected="" <?php }?> value="Sim">Sim</option>
                                                                  <option <?php if($dadosdoanolectivo["vigor"]=="Não") { ?> selected="" <?php }?> value="Não">Não</option> 
                                                              </select>
                                                        
                                                      </div> 

                                                      <div class="form-group">
                                                          <label>Posição:</label>
                                                        <input type="number" name="posicao" min="0" max="300" class="form-control  "  value="<?php echo $dadosdoanolectivo["posicao"] ; ?>">
                                                      </div>

                                                      <div class="form-group">
                                                          <label>Preço da Falta</label>
                                                        <input type="number" name="precodafalta" min="0" max="100000" step="any"  class="form-control  "  value="<?php echo $dadosdoanolectivo["precodafalta"] ; ?>">
                                                      </div> 


                                                      <div class="form-group">
                                                          <label>Data início do ano lectivo</label>
                                                        <input type="text" name="datainicio" class="form-control"  value="<?php echo $dadosdoanolectivo["datainicio"] ; ?>">
                                                      </div>  

                                                      <div class="form-group">
                                                          <label>Data Fim (Classes Normal)</label>
                                                        <input type="text" name="datafim" class="form-control"  value="<?php echo $dadosdoanolectivo["datafim"] ; ?>">
                                                      </div> 

                                                      <div class="form-group">
                                                          <label>Data Fim (Classes de Exame)</label>
                                                        <input type="text" name="datafimexame" class="form-control"  value="<?php echo $dadosdoanolectivo["datafimexame"] ; ?>">
                                                      </div> 

                                                      <div class="form-group">
                                                          <label>Quantos dias para combranças de Multa</label>
                                                        <input type="number" name="diadamulta" min="0" max="60"   class="form-control"  value="<?php echo $dadosdoanolectivo["diadamulta"] ; ?>">
                                                      </div> 
 

                                                      <div class="form-group">
                                                          <label>Preço da Multa</label>
                                                        <input type="text" name="precodamulta"  step="any" class="form-control"  value="<?php echo $dadosdoanolectivo["precodamulta"] ; ?>">
                                                      </div> 
 


                                                      <div class="form-group">
                                                          <input type="submit" name="editardadosdoanolectivo" value="Guardar Novas Informações" class="btn btn-success" title="Guardar dados novos">
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

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Matrícula' or tipo='Rematrícula'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Confirmação'")); 

  
                                      ?>   <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>
 <br>
                                                Preço da Falta: <strong> <?php echo $dadosdoanolectivo["precodafalta"]; ?> </strong><br>
                                                   Dias para cobranças de Multa: <strong> <?php echo $dadosdoanolectivo["diadamulta"]; ?> </strong><br>
                                                   Preço da Multa: <strong> <?php echo $dadosdoanolectivo["precodamulta"]; ?> </strong><br>
                                           
                                                 <?php } ?>


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
              <div class="table-responsive">
               
                    
                
               

              <span id="mensagemdealerta"></span> 
   <?php if($painellogado=="administrador"    || $painellogado=="areapedagogica" ){ ?>

      
                 <a href="anolectivoturma.php?idanolectivo=<?php echo $idanolectivo; ?>" class="d-sm-inline-block btn btn-sm btn-success"  ><i class="fas fa-fw fa-user"></i> Ver todos os estudantes</a>  <br><br>
                   
<?php } ?>

              <span id="mensagemdealerta"></span> 
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Turma</th> 
                      <th>Período</th> 
                      <th>Curso</th> 
                      <th>Sala</th> 
                      <th>Classe</th> 
                      <th>Nº de Alunos</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from turmas where idanolectivo='$idanolectivo'"); 
                         while($exibir = $lista->fetch_array()){

                           $idturma=$exibir["idturma"];

                           $idperiodo=$exibir["idperiodo"];
                           $idcurso=$exibir["idcurso"];
                           $idsala=$exibir["idsala"];
                           $idclasse=$exibir["idclasse"];

                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];
 
                            $alunos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));

                  ?>
                    <tr>  
                      <td> <a  href="turma.php?idturma=<?php echo $exibir["idturma"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td> 

                      <td><a  href="periodo.php?idperiodo=<?php echo $exibir["idperiodo"]; ?>"><?php echo $periodo; ?></a></td>
                      <td><a  href="curso.php?idcurso=<?php echo $exibir["idcurso"]; ?>"><?php echo $curso; ?></a></td>  
                      <td><a  href="sala.php?idsala=<?php echo $exibir["idsala"]; ?>"><?php echo $sala; ?></a></td> 
                      <td><a  href="classe.php?idclasse=<?php echo $exibir["idclasse"]; ?>"><?php echo $classe; ?></a></td>  
                      <td><?php echo $alunos; ?></td>   
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
