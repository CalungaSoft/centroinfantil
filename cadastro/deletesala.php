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

 

if(isset($_POST["idsala"])){
  
    $idsala=$_POST["idsala"];

     $nomedosala=mysqli_fetch_array(mysqli_query($conexao, "select titulo FROM  salas where  idsala='$idsala'"))[0]; 

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_alunos_cadastrados=mysqli_num_rows(mysqli_query($conexao, "select sala from matriculaseconfirmacoes where sala='$nomedosala'")); 
    if($registros_alunos_cadastrados!=0){
        echo '<div class="alert alert-danger">A sala ('.$nomedosala.') não pode ser eliminada, pois foram encontrados '.$registros_alunos_cadastrados.' alunos nessa sala</div>';
        $erro++;
    }
    //funcionarios
   
    

   if ($erro==0) {
        
    $antigo="Eliminado a sala: $nomedosala";
    $novo="Eliminado"; 
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidsala=mysqli_query($conexao," DELETE FROM salas where idsala='$idsala'");
    
      if($eliminandoidsala){
            echo '<div class="alert alert-success"> sala Eliminada com Sucesso <a href="index.php">Clique aqui para ir a página inicial!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar a sala!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar a sala! <br>
    Você não pode eliminar esse sala atravez dos alunos que foram encontrados nela... <br>
    <h4>Elimine primeiro a matrícula desses alunos, ou os mude para outra sala! </h4>
    </div>';
   }
    
}


?>