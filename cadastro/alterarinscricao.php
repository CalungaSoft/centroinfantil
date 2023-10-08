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

 if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){

if(isset($_POST["tipodematricula"])){

        $tipodematricula=$_POST["tipodematricula"];
        $idmatriculaeconfirmacao=$_POST["idmatriculaeconfirmacao"];
        

          $dadosdamatricula=mysqli_fetch_array(mysqli_query($conexao," SELECT tipo, idaluno, idturma FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"));
    
            $tipodematricula_antiga=$dadosdamatricula["tipo"];
            $idaluno=$dadosdamatricula["idaluno"];
            $idturma=$dadosdamatricula["idturma"];
    
        if(mysqli_query($conexao, "UPDATE `matriculaseconfirmacoes` SET `tipo` = '$tipodematricula' WHERE `matriculaseconfirmacoes`.`idmatriculaeconfirmacao` ='$idmatriculaeconfirmacao'")){
  
    $descricao="Registro de $tipodematricula";
        $alterarnasEntradas=mysqli_query($conexao," UPDATE `entradas` SET `tipo` = '$tipodematricula', descricao='$descricao' WHERE `entradas`.`tipo` ='$tipodematricula_antiga' and idaluno='$idaluno' and idturma='$idturma' ");
 
 				 $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];


        	 $antigo="Alterado o tipo de Inscrição do Aluno $nomedoaluno - $tipodematricula_antiga";
           $novo="$tipodematricula";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
 

            echo '<div class="alert alert-success"> Alteração feita com sucesso </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao fazer a Alteração!</div>';
     
    }
 

  }

} else{
        echo '<div class="alert alert-danger">Você não tem permissão para fazer esse tipo de alteração</div>';
     
    }


?>