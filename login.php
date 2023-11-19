<?php



require_once 'conexao.php';
session_start();

$id_saindo=isset($_SESSION['administradorlogado'])?$_SESSION['administradorlogado']:"000";
$alterando_ultimo_acesso=mysqli_query($conexao,"UPDATE `administradores` SET horadodeslogue=now() WHERE `administradores`.`idadministrador` = '$id_saindo'");


session_unset();
session_destroy(); 




session_start();

if(isset($_POST['entrar'])){
	  $user=mysqli_escape_string($conexao, $_POST['nomedousuario']);
    $senha=mysqli_escape_string($conexao, $_POST['senha']); 
	
	if(!(empty($user) or empty($senha))){

                    $pesquisanosfuncionarios = mysqli_query($conexao, "select * from administradores where username ='$user'");
                    
                    $registros = mysqli_num_rows($pesquisanosfuncionarios);
                    

                    $pesquisanosalunos = mysqli_query($conexao, "select * from administradoresalunos where username ='$user'");
                    
                    $registrosalunos = mysqli_num_rows($pesquisanosalunos);
                    


				          	if($registros>=1){

                        $dados=mysqli_fetch_array($pesquisanosfuncionarios);
                          $senha_bd=$dados["senha"];

                          if(password_verify($senha, $senha_bd)){

                              if($dados['acesso']=="bloqueado"){
                                $erros[]="Usuário e Senha Correctas, mas o seu acesso ao sistema foi bloqueado pelo administrador, por favor, cantacte-o!";
                              }else{

                                
                                $idadministrador=$dados['idadministrador'];

                                $alterando_ultimo_acesso=mysqli_query($conexao,"UPDATE `administradores` SET `ultimoacesso` = now() WHERE `administradores`.`idadministrador` = '$idadministrador'");

                                $_SESSION['logado']=true;
                                $_SESSION['funcionariologado']=$dados['idfuncionario'];
                                $idfuncionario=$dados['idfuncionario'];
                                $_SESSION['administradorlogado']=$dados['idadministrador'];
                                $_SESSION['nomedofuncionariologado']=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario ='$idfuncionario'"))[0];
                                $_SESSION['painel']=$dados['painel'];

                                if ($_SESSION['painel']=="secretaria1" || $_SESSION['painel']=="secretaria2"  || $_SESSION['painel']=="administrador"){
                                   header('Location: index.php');
                                  }else if($_SESSION['painel']=='professor') {  
                                     header('Location: indexpedagogico.php');

                                   }  else if($_SESSION['painel']=='areapedagogica') {  
                                     header('Location: indexdireitor.php');

                                   }   else if($_SESSION['painel']=="RH" ) {  
                                    header('Location: meuperfil.php');

                                  }  
                               

                              }
                            

                          }else{

                            $erros[]="Senha Incorrecta!";
                            
                          }
                         
                      } else if($registrosalunos>=1){
  
                          $dados=mysqli_fetch_array($pesquisanosalunos);
                          $erros[]="oiiiiiii";
                            $senha_bd=$dados["senha"];
  
                            if(password_verify($senha, $senha_bd)){
  
                                if($dados['acesso']=="bloqueado"){
                                  $erros[]="Usuário e Senha Correctas, mas o seu acesso ao sistema foi bloqueado pelo administrador, por favor, cantacte-o!";
                                }else{
  
                                  
                                  $idadministrador=$dados['idadministradoraluno'];
  
                                  $alterando_ultimo_acesso=mysqli_query($conexao,"UPDATE `administradoresalunos` SET `ultimoacesso` = now() WHERE `administradoresalunos`.`idadministradoraluno` = '$idadministrador'");
  
                                  $_SESSION['logado']=true;
                                  $_SESSION['idalunologado']=$dados['idaluno'];
                                  $idaluno=$dados['idaluno']; 
                                  $_SESSION['nomedoalunologado']=mysqli_fetch_array(mysqli_query($conexao, "select nomecompleto from alunos where idaluno ='$idaluno'"))[0];
                                  $_SESSION['painel']="aluno";
  
                                     header('Location: indexaluno.php');
                                   
                                 
  
                                }
                              
  
                            }else{
  
                              $erros[]="Senha Incorrecta!";
                              
                            }
                           
                        } 
                        else {
                            $erros[]="Esse Usuário não Existe!";
                        } 
                                
                        
	          }


	          else{
								$erros[]="os campos devem ser preenchido!";
		     } 
  } 



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>escola</title>
 
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
          
            <!-- Nested Row within Card Body -->
            <div class="row">
            
              <div  class="col-lg-6 d-none d-lg-block "> 
              <img  id="imgm" class="img-profile" src="img/calungasoft.jpg"> 
             
              </div>
              <div class="col-lg-6">
              
                <div class="p-5">
                
                  <div class="text-center">
                    
                    <h1 class="h4 text-gray-900 mb-4">Bem-Vindo</h1>
                  </div>
                  <?php 
                       if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>
           
                  <form class="user" action="" method="post">
                    <div class="form-group">
    
                      <input type="text" autocomplete="off" id="imagemdelogim" name="nomedousuario" class="form-control form-control-user"    placeholder="Digite seu nome de usuário">
                    </div><br>
                    <div class="form-group">
                      
                      <input type="password" autocomplete="off" id="imagemdelogim2" name="senha" class="form-control form-control-user"  placeholder="Palavra-passe">
                    </div><br>
                    
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Entrar" name="entrar">
                      
                    <hr>
                    
                  </form>
                  <hr>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

         
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
