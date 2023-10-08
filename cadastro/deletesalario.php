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
 
    
         
        $dadosdosalario=mysqli_fetch_array(mysqli_query($conexao,"SELECT  idnasaida FROM salario where idsalario='".$_POST["id"]."'"));
        $idnasaida=$dadosdosalario["idnasaida"];

        $dadosnasaida=mysqli_fetch_array(mysqli_query($conexao,"SELECT  * FROM saidas where idsaida='$idnasaida'"));
        
        $descricao=$dadosnasaida["descricao"];
        $valor=$dadosnasaida["valor"];

        $antigo="$descricao: Valor: $valor";
        $novo="Eliminado";
      
            $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
      

        $deletandodaentrada=mysqli_query($conexao, "Delete from saidas where idsaida='$idnasaida'");
        
        if(mysqli_query($conexao, "Delete from salario where idsalario='".$_POST["id"]."'")){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
       }
       else{
           
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>