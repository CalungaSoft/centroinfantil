 
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif; 
 

$diav=date('d');
$mesv=date('m');
$anov=date('Y'); 


$hoje=date('d');
 
$iddisciplina=isset($_GET['iddisciplina'])?$_GET['iddisciplina']:"0"; 
$idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"0"; 

$dadosdadisciplina=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from disciplinas where iddisciplina='$iddisciplina' limit 1"));

$nomedotrimestre=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from trimestres where idtrimestre='$idtrimestre' limit 1"))[0];

 
    $idturma=$dadosdadisciplina["idturma"];
    $nome_da_disciplina=$dadosdadisciplina["titulo"];
  
 
     

    $dados_da_turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));



                           $idperiodo=$dados_da_turma["idperiodo"];
                           $idcurso=$dados_da_turma["idcurso"];
                           $idsala=$dados_da_turma["idsala"];
                           $idclasse=$dados_da_turma["idclasse"];
                           $idanolectivo=$dados_da_turma["idanolectivo"];
 
                          $turma=$dados_da_turma["titulo"];
                          $minimoparapositiva=$dados_da_turma["minimoparapositiva"];


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            if($curso=='Nenhum'){
                              $curso='';
                            }else{
                              $curso="($curso)";
                            }

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                           $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from anoslectivos where idanolectivo='$idanolectivo'"));

                           $anolectivo=$dadosdoanolectivo["titulo"];

                        



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
        $minipauta=' 
        <style>#assinatura {text-align:center;}  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/logo.png"> 
                </figure>
            </div>
                <p style="font-size: 20px; margin-left:70px">
                República de Angola <br>
                Ministério da Educação <br>
                 <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                </p> 
                <hr><hr>
               
                    <span style="font-size: 20px; margin-left:50px"> Minipauta De '.$nome_da_disciplina.'  - '.$classe.'  </strong> <strong>'.$curso.'</strong>   |   <strong>'.$nomedotrimestre.' Trimestre</span>
            <br> <br>   ';

            $minipauta.="
           <p id='centro' style='font-size: 15px;'> Sala: <strong>".$sala."</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|  Turma: <strong>".$turma."</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Período: <strong>".$periodo."</strong>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ano Lectivo: <strong>".$anolectivo."</strong></p></p>";


           if ($dados_da_turma["eclassedeexame"]!='Sim') {
              
            $minipauta.='
            
                          <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>';

                
                 $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  idtrimestre='$idtrimestre' and  tipodeturma='Transição'  and tipo='normal'"));
                 $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  idtrimestre='$idtrimestre' and  tipodeturma='Transição' and tipodemedia='denotas' "));

                 $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                         
                 $minipauta.='

                 <tr>  
                 <th width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Proc. Nº</th>
                   <th width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Nome do Estudante</th>
                 
                   <th width="auto" style="border: 1px solid; border-spacing:0px"  colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
                 </tr>
                  ';

             

                 
                 
                     $vetor_trimestres[]=$idtrimestre;

                   
                      
                   
                   $minipauta.='
                    

                  <tr>  
                  ';

                  foreach ($vetor_trimestres as $key => $idtrimestre_v) {
                 
                         $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre_v' order by posicao asc");

                           while($exibir = $lista->fetch_array()){
                             
                             $minipauta.=' 
                                 <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                             ';
                             
                             } 
                             
                         $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                           while($exibir = $lista->fetch_array()){
                             
                             $minipauta.=' 
                               <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                             ';
                            }
                             
                     }
                     
                     $minipauta.='
                 </tr>
               

               </thead>
               <tbody> 
                 ';

                     $lista=mysqli_query($conexao, "select alunos.nomecompleto,alunos.numerodeprocesso,  matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by nomecompleto "); 

                      while($exibir = $lista->fetch_array()){


               $minipauta.='
                 <tr> 
                 <td width="auto" style="border: 1px solid; border-spacing:0px"> '.$exibir['numerodeprocesso'].'  </td> 
                   <td width="auto" style="border: 1px solid; border-spacing:0px"> '.$exibir['nomecompleto'].'  </td>'; 

                       

                              $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                              $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre'  order by posicao ");

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
                                           <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  >  <span style="color: '.$cor.'">'.$nota.'</span></th>'; 
                                        
                                         } 

                                         $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                                         if ($media>=$minimoparapositiva) {
                                           $cor="Blue";
                                        }else{
                                          $cor="red";
                                        }

                                         $minipauta.='  
                                         <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  ><span style="color: '.$cor.'">'.$media.'</span></th>'; 
                                          $cor='';

                                               
                            
                                  }  


                              }
        
                       $minipauta.='


                 </tr>   '; }
                 $minipauta.='
               </tbody>
             </table>';
 
        }else {
           
            $minipauta.='
            
                          <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>';

                
                 $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  idtrimestre='$idtrimestre' and   tipodeturma='exame'  and tipo='normal'"));
                 $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  idtrimestre='$idtrimestre' and   tipodeturma='exame' and tipodemedia='denotas' "));

                 $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                         
                 $minipauta.='

                 <tr>  
                   <th width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Proc. Nº</th>
                   <th width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Nome do Estudante</th>
                   <th width="auto" style="border: 1px solid; border-spacing:0px"  colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
                 </tr>
                  ';

             
 
                     $vetor_trimestres[]=$idtrimestre;
 
                     
                      
                   
                   $minipauta.='
                    

                  <tr>  
                  ';

                  foreach ($vetor_trimestres as $key => $idtrimestre_v) {
                 
                         $lista= mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idanolectivo='$idanolectivo' and  tipodeturma='exame' and idtrimestre='$idtrimestre_v' order by posicao asc");

                           while($exibir = $lista->fetch_array()){
                             
                             $minipauta.=' 
                                 <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                             ';
                             
                             } 
                             
                         $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                           while($exibir = $lista->fetch_array()){
                             
                             $minipauta.=' 
                               <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                             ';
                            }
                             
                     }
                     
                     $minipauta.='
                 </tr>
               

               </thead>
               <tbody> 
                 ';

                     $lista=mysqli_query($conexao, "select alunos.nomecompleto,alunos.numerodeprocesso,  matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by nomecompleto "); 

                      while($exibir = $lista->fetch_array()){


               $minipauta.='
                 <tr>  
                 <td width="auto" style="border: 1px solid; border-spacing:0px"> '.$exibir['numerodeprocesso'].'  </td> 
                   <td width="auto" style="border: 1px solid; border-spacing:0px">  '.$exibir['nomecompleto'].' </td>'; 

                       

                              $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                              $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre' order by posicao ");

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
                                           <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  ><span style="color: '.$cor.'">'.$nota.'</span> </th>'; 
                                        
                                         } 

                                         $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                                         if ($media>=$minimoparapositiva) {
                                           $cor="Blue";
                                        }else{
                                          $cor="red";
                                        }

                                         $minipauta.='  
                                         <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  >  <span style="color: '.$cor.'">'.$media.'</span></th>'; 
                                          $cor='';

                                               
                            
                                  }  


                              }
        
                       $minipauta.='


                 </tr>   '; }
                 $minipauta.='
               </tbody>
             </table>';
 
        }

 
 
  $minipauta.=" 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>


<br><br><br>


           <p id=assinatura>O(A) Professor(a)<br>
___________________________ <br>
    
</p>

 

        </div>
        ";


        $gerador->load_html($minipauta); 
        // $gerador->setPaper('A4', 'landscape');
         $gerador->render();
     
         $gerador->stream(
             "Minipauta de ".$nome_da_disciplina." - ".$turma." - CalungaSoft.pdf",
             array(
                 "attachment" => true
             )
         );
    ?>
 
 