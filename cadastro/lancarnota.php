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
    $idnotadoano=mysqli_escape_string($conexao,$_POST['idnotadoano']);
    $valordanota=mysqli_escape_string($conexao,trim($_POST['valordanota']));
    $iddisciplina=mysqli_escape_string($conexao,$_POST['iddisciplina']); 


    //limpando espaços em branco do valor da nota
    $valordanota=str_replace(' ', '', $valordanota);

    $dadosdamatricula=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"));

    $idaluno=$dadosdamatricula["idaluno"];
    $idturma=$dadosdamatricula["idturma"];

    $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 


     $nomedadisciplina=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo FROM disciplinas where iddisciplina='$iddisciplina'"))[0];

      $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];



     $dados_do_tipo_de_nota=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM notasdoano where idnotadoano='$idnotadoano'"));

            $valormaximo=$dadosdaturma["valormaximo"];
            $valorminimo=$dadosdaturma["valorminimo"]; 

           

            



                        if (trim($valordanota)!='') {
                 
                        
                     
                            $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idnota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' and idnotadoano='$idnotadoano' limit 1"));

                            if($jaexiste==0){
 
                                 if($valordanota<$valorminimo || $valordanota>$valormaximo){

                                    echo '<div class="alert alert-danger"> <h2> O Valor da Nota insirida não é válido, por favor insira valores no intervalo de '.$valorminimo.' à '.$valormaximo.' </h2> ATT: Não Insira espaços em branco nem antes nem depois do valor da nota</div>';

                                    }else{


                                        $cadastrar=mysqli_query($conexao,"INSERT INTO `notas` (`idnota`, `iddisciplina`, `idaluno`, `idnotadoano`, `idmatriculaeconfirmacao`, `valordanota`, `idturma`) VALUES (NULL, '$iddisciplina', '$idaluno', '$idnotadoano', '$idmatriculaeconfirmacao', '$valordanota', '$idturma')");

                                                if($cadastrar){

                                                  
                                                    echo '<div class="alert alert-success"> A Nota ('.$valordanota.') do estudante foi insirida com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                                    
                                                }else{

                                                    echo '<div class="alert alert-danger">Ocorreu um erro ao insirir a nota<a href="">Clique aqui para actualizar a página!</a> </div>';


                                                }



                                    }

                                
                            }else{

                                $dadosdanota=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' and idnotadoano='$idnotadoano' limit 1"));

                                $idnota=$dadosdanota["idnota"];
                                $notaantiga=$dadosdanota["valordanota"];

                                if($valordanota!=$notaantiga){

                                    $actualizar=mysqli_query($conexao,"UPDATE `notas` SET `valordanota` = '$valordanota' WHERE `notas`.`idnota` = '$idnota'");

                                    if($actualizar){

                                        $antigo="A nota do aluno <a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a> da disciplina de $nomedadisciplina |Valor da Nota: $notaantiga ";
                                        $novo="Valor da Nota: $valordanota";

                            
                                        $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                        


                                        echo '<div class="alert alert-success">Nota do aluno alterado com sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                    }

                                }
                    
              
                                

                            }

                       
                 }else{
                    
                    $jaexiste=mysqli_num_rows(mysqli_query($conexao,"SELECT idnota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' and idnotadoano='$idnotadoano' limit 1"));
                    
                    if($jaexiste!=0){
                        $dadosdanota=mysqli_fetch_array(mysqli_query($conexao,"SELECT idnota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' and idnotadoano='$idnotadoano' limit 1"));

                        $idnota=$dadosdanota["idnota"];
                        echo '<div class="alert alert-danger"> <h2> Queres mesmo eliminar essa nota ? <br><a href="lancarnota.php?iddisciplina='.$iddisciplina.'&del=yes&id='.$idnota.'">Sim</a>  | <a href="">Não</a> </h2></div>';
                    }
                 }
            

 
 
         
                
            
            
