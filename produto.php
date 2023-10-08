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

 
 if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}



$idproduto= $_GET['idproduto'];

if(isset($_POST['editardadosdoproduto'])){

  if(!empty(trim($_POST['nomedoproduto']))){ 

  $nomedoproduto=mysqli_escape_string($conexao,  $_POST['nomedoproduto']);  
  $preco=mysqli_escape_string($conexao,  $_POST['preco']);  
  $precodecompra=mysqli_escape_string($conexao,  $_POST['precodecompra']);   
  $stockminimo=mysqli_escape_string($conexao,  $_POST['stockminimo']);
  $datadeexpiracao=mysqli_escape_string($conexao,  $_POST['datadeexpiracao']);  
  $estatus=mysqli_escape_string($conexao,  $_POST['estatus']);
  
    $produtoigual=mysqli_num_rows(mysqli_query($conexao,"SELECT idproduto FROM produtos where nomedoproduto='$nomedoproduto' and idproduto!='$idproduto'"));
    if($produtoigual==0){

      $salvar= mysqli_query($conexao,"UPDATE `produtos` SET `nomedoproduto` = '$nomedoproduto', `preco` = '$preco', `precodecompra` = '$precodecompra', `datadeexpiracao` = '$datadeexpiracao', `estatus` = '$estatus', `stockminimo` = '$stockminimo' WHERE `produtos`.`idproduto` = '$idproduto'");
     
        if($salvar){

          $acerto[]=" produto $nomedoproduto, actualizado com sucesso";

        }else{

          $erros[]="Ocorreu um erro Ao cadastrar o  produto, tente novamente";

        }
    }else{
      $erros[]="Já Existe outro produto com o mesmo nome! Por Favor acrescente alguma palavra ou sigla para o diferenciar!";
    }
  }else{

    $erros[]="O campo nome do produto não pode estar vazio!";

  }
  }


  
if(isset($_POST['aumentar'])){
 

     
        $preco=mysqli_escape_string($conexao,  $_POST['preco']);
        $precodecompra=mysqli_escape_string($conexao,  $_POST['precodecompra']);
        $quantidade=mysqli_escape_string($conexao,  $_POST['quantidade']); 

     if($quantidade>0){
          $guardandonostock= mysqli_query($conexao,"INSERT INTO `stock` (`idstock`, `idproduto`, `precodevenda`, `precodecompra`, `quantidade`, `datadecadastro`) VALUES (NULL, '$idproduto', '$preco', '$precodecompra', '$quantidade', CURRENT_TIMESTAMP)");

          if($guardandonostock){

            $salvar= mysqli_query($conexao,"UPDATE `produtos` SET preco='$preco', precodecompra='$precodecompra', `quantidade` =`quantidade`+'$quantidade'  WHERE `produtos`.`idproduto` = '$idproduto'");
                if($salvar){

                  $acerto[]="Quantidade do produto aumentado com sucesso";
    
                }else{
    
                  $erros[]="Ocorreu um erro Ao aumentar a quantidade de produto no stock, tente novamente";
    
                }
          }else{

            $erros[]="Ocorreu um erro Ao aumentar a quantidade de produto no stock, tente novamente";

          }
      }else{
        $erros[]="A quantidade deve ser sempre maior que zero";
      }
            
                   
 
            
 
 
}



if(isset($_POST['reduzir'])){
  
  $quantidade=mysqli_escape_string($conexao,  $_POST['quantidade']); 
  $quantidademaxima=mysqli_escape_string($conexao,  $_POST['quantidademaxima']); 



if($quantidade<$quantidademaxima || $quantidademaxima==$quantidade){
  
      $salvar= mysqli_query($conexao,"UPDATE `produtos` SET `quantidade` =`quantidade`-'$quantidade'  WHERE `produtos`.`idproduto` = '$idproduto'");

  $dadosdoproduto=mysqli_fetch_array(mysqli_query($conexao," SELECT produtos.* FROM produtos  where produtos.idproduto='$idproduto' "));
  $preco=$dadosdoproduto['preco'];
  $precodecompra=$dadosdoproduto['precodecompra'];
  $quantidade=(-1)*$quantidade;


     $guardandonostock= mysqli_query($conexao,"INSERT INTO `stock` (`idstock`, `idproduto`, `precodevenda`, `precodecompra`, `quantidade`, `datadecadastro`) VALUES (NULL, '$idproduto', '$preco', '$precodecompra', '$quantidade', CURRENT_TIMESTAMP)");

          if($salvar){

            $acerto[]="Quantidade do produto Diminuída com sucesso";

          }else{

            $erros[]="Ocorreu um erro Ao diminuir a quantidade de produto no stock, tente novamente";

          }
  
}else{
  $erros[]="Esse produto só lhe restam $quantidademaxima Unidades, então não podes reduzir $quantidade Unidades";
}
      
             

      


}


include("cabecalho.php") ; ?>

