<?php include("conexao.php");
$hojemes = date('m');
$hojeano = date('Y');


$idanolectivo = isset($_GET['idanolectivo']) ? $_GET['idanolectivo'] : "$hojeano";
$idanolectivo = mysqli_escape_string($conexao, $idanolectivo);

$mes = isset($_GET['mes']) ? $_GET['mes'] : "$hojemes";
$ano = isset($_GET['ano']) ? $_GET['ano'] : "$hojeano";

$mes_escolhido = mysqli_escape_string($conexao, $mes);
$ano = mysqli_escape_string($conexao, $ano);


session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];


if (isset($_GET['del'])) {
  $idfalta = mysqli_escape_string($conexao, $_GET['id']);
  $editando = mysqli_query($conexao, "DELETE FROM `presenca` WHERE `presenca`.`idfalta` = '$idfalta'");
  if ($editando) {
    $acertos[] = "O registo de controlo de presença foi eliminado com sucesso!";
  } else {
    $erros[] = "ocorreu algum erro, tente novamente!";
  }
}


$total_a_pagar_professores = mysqli_fetch_array(mysqli_query($conexao, "SELECT sum(totaldetempos*salarioportempo) FROM presencaprofessores where  MONTH(diadapresenca)='$mes_escolhido' and YEAR(diadapresenca)='$ano'"))[0];


$total_a_pagar_professores = number_format($total_a_pagar_professores, 2, ",", ".");

