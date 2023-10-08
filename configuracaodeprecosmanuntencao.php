<?php include("conexao.php");



session_start();

if (!isset($_SESSION['logado']) || $_SESSION['painel'] != "administrador") :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];



if (isset($_FILES['novo_logo'])) {
  $upload_directory = 'pdf/img/';
  $file_name = $_FILES['novo_logo']['name'];
  $file_temp = $_FILES['novo_logo']['tmp_name'];
  $file_size = $_FILES['novo_logo']['size'];
  $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif'); // Extensões permitidas

  // Verifique o tamanho máximo (por exemplo, 2MB)
  $max_size = 10 * 1024 * 1024; // 2MB em bytes

  // Verifique a extensão do arquivo
  $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

  // Gere um nome único para o arquivo
  $unique_file_name = uniqid() . '.' . $file_extension;

  if (in_array($file_extension, $allowed_extensions) && $file_size <= $max_size) {
    // Verifique se o upload foi bem-sucedido
    if (move_uploaded_file($file_temp, $upload_directory . $unique_file_name)) {
      // Atualize o nome da foto na tabela "aluno"

      $sql = "UPDATE dadosdaempresa SET caminhodologo = '$unique_file_name'";

      if (mysqli_query($conexao, $sql)) {
        $acertos[] = "O Logotipo foi alterada com sucesso!";
      } else {
        $erros[] = "Erro ao atualizar o Logotipo: " . mysqli_error($conexao);
      }
    } else {
      $erros[] = "Erro ao fazer o upload do Logotipo.";
    }
  } else {
    $erros[] = "O arquivo não é válido. Certifique-se de que seja uma imagem (jpg, jpeg, png ou gif) e não exceda 2MB de tamanho.";
  }
}


if (isset($_POST['editadados'])) {

  $nome = mysqli_escape_string($conexao, trim($_POST['nome']));
  $servicos = mysqli_escape_string($conexao, trim($_POST['servicos']));
  $numerodecontribuinte = mysqli_escape_string($conexao, trim($_POST['numerodecontribuinte']));
  $contabancaria = mysqli_escape_string($conexao, trim($_POST['contabancaria']));
  $email = mysqli_escape_string($conexao, trim($_POST['email']));
  $localizacao = mysqli_escape_string($conexao, trim($_POST['localizacao']));
  $telefone = mysqli_escape_string($conexao, trim($_POST['telefone']));
  $site = mysqli_escape_string($conexao, trim($_POST['site']));
  $nomedodireitor = mysqli_escape_string($conexao, trim($_POST['nomedodireitor']));
  $localizacaoprecisa = mysqli_escape_string($conexao, trim($_POST['localizacaoprecisa']));



  $guardar = mysqli_query($conexao, "UPDATE `dadosdaempresa` SET localizacaoprecisa='$localizacaoprecisa',`nomedodireitor` = '$nomedodireitor',`site` = '$site', `nome` = '$nome', `servicos` = '$servicos', `numerodecontribuinte` = '$numerodecontribuinte', `contabancaria` = '$contabancaria', `email` = '$email', `localizacao` = '$localizacao', `telefone` = '$telefone' WHERE `dadosdaempresa`.`iddadosdaempresa` = 1");

  header("location:configuracaodeprecosmanuntencao.php");
}


