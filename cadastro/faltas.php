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

 

$iddisciplina=mysqli_escape_string($conexao, $_POST['iddisciplina']);
$idturma=mysqli_escape_string($conexao, $_POST['idturma']);
$idanolectivo=mysqli_escape_string($conexao, $_POST['idanolectivo']);

 $dadosdadisciplina= mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1")); 
 
$listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

   $colspan=mysqli_num_rows($listadetrimestre);
$htm='

 
<table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                  <thead>


                    <tr>  
                      <th rowspan="2" align="center">Nº</th>
                      <th rowspan="2" align="center">Nome do Estudante</th>
                      <th colspan="'.$colspan.'" align="center">Trimestres</th>
                      <th rowspan="2" align="center">Total</th>
                    </tr>

                     <tr>    
                      ';
                        while($exibir = $listadetrimestre->fetch_array()){
                           
                          $htm.='
                      <th align="center"  >'.$exibir["titulo"].'</th>';
                      }

                      $htm.='
 
                         
                    </tr>
 


                  </thead>
                  <tbody> 

                  '; 
        

                      $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by alunos.nomecompleto"); 

                          $n=1;
                         while($exibir = $lista->fetch_array()){

                          $htm.='
                    <tr>     
                      <td>'.$n.'</td> 
                      <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'"> '.$exibir['nomecompleto'].' </a></td> 
 
                    

                     ';
                     $n++;

                     $idaluno=$exibir["idaluno"];
                     $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
                      $total_individual=0;

                     
                      $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

                      while($exibir = $listadetrimestre->fetch_array()){

                          $idtrimestre=$exibir["idtrimestre"];
                        
                          

                             

 
                               $falta=mysqli_fetch_array(mysqli_query($conexao," SELECT valordafalta FROM faltas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' limit 1"))[0];
                              
                              

                              $total_individual+=$falta;

                              $htm.='
                          <th align="center" >'.$falta.'</th>';
                          

 

                            
                      }



                     $htm.=' <th align="center" style="color: blue" ><strong>'.$total_individual.'</strong></th>
                     </tr>';

                    }

                    $htm.='

 

                  </tbody>
                </table>';

                   if(($dadosdadisciplina["idprofessor"]==$idlogado || $dadosdadisciplina["idprofessorauxiliar"]==$idlogado ) || $painellogado=="areapedagogica" || $painellogado=="administrador"){

                    $htm.='

                  <a href="lancarfalta.php?iddisciplina='.$iddisciplina.'" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-users"></i> Lançar, editar ou eliminar falta </a> <br><br>
                   '; } 

                   $htm.='
                  
                                    <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
 ';




echo "$htm";



                   ?>

