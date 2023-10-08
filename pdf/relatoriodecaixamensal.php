 
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
$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"$mesv";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"$anov";
$anodevenda=mysqli_escape_string($conexao, $anodevenda); 
 
$servico=isset($_GET['servico'])?$_GET['servico']:"todos";
 
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

        $gerador=new DOMPDF(); 
        $htm=' 
        <style>  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 18px; font-family: forte">'.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |Relatório de Caixa Mensal:   '.$mesdevenda.' / '.$anodevenda.'</span>
            <br> <br> <br> 
            |Entradas<br>
         <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="95%" align=center>
                  <thead>
                  <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Designação</th> ';


 
                             $diferentesdias= mysqli_query($conexao,"select DISTINCT(DAY(datadaentrada)) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)");

                             $dias_diferentes=[];

                         while($exibir_dia = $diferentesdias->fetch_array()){

                              $dias_diferentes[]=$exibir_dia[0];

                            $htm.=' <th width="auto" style="border: 1px solid; border-spacing:0px"> Dia '.$exibir_dia[0].' </th>';
                      }  
                         

                        $htm.='
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Sub-Total </th> 

                    </tr>
 

                  </thead> 
                  <tbody>

                  ';

                 

                   

                       $tipodeentradas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas where  YEAR(datadaentrada)='$anodevenda' AND '$mesdevenda'=MONTH(datadaentrada) ");

                       $total_valor_por_mes[]=0;
                    


                   while($exibir = $tipodeentradas->fetch_array()){



                    $tipodeentrada=$exibir['tipo'];

                      $total_valor_categoria=0;
                   
   
                      


 


                     $htm.='

                   <tr>
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'. $exibir["tipo"].'</td>
                      ';


                        foreach ($dias_diferentes as $key => $value) {
                  
                         $valor_do_tipo[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where  tipo='$tipodeentrada' and YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value' "))[0]+0;

                          $total_valor_categoria+=$valor_do_tipo[$value];

                          $valor_do_tipo_f=number_format($valor_do_tipo[$value],2,",", ".");

                         $htm.='
                         
                         <td width="auto" style="border: 1px solid; border-spacing:0px">'.$valor_do_tipo_f.'</td> 

                           ';


                         } 

                         $total_valor_categoria_f=number_format($total_valor_categoria,2,",", ".");

                         $htm.='

                          <td width="auto" style="border: 1px solid; border-spacing:0px">'.$total_valor_categoria_f.'</td> 
 
                    </tr>'; } 

                    $htm.='

                   </tbody> 

                   <tfoot>
                      <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Sub-total</th>';


 

                       $total_valor_mes=0;
                    

                              foreach ($dias_diferentes as $key => $value) {
                 
                        
                          $total_valor_por_mes[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value' "))[0]+0;

                          $total_valor_mes+=$total_valor_por_mes[$value];

                        
                            $total_valor_por_mes_f=number_format($total_valor_por_mes[$value],2,",", ".");

                         $htm.='
                         <th width="auto" style="border: 1px solid; border-spacing:0px" >'.$total_valor_por_mes_f.'</th> ';
 


                        } 

                         $totalentradascalculo=$total_valor_mes;
                            $total_valor_mes_f=number_format($total_valor_mes,2,",", ".");


                        $htm.='

                          <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_valor_mes_f.'</th> 
 
                    </tr>
                  

                   </tfoot>
                    
                </table>
        <br><br>

           ';

           $htm.='
         <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="95%" align=center>
        <thead> 
        <tr>
          <th  width="auto" style="border: 1px solid; border-spacing:0px">Tipo</th>  
          <th width="auto" style="border: 1px solid; border-spacing:0px">Valor Pago</th>
          <th width="auto" style="border: 1px solid; border-spacing:0px">Dívida</th> 
        </tr>  
      </thead> 
      <tbody> 
           ';  
           
              $registrosdeentrada=mysqli_query($conexao, "select distinct(tipo) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) order by datadaentrada asc"); 
            
            
 
            while($exibir = $registrosdeentrada->fetch_array()){
                $tipo = $exibir["tipo"];
                $dados = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) as valor, sum(divida) as divida from entradas where tipo='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)  order by datadaentrada asc")); 
              
                $valor=number_format($dados["valor"],2,",", ".");
                $divida=number_format($dados["divida"],2,",", ".");

               $htm.="
               
              <tr>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["tipo"]."</td>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$valor."</td>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$divida."</td>
        
              </tr>  
               "; 
              } 
            
                  $htm.="
           
         
          </tbody>
   </table> 
<br><br>

    |Saídas <br>

     <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='95%' align=center>
    <thead>
    <tr>
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Funcionário</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Descrição</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Tipo</th> 
      <th width='auto' style='border: 1px solid; border-spacing:0px'>Valor</th>  
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Por Consolidar</th> 
      <th width='auto' style='border: 1px solid; border-spacing:0px'>Data</th> 
    </tr>    
  </thead> 
  <tbody> 
       "; 
       
          $registrosdesaida=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario and  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) order by datadasaida asc"); 
        
        $totalsaida=0;
        $totaldivida=0;
     while($exibir = $registrosdesaida->fetch_array()){
      $totalsaida=$totalsaida+$exibir["valor"]; 
      $totaldivida=$totaldivida+$exibir["divida"]; 
      $valorindividual=number_format($exibir["valor"],2,",", "."); 
      $dividaindividual=number_format($exibir["divida"],2,",", "."); 
           $htm.=" 
          <tr>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomedofuncionario"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["descricao"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["tipo"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$valorindividual."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$dividaindividual."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["datadasaida"]."</td>
         </tr>  
           "; 
          } 
          
          $totalsaidacalculo=$totalsaida;
          $totalsaida=number_format($totalsaida,2,",", ".");  
          $totaldivida=number_format($totaldivida,2,",", ".");  
          
              $htm.="
          <tr>
              <td width='auto' style='border: 1px solid; border-spacing:0px'><strong>Total</strong></td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'> </td> 
              <td width='auto' style='border: 1px solid; border-spacing:0px'> </td> 
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totalsaida."</td> 
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totaldivida."</td> 
              <td width='auto' style='border: 1px solid; border-spacing:0px'> </td>  
          </tr>  
     
      </tbody>
</table> 


";

           $htm.='
         <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="95%" align=center>
        <thead>
        <tr>
          <th  width="auto" style="border: 1px solid; border-spacing:0px">Tipo</th>  
          <th width="auto" style="border: 1px solid; border-spacing:0px">Valor Pago</th>
          <th width="auto" style="border: 1px solid; border-spacing:0px">Por Consolidar</th> 
        </tr>  
      </thead> 
      <tbody> 
           ';  
           
              $registrosdeentrada=mysqli_query($conexao, "select distinct(tipo) from saidas where '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)  order by datadasaida asc"); 
            
            
 
            while($exibir = $registrosdeentrada->fetch_array()){
                $tipo = $exibir["tipo"];
                $dados = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) as valor, sum(divida) as divida from saidas where tipo='$tipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)   order by datadasaida asc")); 
              
                $valor=number_format($dados["valor"],2,",", ".");
                $divida=number_format($dados["divida"],2,",", ".");

               $htm.="
               
              <tr>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["tipo"]."</td>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$valor."</td>
                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$divida."</td>
        
              </tr>  
               "; 
              } 

                  $htm.="
           
         
          </tbody>
   </table> 
<br><br>";
            

$total=$totalentradascalculo-$totalsaidacalculo;
$total=number_format($total,2,",", ".");  

  $htm.="

             <br>
Hoje houve um total de Entrada de ".$total_valor_mes_f." KZ e um total de saída de ".$totalsaida." KZ. <br>
Tendo um saldo Mensal de ".$total." KZ. <br>
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>
        </div>
        ";


        $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "relatorio de caixa mensal | ".$mesdevenda."  -  ".$anodevenda."  CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );    ?>
 