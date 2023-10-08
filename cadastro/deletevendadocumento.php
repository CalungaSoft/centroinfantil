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

   $id=mysqli_escape_string($conexao, $_POST['id']);

        $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$id'"));

 
        
          
          $tipo=$dados["tipo"];
          $idtipo=$dados["idtipo"];

          $primeiroid=mysqli_fetch_array(mysqli_query($conexao," SELECT identrada FROM entradas where idtipo='$idtipo' and tipo='$tipo' order by identrada asc limit 1"))[0];

           $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valor, sum(divida) as divida, descricao  FROM entradas where idtipo='$idtipo' and tipo='$tipo'"));

            $descricaonaentrada=$dados["descricao"];
            $valorantigo=$dados["valor"];
            $dividaantigo=$dados["divida"];
            $dividaantigo=$dados["divida"];

 $idaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT idaluno FROM documentostratados where iddocumentotratado='$idtipo'"))[0];


 $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];
 
           $idfuncionario=$idlogado;

           $valorantigoh=number_format($valorantigo,2,",", "."); 
           $dividaantigoh=number_format($dividaantigo,2,",", ".");  

           $antigo="Todos os dados de($descricaonaentrada) (<a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a>)| Valor: $valorantigoh KZ | Por Consolidar $dividaantigo KZ";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
 
      $deletenosdoucmentos=mysqli_query($conexao,"Delete from documentostratados where iddocumentotratado='$idtipo'");

 
        if(mysqli_query($conexao, "Delete from entradas where idtipo='$idtipo' and tipo='$tipo'")){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="index.php">Clique aqui para ir a página inical!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>