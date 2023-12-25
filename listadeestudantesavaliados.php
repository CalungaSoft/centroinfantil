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


$idanolectivo = isset($_GET['idanolectivo']) ? $_GET['idanolectivo'] : "";
$idanolectivo = mysqli_escape_string($conexao, $idanolectivo);

$anolectivo_escolhido = mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];




include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Lista de Alunos avaliados no ano lectivo (<?php echo $anolectivo_escolhido; ?>)</h1> <br>

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



  <?php include("estilocarde.php"); ?>


  <button id="myBtnreclamacoes" class="btn btn-primary" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button>




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


      </form>
    </div>
  </div>





  <script>
    var btnreclamacoes = document.getElementById("myBtnreclamacoes");


    var modalreclamacoes = document.getElementById("myModalreclamacoes");
    var spanreclamacoes = document.getElementById("closereclamacoes");






    window.onclick = (event) => {
      if (event.target == modalreclamacoes) {
        modalreclamacoes.style.display = "none";
      }
    }


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

  <br> <br>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <span id="mensagemdealerta"></span>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nome Completo</th>
              <th>Turma</th>
              <th>Sala</th>
              <th>Observação</th>
              <th>Data</th>
              <th>Ver</th>
              <th>Imprimir</th>
            </tr>
          </thead>
          <tbody>
            <?php


            $lista = mysqli_query($conexao, "SELECT MIN(datadaavaliacao) AS datadaavaliacao, matriculaseconfirmacoes.*, avaliacoesdosalunos.observacao
FROM matriculaseconfirmacoes
JOIN avaliacoesdosalunos ON matriculaseconfirmacoes.idmatriculaeconfirmacao = avaliacoesdosalunos.idmatriculaeconfirmacao
WHERE matriculaseconfirmacoes.idanolectivo = '$idanolectivo'
GROUP BY datadaavaliacao, matriculaseconfirmacoes.idmatriculaeconfirmacao
ORDER BY datadaavaliacao ASC");


            while ($exibir = $lista->fetch_array()) {

              $idaluno = $exibir['idaluno'];
              $idmatricula = $exibir['idmatriculaeconfirmacao'];
              $dataDaAvaliacao = $exibir['datadaavaliacao'];

              $dados_do_aluno = mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno'"));
              $nomecompleto = $dados_do_aluno['nomecompleto'];

              //ultima obsevacao da avaliacoa
              $sql_verificar_ultima_observacao = mysqli_query($conexao, "select * from avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatricula' and datadaavaliacao='$dataDaAvaliacao' order by idavaliacao desc limit 1");
              if (mysqli_num_rows($sql_verificar_ultima_observacao) > 0) {
                $ultimaobservacao = mysqli_fetch_array($sql_verificar_ultima_observacao)['observacao'];
              } else {
                $ultimaobservacao = "";
              }

              //converter data para o formato dd/mm/aaaa
              $dataDaAvaliacao = date("d/m/Y", strtotime($dataDaAvaliacao));

            ?>
              <tr>
                <td> <a href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $nomecompleto; ?> </a></td>

                <td><?php echo $exibir['turma']; ?></td>
                <td><?php echo $exibir['sala']; ?></td>
                <td><?php echo $ultimaobservacao; ?></td>
                <td><?php echo $exibir['datadaavaliacao']; ?></td>
                <td> <a class="btn btn-success" href="avaliacaodoaluno.php?idmatricula=<?php echo $exibir["idmatriculaeconfirmacao"]; ?>&datadaavaliacao=<?php echo $dataDaAvaliacao; ?>"> <i class="fas fa-eye"></i> </a></td>
                <td> <a class="btn btn-primary" href="imprimiravaliacao.php?idmatricula=<?php echo $exibir["idmatriculaeconfirmacao"]; ?>&datadaavaliacao=<?php echo $dataDaAvaliacao; ?>"> <i class="fas fa-print"></i> </a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
  $(document).on("blur", ".update", function() {
    var id = $(this).data("id");
    var nomedacoluna = $(this).data("column");
    var valor = $(this).text();


    $.ajax({
      url: 'cadastro/updateagenda.php',
      method: 'POST',
      data: {
        id: id,
        nomedacoluna: nomedacoluna,
        valor: valor
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);
      }

    })
  })


  $(document).on("click", ".delete", function(event) {
    event.preventDefault();
    var id = $(this).attr("id");
    console.log(id)
    if (confirm("Tens certeza que queres eliminar esssa actividade?")) {
      $(this).closest('tr').remove();
      $.ajax({
        url: 'cadastro/deleteagenda.php',
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

<!-- Jquery JS-->
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

</body>

</html>