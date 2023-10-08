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

 

$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $_POST['idmatriculaeconfirmacao']);

$matriculasdesseano= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where  idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"));


$idturma=$matriculasdesseano["idturma"];
$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 
 
    $idanolectivo=$dadosdaturma["idanolectivo"];
  

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
 

 $minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

   $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

   
  if ($dadosdaturma["eclassedeexame"]!='Sim') {
    
     $minipauta='
     
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>';

         
          $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
          $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' "));

          $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                  
          $minipauta.='

          <tr>  
            <th rowspan="3" align="center">Disciplina</th>
            <th colspan="'.$colSpan_dis.'" align="center">Trimestre</th>
          </tr>
          <tr>  ';

      

          $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

              
            while($exibir = $lista_de_trimestre->fetch_array()){
              
              $idtrimestre=$exibir["idtrimestre"];
              
              $vetor_trimestres[]=$idtrimestre;

              $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
              $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas'  "));

              $colSpan_tri=$numerodenotas_transicao+$numerodemedias_transicao;
                 
              
              
              $minipauta.='

            <th align="center" colspan="'.$colSpan_tri.'">'.$exibir["titulo"].'</th> 
             '; } 
            
            $minipauta.='
              </tr>

           <tr>  
           ';

           foreach ($vetor_trimestres as $key => $idtrimestre_v) {
          
                  $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre_v' order by posicao asc");

                    while($exibir = $lista->fetch_array()){
                      
                      $minipauta.=' 
                          <th align="center">'.$exibir["titulo"].'</th> 
                      ';
                      
                      } 
                      
                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

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

              $lista=mysqli_query($conexao, "select * from  disciplinas where idturma='$idturma'"); 

               while($exibir = $lista->fetch_array()){

                  $iddisciplina=$exibir["iddisciplina"];

        $minipauta.='
          <tr>  
            <td> <a  href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'">'.$exibir['titulo'].' </a></td>'; 

                
 
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
                                  if ($nota>=$minimoparapositiva) {
                                     $cor="Blue";
                                  }else{
                                    $cor="red";
                                  }
                                
                                    $minipauta.='  
                                    <th align="center" style="color: '.$cor.'" >'.$nota.'</th>'; 
                                 
                                  } 

                                  $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
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
      

 

      <!-- Page level plugins -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
      <!-- Page level custom scripts -->
      <script src="js/demo/datatables-demo.js"></script>';


      echo "$minipauta";
 }else {
    
     $minipauta='
     
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>';

         
          $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' "));
          $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas' "));

          $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                  
          $minipauta.='

          <tr>  
            <th rowspan="3" align="center">Disciplina</th>
            <th colspan="'.$colSpan_dis.'" align="center">Trimestre</th>
          </tr>
          <tr>  ';

      

          $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

              
            while($exibir = $lista_de_trimestre->fetch_array()){
              
              $idtrimestre=$exibir["idtrimestre"];
              
              $vetor_trimestres[]=$idtrimestre;

              $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='exame' "));
              $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas'  "));

              $colSpan_tri=$numerodenotas_transicao+$numerodemedias_transicao;
                 
              
              
              $minipauta.='

            <th align="center" colspan="'.$colSpan_tri.'">'.$exibir["titulo"].'</th> 
             '; } 
            
            $minipauta.='
              </tr>

           <tr>  
           ';

           foreach ($vetor_trimestres as $key => $idtrimestre_v) {
          
                  $lista= mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idanolectivo='$idanolectivo' and  tipodeturma='exame' and idtrimestre='$idtrimestre_v' order by posicao asc");

                    while($exibir = $lista->fetch_array()){
                      
                      $minipauta.=' 
                          <th align="center">'.$exibir["titulo"].'</th> 
                      ';
                      
                      } 
                      
                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

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

          $lista=mysqli_query($conexao, "select * from  disciplinas where idturma='$idturma'"); 

          while($exibir = $lista->fetch_array()){

             $iddisciplina=$exibir["iddisciplina"];

        $minipauta.='
          <tr>  
          <td> <a  href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'">'.$exibir['titulo'].' </a></td>'; 

                
 
                       $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

                       while($observar = $listadetrimestre->fetch_array()){
 
                           $idtrimestre=$observar["idtrimestre"];
           
                            $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='denotas'"); 

                            while($visualizar = $lista_de_medias->fetch_array()){
                              
                              $idmedia=$visualizar["idmediadoano"];
                     
                                $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                                $somatorio=0;
                                $numero_de_notas=mysqli_num_rows($lista_de_nota);
                             
                                while($ver = $lista_de_nota->fetch_array()){
                                  
                                  $idnotadoano=$ver["idnotadoano"];
                              
                                  $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                                  $somatorio+=$nota;
                                  if ($nota>=$minimoparapositiva) {
                                     $cor="Blue";
                                  }else{
                                    $cor="red";
                                  }
                                
                                    $minipauta.='  
                                    <th align="center" style="color: '.$cor.'" >'.$nota.'</th>'; 
                                 
                                  } 

                                  $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
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
      
      
   

      <!-- Page level plugins -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
      <!-- Page level custom scripts -->
      <script src="js/demo/datatables-demo.js"></script>
     ';


      echo "$minipauta";
 }


?>