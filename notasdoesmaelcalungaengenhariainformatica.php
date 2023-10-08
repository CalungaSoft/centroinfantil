<?php 
 
  $hostname="localhost";
  $user="root";
  $password="";
  $database="minhasnotas";
  
  $conexao=mysqli_connect($hostname,$user,$password,$database);
  mysqli_set_charset($conexao, 'utf8');
   
 
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

$erros=[];
$acertos=[];


 
 
 
 

     
      $totaldenotas = mysqli_num_rows(mysqli_query($conexao,"select idnota from notas"));

      $Media = round( mysqli_fetch_array(mysqli_query($conexao,"select AVG(valordanota) from notas"))[0], 2);
      
 
include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

      
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Total de Disciplinas   <?php echo "($totaldenotas)"; ?> | Média do curso: <?php echo "($Media)"; ?>   </h1> 
           

<br><br>
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


           

 
                     <!-- Content Row -->
                    <!-- Content Row -->
                    <div class="row">  
                    <?php  

                          $diferentesnotas=mysqli_query($conexao,"SELECT DISTINCT(valordanota) from notas order by valordanota");

                          while($exibir = $diferentesnotas->fetch_array()){


                                $tipodenota=$exibir["valordanota"];
      
 
  $totaldenotas_portipo = mysqli_num_rows(mysqli_query($conexao,"select idnota from notas where  valordanota ='$tipodenota' "));
  

 
                                   $valor=$totaldenotas_portipo;
                                    if($totaldenotas==0){$totaldenotas=1;} $percentagem=round($valor*100/$totaldenotas); ?>
                                  

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-info shadow h-100 py-2" >
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"> <h5><?php echo "$tipodenota";  ?> Valores</h5>  <br>      </div>
                          <div class="row no-gutters align-items-center">  
                          
                              Total de Disciplinas:
                            <div class="col-auto">
                              <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"> <?php echo "$valor";  ?></div>
                            </div>
                            <div class="col-auto">
                              <div class="h7 mb-0 mr-3 font-weight-bold text-gray-800">Equivalente à <?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                           

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto"> 
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
              
              
             <?php } ?>
                  </div>    
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Relatorio</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                  </thead>
                  <tbody>
                   
                    </tr>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>



  <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Notas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Disciplina</th> 
                      <th>Valor da Nota</th>
                      <th>Ano</th>  
                      <th>Simestre</th>  
                    </tr>
                  </thead> 
                  <tbody>
                  <?php 
             
                        
                        $notas=mysqli_query($conexao, "select  * from notas");
                     
 while($exibir = $notas->fetch_array()){
                   
                  

                      ?>

                    <tr>  
                      <td><?php echo $exibir["disciplina"]; ?></td>
                      <td><?php echo $exibir["valordanota"]; ?></td>
                      <td><?php echo $exibir["ano"]; ?></td>
                      <td><?php echo $exibir["simestre"]; ?></td>
                        
                    </tr> 
                   <?php }    ?>
                   </tbody> 
                    
                </table>
              </div>
            </div>
          </div>

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
