
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
$idtrimestre=mysqli_escape_string($conexao, $_POST['idtrimestre']);


  $dados_da_matriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

      $idaluno=$dados_da_matriculaeconfirmacao["idaluno"];
      $idanolectivo=$dados_da_matriculaeconfirmacao["idanolectivo"];
      

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
     $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);

    $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM turmas where idturma='$idturma' "));

    $eclassedeexame=$dadosdaturma['eclassedeexame'];
     $minimoparapositiva=$dadosdaturma["minimoparapositiva"];
    
    if($eclassedeexame=='Sim'){  $colspan_do_anolectivo=4; }else{ $colspan_do_anolectivo=3;  }


$htm='
  
    <a href=""  id="avaliacao" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-check"></i> Avaliações </a> 
             
                    <a href=""  id="minipauta" class="d-sm-inline-block btn btn-sm btn-secondary" ><i class="fas fa-fw fa-print"></i> Mini-Pauta </a> 

                     <a href="" id="pauta" class="d-sm-inline-block btn btn-sm btn-success"><i class="fas fa-fw fa-print"></i> Pauta</a>   
      
 
                  <a href="" id="falta" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-calendar"></i> Faltas </a> 

 

                  <a href="" id="cadeira" class="d-sm-inline-block btn btn-sm btn-danger" ><i class="fas fa-fw fa-book"></i> Cadeira em atraso </a> 

                  <a href="" id="propina" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-money"></i> Propinas </a>  <br><br>


<h2>Avaliações Contínuas do Aluno do  
                    <select  id="idtrimestre" required  class="d-sm-inline-block" > 
                     ';
                           $lista=mysqli_query($conexao,"SELECT * from trimestres where idanolectivo='$idanolectivo' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ 
                            $htm.='
                          <option '; if($exibir["idtrimestre"]==$idtrimestre){$htm.='"selected"';} $htm.=' value="'.$exibir["idtrimestre"].'">'.$exibir["titulo"].'</option>
                      '; } 
                      $htm.='
                    </select>  

                    Trimestre </h2> 
<table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                  <thead>


                    <tr>       
                     <th >Disciplina</th>
                                       ';

                            $lista=mysqli_query($conexao, "SELECT disciplinas.* from disciplinas where disciplinas.idturma='$idturma'"); 


                            $maior=0;

                         while($exibir = $lista->fetch_array()){ 

                              $iddisciplina=$exibir["iddisciplina"];

                               $numeromaiordeavaliacao=mysqli_fetch_array(mysqli_query($conexao, "SELECT count(idavaliacao) from avaliacoes where iddisciplina='$iddisciplina' "))[0];

                               if($numeromaiordeavaliacao>$maior){
                                $maior=$numeromaiordeavaliacao;
                               }

                            }


                   
 
                
                         for ($i=1; $i <=$maior ; $i++) { 
                          

                          $htm.='
                      <th  align="center">'.$i.'ª</th>
                    
                     ';}


                     $htm.='

                         <th rowspan="2" >Média</th>
                      </tr>


                  </thead>
                  <tbody> 
                      
                      ';  $listadedisciplinas=mysqli_query($conexao," SELECT iddisciplina, titulo FROM disciplinas where idturma='$idturma' order by titulo ");



                      while($mostrar = $listadedisciplinas->fetch_array()){

    
                            $iddisciplina=$mostrar["iddisciplina"];


                          $htm.='
                    <tr>     

                                   <th  align="center"><a href="disciplina.php?iddisciplina='.$mostrar["iddisciplina"].'">'.$mostrar["titulo"].'</a></th>';

                                    $listadeavaliacoes=mysqli_query($conexao," SELECT idavaliacao FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' order by data asc ");

                                 $soma_nota=0;
                                 $numerodeavaliacoes=0;

                                 $antigomaior=$maior;

                                  while($exibir_tipodeavaliacao = $listadeavaliacoes->fetch_array()){

                                    $idavaliacao=$exibir_tipodeavaliacao["idavaliacao"];

                                    $maior--;
                                    $numerodeavaliacoes++;


                                    $valordanota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notasavaliacao where idavaliacao='$idavaliacao' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"))[0];

                                    $soma_nota+=$valordanota;

                                    if ($valordanota>=$minimoparapositiva) {
                                         $cor="Blue";
                                      }else{
                                        $cor="red";
                                      }

                                      $htm.='
                                        

                                        <td  >'.$valordanota.'</td>';


                                  }  

                                    if($numerodeavaliacoes>0){

                                      $media=round(($soma_nota/$numerodeavaliacoes),2);
                                    }else{
                                      $media=0;
                                    }

                                    if ($media>=$minimoparapositiva) {
                                         $cor_media="Blue";
                                      }else{
                                        $cor_media="red";
                                      }

                               

                                  for ($i=1; $i <=$maior ; $i++) { 
                          

                                              $htm.='
                                          <th  align="center"></th>
                                        
                                         ';}
                            

                            $htm.='

                             <td  align="center" style="color: '.$cor_media.'" >'.$media.'</td>
                               
                                     

                      </tr> '; $maior=$antigomaior;

                    }

                      $htm.='     
                          
                  </tbody>
                </table>

 <script>

  $(document).on("change", "#idtrimestre", function(event){
            
          var idmatriculaeconfirmacao='.$idmatriculaeconfirmacao.'; 
          var idturma='.$idturma.' ;
         var idtrimestre=$("#idtrimestre option:selected").val();

                          $.ajax({
                              url:"cadastro/avaliacaoindividual.php",
                              method:"POST",
                              data:{
                                  idmatriculaeconfirmacao, idturma, idtrimestre
                              },
                              success: function(data){
                                  $("#mensagemdealerta").html(data);
                    
                              }

                          })                                    
                                                                    
                                                                   
            })
           
           
        

 </script>
                   <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
 
 ';



echo "$htm";
 