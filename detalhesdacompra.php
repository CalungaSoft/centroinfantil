<?php 
include("conexao.php");

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}


 
$idcompra=isset($_GET['idtipo'])?$_GET['idtipo']:"";
$idcompra=mysqli_escape_string($conexao, $idcompra); 

$idaluno=isset($_GET['idaluno'])?$_GET['idaluno']:"";
$idaluno=mysqli_escape_string($conexao, $idaluno); 

 
if(isset($_POST['editardadosdacompra'])){

    $obs=mysqli_escape_string($conexao, trim($_POST['obs']) );  

    $actualizando=mysqli_query($conexao, "UPDATE `compras` SET `obs` = '$obs' WHERE idcompra = '$idcompra'");
 
 
        if($actualizando){

            $acerto[]="Alterações feitas com sucesso!";
        
        }else{
        
        $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente";
        
        } 
  }

        include("cabecalho.php") ; ?>

<?php
                                      $obs=mysqli_fetch_array(mysqli_query($conexao," SELECT obs FROM compras where idcompra='$idcompra' "))[0];
                                      $dadosdacompraentrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where idtipo='$idcompra' and tipo='Material Escolar' "));
                                      $idaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT idaluno FROM compras where idcompra='$idcompra' "))[0];
                                      $dodosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM alunos where idaluno='$idaluno' "));
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Compra |<a href="aluno.php?idaluno=<?php echo $idaluno; ?>"><?php echo $dodosdoaluno["nomecompleto"]; ?> </a> </h1>

             | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=<?php echo "$dadosdacompraentrada[identrada]";?>'> Imprimir Recibo Geral</a>
              
