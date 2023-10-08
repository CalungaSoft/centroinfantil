<?php 


session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

include("../conexao.php"); 

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

$idcurso=$_POST['idcurso'];

$htm='


	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Disciplina</th>  
                      <th>Professor</th> 
                      <th>Auxiliar</th> 
                      <th>Tipo</th>  
                      <th>Classe</th> 
                      <th>Ano Lectivo</th> 
                      <th>Ver Mais</th>
                    </tr>
                  </thead>
                  <tbody>
                  ';
                        $lista=mysqli_query($conexao, "SELECT disciplinas.* from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idcurso='$idcurso'"); 
                         while($exibir = $lista->fetch_array()){

                           $iddisciplina=$exibir["iddisciplina"];

                           $idprofessor=$exibir["idprofessor"];
                           $idprofessorauxiliar=$exibir["idprofessorauxiliar"];

                           $Professor=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessor'"))[0];

                          $Professorauxiliar=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar'"))[0];


                           $idturma=$exibir["idturma"];
                           $idanolectivo=$exibir["idanolectivo"];

                           $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));

                            $idcurso=$dadosdaturma["idcurso"]; 
                           $idclasse=$dadosdaturma["idclasse"];
 

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0]; 

                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0]; 

                   $htm.='
                    <tr>  
                      <td> <a  href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'"> '.$exibir['titulo'].' </a></td>  
                      <td><a  href="funcionario.php?idfuncionario='.$exibir["idprofessor"].'">'.$Professor.'</a></td>
                      <td><a  href="funcionario.php?idfuncionario='.$exibir["idprofessorauxiliar"].'">'.$Professorauxiliar.'</a></td>
                       <td>'.$exibir["tipodedisciplina"].'</td>  
                      <td><a  href="classe.php?idclasse='.$idclasse.'">'.$classe.'</a></td>   
                      <td><a  href="anolectivo.php?idanolectivo='.$idanolectivo.'">'.$anolectivo.'</a></td>      
                      <td align="center" title="Veja mais opções sobre esse disciplina">
                         <a  href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'" '.$exibir["iddisciplina"].'><i  class="fas fa-eye" ></i> </a>
                      </td>
                    </tr> 
                    '; } $htm.='
                  </tbody>
                </table>


                  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

';

echo "$htm";

?>
