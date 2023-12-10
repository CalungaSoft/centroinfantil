<?php include("conexao.php");
$hojemes = date('m');
$hojeano = date('Y');
$mes = isset($_GET['mes']) ? $_GET['mes'] : "$hojemes";
$ano = isset($_GET['ano']) ? $_GET['ano'] : "$hojeano";

$mes_escolhido = mysqli_escape_string($conexao, $mes);
$ano = mysqli_escape_string($conexao, $ano);

$idturma = isset($_GET['idturma']) ? $_GET['idturma'] : "1";
$idturma = mysqli_escape_string($conexao, $idturma);


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



ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL); //force php to show any error message


$dadosdaturma = mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1"));

$turma = $dadosdaturma["titulo"];

include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Presença Mensal | <?php echo "$mes_escolhido";  ?>/<?php echo "$ano";  ?> - Turma: <a href="turma.php?idturma=<?php echo "$idturma";  ?>"><?php echo "$turma";  ?></a> </h1>
  <p class="mb-4">Abaixo vai a tabela de presenças ao longo do mês</p>

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

  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" action="" method="get">

        <div class="form-group">
          <?php $ano = date("Y"); ?>
          <span>Ano </span>
          <input type="number" name="ano" min="2010" max="2200" class="form-control" value="<?php echo "$ano"; ?>">
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

          <input type="hidden" value="<?php echo "$idturma";  ?>" name="idturma">
          <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
        </div>
      </form>
    </div>
  </div>

  <br> <br>
  <span id="mensagemdealerta"></span>
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

  <br><br>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Presença</h6>
    </div>

    <div class="card-body">

      <div class="table-responsive">



        <span id="mensagemdealerta2"></span>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Aluno</th>
              <th>Idade</th>
              <th>Tel. da Mãe</th>
              <th>Tel. do Pai</th>
              <?php
              $totaldedias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
              for ($i = 1; $i <= $totaldedias; $i++) {  ?>
                <th><?php echo  $i; ?></th>
              <?php } ?>
              <th>Presenças</th>
              <th>Faltas</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $lista = mysqli_query($conexao, "select   TIMESTAMPDIFF(YEAR,datadenascimento,CURDATE()) as idade, alunos.* , matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'");

          
            while ($exibir = $lista->fetch_array()) {

              $idmatricula = $exibir['idmatriculaeconfirmacao'];
              $idaluno = $exibir['idaluno'];
           
              $total_presenca = 0;
            $total_falta = 0;

 
            ?>
              <tr>
                <td><a href="aluno.php?idaluno=<?php echo $idaluno; ?>"><?php echo $exibir['nomecompleto']; ?></a></td>
                <td><?php echo $exibir["datadenascimento"]; ?> (<?php echo $exibir["idade"]; ?> Anos )</td>
                <td><?php echo $exibir['contactomae']; ?></td>
                <td><?php echo $exibir['contactopai']; ?></td>
                <?php for ($i = 1; $i <= $totaldedias; $i++) {

                  $data = "$i-$mes-$ano";

                  $cor = "red";
                  $imprimir = "";
                  $query = mysqli_query($conexao, "SELECT * FROM presencaalunos where idmatricula='$idmatricula' and ano='$ano' and dia='$i' and mes='$mes' limit 1");



                  if (mysqli_num_rows($query) == 0) {
                    

                    $falta = [];

 
                  } else {

                    
                    $falta = mysqli_fetch_array($query);

                    if ($falta["presenca"]=='P'|| $falta["presenca"]=='p') {
                      $total_presenca++;
                    }else {

                      $total_falta++;

                    }
                  
                    
 
                  }

 
                  
                  $imprimir = "$falta[presenca]";

                  if (date('N', strtotime($data)) == 6) {
                    $cor = "yellow";
                  } else if (date('N', strtotime($data)) == 7) {
                    $cor = 'rgb(255,135,135)';
                  } else {
                    $cor = '';
                  }



                ?>
                  <td title="Estudante: <?php echo $exibir['nomecompleto']; ?>"  class="update" data-id="<?php echo $idmatricula; ?>" data-column="<?php echo $i; ?>" style="background-color: <?php echo $cor; ?>;" contenteditable><strong><?php echo $imprimir; ?></strong></td>
                <?php } ?>
                <td><?php echo $total_presenca; ?></td>
                <td><?php echo $total_falta; ?></td>
                                                                                                                                               
              </tr>
            <?php } ?>

          </tbody>
          
        </table>
      </div>
    </div>
  </div>



  <!-- Earnings (Monthly) Card Example -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
  $(document).on("input", ".update", function() {
    var idmatricula = $(this).data("id");
    var dia = $(this).data("column");
    var presenca = $(this).text();

    var ano = <?php echo $ano; ?>;
    var mes = <?php echo $mes; ?>;

    $.ajax({
      url: 'cadastro/preencherfaltaaluno.php',
      method: 'POST',

      data: {
        idmatricula,
        dia,
        presenca,
        ano,
        mes
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