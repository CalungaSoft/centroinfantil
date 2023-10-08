    <?php
    include("conexao.php");


    session_start();

    if (!isset($_SESSION['logado'])) :
        header('Location: login.php');
    endif;

    $nome = $_SESSION['nomedoalunologado'];

    $idlogado = $_SESSION['alunologado'];
    $nomelogado = $_SESSION['nomedoalunologado'];
    $painellogado = $_SESSION['painel'];


    $hojemes = date('m');
    $hojeano = date('Y');
    $mes = isset($_GET['mes']) ? $_GET['mes'] : "$hojemes";
    $ano = isset($_GET['ano']) ? $_GET['ano'] : "$hojeano";

    $mes_escolhido = mysqli_escape_string($conexao, $mes);
    $ano = mysqli_escape_string($conexao, $ano);

    $iddisciplina = isset($_GET['iddisciplina']) ? $_GET['iddisciplina'] : "";

    $dadosdadisciplina = mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1"));

    if (!(($dadosdadisciplina["idprofessor"] == $idlogado || $dadosdadisciplina["idprofessorauxiliar"] == $idlogado) || $painellogado == "areapedagogica" || $painellogado == "administrador")) {
        header('Location: login.php');
    }


    include("cabecalho.php"); ?>

    <?php



    $idprofessor = $dadosdadisciplina["idprofessor"];
    $idprofessorauxiliar = $dadosdadisciplina["idprofessorauxiliar"];

    $professor = mysqli_fetch_array(mysqli_query($conexao, "select nomedoaluno from alunos where idaluno='$idprofessor' limit 1"))[0];

    $professorauxiliar = mysqli_fetch_array(mysqli_query($conexao, "select nomedoaluno from alunos where idaluno='$idprofessorauxiliar' limit 1"))[0];

    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading --><?php include("estilocarde.php"); ?>
        <h1 class="h3 mb-4 text-gray-800">Lançando faltas e presença no Sistema | <?php echo $mes_escolhido; ?>/<?php echo $ano; ?> </h1>
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

                    <input type="hidden" name="iddisciplina" value="<?php echo $dadosdadisciplina["iddisciplina"]; ?>">

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
                        <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                    </div>
                </form>
            </div>
        </div>
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


        <br><br>
        <div class="col-lg">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dados da disciplina</h6>
                    <div class="dropdown no-arrow">

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">



                    <!-- Earnings (Monthly) Card Example -->
                    <div class="row">



                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">disciplina</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="disciplina.php?iddisciplina=<?php echo $dadosdadisciplina["iddisciplina"]; ?>"><?php echo $dadosdadisciplina["titulo"]; ?></a></div> <br>

                                                     Abreviatura: <strong> <?php echo $dadosdadisciplina["abreviatura"]; ?> </strong> <br>

                                                     Tipo de Disciplina: <strong> <?php echo $dadosdadisciplina["tipodedisciplina"]; ?> </strong> <br>

                                                     Agrupamento: <strong> <?php echo $dadosdadisciplina["agrupamento"]; ?> </strong> <br>

                                                     Observações: <strong> <?php echo $dadosdadisciplina["obs"]; ?> </strong> <br><br><br>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dados Lectivo</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                                    <p id="mostra1"> <br>



                                                        <?php

                                                        $anolectivo = mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where vigor='Sim'"));

                                                        $idanolectivo = $anolectivo["idanolectivo"];


                                                        $idturma = $dadosdadisciplina["idturma"];
                                                        $dadosdaturma = mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1"));

                                                        $turma = $dadosdaturma["titulo"];
                                                        $idperiodo = $dadosdaturma["idperiodo"];
                                                        $idcurso = $dadosdaturma["idcurso"];
                                                        $idsala = $dadosdaturma["idsala"];
                                                        $idclasse = $dadosdaturma["idclasse"];



                                                        $periodo = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                                                        $curso = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                                                        $sala = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from salas where idsala='$idsala'"))[0];

                                                        $classe = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from classes where idclasse='$idclasse'"))[0];

                                                        ?>

                                                         Ano Lectivo: <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo["titulo"]; ?> </a><br>

                                                         Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a><br>

                                                         Curso: <a href="curso.php?idcurso=<?php echo $idcurso; ?>"> <?php echo $curso; ?> </a><br>

                                                         Classe: <a href="classe.php?idclasse=<?php echo $idclasse; ?>"> <?php echo $classe; ?> </a><br>

                                                         Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                                                         Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a>
                                                        <br><br>


                                                         Porfessor: <strong> <a href="idaluno.php?idaluno=<?php echo $idprofessor; ?>"><?php echo $professor; ?></a> </strong> <br>

                                                         Porfessor Auxiliar: <strong> <a href="idaluno.php?idaluno=<?php echo $idprofessorauxiliar; ?>"><?php echo $professorauxiliar; ?></a> </strong> <br>



                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!-- End of Main Content -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Faltas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <span id="mensagemdealerta"></span>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <?php
                                $totaldedias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                                for ($i = 1; $i <= $totaldedias; $i++) {  ?>
                                    <th><?php echo  $i; ?></th>
                                <?php } ?>
                                <th>Total(falta)</th>
                                <th>Total(a pagar)</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php

                            $totalAReceberDeFalta = 0;
                            $toalDeDaltas = 0;

                            $lista_de_aluno = mysqli_query($conexao, "select alunos.nomecompleto, matriculas.* from matriculas, alunos where matriculas.idaluno=alunos.idaluno and matriculas.idturma='$idturma'");
                            $salariodetodos = 0;

                            $precoDaFalta = mysqli_fetch_array(mysqli_query($conexao, "select precodafalta from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                            while ($exibir = $lista_de_aluno->fetch_array()) {

                                $idmatricula = $exibir["idmatricula"];


                            ?>
                                <tr>
                                    <td title="Salário por dia: <?php echo $salariopordia; ?>"><a href="aluno.php?idaluno=<?php echo $idaluno; ?>"><?php echo $exibir['nomecompleto']; ?></a></td>

                                    <?php

                                    $numerodeFalta = 0;

                                    for ($i = 1; $i <= $totaldedias; $i++) {

                                        $data = "$i-$mes-$ano";

                                        $data_falta = "$ano-$mes-$i";

                                        $cor = "red";
                                        $imprimir = "";
                                        $falta = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM faltas where idmatricula='$idmatricula' and data='$data_falta' limit 1"));


                                        $imprimir = "$falta[falta]";
                                        if (date('N', strtotime($data)) == 6) {
                                            $cor = "yellow";
                                        } else if (date('N', strtotime($data)) == 7) {
                                            $cor = 'rgb(255,135,135)';
                                        } else {
                                            $cor = '';
                                        }

                                        if ($imprimir == 'F' || $imprimir == 'f') {
                                            $numerodeFalta++;
                                        }



                                    ?>
                                        <td class="update" data-id="<?php echo $idmatricula; ?>" data-column="<?php echo $i; ?>" style="background-color: <?php echo $cor; ?>;" contenteditable><strong><?php echo $imprimir; ?></strong></td>
                                    <?php }

                                    $valordaFalta = $numerodeFalta * $precoDaFalta;

                                    $totalAReceberDeFalta += $valordaFalta;
                                    $toalDeDaltas += $numerodeFalta;

                                    $valordaFalta_f = number_format($valordaFalta, 2);

                                    ?>
                                    <td><?php echo $numerodeFalta; ?></td>
                                    <td><?php echo $valordaFalta_f; ?> Kz</td>
                                </tr>
                            <?php } ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Total</strong></td>
                                <?php for ($i = 1; $i <= $totaldedias; $i++) { ?>
                                    <td></td>
                                <?php } ?>
                                <td><strong><?php echo $toalDeDaltas; ?></strong></td>
                                <td><strong><?php $n = number_format($totalAReceberDeFalta, 2, ",", ".");
                                            echo $n; ?> Kz</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->



    </div>
    <!-- End of Main Content -->
  
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

    <script>
       

        $(document).on("blur", ".update", function() {
            var idmatricula = $(this).data("id");
            var dia = $(this).data("column");
            var falta = $(this).text();

            var ano = <?php echo $ano; ?>;
            var mes = <?php echo $mes; ?>;
            var iddisciplina = <?php echo $iddisciplina; ?>;

            $.ajax({
                url: 'cadastro/lancarfalta.php',
                method: 'POST',

                data: {
                    idmatricula,
                    dia,
                    falta,
                    ano,
                    mes,
                    iddisciplina
                },

                success: function(data) {
                    $("#mensagemdealerta").html(data); 
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

    <!-- Jquery JS-->
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

    </body>

    </html>