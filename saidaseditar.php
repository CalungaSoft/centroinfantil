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



 
$idsaida=isset($_GET['idsaida'])?$_GET['idsaida']:"";
$idsaida=mysqli_escape_string($conexao, $idsaida); 

 
if(isset($_POST['editaralteracoes'])){

    $idsaida=mysqli_escape_string($conexao, trim($_POST['idsaida']) );  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']) );  
    $divida=mysqli_escape_string($conexao, trim($_POST['divida']) );  
    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']) );  
    $formadesaida=mysqli_escape_string($conexao, trim($_POST['formadesaida']) );  
    $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']) );  
    $idanolectivo=mysqli_escape_string($conexao, trim($_POST['idanolectivo']) ); 
    $idtipo=mysqli_escape_string($conexao, trim($_POST['idtipo']) );   
 
    
                     $dadosantigos=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM saidas where idsaida='$idsaida' "));

                     $tipo=mysqli_fetch_array(mysqli_query($conexao," SELECT tipo FROM tipodesaidas where idtipodesaida='$idtipo' "))[0];




                     $divida_antigo=$dadosantigos['divida'];
                     $valor_antigo=$dadosantigos['valor'];
                     $datadasaida_antigo=$dadosantigos['datadasaida'];
                     $descricao_antigo=$dadosantigos['descricao'];
                     $formadesaida_antigo=$dadosantigos['formadesaida'];
                     $tipo_antigo=$dadosantigos['tipo'];
                                        


                $antigo="($descricao_antigo) | Pago: $valor_antigo | Dívida: $divida_antigo | F. Pag: $formadesaida_antigo | $datadasaida_antigo | $tipo_antigo";
                $novo="($descricao) | Pago: $valor | Dívida: $divida | F. Saída: $formadesaida | $datadasaida | $tipo";
                
                $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
            
            if($guardar2){

               $actualizando=mysqli_query($conexao, "UPDATE `saidas` SET `datadasaida` = '$datadasaida', `descricao` = '$descricao', `valor` = '$valor',`divida` = '$divida', `formadesaida` = '$formadesaida', `idanolectivo` = '$idanolectivo', `idtipo` = '$idtipo' WHERE idsaida = '$idsaida'");
 
 
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
                                 
                                      $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM saidas where idsaida='$idsaida' "));
                                      
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Detalhes da Saída  </h1>

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

              
<br><br>

          <div class="col-lg">
         
      
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Histórico</h6>
            </div>
            <div class="card-body">
           

  <span id="mensagemdealerta"></span>
 
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Funcionário</th>
                      <th>Descrição</th> 
                      <th>Tipo</th>
                      <th>Ano Lectivo</th>
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Data</th> 
                      <th title="Forma de Pagamento">F. de Pag.</th> 
                      <th>Editar</th>  
                    </tr>
                  </thead> 
                  <tbody>
                  
                     <?php
                     
                       

                          $registrosdeentrada=mysqli_query($conexao, "select funcionarios.nomedofuncionario, saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario and idsaida='$idsaida' order by datadasaida desc"); 
 
                       

                      $totalsaidas=0;
                      $totademdivida=0;
                      while($exibir = $registrosdeentrada->fetch_array()){
                            
                            $idanolectivo=$exibir["idanolectivo"];
                        
                         $anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM anoslectivos where idanolectivo='$idanolectivo' "))[0];
                        
                      
                     
                     ?>
                      
                    <tr>
                    <td> <a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?> </a></td>
                    <td ><?php echo $exibir["descricao"]; ?></td> 
                    <td ><?php echo $exibir["tipo"]; ?></td> 
                    <td ><a href="anolectivo.php?idanolectivo=<?php echo $exibir["idanolectivo"]; ?>"><?php echo $anolectivo; ?></a></td> 
                     
                      <td ><?php  $totalsaidas=$totalsaidas+$exibir["valor"];  $n=number_format($exibir["valor"],2,",", "."); echo $exibir["valor"]; ?></td>
                      <td><?php $totademdivida=$totademdivida+$exibir["divida"];  $n=number_format($exibir["divida"],2,",", "."); echo $exibir["divida"]; ?></td>
                      <td><?php echo $exibir["datadasaida"]; ?></td> 
                      <td><?php echo $exibir["formadesaida"]; ?></td>  
                      <td><a href="" class="btn btn-success mudavalor" data-column="Aumentar" data-id="<?php echo $idsaida; ?>" ><i style="color:white" title="Mudar dados nesse registro" class="fas fa-edit"></i></a></td>  
                         


                    

                    </tr> 
                    </tr>
                    <?php  } ?>
                    </tbody>
                 
                </table>

                <a href="" class="btn btn-danger deletevenda" id="<?php echo $idsaida; ?>" ><i style="color:white" title="Eliminar todos os dados dessa venda, incluíndo a própria venda" class="fas fa-trash"></i>ELIMINAR Todos registros</a>
          
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
                             
                               
                                            $.ajax({
                              url:'cadastro/editarsaidas.php',
                              method:'POST',
                              data: {
                                id 
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
                                                                    url:'cadastro/deletesaida.php',
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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
