
<?php
 
 
 
include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $_POST['idmatriculaeconfirmacao']);
$idturma=mysqli_escape_string($conexao, $_POST['idturma']);


  $dados_da_matriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

      $idaluno=$dados_da_matriculaeconfirmacao["idaluno"];
      $idanolectivo=$dados_da_matriculaeconfirmacao["idanolectivo"];
      

$listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

   $colspan=mysqli_num_rows($listadetrimestre);

$htm=' 

<h2>Disciplinas em Atraso do Aluno </h2>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>   
                      <th>Turma</th>
                      <th>Classe</th>
                      <th>Curso</th> 
                      <th>Disciplina</th>
                      <th>Nota</th>
                      <th>Data</th> 
                      <th>Alterar</th> 
                    </tr>
                  </thead>
                  <tbody>
                  ';

                        $lista=mysqli_query($conexao, "select cadeirasdeixadas.iddisciplina, cadeirasdeixadas.valordanota, cadeirasdeixadas.data as datadacadeira,  matriculaseconfirmacoes.* from matriculaseconfirmacoes,   cadeirasdeixadas where    cadeirasdeixadas.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and cadeirasdeixadas.idaluno='$idaluno'"); 

                         while($exibir = $lista->fetch_array()){
                          
  

                             $iddisciplina=$exibir["iddisciplina"];

                            $disciplina=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from disciplinas where iddisciplina='$iddisciplina'"))[0];





                   $htm.='

                     <tr>  
                        <td><a href="turma.php?idturma='.$exibir["idturma"].'">'.$exibir['turma'].'</a></td>  
                       <td> '.$exibir['classe'].'</td>  
                        <td> '.$exibir['curso'].'</td>   
                       <td><a href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'">'.$disciplina.'</a></td> 
                      <td>'.$exibir['valordanota'].'</td>
                      <td>'.$exibir['datadacadeira'].'</td> 
                      <td align="center" title="Mudar nota dessa cadeira para poder elimina-la">
                         <a  href="lancarnotapauta.php?iddisciplina='.$exibir["iddisciplina"].'&eliminar=cadeira"> <button class="btn btn-success"> <i  class="fas fa-sync" ></i> </button> </a>
                      </td>
                    </tr> 
                    ';
                    } 
 $htm.='

                  </tbody>
                </table>

                <script> $("#botaoavaliacao").html("");</script>
 ';




echo "$htm";
