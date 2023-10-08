<?php
include("conexao.php");


session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];


$mesdesalario = isset($_GET['mesdesalario']) ? $_GET['mesdesalario'] : "";
$anodesalario = isset($_GET['anodesalario']) ? $_GET['anodesalario'] : "";

$cardeeditar = "";

if (isset($_GET['idnosalario'])) {
  $idnosalario = $_GET['idnosalario'];
  $idnasaida = $_GET['idnasaida'];
  $cardeeditar = "aberto";
}


if (isset($_POST['eliminarregistro'])) {
  $idnasaida = $_POST['idnasaida'];
  $idnosalario = $_POST['idnosalario'];

  $editando = mysqli_query($conexao, "DELETE FROM `salario` WHERE `salario`.`idsalario` = '$idnosalario'");
  $editando = mysqli_query($conexao, "DELETE FROM `saida` WHERE `saida`.`idsaida` = '$idnasaida'");

  if ($editando) {
    header("location:folhadesalario.php");
  }
}


if (isset($_POST['cancelareliminacao'])) {
  header("location:folhadesalario.php");
}

if (isset($_POST['pagarsalario'])) {

  $funcionarioescolhido = $_POST['funcionarioescolhido'];
  $nomedofuncionario = $_POST['nomedofuncionario'];
  $idposto = $_POST['idposto'];
  $anoescolhido = $_POST['anoescolhido'];
  $mesescolhido = $_POST['mesescolhido'];
  $diaremunerados = $_POST['diaremunerados'];
  $dianaoremunerados = $_POST['dianaoremunerados'];
  $horastrabalhadas = $_POST['horastrabalhadas'];
  $salarioactual = $_POST['salarioactual'];
  $salarioactualporhora = $_POST['salarioactualporhora'];
  $faltas = $_POST['faltas'];
  $horasextras = $_POST['horasextras'];
  $salarioextra = $_POST['salarioextra'];
  $irt = $_POST['irt'];

  $abonodefamilia = $_POST['abonodefamilia'];
  $segurancasocial = $_POST['segurancasocial'];
  $subsidiodeferias = $_POST['subsidiodeferias'];
  $subsidiodenatal = $_POST['subsidiodenatal'];
  $outrosdescontos = $_POST['outrosdescontos'];

  $salariobruto = round($_POST['valorporreceber']);

  //Calculando o salario líquido
  $valorcomabono = $salariobruto + $abonodefamilia;
  $valorabonoirt = $valorcomabono - $valorcomabono * ($irt / 100);
  $valorabonoirtsgsocial = $valorabonoirt - $valorabonoirt * ($segurancasocial / 100);
  $salarioliquido = round($valorabonoirtsgsocial + $valorabonoirtsgsocial * ($subsidiodeferias / 100) + $valorabonoirtsgsocial * ($subsidiodenatal / 100) - $outrosdescontos);

  $valoraserpago = $_POST['valoraserpago'];
  $formadepagamento = $_POST['formadepagamento'];
  $obs = $_POST['obs'];


  $divida = $salarioliquido - $valoraserpago;
  $idnasaida = mysqli_fetch_array(mysqli_query($conexao, "select idsaida from saidas order by idsaida desc limit 1"))[0] + 1;
  $idnosalario = mysqli_fetch_array(mysqli_query($conexao, "select idsalario from salario order by idsalario desc limit 1"))[0] + 1;

  $idanolectivo = $_POST['idanolectivo'];
  $descricao = "Pagamento do Salário do mês de $mesescolhido/$anoescolhido do funcionario:  $nomedofuncionario ";
  $guardar = mysqli_query($conexao, "INSERT INTO `saidas` (`idsaida`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `datadasaida`, `idtipo`, idanolectivo, formadesaida) VALUES (NULL, '$idlogado', '$descricao', 'salario', '$valoraserpago', '$divida', CURRENT_TIMESTAMP, '1', '$idanolectivo', '$formadepagamento')");

  $mes = Date('m');
  $ano = Date('Y');

  if (mysqli_num_rows(mysqli_query($conexao, "SELECT identrada FROM `entradas` where YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes'")) == 0) {

    $salvar = mysqli_query($conexao, "INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', 'Controlo', 'Outras', '0', '0', 0, CURRENT_TIMESTAMP, '', '$idanolectivo')");
  }



  if ($guardar) {

    $guardar1 = mysqli_query($conexao, "INSERT INTO `salario` (`idsalario`, `idfuncionario`, `ano`, `mes`, `faltas`, `horastrabalhadas`, `salarioactualporhora`, `salarioactualbase`, `salariobruto`, `horasextras`, `valorextra`, `abonodefamilia`, `subsidiodeferias`, `subsidiodenatal`, `segurancasocial`, `valorporreceber`, `irt`, `valorrecebido`, `formapagamento`, `obs`, `datadepagamento`, `idnasaida`, outrosdescontos, idposto) VALUES ('$idnosalario', '$funcionarioescolhido', '$anoescolhido', '$mesescolhido', '$faltas', '$horastrabalhadas', '$salarioactualporhora', '$salarioactual','$salariobruto', '$horasextras', '$salarioextra', '$abonodefamilia', '$subsidiodeferias', '$subsidiodenatal', '$segurancasocial', '$salarioliquido', '$irt', '$valoraserpago', '$formadepagamento', '$obs', CURRENT_TIMESTAMP, '$idnasaida', '$outrosdescontos', '$idposto')");
    if ($guardar1) {
      header("location:folhadesalario.php?mesdesalario=$mesescolhido&anodesalario=$anoescolhido");
    } else {

      $erros[] = "Ocorreu um erro ao fazer o pagamento de salários";
    }
  } else {

    $erros[] = "Ocorreu um erro ao fazer o pagamento de salários";
  }
}

