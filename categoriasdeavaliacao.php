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


if (isset($_POST['cadastrar'])) {

  if (!empty(trim($_POST['titulo']))) {

    $titulo = mysqli_escape_string($conexao, $_POST['titulo']);
    $avaliacoes = mysqli_escape_string($conexao, $_POST['avaliacoes']);
    $idsessaodeavaliacao = mysqli_escape_string($conexao, $_POST['idsessaodeavaliacao']);


    // Divide a string em um array usando o ponto e vírgula como delimitador
    $arrayDeAvaliacoes = explode(";", $avaliacoes);



    $existe = mysqli_num_rows(mysqli_query($conexao, "select id from categoriasdeavaliacao where titulo='$titulo' and idsessaodeavaliacao='$idsessaodeavaliacao'"));

    if ($existe == 0) {

      $salvar = mysqli_query($conexao, "INSERT INTO `categoriasdeavaliacao` (titulo,idsessaodeavaliacao) VALUES ('$titulo','$idsessaodeavaliacao')");



      $idCategoriaSalva = mysqli_fetch_array(mysqli_query($conexao, "SELECT id from categoriasdeavaliacao where titulo='$titulo' and idsessaodeavaliacao='$idsessaodeavaliacao' order by id desc limit 1"))[0];



      if ($salvar) {

        foreach ($arrayDeAvaliacoes as $key => $value) {

          $salvar = mysqli_query($conexao, "INSERT INTO `tiposdeavalicoes` (titulo,idcategoria) VALUES ('$value','$idCategoriaSalva')");

          if ($salvar) {
            $acerto[] = "Avaliação $value foi Cadastrado com sucesso";
          } else {

            $erros[] = "Ocorreu um erro Ao Cadastrar a avaliação $value";
          }
        }


        $acerto[] = "Categoria de Avaliação $titulo foi Cadastrado com sucesso";
      } else {

        $erros[] = "Ocorreu um erro Ao Cadastrar a Categoria de Avaliação";
      }
    } else {

      $erros[] = "Essa Categoria de Avaliação já existe";
    }
  } else {
    $erros[] = " O campo título não pode ir vazio";
  }
}





include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Lista de categoria para avaliações</h1>
  <p class="mb-4">A seguir vai a lista de categoria</p>

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


  <button id="myBtn" class="btn btn-success"> <i class="fas fa-fw fa-plus"></i> Acrescentar categoria</button>


  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" method="post" action="">
        <h3>Cadastrando uma nova Categoria de Avaliação</h3> <br>
        <div class="form-group">


          <?php

          $lista = mysqli_query($conexao, "select * from categoriasdeavaliacao");

          ?>
          <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control" placeholder="Categoria de avaliação,  Ex: Motora, Percepção, Creatividade" required="">
          <datalist id="datalist2">
            <?php while ($exibir = $lista->fetch_array()) { ?>
              <option value="<?php echo $exibir['titulo']; ?>">
              <?php } ?>
          </datalist>
        </div>

        <div class="form-group">
          <span>Sessão</span>
          <select name="idsessaodeavaliacao" required class="form-control">
            <?php

            $lista = mysqli_query($conexao, "SELECT * from sessoesdeavaliacao");

            while ($exibir = $lista->fetch_array()) {
            ?>
              <option value="<?php echo $exibir["id"]; ?>"><?php echo $exibir["titulo"]; ?></option>
            <?php } ?>

          </select>
        </div>

        <div class="form-group">
          <span>Avaliações</span> <br> (<span style="font-size: 10px;">Separa cada avaliação com um ponto e vírgula ";"</span>)
          <textarea name="avaliacoes" id="" cols="30" rows="4" class="form-control"></textarea>
        </div>




        <br>
        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success" style="float: rigth;">

      </form>
    </div>
  </div>







  <script>
    var btn = document.getElementById("myBtn");


    var modal = document.getElementById("myModal");


    var span = document.getElementById("close");





    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }



    btn.addEventListener("click", () => {
      modal.style.display = "block";
    })




    span.addEventListener("click", () => {
      modal.style.display = "none";
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
              <th>Categoria de Avaliação</th>
              <th>Sessão</th>

              <th>Avaliações</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $lista = mysqli_query($conexao, "select * from categoriasdeavaliacao");
            while ($exibir = $lista->fetch_array()) {

              $idsessao = $exibir["idsessaodeavaliacao"];
              $idCategoria = $exibir["id"];

              $sessao = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from sessoesdeavaliacao where  id='$idsessao'"))[0];

            ?>
              <tr>
                <td> <?php echo $exibir['titulo']; ?> </td>
                <td> <?php echo $sessao; ?> </td>

                <td> <?php

                      $lista_av = mysqli_query($conexao, "select * from tiposdeavalicoes where idcategoria='$idCategoria'");
                      while ($mostrar = $lista_av->fetch_array()) {
                        echo "$mostrar[titulo]; <br>";
                      }


                      ?> </td>
                <td align="center" title="Eliminar categoria">
                  <a href="categoriasdeavaliacao.php?idcaegoria=<?php echo $idCategoria; ?>&del=yes" style="color:red"><i class="fas fa-trash"></i> </a>
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
      <span>Copyright &copy; CalungaSOFT 2022</span>
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