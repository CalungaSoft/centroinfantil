<?php include("conexao.php");


session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];

$resultadosPorPagina = 200; // Número de resultados por página
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual

$limite = ($paginaAtual - 1) * $resultadosPorPagina;



if (!($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2")) {

  header('Location: login.php');
}

include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Realizar Venda</h1>
  <p class="mb-4">Abaixo vai a lista de todos os alunos da Escola, se for um aluno novo, cadastre-o primeiro.</p>

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



  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de alunos</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nome</th>
              <?php if ($painellogado == "administrador") { ?>
                <th>Valor Agregado</th>
              <?php } ?>
              <th>Dívida</th>
              <th title="Número de vezes em que o aluno comprou na Escola">Nº de Compras</th>
              <th>Localização</th>
              <th title="Última vez que o aluno comprou na Escola">Última Compra</th>
              <th>Opção</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $listadealunos = mysqli_query($conexao, "SELECT * FROM alunos where estatus='activo' order by nomecompleto asc LIMIT $limite, $resultadosPorPagina");
            while ($exibir = $listadealunos->fetch_array()) {
              $idaluno = $exibir['idaluno'];

              $valoragregado = mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where  entradas.idaluno='$idaluno'"))[0] + 0;
              $valoremdivida = mysqli_fetch_array(mysqli_query($conexao, "select sum(divida) FROM entradas where entradas.idaluno='$idaluno'"))[0] + 0;
              $numerodecompras = mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM compras where idaluno='$idaluno'"));

              $ultimacompra = mysqli_fetch_array(mysqli_query($conexao, "select data FROM compras where idaluno='$idaluno' order by data desc limit 1"));


              if ($ultimacompra) {
                $ultimacompra = $ultimacompra[0];
              } else {
                $ultimacompra = '';
              }


            ?>
              <tr>
                <td><a href="aluno.php?idaluno=<?php echo $exibir['idaluno']; ?>"><?php echo $exibir['nomecompleto']; ?></a></td>
                <?php if ($painellogado == "administrador") { ?>
                  <td title="<?php $n = number_format($valoragregado, 2, ",", ".");
                              echo $n; ?>"><?php echo $valoragregado; ?></td>
                <?php } ?>
                <td title="<?php $n = number_format($valoremdivida, 2, ",", ".");
                            echo $n; ?>"><?php echo $valoremdivida; ?></td>
                <td><?php echo $numerodecompras; ?></td>
                <td><?php echo $exibir["morada"]; ?></td>
                <td><?php echo $ultimacompra; ?></td>
                <td><a href="realizarvenda.php?idaluno=<?php echo $exibir["idaluno"]; ?>"><button class="btn btn-success vender" title="Escolher esse aluno para realizar venda">Vender<i style="color:green;" class="fas fa-fw fa-dollar-sign"></i></button></a></td>
              </tr>
            <?php }
            
            
                              function totalResultados($conexao) {
                                $sql = "SELECT COUNT(*) AS total FROM alunos WHERE estatus='activo'";
                                $resultado = mysqli_query($conexao, $sql);
                                $row = mysqli_fetch_assoc($resultado);
                            
                                if ($row) {
                                    return $row['total'];
                                }
                            
                                return 0; // Retorna 0 se não houver resultados
                            }
                            
                        // Crie links de páginação para as páginas anteriores e seguintes
                        $totalResultados = totalResultados($conexao); // Obtém o número total de resultados
                        $totalPaginas = ceil($totalResultados / $resultadosPorPagina); // Calcula o número total de páginas
                        
                       

?>
          </tbody>
        </table>
                      <?php

                      // Link para a página anterior
              if ($paginaAtual > 1) {
                  echo '<a class="btn btn-primary ml-2" href="?pagina=' . ($paginaAtual - 1) . '">Página anterior</a>';
              }

              // Links para páginas intermediárias
              for ($i = 1; $i <= $totalPaginas; $i++) {
                  echo '<a class="btn btn-primary ml-2" href="?pagina=' . $i . '">' . $i . '</a>';
              }

              // Link para a próxima página
              if ($paginaAtual < $totalPaginas) {
                  echo '<a class="btn btn-primary ml-2" href="?pagina=' . ($paginaAtual + 1) . '">Próxima página</a>';
              }?>


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