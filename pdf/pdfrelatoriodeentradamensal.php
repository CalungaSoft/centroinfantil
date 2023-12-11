 
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
$diadevenda=isset($_GET['diadevenda'])?$_GET['diadevenda']:"$diav";
$diadevenda=mysqli_escape_string($conexao, $diadevenda);
 
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

       $gerador=new DOMPDF(["chroot" => __DIR__]);  
        $htm=' 
        <style>  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div><center>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 18px; font-family: forte">'.$dadosdainstituicao["servicos"].'  </span></p> </center>
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |Relatório Mensal: '.$mesdevenda.' / '.$anodevenda.'</span>
            <br> <br> <br> ';

            $htm.='
            |Entradas <br> 

             <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="95%" align=center>
                  <thead>
                  <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Designação</th> ';


 
                             $diferentesdias= mysqli_query($conexao,"select DISTINCT(DAY(datadaentrada)) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) and DAY(datadaentrada)<='15'");

                             $dias_diferentes=[];

                         while($exibir_dia = $diferentesdias->fetch_array()){

                              $dias_diferentes[]=$exibir_dia[0];

                            $htm.=' "<th width="auto" style="border: 1px solid; border-spacing:0px"> Dia '.$exibir_dia[0].' </th>';
                      }  
                         

                        $htm.='
                      

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

                          
                          $valor_do_tipo_f=number_format($valor_do_tipo[$value],2,",", ".");

                         $htm.='
                         
                         <td width="auto" style="border: 1px solid; border-spacing:0px">'.$valor_do_tipo_f.'</td> 

                           ';


                         } 

                         
                         $htm.='

                         
 
                    </tr>'; } 

                    $htm.='

                   </tbody> 

                   <tfoot>
                      <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Sub-total</th>';


 
 

                              foreach ($dias_diferentes as $key => $value) {
                 
                        
                          $total_valor_por_mes[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value' "))[0]+0;

                       
                        
                            $total_valor_por_mes_f=number_format($total_valor_por_mes[$value],2,",", ".");

                         $htm.='
                         <th width="auto" style="border: 1px solid; border-spacing:0px" >'.$total_valor_por_mes_f.'</th> ';
 


                        } 

                          

                        $htm.='
                            </th> 
 
                    </tr>
                  

                   </tfoot>
                    
                </table>
        
                  

           ';



           $htm.='
           

            <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="95%" align=center>
                 <thead>
                 <tr> ';



                            $diferentesdias= mysqli_query($conexao,"select DISTINCT(DAY(datadaentrada)) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) and DAY(datadaentrada)>15");

                            $dias_diferentes=[];

                        while($exibir_dia = $diferentesdias->fetch_array()){

                             $dias_diferentes[]=$exibir_dia[0];

                           $htm.=' "<th width="auto" style="border: 1px solid; border-spacing:0px"> Dia '.$exibir_dia[0].' </th>';
                     }  
                        

                       $htm.='
                     <th width="auto" style="border: 1px solid; border-spacing:0px">Sub-Total </th> 

                   </tr>


                 </thead> 
                 <tbody>

                 ';

                

                  

                      $tipodeentradas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas where  YEAR(datadaentrada)='$anodevenda' AND '$mesdevenda'=MONTH(datadaentrada)  ");

                      $total_valor_por_mes[]=0;
                   


                  while($exibir = $tipodeentradas->fetch_array()){



                   $tipodeentrada=$exibir['tipo'];

                 
                     





                    $htm.='

                  <tr>
                      
                     ';


                       foreach ($dias_diferentes as $key => $value) {
                 
                        $valor_do_tipo[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where  tipo='$tipodeentrada' and YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value' "))[0]+0;

                        
                         $valor_do_tipo_f=number_format($valor_do_tipo[$value],2,",", ".");

                        $htm.='
                        
                        <td width="auto" style="border: 1px solid; border-spacing:0px">'.$valor_do_tipo_f.'</td> 

                          ';


                        } 

                        $total_valor_categoria=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where  tipo='$tipodeentrada' and YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' "))[0]+0;

                        
                        $total_valor_categoria_f=number_format($total_valor_categoria,2,",", ".");

                        $htm.='

                         <td width="auto" style="border: 1px solid; border-spacing:0px"> Total em '.$tipodeentrada.' - '.$total_valor_categoria_f.' </td> 

                   </tr>'; } 

                   $htm.='

                  </tbody> 

                  <tfoot>
                     <tr> ';




                      
                             foreach ($dias_diferentes as $key => $value) {
                
                       
                         $total_valor_por_mes[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value'   "))[0]+0;

                        
                           $total_valor_por_mes_f=number_format($total_valor_por_mes[$value],2,",", ".");

                        $htm.='
                        <th width="auto" style="border: 1px solid; border-spacing:0px" >'.$total_valor_por_mes_f.'</th> ';



                       } 
                       $total_valor_mes=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where   YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' "))[0]+0;

                           $total_valor_mes_f=number_format($total_valor_mes,2,",", ".");


                       $htm.='

                         <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_valor_mes_f.'</th> 

                   </tr>
                 

                  </tfoot>
                   
               </table>
       
                 

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
           
              $registrosdeentrada=mysqli_query($conexao, "select distinct(tipo) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)  order by tipo asc"); 
            
            
 
            while($exibir = $registrosdeentrada->fetch_array()){
                $tipo = $exibir["tipo"];
                $dados = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) as valor, sum(divida) as divida from entradas where tipo='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)   order by datadaentrada asc")); 
              
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

    
<br><br>";
            
 
  $htm.="
 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>
        </div>
        ";


        $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "relatoriodeentradamensal | ".$mesdevenda."  -  ".$anodevenda."  CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 