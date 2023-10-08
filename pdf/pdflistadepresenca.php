 
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
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

    $hojemes=date('m');
    $hojeano=date('Y');

   $mesescolhido=isset($_GET['mes'])?$_GET['mes']:"$hojemes";
   $anoescolhido=isset($_GET['ano'])?$_GET['ano']:"$hojeano";
   
   $mesescolhido=mysqli_escape_string($conexao, $mesescolhido);
   $anoescolhido=mysqli_escape_string($conexao, $anoescolhido);
   
        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

        $gerador=new DOMPDF(); 
        $htm=' 
        <style>  #centro{text-align: center;} figure {margin-top:-45px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure> 
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 22px; font-family: forte"> '.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |LISTA DE PRESENÇA: '.$mesescolhido.' / '.$anoescolhido.'</span>
            <br> <br> <br> 
        <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="98%" align=center>
                  <thead>
                  
                  <tr>
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">Funcionário</th>';
                    for ($i=1; $i <=31; $i++) { $htm.='
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">'.$i.'</th>
                    ';}                         $htm.='
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">Total(Dias)</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Total(salário)</th>  
                  </tr> 
 
                </thead> 
                <tbody> 
                     ';

                     $listadefuncionários=mysqli_query($conexao,"SELECT * FROM funcionarios");
                     $salariodetodos=0; 
                      while($exibir = $listadefuncionários->fetch_array()){ 
                        $idfuncionario=$exibir['idfuncionario'];
                        $totaldedias=0;
                        $salariototal=0;

                    $htm.="  
                         
                        <tr>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomedofuncionario"]."</td>
                            ";
                            for ($i=1; $i <=31; $i++) {
                                
                                $cor="red";
                                $imprimir="";

                                $falta=mysqli_fetch_array(mysqli_query($conexao,"SELECT falta, remunerar, salariopordia FROM presenca where idfuncionario='$idfuncionario' and ano='$anoescolhido' and dia='$i' and mes='$mesescolhido' limit 1")); 


                                $totaldedias=$totaldedias+mysqli_num_rows(mysqli_query($conexao,"SELECT * FROM presenca where idfuncionario='$idfuncionario' and ano='$anoescolhido' and dia='$i' and mes='$mesescolhido' limit 1"));


                                if($falta["remunerar"]==1){$salariototal=$salariototal+1*$falta["salariopordia"];}
                                if($falta["remunerar"]==1){ $cor="rgb(238,251,210)"; $imprimir="P";} else {$cor="rgb(255,159,165)"; $imprimir="F$falta[falta]"; }
                                if($falta["remunerar"]==1 && $falta["falta"]!="P"){ $cor="rgb(238,251,210)"; $imprimir="F$falta[falta]";}
                                if($falta==null){ $imprimir=""; $cor="";}

                                
                                $salariototaindividual=number_format($salariototal,2,",", ".");

                                $htm.="
                                
                                <td  width='auto' style='border: 1px solid; border-spacing:0px; background-color:".$cor."'>".$imprimir." </td>

                            "; }
                            $salariodetodos=$salariodetodos+$salariototal;
                            $htm.="
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totaldedias."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$salariototaindividual." KZ</td>  
                        </tr>
                        ";}
                                $htm.="
                        <tr>
                        <td width='auto' style='border: 1px solid; border-spacing:0px'><strong>Total</strong></td>";

                           for ($i=1; $i <=31; $i++) { $htm.=" 
                           <td width='auto' style='border: 1px solid; border-spacing:0px'></td>";
                          }  

                          $salariodetodososfuncionarios=number_format($salariodetodos,2,",", ".");
                          $htm.="
                        <td width='auto' style='border: 1px solid; border-spacing:0px'></td>
                        <td width='auto' style='border: 1px solid; border-spacing:0px'><strong> ".$salariodetodososfuncionarios." Kz</strong></td>
                      </tr>
                   </tbody>
             </table> 
        <br><br>
            <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='98%' align=center>
            <thead>
                <tr> 
                <th  width='auto' style='border: 1px solid; border-spacing:0px'>Referente Faltas sem Remuneração</th>
                <th width='auto' style='border: 1px solid; border-spacing:0px'>Referente Faltas com Remuneração</th>  
                </tr> 
           </thead> 
           <tbody> 
                <tr>
                    <td width='auto' style='border: 1px solid; border-spacing:0px'>
                                    12| Licença<br> 
                                    22| Licença de Materninadade<br>
                                    67| Falta Justificada <br>
                                    68| Falta injustificada <br>
                                    69| Falta por Doença <br> 
                                    72| Meia falta justificada <br>
                                    73| Meia Falta injustificada <br>
                                    79| Dia de interrupção de serviço<br>
                                    
                    </td>
                    <td width='auto' style='border: 1px solid; border-spacing:0px'>
                                    02| Doença Especial <br> 
                                    13| Falta por doença <br>
                                    21| Falta justificada <br>
                                    22| Licença de Materninadade<br> 
                                    70| Dias de férias <br> 
                                    79| Dia de interrupção de serviço<br>
                    
                    </td>   
                </tr>
           </tbody>
        </table> 
             <br>
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>
        </div>
        ";


       $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "listadepresencaCalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 