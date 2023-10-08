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

  $idanolectivo = mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim'"))['idanolectivo'];

  $idmatriculaeconfirmacao_selecionado = mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idanolectivo='$idanolectivo'"))[0];



  $ano_escolhido = date('Y');
  $mes_escolhido = date('m');
  $dia_escolhido = date('d');





  $anodehoje = date('Y');
  $mesdehoje = date('m');


  $divida_com_a_instituicao = mysqli_fetch_array(mysqli_query($conexao, "SELECT sum(divida) FROM `entradas` where idaluno='$idalunologado'"))[0] + 0;
  $divida_com_a_instituicao_f = number_format($divida_com_a_instituicao, 2, ",", ".");


  $media_das_notas = mysqli_fetch_array(mysqli_query($conexao, "SELECT avg(valordanota) FROM `notas` where idmatriculaeconfirmacao='$idmatriculaeconfirmacao_selecionado'"))[0] + 0;
  $faltas = mysqli_fetch_array(mysqli_query($conexao, "SELECT sum(falta) FROM `faltas` where idmatriculaeconfirmacao='$idmatriculaeconfirmacao_selecionado'"))[0] + 0;
  $numero_de_relatorio = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM relatoriodiario WHERE data >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND data <= CURDATE() and idmatriculaeconfirmacao='$idmatriculaeconfirmacao_selecionado'"))+0;

  $idturma = mysqli_fetch_array(mysqli_query($conexao, "SELECT idturma FROM `matriculaseconfirmacoes` where idmatriculaeconfirmacao='$idmatriculaeconfirmacao_selecionado'"))[0];
  
  $minumoParaPositiva=mysqli_fetch_array(mysqli_query($conexao, "SELECT minimoparapositiva FROM `turmas` where idturma='$idturma'"))[0];

  $numero_de_positivas=mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM notas WHERE valordanota >= '$minumoParaPositiva' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao_selecionado'"))+0;
  $numero_de_negativas=mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM notas WHERE valordanota < '$minumoParaPositiva' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao_selecionado'"))+0;

  include("cabecalhoaluno.php"); ?>

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h4 mb-0 text-gray-500"><?php echo date("d");
                                      echo "/";
                                      echo date("m");
                                      echo "/";
                                      echo date("Y"); ?></h1>


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


 <!-- Begin Page Content -->
 <div class="container-fluid">


   <!-- Content Row -->
   <div class="row">

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-3">
       <div class="card border-left-danger shadow h-100 py-2">
         <div class="card-body">
           <div class="row no-gutters align-items-center">
             <div class="col mr-2">
               <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dívida com a instituição</div>
               <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $divida_com_a_instituicao_f; ?></div>
               <script>

               </script>
             </div>
             <div class="col-auto">
               <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
             </div>
           </div>
         </div>
       </div>
     </div>


     <!-- Earnings (Monthly) Card Example -->

     <div class="col-xl-3 col-md-6 mb-3">
       
         <div class="card border-left-warning shadow h-100 py-2">
           <div class="card-body">
             <div class="row no-gutters align-items-center">
               <div class="col mr-2" title="Corresponde a Média Aritmética">
                 <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sua Média de notas</div>
                 <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $media_das_notas; ?></div>
               </div>
               <div class="col-auto">
                 <i class="fas fa-user fa-2x text-gray-300"></i>
               </div>
             </div>
           </div>
         </div>
       
     </div>






     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-3">
       <a href="disciplinasareapedagogicaindividual.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Lançar Faltas">
         <div class="card border-left-danger shadow h-100 py-2">
           <div class="card-body">
             <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                 <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Faltas </div>
                 <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $faltas; ?></div>

                 </script>
               </div>
               <div class="col-auto">
                 <i class="fas fa-calendar fa-2x text-gray-300"></i>
               </div>
             </div>
           </div>
         </div>
       </a>
     </div>


     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-3">
       <a href="disciplinasareapedagogicaindividual.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Lançar Notas">
         <div class="card border-left-info shadow h-100 py-2">
           <div class="card-body">
             <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                 <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Relatório</div>
                 <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numero_de_relatorio; ?></div>

                 </script>
               </div>
               <div class="col-auto">
                 <i class="fas fa-book fa-2x text-gray-300"></i>
               </div>
             </div>
           </div>
         </div>
       </a>
     </div>


     <div class="row">

       <!-- Area Chart -->
       <div class="col-xl-9 col-lg-7">
         <div class="card shadow mb-4">
           <!-- Card Header - Dropdown -->
           <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary">Últimas Transações</h6>
             <div class="dropdown no-arrow">


             </div>
           </div>
           <!-- Card Body -->
           <div class="card-body">




             <div class="table-responsive">
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

             </div>
           </div>
         </div>
       </div>

       <!-- Content Row -->
       <!-- Pie Chart -->
       <div class="col-xl-3 col-lg-5">
         <div class="card shadow mb-4">
           <!-- Card Header - Dropdown -->
           <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary">Notas</h6>
             <div class="dropdown no-arrow">

             </div>
           </div>
           <!-- Card Body -->
           <div class="card-body">
             <div class="chart-pie pt-4 pb-2">
               <canvas id="myPieChart"></canvas>
             </div>
             <div class="mt-4 text-center small">
               <span class="mr-2">
                 <i class="fas fa-circle text-success"></i> Positivas
               </span>
               <span class="mr-2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               </span>
               <span class="mr-2">
                 <i class="fas fa-circle text-danger"></i> Negativas
               </span>
             </div>
           </div>
         </div>
       </div>
     </div>
     <script>
       // Pie Chart Example
       var ctx = document.getElementById("myPieChart");
       var myPieChart = new Chart(ctx, {
         type: 'doughnut',
         data: {
           labels: ["Negativas", "Positivas"],
           datasets: [{
             data: [<?php print $numero_de_negativas ?>, <?php print $numero_de_positivas ?>],
             backgroundColor: ['red', 'green'],
             hoverBackgroundColor: ['red', 'green'],
             hoverBorderColor: "rgba(234, 236, 244, 1)",
           }],
         },
         options: {
           maintainAspectRatio: false,
           tooltips: {
             backgroundColor: "rgb(255,255,255)",
             bodyFontColor: "#858796",
             borderColor: '#dddfeb',
             borderWidth: 1,
             xPadding: 15,
             yPadding: 15,
             displayColors: false,
             caretPadding: 10,
           },
           legend: {
             display: false
           },
           cutoutPercentage: 80,
         },
       });
     </script>

     <!-- /.container-fluid -->

   </div>
   <!-- End of Main Content -->
 </div>
 <!-- End of Main Content -->
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
 <script src="vendor/select2/select2.min.js"></script>
 <script src="vendor/datepicker/moment.min.js"></script>
 <script src="vendor/datepicker/daterangepicker.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="vendor/chart.js/Chart.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="js/demo/chart-area-demo.js"></script>
 <script src="js/demo/chart-pie-demo.js"></script>

 <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="js/demo/datatables-demo.js"></script>


 <!-- Jquery JS-->
 <script src="vendor/jquery/jquery.min.js"></script>
 <!-- Vendor JS-->
 <script src="vendor/select2/select2.min.js"></script>
 <script src="vendor/datepicker/moment.min.js"></script>
 <script src="vendor/datepicker/daterangepicker.js"></script>

 <!-- Main JS-->
 <script src="js/global.js"></script>

 </body>

 </html>