  <?php 
include("../conexao.php");


$iddisciplina=mysqli_escape_string($conexao, $_POST['iddisciplina']);
$idturma=mysqli_escape_string($conexao, $_POST['idturma']);
$idanolectivo=mysqli_escape_string($conexao, $_POST['idanolectivo']);


$htm=' <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                       <th>Nome Completo</th>  
                      <th>Nota</th>
                      <th>Data</th> 
                      <th>Alterar</th> 
                    </tr>
                  </thead>
                  <tbody>';
                   
                        $lista=mysqli_query($conexao, "select cadeirasdeixadas.iddisciplina, cadeirasdeixadas.valordanota, cadeirasdeixadas.data as datadacadeira, alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos, cadeirasdeixadas where matriculaseconfirmacoes.idaluno=alunos.idaluno  and cadeirasdeixadas.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and cadeirasdeixadas.iddisciplina='$iddisciplina'"); 

                         while($exibir = $lista->fetch_array()){
                          

                          $idaluno=$exibir["idaluno"];

                            $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto from alunos where idaluno='$idaluno'"))[0];

                             $iddisciplina=$exibir["iddisciplina"];

                            $disciplina=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from disciplinas where iddisciplina='$iddisciplina'"))[0];





                  $htm.='
                     <tr>  
                      <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'"> '.$nomedoaluno.'</a></td>    
                      <td>'.$exibir['valordanota'].'</td>
                      <td>'.$exibir['datadacadeira'].'</td> 
                      <td align="center" title="Mudar nota dessa cadeira para poder elimina-la">
                         <a  href="lancarnotapauta.php?iddisciplina='.$exibir["iddisciplina"].'&eliminar=cadeira"> <button class="btn btn-success"> <i  class="fas fa-sync" ></i> </button> </a>
                      </td>
                    </tr>'; 
                    }

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