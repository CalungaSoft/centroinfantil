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

$funcao = isset($_GET['funcao']) ? $_GET['funcao'] : "";
$funcao = mysqli_escape_string($conexao, $funcao);

$anolectivo_escolhido = mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Lista de disciplinas no ano lectivo (<?php echo $anolectivo_escolhido; ?>) | <?php echo $funcao; ?></h1>
  <p class="mb-4">A seguir vai a lista de disciplinas disponíveis na instituição</p>

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

        <input type="hidden" name="funcao" value="<?php echo "$funcao"; ?>">
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
      <br> <?php if ($funcao == 'Minipauta') { ?>

        <a href="minipautadeturmas.php?idanolectivo=<?php echo $idanolectivo; ?>" class="d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-fw fa-user"></i> Ver Minipauta por turmas</a> <br>

        <br><?php } ?>
      <div class="table-responsive">

        <span id="mensagemdealerta"></span>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Disciplina</th>
              <th>Professor</th>
              <th>Auxiliar</th>
              <th>Tipo</th>
              <th>Classe</th>
              <th>Curso</th>
              <th>Opção</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $lista = mysqli_query($conexao, "select * from disciplinas where idanolectivo='$idanolectivo'");
            while ($exibir = $lista->fetch_array()) {

              $iddisciplina = $exibir["iddisciplina"];

              $idprofessor = $exibir["idprofessor"];
              $idprofessorauxiliar = $exibir["idprofessorauxiliar"];

              $Professor = mysqli_fetch_array(mysqli_query($conexao, "SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessor'"))[0];

              $Professorauxiliar = mysqli_fetch_array(mysqli_query($conexao, "SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar'"))[0];


              $idturma = $exibir["idturma"];

              $dadosdaturma = mysqli_fetch_array(mysqli_query($conexao, "SELECT * from turmas where idturma='$idturma'"));

              $idcurso = $dadosdaturma["idcurso"];
              $idclasse = $dadosdaturma["idclasse"];


              $curso = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from cursos where idcurso='$idcurso'"))[0];

              $classe = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from classes where idclasse='$idclasse'"))[0];

            ?>
              <tr>
                <td> <a href="disciplina.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td>
                <td><a href="funcionario.php?idfuncionario=<?php echo $exibir["idprofessor"]; ?>"><?php echo $Professor; ?></a></td>
                <td><a href="funcionario.php?idfuncionario=<?php echo $exibir["idprofessorauxiliar"]; ?>"><?php echo $Professorauxiliar; ?></a></td>
                <td><?php echo $exibir["tipodedisciplina"]; ?></td>
                <td><a href="classe.php?idclasse=<?php echo $idclasse; ?>"><?php echo $classe; ?></a></td>
                <td><a href="curso.php?idcurso=<?php echo $idcurso; ?>"><?php echo $curso; ?></a></td>

                <td>


                  <?php

                  if (($idprofessorauxiliar == $idlogado || $idprofessor == $idlogado) || $painellogado == "areapedagogica" || $painellogado == "administrador") {




                    if ($funcao == 'Lançar Notas') { ?>
                      <a href="lancarnota.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <button class="btn btn-success"> <?php echo "$funcao"; ?> </button> </a>

                    <?php } ?>


                    <?php if ($funcao == 'Lançar Faltas' || $funcao == 'Ver Faltas') { ?>
                      <a href="lancarfalta.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <button class="btn btn-success"> <?php echo "$funcao"; ?> </button> </a>

                    <?php } ?>




                    <?php if ($funcao == 'Minipauta') { ?>
                      <a href="disciplina.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <button class="btn btn-success">Ver <?php echo "$funcao"; ?> </button> </a>

                    <?php }


                    if ($funcao == 'Lançar Presença') { ?>
                      <a href="disciplina.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <button class="btn btn-success">Lançar Presença </button> </a>

                  <?php }
                  } ?>





                </td>


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