<?php
                                      $dadosdoproduto=mysqli_fetch_array(mysqli_query($conexao," SELECT produtos.* FROM produtos  where produtos.idproduto='$idproduto' "));
                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Produto</h1>
     
          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
          
            if(!empty($acerto)):
                        foreach($acerto as $acerto):
                          echo '<div class="alert alert-success">'.$acerto.'</div>';
                        endforeach;
                      endif;
            ?>
                    <?php if($painellogado=="administrador"){ ?>
 <button id="myBtn" class="btn btn-primary">Aumentar o Stock</button> 
                               
    <button id="myBtnreclamacoes" class="btn btn-info">Reduzir o Stock</button>
                    <?php } ?>
<?php  include("estilocarde.php"); ?>

<div id="myModal" class="modal"  >
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" method="post" action="">  
            <h3>Aumentando o Stock</h3>
            
            <div class="form-group">
                  <input type="number" name="quantidade" class="form-control"  title="Digite a quantidade em stock do produto" placeholder="Quantidade a Aumentar" required="">
                </div>    
                <div class="form-group">
                  <input type="number" name="precodecompra" class="form-control"  title="Digite o preço de compra do produto" placeholder="Preço de compra" required="">
                </div> 
                <div class="form-group">
                  <input type="number" name="preco" class="form-control"  title="Digite o preço a ser pago pelo produto" placeholder="Preço de venda" required="">
                </div>  
 

                <br>
                   <input type="submit" name="aumentar" value="Aumentar Stock" class="btn btn-primary" style="float: rigth;">
                
      </form>
    </div>
</div>


 
                 