include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Folha de Salário <?php if (isset($_GET['mesdesalario'])) {
                                                        echo "| $mesdesalario/$anodesalario";
                                                      } ?></h1>
  <?php
  if (!empty($erros)) :
    foreach ($erros as $erros) :
      echo '<div class="alert alert-danger">' . $erros . '</div>';
    endforeach;
  endif;
  ?>

 
 
  <?php include("estilocarde.php"); ?>
  <button id="myBtn" class="btn btn-primary">Escolher o mês</button>
  <br><br>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" action="" method="get">
        <div class="form-group">
          <select name="anodesalario" class="form-control" title="Escolha aqui o ano">
            <option <?php $anoactual = date('Y');
                    if ($anoactual == 2020) { ?> selected="" <?php } ?> value=2020>2020</option>
            <option <?php if ($anoactual == 2021) { ?> selected="" <?php } ?> value=2021>2021</option>
            <option <?php if ($anoactual == 2022) { ?> selected="" <?php } ?> value=2022>2022</option>
            <option <?php if ($anoactual == 2023) { ?> selected="" <?php } ?> value=2023>2023</option>
            <option <?php if ($anoactual == 2024) { ?> selected="" <?php } ?> value=2024>2024</option>
            <option <?php if ($anoactual == 2025) { ?> selected="" <?php } ?> value=2025>2025</option>
            <option <?php if ($anoactual == 2026) { ?> selected="" <?php } ?> value=2026>2026</option>
            <option <?php if ($anoactual == 2027) { ?> selected="" <?php } ?> value=2027>2027</option>
          </select>
        </div>


        <div class="form-group">
          <select name="mesdesalario" class="form-control">
            <option <?php $mesactual = date('m');
                    if ($mesactual == 1) { ?> selected="" <?php } ?> value="01">Janeiro</option>
            <option <?php if ($mesactual == 2) { ?> selected="" <?php } ?> value="02">Fevereiro</option>
            <option <?php if ($mesactual == 3) { ?> selected="" <?php } ?> value="03">março</option>
            <option <?php if ($mesactual == 4) { ?> selected="" <?php } ?> value="04">Abril</option>
            <option <?php if ($mesactual == 5) { ?> selected="" <?php } ?> value="05">Maio</option>
            <option <?php if ($mesactual == 6) { ?> selected="" <?php } ?> value="06">Junho</option>
            <option <?php if ($mesactual == 7) { ?> selected="" <?php } ?> value="07">Julho</option>
            <option <?php if ($mesactual == 8) { ?> selected="" <?php } ?> value="08">Agosto</option>
            <option <?php if ($mesactual == 9) { ?> selected="" <?php } ?> value="09">Setembro</option>
            <option <?php if ($mesactual == 10) { ?> selected="" <?php } ?> value="10">Outubro</option>
            <option <?php if ($mesactual == 11) { ?> selected="" <?php } ?> value="11">Novembro</option>
            <option <?php if ($mesactual == 12) { ?> selected="" <?php } ?> value="12">Dezembro</option>
          </select>
          <br>
          <input type="submit" value="Visualizar Folha de Salário" class="btn btn-primary" style="float: rigth;">
        </div>

      </form>
    </div>
  </div>



  <script>
    var btn = document.getElementById("myBtn");
    var modal = document.getElementById("myModal");

    var span = document.getElementById("close");


    btn.addEventListener("click", () => {
      modal.style.display = "block";
    })
    span.addEventListener("click", () => {
      modal.style.display = "none";
    })
    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Folha de Salário</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <?php if (!isset($_GET['mesdesalario'])) { ?>
          <a href="pdf/pdffolhadesalario.php" class="d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-print fa-download"></i> Imprimir</a> <br> <br>
        <?php } else { ?>
          <a href="pdf/pdffolhadesalario.php?mesdesalario=<?php echo $mesdesalario; ?>&anodesalario=<?php echo $anodesalario; ?>" class="d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-print fa-download"></i> Imprimir</a> <br> <br>
        <?php } ?>
        <span id="mensagemdealerta"></span>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Nome Completo</th>
              <th>Cargo</th>
              <th>Salario Base</th>
              <th title="Salário actual do funcionáio">Salário/H</th>
              <th>Faltas</th>
              <th title="Valor das faltas">V. Faltas</th>
              <th>Salário do Mês</th>

              <th title="Subsídio de Férias">Subsídio F.</th>
              <th title="Subsídio de Natal">Subsídio N.</th>
              <th title="Abono de Família">Abono de F.</th>

              <th title="total de horas extras durante o mês">Horas Extras</th>
              <th title="total em salário de horas extras durante o mês">Total Extras</th>


              <th title="Subsídeo de Alimentação">S. Alimentação</th>
              <th title="Subsídeo de Transporte">S. Transporte</th>

              <th>Salário Ilíquido</th>

              <th title="Material Colectavel para Segurança Social">M. C. Para Seg. Social</th>
              <th title="Material Colectavel para IRT">M. C. Para IRT</th>

              <th>S. Social(3%)</th>
              <th>IRT</th>

              <th>Total de Desconto</th>

              <th title="Salário líquido">Salário líquido</th>


            </tr>
          </thead>
          <tbody>
            <?php

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

              $horasextras = mysqli_fetch_array(mysqli_query($conexao, "select sum(horasextras) from presenca where   idfuncionario='$idfuncionario' and mes='$mesdesalario' and ano='$anodesalario'"))[0];
              $salariopelahorasextras = mysqli_fetch_array(mysqli_query($conexao, "select sum(salariopelahorasextras) from presenca where   idfuncionario='$idfuncionario' and mes='$mesdesalario' and ano='$anodesalario'"))[0];

              $salarioDoMes = $exibir['salario'] - $valorFaltas;

              if ($mesdesalario == 12) {

                $subsidiodeferias = $exibir['salario'] * 0.5;
                $subsidiodenatal = $exibir['salario'] * 0.5;
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



            ?>
              <tr>

                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $cont; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['categoria']; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($exibir['salario'], 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['salarioporhora']; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $numerodefaltas; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($valorFaltas, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($salarioDoMes, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($subsidiodeferias, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($subsidiodenatal, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format(00, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $horasextras; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($salariopelahorasextras, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($exibir['subsideodealimentacao'], 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($exibir['subsideodetransporte'], 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($salrioIliquido, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($mcsegurancasocial, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($mcirt, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($segurancasocial, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($irt, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($descontos, 2, ",", ".");
                                                                        echo $n; ?></td>
                <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $n = number_format($salarioliquido, 2, ",", ".");
                                                                        echo $n; ?></td>

              </tr>
            <?php
              $cont++;
            } ?>

          </tbody>
          <tfoot>
            <?php

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


            ?>
            <tr>
              <th>Total</th>
              <th></th>
              <th></th>
              <th><?php echo $totalsalariobase; ?></th>
              <th><?php echo $totalsalarioporhora; ?></th>
              <th></th>
              <th><?php echo $totalvalorpelasfaltas; ?></th>
              <th><?php echo $totalsalariodomes; ?></th>
              <th><?php echo $totalsubsidiodeferias; ?></th>
              <th><?php echo $totalsubsidiodenatal; ?></th>
              <th><?php echo $totalabonodefamilia; ?></th>
              <th></th>
              <th><?php echo $totalsalariopelahorasextras; ?></th>
              <th><?php echo $totalsubsideodealimentacao; ?></th>
              <th><?php echo $totalsubsideodetransporte; ?></th>
              <th><?php echo $totalsalarioiliquido; ?></th>
              <th></th>
              <th></th>
              <th><?php echo $totalsegurancasocial; ?></th>
              <th><?php echo $totalirt; ?></th>
              <th><?php echo $totaldesconto; ?></th>
              <th><?php echo $totalsalarioliquido; ?></th>


            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<script>
  $(document).on("click", ".delete", function(event) {
    event.preventDefault();
    var id = $(this).attr("id");
    console.log(id)
    if (confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")) {
      $(this).closest('tr').remove();
      $.ajax({
        url: 'cadastro/deletesalario.php',
        method: 'POST',
        data: {
          id: id
        },
        success: function(data) {
          $("#mensagemdealerta").html(data);

        }

      })
    }

  })
</script>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; CalungaSOFT 2021</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>