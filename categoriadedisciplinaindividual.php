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

 
    $idtipodedisciplina=isset($_GET['idtipodedisciplina'])?$_GET['idtipodedisciplina']:"";
$idtipodedisciplina=mysqli_escape_string($conexao, $idtipodedisciplina); 

     $tipodedisciplina=mysqli_fetch_array(mysqli_query($conexao, "select titulo from tipodedisciplinas where idtipodedisciplina='$idtipodedisciplina'"))[0];

 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista de disciplinas no ano lectivo (<?php echo $tipodedisciplina; ?>)</h1>
          <p class="mb-4">A seguir vai a lista de disciplinas disponíveis na instituição</p>
     
      <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>
              <?php 
            if(!empty($acerto)):
                        foreach($acerto as $acerto):
                          echo '<div class="alert alert-success">'.$acerto.'</div>';
                        endforeach;
                      endif;
            ?>


                    
   
   <a href="categoriadedisciplinas.php"><button  class="btn btn-primary"> Ver Categorias de Disciplinas</button></a> 

 

                  <br> <br>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Disciplina</th>  
                      <th>Professor</th> 
                      <th>Auxiliar</th> 
                      <th>Tipo</th>  
                      <th>Classe</th> 
                      <th>Curso</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from disciplinas where idtipodedisciplina='$idtipodedisciplina'"); 
                         while($exibir = $lista->fetch_array()){

                           $iddisciplina=$exibir["iddisciplina"];

                           $idprofessor=$exibir["idprofessor"];
                           $idprofessorauxiliar=$exibir["idprofessorauxiliar"];

                           $Professor=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessor'"))[0];

                          $Professorauxiliar=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar'"))[0];


                           $idturma=$exibir["idturma"];

                           $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));

                            $idcurso=$dadosdaturma["idcurso"]; 
                           $idclasse=$dadosdaturma["idclasse"];

 
                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0]; 

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0]; 

                  ?>
                    <tr>  
                      <td> <a  href="disciplina.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td>  
                      <td><a  href="funcionario.php?idfuncionario=<?php echo $exibir["idprofessor"]; ?>"><?php echo $Professor; ?></a></td>
                      <td><a  href="funcionario.php?idfuncionario=<?php echo $exibir["idprofessorauxiliar"]; ?>"><?php echo $Professorauxiliar; ?></a></td>
                       <td><?php echo $exibir["tipodedisciplina"]; ?></td>  
                      <td><a  href="classe.php?idclasse=<?php echo $idclasse; ?>"><?php echo $classe; ?></a></td>  
                      <td><a  href="curso.php?idcurso=<?php echo $idcurso; ?>"><?php echo $curso; ?></a></td> 
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