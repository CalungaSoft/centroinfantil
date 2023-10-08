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

 
  
    $idmatriculaeconfirmacao=mysqli_escape_string($conexao,$_POST['idmatriculaeconfirmacao']); 
    $iddisciplina=mysqli_escape_string($conexao,$_POST['iddisciplina']); 
     $idtrimestre=mysqli_escape_string($conexao,$_POST['idtrimestre']); 

  $valordamedia=mysqli_escape_string($conexao,$_POST['valordamedia']); 


    $dadosdamatricula=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"));
 
    $idaluno=$dadosdamatricula["idaluno"];
    $idturma=$dadosdamatricula["idturma"];

    $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 


    $idnotavinculada= mysqli_fetch_array(mysqli_query($conexao, "select notavinculada from avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' limit 1"))[0]; 

     $nomedadisciplina=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo FROM disciplinas where iddisciplina='$iddisciplina'"))[0];

      $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];
 

                                  
                            $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotavinculada' and iddisciplina='$iddisciplina' limit 1"));

                            if($jaexiste==0){
 

                                        $cadastrar=mysqli_query($conexao,"INSERT INTO `notas` (`idnota`, `iddisciplina`, `idaluno`, `idnotadoano`, `idmatriculaeconfirmacao`, `valordanota`, `idturma`) VALUES (NULL, '$iddisciplina', '$idaluno', '$idnotavinculada', '$idmatriculaeconfirmacao', '$valordamedia', '$idturma')");

                                                if($cadastrar){

                                                  
                                                    echo '<div class="alert alert-success"> A Nota ('.$valordamedia.') do estudante '.$nomedoaluno.' foi insirida  com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                                    
                                                }else{

                                                    echo '<div class="alert alert-danger">Ocorreu um erro ao insirir a nota<a href="">Clique aqui para actualizar a página!</a> </div>';


                                                }



                               

                                
                            }else{

                                 $dadosdanota=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' and idnotadoano='$idnotavinculada' limit 1"));

                                $idnota=$dadosdanota["idnota"];
                                $notaantiga=$dadosdanota["valordanota"];

                                if($valordamedia!=$notaantiga){

                                    $actualizar=mysqli_query($conexao,"UPDATE `notas` SET `valordanota` = '$valordamedia' WHERE `notas`.`idnota` = '$idnota'");

                                    if($actualizar){

                                        $antigo="A nota do aluno <a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a> da disciplina de $nomedadisciplina |Valor da Nota: $notaantiga ";
                                        $novo="Valor da Nota: $valordamedia";

                            
                                        $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                        


                                        echo '<div class="alert alert-success">Nota do aluno '.$nomedoaluno.' alterado com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                    }
              
                                

                            }

                        }

                       
                
            

 
 
         
                
            
            
