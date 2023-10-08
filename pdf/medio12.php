<?php
  include_once("../conexao.php"); 
  
  session_start();

   if(!isset($_SESSION['logado'])):
     header('Location: index.php');
   endif;
    
 
    $iddocumentotratado=isset($_GET['iddocumentotratado'])?$_GET['iddocumentotratado']:"0";
     $dirmunicipal=isset($_GET['dirmunicipal'])?$_GET['dirmunicipal']:"0";
      $frase=isset($_GET['frase'])?$_GET['frase']:"0"; 

      $livroregistro=isset($_GET['livroregistro'])?$_GET['livroregistro']:"0";
      $folhas=isset($_GET['folhas'])?$_GET['folhas']:"0";
      $municipio=isset($_GET['municipio'])?$_GET['municipio']:"0";
  

   $dadosdodocumentos=mysqli_fetch_array(mysqli_query($conexao, "select YEAR(datadeentrada) as ano, MONTH(datadeentrada) as mes, DAY(datadeentrada) as dia, documentostratados.* from documentostratados where iddocumentotratado='$iddocumentotratado' limit 1"));

   $idmatriculaeconfirmacao=$dadosdodocumentos['idmatriculaeconfirmacao'];

   $idturma1=$dadosdodocumentos['classeum'];
   $idturma2=$dadosdodocumentos['classedois'];
   $idturma3=$dadosdodocumentos['classetres']; 


   $anolectivo_10=mysqli_fetch_array(mysqli_query($conexao, "select anoslectivos.titulo from anoslectivos, turmas where turmas.idanolectivo=anoslectivos.idanolectivo and turmas.idturma='$idturma1'  limit 1"))[0];

   $anolectivo_11=mysqli_fetch_array(mysqli_query($conexao, "select anoslectivos.titulo from anoslectivos, turmas where turmas.idanolectivo=anoslectivos.idanolectivo and turmas.idturma='$idturma2'  limit 1"))[0];


   $anolectivo_12=mysqli_fetch_array(mysqli_query($conexao, "select anoslectivos.titulo from anoslectivos, turmas where turmas.idanolectivo=anoslectivos.idanolectivo and turmas.idturma='$idturma3'  limit 1"))[0];

 


  $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and idturma='$idturma3' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
                                  $idaluno=$dadosda_reconfirmacao["idaluno"];
                                  $classe=$dadosda_reconfirmacao["classe"];

   $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1"));

    
            $dadosdo_aluno=mysqli_fetch_array(mysqli_query($conexao, "select MONTH(datadenascimento) as nascimes , YEAR(datadenascimento) as nasciano , DAY(datadenascimento) as nascidia, alunos.* from alunos where idaluno='$idaluno' limit 1"));


             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0];

  

     
     
        $dadosdaempresa=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));


        $direitorgeral=$dadosdaempresa['nomedodireitor'];
   

     $dia=date('d');  
     $mes=date('m');  
     $ano=date('Y');   
     
  

  
                 
?> 


    <?php 
     use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';

        $gerador=new DOMPDF();
 
  if($dadosdo_aluno['nascimes']==1) 
  $dadosdo_aluno['nascimes']="Janeiro"; 
else
if($dadosdo_aluno['nascimes']==2) 
  $dadosdo_aluno['nascimes']="Fevereiro"; 
else
if($dadosdo_aluno['nascimes']==3) 
  $dadosdo_aluno['nascimes']="Março"; 
else
  if($dadosdo_aluno['nascimes']==4) 
  $dadosdo_aluno['nascimes']="Abril"; 
else if($dadosdo_aluno['nascimes']==5) 
  $dadosdo_aluno['nascimes']="Maio"; 
else if($dadosdo_aluno['nascimes']==6) 
  $dadosdo_aluno['nascimes']="Junho"; 
else if($dadosdo_aluno['nascimes']==7) 
  $dadosdo_aluno['nascimes']="Julho"; 
else if($dadosdo_aluno['nascimes']==8) 
  $dadosdo_aluno['nascimes']="Agosto"; 
else if($dadosdo_aluno['nascimes']==9) 
  $dadosdo_aluno['nascimes']="Setembro"; 
else if($dadosdo_aluno['nascimes']==10) 
  $dadosdo_aluno['nascimes']="Outubro"; 
