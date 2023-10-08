<?php

include("../conexao.php");


include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
 

  
    $idfalta=mysqli_escape_string($conexao,$_POST['idfalta']); 
    $horas=mysqli_escape_string($conexao,$_POST['horas']);  
    $idfuncionario=mysqli_escape_string($conexao,$_POST['idfuncionario']);  

    $salarioporhora=mysqli_fetch_array(mysqli_query($conexao,"SELECT salarioporhora FROM funcionarios where idfuncionario='$idfuncionario'"))[0];

    $nomedofuncionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario FROM funcionarios where idfuncionario='$idfuncionario'"))[0];
    
  
    $salariopelahorasextras=$horas*$salarioporhora;
 
         if (trim($horas)!=''){
          

                        $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao,"SELECT horasextras, dia, mes, ano FROM presenca where idfalta='$idfalta'"));

                    
                        $horasextrasantiga=$dadosdafalta["horasextras"];

                        $dia=$dadosdafalta["dia"];
                        $mes=$dadosdafalta["mes"];
                        $ano=$dadosdafalta["ano"];

                        if($horas!=$horasextrasantiga){

                            if($horas>0 || $horas==0){

                                
                                        $antigo="As horas extra do(a) <a href=funcionario.php?idfuncionario=$idfuncionario>$nomedofuncionario</a> do dia $dia/$mes/$ano |Horas: $horasextrasantiga ";
                                        $novo="Horas: $horas";

                            
                                        $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                        
                                        if($guardar){
                                        
                                            $actualizar=mysqli_query($conexao,"UPDATE `presenca` SET `horasextras` = '$horas', `salariopelahorasextras` = '$salariopelahorasextras' WHERE `presenca`.`idfalta` = '$idfalta'");

                                                if($actualizar){
                                                    echo '<div class="alert alert-success">Horas Extras actualizada com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                                }else{
                    
                                                    echo '<div class="alert alert-danger">Ocorreu um erro </div>';
                                                }
                                            
                                        }else{

                                            echo '<div class="alert alert-danger">Ocorreu um erro ao guardar nos histórico</div>';

                                        }

                            } 

          

                        }
            
      
                        

                    }else{

                        echo '<div class="alert alert-danger">Campo vazio não pode ser alterado</div>';

                    }

 
            
            
