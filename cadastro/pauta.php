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

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
 

 $minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

  $dadosdadisciplina= mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1")); 
  $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

  if ($dadosdaturma["eclassedeexame"]!='Sim') {
    
     $minipauta='
     
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>';

         
        $numerodenotas_transicao=0;
        $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'"));

          $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                  
          $minipauta.='

          <tr>  
            <th rowspan="2" align="center">Nome do Estudante</th>
            <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
          </tr>
          ';

      

          $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

              
            while($exibir = $lista_de_trimestre->fetch_array()){
              
              $idtrimestre=$exibir["idtrimestre"];
              
              $vetor_trimestres[]=$idtrimestre;
 
              
                } 
            
            $minipauta.='
            

           <tr>  
           ';

           foreach ($vetor_trimestres as $key => $idtrimestre_v) {
          
                  
                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  ");

                    while($exibir = $lista->fetch_array()){
                      
                      $minipauta.=' 
                        <th align="center">'.$exibir["titulo"].'</th> 
                      ';
                     }
                      
              }
              
              $minipauta.='
            
          </tr>
        

        </thead>
        <tbody> 
          ';

              $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'"); 

               while($exibir = $lista->fetch_array()){


        $minipauta.='
          <tr>  
            <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'">'.$exibir['nomecompleto'].' </a></td>'; 

                

                       $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                       $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

                       while($observar = $listadetrimestre->fetch_array()){
 
                           $idtrimestre=$observar["idtrimestre"];
           
                            $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='denotas'"); 

                            while($visualizar = $lista_de_medias->fetch_array()){

                              
                              $idmedia=$visualizar["idmediadoano"];

                              
                     
                                $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                                $somatorio=0;
                                $numero_de_notas=mysqli_num_rows($lista_de_nota);
                             
                                while($ver = $lista_de_nota->fetch_array()){
                                  
                                  $idnotadoano=$ver["idnotadoano"];
                              
                                  $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                                  $somatorio+=$nota;
                                  
                                    
                               
                                 
                                  } 

                                  $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                                  $idmediamaior=$visualizar["idmediamaior"];

                                  $vetor_media_mediamaior[$idmedia]=$idmediamaior; // vai fazer um par de chaves - [idmedia]=[mediamaiorqueelapertence]
                                  $vetor_media[$idmedia]=$media; //vai guardar as médias

                                  if ($media>=$minimoparapositiva) {
                                    $cor="Blue";
                                 }else{
                                   $cor="red";
                                 }

                                  $minipauta.='  
                                  <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                   $cor='';

                                        
                     
                           }
                           
                           
                           $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='demedias'"); 

                           while($visualizar = $lista_de_medias->fetch_array()){
                             
                             $idmedia=$visualizar["idmediadoano"];

                             $somatorio=0;
                             $cont_medias=0;
                              foreach ($vetor_media_mediamaior as $key => $value) {
                                 
                                if($value==$idmedia){
                                  $cont_medias++;
                                 $somatorio+=$vetor_media[$key];
                                }

                              }
 

                                 $media=round($somatorio/$cont_medias,$visualizar["arredondarmedia"]);
                                 if ($media>=$minimoparapositiva) {
                                   $cor="Blue";
                                }else{
                                  $cor="red";
                                }

                                 $minipauta.='  
                                 <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                  $cor='';

                                       
                    
                          }  



                       }
 
                $minipauta.='


          </tr>   '; }
          $minipauta.='
        </tbody>
      </table>
   
      <br> 

      <a href="lancarnotapauta.php?iddisciplina='.$iddisciplina.'"><button  class="btn btn-primary"> Lançar Nota da Pauta </button></a>
        
      <br><br>
      
      <!-- Page level plugins -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
      <!-- Page level custom scripts -->
      <script src="js/demo/datatables-demo.js"></script>
    
      ';


      echo "$minipauta";
 }else {
    $minipauta='
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>';

   
  $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and (tipo='exame' or tipo='recurso')"));
  $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and (tipodemedia='ponderada' or tipodemedia='demedias')"));

 
    $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                            
    $minipauta.='

    <tr>  
      <th rowspan="2" align="center">Nome do Estudante</th>
      <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
    </tr>
    ';



    $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

        
      while($exibir = $lista_de_trimestre->fetch_array()){
        
        $idtrimestre=$exibir["idtrimestre"];
        
        $vetor_trimestres[]=$idtrimestre;

        
          } 
      
      $minipauta.='
      

     <tr>  
     ';

     foreach ($vetor_trimestres as $key => $idtrimestre_v) {
    
            
            $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='demedias' and percentagem!=0 and idtrimestre='$idtrimestre_v'  ");

              while($exibir = $lista->fetch_array()){
                
                $minipauta.=' 
                  <th align="center">'.$exibir["titulo"].'</th> 
                ';
               }

               $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='exame' and idtrimestre='$idtrimestre_v'  ");

              while($exibir = $lista->fetch_array()){
                
                $minipauta.=' 
                  <th align="center">'.$exibir["titulo"].'</th> 
                ';
               }

               $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='ponderada' and idtrimestre='$idtrimestre_v'  ");

              while($exibir = $lista->fetch_array()){
                
                $minipauta.=' 
                  <th align="center">'.$exibir["titulo"].'</th> 
                ';
               }


               $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");

               while($exibir = $lista->fetch_array()){
                 
                 $minipauta.=' 
                   <th align="center">'.$exibir["titulo"].'</th> 
                 ';
                }
                
        }
        
        $minipauta.='
    </tr>
  

  </thead>
  <tbody> 
    ';

        $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'"); 

         while($exibir = $lista->fetch_array()){

       

  $minipauta.='
    <tr>  
      <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'">'.$exibir['nomecompleto'].' </a></td>'; 

          

                 $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                 $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao desc limit 1 ");
                 $somatorio_geral=0;
                 $numero_de_notas_geral=0;
                 $somatorio_individual=0;


                 while($observar = $listadetrimestre->fetch_array()){

                     $idtrimestre=$observar["idtrimestre"];

                     //buscando media das médias dos trimestre
                     $listademeiamaior=mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='demedias' and percentagem!=0 and idtrimestre='$idtrimestre_v'  ");

                    
                  
                    
                     while($enxergar = $listademeiamaior->fetch_array()){
                      
                      $idmediamaior=$enxergar["idmediadoano"];

                      $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='denotas' and idmediamaior='$idmediamaior'"); 

                        //buscando as medias dos trimestre
                      while($visualizar = $lista_de_medias->fetch_array()){

                        
                        $idmedia=$visualizar["idmediadoano"];

                     
               
                          $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                          $somatorio=0;
                          $numero_de_notas=mysqli_num_rows($lista_de_nota);

                          //buscando as notas de cada média

                          
                          while($ver = $lista_de_nota->fetch_array()){
                            
                            $idnotadoano=$ver["idnotadoano"];
                            
                          
                            $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                         
                            $somatorio_individual+=$nota;
                            $numero_de_notas_geral++;
                            
                              
                         
                           
                            } 

                           
                            
                          
                           

                                  
               
                         }
                           
                         $media_geral=round($somatorio_individual/$numero_de_notas_geral,$enxergar["arredondarmedia"]);
                         if ($media_geral>=$minimoparapositiva) {
                              $cor="Blue";
                          }else{
                            $cor="red";
                          }

                            $valor_da_media=$media_geral; //media das medias do trimestre
                            $percentagem_media=$enxergar["percentagem"];

                            $minipauta.='  
                            <th align="center" style="color: '.$cor.'" >'.$media_geral.' </th>'; 
                            $cor='';
                    }
                     



                    //nota da prova final
                     $notada_prova= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='exame' and idtrimestre='$idtrimestre_v'  ");

                     $notas_da_prova=0;
                 

                     while($visualizar = $notada_prova->fetch_array()){
                       
                       $idnotadoano=$visualizar["idnotadoano"];

                       $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];

                         
                           if ($nota>=$minimoparapositiva) {
                             $cor="Blue";
                          }else{
                            $cor="red";
                          }

                          $notas_da_prova+=$nota*$visualizar["percentagem"];
                           $minipauta.='  
                           <th align="center" style="color: '.$cor.'" >'.$nota.' </th>'; 
                            $cor='';

                                 
              
                    }  


                    //media Ponderada

                    $arredondar_ponderada=mysqli_fetch_array(mysqli_query($conexao, "select arredondarmedia from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='ponderada'"))[0]; 


                      $nota_ponderada=round(($percentagem_media*$valor_da_media)+$notas_da_prova,$arredondar_ponderada);
                          if ($nota_ponderada>=$minimoparapositiva) {
                            $cor="Blue";
                         }else{
                           $cor="red";
                         }

                          $minipauta.='  
                          <th align="center" style="color: '.$cor.'" >'.$nota_ponderada.' </th>'; 
                           $cor='';

                     

                        //nota do recurso
                        $notada_prova= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");

                        while($visualizar = $notada_prova->fetch_array()){
                          
                          $idnotadoano=$visualizar["idnotadoano"];
    
                          $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
    
                            
                              if ($nota>=$minimoparapositiva) {
                                $cor="Blue";
                             }else{
                               $cor="red";
                             }
    
                              $minipauta.='  
                              <th align="center" style="color: '.$cor.'" >'.$nota.' </th>'; 
                               $cor='';
    
                                    
                            }

 


                 }

          $minipauta.='


    </tr>   '; }
    $minipauta.='
  </tbody>
</table>

     <br> 
      
      <a href="lancarnotapauta.php?iddisciplina='.$iddisciplina.'"><button  class="btn btn-primary"> Lançar Nota da Pauta </button></a>
        
      <br><br>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

';

 
      echo "$minipauta";
 }


?>