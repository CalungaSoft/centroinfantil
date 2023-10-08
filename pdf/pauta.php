
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

 

$diav=date('d');
$mesv=date('m');
$anov=date('Y'); 


$hoje=date('d');
$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"$mesv";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"$anov";
$anodevenda=mysqli_escape_string($conexao, $anodevenda); 
 
$idturma=isset($_GET['idturma'])?$_GET['idturma']:"0";

    $dados_da_turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));



                           $idperiodo=$dados_da_turma["idperiodo"];
                           $idcurso=$dados_da_turma["idcurso"];
                           $idsala=$dados_da_turma["idsala"];
                           $idclasse=$dados_da_turma["idclasse"];
                           $idanolectivo=$dados_da_turma["idanolectivo"];
 
                          $turma=$dados_da_turma["titulo"];


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            if($curso=='Nenhum'){
                              $curso='';
                            }

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                           $anolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];


$dia=date('d');  
    $mes=date('m');  
    $ano=date('Y'); 
    if($mes==1) 
    $mes="Janeiro"; 
    else if($mes==2) 
    $mes="Fevereiro"; 
    else if($mes==3) 
    $mes="Março"; 
    else if($mes==4) 
    $mes="Abril"; 
    else if($mes==5) 
    $mes="Maio"; 
    else if($mes==6) 
    $mes="Junho"; 
    else if($mes==7) 
    $mes="Julho"; 
    else if($mes==8) 
    $mes="Agosto"; 
    else if($mes==9) 
    $mes="Setembro"; 
    else if($mes==10) 
    $mes="Outubro"; 
    else if($mes==11) 
    $mes="Novembro"; 
    else if($mes==12) 
    $mes="Dezembro"; 


    $dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';

        $gerador=new DOMPDF();
    
        $minipauta="<style> #assinatura {text-align:center;} #rodap {text-align:center; font-size: 6px; margin-bottom:-20px;} #corpo {text-align: justify;} body {font-size: 13px; color:#000; font-family:Arial;} #nome {color:red;} #centro{text-align: left;} #centro1{align: center; margin-bottom: 10px;} figure {margin-left:20px; float: left;}</style> 
        <div>     <figure id=imag>
         <img src='img/logo.png'> 
        </figure>
        <p id=centro> <h1>  ".$dadosdainstituicao['nome']." </h1> <i>".$dadosdainstituicao['servicos']."</i> </p>   
      <style> 
          #nome {color:red;}
          #nome1 {color:rgb(31,73,125);}
          </style>
   <p>      <strong>  Classe: </strong> ".$classe."    
             <strong>  Turma:</strong>   ".$turma."  
             <strong>  Curso: </strong>  ".$curso."   
             <strong>  Período: </strong>  ".$periodo."   
             <strong>  Ano: </strong>  ".$anolectivo."   
            </p> 

            <br><br>
            <hr><hr>
