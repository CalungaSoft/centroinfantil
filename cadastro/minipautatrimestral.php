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
$idtrimestre=mysqli_escape_string($conexao, $_POST['idtrimestre']);

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
 

 $minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

  $dadosdadisciplina= mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1")); 
  $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

  
  $minipauta='  
  <form action="" method="post">
  <input type="hidden" id="iddisciplina" value="'.$iddisciplina.'">  
<br>
<h2>Minipauta de(o)  
      <select  id="idtrimestre" name="idtrimestre" required  class="d-sm-inline-block" > 
      <option  value="0">Todos</option>
         ';
               $lista=mysqli_query($conexao,"SELECT * from trimestres where idanolectivo='$idanolectivo' order by titulo desc");
              while($exibir = $lista->fetch_array()){ 
                $minipauta.='
              <option '; if($exibir["idtrimestre"]==$idtrimestre){ $minipauta.='selected';} else{ $minipauta.=''; } $minipauta.=' value="'.$exibir["idtrimestre"].'">'.$exibir["titulo"].'</option>
          '; } 
          $minipauta.='
        </select>  

        Trimestre 
        <button  name="imprimirminipauta" class="d-sm-inline-block btn btn-sm btn-success" > <i class="fas fa-fw fa-print"></i> Imprimir Minipauta</button>
        <br> 
        </form>
        </h2> <br> ';

  if ($dadosdaturma["eclassedeexame"]!='Sim') {
    
     $minipauta.='
     
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>';

         
          $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre' "));
          $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' and idtrimestre='$idtrimestre'  "));

          $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                  
          $minipauta.='

          <tr>  
            <th rowspan="2" align="center">Nome do Estudante</th>
            <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
          </tr>
            ';

      
 
              
              $vetor_trimestres[]=$idtrimestre;

              $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
              $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas'  "));

              $colSpan_tri=$numerodenotas_transicao+$numerodemedias_transicao;
                 
              
             
            $minipauta.='
              

           <tr>  
           ';

           foreach ($vetor_trimestres as $key => $idtrimestre) {
          
                  $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre' order by posicao asc");

                    while($exibir = $lista->fetch_array()){
                      
                      $minipauta.=' 
                          <th align="center">'.$exibir["titulo"].'</th> 
                      ';
                      
                      } 
                      
                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre'  and tipodemedia='denotas' ");

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

                       $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre' order by posicao ");

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
      

      <br> 
      
      <a href="lancarnota.php?iddisciplina='.$iddisciplina.'"><button  class="btn btn-primary"> Lançar Nota da Minipauta </button></a>
        
      <br><br>


      <!-- Page level plugins -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
      <!-- Page level custom scripts -->
      <script src="js/demo/datatables-demo.js"></script>';


      echo "$minipauta";
 }else {
    
     $minipauta.='
     
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>';

         
          $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame'and idtrimestre='$idtrimestre'  "));
          $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas' and idtrimestre='$idtrimestre'  "));

          $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                  
          $minipauta.='

          <tr>  
            <th rowspan="2" align="center">Nome do Estudante</th>
            <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
          </tr>
          <tr>  ';

      
  
              $vetor_trimestres[]=$idtrimestre;

               

           
          

           foreach ($vetor_trimestres as $key => $idtrimestre) {
          
                  $lista= mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idanolectivo='$idanolectivo' and  tipodeturma='exame' and idtrimestre='$idtrimestre' order by posicao asc");

                    while($exibir = $lista->fetch_array()){
                      
                      $minipauta.=' 
                          <th align="center">'.$exibir["titulo"].'</th> 
                      ';
                      
                      } 
                      
                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame'  and idtrimestre='$idtrimestre'  and tipodemedia='denotas' ");

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


                      
 
                $minipauta.='


          </tr>   '; }
          $minipauta.='
        </tbody>
      </table>
      
      
      <br> 
      
      <a href="lancarnota.php?iddisciplina='.$iddisciplina.'"><button  class="btn btn-primary"> Lançar Nota da Minipauta </button></a>
        
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