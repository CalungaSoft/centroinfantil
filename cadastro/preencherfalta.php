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
    $idfuncionario=mysqli_escape_string($conexao,$_POST['idfuncionario']);
    $falta=mysqli_escape_string($conexao,$_POST['falta']);  

    $salarioporhora=mysqli_fetch_array(mysqli_query($conexao,"SELECT salarioporhora FROM funcionarios where idfuncionario='$idfuncionario'"))[0];
    $nomedofuncionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario FROM funcionarios where idfuncionario='$idfuncionario'"))[0];
    $numerodehoras=mysqli_fetch_array(mysqli_query($conexao,"SELECT numerodehoras FROM funcionarios where idfuncionario='$idfuncionario'"))[0]+0;
    
    $horas=0;
    $aceita="sim";

    if ($falta=="12" || $falta=="67" || $falta=="68" || $falta=="69" || $falta=="72" || $falta=="73") {
        $remunerar=0;
        if($falta=="72" || $falta=="73"){
            $horas=4;
        }

        $salariopordia=0;

      

    } else if ($falta=="p" || $falta=="P" || $falta=="2" || $falta=="02" || $falta=="13" || $falta=="21" || $falta=="22" || $falta=="70" || $falta=="79"){
        
        $horas=$numerodehoras;
        $remunerar=1;
        $salariopordia=$horas*$salarioporhora;

    } else if(trim($falta)!='') {
        $aceita="não";
        echo '<div class="alert alert-danger">O valor insirido não foi reconhecido como código de presença/ausência</div>';
    }
 
         if (trim($falta)!='') {
         
                
                if($aceita=="sim"){

                    $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idfalta FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));

                    if($jaexiste==0){

                        $cadastrar=mysqli_query($conexao,"INSERT INTO `presenca` (`idfalta`, `idfuncionario`, `ano`, `dia`, `mes`, `falta`, `horastrabalhadas`, `horasextras`, `remunerar`, `salariopordia`) VALUES (NULL, '$idfuncionario', '$ano', '$dia', '$mes', '$falta', '$horas', '0', '$remunerar', '$salariopordia')");

                            if($cadastrar){

                              
                                echo '<div class="alert alert-success"> Código de Presença/falta foi insirido com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                
                            }

                    }else{

                        $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao,"SELECT idfalta, falta FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));

                        $idfalta=$dadosdafalta["idfalta"];
                        $faltaantiga=$dadosdafalta["falta"];

                        if($falta!=$faltaantiga){

                            $actualizar=mysqli_query($conexao,"UPDATE `presenca` SET `falta` = '$falta', `horastrabalhadas` = '$horas', `remunerar` = '$remunerar', `salariopordia` = '$salariopordia' WHERE `presenca`.`idfalta` = '$idfalta'");

                            if($actualizar){

                                $antigo="Código de Presença/falta do(a) <a href=funcionario.php?idfuncionario=$idfuncionario>$nomedofuncionario</a> do dia $dia/$mes/$ano |Código: $faltaantiga ";
                                $novo="Código: $falta";

                    
                                $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                


                                echo '<div class="alert alert-success"> Código de Presença/falta foi actualizado com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                            }

                        }
            
      
                        

                    }

                }
         }else{
            
            $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idfalta FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));
            
            if($jaexiste!=0){
                $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao,"SELECT idfalta, falta FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));

                $idfalta=$dadosdafalta["idfalta"];
                echo '<div class="alert alert-danger"> <h2> Queres mesmo eliminar esse registro de presença/falta ? <br><a href="presenca.php?dia='.$dia.'&mes='.$mes.'&ano='.$ano.'&del=yes&id='.$idfalta.'">Sim</a>  | <a href="">Não</a> </h2></div>';
            }
         }
            
                
            
            
