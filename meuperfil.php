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

 

$idfuncionario=$idlogado;

 
if(isset($_POST['mudarsenha'])){
  
  
  $id_administrador=mysqli_escape_string($conexao, $_POST['idadministrador']);
  $nomedeusuario=mysqli_escape_string($conexao, $_POST['nomedeusuario']);
  $senha=mysqli_escape_string($conexao, $_POST['senha']);
  $senharepetida=mysqli_escape_string($conexao, $_POST['senharepetida']);
  $senhaantiga=mysqli_escape_string($conexao, $_POST['senhaantiga']);


   
  $senhaantiga_do_banco=mysqli_fetch_array(mysqli_query($conexao, "select senha from administradores where idadministrador ='$id_administrador'"))[0];

  if(password_verify($senhaantiga, $senhaantiga_do_banco)){

      if($senharepetida!=$senha){
        $erros[]="As senhas que digitou não combinam, por favor tente novamente";
      }else{
        if(!empty(trim($senharepetida))){

              $senha=password_hash($senha, PASSWORD_DEFAULT);
      
              if(mysqli_num_rows(mysqli_query($conexao," SELECT idfuncionario FROM administradores where username='$nomedeusuario' and idadministrador!='$id_administrador'"))==0){ 

                $guardar=mysqli_query($conexao,"UPDATE `administradores` SET `senha` = '$senha', `username` = '$nomedeusuario' WHERE `administradores`.`idadministrador` = '$id_administrador'");

                if($guardar){
          
                  $acertos[]="Dados Alterados com sucesso";
                    
                }else{

                  $erros[]="Ups! Ocorreu um erro...";
                    
                }


              }else{
                $erros[]="Já Existe um funcionário como esse nome de usuário, por favor, use outro nome";
              }

            }else{

              $erros[]="As Senhas não podem ser campos vazios!";

            }

          }
  }else{

    $erros[]="Senha Antiga Incorrecta, Tente Novamente! <br>  <br> Você esqueceu sua senha? contacte a assistência técnica!";

  }

}



 
if(isset($_POST['editardadospessoais'])){

  $nomedofuncionario=mysqli_escape_string($conexao, $_POST['nomedofuncionario']);
  $cargo=mysqli_escape_string($conexao, $_POST['cargo']);
  $numerodofuncionario=mysqli_escape_string($conexao, $_POST['numerodofuncionario']);
  $categoria=mysqli_escape_string($conexao, $_POST['categoria']);
  $telefone=mysqli_escape_string($conexao, $_POST['telefone']);
  $localizacao=mysqli_escape_string($conexao, $_POST['localizacao']);
  $numerodobi=mysqli_escape_string($conexao, $_POST['numerodobi']);
  $datadenascimento=mysqli_escape_string($conexao, $_POST['datadenascimento']);
  $habilitacoesliteraria=mysqli_escape_string($conexao, $_POST['habilitacoesliteraria']);
  $contabancaria=mysqli_escape_string($conexao, $_POST['contabancaria']);
  $datadeentrada=mysqli_escape_string($conexao, $_POST['datadeentrada']);
  $salario=mysqli_escape_string($conexao, $_POST['salario']); 
  

  $numerodedias=mysqli_escape_string($conexao, $_POST['numerodedias']);
  $numerodehoras=mysqli_escape_string($conexao, $_POST['numerodehoras']);
  $salarioporhora=round(($salario/$numerodedias)/$numerodehoras); 

  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM funcionarios where nomedofuncionario='$nomedofuncionario' and idfuncionario!='$idfuncionario'"))==0){ 
 
  $salvar= mysqli_query($conexao,"UPDATE `funcionarios` SET `numerodedias` = '$numerodedias',`numerodehoras` = '$numerodehoras', `categoria` = '$categoria',`numerodofuncionario` = '$numerodofuncionario', `nomedofuncionario` = '$nomedofuncionario', `cargo` = '$cargo', `telefone` = '$telefone', `localizacao` = '$localizacao', `numerodobi` = '$numerodobi', `datadenascimento` = '$datadenascimento', `habilitacoesliterarias` = '$habilitacoesliteraria', `contabancaria` = '$contabancaria', `datadeentrada` = '$datadeentrada', `salario` = '$salario', `salarioporhora` = '$salarioporhora' WHERE `funcionarios`.`idfuncionario` = '$idfuncionario'");
  }else{
    $erros[]="Já Existe um funcionário como esse nome";
  }
  
  
  header("location:funcionario.php?idfuncionario=$idfuncionario");
}
include("cabecalho.php") ;


$id_administrador=isset($_SESSION['administradorlogado'])?$_SESSION['administradorlogado']:"000";
$dados_do_login=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM administradores where idadministrador='$id_administrador' "));

