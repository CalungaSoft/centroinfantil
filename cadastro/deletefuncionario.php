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

 

if(isset($_POST["idfuncionario"])){
  
    $idfuncionario=$_POST["idfuncionario"];

    //Adminstradores 
    $erro=0;
    //Entradas
    $registros_nas_entradas=mysqli_num_rows(mysqli_query($conexao, "select idfuncionario from entradas where idfuncionario='$idfuncionario'")); 
    if($registros_nas_entradas!=0){
        echo '<div class="alert alert-danger">O funcionário não pode ser eliminado, pois foram encontrados '.$registros_nas_entradas.' registros nas entradas</div>';
        $erro++;
    }
    //funcionarios
   
    //presenca
    //saida
    $registros_nas_saidas=mysqli_num_rows(mysqli_query($conexao, "select idfuncionario from saidas where idfuncionario='$idfuncionario'")); 
    if($registros_nas_saidas!=0){
        echo '<div class="alert alert-danger">O funcionário não pode ser eliminado, pois foram encontrados '.$registros_nas_saidas.' registros nas saídas relacionadas a esse funcionário</div>';
        $erro++;
    }

    //salario
    $registros_nas_salario=mysqli_num_rows(mysqli_query($conexao, "select idfuncionario from salario where idfuncionario='$idfuncionario'")); 
    if($registros_nas_salario!=0){
        echo '<div class="alert alert-danger">O funcionário não pode ser eliminado, pois foram encontrados '.$registros_nas_salario.' registros nos salários relacionados a esse funcionário</div>';
        $erro++;
    }
 

   if ($erro==0) {
       
    



    $dadosdoidfuncionario=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario, datadeentrada FROM  funcionarios where  idfuncionario='$idfuncionario'")); 
    $nomedofuncionario=$dadosdoidfuncionario["nomedofuncionario"];
    $data=$dadosdoidfuncionario["datadeentrada"];

    $antigo="Eliminado o funcionario: $nomedofuncionario deu entrada: $data";
    $novo="Eliminado";
           
    $incluindonoshistoricos=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
  

    $eliminandoidadmitradore=mysqli_query($conexao," DELETE FROM administradores where idfuncionario='$idfuncionario'");
    $eliminandoidpresenca=mysqli_query($conexao," DELETE FROM presenca where idfuncionario='$idfuncionario'");
    $eliminandoidhistorico=mysqli_query($conexao," DELETE FROM historico where idfuncionario='$idfuncionario'");
    $eliminandoidfuncionario=mysqli_query($conexao," DELETE FROM funcionarios where idfuncionario='$idfuncionario'");
    
      if($eliminandoidfuncionario){
            echo '<div class="alert alert-success"> funcionario Eliminado com Sucesso <a href="index.php">Clique aqui para actualizar a página!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar o funcionario!</div>';
     
    }
 




   }else {
    echo '<div class="alert alert-info">Ocorreu um erro ao eliminar o funcionario! <br>
    Você não pode eliminar esse funcionário atravez dos registros que foram encontrados em seu nome... <br>
    <h4>Elimine primeiro esses registros! </h4>
    </div>';
   }
    
}


?>