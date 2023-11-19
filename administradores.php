<?php 
include("conexao.php");

    
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['painel']!="administrador"):
  header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'];
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
 
if(isset($_POST['cadastrar'])){
  
   
      $idfuncionario=mysqli_escape_string($conexao, $_POST['idfuncionario']);
      $nomedeusuario=mysqli_escape_string($conexao, $_POST['nomedeusuario']);
      $senha=mysqli_escape_string($conexao, $_POST['senha']);
      $senharepetida=mysqli_escape_string($conexao, $_POST['senharepetida']);
      $painel=mysqli_escape_string($conexao, $_POST['painel']);
 
 

      if($senharepetida!=$senha){
        $erros[]="As senhas que digitou não combinam, por favor tente novamente";
      }else{
        if(!empty(trim($senharepetida))){
        $senha=password_hash($senha, PASSWORD_DEFAULT);

       
              if(mysqli_num_rows(mysqli_query($conexao," SELECT idfuncionario FROM administradores where username='$nomedeusuario'"))==0){ 

                $guardar=mysqli_query($conexao,"INSERT INTO `administradores` (`idadministrador`, `idfuncionario`, `painel`, `username`, `senha`) VALUES (NULL, '$idfuncionario', '$painel', '$nomedeusuario', '$senha')");
  
                if($guardar){
          
                  $acertos[]="Funcionário Cadastrado com Sucesso! ";
                    
                }else{
                  $erros[]="Ocorreu um erro ao cadastrar o funcionário!";
                    
                }


              }else{
                $erros[]="Já Existe um funcionário como esse nome de usuário, por favor, use outro nome";
              }

            }else{

              $erros[]="As Senhas não podem ser campos vazios!";

            }

      }
    
   
}




 
if(isset($_GET['permition'])){
  
  
  $idadministrador=mysqli_escape_string($conexao, $_GET['idadministrador']);
  $permition=mysqli_escape_string($conexao, $_GET['permition']); 
  $painel=mysqli_escape_string($conexao, $_GET['painel_do_funcionario']); 

 
  
                $guardar=mysqli_query($conexao,"UPDATE `administradores` SET `acesso` = '$permition' WHERE `administradores`.`idadministrador` = '$idadministrador'");

                if($guardar){
          
                  $acertos[]="Funcionário $permition com Sucesso! ";
                    
                }else{
                  $erros[]="Ocorreu um erro!";
                    
                }
 


}






if(isset($_GET['painel'])){
  
  
  $idadministrador=mysqli_escape_string($conexao, $_GET['idadministrador']);
  $painel=mysqli_escape_string($conexao, $_GET['painel']); 


 
    
            $guardar=mysqli_query($conexao,"UPDATE `administradores` SET `painel` = '$painel' WHERE `administradores`.`idadministrador` = '$idadministrador'");

            if($guardar){
      
              $acertos[]="Funcionário mudado para acesso de  $painel com Sucesso! ";
                
            }else{
              $erros[]="Ocorreu um erro!";
                
            }
 
 


}



include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Administradores do Sistema</h1>
          <p class="mb-4">Abaixo vai a lista de todos os Funcionários da Empresa que têm acesso ao sistema</p>

          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

            <?php 
              if(!empty($acertos)):
                          foreach($acertos as $acertos):
                            echo '<div class="alert alert-success">'.$acertos.'</div>';
                          endforeach;
                        endif;
            ?>


            

   <div class="row">
        <div class="col-xl-6 col-lg-6"></div> 
          <div class="col-xl-5 col-lg-6">
            <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
              <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Dar acesso ao sistema a um funcionário</h6>
              </a>
          <!-- Card Content - Collapse -->
                      <div class="collapse mb-4" id="collapseCardExample">
                          <div class="card-body">

                              <form   method="POST" action="">
                              
                              <span>Funcionário</span>
                              <div class="form-group">
                              <select name="idfuncionario" required  class="form-control" title="Escolha aqui o funcionário que terá acesso ao sistema"> 
                                <?php
                                    $lista_de_funcionarios=mysqli_query($conexao,"SELECT nomedofuncionario, idfuncionario from funcionarios order by nomedofuncionario ");
                                    while($exibir = $lista_de_funcionarios->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["idfuncionario"]; ?>"><?php echo $exibir["nomedofuncionario"]; ?></option>
                                  <?php } ?> 
                              </select> 
                              </div>   

                                <div class="form-group">
                                  <input type="text" name="nomedeusuario" autocomplete="off" required=""   class="form-control" title="Digite o nome de usuário que o funcionário usará para ter acesso ao sistema" placeholder="Nome de usuário">
                                </div> 
                                

                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="senha" id="senhaum" autocomplete="off" required="" class="form-control" title="Digite a senha que o funcionário usará para o acesso ao sistema" placeholder="Senha">
                                </div>
                                <div class="col-sm-6">
                                <input type="text" name="senharepetida" autocomplete="off" id="senhadois" required=""  class="form-control" title="Repete a senha" placeholder="Repita a Senha Novamente">
                                </div> 
                              
                              </div> 
                                <span id="verificacaodasenha"></span> 

                                <select name="painel" class="form-control"   title="Escolha o painel de acesso do funcionário ao sistema" >
                                        <option value="professor">Professor</option>
                                        <option value="secretaria1">Secretaria nivel 1</option>
                                        <option value="secretaria2">Secretaria nivel 2</option>
                                        <option value="areapedagogica">Área Pedagógica</option>
                                        <option value="RH">Recursos Humanos</option>
                                        <option value="administrador">Administrador</option> 
                                </select> 
                                <br>
                            
                              <div class="form-group">
                                  <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                              </div> 

                              <div id="info"> </div> 

                              <div  id="sms">   </div> 

                  </form>

                          </div>
                    </div>
            </div>
          </div>
