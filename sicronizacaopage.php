<?php 

include("conexao.php");


    
session_start();

if(!isset($_SESSION['logado'])  || $_SESSION['painel']!="administrador"):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];
 
  

include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">
     <!-- Content Row -->
     <div class="row">  
       
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"> Sicronização online / offline </h1> <br>
          <h3 style="font-size: 70px; text-align: center"> <?php 
            if(isset($_GET['sms'])):
                        
                          echo '<div class="alert alert-success">Base de dados sicronizada</div>';
                   
                      endif;

                    
            ?></h3>
           
<br><br>
<?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

<?php 
           

                      $data_referencia_padrao=mysqli_fetch_array(mysqli_query($conexao,"SELECT datadasicronizacao FROM `historico_sincronizacao` order by id desc limit 1"))[0];

            ?>

<br><br><br><br><br><br>
<form class="user" action="sicronizacao.php" method="POST"> 
<br>      <div class="input-group mb-4 mt-4">
                <input type="text" name="data" class="form-control" value="<?php echo $data_referencia_padrao; ?>">
                <button type="submit" class="btn btn-success" >Sicronizar as duas bases de dados a partir dessa data</button>
            </div>
                     
          </form>
         


 
              <div class="table-responsive">

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="45%" cellspacing="0" align="center">
                  <thead>
                    <tr>  
                      
                      <th>Tabelas</th>   
                      <th>Sicronizar</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                          $query_tables = "SHOW TABLES";
                          $result_tables = mysqli_query($conexao, $query_tables);
                      
                          while ($row_table = mysqli_fetch_row($result_tables)) {
                              $nomedatabela = $row_table[0];
 
                  ?>
                    <tr>  
                      <td><?php echo $nomedatabela; ?> </td>  
                     <td id="<?php echo $nomedatabela; ?>"> <a href=""   class="sicronizar" data-id="<?php echo $nomedatabela; ?>">Sicronizar</a> </td> 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>
            
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

<script>
  
  $(document).on("click", ".sicronizar", function(){

    event.preventDefault();

var nomedatabela=$(this).data("id"); 
 

$.ajax({
      url:'sicronizacaodelete.php',
      method:'POST',

      data:{nomedatabela},

      success: function(data){
        $("#" + nomedatabela).html(data);
      }

  })

})
</script>

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
