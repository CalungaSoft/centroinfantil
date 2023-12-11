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
		 
        
        $htm="<style> #assinatura {text-align:center;} #rodap {text-align:center; font-size: 8px; margin-bottom:-20px;} #corpo {text-align: justify;} div {border-width:2px; border-style:dotted; border-color:black; width:99%; height:900px; padding:10px;}  body {font-size: 22px; color:black; font-family:Arial; background-image:url(assets/img/fundo.png); background-repeat: no-repeat; background-width:100%; } #nome {color:red;} #centro{text-align: center;} figure {margin-left:270px;}</style> 
        <div> <figure id=imag>
         <img src='img/logo.png'> 
        </figure> 
         <h3 id=centro> ".$dadosdaempresa["nome"]." </h3>
        <p id=centro> ".$dadosdaempresa["servicos"]." </p>
 

      <p id=centro style=font-size:30px> DECLARAÇÃO DE FREQUÊNCIA </p>  <br>
<p id=corpo> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Para todos os efeitos legais, declara-se que <a id=nome> ".$dadosdo_aluno['nomecompleto']." </a> </strong>  filho (a) de ".$dadosdo_aluno['nomedopai']."   e de   ".$dadosdo_aluno['nomedamae']." , Natural de    ".$dadosdo_aluno['naturalidade']." , Província de  ".$dadosdo_aluno['provincia'].", Nascido aos ".$dadosdo_aluno['nascidia']."  de ".$dadosdo_aluno['nascimes']." de ".$dadosdo_aluno['nasciano'].".</p>  

 <p id=corpo > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frequenta nessa instituição de ensino no ano lectivo de ".$anolectivo."  a <a id=nome> ".$classe." </a> "; 
 if($dadosda_reconfirmacao["curso"]!="Nenhum") 
 { $htm.=" No curso de ".$dadosda_reconfirmacao['curso']." "; } 
 $htm.="  na sala nº ".$dadosda_reconfirmacao['sala']." no Período de ".$dadosda_reconfirmacao['periodo'].". </p> 
<p id=corpo >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Por ser verdade, emitiu-se a presente declaração, que vai ser assinada e autenticada com o carimbo a óleo, em uso nesta instituição.</p>


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
            "declaracaosemnotaCalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 nasciano