include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Presença Mensal Dos Professores| <?php echo "$mes_escolhido";  ?>/<?php echo "$ano";  ?> </h1>
  <p class="mb-4">Abaixo vai a tabela de presenças e faltas dos professores ao longo do mês</p>

  <?php
  if (!empty($erros)) :
    foreach ($erros as $erros) :
      echo '<div class="alert alert-danger">' . $erros . '</div>';
    endforeach;
  endif;
  ?>

  <?php
  if (!empty($acertos)) :
    foreach ($acertos as $acertos) :
      echo '<div class="alert alert-success">' . $acertos . '</div>';
    endforeach;
  endif;
  ?>







  <?php include("estilocarde.php"); ?>

  <button id="myBtn" class="btn btn-primary">Escolher o mês</button>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button>


  <br><br>
  <span id="mensagemdealerta"></span>


  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" action="" method="get">


        <div class="form-group">
          <?php $ano_padrao = date("Y"); ?>
          <span>Ano </span>
          <input type="number" name="ano" min="2010" max="2200" class="form-control" value="<?php echo "$ano_padrao"; ?>">
        </div>

        <div class="form-group">
          <select name="mes" class="form-control">
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

          <input type="hidden" name="idanolectivo" value="<?php echo $idanolectivo; ?>">

          <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
        </div>
      </form>
    </div>
  </div>





  <div id="myModalreclamacoes" class="modal">
    <div class="modal-content">
      <span id="closereclamacoes"> &times;</span>
      <form action="" method="get">
        <br>

        <span>Escolha outro Ano Lectivo</span>
        <div class="form-group">
          <select name="idanolectivo" required class="form-control">
            <?php
            $lista = mysqli_query($conexao, "SELECT * from anoslectivos order by titulo desc");
            while ($exibir = $lista->fetch_array()) { ?>
              <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
            <?php } ?>
          </select>
        </div>

        <br>
        <input type="submit" value="Ver" name="mudaranolectivo" class="btn btn-success" style="float: rigth;">


        <input type="hidden" name="ano" value="<?php echo $ano; ?>">
        <input type="hidden" name="mes" value="<?php echo $mes_escolhido; ?>">
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





    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }


    window.onclick = (event) => {
      if (event.target == modalreclamacoes) {
        modalreclamacoes.style.display = "none";
      }
    }

    btn.addEventListener("click", () => {
      modal.style.display = "block";
    })




    span.addEventListener("click", () => {
      modal.style.display = "none";
    })

    spanreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "none";
    })


    btnreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "block";
    })

    spanreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "none";
    })
  </script>
  <br><br>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Presença</h6>
    </div>

    <div class="card-body">

      <div class="table-responsive">

        <a href="pdf/pdfpresencaprofessores.php?mesdevenda=<?php echo  $mes; ?>&anodevenda=<?php echo  $ano; ?>&idanolectivo=<?php echo  $idanolectivo; ?>" class="d-sm-inline-block btn btn-sm btn-primary" title="Imprimir lista de presença mensal"><i class="fas fa-fw fa-download"></i>Imprimir lista de Presença</a>

        <a href="presencaprofessoresauxiliares.php?mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>&idanolectivo=<?php echo  $idanolectivo; ?>" class="d-sm-inline-block btn btn-sm btn-info"><i class="fas fa-fw fa-eye"></i>Ver Professores Auxiliares</a>

        <br><br>

        <span id="mensagemdealerta2"></span>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Funcionário</th>
              <th>Turma</th>
              <th>Disciplina</th>
              <th>Salário/tempo</th>
              <?php

              $salario_portempo = mysqli_fetch_array(mysqli_query($conexao, "SELECT salarioportempo FROM anoslectivos where idanolectivo='$idanolectivo'"))[0];




              $totaldedias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
              for ($i = 1; $i <= $totaldedias; $i++) {  ?>
                <th><?php echo  $i; ?></th>
              <?php } ?>
              <th>Total(Tempos)</th>
              <th>Total(salário)</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $listadefuncionários = mysqli_query($conexao, "SELECT  disciplinas.salarioportempo,disciplinas.idprofessor, disciplinas.titulo, disciplinas.iddisciplina,disciplinas.idturma, funcionarios.nomedofuncionario FROM funcionarios, disciplinas where (funcionarios.idfuncionario=disciplinas.idprofessor) and idanolectivo='$idanolectivo'");
            $salariodetodos = 0;
            while ($exibir = $listadefuncionários->fetch_array()) {

              $idfuncionario = $exibir['idprofessor'];
              $iddisciplina = $exibir['iddisciplina'];
              $idturma = $exibir['idturma'];

              $turma = mysqli_fetch_array(mysqli_query($conexao, "select titulo from turmas where idturma='$idturma' limit 1"))[0];
              $salariototal = 0;
              $tempos_total = 0;




            ?>
              <tr>
                <td><a href="funcionario.php?idfuncionario=<?php echo $idfuncionario; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
                <td><a href="turma.php?idturma=<?php echo $exibir['idturma']; ?>"><?php echo $turma; ?></a></td>
                <td><a href="disciplina.php?iddisciplina=<?php echo $exibir['iddisciplina']; ?>"><?php echo $exibir['titulo']; ?></a></td>
                <td><?php echo $exibir['salarioportempo']; ?></td>
                <?php for ($i = 1; $i <= $totaldedias; $i++) {

                  $data = "$i-$mes_escolhido-$ano";

                  $dia_da_presenca = "$ano-$mes_escolhido-$i";

                  $cor = "red";
                  $imprimir = "";

                  $dados = mysqli_fetch_array(mysqli_query($conexao, "SELECT totaldetempos, salarioportempo FROM presencaprofessores where idprofessor='$idfuncionario' and diadapresenca='$dia_da_presenca' and iddisciplina='$iddisciplina' limit 1"));

                  if (isset($dados["totaldetempos"])) {
                    $tempos = $dados["totaldetempos"];
                    $imprimir = "$tempos";
                  } else {
                    $tempos = 0;
                    $dados["salarioportempo"] = 0;
                    $imprimir = "";
                  }



                  $valorporreceber = $tempos * $dados["salarioportempo"];


                  $salariototal += $valorporreceber;
                  $tempos_total += $tempos;






                  if (date('N', strtotime($data)) == 6) {
                    $cor = "yellow";
                  } else if (date('N', strtotime($data)) == 7) {
                    $cor = 'rgb(255,135,135)';
                  } else {
                    $cor = '';
                  }


                  $salariototal_f = number_format($salariototal, 2, ",", ".");

                ?>
                  <td title="Valor nesse dia: <?php echo $valorporreceber; ?> | Valor acumulado:  <?php echo $salariototal_f; ?>  funcionário: <?php echo $exibir['nomedofuncionario']; ?> " class="update" data-id="<?php echo $iddisciplina; ?>" data-column="<?php echo $dia_da_presenca; ?>" style="background-color: <?php echo $cor; ?>;" contenteditable><strong><?php echo $imprimir; ?></strong></td>
                <?php } ?>
                <td><?php echo $tempos_total; ?></td>
                <td><?php $salariodetodos += $salariototal;
                    $n = number_format($salariototal, 2, ",", ".");
                    echo $n; ?> Kz</td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <td><strong>Total</strong></td>
              <td></td>
              <td></td>
              <td></td>
              <?php for ($i = 1; $i <= $totaldedias; $i++) { ?>
                <td></td>
              <?php } ?>
              <td></td>
              <td><strong><?php $n = number_format($salariodetodos, 2, ",", ".");
                          echo $n; ?> Kz</strong></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>




</div>
<!-- End of Main Content -->
</div>
<!-- End of Main Content -->


<script>
  $(document).on("blur", ".update", function() {
    var iddisciplina = $(this).data("id");
    var dia = $(this).data("column");
    var tempos = $(this).text(); 

    var auxiliar = 0;


    $.ajax({
      url: 'cadastro/preencherpresencadoprofessor.php',
      method: 'POST',

      data: {
        iddisciplina,
        dia,
        tempos,
        auxiliar
      },

      success: function(data) {
        $("#mensagemdealerta").html(data);
        $("#mensagemdealerta2").html(data);
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

</body>

</html>