else if($dadosdo_aluno['nascimes']==11) 
  $dadosdo_aluno['nascimes']="Novembro"; 
else if($dadosdo_aluno['nascimes']==12) 
  $dadosdo_aluno['nascimes']="Dezembro"; 



  if($mes==1) 
      $mes="Janeiro"; 
    else
    if($mes==2) 
      $mes="Fevereiro"; 
    else
    if($mes==3) 
      $mes="Março"; 
    else
      if($mes==4) 
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
      
          
                    $somatotal=round(12);

        $mesd=date('m'); $anod=date('Y'); $diad=date('d');

        $htm="<style> #texto {text-align:justify;} #nome {color:red;} #marcadis {background-color:rgb(1210,1210,127);}  #assinatura {text-align:center;} #rodap {text-align:left; font-size: 8px; margin-bottom:-20px;} #corpo {text-align: justify;} div {padding:10px; margin-top:-30px;} #cert {font-size: 29px; color:black; font-family:Arial; padding:8px;} body {font-size: 15px; color:black; font-family:Arial; padding:10px;} #nome {color:red;} #centro{text-align: center;} figure {margin-left:310px; margin-bottom:-15px;margin-top:-8px;}</style> 
        <div> <figure id=imag>
        <img src='img/insignia.jpg' >
        </figure>    
            <p id=centro> REPÚBLICA DE ANGOLA <br>
            MINISTÉRIO DA EDUCACÃO<br> </p>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Visto do(a) &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ".$dadosdaempresa['servicos']."<br>
                    &nbsp;&nbsp;&nbsp; Director(a)  Municipal <br> 
                    &nbsp;&nbsp;_______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span id=cert>C E R T I F I C A D O </span> <br>
                    &nbsp;&nbsp;&nbsp;&nbsp; ".$dirmunicipal."
                    <p id=texto>
                    &nbsp;&nbsp;&nbsp;a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	".$frase.", certifico que <a id=nome><u>  ".$dadosdo_aluno['nomecompleto']."</u> </a>, filho (a) de <u>".$dadosdo_aluno['nomedopai']."</u>  e de <u>".$dadosdo_aluno['nomedamae']."</u>, natural de <u>".$dadosdo_aluno['naturalidade']."</u>, Província de <u>".$dadosdo_aluno['provincia']."</u>, portador do B.I nº <u>".$dadosdo_aluno['numerodobioucedula']."</u>, passado pelo Arquivo de Identificação de <u>".$dadosdo_aluno['arquivodeidentificacao']."</u>  zxzxzxzxzxzxzxzxzxzxzxzxzxzxzxzzxzxzxzxzxzxzxzzxzxzxzxzxzxzxzxzxzzxzxzxzxzxzxzxz <br>  Concluiu no ano lectivo de <strong>".$anolectivo_12."</strong> no curso de <strong> ".$dadosda_reconfirmacao['curso']." </strong>o <strong> II CICLO DO ENSINO SECUNDÁRIO GERAL </strong>, conforme o disposto na alínea b) do artigo 109.º da LBSEE 17/16, de 7 de Outubro.  </p>
 
                     
          <table style='border:0px solid; border-spacing:0px; margin-top:-5px;  padding:0px' width='100%' align=center>
                      <tr>
                            <td   width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Disciplinas</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> 10ª (".$anolectivo_10.")</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> 11ª (".$anolectivo_11.")</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> 12ª (".$anolectivo_12.")</td>  
                            <td   width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Média Final</td> 
                      </tr> 
                     

                          ";


                        




                          $disciplinas=mysqli_query($conexao, "select iddisciplina, titulo from disciplinas  where (idturma='$idturma1' or idturma='$idturma2' or idturma='$idturma3')  order by titulo"); 



                  
                            $tipodedisciplina="Esmael -- Calunga";
                            $nota_final=0;
                            $media_total=0;

                            $numerode_disciplinas_diferente=0;

                             while($exibir = $disciplinas->fetch_array()){

                                    
                                if($exibir["titulo"]!=$tipodedisciplina){

                                  $numerode_disciplinas_diferente+=1;

                                  $titulo_da_disciplina=$exibir["titulo"];

                                  $color10=""; $color11=""; $color12=""; $color13="";
                                  $quantidade_disc_10=""; $quantidade_disc_11=""; $quantidade_disc_12=""; $quantidade_disc_13="";

                                  $cor_nota10=""; $cor_nota11=""; $cor_nota12=""; $cor_nota13="";

                                   $somanota_disc=""; 



                                  $iddisciplina=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina  from disciplinas  where (idturma='$idturma1') and titulo='$titulo_da_disciplina'"))[0];


                                  if($iddisciplina==NULL){
                                    $color10='marcadis';
                                    $nota_final10='';
                                  }else{



                                    $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idturma='$idturma1' and idaluno='$idaluno' limit 1"));
 
                                      $idanolectivo=$dadosda_reconfirmacao["idanolectivo"]; 
                                      $idmatriculaeconfirmacao=$dadosda_reconfirmacao["idmatriculaeconfirmacao"]; 



                                       $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));


                                          $nome_da_provadeescola=$dadosdoanolectivo["nomedaprovadeescola"];
                                          $nome_da_provaderecurso=$dadosdoanolectivo["nomedaprovadeexame"];
                                          $arredondarmedia_anolectivo=$dadosdoanolectivo["arredondarmedia"]; 
                                          $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 



                                         $idprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provadeescola' and idanolectivo='$idanolectivo'"))[0];
                                         $idprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provaderecurso' and idanolectivo='$idanolectivo'"))[0];


                                     $notadaprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovadeescola'"))[0];

                                     $notadaprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovaderecurso'"))[0];

                                       $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT sum((notas.valordanota*tiposdenotas.percentagemnotrimestre)*trimestres.percentagemnoanolectivo) as media FROM notas, tiposdenotas, trimestres where tiposdenotas.idtipodenota=notas.idtipodenota and tiposdenotas.idtrimestre=trimestres.idtrimestre and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);


                                            $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);




                                       if($notadaprovaderecurso!=''){
                                          $nota_final10=$notadaprovaderecurso;
                                        }else{

                                           $nota_final10=round((($dadosdoanolectivo["percentagemdamediadostrimestres"]*$mediadostrimestres)+($notadaprovadeescola*$percentagemrestante)), $arredondarmedia_anolectivo);  
                                        }



                                         $somanota_disc+=1;

                                          if ($nota_final10<$minimoparapositiva) {
                                           $cor_nota10="nome";
                                            }else{
                                              $cor_nota10="";
                                            }
                                      





                                  }



































                                  
                                  $iddisciplina=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina  from disciplinas  where (idturma='$idturma2') and titulo='$titulo_da_disciplina'"))[0];


                                  if($iddisciplina==NULL){
                                    $color11='marcadis';
                                    $nota_final11='';
                                  }else{



                                    $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idturma='$idturma2' and idaluno='$idaluno' limit 1"));
 
                                      $idanolectivo=$dadosda_reconfirmacao["idanolectivo"]; 
                                      $idmatriculaeconfirmacao=$dadosda_reconfirmacao["idmatriculaeconfirmacao"]; 



                                       $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));


                                          $nome_da_provadeescola=$dadosdoanolectivo["nomedaprovadeescola"];
                                          $nome_da_provaderecurso=$dadosdoanolectivo["nomedaprovadeexame"];
                                          $arredondarmedia_anolectivo=$dadosdoanolectivo["arredondarmedia"]; 
                                          $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 



                                         $idprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provadeescola' and idanolectivo='$idanolectivo'"))[0];
                                         $idprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provaderecurso' and idanolectivo='$idanolectivo'"))[0];


                                     $notadaprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovadeescola'"))[0];

                                     $notadaprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovaderecurso'"))[0];

                                       $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT sum((notas.valordanota*tiposdenotas.percentagemnotrimestre)*trimestres.percentagemnoanolectivo) as media FROM notas, tiposdenotas, trimestres where tiposdenotas.idtipodenota=notas.idtipodenota and tiposdenotas.idtrimestre=trimestres.idtrimestre and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);


                                            $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);




                                       if($notadaprovaderecurso!=''){
                                          $nota_final11=$notadaprovaderecurso;
                                        }else{

                                           $nota_final11=round((($dadosdoanolectivo["percentagemdamediadostrimestres"]*$mediadostrimestres)+($notadaprovadeescola*$percentagemrestante)), $arredondarmedia_anolectivo);  
                                        }

                                        $somanota_disc+=1;

                                          if ($nota_final11<$minimoparapositiva) {
                                           $cor_nota11="nome";
                                            }else{
                                              $cor_nota11="";
                                            }
                                      
 

 
                                  }


                                  























                                  $iddisciplina=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina  from disciplinas  where (idturma='$idturma3') and titulo='$titulo_da_disciplina'"))[0];


                                  if($iddisciplina==NULL){
                                    $color12='marcadis';
                                    $nota_final12='';
                                  }else{



                                    $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idturma='$idturma3' and idaluno='$idaluno' limit 1"));
 
                                      $idanolectivo=$dadosda_reconfirmacao["idanolectivo"]; 
                                      $idmatriculaeconfirmacao=$dadosda_reconfirmacao["idmatriculaeconfirmacao"]; 



                                       $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));


                                          $nome_da_provadeescola=$dadosdoanolectivo["nomedaprovadeescola"];
                                          $nome_da_provaderecurso=$dadosdoanolectivo["nomedaprovadeexame"];
                                          $arredondarmedia_anolectivo=$dadosdoanolectivo["arredondarmedia"]; 
                                          $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 



                                         $idprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provadeescola' and idanolectivo='$idanolectivo'"))[0];
                                         $idprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provaderecurso' and idanolectivo='$idanolectivo'"))[0];


                                     $notadaprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovadeescola'"))[0];

                                     $notadaprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovaderecurso'"))[0];

                                       $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT sum((notas.valordanota*tiposdenotas.percentagemnotrimestre)*trimestres.percentagemnoanolectivo) as media FROM notas, tiposdenotas, trimestres where tiposdenotas.idtipodenota=notas.idtipodenota and tiposdenotas.idtrimestre=trimestres.idtrimestre and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);


                                            $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);




                                       if($notadaprovaderecurso!=''){
                                          $nota_final12=$notadaprovaderecurso;
                                        }else{

                                           $nota_final12=round((($dadosdoanolectivo["percentagemdamediadostrimestres"]*$mediadostrimestres)+($notadaprovadeescola*$percentagemrestante)), $arredondarmedia_anolectivo);  
                                        }

                                        $somanota_disc+=1;

                                          if ($nota_final12<$minimoparapositiva) {
                                           $cor_nota12="nome";
                                            }else{
                                              $cor_nota12="";
                                            }
                                      
 
                                  }





 

 

                                     $media_por_disciplina=round((($nota_final10+$nota_final11+$nota_final12)/$somanota_disc), 2);

                                      if ($media_por_disciplina<$minimoparapositiva) {
                                           $cor_nota="nome";
                                            }else{
                                              $cor_nota="";
                                            }




                                     $media_total+=$media_por_disciplina;
  
 

                              $htm.="

                      <tr>
                     <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["titulo"]."  </td>
                     <td width='auto' id='".$color10."' style='border:  1px solid; border-spacing:0px'> <t id='".$cor_nota10."'> ".$nota_final10." </t> </td>
                     <td width='auto' id='".$color11."' style='border: 1px solid; border-spacing:0px'> <t id='".$cor_nota11."'>".$nota_final11." </t> </td>
                     <td width='auto' id='".$color12."' style='border: 1px solid; border-spacing:0px'> <t id='".$cor_nota12."'>".$nota_final12." </t> </td> 
                     <td width='auto' style='border: 1px solid; border-spacing:0px'><strong><t id='".$cor_nota."'> ".$media_por_disciplina." </t> </strong> </td> 
                      </tr>
                        ";

                      $tipodedisciplina=$exibir["titulo"]; }

                    }


                    $media_total=round(($media_total/$numerode_disciplinas_diferente),2);
 
 
                      $htm.="
                                         

                </table>
                                 
   <p id=corpo >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Média Final das classificações por ciclos de aprendizagem <a id=nome>".$media_total."</a>. <br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Para efeitos legais lhe é passado o presente <strong> CERTIFICADO </strong>, que consta do livro de registo nº ".$livroregistro." folhas ".$folhas.", assinado por mim e autenticado com carimbo a óleo em uso neste estabelecimento de ensino.
 <br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direcção Municipal da Educação de ".$municipio.",  ".$dia."  de   ".$mes."  de  ".$ano."

</p>

  


<p id=assinatura> Conferido por &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  O(A) Director(a)  <br>
___________________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________  
 
</p>
  

    </div> ";


        $gerador->load_html($htm); 
        //$gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Certificado12.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 