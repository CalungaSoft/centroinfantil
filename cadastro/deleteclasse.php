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

 

if(isset($_POST["idclasse"])){
  
    $idclasse=$_POST["idclasse"];

     $nomedoclasse=mysqli_fetch_array(mysqli_query($conexao, "select titulo FROM  classes where  idclasse='$idclasse'"))[0]; 

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_alunos_cadastrados=mysqli_num_rows(mysqli_query($conexao, "select classe from matriculaseconfirmacoes where classe='$nomedoclasse'")); 
    if($registros_alunos_cadastrados!=0){
        echo '<div class="alert alert-danger">A Classe ('.$nomedoclasse.') não pode ser eliminada, pois foram encontrados '.$registros_alunos_cadastrados.' alunos nessa Classe</div>';
        $erro++;
    }
    //funcionarios
   
    

   if ($erro==0) {
        
    $antigo="Eliminado a Classe: $nomedoclasse";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idclasse`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidclasse=mysqli_query($conexao," DELETE FROM classes where idclasse='$idclasse'");
    
      if($eliminandoidclasse){
            echo '<div class="alert alert-success"> Classe Eliminada com Sucesso <a href="index.php">Clique aqui para ir a página inicial!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar a Classe!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar a Classe! <br>
    Você não pode eliminar esse Classe atravez dos alunos que foram encontrados nela... <br>
    <h4>Elimine primeiro a matrícula desses alunos, ou os mude para outra classe! </h4>
    </div>';
   }
    
}


?>