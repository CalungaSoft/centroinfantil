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


$idmatriculaeconfirmacao = isset($_GET['idmatricula']) ? $_GET['idmatricula'] : "0";


$datadaavaliacao = isset($_GET['datadaavaliacao']) ? $_GET['datadaavaliacao'] : "0";
 
$dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

$idaluno = $dados_da_matriculaeconfirmacao["idaluno"];
$idanolectivo = $dados_da_matriculaeconfirmacao["idanolectivo"];
$idanolectivo_selecionado = $dados_da_matriculaeconfirmacao["idanolectivo"];

$dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao, "SELECT MONTH(datainicio) as mesinicio, MONTH(datafim) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafim) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

$anolectivo_selecionado = $dadosdoanolectivo["titulo"];


$dadosdoaluno = mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1"));



$dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

//verificar se já existe avaliação para essa data caso nao entao deixa em branco
$jaexiste = mysqli_num_rows(mysqli_query($conexao, "SELECT id FROM avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y') limit 1"));

if ($jaexiste == 0) {
  $dados_da_avaliacao[] = "";
  $dados_da_avaliacao["observacao"] = "";
}else{
  $dados_da_avaliacao = mysqli_fetch_array(mysqli_query($conexao, "select * from avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y') order by observacao desc limit 1"));

}



 


include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">


  <h1>Avaliando aluno</h1>
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Dados do aluno <a href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"]; ?>"><?php echo $dadosdoaluno["nomecompleto"]; ?></a> <?php if ($idmatriculaeconfirmacao != 0) {
                                                                                                                                                                          echo "( $dados_da_matriculaeconfirmacao[turma] | Sala $dados_da_matriculaeconfirmacao[sala] - $anolectivo_selecionado ) | $datadaavaliacao";
                                                                                                                                                                        } ?> </h1>

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




  <br> <br>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">



        <div class="form-group">
          <span>Observação sobre a avaliação do aluno</span>
          <textarea id="obsavaliacao" rows="3" class="form-control " title="Alguma observação?"><?php echo $dados_da_avaliacao["observacao"]; ?></textarea>
        </div>

        <form action="avaliacaodoaluno.php" method="get">
        <div class="form-group">
          <span>Data da realização da avaliação</span>
          <input type="text" name="datadaavaliacao" id="datadaavaliacao" autocomplete="off" class="form-control js-datepicker" title="Digite data da avaliação" placeholder="Data da Matrícula" value="<?php echo $datadaavaliacao; ?>">
        </div>

        <input type="hidden" name="idmatricula" value="<?php echo $idmatriculaeconfirmacao; ?>">
        <button type="submit" id="myBtn" class="btn btn-success">  <i class="fas fa-fw fa-eye"></i> Ver Resultado da avaliação para imprimir</button>

        </form>

        <br> <br>
        <span id="mensagemdealerta"></span>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Avaliação</th>
              <th>Categoria de Avaliação</th>
              <th>Sessão</th>
              <th>Sim</th>
              <th>Não</th>
              <th>Talvez</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $lista = mysqli_query($conexao, "select avaliacoesdosalunos.idavaliacao as idavaliacaoescolhida, tiposdeavalicoes.*, avaliacoesdosalunos.* from tiposdeavalicoes,avaliacoesdosalunos where avaliacoesdosalunos.idavaliacao=tiposdeavalicoes.id and avaliacoesdosalunos.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and avaliacoesdosalunos.datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y') order by tiposdeavalicoes.id desc");
            while ($exibir = $lista->fetch_array()) {

              $idcategoria = $exibir["idcategoria"];

              $categoria = mysqli_fetch_array(mysqli_query($conexao, "SELECT * from categoriasdeavaliacao where  id='$idcategoria'"));

              $idsessao = $categoria["idsessaodeavaliacao"];
              $sessao = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from sessoesdeavaliacao where  id='$idsessao'"))[0];

               $idavaliacao=$exibir["idavaliacaoescolhida"];
             
            ?>


              <tr>
                <td><?php echo $exibir['titulo']; ?> </td>
                <td> <?php echo $categoria["titulo"]; ?> </td>
                <td> <?php echo $sessao; ?> </td>
                <td>
                  <input type="radio" name="resposta[<?php echo $idavaliacao; ?>]" id="<?php echo $idavaliacao; ?>" value="Sim" <?php if($exibir["resposta"]=='Sim'){echo "checked"; } ?> >
                </td>
                <td>
                  <input type="radio" name="resposta[<?php echo $idavaliacao; ?>]" id="<?php echo $idavaliacao; ?>" value="Não" <?php if($exibir["resposta"]=='Não'){echo "checked"; } ?> > 
                </td>
                <td>
                  <input type="radio" name="resposta[<?php echo $idavaliacao; ?>]" id="<?php echo $idavaliacao; ?>" value="Talvez" <?php if($exibir["resposta"]=='Talvez'){echo "checked"; }  ?> >
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


<script>
  $(document).on("change", "input[name^='resposta']", function() {
    var idavaliacao = $(this).attr("id");
    var escolha = $(this).val();
    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;

    var datadaavaliacao = document.getElementById("datadaavaliacao").value;


    $.ajax({
      url: 'cadastro/escolhadeavaliacao.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao: idmatriculaeconfirmacao,
        escolha: escolha,
        idavaliacao: idavaliacao,
        datadaavaliacao
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);
      }
    })
  });



  $(document).on("blur", '#obsavaliacao', function() {

    var datadaavaliacao = document.getElementById("datadaavaliacao").value; 
    var obsavaliacao = document.getElementById("obsavaliacao").value;
    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;


    $.ajax({
      url: 'cadastro/obsavaliacao.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao: idmatriculaeconfirmacao,
        obsavaliacao: obsavaliacao,
        datadaavaliacao
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);
      }
    })
  });
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