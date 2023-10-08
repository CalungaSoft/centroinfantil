 
    <?php 
 include("../conexao.php");
 
  
 session_start();
 $nomelogado=$_SESSION['nomedofuncionariologado'];

 
 $idsalario=isset($_GET['idsalario'])?$_GET['idsalario']:""; 
 $idsalario=mysqli_escape_string($conexao, $idsalario);
 $dadosdosalario=mysqli_fetch_array(mysqli_query($conexao,"select salario.*, funcionarios.* from salario, funcionarios where funcionarios.idfuncionario=salario.idfuncionario and idsalario='$idsalario'")); 

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);
 
   $hoje=date('d-m-Y');
    $hora=date('H')-5;
   if($hora<10){
     $hora="0$hora";
   }
   $minutos=date('i');

   $dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa")); 

   $mes=$dadosdosalario["mes"];
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
   
use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

        $gerador=new DOMPDF(); 
        $htm='  
        <style> 
        
        
.table {
    width: 100%; 
    color: black;
  }
  
  .table th,
  .table td {
    padding: 0rem;  
  }
  
  .table thead th{  
    border=0;
    background-color: rgb(151,212, 244);
  }
  
  .table tfoot td {  
    border=0;
    background-color: rgb(151,212, 244);
  }

.table-sm th,
.table-sm td {
  padding: 0.1rem;
}
.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
  border: 0;
}

  .table tbody + tbody {
    border=0;
    vertical-align: none; 
  }
   
  
  
  
  .table-striped tbody tr:nth-of-type(odd) {
    border-left=background-color: rgba(0, 0, 0, 0.16);
    background-color: rgba(0, 0, 0, 0.09);
  }
  
  .table-striped tbody tr:nth-of-type(even) {
    border-left=background-color: rgba(0, 0, 0, 0.04);
    background-color: rgba(0, 0, 0, 0.02);
  }
  
  @media (max-width: 575.98px) {
    .table-responsive-sm {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .table-responsive-sm > .table-bordered {
      border: 0;
    }
  }
  
  @media (max-width: 767.98px) {
    .table-responsive-md {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .table-responsive-md > .table-bordered {
      border: 0;
    }
  }
  
  @media (max-width: 991.98px) {
    .table-responsive-lg {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .table-responsive-lg > .table-bordered {
      border: 0;
    }
  }
  
  @media (max-width: 1199.98px) {
    .table-responsive-xl {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .table-responsive-xl > .table-bordered {
      border: 0;
    }
  }
  
  .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
   
  
        
  hr {
    box-sizing: content-box;
    height: 0;
    overflow: visible;
    opacity:0.5;
  }
        
        
        
        
        
        
        #centro{text-align: center;} figure {margin-top:-9px; margin-left:-0px; float: left; position:relative} body {font-size: 13px; color:#000; font-family:Arial; font-family:Arial; }
        
        </style> 
        
        <div style="position: absolute; border-width:3px; border-style:solid; border-color:#000; width:45%; height:680px; padding:10px; margin-top:-20px;">
             
              
        <figure>
        <img src="img/logopequena.png"> 
    </figure>

    <p style="font-size: 16px; margin-left:10px; loat:left"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
    <span style="font-size: 11px; font-family:calibri; text-transform: bold;"><i> '.$dadosdainstituicao["servicos"].' </i> </span></p> 
    <span style="font-size: 12px; margin-left:30px"> <strong>Recibo de Vencimento | Original</strong> </span> <br><br>
    <br><br>Nº de contribuinte: '.$dadosdainstituicao["numerodecontribuinte"].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$hoje.' <hr><hr>
<br>';
$salariobruto=$dadosdosalario["salariobruto"];
$htm.='
    <table style="font-size:9px; border:0px solid; border-spacing:0px; margin-top:-20px;" width="100%" align=center>

 <tbody>  
         <tr> 
             <td width="auto" ><strong>Período</strong></td>
             <td width="auto" >'.$mes.'</td>  
             <td width="auto" ><strong>Nome</strong></td>
             <td width="auto" >'.$dadosdosalario["nomedofuncionario"].'</td>     
         </tr>  
         <tr> 
            <td width="auto" ><strong>Data de Fecho</strong></td>
            <td width="auto" >'.$dadosdosalario["datadepagamento"].'</td> 
            <td width="auto" ><strong>Nº Funcionário</strong></td>
            <td width="auto" >'.$dadosdosalario["idfuncionario"].'</td>      
        </tr> 
        <tr> 
             <td width="auto" ><strong>Vencimento</strong></td>
             <td width="auto" >'.$salariobruto.'</td>  
             <td width="auto" ><strong>Cargo</strong></td>
             <td width="auto" >'.$dadosdosalario["cargo"].'</td>     
        </tr>    
        <tr> 
            <td width="auto" ><strong>Venc. /dia</strong></td>
            <td width="auto" >'.$dadosdosalario["salario"].'</td>  
            <td width="auto" ><strong>Conta Bancaria</strong></td>
            <td width="auto" >'.$dadosdosalario["contabancaria"].'</td>     
       </tr> 
       <tr> 
            <td width="auto" ><strong>Dias c/ rem. </strong></td>
            <td width="auto" >'.$dadosdosalario["diascomremuneracao"].'</td>  
            <td width="auto" ><strong>Telefone</strong></td>
            <td width="auto" >'.$dadosdosalario["telefone"].'</td>     
      </tr> 
      <tr> 
            <td width="auto" ><strong>Dias s/ rem.</strong></td>
            <td width="auto" >'.$dadosdosalario["diassemremuneracao"].'</td>  
            <td width="auto" ><strong>F. de Pagamento</strong></td>
            <td width="auto" >'.$dadosdosalario["formapagamento"].'</td>     
      </tr> 
    </tbody>
</table>  
   <br> <hr> 
<table class="table table-striped table-sm table-borderless" style="border:0" align=center>
 <thead>
      <tr>  
        <th>Cod.</th>  
        <th>Descrição</th>   
        <th>Remuneração</th> 
        <th>Desconto</th>  
      </tr>  
</thead> 
<body> ';
$vecimento=$dadosdosalario["valorporreceber"];
$salario=$dadosdosalario['salariobruto']+$dadosdosalario['bonus']-$dadosdosalario['descontos'];
$irt=($salario*($dadosdosalario['irt']/100)); 
  
$totalsemirt=$salario;
$totalcomirt=$totalsemirt-$irt;
$valorrecebido=$dadosdosalario["valorrecebido"];
$valorfaltando=$totalcomirt-$valorrecebido;

$bonus=number_format($dadosdosalario['bonus'],2,",", ".");
$descontos=number_format($dadosdosalario['descontos'],2,",", ".");
$totaldecontos=number_format($dadosdosalario['descontos']+$irt,2,",", ".");
$totalsemdescontos=number_format($dadosdosalario['bonus']+$dadosdosalario["salariobruto"],2,",", ".");
$vecimento=number_format($vecimento,2,",", ".");
$totalsemirt=number_format($totalsemirt,2,",", "."); 
$totalcomirt=number_format($totalcomirt,2,",", ".");
$valorrecebido=number_format($valorrecebido,2,",", ".");
$valorfaltando=number_format($valorfaltando,2,",", ".");
$salariobruto=number_format($salariobruto,2,",", ".");

$irt=number_format($irt,2,",", ".");
$htm.='
      <tr>  
        <td>R01</td>  
        <td>Vecimento</td>   
        <td>'.$salariobruto.'</td> 
        <td>0,00</td>  
      </tr> 
      <tr>  
        <td>D02</td>  
        <td>IRT('.$dadosdosalario["irt"].'%)</td>   
        <td>0,00</td> 
        <td>'.$irt.'</td>  
      </tr> 
      <tr>  
        <td></td>  
        <td>Bonus</td>   
        <td>'.$bonus.'</td> 
        <td></td>  
      </tr> 
      <tr>  
        <td></td>  
        <td>Descontos</td>   
        <td>0,00</td> 
        <td>'.$descontos.'</td>  
      </tr> 
</body>
<tfoot>
        <th>Total</th> 
        <th></th> 
        <td>'.$totalsemdescontos.'</td> 
        <td>'.$totaldecontos.'</td> 
</tfoot>
</table> 




<div style="position: absolute; bottom: 0; margin-bottom: 15px;">
<table class="table table-striped table-sm table-borderless" align=center style="margin-bottom:-90px"> 
       <thead>
            <tr> 
                <th> A receber| '.$totalcomirt.'</th>
                <th>Recebido | '.$valorrecebido.' </th> 
                <th>Em Falta | '.$valorfaltando.'</th>        
            </tr>  
       </thead>
</table> <br><br>
OBS: '.$dadosdosalario["obs"].' <br><br>  

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Confirmo que recebi a quantia constante nesse recibo <br> 
&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________________ 
<span  style="font-size: 40px;"><strong>______________</strong></span><span style="font-size: 40px;color:rgb(151,212, 244);"><strong>_________</strong></span>
<br> <span  style="font-size: 9px;"> N.B:  VALORES EM KWANZA COMO REFERÊNCIA</span><br>
Operador(a): '.$nomelogado.'
<br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span align="center" style="font-size: 10px;  ">'.$dadosdainstituicao["localizacao"].'<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: '.$dadosdainstituicao["email"].' | tel: '.$dadosdainstituicao["telefone"].'
    </span>
</div>
</div>
<br 
        </div>

        <div style="position: absolute; border-width:3px; border-style:solid; border-color:#000; width:45%; height:680px; padding:10px; margin-left:530px;">
             
                  
              
        <figure>
        <img src="img/logopequena.png"> 
    </figure>

    <p style="font-size: 16px; margin-left:10px; loat:left"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
    <span style="font-size: 11px; font-family:calibri; text-transform: bold;"><i> '.$dadosdainstituicao["servicos"].' </i> </span></p> 
    <span style="font-size: 12px; margin-left:30px"> <strong>Recibo de Vencimento | Duplicado</strong> </span> <br><br>
    <br><br>Nº de contribuinte: '.$dadosdainstituicao["numerodecontribuinte"].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$hoje.' <hr><hr>
<br>';
$salariobruto=$dadosdosalario["salariobruto"];
$htm.='
    <table style="font-size:9px; border:0px solid; border-spacing:0px; margin-top:-20px;" width="100%" align=center>

 <tbody>  
         <tr> 
             <td width="auto" ><strong>Período</strong></td>
             <td width="auto" >'.$mes.'</td>  
             <td width="auto" ><strong>Nome</strong></td>
             <td width="auto" >'.$dadosdosalario["nomedofuncionario"].'</td>     
         </tr>  
         <tr> 
            <td width="auto" ><strong>Data de Fecho</strong></td>
            <td width="auto" >'.$dadosdosalario["datadepagamento"].'</td> 
            <td width="auto" ><strong>Nº Funcionário</strong></td>
            <td width="auto" >'.$dadosdosalario["idfuncionario"].'</td>      
        </tr> 
        <tr> 
             <td width="auto" ><strong>Vencimento</strong></td>
             <td width="auto" >'.$salariobruto.'</td>  
             <td width="auto" ><strong>Cargo</strong></td>
             <td width="auto" >'.$dadosdosalario["cargo"].'</td>     
        </tr>    
        <tr> 
            <td width="auto" ><strong>Venc. /dia</strong></td>
            <td width="auto" >'.$dadosdosalario["salario"].'</td>  
            <td width="auto" ><strong>Conta Bancaria</strong></td>
            <td width="auto" >'.$dadosdosalario["contabancaria"].'</td>     
       </tr> 
       <tr> 
            <td width="auto" ><strong>Dias c/ rem. </strong></td>
            <td width="auto" >'.$dadosdosalario["diascomremuneracao"].'</td>  
            <td width="auto" ><strong>Telefone</strong></td>
            <td width="auto" >'.$dadosdosalario["telefone"].'</td>     
      </tr> 
      <tr> 
            <td width="auto" ><strong>Dias s/ rem.</strong></td>
            <td width="auto" >'.$dadosdosalario["diassemremuneracao"].'</td>  
            <td width="auto" ><strong>F. de Pagamento</strong></td>
            <td width="auto" >'.$dadosdosalario["formapagamento"].'</td>     
      </tr> 
    </tbody>
</table>  
   <br> <hr> 
   <table class="table table-striped table-sm table-borderless" style="border:0" align=center>
   <thead>
        <tr>  
          <th>Cod.</th>  
          <th>Descrição</th>   
          <th>Remuneração</th> 
          <th>Desconto</th>  
        </tr>  
  </thead> 
  <body> ';
  $vecimento=$dadosdosalario["valorporreceber"];
  $salario=$dadosdosalario['salariobruto']+$dadosdosalario['bonus']-$dadosdosalario['descontos'];
  $irt=($salario*($dadosdosalario['irt']/100)); 
    
  $totalsemirt=$salario;
  $totalcomirt=$totalsemirt-$irt;
  $valorrecebido=$dadosdosalario["valorrecebido"];
  $valorfaltando=$totalcomirt-$valorrecebido;
  
  $bonus=number_format($dadosdosalario['bonus'],2,",", ".");
  $descontos=number_format($dadosdosalario['descontos'],2,",", ".");
  $totaldecontos=number_format($dadosdosalario['descontos']+$irt,2,",", ".");
  $totalsemdescontos=number_format($dadosdosalario['bonus']+$dadosdosalario["salariobruto"],2,",", ".");
  $vecimento=number_format($vecimento,2,",", ".");
  $totalsemirt=number_format($totalsemirt,2,",", "."); 
  $totalcomirt=number_format($totalcomirt,2,",", ".");
  $valorrecebido=number_format($valorrecebido,2,",", ".");
  $valorfaltando=number_format($valorfaltando,2,",", ".");
  $salariobruto=number_format($salariobruto,2,",", ".");
  
  $irt=number_format($irt,2,",", ".");
  $htm.='
        <tr>  
          <td>R01</td>  
          <td>Vecimento</td>   
          <td>'.$salariobruto.'</td> 
          <td>0,00</td>  
        </tr> 
        <tr>  
          <td>D02</td>  
          <td>IRT('.$dadosdosalario["irt"].'%)</td>   
          <td>0,00</td> 
          <td>'.$irt.'</td>  
        </tr> 
        <tr>  
          <td></td>  
          <td>Bonus</td>   
          <td>'.$bonus.'</td> 
          <td></td>  
        </tr> 
        <tr>  
          <td></td>  
          <td>Descontos</td>   
          <td>0,00</td> 
          <td>'.$descontos.'</td>  
        </tr> 
  </body>
  <tfoot>
          <th>Total</th> 
          <th></th> 
          <td>'.$totalsemdescontos.'</td> 
          <td>'.$totaldecontos.'</td> 
  </tfoot>
  </table> 
<div style="position: absolute; bottom: 0; margin-bottom: 15px;">
<table class="table table-striped table-sm table-borderless" align=center style="margin-bottom:-90px"> 
       <thead>
            <tr> 
                <th> A receber| '.$totalcomirt.'</th>
                <th>Recebido | '.$valorrecebido.' </th> 
                <th>Em Falta | '.$valorfaltando.'</th>        
            </tr>  
       </thead>
</table> <br><br>
OBS: '.$dadosdosalario["obs"].' <br><br>  

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Confirmo que recebi a quantia constante nesse recibo <br> 
&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________________ 
 <span  style="font-size: 40px;"><strong>______________</strong></span><span style="font-size: 40px;color:rgb(151,212, 244);"><strong>_________</strong></span>
<br> <span  style="font-size: 9px;"> N.B:  VALORES EM KWANZA COMO REFERÊNCIA</span><br>
Operador(a): '.$nomelogado.'
<br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span align="center" style="font-size: 10px;  ">'.$dadosdainstituicao["localizacao"].'<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: '.$dadosdainstituicao["email"].' | tel: '.$dadosdainstituicao["telefone"].'
    </span>
</div>
</div>
<br 

        </div>
        ';


        $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "relatorio.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 