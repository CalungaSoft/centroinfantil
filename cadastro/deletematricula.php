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

        $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$id'"));
        
        $idaluno=$dados["idaluno"];
        $tipo=$dados["tipo"]; 
        $valorpago=$dados["valorpago"];
         $turma=$dados["turma"];  
        $idturma=$dados["idturma"];
        $idaluno=$dados["idaluno"];


        $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0]; 
          
           $antigo="Eliminado $tipo do aluno <a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a> | Na Turma: <a href=turma.php?idturma=$idturma>$turma</a> | Valor pago: $valorpago ";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");

           if($guardar){

             $delete=mysqli_query($conexao, "Delete from entradas where tipo='$tipo' and idtipo='$id'");

             $delete=mysqli_query($conexao, "Delete from propinas where idmatriculaeconfirmacao='$id'");

             $delete=mysqli_query($conexao, "Delete from cadeirasdeixadas where idmatriculaeconfirmacao='$id'");


                $delete=mysqli_query($conexao, "Delete from descadastrados where idmatriculaeconfirmacao='$id'");

              
                $delete=mysqli_query($conexao, "Delete from documentostratados where idmatriculaeconfirmacao='$id'");

              $delete=mysqli_query($conexao, "Delete from faltas where idmatriculaeconfirmacao='$id'");

                $delete=mysqli_query($conexao, "Delete from notas where idmatriculaeconfirmacao='$id'");
 


        if($delete){

           if(mysqli_query($conexao, "Delete from matriculaseconfirmacoes where idmatriculaeconfirmacao='$id'")){

            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso <a href="">Clique aqui para actualizar a página</a> </div>';


           }else{

          echo '<div class="alert alert-danger"> Erro ao eliminar nas matriculas e confirmações </div>';



         }


         }else{

          echo '<div class="alert alert-danger"> Erro ao eliminar nas finanças </div>';



         }
         
         
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>