<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
 
 
$idlogado=$_SESSION['funcionariologado'] ;
 

if(isset($_POST["idturma"])){
  
    $idturma=$_POST["idturma"];

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_nas_entradas=mysqli_num_rows(mysqli_query($conexao, "select idturma from entradas where idturma='$idturma'")); 
    if($registros_nas_entradas!=0){
        echo '<div class="alert alert-danger">a turma não pode ser eliminada, pois foram encontrados '.$registros_nas_entradas.' registros nas entradas</div>';
        $erro++;
    }
    //Turmas
   
    //presenca
    //saida
    $registrosnasmatriculas=mysqli_num_rows(mysqli_query($conexao, "select idaluno from matriculaseconfirmacoes where idturma='$idturma'")); 
    if($registrosnasmatriculas!=0){
        echo '<div class="alert alert-danger">a turma não pode ser eliminada, pois foram encontrados '.$registrosnasmatriculas.' registros de matrículas e reconfirmações relacionadas a essa turma</div>';
        $erro++;
    }

    

   if ($erro==0) {
       
    


$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                           $turma=$dadosdaturma["titulo"]; 
                           $idperiodo=$dadosdaturma["idperiodo"];
                           $idcurso=$dadosdaturma["idcurso"];
                           $idsala=$dadosdaturma["idsala"];
                           $idclasse=$dadosdaturma["idclasse"];
                           $idanolectivo=$dadosdaturma["idanolectivo"];

                           $propina=$dadosdaturma["propina"];
                           $matricula=$dadosdaturma["matricula"];
                           $reconfirmacao=$dadosdaturma["reconfirmacao"];
 


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                                    

    $antigo="Eliminada a turma: $turma | classe: $classe , Período $periodo , curso: $curso , sala $sala";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  
 
    $eliminandoidturma=mysqli_query($conexao," DELETE FROM turmas where idturma='$idturma'");
    
      if($eliminandoidturma){
            echo '<div class="alert alert-success"> Turma Eliminada com Sucesso <a href="index.php">Clique aqui para actualizar a página!</a> </div>';
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