<?php include("conexao.php");



session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : "todos";
$mesdevenda = isset($_GET['mesdevenda']) ? $_GET['mesdevenda'] : "";
$mesdevenda = mysqli_escape_string($conexao, $mesdevenda);
$anodevenda = isset($_GET['anodevenda']) ? $_GET['anodevenda'] : "";
$anodevenda = mysqli_escape_string($conexao, $anodevenda);


if (!($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2")) {

  header('Location: login.php');
}

if (isset($_POST['cadastrar'])) {

  if (!empty(trim($_POST['mes']))) {

    $mes = mysqli_escape_string($conexao,  $_POST['mes']);
    $ano = mysqli_escape_string($conexao,  $_POST['ano']);

    $mesdevenda = $mes;
    $anodevenda = $ano;

    $ementamensal = mysqli_num_rows(mysqli_query($conexao, "SELECT id FROM ementamensal where MONTH(dia)='$mes' and YEAR(dia)='$ano'"));
    if ($ementamensal == 0) {


      $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

      for ($i = 1; $i <= $diasNoMes; $i++) {


        $dia = "$ano-$mes-$i";

        //pequeno Almoço
        $salvar = mysqli_query($conexao, "INSERT INTO `ementamensal` (`dia`, `tipoderefeicao`, `descricaodarefeicao`) VALUES ('$dia', 'Pequeno Almoço','')");

        //almoço
        $salvar = mysqli_query($conexao, "INSERT INTO `ementamensal` (`dia`, `tipoderefeicao`, `descricaodarefeicao`) VALUES ('$dia', 'Almoço','')");

        //lanche
        $salvar = mysqli_query($conexao, "INSERT INTO `ementamensal` (`dia`, `tipoderefeicao`, `descricaodarefeicao`) VALUES ('$dia', 'Lanche','')");
      }


      if ($salvar) {

        $acerto[] = "Ementa Criada com sucesso";
      } else {
        $erros[] = "Ocorreu um erro Ao cadastrar o  produto, tente novamente";
      }
    } else {
      $erros[] = "Já Existe a ementa mensal de $mes/$ano";
    }
  } else {
    $erros[] = "Um mês deve ser selecionado";
  }
}

$cardeeditar = "";




include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <?php
  if (!empty($erros)) :
    foreach ($erros as $erros) :
      echo '<div class="alert alert-danger">' . $erros . '</div>';
    endforeach;
  endif;
  ?>
  <?php
  if (!empty($acerto)) :
    foreach ($acerto as $acerto) :
      echo '<div class="alert alert-success">' . $acerto . '</div>';
    endforeach;
  endif;
  ?>




  <?php

  $totaldeprodutos = mysqli_num_rows(mysqli_query($conexao, "select idproduto FROM produtos"));

  ?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Ementa Mensal <?php if (isset($_GET['mesdevenda'])) {
                                                    echo "| $mesdevenda/$anodevenda";
                                                  } ?> </h1> <br>

  <?php include("estilocarde.php"); ?>
  <button id="myBtn" class="btn btn-primary">Escolher o mês</button>
  <?php if ($painellogado == "administrador") { ?>
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma entrada">Fazer Ementa</button>
  <?php  } else { ?>
    <span id="myBtnreclamacoes"></span>
  <?php } ?>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" action="" method="">

        <div class="form-group">

          <span>Ano Lectivo</span>
          <select name="anodevenda" required class="form-control">
            <?php

            $ano = date('Y');
            $lista = mysqli_query($conexao, "SELECT DISTINCT(YEAR(datadaentrada)) as ano from entradas order by YEAR(datadaentrada) desc");

            while ($exibir = $lista->fetch_array()) {

              $ano = $exibir["ano"];
            ?>
              <option <?php if (date('Y') == $exibir["ano"]) { ?> selected="" <?php } ?> value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
            <?php } ?>
            <option <?php if (date('Y') == $ano + 1) { ?> selected="" <?php } ?> value="<?php echo $ano + 1; ?>"><?php echo $ano + 1; ?></option>
          </select>
        </div>


        <div class="form-group">
          <select name="mesdevenda" class="form-control">
            <option <?php $mesactual = date('m');
                    if ($mesactual == 1) { ?> selected="" <?php } ?> value="01">Janeiro</option>
            <option <?php if ($mesactual == 2) { ?> selected="" <?php } ?> value="02">Fevereiro</option>
            <option <?php if ($mesactual == 3) { ?> selected="" <?php } ?> value="03">Marco</option>
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
          <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
        </div>

      </form>
    </div>
  </div>



  <div id="myModalreclamacoes" class="modal">
    <div class="modal-content">
      <span id="closereclamacoes"> &times;</span>
      <form class="user" method="post" action="">
        <h2>Fazer ementa</h2>
        <span style="font-size: 11px"> </p>

          <div class="form-group">

            <span>Ano Lectivo</span>
            <select name="ano" required class="form-control">
              <?php

              $ano = date('Y');
              $lista = mysqli_query($conexao, "SELECT DISTINCT(YEAR(datadaentrada)) as ano from entradas order by YEAR(datadaentrada) desc");

              while ($exibir = $lista->fetch_array()) {

                $ano = $exibir["ano"];
              ?>
                <option <?php if (date('Y') == $exibir["ano"]) { ?> selected="" <?php } ?> value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
              <?php } ?>
              <option <?php if (date('Y') == $ano + 1) { ?> selected="" <?php } ?> value="<?php echo $ano + 1; ?>"><?php echo $ano + 1; ?></option>
            </select>
          </div>


          <div class="form-group">
            <select name="mes" class="form-control">
              <option <?php $mesactual = date('m');
                      if ($mesactual == 1) { ?> selected="" <?php } ?> value="01">Janeiro</option>
              <option <?php if ($mesactual == 2) { ?> selected="" <?php } ?> value="02">Fevereiro</option>
              <option <?php if ($mesactual == 3) { ?> selected="" <?php } ?> value="03">Marco</option>
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
          </div>



          <br>
          <input type="submit" name="cadastrar" value="Fazer Ementa Mensal" class="btn btn-primary" style="float: rigth;">

      </form>
    </div>
  </div>


  <script>
    var btn = document.getElementById("myBtn");
    var btnreclamacoes = document.getElementById("myBtnreclamacoes");

    var modal = document.getElementById("myModal");
    var modalreclamacoes = document.getElementById("myModalreclamacoes");

    var span = document.getElementById("close");
    var spanreclamacoes = document.getElementById("closereclamacoes");

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

    btnreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "block";
    })
    spanreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "none";
    })
    window.onclick = (event) => {
      if (event.target == modalreclamacoes) {
        modalreclamacoes.style.display = "none";
      }
    }
  </script>

  <br><br>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabela de refeições no mês</h6>
    </div>
    <div class="card-body">

    <span id="mensagemdealerta"></span>

      <div class="table-responsive">

        <?php
        $mesAtual = $mesdevenda;
        $anoAtual = $anodevenda;
        $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mesAtual, $anoAtual);
        $primeiroDia = date("N", strtotime("{$anoAtual}-{$mesAtual}-01"));


        $ementamensal_esse_mes = mysqli_num_rows(mysqli_query($conexao, "SELECT id FROM ementamensal where MONTH(dia)='$mesAtual' and YEAR(dia)='$anoAtual'"));


        if ($ementamensal_esse_mes != 0) {


         

          // Início da tabela com classes
          echo "<table class='table table-bordered'  width='100%' cellspacing='0' border=1>";
          echo "<thead><tr><th>Semanas</th><th>Alimentação</th><th>Segunda</th><th>Terça</th><th>Quarta</th><th>Quinta</th><th>Sexta</th></tr></thead>";
          echo "<tbody>";

          // Loop para as semanas
          for ($semana = 1; $semana <= 5; $semana++) {

            echo "<tr><td rowspan='3'>{$semana}ª Semana</td><td>Pequeno Almoço</td>";

            // Loop para os dias da semana
            for ($diaSemana = 1; $diaSemana <= 5; $diaSemana++) {
              // Calcula o número do dia no mês
              $diaNoMes = ($semana - 1) * 7 + $diaSemana - $primeiroDia + 1;

              // Verifica se o dia está dentro do mês
              if ($diaNoMes > 0 && $diaNoMes <= $diasNoMes) {
                
                $alimento =mysqli_fetch_array(mysqli_query($conexao, "SELECT descricaodarefeicao FROM ementamensal where DAY(dia)='$diaNoMes' and MONTH(dia)='$mesAtual' and YEAR(dia)='$anoAtual' and tipoderefeicao='Pequeno Almoço' limit 1"))[0];
                echo "<td contenteditable class='update' data-id='$diaNoMes' data-column='Pequeno Almoço' >$alimento</td>";
              } else {
                echo "<td></td>";
              } 
            }

            echo "</tr><tr><td>Almoço</td>";

            // Reinicia o loop para os dias da semana
            for ($diaSemana = 1; $diaSemana <= 5; $diaSemana++) {
              $diaNoMes = ($semana - 1) * 7 + $diaSemana - $primeiroDia + 1;
              if ($diaNoMes > 0 && $diaNoMes <= $diasNoMes) {

                $alimento =mysqli_fetch_array(mysqli_query($conexao, "SELECT descricaodarefeicao FROM ementamensal where DAY(dia)='$diaNoMes' and MONTH(dia)='$mesAtual' and YEAR(dia)='$anoAtual' and tipoderefeicao='Almoço' limit 1"))[0];
                echo "<td contenteditable class='update' data-id='$diaNoMes' data-column='Almoço' >$alimento</td>";
              } else {
                echo "<td></td>";
              }
            }

            echo "</tr><tr><td>Lanche</td>";

            // Reinicia o loop para os dias da semana
            for ($diaSemana = 1; $diaSemana <= 5; $diaSemana++) {
              $diaNoMes = ($semana - 1) * 7 + $diaSemana - $primeiroDia + 1;
              if ($diaNoMes > 0 && $diaNoMes <= $diasNoMes) {
                $alimento =mysqli_fetch_array(mysqli_query($conexao, "SELECT descricaodarefeicao FROM ementamensal where DAY(dia)='$diaNoMes' and MONTH(dia)='$mesAtual' and YEAR(dia)='$anoAtual' and tipoderefeicao='Lanche' limit 1"))[0];
                echo "<td contenteditable class='update' data-id='$diaNoMes' data-column='Lanche' >$alimento</td>";
              } else {
                echo "<td></td>";
              }
            }

            echo "</tr>";
          }

          // Fim da tabela
          echo "</tbody></table>";
        }
        ?>



      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
  $(document).on("blur", ".update", function() {
    var dia = $(this).data("id");
    var tipoderefeicao = $(this).data("column");
    var descricaodarefeicao = $(this).text();

    var ano = <?php echo $anoAtual; ?>;
    var mes = <?php echo $mesAtual; ?>;

    $.ajax({
      url: 'cadastro/updateementa.php',
      method: 'POST',

      data: {
        dia,
        tipoderefeicao,
        descricaodarefeicao,
        ano,
        mes
      },

      success: function(data) {
        $("#mensagemdealerta").html(data); 
      }

    })

  })
</script>

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; CalungaSOFT 2023</span>
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

<!-- Jquery JS-->
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

</body>

</html>