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
      $iddoaluno=$_POST['id'];
      $dirmunicipal=$_POST['dirmunicipal'];
      $frase=$_POST['frase'];
      $livroregistro=$_POST['livroregistro'];
      $folhas=$_POST['folhas'];
      $municipio=$_POST['municipio'];
       
		$disciplinas = mysqli_query($conexao, "select * from disciplinas where classe='2' or classe='4' or classe='6' order by nome");
		$fim=mysqli_fetch_array(mysqli_query($conexao, "SELECT ano FROM nota where idaluno='$iddoaluno' and classe= '6' limit 1"))[0];
		
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
    $dadospessoais["classedoaluno"]="pré";
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
         
            $disciplinas1 = mysqli_query($conexao, "select * from disciplinas where classe='2' or classe='4' or classe='6' order by nome");
            $nome="Esmael Calunga"; $n=0; $somatotal=0; while($mostrar = $disciplinas1->fetch_array()){  
                $iddisciplina=[0,0,0,0,0,0,0,0]; $totald=0;
               if($nome!=$mostrar["nome"]){
                   $nome2=$mostrar["nome"];
                   $iddisciplina[2]=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina from disciplinas where classe='2' and nome='$nome2'"))[0];
                   $iddisciplina[4]=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina from disciplinas where classe='4' and nome='$nome2'"))[0];
                   $iddisciplina[6]=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina from disciplinas where classe='6' and nome='$nome2'"))[0];
                   $media6=[0,0,0,0,0,0,0,0,0,0,0];   $marca6=[0,0,0,0,0,0,0,0,0,0,0];
                   if($iddisciplina[2]>0){$totald++;} if($iddisciplina[4]>0){$totald++;} if($iddisciplina[6]>0){$totald++;}
                  for ($i=2; $i<=6; $i=$i+2) { 
                      
                    $dis=$iddisciplina[$i]; 
                   $frequencia1t1=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=1  and frequencia=1 limit 1"));
                   $frequencia2t1=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=1  and frequencia=2 limit 1"));

                   $frequencia1t2=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=2  and frequencia=1 limit 1"));
                   $frequencia2t2=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=2  and frequencia=2 limit 1"));

                   $frequencia1t3=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=1 limit 1"));
                   $frequencia2t3=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=2 limit 1"));
                   $frequencia3t3=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=3 limit 1"));
                   $recurso=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=4 limit 1"));
                   $media1=($frequencia1t1[0]+$frequencia2t1[0])/2;
                   $media2=($frequencia1t2[0]+$frequencia2t2[0])/2;
                   $media3=($frequencia1t3[0]+$frequencia2t3[0])/2;
                  
                   $media4=($media1+$media2+$media3)/3;

                   if($i==6){
										//se não tiver nota de recurso
										if($recurso==null){

										$media6[$i]=round(((0.4*$media4)+(0.6*$frequencia3t3[0])));
										//se tiver:
										}else{
											$media6[$i]=$recurso[0]; //classificação final será nota do recurso
										}
									//para as classes que não são de exame:
								   } else{

									  $media6[$i]=round(($media4+$frequencia3t3[0])/2);

                   }
                   
                    
                }
                $mediapordisciplina=(($media6[2]+$media6[4]+$media6[6])/$totald); 
                $somatotal+=$mediapordisciplina;
                $n++;  } $nome=$mostrar["nome"];}
                
                    $somatotal=round($somatotal/$n);
        $mesd=date('m'); $anod=date('Y'); $diad=date('d');
        $htm="<style> #texto {text-align:justify;} #nome {color:red;} #marcadis {background-color:rgb(127,127,127);}  #assinatura {text-align:center;} #rodap {text-align:left; font-size: 8px; margin-bottom:-20px;} #corpo {text-align: justify;} div {border-width:4px; border-style:solid; border-color:black; width:100%; height:920px; padding:10px; margin-top:-30px;} #cert {font-size: 29px; color:black; font-family:Arial; padding:10px;} body {font-size: 15px; color:black; font-family:Arial; padding:10px;} #nome {color:red;} #centro{text-align: center;} figure {margin-left:310px; margin-bottom:-15px;margin-top:-8px;}</style> 
        <div> <figure id=imag>
        <img src='assets/img/insignia.jpg' >
        </figure>    
            <p id=centro> REPÚBLICA DE ANGOLA <br>
            MINISTÉRIO DA EDUCACÃO<br> </p>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Visto do(a) &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ENSINO PRIMÁRIO <br>
                    &nbsp;&nbsp;&nbsp; Director(a)  Municipal <br> 
                    &nbsp;&nbsp;_______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span id=cert>CERTIFICADO</span> <br>
                    &nbsp;&nbsp;&nbsp;&nbsp; ".$dirmunicipal."
                    <p id=texto>
                    &nbsp;&nbsp;&nbsp;a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$frase.",certifico que <a id=nome> ".$dadospessoais['nome']." </a>, filha (o) de ".$dadospessoais['nomedopai']."  e de ".$dadospessoais['nomedamae'].", Nascido aos ".$dadospessoais['nascidia']."  de ".$dadospessoais['nascimes']." de ".$dadospessoais['nasciano'].", natural de ".$dadospessoais['naturalidade'].", Província de ".$dadospessoais['provincia'].", portador do B.I nº ".$dadospessoais['numerodobi'].", passado pelo Arquivo de Identificação de ".$dadospessoais['arquivoidentificacao'].", concluiu no ano lectivo de ".$fim." o <strong> ENSINO PRIMÁRIO </strong>, conforme o disposto na alínea b) do artigo 109.º da LBSEE 17/16, de 7 de Outubro, com a Média Final de <a id=nome>".$somatotal."</a> valores obtida nas seguintes classificações por ciclos de aprendizagem: </p>
 
                     
          <table style='border:0px solid; border-spacing:0px; margin-top:-5px;  padding:0px' width='100%' align=center>
                      <tr>
                            <td rowspan='2' width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Disciplinas</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'>I Ciclo</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'>II Ciclo</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'>III Ciclo</td> 
                            <td rowspan='2' width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Média Final</td>
                            <td rowspan='2' width='auto' style='border: 1px solid; border-spacing:0px' align='center'>Média por Extenso</td>
                      </tr>
                      <tr>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> 2ª Classe</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> 4ª Classe</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> 6ª Classe</td> 
                     </tr>
                                        "; $nome="Esmael Calunga"; while($mostrar = $disciplinas->fetch_array()){  
                                            $iddisciplina=[0,0,0,0,0,0,0,0]; $totald=0;
                                           if($nome!=$mostrar["nome"]){
                                               $nome2=$mostrar["nome"];
                                               $iddisciplina[2]=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina from disciplinas where classe='2' and nome='$nome2'"))[0];
                                               $iddisciplina[4]=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina from disciplinas where classe='4' and nome='$nome2'"))[0];
                                               $iddisciplina[6]=mysqli_fetch_array(mysqli_query($conexao, "select iddisciplina from disciplinas where classe='6' and nome='$nome2'"))[0];
                                               $media6=[0,0,0,0,0,0,0,0,0,0,0];   $marca6=[0,0,0,0,0,0,0,0,0,0,0];
                                               if($iddisciplina[2]>0){$totald++;} if($iddisciplina[4]>0){$totald++;} if($iddisciplina[6]>0){$totald++;}
                                              for ($i=2; $i<=6; $i=$i+2) { 
                                                  
                                                $dis=$iddisciplina[$i]; 
                                               $frequencia1t1=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=1  and frequencia=1 limit 1"));
                                               $frequencia2t1=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=1  and frequencia=2 limit 1"));
               
                                               $frequencia1t2=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=2  and frequencia=1 limit 1"));
                                               $frequencia2t2=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=2  and frequencia=2 limit 1"));
               
                                               $frequencia1t3=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=1 limit 1"));
                                               $frequencia2t3=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=2 limit 1"));
                                               $frequencia3t3=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=3 limit 1"));
                                               $recurso=mysqli_fetch_array(mysqli_query($conexao, "SELECT valordanota FROM nota where idaluno='$iddoaluno' and iddisciplinafk= '$dis' and classe= '$i'  and trimestre=3  and frequencia=4 limit 1"));
                                               $media1=round(($frequencia1t1[0]+$frequencia2t1[0])/2);
                                               $media2=round(($frequencia1t2[0]+$frequencia2t2[0])/2);
                                               $media3=round(($frequencia1t3[0]+$frequencia2t3[0])/2);
                                               
                                               $media4=round(($media1+$media2+$media3)/3);
                                               
                                               if($i==6){
                                                //se não tiver nota de recurso
                                                if($recurso==null){
                            
                                                $media6[$i]=round(((0.4*$media4)+(0.6*$frequencia3t3[0])));
                                                //se tiver:
                                                }else{
                                                  $media6[$i]=$recurso[0]; //classificação final será nota do recurso
                                                }
                                              //para as classes que não são de exame:
                                               } else{
                            
                                                $media6[$i]=round(($media4+$frequencia3t3[0])/2);
                            
                                               }
                                               
                                            }
                                            $mediapordisciplina=round((($media6[2]+$media6[4]+$media6[6])/$totald));
                                            $mediapordisciplinaextenso=round((($media6[2]+$media6[4]+$media6[6])/$totald));
                                            for ($i=2; $i<=6; $i=$i+2) { 
                                              if($media6[$i]==0){$media6[$i]= "$media6[$i] (zero)";} if($media6[$i]==1){$media6[$i]= "$media6[$i] (Um)";} if($media6[$i]==2){$media6[$i]= "$media6[$i] (Dois)";} if($media6[$i]==3){$media6[$i]= "$media6[$i] (Três)";} if($media6[$i]==4){$media6[$i]= "$media6[$i] (Quatro)";} if($media6[$i]==5){$media6[$i]= "$media6[$i] (Cinco)";}
                                              if($media6[$i]==6){$media6[$i]= "$media6[$i] (Seis)";} if($media6[$i]==7){$media6[$i]= "$media6[$i] (Sete)";} if($media6[$i]==8){$media6[$i]= "$media6[$i] (Oito)";} if($media6[$i]==9){$media6[$i]= "$media6[$i] (Nove)";}if($media6[$i]==10){$media6[$i]= "$media6[$i] (Dez)";}
                                               
                                              if($media6[$i]<5){$marca6[$i]="nome";}
                                         
                                            }
                                              if($mediapordisciplina<5){$marca7="nome";}else{ $marca7="Esmael Calunga";}
                                              if($mediapordisciplinaextenso==0){$mediapordisciplinaextenso="zero";} if($mediapordisciplinaextenso==1){$mediapordisciplinaextenso="Um";} if($mediapordisciplinaextenso==2){$mediapordisciplinaextenso="Dois";} if($mediapordisciplinaextenso==3){$mediapordisciplinaextenso="Três";} if($mediapordisciplinaextenso==4){$mediapordisciplinaextenso="Quatro";} if($mediapordisciplinaextenso==5){$mediapordisciplinaextenso="Cinco";}
                                              if($mediapordisciplinaextenso==6){$mediapordisciplinaextenso="Seis";} if($mediapordisciplinaextenso==7){$mediapordisciplinaextenso="Sete";} if($mediapordisciplinaextenso==8){$mediapordisciplinaextenso="Oito";} if($mediapordisciplinaextenso==9){$mediapordisciplinaextenso="Nove";}  if($mediapordisciplinaextenso==10){$mediapordisciplinaextenso="Dez";}
                                              if($mediapordisciplinaextenso==11){$mediapordisciplinaextenso="Onze";} if($mediapordisciplinaextenso==12){$mediapordisciplinaextenso="Doze";} if($mediapordisciplinaextenso==13){$mediapordisciplinaextenso="Treze";} if($mediapordisciplinaextenso==14){$mediapordisciplinaextenso="Catorze";} if($mediapordisciplinaextenso==15){$mediapordisciplinaextenso="Quinze";} if($mediapordisciplinaextenso==16){$mediapordisciplinaextenso="Dezesseis";}
                                              if($mediapordisciplinaextenso==17){$mediapordisciplinaextenso="Dezessete";} if($mediapordisciplinaextenso==18){$mediapordisciplinaextenso="Dozoito";} if($mediapordisciplinaextenso==19){$mediapordisciplinaextenso="Dezenove";} if($mediapordisciplinaextenso==20){$mediapordisciplinaextenso="Vinte";} 
                                        
                                            $marcadis2="";$marcadis4="";$marcadis6="";
                                            if($iddisciplina[2]==null){$marcadis2="marcadis"; $media6[2]="";}
                                            if($iddisciplina[4]==null){$marcadis4="marcadis"; $media6[4]="";}
                                            if($iddisciplina[6]==null){$marcadis6="marcadis"; $media6[6]="";}
                                        $htm.=" 
                     <tr>                    
                            <td width='auto' style='border: 1px solid; border-spacing:0px' > ".$mostrar['nome']." </td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center' id=$marcadis2> <span id=$marca6[2]> ".$media6[2]."</span></td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center' id=$marcadis4> <span id=$marca6[4]> ".$media6[4]."</span> </td> 
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center' id=$marcadis6> <span id=$marca6[6]> ".$media6[6]."</span></td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> <span id=$marca7>  ".$mediapordisciplina." (".$mediapordisciplinaextenso.")</span> </td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px' align='center'> <span id=$marca7>  ".$mediapordisciplinaextenso."</span> </td> 
                    </tr>"; } $nome=$mostrar["nome"];  }
                     
                     $htm.="
                      </table>
 <br>
   <p id=corpo >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Para efeitos legais lhe é passado o presente <strong> CERTIFICADO </strong>, que consta do livro de registo nº ".$livroregistro." folhas ".$folhas.", assinado por mim e autenticado com carimbo a óleo em uso neste estabelecimento de ensino.
 <br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direcção Municipal da Educação de ".$municipio." em Luanda,  ".$dia."  de   ".$mes."  de  ".$ano."

</p>

  


<p id=assinatura> Conferido por &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  O(A) Director(a)  <br>
___________________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________  
 
</p>
  <br><br>
  
<p id=rodap> 
  a)	Nome do(a) Director(a)  
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
 