if($idfuncionario!=$idlogado){

  $erros_de_permissao[]="Você não tem permissão para ver perfil de outro funcionário. <br> <a href=index.php> clique aqui para ir a página principal </a>";

}
 
 
 
 $idanolectivo=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim'"))['idanolectivo'];


  
            $ano_escolhido=date('Y');
            $mes_escolhido=date('m');

            
       

            $saidahoje = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"))[0];

            $totaldeaniversariantes=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where MONTH(datadenascimento)=MONTH(curdate())"));

            $totaldeActividades=mysqli_num_rows(mysqli_query($conexao, "select * from agenda where Week(datainicio)=Week(curdate())")); 


             $totaldelembretes=mysqli_num_rows(mysqli_query($conexao, "select * from lembretes where Week(datadolembrete)=Week(curdate())")); 
            
           
           for ($i=0; $i <=6 ; $i++) { 

            $dat=date('d-m-Y', strtotime("- $i days"));
 

              $datas[$i]=date('D', strtotime($dat)); 
                
           }
              $semana=array('Sun' =>'Domingo','Mon' =>'Segunda','Tue' =>'Terça','Wed' =>'Quarta', 'Thu' =>'Quinta','Fri' =>'Sexta','Sat' =>'Sábado');

          

           foreach ($datas as $key => $value) {

              $ultimos_sete_dias[]=$semana["$value"];
                
           }
 
              

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Funcionário</h1>


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
        

                if(!empty($erros_de_permissao)){
                  foreach($erros_de_permissao as $erros_de_permissao):
                    echo '<div class="alert alert-danger"> <h1>'.$erros_de_permissao.' </h1></div>';
                  endforeach;
                }else{

               
?>


<?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-info">Mudar Senha ou Nome de Usuário</button>
     
    
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="POST">
                                  <input type="hidden" name="idadministrador" value="<?php echo $dados_do_login["idadministrador"] ; ?>">
                               <div class="form-group">
                                   <span>Nome de Usuário</span>
                                  <input type="text" name="nomedeusuario" autocomplete="off" required=""  class="form-control" title="Digite o nome de usuário que o funcionário usará para ter acesso ao sistema" value="<?php echo $dados_do_login["username"] ; ?>">
                                </div> 
                                
                                <div class="form-group">
                                <span>Senha Antiga</span>
                                  <input type="text" name="senhaantiga" autocomplete="off" required=""  class="form-control" title="Você deve inserir a senha antiga" placeholder="Senha Antiga">
                                </div> 

                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                  <span>Senha Nova</span>
                                    <input type="text" name="senha" autocomplete="off" required="" id="senhaum" class="form-control" title="Digite a senha que o funcionário usará para o acesso ao sistema" placeholder="Senha Nova">
                                </div>
                                <div class="col-sm-6">
                                  <span>Repete a Senha Nova</span>
                                <input type="text" name="senharepetida" autocomplete="off" required="" id="senhadois" class="form-control" title="Repete a senha" placeholder="Repita a Senha Nova Novamente">
                                </div> 
                              
                              </div> 
                                <span id="verificacaodasenha"></span> 
 
                                <br>
                            
                              <div class="form-group">
                                  <input type="submit" name="mudarsenha" value="Cadastrar" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                              </div> 

                    

          </form>
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

<br><br>
                    

          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do Funcionário</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">


                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">

                            
                              <?php

                                      $dadospessoais=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM funcionarios where idfuncionario='$idfuncionario' ")) ;
                                      
                                      
                              ?>
                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dados Pessoais
                                       <div id="content-wrapper" class="d-flex flex-column">
                                          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                                              <div id="content">
                                                <ul>
                                                  <li class="nav-item dropdown no-arrow">
                                                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <div class="h5 mb-0 mr-3 font-weight-bold"><?php echo $dadospessoais["nomedofuncionario"] ; ?></div>
                                                       
                                                      </a>
                                                  </li>
                                                  </ul>
                                            </nav>
                                                  </div>
                                              </div>
                                     
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                                   	<strong>Habilitação Literária:</strong> <?php echo $dadospessoais["habilitacoesliterarias"] ; ?> <br> 
                                                  	<strong>Nº de Telefone:</strong> <?php echo $dadospessoais["telefone"] ; ?> <br> 
                                                  	<strong>Conta Bancária:</strong> <?php echo $dadospessoais["contabancaria"] ; ?> <br> 
                                                  	<strong>Localização:</strong> <?php echo $dadospessoais["localizacao"] ; ?><br> 
                                                </div>
                                     
                                    </div>
                                    </div>
                                     
                                </div>
                                </div>
                            </div>
                            </div>
   
                            <?php 
                               
 
                                 $totaldehorastrabalhadas=mysqli_num_rows(mysqli_query($conexao, "select idfalta from presenca where idfuncionario='$idfuncionario'")); 
                            ?>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dados Profissionais</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $dadospessoais["categoria"] ; ?></div>
                                          <br>
                                                  	  <strong>Categoria </strong>: <?php echo $dadospessoais["categoria"] ; ?> <br> 
                                                  	<strong>Data de entrada na empresa</strong>: <?php echo $dadospessoais["datadeentrada"] ; ?> <br> 
                                                    <strong>Salário Base</strong>: <?php echo $dadospessoais["salario"] ; ?>KZ : Por Hora: <?php echo $dadospessoais["salarioporhora"] ; ?>KZ <br>   <strong>Total de Dias de trabalho</strong>: <?php echo $totaldehorastrabalhadas+0; ?> dias<br>  
                 
                                                 

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
 
              
       
         
  <!-- DataTales Example -->  
        </div>
      
       <!-- DataTales Example -->  
       </div>
        <!-- /.container-fluid -->

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content --> 
      
      
                                                          <?php } ?>
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2023</span>
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
