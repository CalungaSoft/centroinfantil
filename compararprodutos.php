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

 


$idcliente=1;

if(isset($_POST['comparar'])){

    $tipodecomparacao=$_POST['tipodecomparacao'];
    $mesdecomparacao=$_POST['mesdecomparacao'];
    $anodecomparacao=$_POST['anodecomparacao'];
    $produto1=$_POST['produto1'];
    $produto2=$_POST['produto2']; 

    $formadecomparacao=$_POST['formadecomparacao']; 
if($formadecomparacao=="porhoras"){

    header("Location: comparandoosprodutos.php?produto2=$produto2&produto1=$produto1&tipodecomparacao=$tipodecomparacao&mesdecomparacao=$mesdecomparacao&anodecomparacao=$anodecomparacao");

}else if($formadecomparacao=="pordiasdesemana"){

    header("Location: comparandoosprodutosdiadesemana.php?produto2=$produto2&produto1=$produto1&tipodecomparacao=$tipodecomparacao&mesdecomparacao=$mesdecomparacao&anodecomparacao=$anodecomparacao");

}else if($formadecomparacao=="pordiasdomes"){
 
    header("Location: comparandoosprodutosdiadomes.php?produto2=$produto2&produto1=$produto1&tipodecomparacao=$tipodecomparacao&mesdecomparacao=$mesdecomparacao&anodecomparacao=$anodecomparacao");
}

  }

        include("cabecalho.php") ; ?>

<?php
                                      $dadosdocliente=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM clientes where idcliente='$idcliente' "));
                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Comparando produtos</h1>
     
                               


          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Produtos a ser comparados</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Produto 1</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">  
                                        <form action="" method="post">
                                                <select name="produto1"  class="form-control" title="Escolha aqui o produto">
                                                <?php $listadeprodutos=mysqli_query($conexao,"SELECT * FROM produtos order by nomedoproduto"); 
                                                    while($exibir = $listadeprodutos->fetch_array()){  ?>
                                                    <option value="<?php echo $exibir["idproduto"]?>"><?php echo $exibir["nomedoproduto"]?></option>
                                            <?php } ?>   
                                            </select>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produto 2</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <select name="produto2"  class="form-control" title="Escolha aqui o segundo produto">
                                                <?php $listadeprodutos=mysqli_query($conexao,"SELECT * FROM produtos order by nomedoproduto"); 
                                                    while($exibir = $listadeprodutos->fetch_array()){  ?>
                                                    <option value="<?php echo $exibir["idproduto"]?>"><?php echo $exibir["nomedoproduto"]?></option>
                                            <?php } ?>   
                                            </select>
                                        </div>
                                        </div> 
                                </div>
                                </div>
                            </div>
                        </div>
                      </div> 


 
 

                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Forma de Comparação</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">  
                                                <select name="tipodecomparacao"  class="form-control">
                                                    <option value="quantidade">Número de vendas</option>
                                                    <option value="valorpago">Valor de vendas</option> 
                                            </select> <br>
                                            <select name="formadecomparacao"  class="form-control">
                                                    <option value="porhoras">Por horas</option>
                                                    <option value="pordiasdesemana">Por dias de Semana</option> 
                                                    <option value="pordiasdomes">Por dias do Mês</option> 
                                            </select>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Em que mês</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <div class="form-group">
                      <select name="anodecomparacao"  class="form-control" title="Escolha aqui o ano"  >
                          <option <?php $anoactual=date('Y'); if($anoactual==2020) { ?> selected="" <?php }?> value=2020>2020</option>
                          <option <?php if($anoactual==2021) { ?> selected="" <?php }?> value=2021>2021</option>
                          <option <?php if($anoactual==2022) { ?> selected="" <?php }?> value=2022>2022</option>
                          <option <?php if($anoactual==2023) { ?> selected="" <?php }?> value=2023>2023</option>
                          <option <?php if($anoactual==2024) { ?> selected="" <?php }?> value=2024>2024</option>
                          <option <?php if($anoactual==2025) { ?> selected="" <?php }?> value=2025>2025</option>
                          <option <?php if($anoactual==2026) { ?> selected="" <?php }?> value=2026>2026</option>
                          <option <?php if($anoactual==2027) { ?> selected="" <?php }?> value=2027>2027</option>
                      </select>
                    </div> 
                    
                     
                    <div class="form-group">
                          <select name="mesdecomparacao"  class="form-control">
                          <option <?php $mesactual=date('m'); if($mesactual==1) { ?> selected="" <?php }?> value="01">Janeiro</option>
                              <option <?php if($mesactual==2) { ?> selected="" <?php }?> value="02">Fevereiro</option>
                              <option <?php if($mesactual==3) { ?> selected="" <?php }?> value="03">Marco</option>
                              <option <?php if($mesactual==4) { ?> selected="" <?php }?> value="04">Abril</option>
                              <option <?php if($mesactual==5) { ?> selected="" <?php }?> value="05">Maio</option>
                              <option <?php if($mesactual==6) { ?> selected="" <?php }?> value="06">Junho</option>
                              <option <?php if($mesactual==7) { ?> selected="" <?php }?> value="07">Julho</option>
                              <option <?php if($mesactual==8) { ?> selected="" <?php }?> value="08">Agosto</option>
                              <option <?php if($mesactual==9) { ?> selected="" <?php }?> value="09" >Setembro</option>
                              <option <?php if($mesactual==10) { ?> selected="" <?php }?> value="10">Outubro</option>
                              <option <?php if($mesactual==11) { ?> selected="" <?php }?> value="11">Novembro</option>
                              <option <?php if($mesactual==12) { ?> selected="" <?php }?> value="12">Dezembro</option> 
                          </select>
                          <br> 
                          
                    </div>
                                        </div>
                                        </div> 
                                </div>
                                </div>
                            </div>
                        </div>
                        
                      </div>
                      <input type="submit" value="Fazer Comparação" name="comparar" class="btn btn-success" style="float: rigth;">
                        </form> 


                 
      <!-- End of Main Content -->

 
         </div>
         </div>

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
