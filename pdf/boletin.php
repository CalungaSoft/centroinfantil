<?php
  include_once("../conexao.php"); 
  
  session_start();

	 if(!isset($_SESSION['logado'])):
		 header('Location: index.php');
	 endif;
	  
 
    $iddocumentotratado=isset($_GET['iddocumentotratado'])?$_GET['iddocumentotratado']:"0";

  

   $dadosdodocumentos=mysqli_fetch_array(mysqli_query($conexao, "select YEAR(datadeentrada) as ano, MONTH(datadeentrada) as mes, DAY(datadeentrada) as dia, documentostratados.* from documentostratados where iddocumentotratado='$iddocumentotratado' limit 1"));

   $idmatriculaeconfirmacao=$dadosdodocumentos['idmatriculaeconfirmacao'];
   $idtrimestre=$dadosdodocumentos['idtrimestre'];
 
  


  $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));


                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
                                  $idaluno=$dadosda_reconfirmacao["idaluno"];
                                  $classe=$dadosda_reconfirmacao["classe"];

 

    
            $dadosdo_aluno=mysqli_fetch_array(mysqli_query($conexao, "select MONTH(datadenascimento) as nascimes , YEAR(datadenascimento) as nasciano , DAY(datadenascimento) as nascidia, alunos.* from alunos where idaluno='$idaluno' limit 1"));

             $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM turmas where idturma='$idturma' "));

    $eclassedeexame=$dadosdaturma['eclassedeexame'];


   $minimoparapositiva=$dadosdaturma["minimoparapositiva"];


             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0];

  

     $dadosdo_trimestre=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from trimestres where idtrimestre='$idtrimestre'"));


    $nomedo_trimestre=$dadosdo_trimestre["titulo"];

        $dadosdaempresa=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));


        $direitorgeral=$dadosdaempresa['nomedodireitor'];
	 

     $dia=date('d');  
     $mes=date('m');  
     $ano=date('Y');   
                 
?> 


    <?php 

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';

       $gerador=new DOMPDF(["chroot" => __DIR__]); 
 
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
		 

        
       $minipauta="<style> #centro{text-align: center; margin-top:-20px} 

    
        #assinatura {text-align:center;margin-top:-20px} #assinatura1 {text-align:center;} 

       div {  width:100%; height:auto; padding:2px; margin-top:-35px;}  body {font-size: 13px; color:black; font-family:Arial; } #nome {color:red;} #centro1{text-align: justify; padding:20px;margin-top:-20px} </style> 
        <div>
         
        <p id=centro>

          <figure id=imag>
               <img src='img/insignia.jpg' >
          </figure>

            REPÚBLICA DE ANGOLA <br>
            GOVERNO PROVINCIAL DA PROVÍNCIA DE LUANDA <br>

            ".$dadosdaempresa['nome']." <br>

         
    <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='90%' align=center>

         <tr>
         <th  width='auto' style='border: 3px solid; border-spacing:0px; font-size: 26px'> </th>
         </tr>
        <tr>
         <th  width='auto' style='border: 1px solid; border-spacing:0px; font-size:13px'> >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> BOLETIM DE NOTAS  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> </th>
         </tr>
    </table>
         </p>  
        <p id=centro1> 

         <strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  ".$dadosda_reconfirmacao['classe']." Classe    </strong>  / Curso:    <strong> ";  if($dadosda_reconfirmacao["curso"]!="Nenhum")  { $minipauta.=" ".$dadosda_reconfirmacao['curso']." "; } $minipauta.="    </strong> / Ano Lecivo:  ".$anolectivo.".   



   <table style='border:0px solid; border-spacing:0px; margin-top:-50px;  padding:20px' width='90%' align=center>
 
        <tr>
         <th  width='80%' style='border: 1px solid; border-spacing:0px'>  Nome Completo: <a id=nome> ".$dadosdo_aluno['nomecompleto']."     </th> 
          <th  width='20%' style='border: 1px solid; border-spacing:0px'>Nº".$dadosdo_aluno['numerodeprocesso']." <br> Sala:  ".$dadosda_reconfirmacao['sala']."  <br> Turno:".$dadosda_reconfirmacao['periodo']." <br> Trimestre: ".$nomedo_trimestre." 
           </th>
         </tr>
    </table>


