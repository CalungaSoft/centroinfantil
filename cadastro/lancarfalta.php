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

 
 

  
    $ano=mysqli_escape_string($conexao,$_POST['ano']);
    $mes=mysqli_escape_string($conexao,$_POST['mes']);
    $dia=mysqli_escape_string($conexao,$_POST['dia']);
    $idmatricula=mysqli_escape_string($conexao,$_POST['idmatricula']);
    $iddisciplina=mysqli_escape_string($conexao,$_POST['iddisciplina']);
    $falta=mysqli_escape_string($conexao,$_POST['falta']);  

    $salarioporhora=mysqli_fetch_array(mysqli_query($conexao,"SELECT salarioporhora FROM funcionarios where idmatricula='$idmatricula'"))[0];
    $idaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT idaluno FROM matriculas where idmatricula='$idmatricula'"))[0];
    $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];
   
    $horas=0;
    $aceita="sim";

    if (!($falta=="P" || $falta=="p" || $falta=="f" || $falta=="F" || $falta==0)) {
       
        $aceita="não";
        echo '<div class="alert alert-danger">O valor insirido não foi reconhecido, use somente F(falta) ou P(para presença) ou 0</div>';
    

    }  
 
    $data_falta="$ano-$mes-$dia";

         if (trim($falta)!='') {
         
                
                if($aceita=="sim"){

                    $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idfalta FROM faltas where idmatricula='$idmatricula' and data='$data_falta' and iddisciplina='$iddisciplina' limit 1"));

                    if($jaexiste==0){

                        $cadastrar=mysqli_query($conexao,"INSERT INTO `faltas` (`idfalta`, `idaluno`, `idmatricula`, `iddisciplina`,  `falta`, `pago`, `data`) VALUES (NULL, '$idaluno', '$idmatricula', '$iddisciplina', '$falta', '0', '$data_falta')");

                            if($cadastrar){

                              
                                echo '<div class="alert alert-success">  Presença/falta foi insirido com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                
                            }

                    }else{

                        $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao,"SELECT idfalta FROM faltas where idmatricula='$idmatricula' and data='$data_falta' and iddisciplina='$iddisciplina' limit 1"));

                        $idfalta=$dadosdafalta["idfalta"];
                        $faltaantiga=$dadosdafalta["falta"];

                        if($falta!=$faltaantiga){

                            $actualizar=mysqli_query($conexao,"UPDATE `presenca` SET `falta` = '$falta' WHERE `presenca`.`idfalta` = '$idfalta'");

                            if($actualizar){

                                $antigo="Código de Presença/falta do(a) <a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a> do dia $dia/$mes/$ano |Código: $faltaantiga ";
                                $novo="Código: $falta";

                    
                                $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idmatricula`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                


                                echo '<div class="alert alert-success"> Código de Presença/falta foi actualizado com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                            }

                        }
            
      
                        

                    }

                }
         } 
            
                
            
            
