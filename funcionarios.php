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

 
 
if(isset($_POST['cadastrar'])){
  
  $nomedofuncionario=mysqli_escape_string($conexao, $_POST['nomedofuncionario']);

  if(!empty(trim($nomedofuncionario))){

    
      $proveniencia=mysqli_escape_string($conexao, $_POST['proveniencia']);
      $categoria=mysqli_escape_string($conexao, $_POST['categoria']);
      $telefone=mysqli_escape_string($conexao, $_POST['telefone']);
      $localizacao=mysqli_escape_string($conexao, $_POST['localizacao']);
      $naturalidade=mysqli_escape_string($conexao, $_POST['naturalidade']);
      $habilitacoesliteraria=mysqli_escape_string($conexao, $_POST['habilitacoesliteraria']);
      $contabancaria=mysqli_escape_string($conexao, $_POST['contabancaria']);
      $datadeentrada=mysqli_escape_string($conexao, $_POST['datadeentrada']);
 
      $salario=mysqli_escape_string($conexao, $_POST['salario']);
      $numerodedias=mysqli_escape_string($conexao, $_POST['numerodedias']);
      $numerodehoras=mysqli_escape_string($conexao, $_POST['numerodehoras']);

 
 

       

        $salarioporhora=round(($salario)*12/(52*45));
  
              if(mysqli_num_rows(mysqli_query($conexao," SELECT idfuncionario FROM funcionarios where nomedofuncionario='$nomedofuncionario'"))==0){ 

                $guardar=mysqli_query($conexao,"INSERT INTO `funcionarios` (`idfuncionario`, `nomedofuncionario`, `categoria`, `telefone`, `localizacao`, `naturalidade`, `proveniencia`, `habilitacoesliterarias`, `contabancaria`, `datadeentrada`, `salario`, `datadeentradanosistema`, `salarioporhora`, `numerodedias`, `numerodehoras`, `estatus`) VALUES (NULL, '$nomedofuncionario', '$categoria', '$telefone', '$localizacao', '$naturalidade', '$proveniencia', '$habilitacoesliteraria', '$contabancaria', STR_TO_DATE('$datadeentrada', '%d/%m/%Y'), '$salario', CURRENT_TIMESTAMP, '$salarioporhora', '$numerodedias', '$numerodehoras', 'activo')");
                
                if($guardar){
          
                  $acertos[]="Funcionário Cadastrado com Sucesso! ";
                    
                }else{
                  $erros[]="Ocorreu um erro ao cadastrar o funcionário!";
                    
                }


              }else{
                $erros[]="Já Existe um funcionário como esse nome";
              }

    
 
    }else{
      $erros[]="O nome do funcionário não pode estar vazio";
    }
}

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Funcionários</h1>
          <p class="mb-4">Abaixo vai a lista de todos os Funcionários da Empresa.</p>

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
   <?php if($_SESSION['painel']=="administrador"){?>
        <div class="col-xl-6 col-lg-6"></div> 
          <div class="col-xl-5 col-lg-6">
            <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
              <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
           
             <h6 class="m-0 font-weight-bold text-primary">Cadastrar Novo Funcionário</h6>
              </a>
          <!-- Card Content - Collapse -->
                      <div class="collapse mb-4" id="collapseCardExample">
                          <div class="card-body">

                              <form   method="POST" action="funcionarios.php">
                              <div class="form-group">
                                <input type="text" name="nomedofuncionario"  required="" class="form-control" title="Digite o nome completo do Funcionário" placeholder="Nome Completo">
                              </div>
                  
                              <div class="form-group">
                                <input type="text" name="proveniencia" required="" class="form-control"  placeholder="Proveniência">
                              </div> 

                              <div class="form-group">
                                <input type="text" name="categoria" class="form-control" title="Digite a categoria do funcionário" placeholder="Categoria">
                              </div> 
                              <div class="form-group">
                                <input type="text" name="telefone" class="form-control" title="Digite o Número de telefone do Funcionário" placeholder="Número de telefone">
                              </div>
                            <div class="form-group">
                                <input type="text" name="naturalidade" class="form-control" title="Digite a Naturalidade do funcionario" placeholder="Naturalidade">
                              </div>
                              <div class="form-group">
                              <input type="text" name="localizacao" class="form-control" title="Digite a Zona Onde mora o Funcionário" placeholder="Localização">
                              </div> 
                              <div class="form-group">
                                <input type="text" name="habilitacoesliteraria" class="form-control" title="Digite a Habilitação literária do Funcionário, Ex: 3º ano do Ensino Superior no curso de Mecânica" placeholder="Habilitação literária">
                              </div>
                              <div class="form-group">
                                <input type="text" name="contabancaria" class="form-control" title="Digite a  conta bancária do funcionário, pode ser também o IBAN, depois dê um espaço e ddigite o nome do Banco" placeholder="Conta Bancária">
                              </div> 
                              <div class="form-group">
                                <input type="text" name="datadeentrada" class="form-control js-datepicker" title="Digite a data em que o funcionário entrou na instituição" placeholder="Data de entrada na instituição">
                              </div> 
                              
                              <div class="form-group"> 
                                  <span>Salario Mensal Base</span>
                                <input type="number" id="salariobase" name="salario" required="" class="form-control" title="Digite o salário base que o funcionário receberá, digite apenas o valor numérico" placeholder="Salário Base - Mensal (Kz)">
                                 
                              </div> 
                              
                              <div class="form-group">
                                <span>Salário Por Hora</span>
                                <input type="number"  id="salarioporhora"  disabled=""  class="form-control " placeholder="Salários por hora">
                              </div> 

                                
                              
                            
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
          <?php } ?>
