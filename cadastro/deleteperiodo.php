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

 

if(isset($_POST["idperiodo"])){
  
    $idperiodo=$_POST["idperiodo"];

     $nomedoperiodo=mysqli_fetch_array(mysqli_query($conexao, "select titulo FROM  periodos where  idperiodo='$idperiodo'"))[0]; 

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_alunos_cadastrados=mysqli_num_rows(mysqli_query($conexao, "select periodo from matriculaseconfirmacoes where periodo='$nomedoperiodo'")); 
    if($registros_alunos_cadastrados!=0){
        echo '<div class="alert alert-danger">O Período ('.$nomedoperiodo.') não pode ser eliminado, pois foram encontrados '.$registros_alunos_cadastrados.' alunos nesse Período</div>';
        $erro++;
    }
    //funcionarios
   
    

   if ($erro==0) {
        
    $antigo="Eliminado o Período: $nomedoperiodo";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idperiodo`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidperiodo=mysqli_query($conexao," DELETE FROM periodos where idperiodo='$idperiodo'");
    
      if($eliminandoidperiodo){
            echo '<div class="alert alert-success"> Período Eliminado com Sucesso <a href="index.php">Clique aqui para ir a página inicial!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar o período!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar o período! <br>
    Você não pode eliminar esse Período atravez dos alunos que foram encontrados neles... <br>
    <h4>Elimine primeiro a matrícula desses alunos, ou os mude para outro perído! </h4>
    </div>';
   }
    
}


?>