<?php
  include_once("../conexao.php"); 
  
  session_start();

	 if(!isset($_SESSION['logado'])):
		 header('Location: index.php');
	 endif;
	  
 
  $idmatriculaeconfirmacao=isset($_GET['idmatriculaeconfirmacao'])?$_GET['idmatriculaeconfirmacao']:"0";



  $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

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
		 
        
        $htm="<style> #assinatura {text-align:center;} #rodap {text-align:center; font-size: 8px; margin-bottom:-20px;} #corpo {text-align: justify;} div {border-width:2px; border-style:dotted; border-color:black; width:99%; height:900px; padding:10px;}  body {font-size: 16px; color:black; font-family:Arial; background-image:url(assets/img/fundo.png); background-repeat: no-repeat; background-width:100%; } #nome {color:red;} #centro{text-align: center;} figure {margin-left:270px;}</style> 
        <div> <figure id=imag>
         <img src='img/logo.png'> 
        </figure> 
         <h5 id=centro> ".$dadosdaempresa["nome"]." </h5>
        <p id=centro> ".$dadosdaempresa["servicos"]." </p>
 

      <p id=centro style=font-size:30px> DECLARAÇÃO DE FREQUÊNCIA </p>  
<p id=corpo> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Para todos os efeitos legais, declara-se que <a id=nome> ".$dadosdo_aluno['nomecompleto']." </a> </strong>  filho (a) de ".$dadosdo_aluno['nomedopai']."   e de   ".$dadosdo_aluno['nomedamae']." , Natural de    ".$dadosdo_aluno['naturalidade']." , Província de  ".$dadosdo_aluno['provincia'].", Nascido aos ".$dadosdo_aluno['nascidia']."  de ".$dadosdo_aluno['nascimes']." de ".$dadosdo_aluno['nasciano'].".</p>  

 <p id=corpo > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frequenta nessa instituição de ensino no ano lectivo de ".$anolectivo."  a <a id=nome> ".$classe." </a> "; 
 if($dadosda_reconfirmacao["curso"]!="Nenhum") 
 { $htm.=" No curso de ".$dadosda_reconfirmacao['curso']." "; } 
 $htm.="  na sala nº ".$dadosda_reconfirmacao['sala']." no Período de ".$dadosda_reconfirmacao['periodo'].". </p> 


  <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='85%' align=center>
    <thead>
    <thead>
    <tr>
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Disciplina</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Média</th>    
    </tr>    
  </thead> 
  <tbody> 
       "; 


                        $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));

 
                         $nome_da_provadeescola=$dadosdoanolectivo["nomedaprovadeescola"];
                        $nome_da_provaderecurso=$dadosdoanolectivo["nomedaprovadeexame"];
                        $arredondarmedia_anolectivo=$dadosdoanolectivo["arredondarmedia"]; 
                        $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 
                        $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);




                       $idprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provadeescola' and idanolectivo='$idanolectivo'"))[0];
                       $idprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provaderecurso' and idanolectivo='$idanolectivo'"))[0];



       
          $disciplinas=mysqli_query($conexao, "select iddisciplina, titulo from disciplinas  where idturma='$idturma' order by agrupamento"); 
        
    $somadasnotas=0;
    $numerodedisciplina=mysqli_num_rows($disciplinas);
     while($exibir = $disciplinas->fetch_array()){

      $iddisciplina=$exibir["iddisciplina"];


       $notadaprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovadeescola'"))[0];

       $notadaprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovaderecurso'"))[0];

       $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT sum((notas.valordanota*tiposdenotas.percentagemnotrimestre)*trimestres.percentagemnoanolectivo) as media FROM notas, tiposdenotas, trimestres where tiposdenotas.idtipodenota=notas.idtipodenota and tiposdenotas.idtrimestre=trimestres.idtrimestre and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);


       if($notadaprovaderecurso!=''){
          $nota_final=$notadaprovaderecurso;
        }else{

           $nota_final=round((($dadosdoanolectivo["percentagemdamediadostrimestres"]*$mediadostrimestres)+($notadaprovadeescola*$percentagemrestante)), $arredondarmedia_anolectivo);  
        }

       if ($nota_final>=$minimoparapositiva) {

             $cor_classificacaofinal="Blue"; 
          }else{
            $cor_classificacaofinal="red"; 
          }

      $somadasnotas+=$nota_final;


     
     $htm.=" 
          <tr>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["titulo"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px' > <span  style='color:".$cor_classificacaofinal."'> ".$nota_final." </span></td> 
         </tr>  
           "; 
          } 
           
           $media_geral=round(($somadasnotas/$numerodedisciplina), 2);

            $htm.="
           
      </tbody>
</table> 

<p id=corpo>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Média Final: ".$media_geral." </p>

<p id=corpo>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Por ser verdade, emitiu-se a presente declaração, que vai ser assinada e autenticada com o carimbo a óleo, em uso nesta instituição.</p>


<br> 


<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Luanda,  ".$dia."  de   ".$mes."  de  ".$ano." .</b>


<p id=assinatura>O Director Geral <br>
___________________________ <br>
".$direitorgeral."
</p>
  
 
       <br>
<p id=rodap>
---------------------------------------------------------------
<br>".$dadosdaempresa["nome"]."/".$dadosdaempresa["localizacaoprecisa"]." <br>
 Telefone: ".$dadosdaempresa["telefone"]." 
<p>
    </div> ";


        $gerador->load_html($htm); 
        //$gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "declaracaocomnota".$dadosdo_aluno["nomecompleto"]."CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 nasciano