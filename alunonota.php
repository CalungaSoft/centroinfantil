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
$idanolectivo_selecionado = isset($_GET['idanolectivo']) ? $_GET['idanolectivo'] : "4";


$idmatriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idalunologado' and idanolectivo='$idanolectivo_selecionado' order by idaluno desc limit 1"))[0];


$dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

$dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao, "SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

include("cabecalhoaluno.php"); ?>

<?php

$dadosdoaluno = mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1"));


?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Notas da Mini Pai</h1>

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
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Disciplina</th>
                                <th>Relatório</th>
                                <th>Data</th>
                                <th>Opção</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lista_relatorio = mysqli_query($conexao, "SELECT    matriculaseconfirmacoes.classe,matriculaseconfirmacoes.estatus, relatoriodiario.* from relatoriodiario, matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and relatoriodiario.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao  and relatoriodiario.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' order by data desc");
                            $n = 0;

                            while ($exibir_relatorio = $lista_relatorio->fetch_array()) {

                                $n++;


                                $iddisciplina = $exibir_relatorio["iddisciplina"];

                                $nomedadisciplina = mysqli_fetch_array(mysqli_query($conexao, "select titulo from disciplinas where iddisciplina='$iddisciplina' limit 1"))[0];



                            ?>
                                <tr>
                                    <td><?php echo $n; ?></td>
                                    <td> <a href="diciplina.php?iddiciplina=<?php echo $exibir_relatorio["iddiciplina"]; ?>"> <?php echo $nomedadisciplina; ?> </a> </td>
                                    <td class="update" data-id="<?php echo $exibir_relatorio["idrelatoriodiario"]; ?>" data-column="descricao" <?php if ($exibir_relatorio["idprofessor"] == $idlogado) { ?> contenteditable <?php } ?>><?php echo $exibir_relatorio['descricao']; ?></td>
                                    <td class="update" data-id="<?php echo $exibir_relatorio["idrelatoriodiario"]; ?>" data-column="data" <?php if ($exibir_relatorio["idprofessor"] == $idlogado) { ?> contenteditable <?php } ?>><?php echo $exibir_relatorio['data']; ?></td>

                                    <td align="center" title="Eliminar Relatório">
                                        <?php if ($exibir_relatorio["idprofessor"] == $idlogado) { ?>
                                            <a href="" class="delete" id="<?php echo $exibir_relatorio["idrelatoriodiario"]; ?>"><i style="color:red" title="Eliminar esse relatório" class="fas fa-trash"></i></a>
                                        <?php }  ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
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