include("cabecalho.php"); ?>
<div class="container-fluid">

  <h1 class="h3 mb-4 text-gray-800">Configurações</h1>



  <?php include("estilocarde.php"); ?>

  <div class="col-lg">
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Dados do empresa

        </h6>
        <div class="dropdown no-arrow">
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <?php
        $dadosdaempresa = mysqli_fetch_array(mysqli_query($conexao, "select * FROM dadosdaempresa where iddadosdaempresa='1'"));
        ?>
        <strong>Nome</strong>: <?php echo $dadosdaempresa["nome"]; ?> <br>
        <strong>Serviços Prestados</strong>: <?php echo $dadosdaempresa["servicos"]; ?><br>
        <strong>Nome do Direitor</strong>: <?php echo $dadosdaempresa["nomedodireitor"]; ?><br>
        <strong>Número de Contribuinte</strong>: <?php echo $dadosdaempresa["numerodecontribuinte"]; ?><br>
        <strong>Conta Bancária</strong>: <?php echo $dadosdaempresa["contabancaria"]; ?><br>
        <strong>Email</strong>: <?php echo $dadosdaempresa["email"]; ?><br>
        <strong>Localização</strong>: <?php echo $dadosdaempresa["localizacao"]; ?><br>
        <strong>Número de Telefone</strong>: <?php echo $dadosdaempresa["telefone"]; ?><br>
        <strong>Web Site</strong>: <?php echo $dadosdaempresa["site"]; ?><br>
        <strong>Localização Precisa</strong>: <?php echo $dadosdaempresa["localizacaoprecisa"]; ?><br><br>


        <br>

        
        
        <hr>
        <hr>
        <hr>

        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
          <!-- Card Header - Accordion -->
          <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Editar Informações</h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse in" id="collapseCardExample">
            <div class="card-body">
              <form action="" method="post" class="user">

                <div class="form-group">
                  <label>Nome:</label>
                  <input type="text" name="nome" class="form-control" value="<?php echo $dadosdaempresa["nome"]; ?>">
                </div>
                <div class="form-group">
                  <label>Serviços:</label>
                  <input type="text" name="servicos" class="form-control" value="<?php echo $dadosdaempresa["servicos"]; ?>">
                </div>
                <div class="form-group">
                  <label>Número de Contribuinte:</label>
                  <input type="text" name="numerodecontribuinte" class="form-control" value="<?php echo $dadosdaempresa["numerodecontribuinte"]; ?>">
                </div>
                <div class="form-group">
                  <label>Nome do Direitor:</label>
                  <input type="text" name="nomedodireitor" class="form-control" value="<?php echo $dadosdaempresa["nomedodireitor"]; ?>">
                </div>

                <div class="form-group">
                  <label>Conta Bancária:</label>
                  <input type="text" name="contabancaria" class="form-control" value="<?php echo $dadosdaempresa["contabancaria"]; ?>">
                </div>
                <div class="form-group">
                  <label>Email:</label>
                  <input type="text" name="email" class="form-control" value="<?php echo $dadosdaempresa["email"]; ?>">
                </div>
                <div class="form-group">
                  <label>Localização:</label>
                  <input type="text" name="localizacao" class="form-control" value="<?php echo $dadosdaempresa["localizacao"]; ?>">
                </div>
                <div class="form-group">
                  <label>Número de Telefone:</label>
                  <input type="text" name="telefone" class="form-control" value="<?php echo $dadosdaempresa["telefone"]; ?>">
                </div>
                <div class="form-group">
                  <label>Web Site:</label>
                  <input type="text" name="site" class="form-control" value="<?php echo $dadosdaempresa["site"]; ?>">
                </div>
                <div class="form-group">
                  <label>Localização No Recibo</label>
                  <input type="text" name="localizacaoprecisa" class="form-control" value="<?php echo $dadosdaempresa["localizacaoprecisa"]; ?>">
                </div>
                <div class="form-group">
                  <input type="submit" name="editadados" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                </div>

              </form>
            </div>
          </div>
        </div>
        <!-- Collapsable Card Example -->

        
        <br>
        <br>
        
        <button id="myBtnfoto" class="btn btn-primary">Ver ou alterar logotipo</button>


      </div>

    </div>
  </div>
</div>
</div>


<div id="myModalfoto" class="modal">
  <div class="modal-content">
    <span id="closefoto"> &times;</span>

    <form action="#" method="post" enctype="multipart/form-data">
      <div class="input-group mb-4 mt-4">
        <input type="file" accept="image/*" class="form-control" name="novo_logo">
        <button type="submit" class="btn btn-success">Alterar Foto</button>
      </div>
    </form>


    <img src="pdf/img/<?php echo $dadosdaempresa['caminhodologo']; ?>" alt="Logotipo">




    <br><br>
  </div>
</div>

<script>
  
  var btnfoto = document.getElementById("myBtnfoto");
    var modalfoto = document.getElementById("myModalfoto");
    var spanfoto = document.getElementById("closefoto");

    window.onclick = (event) => {
      if (event.target == modalfoto) {
        modalfoto.style.display = "none";
      }
    }

    btnfoto.addEventListener("click", () => {
      modalfoto.style.display = "block";
    })

    spanfoto.addEventListener("click", () => {
      modalfoto.style.display = "none";
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