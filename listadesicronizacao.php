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


// CREATE TABLE historico_sincronizacao (
//     id INT AUTO_INCREMENT PRIMARY KEY, 
//     datadasicronizacao DATETIME NOT NULL,
//     numeroderegistrossicronizados INT NOT NULL
// );




include("cabecalho.php"); ?>
<?php include("estilocarde.php"); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Histórico de Sincronizações</h1>

    <button id="myBtn" class="btn btn-info">Sicronizar banco de dados</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="close">&times;</span>
            <form class="user" method="post" action="">
                <h3>Sicronizar</h3> <br>


                <div class="form-group">
                    <label for="dataHora">Data e Hora:</label>
                    <input type="datetime-local" class="form-control" id="dataHora" name="dataHora">
                </div>
                <br>
                <input type="submit" name="cadastrar" value="Sicronizar dados com banco de lados online" class="btn btn-success" style="float: rigth;">

            </form>
        </div>
    </div>

    <br><br>
    <!-- Script para lidar com o modal -->
    <script>
        document.getElementById('viewSyncDataBtn').addEventListener('click', function() {
            var dataModificacao = document.getElementById('dataModificacao').value;
            // Aqui você pode fazer algo com a data de modificação, como enviar para o servidor e obter os dados de sincronização
            // Exemplo: fazer uma requisição AJAX para obter os dados
            // Após obter os dados, você pode exibi-los em uma tabela ou qualquer outra forma que desejar
            // Exemplo de código AJAX (requer a biblioteca jQuery):
            /*
            $.ajax({
                url: 'obter_dados_sincronizacao.php',
                type: 'GET',
                data: { dataModificacao: dataModificacao },
                success: function(response) {
                    // Exibir os dados obtidos, por exemplo, em uma tabela ou div
                },
                error: function() {
                    // Tratar erros, se necessário
                }
            });
            */
        });
    </script>



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


    <!-- Tabela de Sincronizações -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Sincronizações</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Data da Sincronização</th>
                            <th>Número de Registros Sincronizados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obter a lista de sincronizações ordenadas por data
                        $query_sincronizacoes = "SELECT datadasicronizacao, numeroderegistrossicronizados FROM historico_sincronizacao ORDER BY datadasicronizacao DESC";
                        $result_sincronizacoes = $conexao->query($query_sincronizacoes);

                        if ($result_sincronizacoes->num_rows > 0) {
                            while ($row_sincronizacao = $result_sincronizacoes->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row_sincronizacao['datadasicronizacao'] . "</td>";
                                echo "<td>" . $row_sincronizacao['numeroderegistrossicronizados'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>

<!-- /.container-fluid -->


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