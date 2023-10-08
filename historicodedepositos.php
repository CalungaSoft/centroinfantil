<?php include("conexao.php");

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
     
$idproduto=isset($_GET['idproduto'])?$_GET['idproduto']:"";
$idproduto=mysqli_escape_string($conexao, $idproduto);


$nomedoproduto=mysqli_fetch_array(mysqli_query($conexao," SELECT produtos.nomedoproduto FROM produtos where produtos.idproduto='$idproduto'  "))[0];


include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Histórico de Depósito de Produtos <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['idproduto'])){ echo "($nomedoproduto)"; }?>   </h1>
          <p class="mb-4">Abaixo vai a lista de todos os Depósitos de produtos feitos até agora</p>
                       
 
          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o mês</button> 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                     <div class="form-group">

                                  <span>Ano</span>
                                    <select name="anodevenda" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadecadastro)) as ano from stock order by YEAR(datadecadastro) desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                                        <?php } ?> 
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

                            <?php   if(isset($_GET['idproduto'])){ ?> 
                                  <input type="hidden" name="idproduto" value="<?php echo $idproduto; ?>">
                            <?php } ?>
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                    </div>

          </form>
        </div>
    </div>
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
      
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
                    
                    <!-- Content Row -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Depósitos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Produto</th>
                      <th>Depósito</th>
                      <th>Quantidade</th>
                      <th title="Total na compra(Preço de compra vezes a quantidade)">Preço(Compra)</th> 
                      <th title="Total na venda(Preço de venda vezes a quantidade)">Preço(Venda)</th>
                      <th title="Lucro presumido (Total na venda - total na compra)">Lucro</th> 
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                    $somanacompra=0;
                    $somanavenda=0; 
                    $somanolucro=0;
  


                       
                      if(!isset($_GET['mesdevenda']) && !isset($_GET['idproduto']) ){  

                        $listadefuncionários=mysqli_query($conexao,"SELECT stock.*, produtos.nomedoproduto FROM stock, produtos where produtos.idproduto=stock.idproduto"); 

                      }else if(isset($_GET['mesdevenda']) && !isset($_GET['idproduto']) ){ 

                        $listadefuncionários=mysqli_query($conexao,"SELECT stock.*, produtos.nomedoproduto FROM stock, produtos where produtos.idproduto=stock.idproduto and '$anodevenda'=YEAR(datadecadastro) AND '$mesdevenda'=MONTH(datadecadastro)"); 

                      }else if(!isset($_GET['mesdevenda']) && isset($_GET['idproduto']) ){ 
                     
                        $listadefuncionários=mysqli_query($conexao,"SELECT stock.*, produtos.nomedoproduto FROM stock, produtos where produtos.idproduto=stock.idproduto  and stock.idproduto='$idproduto'"); 

                      }else if(isset($_GET['mesdevenda']) && isset($_GET['idproduto']) ) {
    
                        $listadefuncionários=mysqli_query($conexao,"SELECT stock.*, produtos.nomedoproduto FROM stock, produtos where produtos.idproduto=stock.idproduto and '$anodevenda'=YEAR(datadecadastro) AND '$mesdevenda'=MONTH(datadecadastro) and stock.idproduto='$idproduto'"); 
                      }

                   while($exibir = $listadefuncionários->fetch_array()){ 
                
                     $totalnacompra=$exibir['quantidade']*($exibir['precodecompra']);
                     $totalnavenda=$exibir['quantidade']*($exibir['precodevenda']);
                     $lucro=$exibir['quantidade']*($exibir['precodevenda']-$exibir['precodecompra']);

                     $somanacompra+=$totalnacompra;
                     $somanavenda+=$totalnavenda;
                     $somanolucro+=$lucro;
            ?>
                    <tr> 
                      <td><a href="produto.php?idproduto=<?php echo $exibir['idproduto']; ?>"><?php echo $exibir['nomedoproduto']; ?></a></td>
                      <td><?php echo $exibir['datadecadastro']; ?></td>
                      <td><?php echo $exibir['quantidade']; ?></td>  
                      <td title="Preço de compra x quantidade = Total na Compra: <?php $n=number_format($totalnacompra,2,",", ".");  echo $n; ?>KZ"><?php echo $exibir['precodecompra']; ?>x<?php echo $exibir['quantidade']; ?>=<?php echo $totalnacompra; ?></td>
                      <td title="Preço de venda x quantidade = Total Depois das Vendas: <?php $n=number_format($totalnavenda,2,",", ".");  echo $n; ?>KZ"><?php echo $exibir['precodevenda']; ?>x<?php echo $exibir['quantidade']; ?>=<?php echo $totalnavenda; ?></td>
                      <td title="Total de Lucro<?php $n=number_format($lucro,2,",", ".");  echo $n; ?>KZ"><?php echo $lucro; ?></td> 
                      <td><a href="" class="delete" id="<?php echo $exibir["idstock"]; ?>" ><i style="color:red" title="Eliminar esse depósito" class="fas fa-trash"></i></a></td>
                   </tr> 
                   <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr> 
                      <th>Total</th>
                      <th></th>
                      <th></th>  
                      <th <?php $n=number_format($somanacompra,2,",", ".");?>><?php echo $n; ?></th>
                      <th  <?php $n=number_format($somanavenda,2,",", ".");?>><?php echo $n; ?></th>
                      <th  <?php $n=number_format($somanolucro,2,",", ".");?>><?php echo $n; ?></th> 
                      <th></th>
                   </tr> 
                  </tfoot>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <script>
      
      
                                                             $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro?ATT: A quantidade depositada aqui reduzirá na quantidade do produto original")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletedeposito.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })

      
      
      </script>
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
