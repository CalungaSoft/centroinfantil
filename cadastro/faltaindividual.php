
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
 

<h2>Faltas do Aluno </h2>

<table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                  <thead>


                    <tr>   
                      <th rowspan="2" align="center">Disciplina</th>
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
            

                      $listadedisciplinas=mysqli_query($conexao," SELECT iddisciplina, titulo FROM disciplinas where idturma='$idturma' order by titulo ");

                      while($mostrar = $listadedisciplinas->fetch_array()){

    
                            $iddisciplina=$mostrar["iddisciplina"];


                          $htm.='
                    <tr>     

                                   <th  align="center"><a href="disciplina.php?iddisciplina='.$mostrar["iddisciplina"].'">'.$mostrar["titulo"].'</a></th>
                      ';

              
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
                </table>

             
                  
                                    <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
 ';




echo "$htm";