";


if ($dadosdaturma["eclassedeexame"]!='Sim') {
    
  $minipauta.='
  
  <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="90%" align=center>

     <thead>';

      
       $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  tipodeturma='Transição' and tipo='normal' "));
       $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  tipodeturma='Transição' and tipodemedia='denotas' "));

       $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                               
       $minipauta.='

       <tr>  
         <th width="auto" style="border: 1px solid; border-spacing:0px" rowspan="2" align="center">Disciplina</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="'.$colSpan_dis.'" align="center">Trimestre</th>
       </tr>
         ';

   
 
           $vetor_trimestres[]=$idtrimestre;

           
           
           
        
         
         $minipauta.='
          

        <tr>  
        ';

        foreach ($vetor_trimestres as $key => $idtrimestre_v) {
       
               $lista= mysqli_query($conexao, "select * from notasdoano where idtrimestre='$idtrimestre' and  tipodeturma='Transição' and idtrimestre='$idtrimestre_v' order by posicao asc");

                 while($exibir = $lista->fetch_array()){
                   
                   $minipauta.=' 
                       <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                   ';
                   
                   } 
                   
               $lista= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                 while($exibir = $lista->fetch_array()){
                   
                   $minipauta.=' 
                     <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$exibir["titulo"].'</th> 
                   ';
                  }
                   
           }
           
           $minipauta.='
       </tr>
     

     </thead>
     <tbody> 
       ';

           $total_media=0;
           $numero_de_disciplina=0;
           
         
           
           $contadordenegativa=0;
           $somador_de_notas_finais=0;
           $classificacaofinal='';
      

           $lista=mysqli_query($conexao, "select * from  disciplinas where idturma='$idturma'  order by agrupamento"); 
      
           $agupamento_actual='Esmael Calunga - CalungaSoft';
    
           while($exibir = $lista->fetch_array()){
    
              $iddisciplina=$exibir["iddisciplina"];
              $numero_de_disciplina++;
          
              if($agupamento_actual!=$exibir['agrupamento']){
                $colSpan_agru=$colSpan_dis+1;
              $minipauta.='
              <tr>  
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="'.$colSpan_agru.'" > <strong>'.$exibir['agrupamento'].'</strong> </th>
              </tr>'; 
              }
              $agupamento_actual=$exibir['agrupamento'];
    
         $minipauta.='
           <tr>  
           <td width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir['titulo'].' </td>'; 
    
             

                    $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre' order by posicao ");

                    while($observar = $listadetrimestre->fetch_array()){

                        $idtrimestre=$observar["idtrimestre"];
        
                         $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idtrimestre='$idtrimestre' and tipodeturma='Transição' and tipodemedia='denotas'"); 

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
                                 <th width="auto" style="border: 1px solid; border-spacing:0px" align="center" >  <span style="color: '.$cor.'">'.$nota.'</span> </th>'; 
                              
                               } 

                               $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                               $total_media+=$media;

                               if (!($media>=$minimoparapositiva)) { //se for negativa
                            
                                $contadordenegativa++;
                                
                                

                                      if($exibir["agrupamento"]=="Chave"){
                                        $contadordenegativa+=100; //para que reprove direito
                                    
                                    } 
                              }  


                              
                               if ($media>=$minimoparapositiva) {
                                 $cor="Blue";
                              }else{
                                $cor="red";
                              }

                               $minipauta.='  
                               <th width="auto" style="border: 1px solid; border-spacing:0px" align="center"   ><span style="color: '.$cor.'">'.$media.' </span> </th>'; 
                                $cor='';

                                     
                  
                        }  


                    }

             $minipauta.='


       </tr>   '; }

       $total_media=round($total_media/$numero_de_disciplina,$visualizar["arredondarmedia"]);
 

       $cor_classificacaofinal_final="";


                     if($contadordenegativa<=2){ //se tiver menos de duas negativas
                        
                          if($contadordenegativa==0){ //se não tiver nenhuma negativa entao: Aprova
       
                           $classificacaofinal="Aprovado";
       
                            $cor_classificacaofinal_final="Blue";
                          
       
                          }else{ // se tiver 1 ou 2 negativas
        
                             $classificacaofinal="Aprovado com deficiência";
       
                              $cor_classificacaofinal_final="Blue";
                             
                              
        
       
                          }
       
       
                     }else{ //se tiver mais de duas negativas reprova direito
                        $classificacaofinal="Reprovado";
                         $cor_classificacaofinal_final="red";
                     }
       
       
                       

                     if($total_media==0){ //se não fez nenhuma prova de escola então sai como desistente.
       
                           $classificacaofinal='Desistente';
                            $cor_classificacaofinal_final="red";
       
                        }
                       

       $minipauta.='
     </tbody>
   </table>
   



