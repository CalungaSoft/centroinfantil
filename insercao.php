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

 


 
$identrada=isset($_GET['identrada'])?$_GET['identrada']:"";
$identrada=mysqli_escape_string($conexao, $identrada); 

$dados_da_entrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $tipo=$dados_da_entrada['tipo'];
                     $idtipo=$dados_da_entrada['idtipo'];
                     $idaluno=$dados_da_entrada['idaluno'];
                    
$nomedoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];


if(isset($_POST['cadastrar'])){

    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']) );  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']) );  
    $divida=mysqli_escape_string($conexao, trim($_POST['divida']) );    
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']) );    

     $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(divida) as divida FROM entradas where tipo='$tipo' and idtipo='$idtipo'"));

          $divida_antigo=$dados_do_pagamento['divida'];

          if(!($divida=='permanecer')){ 
            $divida=round(($divida_antigo-$valor),2);
          
          }else{

            $divida=$divida_antigo;
          }

          if($divida<0){
              $divida=0;
          }


           $zerando_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='0' WHERE tipo='$tipo' and idtipo='$idtipo'");

             if($zerando_dividas){


                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Inserção no Sistema','$idaluno', '$valor', '$divida', '$idaluno', 0, CURRENT_TIMESTAMP, '$formadepagamento', 0)");
                      
                      if($salvar_financas){

                        $acerto[]="Pagamento feito com sucesso";

                      }else{

                        $erros[]="Ocorreu um erro Ao fazer o pagamento,Tente Novamente";

                      }



             }else{

               $erros[]="Ocorreu um erro Ao fazer o pagamento, ao zerrar as dívidas";
             }

                     
   
  }


if(isset($_POST['editaralteracoes'])){

    $identrada=mysqli_escape_string($conexao, trim($_POST['identrada']) );  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']) );  
    $divida=mysqli_escape_string($conexao, trim($_POST['divida']) );  
    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']) );  
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']) );  
    $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']) );  

    
                     $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $divida_antigo=$dados_do_pagamento['divida'];
                     $valorpago_antigo=$dados_do_pagamento['valor'];
                     $datadaentrada_antigo=$dados_do_pagamento['datadaentrada'];
                     $descricao_antigo=$dados_do_pagamento['descricao'];
                     $formadepagamento_antigo=$dados_do_pagamento['formadepagamento'];
                                        


                $antigo="($descricao_antigo) | Pago: $valorpago_antigo | Dívida: $divida_antigo | F. Pag: $formadepagamento_antigo | $datadaentrada_antigo";
                $novo="($descricao) | Pago: $valor | Dívida: $divida | F. Pag: $formadepagamento | $datadaentrada";
                
                $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
            
            if($guardar2){

               $actualizando=mysqli_query($conexao, "UPDATE `entradas` SET `datadaentrada` = '$datadaentrada', `descricao` = '$descricao', `valor` = '$valor',`divida` = '$divida', `formadepagamento` = '$formadepagamento' WHERE identrada = '$identrada'");
 
 
                if($actualizando){

                    $acerto[]="Alterações feitas com sucesso!";
                
                }else{
                
                $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente";
                
                } 

            }else{

                $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente";
                

            }
   
  }

        include("cabecalho.php") ; ?>

