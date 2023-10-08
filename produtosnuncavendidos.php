<?php include("conexao.php");  

    
    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];
    
$categoria=isset($_GET['categoria'])?$_GET['categoria']:"todos";
 
 if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}


include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
<?php
 

?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Produtos da Escola  </h1>
          <p class="mb-4">A seguir vai a lista de Produtos na Escola que nunca foram vendidos</p>
 
 

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Produtos nunca vendidos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Produto</th> 
                      <th>Preço</th>
                      <th title="Quantidade do produto em stock">quantidade</th>  
                      <th>Expiração</th>    
                      <th>Cadastrado em</th>  
                    </tr>
                  </thead>
                  <tbody>
        <?php     $totalpreco=0;
                  $totalagregado=0;
                  $totaldivida=0;
                  $totaldecompras=0;
                  $totalmeta=0;
                  $totalpercentagemmeta=0;
                  
                  
                  $listademateriais=mysqli_query($conexao, "select *  from produtos"); 
                
                  
                 
                   while($exibir = $listademateriais->fetch_array()){

                    $idproduto=$exibir['idproduto']; 
                    $numerodecompras=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade) FROM compra where idproduto='$idproduto'"))[0]; 
                    if($numerodecompras==0){ 
                    
        ?>
                    <tr>
                      <td><a href="produto.php?idproduto=<?php echo $exibir['idproduto']; ?>"><?php echo $exibir['nomedoproduto']; ?></a></td>
                      <td><?php echo $exibir['preco']; ?></td>
                      <td><?php echo $exibir['quantidade']; ?></td>     
                      <td><?php echo $exibir['datadeexpiracao']; ?></td>  
                      <td><?php echo $exibir['data']; ?></td> 
                    </tr>
                  <?php } }?>
                   
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
