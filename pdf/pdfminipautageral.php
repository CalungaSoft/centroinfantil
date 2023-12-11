 
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
 
$idturma=isset($_GET['idturma'])?$_GET['idturma']:"0"; 
$idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"0"; 

 
     

    $dados_da_turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));
    $dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from trimestres where idtrimestre='$idtrimestre'"));
    $nomedotrimestre=$dadosdotrimestre["titulo"];


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

       $gerador=new DOMPDF(["chroot" => __DIR__]);  
        $minipauta=' 
        <style>#assinatura {text-align:center;}  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div> 
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div>
                <p style="font-size: 20px; margin-left:70px">
                República de Angola <br>
                Ministério da Educação <br>
                 <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                </p> 
                <hr><hr> 
               
                <span style="font-size: 20px; margin-left:50px"> Minipauta Da  - '.$classe.'  </strong> <strong>'.$curso.'</strong>   |   <strong>'.$nomedotrimestre.' Trimestre</span>
        <br> <br> ';

            $minipauta.="
           <p id='centro' style='font-size: 15px;'> Sala: <strong>".$sala."</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|  Turma: <strong>".$turma."</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Período: <strong>".$periodo."</strong>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ano Lectivo: <strong>".$anolectivo."</strong></p></p>";


    
$minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

 
$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 
 
if($dadosdaturma["eclassedeexame"]=='sim'){$tipodeturma="exame";}else{ $tipodeturma='transição';}
 
   $minipauta.='
   
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>';

       
                           
        $minipauta.='

                
          <tr>  
          <th width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Proc. Nº</th>
            <th  width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" align="center">Nome do Estudante</th>
            ';

            $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

            while($exibir = $lista_de_disciplina->fetch_array()){
              $iddisciplina=$exibir["iddisciplina"];
              $minipauta.='
              
            <th  width="auto" style="border: 1px solid; border-spacing:0px"    align="center"> '.$exibir["abreviatura"].' </th>
            ';

            }

            $minipauta.='
            <th  width="auto" style="border: 1px solid; border-spacing:0px"  rowspan="2" >Classificação</th>
          </tr>
        ';

    
      
         
 
          
          $minipauta.='
          

         <tr>  
         ';

         $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
         $nome_da_media=mysqli_fetch_array(mysqli_query($conexao, "select titulo from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='$tipodeturma'  and idtrimestre='$idtrimestre'  "))[0];

         while($exibir = $lista_de_disciplina->fetch_array()){
            
    
              
               
                    $minipauta.=' 
                      <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$nome_da_media.'</th> 
                    ';
                   
                    
           
          
          }
            
            $minipauta.='
        </tr>
      

      </thead>
      <tbody> 
        ';
         
        $arredondarmedia=mysqli_fetch_array(mysqli_query($conexao," SELECT arredondarmedia FROM mediasdoano where idanolectivo='$idanolectivo' and idtrimestre='$idtrimestre' limit 1 "))[0];


            $lista=mysqli_query($conexao, "select alunos.nomecompleto,alunos.numerodeprocesso, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'  order by nomecompleto"); 

             while($exibir = $lista->fetch_array()){

              $idaluno=$exibir["idaluno"];

      $minipauta.='
        <tr>  
        <td width="auto" style="border: 1px solid; border-spacing:0px"> '.$exibir['numerodeprocesso'].'  </td> 
          <td width="auto" style="border: 1px solid; border-spacing:0px" > '.$exibir['nomecompleto'].' </td>'; 

              

                     $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
                     $somatorio_geral=0;
                     $numero_de_notas_geral=0;
                     $somatorio_individual=0;
                     $contadordenegativa=0;
                     $somador_de_notas_finais=0;
                     $classificacaofinal='';
                
                     $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

                     while($exibir_disciplinas = $lista_de_disciplina->fetch_array()){
                     
                      $iddisciplina=$exibir_disciplinas["iddisciplina"];
              
                       
                           
                         
                                
                                $media=round(mysqli_fetch_array(mysqli_query($conexao," SELECT avg((notas.valordanota)) as media FROM notas, notasdoano where notasdoano.idnotadoano=notas.idnotadoano and notasdoano.idtrimestre='$idtrimestre' and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia);
                                
                              $somatorio_individual+=$media;
                                 
                          
                                if ($media>=$minimoparapositiva) {
                                  $cor="Blue";
                               }else{
                                 $cor="red";
                               }

                                $minipauta.='  
                                <th  width="auto" style="border: 1px solid; border-spacing:0px"  align="center"  ><span style="color: '.$cor.'">'.$media.'</span></th>'; 
                                 

                                 if (!($media>=$minimoparapositiva)) { //se for negativa
                            
                                    $contadordenegativa++;
                                    
                                    
  
                                          if($exibir_disciplinas["tipodedisciplina"]=="Chave"){
                                            $contadordenegativa+=100; //para que reprove direito
                                        
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
                             
                              
        
       
                          }
       
       
                     }else{ //se tiver mais de duas negativas reprova direito
                        $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                         $cor_classificacaofinal_final="red";
                     }
       
       
                       

                     if($somatorio_individual==0){ //se não fez nenhuma prova de escola então sai como desistente.
       
                           $classificacaofinal='Desistente';
                            $cor_classificacaofinal_final="red";
       
                        }
                        $cor='';
                        $media=0;
                     
               $minipauta.='
               <td width="auto" style="border: 1px solid; border-spacing:0px" > <span style="color: '.$cor_classificacaofinal_final.'">'.$classificacaofinal.'</span></td> 
       
         </tr>   '; 
        
        }
       

        $minipauta.='
      </tbody>
    </table>
       
    ';
 
  $minipauta.=" 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>


<br><br><br>

             <p id=assinatura>A Direcção <br>
___________________________ <br>
    
</p>
        </div>
        ";


        $gerador->load_html($minipauta); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Minipauta Geral - ".$turma." - CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 
 