</div> 


<script>


 


                      $(document).on("input",  "#salariobase", function(event){
                        
                        var salario=$("#salariobase").val();
                         

                            
                             var x=((salario)*12/(52*45));
                          var salarioporhora=Math.round(x);
                          $("#salarioporhora").val(salarioporhora);
                  
                      }) 

                      $(document).on("input",  "#numerodedias", function(event){
                        
                        var salario=$("#salariobase").val();
                         

                            
                         var x=((salario)*12/(52*45));
                      var salarioporhora=Math.round(x);
                      $("#salarioporhora").val(salarioporhora);
                  
                      }) 
                     


</script>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Funcionários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Nome</th>
                      <th>Categoria</th>
                      <th>Endereço</th> 
                      <th>Proveniência</th>  
                      <th>Telefone</th>
                      <th>Admissão</th> 


                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $listadefuncionários=mysqli_query($conexao, "select * from funcionarios"); 
                   while($exibir = $listadefuncionários->fetch_array()){ 
                    $idfuncionario=$exibir['idfuncionario'];  
                     
                     ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                      <td><?php echo $exibir['categoria']; ?></td>
                      <td><?php echo $exibir['localizacao']; ?></td>
                      <td><?php echo $exibir['proveniencia']; ?></td>
                      <td><?php echo $exibir['telefone']; ?></td>
                      <td><?php echo $exibir['datadeentrada']; ?></td> 
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

      <?php  include("estilocarde.php"); ?>

      <div id="myModal2" class="modal"  >
    <div class="modal-content">
      <span id="close2">&times;</span>
      <div id="formularioresposta"></div>
    </div>
</div>



      <script>
                   
                    var modal2=document.getElementById("myModal2");

                    var span2=document.getElementById("close2");

                    $(document).on("click",  ".vender", function(event){
                              event.preventDefault(); 
                              
                              modal2.style.display="block"; 
                              var id=$(this).data('id')
                              
                               
                                            $.ajax({
                                              url:'cadastro/verpostosdosfuncionarios.php',
                                              method:'POST',
                                              data: {
                                                id: id  
                                            },
                                              success:function(data){ 
                                                $('#formularioresposta').html(data);  
                                              }
                                            })

         
                            })
                            
                    span2.addEventListener("click", ()=>{
                      modal2.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modal2){
                          modal2.style.display="none";
                        }
                    }

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