";




 

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
    $minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

 
    $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 
    

    if ($dadosdaturma["eclassedeexame"]!='Sim') {
  
      $minipauta.='
      
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>';
   
          
           $numerodenotas_transicao=0;
           $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'"));
   
           $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                   
           $minipauta.='
   
                   
             <tr>  
               <th  width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Nome do Estudante</th>
               ';
   
               $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
   
               while($exibir = $lista_de_disciplina->fetch_array()){
                 $iddisciplina=$exibir["iddisciplina"];
                 $minipauta.='
                 
               <th  width="auto" style="border: 1px solid; border-spacing:0px"  colspan="'.$colSpan_dis.'" align="center">'.$exibir["abreviatura"].'</th>
               ';
   
               }
   
               $minipauta.='
               <th  width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" >Classificação</th>
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
   
            $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
   
            while($exibir = $lista_de_disciplina->fetch_array()){
               
            foreach ($vetor_trimestres as $key => $idtrimestre_v) {
           
                   
                   $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  ");
   
                     while($exibir = $lista->fetch_array()){
                       
                       $minipauta.=' 
                         <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                       ';
                      }
                       
               }
             
             }
               
               $minipauta.='
           </tr>
         
   
         </thead>
         <tbody> 
           ';
           $id_ultimo_trimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao desc limit 1 "))[0];
          
   
               $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by nomecompleto"); 
   
                while($exibir = $lista->fetch_array()){
   
                 $idaluno=$exibir["idaluno"];
   
         $minipauta.='
           <tr>  
             <td  width="auto" style="border: 1px solid; border-spacing:0px" > '.$exibir['nomecompleto'].' </td>'; 
   
                 
   
                        $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
                        $contadordenegativa=0;
                        $numero_de_notas_geral=0;
   
                        $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
   
                        while($exibir_disciplinas = $lista_de_disciplina->fetch_array()){
                        
                         $iddisciplina=$exibir_disciplinas["iddisciplina"];
                         $somatorio_geral=0;
                    
                         $somatorio_individual=0;
                        
                         $somador_de_notas_finais=0;
   
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
                                   <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  ><span style="color: '.$cor.'">'.$media.'</span> </th>'; 
                                    $cor='';
                                    $media=0;
   
                                  
                                         
                      
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
                                  <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  > <span style="color: '.$cor.'">'.$media.'</span> </th>'; 
                                   
                                   $somatorio=0;
                                   $cor='';
                               
   
                                   if (!($media>=$minimoparapositiva)) { //se for negativa
                               
                                     $contadordenegativa++;
                                     
                                     
   
                                           if($exibir_disciplinas["tipodedisciplina"]=="Chave"){
                                             $contadordenegativa+=100; //para que reprove direito
                                         
                                         }else { //so tera cadeira se a disciplinao nao for chave
                                           $vetor_cadeiras_deixadas[]=$iddisciplina;
                                           $vetor_nota_da_disciplina[$iddisciplina]=$media;
                                         }
        
                                    
       
                                }else { // caso a media for positiva, então elimina a cadeira
                                  
                                 
                                 
                                 $Eliminando_caso=mysqli_query($conexao, "DELETE FROM `cadeirasdeixadas` WHERE idaluno='$idaluno' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' ");
    
                                } 
                     
                           }  
   
                         }
   
                        }
   
                        $cor_classificacaofinal_final="";
   
   
                        if($contadordenegativa<=2){ //se tiver menos de duas negativas
                           
                             if($contadordenegativa==0){ //se não tiver nenhuma negativa entao: Aprova
          
                              $classificacaofinal=$dadosdaturma['classificacaopositiva'];
          
                               $cor_classificacaofinal_final="Blue";
                             
          
                             }else{ // se tiver 1 ou 2 negativas
           
                                $classificacaofinal="$dadosdaturma[classificacaopositiva]*";
          
                                 $cor_classificacaofinal_final="Blue";
                                
                                 foreach ($vetor_cadeiras_deixadas as $key => $disciplina) {
                                     $data_de_hoje=date('Y-m-d');
                                     $valordanota_cadeira=$vetor_nota_da_disciplina[$disciplina];
                                     
                                     $id_cadeira_deixada=mysqli_fetch_array(mysqli_query($conexao, "SELECT idcadeiradeixada from cadeirasdeixadas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$disciplina'"))[0];
   
                                     if($id_cadeira_deixada==0){
   
                                       $inserindo_cadeiras_em_atraso=mysqli_query($conexao, "INSERT INTO `cadeirasdeixadas` (`idcadeiradeixada`, `idaluno`, `idmatriculaeconfirmacao`, `iddisciplina`, `valordanota`, `data`) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$disciplina', '$valordanota_cadeira', '$data_de_hoje')");
    
                                     }else{
   
                                       $actualizandoanota=mysqli_query($conexao, "UPDATE `cadeirasdeixadas` SET `valordanota` = '$valordanota_cadeira' WHERE `cadeirasdeixadas`.`idcadeiradeixada` = '$id_cadeira_deixada'");
    
                                     }
   
   
   
                                 }
                               
           
          
                             }
          
          
                        }else{ //se tiver mais de duas negativas reprova direito
                           $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                            $cor_classificacaofinal_final="red";
                        }
          
          
                         
                        $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idtrimestre='$id_ultimo_trimestre' and tipodeturma='Transição'"); 
   
                                 $somador_de_notas_finais=0;
                                 
                                 while($ver = $lista_de_nota->fetch_array()){
                                   $idnotadoano=$ver["idnotadoano"];
                                   $somador_de_notas_finais+=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano'  limit 1"))[0];
                                 }
   
                        if($somador_de_notas_finais==0){ //se não fez nenhuma prova de escola então sai como desistente.
          
                              $classificacaofinal='Desistente';
                               $cor_classificacaofinal_final="red";
          
                           }
          
                           $vetor_cadeiras_deixadas=[];
                  $minipauta.='
                  <td  width="auto" style="border: 1px solid; border-spacing:0px" > <span style="color: '.$cor_classificacaofinal_final.'">'.$classificacaofinal.'</span></td> 
          
            </tr>   '; 
           
           }
          
   
           $minipauta.='
         </tbody>
       </table>
          
       ';
   
   
   }else {
     $minipauta.='
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
   <thead>';
   
    
     $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and (tipo='exame' or tipo='recurso')"));
     $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and (tipodemedia='ponderada' or tipodemedia='demedias')"));
   
     $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                             
     $minipauta.='
   
     <tr>  
       <th  width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Nome do Estudante</th>
       ';
   
       $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
   
       while($exibir = $lista_de_disciplina->fetch_array()){
        $iddisciplina=$exibir["iddisciplina"];
         $minipauta.='
         
       <th  width="auto" style="border: 1px solid; border-spacing:0px"  colspan="'.$colSpan_dis.'" align="center">'.$exibir["abreviatura"].'</th>
       ';
   
       }
   
       $minipauta.='
       <th  width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" >Classificação</th>
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
   
      $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
   
      while($exibir = $lista_de_disciplina->fetch_array()){ 
   
      foreach ($vetor_trimestres as $key => $idtrimestre_v) {
     
             
             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='demedias' and percentagem!=0 and idtrimestre='$idtrimestre_v'  ");
   
               while($exibir = $lista->fetch_array()){
                 
                 $minipauta.=' 
                   <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                 ';
                }
   
                $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='exame' and idtrimestre='$idtrimestre_v'  ");
   
               while($exibir = $lista->fetch_array()){
                 
                 $minipauta.=' 
                   <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                 ';
                }
   
                $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='ponderada' and idtrimestre='$idtrimestre_v'  ");
   
               while($exibir = $lista->fetch_array()){
                 
                 $minipauta.=' 
                   <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                 ';
                }
   
   
                $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");
   
                while($exibir = $lista->fetch_array()){
                  
                  $minipauta.=' 
                    <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                  ';
                 }
                 
         }
   
       }
         
         $minipauta.='
     </tr>
   
   
   </thead>
   <tbody> 
     ';
   
         $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by nomecompleto"); 
   
          while($exibir = $lista->fetch_array()){
   
        
   
   $minipauta.='
     <tr>  
       <td  width="auto" style="border: 1px solid; border-spacing:0px" > '.$exibir['nomecompleto'].' </td>'; 
   
           
   
                  $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
   
                  $contadordenegativa=0;
                $somador_de_nota_do_recurso_e_ponderada=0;
   
                  $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
   
                  while($exibir_disciplinas = $lista_de_disciplina->fetch_array()){
                  
                   $somatorio_geral=0;
                   $numero_de_notas_geral=0;
                   $somatorio_individual=0;
                  
                   
                   
                   $iddisciplina=$exibir_disciplinas["iddisciplina"];
   
                   $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao desc limit 1 ");
                   while($observar = $listadetrimestre->fetch_array()){
   
                      $idtrimestre_v=$observar["idtrimestre"];
   
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
                             <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center"   >  <span style="color: '.$cor.'">'.$media_geral.'</span> </th>'; 
                             $somatorio_individual=0;
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
                            <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  >  <span style="color: '.$cor.'">'.$nota.'</span></th>'; 
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
                           <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  >   <span style="color: '.$cor.'">'.$nota_ponderada.'</span></th>'; 
                            $cor='';
   
   
   
                      
   
                         //nota do recurso
                         $notada_prova= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");
   
                         while($visualizar = $notada_prova->fetch_array()){
                           
                           $idnotadoano=$visualizar["idnotadoano"];
     
                           $nota_do_recurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
     
                             
                               if ($nota_do_recurso>=$minimoparapositiva) {
                                 $cor="Blue";
   
                                 $recurso_lhe_aprovou=true;
   
                              }else{
                                $cor="red";
   
                                $recurso_lhe_aprovou=false;
                              }
     
                               $minipauta.='  
                               <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center" > <span style="color: '.$cor.'">'.$nota_do_recurso.'</span> </th>'; 
                                $cor='';
     
                                     
                             }
   
                             $somador_de_nota_do_recurso_e_ponderada+=$nota_do_recurso+$nota_ponderada;
                            
                          if (!($nota_ponderada>=$minimoparapositiva)) { //se for negativa
                              
   
                               if(!$recurso_lhe_aprovou){ //se o recurso não lhe aprovou
                                 $contadordenegativa++;
   
                                 if($exibir_disciplinas["tipodedisciplina"]=="Chave"){
                                   $contadordenegativa+=100; //para que reprove direito
                                
                               }
    
                               }
   
                            } 
     
                            
   
   
                  }
   
                  
   
                 }
   
   
                 $cor_classificacaofinal_final="";
   
   
                 if($contadordenegativa<=2){ //se tiver menos de duas negativas
                    
                      if($contadordenegativa==0){ //se não tiver nenhuma negativa entao: Aprova
   
                       $classificacaofinal=$dadosdaturma['classificacaopositiva'];
   
                        $cor_classificacaofinal_final="Blue";
                      
   
                      }else{ // se tiver alguma negativa
   
                        if($dadosdaturma["eclassedeexame"]=='Sim'){  //verifica se é classe de exame se for: então vai ao recurso nessas disciplinas
   
                         $classificacaofinal='Recurso';
                         $cor_classificacaofinal_final="red";
   
   
                        }else{ // Se não for uma classe de exame deve deixar essas disciplinas, ou seja, fica com cadeiras em atraso
   
                         $classificacaofinal="$dadosdaturma[classificacaopositiva]*";
   
                          $cor_classificacaofinal_final="Blue";
                         
   
   
                        }
   
                      }
   
   
                 }else{ //se tiver mais de duas negativas reprova direito
                    $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                     $cor_classificacaofinal_final="red";
                 }
   
   
                  
               
                 if($somador_de_nota_do_recurso_e_ponderada==0){ //se não fez nenhuma prova de escola então sai como desistente.
   
                       $classificacaofinal='Desistente';
                        $cor_classificacaofinal_final="red";
   
                    }
   
   
           $minipauta.='
           <td  width="auto" style="border: 1px solid; border-spacing:0px" > <span style="color: '.$cor_classificacaofinal_final.'">'.$classificacaofinal.'</span></td> 
   
     </tr>   '; }
     $minipauta.='
   </tbody>
   </table>
    
   ';
   
   
  
   }

 

$minipauta.=" <br><br>
<p id=assinatura>

  O CONSELHO DE NOTA	 	 &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;O DIRECTOR PEDAGÓGICO		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	&nbsp; &nbsp; &nbsp; &nbsp;			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;						    O DIRECTOR DO COMPLEXO	 <br>			
_______________________________		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	________________________________  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;						 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;				_________________________________	<br>					
_______________________________	 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;		  ______/________________/_________		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 	 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;				 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;			________/______________/_________	<br>					
																			

</p>
  
 
       <br>
 
    </div> ";


        $gerador->load_html($minipauta); 
        $gerador->setPaper('A3', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Pauta".$classe."".$curso."CalungaSOFT.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 