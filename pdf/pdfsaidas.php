 
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);


$hoje=date('d');
$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);

$gasto=isset($_GET['tipo'])?$_GET['tipo']:"";
$gasto=mysqli_escape_string($conexao, $gasto);

if(isset($_GET['tipo'])){
  $nomegasto=mysqli_fetch_array(mysqli_query($conexao, "select tipo from tipodesaidas where idtipodesaida='$gasto'"))[0]; 
}else{
  $nomegasto="";
}
 
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
        <style>  #centro{text-align: center;} figure {margin-top:-45px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/logotipo.png"> 
                </figure>
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 22px; font-family: forte"> '.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |Relatório de Saídas: '.$mesdevenda.' / '.$anodevenda.' | '.$nomegasto.'</span>
            <br> <br> <br> 
        <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="90%" align=center>
                  <thead>
                  <thead>
                  <tr>
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Funcionário</th> 
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Descrição</th> 
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Tipo</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Valor</th>  
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Por Consolidar</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Data</th> 
                  </tr>    
                </thead> 
                <tbody> 
                     '; 
                     if(!isset($_GET['mesdevenda']) && !isset($_GET['tipo'])){
                        $registrosdesaida=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario order by datadasaida asc limit 500"); 
                      }else if(isset($_GET['mesdevenda']) && !isset($_GET['tipo'])){
                        $registrosdesaida=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario and '$anodevenda'=YEAR(datadasaida) AND ('$mesdevenda'=(MONTH(datadasaida)) )"); 
                      } else if(isset($_GET['mesdevenda']) && isset($_GET['tipo'])){
                        $registrosdesaida=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario and '$anodevenda'=YEAR(datadasaida) AND ('$mesdevenda'=(MONTH(datadasaida)) ) and idtipo='$gasto'"); 
                      } else if(!isset($_GET['mesdevenda']) && isset($_GET['tipo'])){
                        $registrosdesaida=mysqli_query($conexao, "select funcionarios.nomedofuncionario,  saidas.* from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario and idtipo='$gasto'"); 
                      } 
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
            "relatoriodesaidaCalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 