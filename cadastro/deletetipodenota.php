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

     
        $dadosnaentrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM tiposdenotas where idtipodenota=".$_POST["id"].""));
         
  
            $idfuncionario=$idlogado; 
            $titulo=$dadosnaentrada["titulo"]; 
            $idtrimestre=$dadosnaentrada["idtrimestre"]; 

           $antigo="Apagado o tipo de nota $titulo";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
             
        if(mysqli_query($conexao, "Delete from tiposdenotas where idtipodenota=".$_POST["id"]."")){

             $salvar= mysqli_query($conexao,"UPDATE `trimestres` SET `numerodenotas` =`numerodenotas`- '1' WHERE `trimestres`.`idtrimestre` = '$idtrimestre'");

            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | <a  href=""> Clique aqui para actualizar os cálculos </a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>
