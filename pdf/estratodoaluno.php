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

 

    
            $dadosdo_aluno=mysqli_fetch_array(mysqli_query($conexao, "select MONTH(datadenascimento) as nascimes , YEAR(datadenascimento) as nasciano , DAY(datadenascimento) as nascidia, alunos.* from alunos where idaluno='$idaluno' limit 1"));

             $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM turmas where idturma='$idturma' "));

    $eclassedeexame=$dadosdaturma['eclassedeexame'];



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
		 

        
       $htm="<style> #centro{text-align: center; margin-top:-20px} 

       span {font-size: 25px; color: rgb(227,108,10); float: right; margin-right: 110px;} 

        #assinatura {text-align:center;margin-top:-20px} #assinatura1 {text-align:center;} 

       div {  width:100%; height:auto; padding:2px; margin-top:-35px;}  body {font-size: 13px; color:black; font-family:Arial; } #nome {color:red;} #centro1{text-align: justify; padding:20px;margin-top:-20px} </style> 
        <div>
         <br><br>
        <p id=centro>

          <figure id=imag>
               <img src='img/logopequena.png' style='float:left'>
          </figure>
 

           <t style='font-size:35px;'> ".$dadosdaempresa['nome']." </t><br>
              ".$dadosdaempresa['servicos']." <br>

       <br>  
    <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='95%' align=center>

         <tr>
         <th  width='auto' style='border: 3px solid; border-spacing:0px; font-size: 26px'> </th>
         </tr>
        <tr>
         <th  width='auto' style='border: 1px solid; border-spacing:0px'> >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Estrato do Aluno  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> </th>
         </tr>
    </table>
         </p>  
        <p id=centro1> 

         <strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$dadosda_reconfirmacao['classe']." Classe    </strong>  / Curso:    <strong> ";  if($dadosda_reconfirmacao["curso"]!="Nenhum")  { $htm.=" ".$dadosda_reconfirmacao['curso']." "; } $htm.="    </strong> / Ano Lecivo:  ".$anolectivo.".   



   <table style='border:0px solid; border-spacing:0px; margin-top:-50px;  padding:20px' width='90%' align=center>
 
        <tr>
         <th  width='80%' style='border: 1px solid; border-spacing:0px'>  Nome Completo: <a id=nome> ".$dadosdo_aluno['nomecompleto']."    </a> </th> 
          <th  width='20%' style='border: 1px solid; border-spacing:0px'>Nº________ <br> Sala:  ".$dadosda_reconfirmacao['sala']."  <br> Turno:".$dadosda_reconfirmacao['periodo']." <br>  
           </th>
         </tr>
    </table>



   
        <br> ";



$htm.='<table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="95%" align=center>
                  <thead>
                  <thead>
                  <tr>
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">Funcionário</th>   
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">Descrição</th> 
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Categoria</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">F. Pag.</th> 
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Valor Pago</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Dívida</th> 
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Data</th> 
                  </tr>  
                </thead> 
                <tbody> 
                     ';  
                     
                        $registrosdeentrada=mysqli_query($conexao, "select YEAR(entradas.datadaentrada) as ano, funcionarios.nomedofuncionario, entradas.* from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario and  idanolectivo='$idanolectivo' and idaluno='$idaluno'  order by datadaentrada asc"); 
                      
                      

                      $totalentradas=0;
                      $totademdivida=0;
                      while($exibir = $registrosdeentrada->fetch_array()){
                              
                    $idaluno=$exibir["idaluno"];
                  
                 
                   $nomecompleto=mysqli_fetch_array(mysqli_query($conexao,"SELECT  nomecompleto  FROM alunos where idaluno='$idaluno'"))[0]; 
                        
                         $htm.="
                         
                        <tr>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomedofuncionario"]."</td>                             <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["descricao"]."</td>
                             <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["tipo"]."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["formadepagamento"]."</td>";
 
                                          
                            $totalentradas=$totalentradas+$exibir["valor"]; 
                             $valor=number_format($exibir["valor"],2,",", ".");
                            $dividaindividual=number_format($exibir["divida"],2,",", "."); 
                            $totademdivida+=$exibir["divida"];

                            $htm.="
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$valor."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$dividaindividual."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["datadaentrada"]."</td>  
      
                        </tr>  
                         "; 
                        } 
                        $totalentradascalculo=$totalentradas;
                        $totalentradas=number_format($totalentradas,2,",", "."); 
                        $totademdivida=number_format($totademdivida,2,",", ".");
                            $htm.="
                        <tr>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'><strong>Total</strong></td> 
                            <td width='auto' style='border: 1px solid; border-spacing:0px'> </td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'> </td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'> </td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totalentradas."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totademdivida."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'> </td>  
                        </tr>  
                   
                    </tbody>
             </table> 


 
<br><br> 
 
 


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  A Direição      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  O Encarregado(a) de Educação  <br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ___________________________________
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________/_______/_______________
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel:_________________________
<br><br><br><br>




&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Luanda, ".$dia." de ".$mes."  de ".$anolectivo." <br><br><br>

  


    </div> ";


        $gerador->load_html($htm); 
        //$gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Estratodoaluno".$dadosdo_aluno["nomecompleto"]."CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 nasciano