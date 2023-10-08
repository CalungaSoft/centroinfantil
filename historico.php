<?php  include("conexao.php"); 


    
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['painel']!="administrador"):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST['editadados'])){
 
  $nome=mysqli_escape_string($conexao,trim( $_POST['nome']));
  $servicos=mysqli_escape_string($conexao,trim( $_POST['servicos']));
  $numerodecontribuinte=mysqli_escape_string($conexao,trim( $_POST['numerodecontribuinte']));
  $contabancaria=mysqli_escape_string($conexao,trim( $_POST['contabancaria'])); 
  $email=mysqli_escape_string($conexao,trim( $_POST['email'])); 
  $localizacao=mysqli_escape_string($conexao,trim( $_POST['localizacao']));  
  $telefone=mysqli_escape_string($conexao,trim( $_POST['telefone'])); 
  $site=mysqli_escape_string($conexao,trim( $_POST['site']));  
  


  $guardar=mysqli_query($conexao,"UPDATE `dadosdaempresa` SET `site` = '$site', `nome` = '$nome', `servicos` = '$servicos', `numerodecontribuinte` = '$numerodecontribuinte', `contabancaria` = '$contabancaria', `email` = '$email', `localizacao` = '$localizacao', `telefone` = '$telefone' WHERE `dadosdaempresa`.`iddadosdaempresa` = 1");
  
  header("location:configuracaodeprecosmanuntencao.php");
}


  include("cabecalho.php") ; ?>
   <div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Histórico de Alterações No sistema</h1>
<p>Todas as alterações que foram feitas no sistema, depois de confirmar as alterações você pode apaga-las.</p>

         
          
           <!-- DataTales Example -->
           <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Histórico de Alterações no sistema.</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th title="Aqui vai o nome do funcionário que alterou ou eliminou o registro">Funcionário</th>
                      <th>Descrição</th>
                      <th title="Aqui vai o registro antes de ser editado ou eliminado">Antigo</th> 
                      <th title="Aqui vai o registro depos de ser editado">Novo</th>
                      <th>Data de Alteração</th>
                      <th>Eliminar</th> 
                    </tr>
                  </thead> 
                  <tbody>
                  <?php
                      
                        $historicos=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  historico.* from funcionarios, historico where funcionarios.idfuncionario=historico.idfuncionario"); 
                      
                    
                   while($exibir = $historicos->fetch_array()){ ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
                      <td><?php echo $exibir["descricao"]; ?></td>
                      <td><?php echo $exibir["antigo"]; ?></td>
                      <td><?php echo $exibir["novo"]; ?></td>
                      <td><?php echo $exibir["data"]; ?></td>
                      <td> <a href="" class="delete" id="<?php echo $exibir["idhistorico"]; ?>"><i  style="color:red;" title="Eliminar Registro" class="fas fa-trash"></i></a></td>
                    </tr> 
                   <?php }    ?>
                   </tbody> 
                </table>
              </div>
            </div>
          </div>
 
      <script>


                                                


                                                            $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletehistorico.php',
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