</div> 


<script>



                    $(document).on("blur",  "#senhadois", function(event){
                        
                        var senhaum=$("#senhaum").val();
                        var senhadois=$("#senhadois").val();
                         
                         if(senhaum!=senhadois){
                          $("#verificacaodasenha").html("<div class='alert alert-danger'>As duas senhas não são iguais, repita novamente</div>");
                         }else{
                          $("#verificacaodasenha").html("<div class='alert alert-success'>As senhas combinam, por favor, memorize bem a sua senha! ou aponte em algum local de difícil acesso.<br><div class='alert alert-danger'> ATT: Se esqueceres a tua senha, terás que contactar a assistência técnica, por isso, trate de memorizar bem. </div></div>");
                         }
                             
                        
                  
                      }) 


</script>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Funcionários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
               <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Funcionário</th>
                      <th>Painel</th>
                      <th>Acesso</th>
                      <th>Último Acesso</th> 
                      <th title="Horário em que o funcionário deslogou/saiu do sistema">Última saída</th>
                      <th>acesso</th> 
                      <th>Opção</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $listadefuncionários=mysqli_query($conexao, "select funcionarios.nomedofuncionario, administradores.* from administradores, funcionarios where administradores.idfuncionario=funcionarios.idfuncionario"); 
                   while($exibir = $listadefuncionários->fetch_array()){ ?>
                    <tr> 
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                      <td><?php echo $exibir['painel']; ?></td>
                      <td><?php echo $exibir['acesso']; ?></td>
                      <td><?php echo $exibir['ultimoacesso']; ?></td>
                      <?php 

                       if($exibir['ultimoacesso']>$exibir['horadodeslogue']){ ?>
                          <td>Ainda Online</td>
                        <?php }else{ ?>
                          <td><?php echo $exibir['horadodeslogue']; ?></td>
                        <?php } ?>  
                          <td>
                          <?php  if($exibir['acesso']=="desbloqueado" && $exibir['idfuncionario']!=$idlogado){ ?>
                           <a href="administradores.php?idadministrador=<?php echo $exibir['idadministrador']; ?>&permition=bloqueado&painel_do_funcionario=<?php echo $exibir['painel']; ?>">Bloquear</a>
                        <?php }else if($exibir['idfuncionario']!=$idlogado){ ?>
                          <a href="administradores.php?idadministrador=<?php echo $exibir['idadministrador']; ?>&permition=desbloqueado&painel_do_funcionario=<?php echo $exibir['painel']; ?>">Desbloquear</a> 
                        <?php }   ?>
                          </td>
                           
                          <td> <?php if($exibir['idfuncionario']!=$idlogado){ ?> <a href="" class="delete" id="<?php echo $exibir["idadministrador"]; ?>" ><i style="color:red" title="Eliminar acesso desse funcionário" class="fas fa-trash"></i></a> <?php }   ?> </td>
                         
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

<script type="text/javascript">
                        
                        $(document).on("click", ".delete", function(event){
                          event.preventDefault();
                          var id=$(this).attr("id");

                          if(confirm("Tens certeza que queres eliminar o acesso desse funcionário")){
                              $(this).closest('tr').remove(); 
                              $.ajax({
                              url:'cadastro/deleteacessofuncionario.php',
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
