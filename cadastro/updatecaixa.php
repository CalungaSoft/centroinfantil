<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["id"])){

    $valor=mysqli_real_escape_string($conexao, $_POST["valor"]);
    $id=mysqli_escape_string($conexao, trim($_POST['id']));

    if($valor!=""){
        $query="UPDATE caixa set ".$_POST["nomedacoluna"]."='".$valor."' where idcaixa='$id'";
 
                  
                                if(mysqli_query($conexao, $query)){
                                    echo '<div class="alert alert-success"> '.$_POST["nomedacoluna"].'  Alterado para "'.$valor.'"</div>';
                            }else{
                                echo '<div class="alert alert-danger">Ocorreu um erro ao fazer as alterações</div>';
                            }

                     } else{
        echo '<div class="alert alert-danger">Campo Vazio não pode ser alterado!</div>';
    }
    
    
 

}





?>