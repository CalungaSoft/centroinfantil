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

 
  
    
    $iddisciplina=mysqli_escape_string($conexao,$_POST['iddisciplina']); 
     $idtrimestre=mysqli_escape_string($conexao,$_POST['idtrimestre']); 
     $idturma=mysqli_escape_string($conexao,$_POST['idturma']); 

       $numerodeavaliacoes=mysqli_num_rows(mysqli_query($conexao, "select idavaliacao from avaliacoes where idtrimestre='$idtrimestre' and iddisciplina='$iddisciplina' ")); 

        $nomedadisciplina=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo FROM disciplinas where iddisciplina='$iddisciplina'"))[0];

 



                        $lista=mysqli_query($conexao, "select alunos.nomecompleto, alunos.idaluno, matriculaseconfirmacoes. idmatriculaeconfirmacao  from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' and matriculaseconfirmacoes.estatus='activo' order by alunos.nomecompleto"); 
 
                        while($exibir = $lista->fetch_array()){

                           

                        

                          $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
                          $nomedoaluno=$exibir['nomecompleto'];
                            $idaluno=$exibir["idaluno"];

                       
                       


                              $listadeavaliacoes=mysqli_query($conexao," SELECT idavaliacao, notavinculada FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' order by data asc ");

                                 $soma_nota=0;

                                  while($exibir_tipodeavaliacao = $listadeavaliacoes->fetch_array()){

                                    $idavaliacao=$exibir_tipodeavaliacao["idavaliacao"];
                                     $idnota_vinculada=$exibir_tipodeavaliacao["notavinculada"];

                                        $valordanota_vinculada=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  idnotadoano='$idnota_vinculada'  and iddisciplina='$iddisciplina' limit 1"))[0];


                                    $valordanota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notasavaliacao where idavaliacao='$idavaliacao' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"))[0];

                                    $soma_nota+=$valordanota;

                                     }

                                    $valordamedia=round(($soma_nota/$numerodeavaliacoes),2);

                                      $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnota_vinculada' and iddisciplina='$iddisciplina' limit 1"));

                            if($jaexiste==0){
 

                                        $cadastrar=mysqli_query($conexao,"INSERT INTO `notas` (`idnota`, `iddisciplina`, `idaluno`, `idnotadoano`, `idmatriculaeconfirmacao`, `valordanota`, `idturma`) VALUES (NULL, '$iddisciplina', '$idaluno', '$idnota_vinculada', '$idmatriculaeconfirmacao', '$valordamedia', '$idturma')");

                                                if($cadastrar){

                                                  
                                                    echo '<div class="alert alert-success"> A Nota ('.$valordamedia.') do estudante '.$nomedoaluno.' foi insirida  com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                                    
                                                }else{

                                                    echo '<div class="alert alert-danger">Ocorreu um erro ao insirir a nota<a href="">Clique aqui para actualizar a página!</a> </div>';


                                                }



                               

                                
                            }else{

                                 $dadosdanota=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' and idnotadoano='$idnota_vinculada' limit 1"));

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
 
  
            

 
 
         }
                
            
            
