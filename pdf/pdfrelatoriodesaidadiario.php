 
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

        $gerador=new DOMPDF(); 
        $htm=' 
        <style>  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/logo.png"> 
                </figure>
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 18px; font-family: forte">'.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |Relatório Diário de Saída: '.$diadevenda.' / '.$mesdevenda.' / '.$anodevenda.'</span>
            <br> <br> <br> ';

            $htm.="
            |Saídas <br>

    <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='95%' align=center>
    <thead>
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
       
          $registrosdesaida=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario and '$diadevenda'=DAY(datadasaida) and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) order by datadasaida asc"); 
        
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
        <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="30%">
        <thead>
        <thead>
        <tr>
          <th  width="auto" style="border: 1px solid; border-spacing:0px">Tipo</th>  
          <th width="auto" style="border: 1px solid; border-spacing:0px">Valor Pago</th>
          <th width="auto" style="border: 1px solid; border-spacing:0px">Por Consolidar</th> 
        </tr>  
      </thead> 
      <tbody> 
           ';  
           
              $registrosdeentrada=mysqli_query($conexao, "select distinct(tipo) from saidas where '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) AND '$diadevenda'=DAY(datadasaida) order by datadasaida asc"); 
            
            
 
            while($exibir = $registrosdeentrada->fetch_array()){
                $tipo = $exibir["tipo"];
                $dados = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) as valor, sum(divida) as divida from saidas where tipo='$tipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) AND '$diadevenda'=DAY(datadasaida) order by datadasaida asc")); 
              
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
            "relatoriodesaidadiarioCalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 