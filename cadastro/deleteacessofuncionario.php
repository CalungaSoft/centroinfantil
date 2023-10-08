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

      
          $idfuncionario=mysqli_fetch_array(mysqli_query($conexao," SELECT idfuncionario FROM administradores where idadministrador=".$_POST["id"].""))[0];
 
  
        if(mysqli_query($conexao, "Delete from administradores where idadministrador=".$_POST["id"]."")){
 
 				 $nomedofuncionario=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedofuncionario FROM funcionarios where idfuncionario='$idfuncionario'"))[0];
 
  

        	 $antigo="Eliminado o acesso do funcionário $nomedofuncionario";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
 

            echo '<div class="alert alert-success"> Acesso do funcionário Eliminado com Sucesso </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar acesso do funcionário!</div>';
     
    }
 

}


?>