';

}else {
 
  $minipauta.='
  
  <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="90%" align=center>

     <thead>';

      
       $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  tipodeturma='exame' and tipo='normal' "));
       $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  tipodeturma='exame' and tipodemedia='denotas' "));

       $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                               
       $minipauta.='

       <tr>  
         <th width="auto" style="border: 1px solid; border-spacing:0px" rowspan="2" align="center">Disciplina</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="'.$colSpan_dis.'" align="center">Trimestre</th>
       </tr>
       ';

   
       $vetor_trimestres[]=$idtrimestre;

           
            
        
           
          
         
         $minipauta.='
       

        <tr>  
        ';

        foreach ($vetor_trimestres as $key => $idtrimestre_v) {
       
               $lista= mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idtrimestre='$idtrimestre' and  tipodeturma='exame' and idtrimestre='$idtrimestre_v' order by posicao asc");

                 while($exibir = $lista->fetch_array()){
                   
                   $minipauta.=' 
                       <th width="auto" style="border: 1px solid; border-spacing:0px"  align="center">'.$exibir["titulo"].'</th> 
                   ';
                   
                   } 
                   
               $lista= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and  tipodeturma='exame'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                 while($exibir = $lista->fetch_array()){
                   
                   $minipauta.=' 
                     <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$exibir["titulo"].'</th> 
                   ';
                  }
                   
           }
           
           $minipauta.='
       </tr>
     

     </thead>
     <tbody> 
       ';
       
       $total_media=0;
       $numero_de_disciplina=0;
  
     
       
       $contadordenegativa=0;
       $somador_de_notas_finais=0;
       $classificacaofinal='';
  
       $lista=mysqli_query($conexao, "select * from  disciplinas where idturma='$idturma'  order by agrupamento"); 
      
       $agupamento_actual='Esmael Calunga - CalungaSoft';

       while($exibir = $lista->fetch_array()){

          $iddisciplina=$exibir["iddisciplina"];
          $numero_de_disciplina++;
      
          if($agupamento_actual!=$exibir['agrupamento']){
            $colSpan_agru=$colSpan_dis+1;
          $minipauta.='
          <tr>  
          <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="'.$colSpan_agru.'" > <strong>'.$exibir['agrupamento'].'</strong> </th>
          </tr>'; 
          }
          $agupamento_actual=$exibir['agrupamento'];

     $minipauta.='
       <tr>  
       <td width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir['titulo'].' </td>'; 

             

                    $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre' order by posicao ");

                    while($observar = $listadetrimestre->fetch_array()){

                        $idtrimestre=$observar["idtrimestre"];
        
                         $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idtrimestre='$idtrimestre' and tipodeturma='exame' and tipodemedia='denotas'"); 

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
                                 <th width="auto" style="border: 1px solid; border-spacing:0px" align="center"   > <span style="color: '.$cor.'">'.$nota.'</span> </th>'; 
                              
                               } 

                               $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                               $total_media+=$media;

                               if (!($media>=$minimoparapositiva)) { //se for negativa
                            
                                $contadordenegativa++;
                                
                                

                                      if($exibir["agrupamento"]=="Chave"){
                                        $contadordenegativa+=100; //para que reprove direito
                                    
                                    } 
                              }

   				
				if ($media>=$minimoparapositiva) {
                                 $cor="Blue";
                              }else{
                                $cor="red";
                              }

                               $minipauta.='  
                               <th width="auto" style="border: 1px solid; border-spacing:0px" align="center"  >  <span style="color: '.$cor.'">'.$media.'</span> </th>'; 
                                $cor='';

                                     
                  
                        }  


                    }

             $minipauta.='


       </tr>   '; }

       $total_media=round($total_media/$numero_de_disciplina,$visualizar["arredondarmedia"]);
 

       $cor_classificacaofinal_final="";


                     if($contadordenegativa<=2){ //se tiver menos de duas negativas
                        
                          if($contadordenegativa==0){ //se não tiver nenhuma negativa entao: Aprova
       
                           $classificacaofinal="Aprovado";
       
                            $cor_classificacaofinal_final="Blue";
                          
       
                          }else{ // se tiver 1 ou 2 negativas
        
                             $classificacaofinal="Aprovado com deficiência";
       
                              $cor_classificacaofinal_final="Blue";
                             
                              
        
       
                          }
       
       
                     }else{ //se tiver mais de duas negativas reprova direito
                        $classificacaofinal="Reprovado";
                         $cor_classificacaofinal_final="red";
                     }
       
       
                       

                     if($total_media==0){ //se não fez nenhuma prova de escola então sai como desistente.
       
                           $classificacaofinal='Desistente';
                            $cor_classificacaofinal_final="red";
       
                        }
                       

       $minipauta.='
     </tbody>
   </table>
   
   



  ';
    
                  }
 $minipauta.="
 
 
<strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Média Trimestral: </strong> ".$total_media." Valores | Classificação Final: <t style='color: ".$cor_classificacaofinal_final."'> ".$classificacaofinal." </t> <br>
  <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='90%' align=center>

         <tr>
           <th  colspan='5'  width='auto' style='border: 3px solid; border-spacing:0px; ' align=center> INFORMAÇÕES COMPLEMENTARES </th>
         </tr>


         <tr>
           <th  colspan='5' width='auto' style='border: 3px solid; border-spacing:0px; '> &nbsp; </th>
         </tr>

         <tr>
         <th  colspan='3' width='auto' style='border: 1px solid; border-spacing:0px' align=center>COMPORTAMENTO </th>
          <th colspan='2'  width='auto' style='border: 1px solid; border-spacing:0px' align=center> ESCRITA </th> 
         </tr>

        <tr>
         <th   width='auto' style='border: 1px solid; border-spacing:0px' align=center>MED </th>
          <th   width='auto' style='border: 1px solid; border-spacing:0px' align=center> SUF </th>
          <th   width='auto' style='border: 1px solid; border-spacing:0px' align=center> BOM </th> 
          <th   width='auto' style='border: 1px solid; border-spacing:0px' align=center>Legível / Perceptível </th>
          <th    width='auto' style='border: 1px solid; border-spacing:0px' align=center> Imperceptível </th>
        </tr>
 
          <tr>
         <th   width='auto' style='border: 1px solid; border-spacing:0px'> &nbsp;</th>
          <th   width='auto' style='border: 1px solid; border-spacing:0px'> &nbsp; </th>
          <th   width='auto' style='border: 1px solid; border-spacing:0px'> &nbsp; </th>
           <th   width='auto' style='border: 1px solid; border-spacing:0px'>&nbsp;</th>
          <th    width='auto' style='border: 1px solid; border-spacing:0px'> &nbsp; </th>
         </tr>
 
    </table>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; OBS: Conservar, pois é muito importante e obrigatório para obter o boletim do trimestre seguinte. <br> 

<p style='font-size:13px'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  O Director(a) de Turma      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  O Encarregado(a) de Educação  <br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ___________________________________
 
 

</p>
<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Luanda, ".$dia." de ".$mes."  de ".$anolectivo." <br> 
 <p id=centro> 
</p>
<p id=assinatura1>
A Direcção Pedagógica <br>
___________________________________  



    </div> ";


        $gerador->load_html($minipauta); 
        //$gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "boletin de notas ".$dadosdaturma["titulo"]." - ".$dadosdo_aluno["nomecompleto"]."- CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 nasciano