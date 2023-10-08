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
					$iddoaluno= $_GET['id'];
						$sql10="select alunos.*, classe.nomedaclasse , classe.idclasse from alunos, classe where alunos.classedoaluno = classe.idclasse AND alunos.idaluno= $iddoaluno";
		$consulta10 = mysqli_query($conexao, $sql10);
		
    $trimestre= $_GET['trimestre'];;
    
        $dadospessoais=mysqli_fetch_array(mysqli_query($conexao,"select alunos.*, classe.nomedaclasse , classe.idclasse from alunos, classe where alunos.classedoaluno = classe.idclasse AND alunos.idaluno= $iddoaluno")) ;
        $direitorgeral=mysqli_fetch_array(mysqli_query($conexao,"select direitorgeral from dadosdainstituicao")) ;
	  
     $dia=date('d');  
     $mes=date('m');    
     $ano=date('Y');   
                
    $meusdados=mysqli_fetch_array(mysqli_query($conexao,"SELECT classedoaluno, curso, turma FROM alunos where idaluno='$iddoaluno'")); 
    $classe=$meusdados[0];
    $curso=$meusdados[1];
    $turma=$meusdados[2];
    $consulta1 = mysqli_query($conexao, "select  nome, iddisciplina   from disciplinas where disciplinas.classe='$classe' and disciplinas.curso='$curso' and disciplinas.turma='$turma' order by nome"); 
      
    $dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdainstituicao where iddado='2'"));
                   

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';

        $gerador=new DOMPDF();
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
		 if ($dadospessoais["curso"]=="Nenhum") {
      $dadospessoais["curso"]="";
     }
        
        $htm="<style> #centro{text-align: center; margin-top:-20px} span {font-size: 25px; color: rgb(227,108,10); float: right; margin-right: 110px;}  #assinatura {text-align:center;margin-top:-20px} #assinatura1 {text-align:center;} div {border-width:2px; border-style:solid; border-color:black; width:70%; height:auto; padding:2px; margin-top:-35px;}  body {font-size: 44px; color:black; font-family:Arial; } #nome {color:red;} #centro1{text-align: justify; padding:20px;margin-top:-20px} figure {margin-left:200px;}</style> 
        <div>
           <figure id=imag>
               <img src='assets/img/font-login2.png' >
          </figure> 
        <p id=centro> ".$dadosdainstituicao['nome']." <br>
        ".$dadosdainstituicao['ciclos']."<br>
        BOLETIM DE NOTAS 
         </p>  
        <p id=centro1>Nome: <a id=nome> ".$dadospessoais['nome']." </a> <br>   
         Trimestre: ".$trimestre."  ----   ".$dadospessoais['classedoaluno']." 
         Sala nº: ".$dadospessoais['sala']."   Período: ".$dadospessoais['periodo']." <br>
        Data ".$dia." / ".$mes." / ".$ano." --------  ".$dadospessoais['curso']."</p> ";

    $htm.="
    
    <table style='border: 0px solid; border-spacing:0px; margin-top:-20px; padding:20px;' width='70%' align=center>
        <tr>
          <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Disciplina</td>
          <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Falta</td>
          <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'>CT".$trimestre."</td> 
        </tr>
    ";
    if($trimestre=="I"){
      $trimestre=1; 
    }else if($trimestre=="II"){
      $trimestre=2; 
    } else {
      $trimestre=3; 
    }
      $painel="";
     while($exibir = $consulta1->fetch_array()){  
       $ct=0; 

        $dis=$exibir["iddisciplina"];  
        $minhanota1= mysqli_fetch_array(mysqli_query($conexao,"SELECT valordanota FROM nota where idaluno= '$iddoaluno' and iddisciplinafk= '$dis'  and trimestre='$trimestre'  and frequencia=1 limit 1"));
        $minhanota2= mysqli_fetch_array(mysqli_query($conexao,"SELECT valordanota FROM nota where idaluno= '$iddoaluno' and iddisciplinafk= '$dis'  and trimestre='$trimestre'  and frequencia=2 limit 1")) ;
        $falta=mysqli_fetch_array(mysqli_query($conexao,"SELECT valor FROM faltas where idaluno= '$iddoaluno' and iddisciplina= '$dis' and trimestre='$trimestre' limit 1"))[0];
       
        $ct=($minhanota1[0]+$minhanota2[0])/2;    $ct=round($ct);

        if($classe==14 || ($classe>=1 && $classe<=5)){
          
          if($ct<5){
            $painel="nome";
          }else{
            $painel="";
          }
               
      }else if($classe!=14 && !($classe>=1 && $classe<=5)){
       
        if($ct<10){
          $painel="nome";
        }else{
          $painel="";
        }

         }
         if($classe==14 || $classe==1 || $classe==3 || $classe==5 )
         {
         if($ct>=0 && $ct<=2){ $ct="MAU"; }
         if($ct>2  && $ct<=4){ $ct="MED"; }
         if($ct>4  && $ct<=6){ $ct="SUF";}
         if($ct>6  && $ct<=8){ $ct="BOM";}
         if($ct>8  && $ct<=10){ $ct="MB"; }
         }
        
      

        $htm.="<tr>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir['nome']."</td>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>&nbsp;".$falta."</td>
                   
                   <td width='auto' style='border: 1px solid; border-spacing:0px'><a id=".$painel.">".$ct."</a></td>
                   
               </tr>";

     }

     $htm.="
     <tr>
          <td width='auto' style='border: 1px solid; border-spacing:0px'>Comportamento</td>
          <td width='auto' style='border: 1px solid; border-spacing:0px'>&nbsp;</td>
          <td width='auto' style='border: 1px solid; border-spacing:0px'>&nbsp;</td> 
     </tr>
     <tr>
          <td width='auto' style='border: 1px solid; border-spacing:0px'>Observação</td>
          <td width='auto' style='border: 1px solid; border-spacing:0px'>&nbsp;</td>
          <td width='auto' style='border: 1px solid; border-spacing:0px'>&nbsp;</td> 
     </tr>
  ";
     
     


		    $htm.="
    </table>
    
    <p id=centro>
Luanda ".$dia."/".$mes."/".$ano."<br>
</p>
<p id=assinatura1>
Director Pedagógico <br>
___________________________________ <p>  <br>
____________________________________________________________________________
  </p> <br>
  <img src='assets/img/font-login2.png' > <span > <strong>Colégio Arena Do Saber</strong> </span>
 
<p id=centro1>Nome: <a id=nome> ".$dadospessoais['nome']." </a> <br>   
Trimestre: ".$trimestre."  ----   ".$dadospessoais['classedoaluno']." 
Sala nº: ".$dadospessoais['sala']."   Período: ".$dadospessoais['periodo']." <br>
 Confirmo a recepção do Boletim de notas do ".$trimestre."º Trimestre de 2018. </p>
<p id=assinatura>
Encarregado de Educação <br>
__________________________________ <p>   
 
<br><br><br>
    </div>
    
    
    ";




        $gerador->load_html($htm); 
       // $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "relatorio.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 