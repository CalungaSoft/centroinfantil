<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["id"])){

     
        $dadosnaentrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM agenda where idagenda=".$_POST["id"].""));
         
  
           $idfuncionario=$idlogado; 
            $descricao=$dadosnaentrada["nomedaactividade"];
            $datainicio=$dadosnaentrada["datainicio"];
            $datafim=$dadosnaentrada["datafim"];
            $horainicio=$dadosnaentrada["horainicio"];
            $horafim=$dadosnaentrada["horafim"];

           $antigo="$descricao |início: $datainicio/$horainicio | Fim: $datafim/$horafim";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
             
        if(mysqli_query($conexao, "Delete from agenda where idagenda=".$_POST["id"]."")){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>