<br><br>

          <div class="col-lg">
          <?php if($idaluno!=1){?>  
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do aluno</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Observações</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dodosdoaluno["idaluno"] ; ?>"><?php echo $dodosdoaluno["nomecompleto"] ; ?></a></div>
                                                <p id="mostra"> 

                         
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

                                               
                                                <br> <?php echo $obs; ?> <br> 







                                                
                                                    <?php  include("estilocarde.php"); ?>
                                                <button id="myBtn" class="btn btn-primary">Editar Observação</button>  
                                                <div id="myModal" class="modal">
                                                    <div class="modal-content">
                                                    <span id="close">&times;</span>
                                                    <form action="" method="post">
                                                                <br>
                                                                <div class="form-group">
                        <span>Observações</span>
                        <input type="text" name="obs" class="form-control" title="Altere o que desejas na observação" value="<?php echo $obs; ?> ">
                        </div> 
                                
                            <br>
                        <input type="submit" value="Guardar Alterações" name="editardadosdacompra" class="btn btn-success" style="float: rigth;">
                

            </form>
            </div>
        </div>
    


                            <script>
                                var btn=document.getElementById("myBtn");
                                    var modal=document.getElementById("myModal");

                                    var span=document.getElementById("close");

                                
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

                                </script>
                




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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data e Descrição</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1">  

                                        <br> 
                                   
                                             	Data:    <?php echo $dadosdacompraentrada["datadaentrada"]; ?><br>
                                              	Descrição:  <?php echo $dadosdacompraentrada["descricao"]; ?> <br>
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
      <?php } ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Histórico de compras do aluno</h6>
            </div>
            <div class="card-body">
            <span id="mensagemdealerta"></span> 
            DICA: clique no valor do preço, quantidade, desconto ou valor pago para mudar os seus respectivos valores.
            <br><br> 
            <div class="form-group">
                     <span>Forma de Pagamento</span>
                      <select id="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                      <option disabled="">Formas de Pagamentos</option>
                      <?php
                          $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                          while($exibir = $formasdepagamento->fetch_array()){ ?>
                          <option value="<?php echo $exibir['formadepagamento']; ?>"><?php echo $exibir['formadepagamento']; ?> </option>
                        <?php } ?> 
                    </select> 
       
                    </div> 
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Produto</th>  
                      <th>Preço</th>
                      <th title="Quantidade do produto em stock">Qtd</th> 
                      <th title="Quantidade total que já foi entregue ao paciente">Entregue</th>
                      <th>SubTotal</th>    
                      <th title="Desconto">Desc.</th>  
                      <th>Total</th>    
                      <th>Pago</th>    
                      <th title="Valor em dívida relacionado com esse produto">Dívida</th>  
                      <th>Eliminar</th>    
                    </tr>
                  </thead>
                  <tbody>
        <?php     $totalpreco=0;
                  $valorpago=0;
                  $totaldivida=0;
                  $totaldesubtotal=0;
                  $totaldesconto=0;
                  $totaltotal=0;
                  
                    $listademateriais=mysqli_query($conexao, "select produtos.nomedoproduto, compra.* from compra, produtos where compra.iddacompra='$idcompra' and compra.idproduto=produtos.idproduto order by data desc"); 
                
                  
                 
                   while($exibir = $listademateriais->fetch_array()){

                    $idproduto=$exibir['idproduto']; 
   
                    $totalpreco+=$exibir['preco'];
                    $valorpago+=$exibir['valorpago'];
                    $divida=$exibir['preco']*$exibir['quantidade']-$exibir['valorpago']-$exibir['desconto'];
                    $totaldivida+=$divida;

                    $desconto=$exibir['desconto'];
                    $totaldesconto+=$desconto;
                    $subtotal=$exibir['preco']*$exibir['quantidade'];
                    $total=$subtotal-$desconto;
                    $totaltotal+=$total;
                    $totaldesubtotal+=$subtotal;
        ?>
                    <tr>
                      <td><a href="produto.php?idproduto=<?php echo $exibir['idproduto']; ?>"><?php echo $exibir['nomedoproduto']; ?></a></td> 
                      <td><?php echo $exibir['preco']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idcompra"]; ?>" data-column="quantidade"  contenteditable ><?php echo $exibir['quantidade']; ?></td>  
                      <td class="update" data-id="<?php echo $exibir["idcompra"]; ?>" data-column="entregue"  contenteditable ><?php echo $exibir['entregue']; ?></td>  
                      <td title="<?php $n=number_format($subtotal,2,",", ".");  echo $n; ?>"><?php echo $subtotal; ?></td>
                      <td  class="update" data-id="<?php echo $exibir["idcompra"]; ?>" data-column="desconto"  contenteditable title="<?php $n=number_format($desconto,2,",", ".");  echo $n; ?>"><?php echo $desconto; ?></td>
                      <td title="<?php $n=number_format($total,2,",", ".");  echo $n; ?>"><?php echo $total; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idcompra"]; ?>" data-column="valor"  contenteditable  title="<?php $n=number_format($exibir['valorpago'],2,",", ".");  echo $n; ?>"><?php echo $exibir['valorpago']; ?></td>
                      <td title="<?php $n=number_format($divida,2,",", ".");  echo $n; ?>"><?php echo $divida; ?></td>
                      <td>
                      <a href="" class="delete" id="<?php echo $exibir["idcompra"]; ?>" ><i style="color:red" title="Eliminar essa Entrada" class="fas fa-trash"></i></a>
                      </td>  
 </tr>
                  <?php } ?> 
                  </tbody>
                  <tfoot>
                      <th>Total</th>  
                      <th><?php $n=number_format($totalpreco,2,",", ".");  echo $n; ?></th> 
                      <th ></th> 
                      <th ></th> 
                      <th><?php $n=number_format($totaldesubtotal,2,",", ".");  echo $n; ?></th> 
                      <th><?php $n=number_format($totaldesconto,2,",", ".");  echo $n; ?></th>
                      <th><?php $n=number_format($totaltotal,2,",", ".");  echo $n; ?></th> 
                      <th><?php $n=number_format($valorpago,2,",", ".");  echo $n; ?></th> 
                      <th><?php $n=number_format($totaldivida,2,",", ".");  echo $n; ?></th> 
                      <th></th>  
                  </tfoot>
                </table>











                <br><br><br>

                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Funcionário</th>
                      <th>Descrição</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Data</th> 
                      <th>F. de Pagamento</th>  
                    </tr>
                  </thead> 
                  <tbody>
                  
                     <?php
                     
                       

                          $registrosdeentrada=mysqli_query($conexao, "select YEAR(entradas.datadaentrada) as ano, funcionarios.nomedofuncionario, entradas.* from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario and idtipo='$idcompra' and tipo='Material Escolar' order by datadaentrada desc"); 
 
                       

                      $totalentradas=0;
                      $totademdivida=0;
                      while($exibir = $registrosdeentrada->fetch_array()){
                            
                        
                        
                      
                     
                     ?>
                      
                    <tr>
                    <td> <a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?> </a></td>
                    <td ><?php echo $exibir["descricao"]; ?></td> 
                     
                      <td ><?php  $totalentradas=$totalentradas+$exibir["valor"];  $n=number_format($exibir["valor"],2,",", "."); echo $exibir["valor"]; ?></td>
                      <td><?php $totademdivida=$totademdivida+$exibir["divida"];  $n=number_format($exibir["divida"],2,",", "."); echo $exibir["divida"]; ?></td>
                      <td><?php echo $exibir["datadaentrada"]; ?></td> 
                      <td><?php echo $exibir["formadepagamento"]; ?></td>  

                    

                    </tr> 
                    </tr>
                    <?php  } ?>
                    </tbody>
                 
                </table>

                <a href="" class="btn btn-danger deletevenda" id="<?php echo $idcompra; ?>" ><i style="color:white" title="Eliminar todos os dados dessa venda, incluíndo a própria venda" class="fas fa-trash"></i>ELIMINAR VENDA</a>
          
              </div>
            </div>
          </div>


   
            <!-- Collapsable Card Example -->

            <script>
            
                                                          $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deleteentrada.php',
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


                                                            $(document).on("click", ".deletevenda", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletevenda.php',
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

                                                            $(document).on("blur", ".update", function(){
                                                                var id=$(this).data("id");
                                                                var nomedacoluna=$(this).data("column");
                                                                var valor=$(this).text();
                                                                var formadepagamento=$("#formadepagamento option:selected").val();
                                            

                                                                $.ajax({
                                                                    url:'cadastro/updatevenda.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id, 
                                                                        nomedacoluna:nomedacoluna,
                                                                         valor:valor,
                                                                         formadepagamento:formadepagamento
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                                    }

                                                                })
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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
