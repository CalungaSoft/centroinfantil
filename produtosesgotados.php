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

 

if(isset($_POST['cadastrar'])){
  $produto= $_POST['produto'];
  $preco= $_POST['preco'];
  $quantidade= $_POST['quantidade'];
  $categoria= $_POST['categoria']; 
  $datadeexpiracao= $_POST['datadeexpiracao']; 

  $verificarcategoria=mysqli_num_rows(mysqli_query($conexao,"SELECT idcategoria FROM categorias where nomedacategoria='$categoria'"));
  if($verificarcategoria==0){ 
    $inserir= mysqli_query($conexao,"INSERT INTO `categorias` (`nomedacategoria`) VALUES ('$categoria')");
  }
  $categoria=mysqli_fetch_array(mysqli_query($conexao,"SELECT idcategoria FROM categorias where nomedacategoria='$categoria'"))[0];
  $salvar= mysqli_query($conexao,"INSERT INTO `produtos` (`idproduto`, `nomedoproduto`, `preco`, `quantidade`, `data`, `idcategoria`, `datadeexpiracao`) VALUES (NULL, '$produto', '$preco', '$quantidade', CURRENT_TIMESTAMP, '$categoria',STR_TO_DATE('$datadeexpiracao', '%d/%m/%Y'))");
   
  
if(!$salvar){
  echo "Ocorreu um ERRO, verifique se todos os campos foram devidamente preenchidos!";
  
}else{
  header('Location: tabeladeprecos.php');
};

}

$cardeeditar="";

if(isset($_GET['idmaterial'])){ 
  $idmaterial=$_GET['idmaterial'];
  $cardeeditar="aberto";
  $materialasereditado=mysqli_fetch_array(mysqli_query($conexao, "select * from materiais where idmaterial='$idmaterial'")); 

}


if(isset($_POST['salvaredicao'])){ 
  $idmaterial=$_POST['idmaterial'];
  $tipodematerial=$_POST['tipodematerial'];
  $preco=$_POST['preco'];
  $quantidade=$_POST['quantidade']; 
  $marcas=$_POST['marcas']; 
  $editando=mysqli_query($conexao, "UPDATE `materiais` SET `tipodematerial` = '$tipodematerial', `preco` = '$preco', `quantidade` = '$quantidade', `marcas` = '$marcas', `data` = CURRENT_TIMESTAMP  WHERE `materiais`.`idmaterial` = '$idmaterial'"); 

  if($editando){
    header("location:tabeladeprecos.php");
  }
}

if(isset($_GET['eliminarmaterial'])){ 
  $idmaterial=$_GET['idmaterialeliminar']; 
  $editando=mysqli_query($conexao, "DELETE FROM `materiais`WHERE `materiais`.`idmaterial` = '$idmaterial'"); 

  if($editando){
    header("location:tabeladeprecos.php");
  }
}

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php

$totaldeprodutos=mysqli_num_rows(mysqli_query($conexao, "select idproduto FROM produtos where (produtos.quantidade=0 or produtos.quantidade<0)")); 

?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Produtos com o Stock esgotado  | <?php echo $totaldeprodutos; 
 if($totaldeprodutos==0){$totaldeprodutos=0.00000001;} ?></h1>
          <p class="mb-4">A seguir vai a lista de Produtos</p>
   <!-- Content Row -->
 
 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabela de Produtos</h6>
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
                      <th title="Total de vezes em que o produto foi vendido">Nº de Vendas</th>
                      <th title="Valor que esse produto já agregou para a empresa">Valor Agregado</th> 
                      <th title="Valor em dívida relacionado com esse produto">Dívida</th> 
                      <th>Actualizada em</th>   
                    </tr>
                  </thead>
                  <tbody>
        <?php
                 
                  
                    $listademateriais=mysqli_query($conexao, "select produtos.* from produtos where (produtos.quantidade=0 or produtos.quantidade<0)"); 
               
                  


                   while($exibir = $listademateriais->fetch_array()){

                    $idproduto=$exibir['idproduto']; 
  
                    $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valorpago) FROM compra where idproduto='$idproduto'"))[0]+0; 
                    $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(preco*quantidade-valorpago) FROM compra where idproduto='$idproduto'"))[0]+0; 
                    $numerodecompras=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade) FROM compra where idproduto='$idproduto'"))[0]; 
             

        ?>
                    <tr>
                      <td><a href="produto.php?idproduto=<?php echo $exibir['idproduto']; ?>"><?php echo $exibir['nomedoproduto']; ?></a></td>
                      <td><?php echo $exibir['preco']; ?></td>
                      <td><?php echo $exibir['quantidade']; ?></td>     
                      <td><?php echo $exibir['datadeexpiracao']; ?></td>   
                      <td><?php echo $numerodecompras; ?></td>
                      <td title="<?php $n=number_format($valoragregado,2,",", ".");  echo $n; ?>"><?php echo $valoragregado; ?></td>
                      <td title="<?php $n=number_format($valoremdivida,2,",", ".");  echo $n; ?>"><?php echo $valoremdivida; ?></td>
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
