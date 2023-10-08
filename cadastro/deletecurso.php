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

 

if(isset($_POST["idcurso"])){
  
    $idcurso=$_POST["idcurso"];

     $nomedocurso=mysqli_fetch_array(mysqli_query($conexao, "select titulo FROM  cursos where  idcurso='$idcurso'"))[0]; 

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_alunos_cadastrados=mysqli_num_rows(mysqli_query($conexao, "select curso from matriculaseconfirmacoes where curso='$nomedocurso'")); 
    if($registros_alunos_cadastrados!=0){
        echo '<div class="alert alert-danger">O Curso ('.$nomedocurso.') não pode ser eliminado, pois foram encontrados '.$registros_alunos_cadastrados.' alunos nesse Curso</div>';
        $erro++;
    }
    //funcionarios
   
    

   if ($erro==0) {
        
    $antigo="Eliminado o Curso: $nomedocurso";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idcurso`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidcurso=mysqli_query($conexao," DELETE FROM cursos where idcurso='$idcurso'");
    
      if($eliminandoidcurso){
            echo '<div class="alert alert-success"> Curso Eliminado com Sucesso <a href="index.php">Clique aqui para ir a página inicial!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar o Curso!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar o Curso! <br>
    Você não pode eliminar esse Curso atravez dos alunos que foram encontrados neles... <br>
    <h4>Elimine primeiro a matrícula desses alunos, ou os mude para outro Curso! </h4>
    </div>';
   }
    
}


?>