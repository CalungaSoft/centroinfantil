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
$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
    

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

if(isset($_POST['cadastrar'])){

  if(!empty(trim($_POST['produto']))){ 

        $produto=mysqli_escape_string($conexao,  $_POST['produto']);
        $preco=mysqli_escape_string($conexao,  $_POST['preco']);
        $precodecompra=mysqli_escape_string($conexao,  $_POST['precodecompra']);
        $quantidade=mysqli_escape_string($conexao,  $_POST['quantidade']); 
        $stockminimo=mysqli_escape_string($conexao,  $_POST['stockminimo']);
        $datadeexpiracao=mysqli_escape_string($conexao,  $_POST['datadeexpiracao']);

      

        $produtoigual=mysqli_num_rows(mysqli_query($conexao,"SELECT idproduto FROM produtos where nomedoproduto='$produto'"));
        if($produtoigual==0){
            
          $salvar= mysqli_query($conexao,"INSERT INTO `produtos` (`idproduto`, `nomedoproduto`, `preco`,`precodecompra`, `quantidade`, `data`,  `datadeexpiracao`, `stockminimo`) VALUES (NULL, '$produto', '$preco','$precodecompra', '$quantidade', CURRENT_TIMESTAMP, STR_TO_DATE('$datadeexpiracao', '%d/%m/%Y'), '$stockminimo')");
           
            if($salvar){
              $idprodutonostock=mysqli_fetch_array(mysqli_query($conexao,"SELECT idproduto FROM produtos where nomedoproduto='$produto' limit 1"))[0];

              $guardandonostock= mysqli_query($conexao,"INSERT INTO `stock` (`idstock`, `idproduto`, `precodevenda`, `precodecompra`, `quantidade`, `datadecadastro`) VALUES (NULL, '$idprodutonostock', '$preco', '$precodecompra', '$quantidade', CURRENT_TIMESTAMP)");

                    if($salvar){

                      $acerto[]=" produto $produto, cadastrado com sucesso";
        
                    }else{
        
                      $erros[]="Ocorreu um erro Ao cadastrar o  produto, tente novamente";
        
                    }

            }else{
              $erros[]="Ocorreu um erro Ao cadastrar o  produto, tente novamente";
            }
            

        
        }else{
          $erros[]="Já Existe um produto com o mesmo nome! Por Favor acrescente alguma palavra ou sigla para o diferenciar!";
        }
 
  }else{
    $erros[]="O campo nome do produto não pode estar vazio!";
  }
}

$cardeeditar="";
 

 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

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




<?php

$totaldeprodutos=mysqli_num_rows(mysqli_query($conexao, "select idproduto FROM produtos")); 

?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Produtos da Escola  <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> | <?php echo $totaldeprodutos; 
 if($totaldeprodutos==0){$totaldeprodutos=0.00000001;} ?></h1>
          <p class="mb-4">A seguir vai a lista de Produtos na Escola</p>
 
          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o mês</button>
    <?php if($painellogado=="administrador"){ ?>
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma entrada">Cadastrar Produto</button>
    <?php  } else{?> 
    <span  id="myBtnreclamacoes"></span>
    <?php } ?>
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">
                      <select name="anodevenda"  class="form-control" title="Escolha aqui o ano"  >
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
                          <select name="mesdevenda"  class="form-control">
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
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                    </div>

          </form>
        </div>
    </div>
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form class="user" method="post" action=""> 
          <h2>Cadastrando Produto Novo</h2>
          <span style="font-size: 11px">OBS: Não cadastre produtos com nomes iguais, ponha sempre uma referência para os diferenciar </p>
                    <div class="form-group">
                    <input type="text" autocomplete="off" list="datalist1" name="produto" class="form-control "  title="Digite o nome do  produto" placeholder="Nome do  produto">
                              <datalist id="datalist1">
                                <?php
                                    $listadeprodutos=mysqli_query($conexao, "select * from produtos"); 
                                  while($exibir = $listadeprodutos->fetch_array()){ ?>
                                  <option value="<?php echo $exibir['nomedoproduto'];?>"> 
                                <?php } ?>  
                              </datalist>

                    </div> 
                    <div class="form-group">
                      <input type="number" name="precodecompra" class="form-control"  title="Digite o preço de compra do produto" placeholder="Preço de compra">
                    </div> 
                    <div class="form-group">
                      <input type="number" name="preco" class="form-control"  title="Digite o preço a ser pago pelo produto" placeholder="Preço de venda">
                    </div> 
                    <div class="form-group">
                      <input type="text" name="datadeexpiracao" class="form-control js-datepicker" title="Digite a data em que o produto expira" placeholder="Data de Expiração">
                    </div>
                    <div class="form-group">
                      <input type="number" name="quantidade" class="form-control"  title="Digite a quantidade em stock do produto" placeholder="Quantidade">
                    </div> 
               

                    <div class="form-group">
                      <input type="number" name="stockminimo" class="form-control"  title="Digite o stock mínimo do  produto para ser avisado quando estiver preste a terminar a quantidade em stock" placeholder="Sctock Mínimo">
                    </div> 

                    <br>
                       <input type="submit" name="cadastrar" value="Cadastrar  produto" class="btn btn-primary" style="float: rigth;">
                    
          </form>
        </div>
    </div>
    
    
                <script>
                    var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes");

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");

                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }

                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                  </script>

