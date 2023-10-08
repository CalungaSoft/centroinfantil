<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
 
 
$idlogado=$_SESSION['funcionariologado'] ;
 

if(isset($_POST["idtransporte"])){
  
    $idtransporte=$_POST["idtransporte"];

    //Adminstradores 
    $erro=0;
    //Entradas
 
    //presenca
    //saida
    $registrosnasmatriculas=mysqli_num_rows(mysqli_query($conexao, "select idaluno from matriculatransporte where idtransporte='$idtransporte'")); 
    if($registrosnasmatriculas!=0){
        echo '<div class="alert alert-danger">a turma não pode ser eliminada, pois foram encontrados '.$registrosnasmatriculas.' registros de matrículas relacionadas a essa turma</div>';
        $erro++;
    }

    

   if ($erro==0) {
       
    


$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from transportes where idtransporte='$idtransporte' limit 1")); 

                           $turma=$dadosdaturma["titulo"];  
                           $idanolectivo=$dadosdaturma["idanolectivo"];

                            
                                    

    $antigo="Eliminada a turma do transporte: $turma ";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidtransporte=mysqli_query($conexao," DELETE FROM transportes where idtransporte='$idtransporte'");
    
      if($eliminandoidtransporte){
            echo '<div class="alert alert-success"> Turma do transporte Eliminada com Sucesso <a href="index.php">Clique aqui para actualizar a página!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar a Turma!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar a Turma! <br>
    Você não pode eliminar esse turma atravez dos registros que foram encontrados em nome dessa turma... <br>
    <h4>Elimine primeiro esses registros! </h4>
    </div>';
   }
    
}


?>