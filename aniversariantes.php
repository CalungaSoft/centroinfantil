<?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";

$hoje=date('d');
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
 
       
      $niveralunos=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where MONTH(datadenascimento)=MONTH(curdate())"));
       $aniversariantes=$niveralunos;

   include("cabecalho.php")?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Aniversariantes na Empresa<?php if(isset($_GET['anodevenda'])){ echo "| $anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"> <?php echo $aniversariantes; ?> Aniversariantes </h1>
           

   
        


 
    
    <br><br>
 
           
 


           
 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Aniversariantes desta semana</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th >Nº</th>
                      <th>Nome Completo</th> 
                      <th >Telefone</th>
                      <th >Data de Nascimento</th> 
                      <th>Idade</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                
 
        
                        
                        $niveralunos=mysqli_query($conexao,"SELECT  TIMESTAMPDIFF(YEAR,datadenascimento,CURDATE()) as idade, MONTH(datadenascimento) as mes, DAY(datadenascimento) as dia, alunos.* from alunos alunos where MONTH(datadenascimento)=MONTH(curdate()) order by datadenascimento desc");

                    
                        $datadehoje=Date('m-d');
                        $n=1;
                   while($exibir = $niveralunos->fetch_array()){ 

                   $mes_e_dia="".$exibir['mes']."-".$exibir['mes']."";

                    if($mes_e_dia<$datadehoje){

                      $exibir["idade"]=$exibir["idade"]+1;

                    }
 
            ?>
                    <tr> 
                      <td><?php echo $n; ?></td>
                      <td><a href="aluno.php?idaluno=<?php echo $exibir['idaluno']; ?>"><?php echo $exibir['nomecompleto']; ?></a></td>
                      <td><?php echo $exibir["telefone"]; ?></td>
                      <td><?php echo $exibir["datadenascimento"]; ?></td>
                       <td><?php echo $exibir["idade"]; ?> Anos </td>
                        </tr> 
                   <?php $n++; } 
                  ?>
                    

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

</body>

</html>
