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

      $id=$_POST["id"];
        $dadosdadisciplina=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM disciplinas where iddisciplina=".$_POST["id"].""));
         
  
            $idfuncionario=$idlogado; 
            $nomedadisciplina=$dadosdadisciplina["titulo"]; 
            $idturma=$dadosdadisciplina["idturma"]; 

            $dadosdadisciplina=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM turmas where idturma='$idturma'"))[0];

           $antigo="Apagar a disciplina Disciplina $nomedadisciplina";
           $novo="Apagada";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
             
        if(mysqli_query($conexao, "delete from disciplinas WHERE `disciplinas`.`iddisciplina` = '$id'")){

           $apagar_notas=mysqli_query($conexao, "delete from notas WHERE `disciplinas`.`iddisciplina` = '$id'");

            echo '<div class="alert alert-success"> Essa Disciplina foi apagada, ela não aparecerá na pauta, minipauta, boletim, certificado ou qualquer outro documento. </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao apagar a disciplina!</div>';
     
    }
 

}


?>
