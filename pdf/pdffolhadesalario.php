 
    <?php
    include("../conexao.php");
    
    session_start();
    
    $idlogado = $_SESSION['funcionariologado'];
    $nomelogado = $_SESSION['nomedofuncionariologado'];
    $painellogado = $_SESSION['painel'];
     

    $mesdesalario = isset($_GET['mesdesalario']) ? $_GET['mesdesalario'] : "";
    $mesdesalario = mysqli_escape_string($conexao, $mesdesalario);
    $anodesalario = isset($_GET['anodesalario']) ? $_GET['anodesalario'] : "";
    $anodesalario = mysqli_escape_string($conexao, $anodesalario);


    if (!isset($_SESSION['logado'])) :
        header('Location: login.php');
    endif;

    if(!($painellogado=="secretaria2"  || $painellogado=="administrador")){
        header('Location: login.php');
      }


    $idcaixa = isset($_SESSION['idcaixa']);

    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');
    if ($mes == 1)
        $mes = "Janeiro";
    else if ($mes == 2)
        $mes = "Fevereiro";
    else if ($mes == 3)
        $mes = "Março";
    else if ($mes == 4)
        $mes = "Abril";
    else if ($mes == 5)
        $mes = "Maio";
    else if ($mes == 6)
        $mes = "Junho";
    else if ($mes == 7)
        $mes = "Julho";
    else if ($mes == 8)
        $mes = "Agosto";
    else if ($mes == 9)
        $mes = "Setembro";
    else if ($mes == 10)
        $mes = "Outubro";
    else if ($mes == 11)
        $mes = "Novembro";
    else if ($mes == 12)
        $mes = "Dezembro";


    $dadosdainstituicao = mysqli_fetch_array(mysqli_query($conexao, "select * from dadosdaempresa"));




    use Dompdf\Dompdf;

    require_once 'dompdf/autoload.inc.php';

    $gerador = new DOMPDF();
    $htm = '  
        <style>  #centro{text-align: center;} figure {margin-top:-45px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div> 
                    <center>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> ' . $dadosdainstituicao["nome"] . ' </span> <br> 
                <span style="font-size: 11px; font-family: forte"> ' . $dadosdainstituicao["servicos"] . '  </span></p> </center>
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |FOLHA DE SALÁRIO : ';
    if (isset($_GET['mesdesalario'])) {
        $htm .= ' ' . $mesdesalario . ' / ' . $anodesalario . '';
    } else {
        $htm .= "Todos os registros";
    }
    $htm .= '</span>
            <br> <br> <br> ';


    $htm .= "
    <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='95%' align=center>";

    $htm .= '
                <thead>
                    <tr>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Nº</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Nome Completo</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Cargo</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Conta Bancária</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Salario Base</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Salário atual do funcionário">Salário/H</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Faltas</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Valor das faltas">V. Faltas</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Salário do Mês</th>
             
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="total de horas extras durante o mês">Horas Extras</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="total em salário de horas extras durante o mês">Total Extras</th>
            
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Subsídeo de Alimentação">S. Alimentação</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Subsídeo de Transporte">S. Transporte</th>
            
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Salário Ilíquido</th>
            
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Material Colectavel para Segurança Social">M. C. Para Seg. Social</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Material Colectavel para IRT">M. C. Para IRT</th>
            
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>S. Social(3%)</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>IRT</th>
            
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Total de Desconto</th>
            
                        <th width="auto" style="border: 1px solid; border-spacing:0px" align=center title="Salário líquido">Salário líquido</th>
                    </tr>
                </thead>';

    $htm .= '
    <tbody>';

    $folhadesalario = mysqli_query($conexao, "select * from funcionarios where funcionarios.estatus='activo' order by salario desc");


    $cont = 1;

    $totalsalariobase = 0;
    $totalsalarioporhora = 0;
    $totalvalorpelasfaltas = 0;

    $totalsalariodomes = 0;
    $totalsubsidiodeferias = 0;
    $totalsubsidiodenatal = 0;

    $totalabonodefamilia = 0;
    $totalsalariopelahorasextras = 0;

    $totalsubsideodealimentacao = 0;
    $totalsubsideodetransporte = 0;

    $totalsalarioiliquido = 0;

    $totalsegurancasocial = 0;
    $totalirt = 0;

    $totaldesconto = 0;

    $totalsalarioliquido = 0;




    while ($exibir = $folhadesalario->fetch_array()) {
        $idfuncionario = $exibir['idfuncionario'];
        $numerodefaltas = mysqli_num_rows(mysqli_query($conexao, "select idfuncionario from presenca where (falta!='P' or falta!='p') and idfuncionario='$idfuncionario' and mes='$mesdesalario' and ano='$anodesalario'"));
        $numerodefaltasNaoRemuneradas = mysqli_num_rows(mysqli_query($conexao, "select idfuncionario from presenca where (falta!='P' or falta!='p') and remunerar='0' and idfuncionario='$idfuncionario' and mes='$mesdesalario' and ano='$anodesalario'"));
        $valorFaltas = $numerodefaltasNaoRemuneradas * $exibir['salario'] / 30;
        $horasextras = mysqli_fetch_array(mysqli_query($conexao, "select sum(horasextras) from presenca where idfuncionario='$idfuncionario' and mes='$mesdesalario' and ano='$anodesalario'"))[0];
        $salariopelahorasextras = mysqli_fetch_array(mysqli_query($conexao, "select sum(salariopelahorasextras) from presenca where idfuncionario='$idfuncionario' and mes='$mesdesalario' and ano='$anodesalario'"))[0];
        $salarioDoMes = $exibir['salario'] - $valorFaltas;

        if ($mesdesalario == 12) {
            
            $subsidiodeferias = 0;
            $subsidiodenatal = 0;

            // $subsidiodeferias = $exibir['salario'] * 0.5;
            // $subsidiodenatal = $exibir['salario'] * 0.5;

        } else {
            $subsidiodeferias = 0;
            $subsidiodenatal = 0;
        }

        $salrioIliquido = $salarioDoMes + $subsidiodeferias + $subsidiodenatal + $salariopelahorasextras;
        $mcsegurancasocial = $salrioIliquido + $subsidiodenatal;
        $segurancasocial = $mcsegurancasocial * 0.03;
        $subsideodealimentacao = $exibir['subsideodealimentacao'];
        $subsideodetransporte = $exibir['subsideodetransporte'];

        if ($salrioIliquido > 69999) {
            $mcirt = $salrioIliquido + ($subsideodetransporte > 30000 ? $subsideodetransporte - 30000 : 0) + ($subsideodealimentacao > 30000 ? $subsideodealimentacao - 30000 : 0) - $segurancasocial;
        } else {
            $mcirt = 0;
        }

        if ($mcirt < 70000) {
            $irt = 0;
        } elseif ($mcirt >= 70000 and $mcirt <= 100000) {
            $irt = ($mcirt - 70000) * 0.1 + 3000;
        } elseif ($mcirt >= 100001 and $mcirt <= 150000) {
            $irt = ($mcirt - 100000) * 0.13 + 6000;
        } elseif ($mcirt >= 150001 and $mcirt <= 200000) {
            $irt = ($mcirt - 150000) * 0.16 + 12500;
        } elseif ($mcirt >= 200001 and $mcirt <= 300000) {
            $irt = ($mcirt - 200000) * 0.18 + 31250;
        } elseif ($mcirt >= 300001 and $mcirt <= 500000) {
            $irt = ($mcirt - 300000) * 0.19 + 49250;
        } elseif ($mcirt >= 500001 and $mcirt <= 1000000) {
            $irt = ($mcirt - 500000) * 0.20 + 87250;
        } elseif ($mcirt >= 1000001 and $mcirt <= 1500000) {
            $irt = ($mcirt - 1000000) * 0.21 + 187250;
        } elseif ($mcirt >= 1500001 and $mcirt <= 2000000) {
            $irt = ($mcirt - 1500000) * 0.22 + 292000;
        } elseif ($mcirt >= 2000001 and $mcirt <= 2500000) {
            $irt = ($mcirt - 2000000) * 0.23 + 402250;
        } elseif ($mcirt >= 2500001 and $mcirt <= 5000000) {
            $irt = ($mcirt - 2500000) * 0.24 + 517250;
        } elseif ($mcirt >= 5000001 and $mcirt <= 10000000) {
            $irt = ($mcirt - 5000000) * 0.245 + 1117250;
        } elseif ($mcirt >= 10000001) {
            $irt = ($mcirt - 10000000) * 0.25 + 2342250;
        }

        $descontos = $segurancasocial + $irt;
        $salarioliquido = $salrioIliquido - $descontos;

        $nomecompletoresumido = $exibir['nomedofuncionario'];

        $partesNome = explode(' ', $nomecompletoresumido);

        $primeiroNome = $partesNome[0];
        $ultimoNome = end($partesNome);

        $primeiroEUltimoNome = $primeiroNome . ' ' . $ultimoNome;


          //somatorioTotal
          $totalsalariobase += $exibir['salario'];
          $totalsalarioporhora += $exibir['salarioporhora'];
          $totalvalorpelasfaltas += $valorFaltas;

          $totalsalariodomes += $salarioDoMes;
          $totalsubsidiodeferias += $subsidiodeferias;
          $totalsubsidiodenatal += $subsidiodenatal;

          $totalsalariopelahorasextras += $salariopelahorasextras;

          $totalsubsideodealimentacao += $subsideodealimentacao;

          $totalsubsideodetransporte += $subsideodetransporte;

          $totalsalarioiliquido += $salrioIliquido;

          $totalsegurancasocial += $segurancasocial;
          $totalirt += $irt;

          $totaldesconto += $descontos;

          $totalsalarioliquido += $salarioliquido;



        $htm .= '
        <tr>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $cont . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $primeiroEUltimoNome . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $exibir['categoria'] . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $exibir['contabancaria'] . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($exibir['salario'], 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $exibir['salarioporhora'] . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $numerodefaltas . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($valorFaltas, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($salarioDoMes, 2, ",", ".") . '</td> 
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $horasextras . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($salariopelahorasextras, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($exibir['subsideodealimentacao'], 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($exibir['subsideodetransporte'], 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($salrioIliquido, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($mcsegurancasocial, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($mcirt, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($segurancasocial, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($irt, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($descontos, 2, ",", ".") . '</td>
            <td width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . number_format($salarioliquido, 2, ",", ".") . '</td>
        </tr>';
        $cont++;
    }

    $htm .= '
    </tbody>';
     //formatar totais 
     $totalsalariobase = number_format($totalsalariobase, 2, ",", ".");
     $totalsalarioporhora = number_format($totalsalarioporhora, 2, ",", ".");
     $totalvalorpelasfaltas = number_format($totalvalorpelasfaltas, 2, ",", ".");
     $totalsalariodomes = number_format($totalsalariodomes, 2, ",", ".");
     $totalsubsidiodeferias = number_format($totalsubsidiodeferias, 2, ",", ".");
     $totalsubsidiodenatal = number_format($totalsubsidiodenatal, 2, ",", ".");
     $totalabonodefamilia = number_format($totalabonodefamilia, 2, ",", ".");
     $totalsalariopelahorasextras = number_format($totalsalariopelahorasextras, 2, ",", ".");
     $totalsubsideodealimentacao = number_format($totalsubsideodealimentacao, 2, ",", ".");
     $totalsubsideodetransporte = number_format($totalsubsideodetransporte, 2, ",", ".");
     $totalsalarioiliquido = number_format($totalsalarioiliquido, 2, ",", ".");
     $totalsegurancasocial = number_format($totalsegurancasocial, 2, ",", ".");
     $totalirt = number_format($totalirt, 2, ",", ".");
     $totaldesconto = number_format($totaldesconto, 2, ",", ".");
     $totalsalarioliquido = number_format($totalsalarioliquido, 2, ",", ".");



     $htm .= '<tfoot>
     <tr>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>Total</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsalariobase . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsalarioporhora . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalvalorpelasfaltas . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsalariodomes . '</th> 
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsalariopelahorasextras . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsubsideodealimentacao . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsubsideodetransporte . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsalarioiliquido . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center></th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsegurancasocial . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalirt . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totaldesconto . '</th>
         <th width="auto" style="border: 1px solid; border-spacing:0px" align=center>' . $totalsalarioliquido . '</th>
     </tr>
 </tfoot>
 </table>';
 


    $htm .= "
        <br><br>
            
        <br>
        <p id=centro>
                " . $dadosdainstituicao['nome'] . " aos  " . $dia . "  de   " . $mes . "  de  " . $ano . " .</b>
        </p>
        </div>
        ";


    $gerador->load_html($htm);
    $gerador->setPaper('A3', 'landscape');
    $gerador->render();

    $gerador->stream(
        "folhadesalario $mesdesalario de $anodesalario .pdf",
        array(
            "attachment" => true
        )
    );
    ?>
 