<?php
  
  session_start();

	 if(!isset($_SESSION['logado'])):
		 header('Location: index.php');
	 endif;
	 
	 
	 $id=$_SESSION['id_usuario'];  
	 $painel=$_SESSION['painel'];

	 if(($painel!="administração" &&  $painel!="secretariapedagogica"  &&  $painel!="secretariageral" )){  
		header('Location: index.php');
	   
   } 
   
	include_once("conexao.php"); 
					$iddoaluno= $_POST['id'];
						$sql10="select alunos.*, classe.nomedaclasse , classe.idclasse from alunos, classe where alunos.classedoaluno = classe.idclasse AND alunos.idaluno= $iddoaluno";
		$consulta10 = mysqli_query($conexao, $sql10);
		
		
        $dadospessoais=mysqli_fetch_array(mysqli_query($conexao,"select alunos.*, classe.nomedaclasse , classe.idclasse from alunos, classe where alunos.classedoaluno = classe.idclasse AND alunos.idaluno= $iddoaluno")) ;
        $direitorgeral=mysqli_fetch_array(mysqli_query($conexao,"select direitorgeral from dadosdainstituicao")) ;
	 

     $dia=date('d');  
     $mes=date('m');  
     $ano=date('Y');   
                 
?> 


    <?php 

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';

       $gerador=new DOMPDF(["chroot" => __DIR__]); 
  if($dadospessoais["nascidia"]<10){
    $dadospessoais["nascidia"]="0"."$dadospessoais[nascidia]";
  }

  if($dadospessoais["classedoaluno"]==14){
    $dadospessoais["classedoaluno"]="Iniciação";
  } else {
    $dadospessoais["classedoaluno"]="$dadospessoais[classedoaluno]"."ª Classe";
  }
  if($dadospessoais['nascimes']==1) 
  $dadospessoais['nascimes']="Janeiro"; 
else
if($dadospessoais['nascimes']==2) 
  $dadospessoais['nascimes']="Fevereiro"; 
else
if($dadospessoais['nascimes']==3) 
  $dadospessoais['nascimes']="Março"; 
else
  if($dadospessoais['nascimes']==4) 
  $dadospessoais['nascimes']="Abril"; 
else if($dadospessoais['nascimes']==5) 
  $dadospessoais['nascimes']="Maio"; 
else if($dadospessoais['nascimes']==6) 
  $dadospessoais['nascimes']="Junho"; 
else if($dadospessoais['nascimes']==7) 
  $dadospessoais['nascimes']="Julho"; 
else if($dadospessoais['nascimes']==8) 
  $dadospessoais['nascimes']="Agosto"; 
else if($dadospessoais['nascimes']==9) 
  $dadospessoais['nascimes']="Setembro"; 
else if($dadospessoais['nascimes']==10) 
  $dadospessoais['nascimes']="Outubro"; 
else if($dadospessoais['nascimes']==11) 
  $dadospessoais['nascimes']="Novembro"; 
else if($dadospessoais['nascimes']==12) 
  $dadospessoais['nascimes']="Dezembro"; 



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
        <img src='assets/img/font-login.png' >
        </figure> 
        <p id=centro> <i>Em busca da Sabedoria</i> </p>  
        <p id=centro> Ensino Primário Iº e IIº Ciclo do Ensino Secundário </p>
 

      <p id=centro style=font-size:30px> DECLARAÇÃO </p> 
<p id=corpo> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Para todos os efeitos legais, declara-se que <a id=nome> ".$dadospessoais['nome']." </a> </strong>  filho (a) de ".$dadospessoais['nomedopai']."   e de   ".$dadospessoais['nomedamae']." , Natural de    ".$dadospessoais['naturalidade']." , Provincia de 
".$dadospessoais['provincia']." Nascido aos ".$dadospessoais['nascidia']."  de ".$dadospessoais['nascimes']." de ".$dadospessoais['nasciano'].".</p>  

 <p id=corpo > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frequenta nessa instituição de ensino no ano lectivo de ".$dadospessoais['anoatual']."  a <a id=nome> ".$dadospessoais['classedoaluno']." </a> "; 
 if($dadospessoais["curso"]!="Nenhum") 
 { $htm.=" No curso de ".$dadospessoais['curso']." "; } 
 $htm.="  na sala nº ".$dadospessoais['sala']." no Período de ".$dadospessoais['periodo'].". </p> 
<p id=corpo >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Por ser verdade, emitiu-se a presente declaração, que vai ser assinada e autenticada com o carimbo a óleo, em uso nesta instituição.</p>


<br> 


<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Luanda,  ".$dia."  de   ".$mes."  de  ".$ano." .</b>


<p id=assinatura>O Director Geral <br>
___________________________ <br>
".$direitorgeral[0]."
</p>
  
 
       <br>
<p id=rodap>
---------------------------------------------------------------
<br>Complexo Arena do Saber/Bairro-Jacinto Chipa-Rua do Bequessa <br>
 Telefone: 931940229/998905918 
<p>
    </div> ";


        $gerador->load_html($htm); 
        //$gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "relatorio.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 