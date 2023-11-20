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

 
 
 

    $ano=mysqli_escape_string($conexao,$_POST['ano']);
    $mes=mysqli_escape_string($conexao,$_POST['mes']);
    $dia=mysqli_escape_string($conexao,$_POST['dia']);
    $idmatricula=mysqli_escape_string($conexao,$_POST['idmatricula']);
    $presenca=mysqli_escape_string($conexao,$_POST['presenca']);  
 
    $id_aluno = mysqli_fetch_array(mysqli_query($conexao, "select idaluno from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatricula'  limit 1"))[0];

    $aluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$id_aluno'"))[0]; 
    
    $horas=0;
    $aceita="sim";
 
   
    if(!(trim($presenca)=='p' || trim($presenca)=='P' || trim($presenca)=='f' || trim($presenca)=='F') ) {
        $aceita="Não";
        echo '<div class="alert alert-danger">O valor inserido não foi reconhecido como código de presença/ausência, use apenas F para falta ou P para presença</div>';
    }
    
 
 
         if (trim($presenca)!='') {
         
              
                if($aceita=="sim"){

                    $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT id FROM presencaalunos where idmatricula='$idmatricula' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));

                    if($jaexiste==0){

                        $cadastrar=mysqli_query($conexao,"INSERT INTO `presencaalunos` (`id`, `idmatricula`, `ano`, `dia`, `mes`, `presenca`) VALUES (NULL, '$idmatricula', '$ano', '$dia', '$mes', '$presenca')");

                            if($cadastrar){

                              
                                echo "<div class='alert alert-success'> Código de Presença/Ausencia do aluno $aluno no dia $dia/$mes/$ano insirido com sucesso </div>";
                                
                            }

                    }else{

                        $dadosdapresenca=mysqli_fetch_array(mysqli_query($conexao,"SELECT id, presenca FROM presencaalunos where idmatricula='$idmatricula' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));

                        $id=$dadosdapresenca["id"];
                        $presencaantiga=$dadosdapresenca["presenca"];

                        if($presenca!=$presencaantiga){

                            $actualizar=mysqli_query($conexao,"UPDATE `presencaalunos` SET `presenca` = '$presenca'  WHERE `presencaalunos`.`id` = '$id'");

                            if($actualizar){

                                $antigo="Código de Presença/presenca do(a) <a href=aluno.php?idaluno=$id_aluno>$nomedoaluno</a> do dia $dia/$mes/$ano |Código: $presencaantiga ";
                                $novo="Código: $presenca";

                    
                                $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idmatricula`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                


                                echo '<div class="alert alert-success"> Código de Presença/presenca foi actualizado com sucesso  </div>';
                            }

                        }
            
      
                        

                    }

                }
         }else{
            
            $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT id FROM presencaalunos where idmatricula='$idmatricula' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));
            
            if($jaexiste!=0){
                $dadosdapresenca=mysqli_fetch_array(mysqli_query($conexao,"SELECT id, presenca FROM presencaalunos where idmatricula='$idmatricula' and ano='$ano' and dia='$dia' and mes='$mes' limit 1"));

                $id=$dadosdapresenca["id"];
                echo '<div class="alert alert-danger"> <h2> Queres mesmo eliminar esse registro de presença/presenca ? <br><a href="presencaalunopordia.php?dia='.$dia.'&mes='.$mes.'&ano='.$ano.'&del=yes&id='.$id.'">Sim</a>  | <a href="">Não</a> </h2></div>';
            }
         }
            
                
            
            