<?php
                                 
                                      $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));
                                      
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Detalhes de Pagamento | <a href="aluno.php?idaluno=<?php echo "$idaluno";?>"><?php echo "$nomedoaluno";?></a> </h1>

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

              
 
  <button id="myBtnreclamacoes" class="btn btn-success" title="Registrar Um Pagamento na data de hoje"><i  class="fas fa-money"></i>  Fazer um pagamento Novo</button> 

     | <a class='btn btn-primary' href='pdf/recibopagamento.php?identrada=<?php echo "$dados_da_entrada[identrada]";?>'> Imprimir Recibo Geral</a>




    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="POST">
          <h2>Fazendo novo pagamento</h2>
                      <br>

                       <div class="form-group">
                 <span>Descrição</span>
                <input type="text" name="descricao" autocomplete="on" class="form-control" title="Digite a Descrição" placeholder="Descrição" required="">
                </div>
  

                <div class="form-group">
                 <span>Valor</span>
                <input type="number" step="any" name="valor" autocomplete="on" class="form-control" title="Digite o valor a acrescentar" placeholder="Valor A acrescentar" required="">
                </div>
  

                     
                     <div class="form-group"> 
                      <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                 <?php
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                     ?>
                                      <option  value="<?php echo $exibir["formadepagamento"]; ?>"><?php echo $exibir["formadepagamento"]; ?></option>

                                     <?php } ?>
                                </select> 
                    </div>

                     <div class="form-group"> 
                      <span>Dívida</span>
                                  <select name="divida" required  class="form-control" title="O que acontece com a dívida"> 
                                  <option value="reduzir">Reduzir a Dívida</option>
                                  <option value="permanecer">Não Reduzir a Dívida</option>
                                </select> 
                    </div>


                          <br>
                            <input type="submit" value="Concluir Pagamento" name="cadastrar" class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    


    <script>
                     var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                     var modalreclamacoes=document.getElementById("myModalreclamacoes");
                     var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                   
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })


                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
              
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                
                    

                  </script>

                  <br> <br>
          <div class="col-lg">
         
      
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Histórico de Pagamentos</h6>
            </div>
            <div class="card-body">
           

  <span id="mensagemdealerta"></span> 
          
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Funcionário</th>
                      <th>Descrição</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Data</th> 
                      <th title="Forma de Pagamento">F. de Pag.</th> 
                      <th>Editar</th>  
                      <th>Eliminar</th>  
                    </tr>
                  </thead> 
                  <tbody>
                  
                     <?php
                     
                       

                          $registrosdeentrada=mysqli_query($conexao, "select funcionarios.nomedofuncionario, entradas.* from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario and tipo='$tipo' and idtipo='$idtipo' order by datadaentrada desc"); 
 
                       

                      $totalentradas=0;
                      $totademdivida=0;
                      while($exibir = $registrosdeentrada->fetch_array()){
                            
                          $totalentradas+=$exibir["valor"];
                          $totademdivida+=$exibir["divida"];
                        
                      
                     
                     ?>
                      
                    <tr>
                    <td> <a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?> </a></td>
                    <td ><?php echo $exibir["descricao"]; ?></td> 
                     
                      <td ><?php   $n=number_format($exibir["valor"],2,",", "."); echo $n; ?></td>
                      <td><?php   $n=number_format($exibir["divida"],2,",", "."); echo $n; ?></td>
                      <td><?php echo $exibir["datadaentrada"]; ?></td> 
                      <td><?php echo $exibir["formadepagamento"]; ?></td>  
                      <td><a href="" class="btn btn-info mudavalor" data-column="Aumentar" data-id="<?php echo $exibir["identrada"]; ?>" ><i style="color:white" title="Mudar dados nesse registro" class="fas fa-edit"></i></a></td>  

                       <td><a href="" class="btn btn-danger delete" data-column="Aumentar" data-id="<?php echo $exibir["identrada"]; ?>" ><i style="color:white" title="Eliminar esse registro específico" class="fas fa-trash"></i></a></td>  
                         
                         


                    

                    </tr> 
                    </tr>
                    <?php  } 

                     $totalentradas=number_format($totalentradas,2,",", ".");
                     $totademdivida=number_format($totademdivida,2,",", ".");


                    ?>
                    </tbody>
                    <tfoot>
                      <th>Total</th>
                      <th></th>
                      <th><?php echo $totalentradas; ?></th>
                      <th><?php echo $totademdivida; ?></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tfoot>
                 
                </table>

                <a href="" class="btn btn-danger deletevenda" id="<?php echo $identrada; ?>" ><i style="color:white" title="Eliminar todos os dados dessa venda, incluíndo a própria venda" class="fas fa-trash"></i>ELIMINAR Todos registros</a>
          
              </div>
            </div>
          </div>
 
            </div>
          </div>
   
  <?php  include("estilocarde.php"); ?>
   
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <div id="formularioresposta"></div>
        </div>
    </div>
    
      <script>
                    var btn=document.getElementsByClassName("mudavalor");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                    $(document).on("click",  ".mudavalor", function(event){
                              event.preventDefault(); 
                              
                              modal.style.display="block"; 
                              var id=$(this).data('id')
                              var tipo=$(this).data("column");
                             
                               
                                            $.ajax({
                              url:'cadastro/alterarvaloroutrasentradas.php',
                              method:'POST',
                              data: {
                                id, tipo 
                            },
                              success:function(data){ 
                                $('#formularioresposta').html(data);  
                              }
                            })

         
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

            <script>
             

                                                            $(document).on("click", ".deletevenda", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletevendainserir.php',
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
 




                     $(document).on("click", ".delete", function(event){
                                event.preventDefault(); 

                                var id=$(this).data("id");

                              
                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                    $(this).closest('tr').remove(); 
                                    $.ajax({
                                    url:'cadastro/deleteentradainserir.php',
                                    method:'POST',
                                    data:{
                                        id
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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
