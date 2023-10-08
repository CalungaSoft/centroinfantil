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

 
 

   
    $dia=mysqli_escape_string($conexao,$_POST['dia']);
    $iddisciplina=mysqli_escape_string($conexao,$_POST['iddisciplina']);
    $tempos=mysqli_escape_string($conexao,$_POST['tempos']);  
    $salario_portempo=mysqli_escape_string($conexao,$_POST['salario_portempo']); 
    $auxiliar=mysqli_escape_string($conexao,$_POST['auxiliar']); 


    if($auxiliar==0){

        $idfuncionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT idprofessor FROM disciplinas where iddisciplina='$iddisciplina'"))[0]; 

    }else{

          $idfuncionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT idprofessorauxiliar FROM disciplinas where iddisciplina='$iddisciplina'"))[0]; 
         
    }
     

      $idanolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT idanolectivo FROM disciplinas where iddisciplina='$iddisciplina'"))[0]; 

         

    $nomedofuncionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario FROM funcionarios where idfuncionario='$idfuncionario'"))[0];

    
  
  
     if(!is_numeric($tempos) && $tempos!='') {
 
        echo '<div class="alert alert-danger">O valor inserido deve ser um número</div>';
    }
 
         if (is_numeric($tempos)) {
         
                
                

                    $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idpresencaprofessor FROM presencaprofessores where idprofessor='$idfuncionario' and diadapresenca='$dia' and iddisciplina='$iddisciplina' limit 1"));

                    if($jaexiste==0){

                        $cadastrar=mysqli_query($conexao,"INSERT INTO `presencaprofessores` (`idpresencaprofessor`, `idprofessor`, `diadapresenca`, `totaldetempos`, `salarioportempo`, `iddisciplina`) VALUES (NULL, '$idfuncionario', '$dia', '$tempos', '$salario_portempo', '$iddisciplina')");

                            if($cadastrar){

                              
                                echo '<div class="alert alert-success"> Presença marcada com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                
                            }else{

                                  echo '<div class="alert alert-danger">Ocorreu um erro, actualiza a página e tente novamente!</div>';

                            }

                    }else{

                        $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM presencaprofessores where idprofessor='$idfuncionario' and  diadapresenca='$dia' and iddisciplina='$iddisciplina' limit 1"));

                        $idpresencaprofessor=$dadosdafalta["idpresencaprofessor"];
                        $tempos_antigo=$dadosdafalta["totaldetempos"];
                        $salarioportempo_antigo=$dadosdafalta["salarioportempo"];

                        if($tempos!=$tempos_antigo || $salarioportempo!=$salarioportempo_antigo){

                            $actualizar=mysqli_query($conexao,"UPDATE `presencaprofessores` SET `totaldetempos` = '$tempos', `salarioportempo` = '$salario_portempo'  WHERE idpresencaprofessor= '$idpresencaprofessor'");

                            if($actualizar){

                                $antigo="Nº de tempos do(a) <a href=funcionario.php?idfuncionario=$idfuncionario>$nomedofuncionario</a> do dia $dia |Tempos: $tempos_antigo | Salário por tempo: $salarioportempo_antigo ";
                                $novo="Tempo: $tempos | Salário por tempo: $salario_portempo";

                    
                                $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                


                                echo '<div class="alert alert-success"> Tempos  actualizado com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                            }

                        }
            
      
                        

                    }

               
         }



         if(trim($tempos)==''){
            
            $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idpresencaprofessor FROM presencaprofessores where idprofessor='$idfuncionario' and  diadapresenca='$dia' and iddisciplina='$iddisciplina' limit 1"));
            
            if($jaexiste!=0){

                $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM presencaprofessores where idprofessor='$idfuncionario' and  diadapresenca='$dia' and iddisciplina='$iddisciplina' limit 1"));

                        $idpresencaprofessor=$dadosdafalta["idpresencaprofessor"];
             
                $dadosdafalta=mysqli_query($conexao,"DELETE  FROM presencaprofessores where idpresencaprofessor='$idpresencaprofessor' limit 1");


                echo '<div class="alert alert-success"> <h2>Registo Eliminado com Sucesso</div>';
            }
         }
            
                
            
            
