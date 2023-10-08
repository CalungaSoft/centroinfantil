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

 

if(isset($_POST["idciclo"])){
  
    $idciclo=$_POST["idciclo"];

     $nomedociclo=mysqli_fetch_array(mysqli_query($conexao, "select titulo FROM  ciclos where  idciclo='$idciclo'"))[0]; 

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_alunos_cadastrados=mysqli_num_rows(mysqli_query($conexao, "SELECT   turmas.idclasse FROM matriculaseconfirmacoes, turmas where turmas.idciclo='$idciclo' and matriculaseconfirmacoes.idturma=turmas.idturma ")); 
    if($registros_alunos_cadastrados!=0){
        echo '<div class="alert alert-danger">O Ciclo ('.$nomedociclo.') não pode ser eliminado, pois foram encontrados '.$registros_alunos_cadastrados.' alunos nesse Ciclo</div>';
        $erro++;
    }
    //funcionarios
   
    

   if ($erro==0) {
        
    $antigo="Eliminado o Ciclo: $nomedociclo";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idciclo`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidciclo=mysqli_query($conexao," DELETE FROM ciclos where idciclo='$idciclo'");
    
      if($eliminandoidciclo){
            echo '<div class="alert alert-success"> Ciclo Eliminado com Sucesso <a href="index.php">Clique aqui para ir a página inicial!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar o Ciclo!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar o Ciclo! <br>
    Você não pode eliminar esse Ciclo atravez dos alunos que foram encontrados neles... <br>
    <h4>Elimine primeiro a matrícula desses alunos, ou os mude para outro Ciclo! </h4>
    </div>';
   }
    
}


?>