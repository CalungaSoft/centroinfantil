<?php
include("conexao.php");



session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedoalunologado'];

$nomelogado = $_SESSION['nomedoalunologado'];
$painellogado = $_SESSION['painel'];

$idalunologado = $_SESSION['idalunologado'];

if (!($painellogado == "aluno")) {
  header('Location: login.php');
}

$idaluno = $idalunologado;

$idaluno = isset($_GET['idaluno']) ? $_GET['idaluno'] : "";

include("cabecalhoaluno.php"); ?>

<?php

$dadosdoaluno = mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1"));


?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Finanças do aluno</h1>

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



  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Histórico</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">



        <br><br>




        <span id="mensagemdealerta">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                   <tr>
                     <th>Funcionário</th>
                     <th>Descrição</th>
                     <th>Categoria</th>
                     <th>Valor</th>
                     <th>Dívida</th>
                     <th>Data</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php


                    $registrosdeentradas = mysqli_query($conexao, "select entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios where funcionarios.idfuncionario=entradas.idfuncionario and entradas.idaluno='$idalunologado' order by entradas.identrada desc limit 10");


                    ?>



                   <?php


                    $total_valor = 0;
                    $total_divida = 0;

                    while ($exibir = $registrosdeentradas->fetch_array()) {

                      $idaluno = $exibir["idaluno"];

                      $total_valor += $exibir["valor"];
                      $total_divida += $exibir["divida"];



                    ?>

                     <tr>
                       <td><?php echo $exibir['nomedofuncionario']; ?></td>
                       <td><?php echo $exibir["descricao"]; ?></td>
                       <td><?php echo $exibir["tipo"]; ?></td>
                       <td title="<?php $valor = number_format($exibir["valor"], 2, ",", ".");
                                  echo $valor; ?>"><?php echo $exibir["valor"]; ?></td>
                       <td title="<?php $divida = number_format($exibir["divida"], 2, ",", ".");
                                  echo $divida; ?>"><?php echo $exibir["divida"]; ?></td>
                       <td><?php echo $exibir["datadaentrada"]; ?></td>

                     </tr>
                   <?php }

                    $total_valor = number_format($total_valor, 2, ",", ".");
                    $total_divida = number_format($total_divida, 2, ",", ".");

                    ?>
                 </tbody>
                 <?php if ($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2") { ?>
                   <tfoot>
                     <th>Total</th>
                     <th></th>
                     <th></th>
                     <th><?php echo $total_valor; ?></th>
                     <th><?php echo $total_divida; ?></th>
                     <th></th>
                     <th></th>
                   </tfoot>
                 <?php } ?>
               </table>
        </span>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->



</div>
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