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

        $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM avaliacoes where idavaliacao='$id'"));
 
        $iddisciplina=$dados["iddisciplina"];
        $data=$dados["data"];
        $idtrimestre=$dados["idtrimestre"];
        $titulo=$dados["titulo"];

        $nomedadisciplina=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM disciplinas where iddisciplina='$iddisciplina'"))[0];

       
        $nomedotrimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM trimestres where idtrimestre='$idtrimestre'"))[0];

           $antigo="Eliminada a avaliação contínua de $nomedadisciplina ($titulo - realizada $data ! $nomedotrimestre Trimestre)";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");


      if ($guardar) {

             $salvar=mysqli_query($conexao,"Delete from notasavaliacao where idavaliacao='$id'");

             if ($salvar) {
              
             
                          if(mysqli_query($conexao, "Delete from avaliacoes where idavaliacao='$id'")){
                            echo '<div class="alert alert-success"> Avaliação Eliminada com Sucesso  </div>';
                       }
                       else{
                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar a avaliação! - das avalicoes</div>';
                     
                    }
                }else{
                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar a avaliação! - das notas da avaliação</div>';
                     
                    }
      }else{
                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar a avaliação! - do historico</div>';
                     
                    }


}


?>