<br><br>  

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabela de preços</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Produto</th> 
                      <th>Preço</th>
                      <th title="Quantidade do produto em stock">quantidade</th>
                      <th title="Quantidade do produto que já foram comprados mas que ainda não foi entregue ao paciente">Não-Entregue</th>  
                      <th>Expiração</th> 
                      <?php if($painellogado=="administrador"){ ?>
                      <th title="Total de vezes em que o produto foi vendido">Nº de Vendas</th>
                      <th title="Valor que esse produto já agregou para a empresa">Valor Agregado</th> 
                      <?php  } ?>
                      <th title="Total de desconto relacionado com esse produto">Descontos</th>  
                      <th title="Valor em dívida relacionado com esse produto">Dívida</th>  
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
                  $totaldesconto=0;
                  if(!isset($_GET['categoria'])){
                    $listademateriais=mysqli_query($conexao, "select produtos.* from produtos"); 
               
                  } else
                
                  if(isset($_GET['categoria'])){
                    $listademateriais=mysqli_query($conexao, "select produtos.*, categorias.nomedacategoria from produtos, categorias where produtos.idcategoria=categorias.idcategoria and produtos.idcategoria='$categoria'"); 
                  }  

                  
                 
                   while($exibir = $listademateriais->fetch_array()){

                    $idproduto=$exibir['idproduto']; 
  
                   
                    if(!isset($_GET['mesdevenda'])){
                      $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valorpago) FROM compra where idproduto='$idproduto'"))[0]+0; 
                      $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(preco*quantidade-valorpago-desconto) FROM compra where idproduto='$idproduto'"))[0]+0; 
                      $numerodecompras=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade) FROM compra where idproduto='$idproduto'"))[0]; 
                      $naoentregue=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade-entregue) FROM compra where idproduto='$idproduto'"))[0]; 
                      $desconto=mysqli_fetch_array(mysqli_query($conexao, "select sum(desconto) FROM compra where idproduto='$idproduto'"))[0]; 
                   
                    } else {

                      $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valorpago) FROM compra where idproduto='$idproduto' and '$anodevenda'=YEAR(data) AND '$mesdevenda'=MONTH(data)"))[0]+0; 
                      $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(preco*quantidade-valorpago-desconto) FROM compra where idproduto='$idproduto' and '$anodevenda'=YEAR(data) AND '$mesdevenda'=MONTH(data)"))[0]+0; 
                      $numerodecompras=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade) FROM compra where idproduto='$idproduto' and '$anodevenda'=YEAR(data) AND '$mesdevenda'=MONTH(data)"))[0]; 
                      $naoentregue=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade-entregue) FROM compra where idproduto='$idproduto' and '$anodevenda'=YEAR(data) AND '$mesdevenda'=MONTH(data)"))[0]; 
                      $desconto=mysqli_fetch_array(mysqli_query($conexao, "select sum(desconto) FROM compra where idproduto='$idproduto' and '$anodevenda'=YEAR(data) AND '$mesdevenda'=MONTH(data)"))[0]; 
                 
                      
                    }  

                    $totalpreco+=$exibir['preco'];
                    $totalagregado+=$valoragregado;
                    $totaldivida+=$valoremdivida;
                    $totaldecompras+=$numerodecompras;
                    $totaldesconto+=$desconto; 
                 
        ?>
                    <tr>
                      <td><a href="produto.php?idproduto=<?php echo $exibir['idproduto']; ?>"><?php echo $exibir['nomedoproduto']; ?></a></td>
                      <td><?php echo $exibir['preco']; ?></td>
                      <td><?php echo $exibir['quantidade']; ?></td> 
                      <td><?php echo $naoentregue; ?></td>    
                      <td><?php echo $exibir['datadeexpiracao']; ?></td> 
                      <?php if($painellogado=="administrador"){ ?>  
                      <td><?php echo $numerodecompras; ?></td>
                      <td title="<?php $n=number_format($valoragregado,2,",", ".");  echo $n; ?>"><?php echo $valoragregado; ?></td>
                      <?php } ?>
                      <td title="<?php $n=number_format($desconto,2,",", ".");  echo $n; ?>"><?php echo $desconto; ?></td>
                      <td title="<?php $n=number_format($valoremdivida,2,",", ".");  echo $n; ?>"><?php echo $valoremdivida; ?></td>
                      <td><?php echo $exibir['data']; ?></td> 
                    </tr>
                  <?php } ?>
                  <?php if($painellogado=="administrador"){ ?>
                  <thead>
                  <tr>
                      <td><strong>Total</strong></td>
                      <td><strong></strong></td>
                      <td></td>   
                      <td></td>  
                      <td></td>     
                      <td><strong><?php echo $totaldecompras; ?></strong></td>
                      <td ><strong><?php $n=number_format($totalagregado,2,",", ".");  echo $n; ?></strong></td>
                      <td ><strong><?php $n=number_format($totaldesconto,2,",", ".");  echo $n; ?></strong></td>
                      <td ><strong><?php $n=number_format($totaldivida,2,",", ".");  echo $n; ?></strong></td>
                      <td></td> 
                    </tr>
                  </thead>
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