<div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="post">
          <h3>Reduzindo a quantidade em Stock</h3>
                      <br>
                      <div class="form-group">
                            <input type="number" name="quantidade" class="form-control"  title="Digite a quantidade em stock do produto" placeholder="Quantidade a Reduzir" required="">
                       </div>  <br>
                       <input type="hidden" name="quantidademaxima" value="<?php echo $dadosdoproduto["quantidade"]; ?>">
                       OBS: Escolha um valor de 1 à   <?php echo $dadosdoproduto["quantidade"] ; ?> <br>
                       Essa Acção não afetará o histórico do stock
                       <input type="submit" value="Reduzir a quantidade em stock" name="reduzir" class="btn btn-success" style="float: rigth;">
            

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
              <br> <br>


          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do produto</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">produto</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="produto.php?idproduto=<?php echo $dadosdoproduto["idproduto"] ; ?>"><?php echo $dadosdoproduto["nomedoproduto"] ; ?></a></div>
                                                <p id="mostra"> 

                                                <br> 	Preço de compra:  <?php echo $dadosdoproduto["precodecompra"]; ?>KZ <br>
                                                	Preço de venda:  <?php echo $dadosdoproduto["preco"]; ?>KZ <br>
                                                  
                                                 	Expiração:  <?php echo $dadosdoproduto["datadeexpiracao"]; ?> <br>
                                                 	Data de Cadastro:  <?php echo $dadosdoproduto["data"]; ?> <br>

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
                                                        <span>Nome</span>
                                                      <input type="text" name="nomedoproduto" class="form-control"  title="Digite o nome  do produto" value="<?php echo $dadosdoproduto["nomedoproduto"];  ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                    <span>Preço de Compra</span>
                                                      <input type="number" name="precodecompra" class="form-control"  title="Digite o preço de compra do produto" value="<?php echo $dadosdoproduto["precodecompra"];  ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                    <span>Preço de venda</span>
                                                      <input type="number" name="preco" class="form-control"  title="Digite o preço a ser pago pelo produto" value="<?php echo $dadosdoproduto["preco"];  ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                    <span>Data de Expiração</span>
                                                      <input type="text" name="datadeexpiracao" class="form-control" title="Digite a data em que o produto expira" value="<?php echo $dadosdoproduto["datadeexpiracao"];  ?>">
                                                    </div>  
                                                    <div class="form-group">
                                                    <span>Estatus</span>
                                                      <input type="text" name="estatus" class="form-control"  title="Estatus: ex. Operacional, " value="<?php echo $dadosdoproduto["estatus"];  ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                    <span>Stock mínimo</span>
                                                      <input type="number" name="stockminimo" class="form-control"  title="Digite o stock mínimo do  produto para ser avisado quando estiver preste a terminar a quantidade em stock" value="<?php echo $dadosdoproduto["stockminimo"];  ?>">
                                                    </div> 

                                                      <div class="form-group">
                                                          <input type="submit" name="editardadosdoproduto" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                                                      </div> 
                                  
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- Collapsable Card Example -->
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Histórico</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                           $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valorpago) FROM compra where idproduto='$idproduto'"))[0]+0; 
                                          $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(preco*quantidade-valorpago-desconto) FROM compra where idproduto='$idproduto'"))[0]+0; 
                                          $numerodecompras=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade) FROM compra where idproduto='$idproduto'"))[0]; 
                                          $quantidadenaoentregue=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade-entregue) FROM compra where idproduto='$idproduto'"))[0]; 
                                          $totalemdesconto=mysqli_fetch_array(mysqli_query($conexao, "select sum(desconto) FROM compra where idproduto='$idproduto'"))[0]; 


                                          $valoragregado=number_format($valoragregado,2,",", ".");
                                          $valoremdivida=number_format($valoremdivida,2,",", ".");
                                          $totalemdesconto=number_format($totalemdesconto,2,",", ".");

                                      ?>

                                        <br> 
                                          <?php if($painellogado=="administrador"){ ?>
                                            	Valor Agregado:  <?php echo $valoragregado; ?> KZ<br>
                                                                  <?php } ?>
                                             	Dívida:  <?php echo $valoremdivida; ?> KZ<br>
                                             	Total Descontado:  <?php echo $totalemdesconto; ?> KZ<br>
                                               <?php if($painellogado=="administrador"){ ?>
                                             	Nº de compras:  <?php echo $numerodecompras; ?> <br>  
                                             <?php } ?>
                                             	Quantidade Restante:  <?php echo $dadosdoproduto["quantidade"] ; ?> <br>  
                                             	Quantidade já comprada mas não entregue:  <?php echo $quantidadenaoentregue ; ?> <br>  
                                             	Stock Mínimo:  <?php echo $dadosdoproduto["stockminimo"] ; ?> <br>  
                                             	Estatus:  <?php echo $dadosdoproduto["estatus"] ; ?> <br>  
                                             <?php if($painellogado=="administrador"){ ?> <a href="historicodedepositos.php?idproduto=<?php echo "$idproduto"; ?>" id="myBtnreclamacoes" class=" btn btn-primary shadow-sm"><i class="fas fa-fw fa-table"></i> Ver Histórico de Stock</a>  <?php } ?>
                            
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
              <h6 class="m-0 font-weight-bold text-primary">Lista de Alunos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Nome</th>
                      <?php if($painellogado=="administrador"){ ?>
                      <th title="Valor que esse Aluno já agregou a esse produto">Valor Agregado</th>
                      <?php } ?>
                      <th title="Total de Desconto já feito para esse Aluno em relação a esse produto">Desconto</th> 
                      <th>Dívida</th> 
                      <th title="Número de vezes em que o Aluno comprou esse produto">Nº de Compras</th> 
                     
                  
                      <th title="Última vez que o Aluno comprou na Farmácia">Data</th> 
                      <th>Ver</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $idp="Calunga Esmael";
                  $listadeAlunos=mysqli_query($conexao,"SELECT compra.*, alunos.nomecompleto  FROM alunos, compra where compra.idaluno=alunos.idaluno  and compra.idproduto='$idproduto' order by compra.idaluno"); 
                   while($exibir = $listadeAlunos->fetch_array()){ 
                    $idaluno=$exibir['idaluno']; 
                    
                     

                    
                  
  
                    $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valorpago) FROM compra where compra.idproduto='$idproduto' and compra.idaluno='$idaluno' "))[0]+0; 
                    $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(quantidade*preco-valorpago-desconto) FROM compra where compra.idproduto='$idproduto'  and compra.idaluno='$idaluno'"))[0]+0; 
                    $numerodecompras=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM compra where idaluno='$idaluno' and compra.idproduto='$idproduto' ")); 
                    $totaldescontado=mysqli_fetch_array(mysqli_query($conexao, "select sum(desconto) FROM compra where compra.idproduto='$idproduto' and compra.idaluno='$idaluno' "))[0]+0; 
                    
             
                    
            ?>
                    <tr> 
                      <td><a href="aluno.php?idaluno=<?php echo $exibir['idaluno']; ?>"><?php echo $exibir['nomecompleto']; ?></a></td>
                      <?php if($painellogado=="administrador"){ ?>
                      <td title="<?php $n=number_format($valoragregado,2,",", ".");  echo $n; ?>KZ"><?php echo $valoragregado; ?></td>
                      <?php } ?>
                      <td title="<?php $n=number_format($totaldescontado,2,",", ".");  echo $n; ?>KZ"><?php echo $totaldescontado; ?></td>
                      <td title="<?php $n=number_format($valoremdivida,2,",", ".");  echo $n; ?>KZ"><?php echo $valoremdivida; ?></td>
                      <td><?php echo $numerodecompras; ?></td> 
                      <td><?php echo $exibir["data"]; ?></td> 
                      <td>  
                        <a href="detalhesdacompra.php?idcompra=<?php echo $exibir["iddacompra"]; ?>" ><i title="Visualizar essa Venda" class="fas fa-eye"></i></a>
                       
                        </td>
                   </tr> 
                   <?php }  ?>
                  </tbody>
                </table>
              </div>
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
