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
                      <th>Turma</th> 
                      <th>Período</th>  
                      <th>Sala</th> 
                      <th>Classe</th> 
                      <th>Nº de Alunos</th>  
                    </tr>
                  </thead>
                  <tbody>
                  ';
                        $lista=mysqli_query($conexao, "select * from turmas where idcurso='$idcurso'"); 
                         while($exibir = $lista->fetch_array()){

                           $idturma=$exibir["idturma"];

                           $idperiodo=$exibir["idperiodo"];
                           $idcurso=$exibir["idcurso"];
                           $idsala=$exibir["idsala"];
                           $idclasse=$exibir["idclasse"];

                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];
 
                            $alunos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma'"));

                  $htm.='
                    <tr>  
                      <td> <a  href="turma.php?idturma='.$exibir["idturma"].'"> '.$exibir['titulo'].' </a></td> 

                      <td><a  href="periodo.php?idperiodo='.$exibir["idperiodo"].'">'.$periodo.'</a></td>  
                      <td><a  href="sala.php?idsala='.$exibir["idsala"].'">'.$sala.'</a></td> 
                      <td><a  href="classe.php?idclasse='.$exibir["idclasse"].'">'.$classe.'</a></td>  
                      <td>'.$alunos.'</td>   
                    </tr> 
                    '; } 

                    $htm.=' 
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
