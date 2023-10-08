 <?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];


  if(!( $painellogado=="areapedagogica" || $painellogado=="professor" || $painellogado=="secretaria2"  || $painellogado=="administrador")){
   header('Location: login.php');
}

    if(isset($_POST['cadastrarsaida'])){
      
      $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
      $valorasair=mysqli_escape_string($conexao, trim($_POST['valorasair']));  
      $valorparaconsolidar=mysqli_escape_string($conexao, trim($_POST['valorparaconsolidar']));  
      $idtipo=mysqli_escape_string($conexao, trim($_POST['tipo'])); 
      $idanolectivo=mysqli_escape_string($conexao, trim($_POST['idanolectivo']));  
      $formadesaida=mysqli_escape_string($conexao, trim($_POST['formadesaida']));  

    
 
      $tipo=mysqli_fetch_array(mysqli_query($conexao,"SELECT tipo FROM `tipodesaidas` where idtipodesaida='$idtipo'"))[0];
      $updating=mysqli_query($conexao,"UPDATE `tipodesaidas` SET `numerodesaida` = `numerodesaida`+'1' WHERE `tipodesaidas`.`idtipodesaida` = '$idtipo'");

      

         $salvar1=mysqli_query($conexao,"INSERT INTO `saidas` (`idsaida`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `datadasaida`, `idtipo`, idanolectivo, formadesaida) VALUES (NULL, '$idlogado', '$descricao', '$tipo', '$valorasair', '$valorparaconsolidar', CURRENT_TIMESTAMP, '$idtipo', '$idanolectivo', '$formadesaida')");

       if($salvar1){

            $mes=Date('m'); $ano=Date('Y');

            if(mysqli_num_rows(mysqli_query($conexao,"SELECT identrada FROM `entradas` where YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and idanolectivo='$idanolectivo'"))==0){

                 $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', 'Controlo', 'Outras', '0', '0', 0, CURRENT_TIMESTAMP, '', '$idanolectivo')");

            }
            
        $acertos[]="Registo de Saída cadastrado com sucesso!";
      }else{
        $erros[]="ocorreu algum erro!";
      } 

}
 
 
 $idanolectivo=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim'"))['idanolectivo'];

    if(isset($_POST['cadastrarentrada'])){
      
      $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
      $valorapagar=mysqli_escape_string($conexao, trim($_POST['valorapagar']));  
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));   
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));   
      
       

      $divida=round(($valorapagar-$valorpago), 2);
         $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', '$descricao', 'Outras', '$valorpago', '$divida', 0, CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");

       if($salvar){
      $acertos[]="Registo de entrada cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

}
 
  
            $ano_escolhido=date('Y');
            $mes_escolhido=date('m');
            $dia_escolhido=date('d');

            $dia1v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 6 DAY)"));
            $dia2v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 5 DAY)"));
            $dia3v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 4 DAY)"));
            $dia4v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 3 DAY)"));
            $dia5v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 2 DAY)"));
            $dia6v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 1 DAY)"));
            $dia7v = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and  Date(diadapresenca)<=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"));
          
            
      
             $salarionessemes = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado'"));

             $presencanessemes = mysqli_num_rows(mysqli_query($conexao,"SELECT idpresencaprofessor FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and totaldetempos!='0'"));

             $ausencianessemes = mysqli_num_rows(mysqli_query($conexao,"SELECT idpresencaprofessor FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and (YEAR(diadapresenca)='$ano_escolhido' and MONTH(diadapresenca)='$mes_escolhido') and presencaprofessores.idprofessor='$idlogado' and totaldetempos='0'"));


            $saidahoje = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"))[0];

            $totaldeaniversariantes=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where MONTH(datadenascimento)=MONTH(curdate())"));

            $totaldeActividades=mysqli_num_rows(mysqli_query($conexao, "select * from agenda where Week(datainicio)=Week(curdate())")); 


             $totaldelembretes=mysqli_num_rows(mysqli_query($conexao, "select * from lembretes where Week(datadolembrete)=Week(curdate())")); 
            
           
           for ($i=0; $i <=6 ; $i++) { 

            $dat=date('d-m-Y', strtotime("- $i days"));
 

              $datas[$i]=date('D', strtotime($dat)); 
                
           }
              $semana=array('Sun' =>'Domingo','Mon' =>'Segunda','Tue' =>'Terça','Wed' =>'Quarta', 'Thu' =>'Quinta','Fri' =>'Sexta','Sat' =>'Sábado');

          

           foreach ($datas as $key => $value) {

              $ultimos_sete_dias[]=$semana["$value"];
                
           }
 
              
        

            $anodehoje=date('Y');
  $mesdehoje=date('m');


 


   include("cabecalho.php"); ?>
 
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-500"><?php echo date("d"); echo "/"; echo date("m"); echo "/"; echo date("Y") ;?></h1>

               
          </div>
<?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

<?php 
            if(!empty($acertos)):
                        foreach($acertos as $acertos):
                          echo '<div class="alert alert-success">'.$acertos.'</div>';
                        endforeach;
                      endif;
 ?>

            
        <!-- Begin Page Content -->
        <div class="container-fluid">

    
    <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-3">
               <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Salário Acumulado mês actual</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php $n=number_format($salarionessemes[0],2,",", "."); echo $n; ?></div> <script>
 
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
          <a href="relatoriodiario.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&diadevenda=<?php echo "$dia_escolhido"; ?>&mesdevenda=<?php echo "$mes_escolhido"; ?>&anodevenda=<?php echo "$ano_escolhido"; ?>">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Fazer relatório diário de alunos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>  </a>
            </div>
          

 


            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-3">
            <a href="disciplinasareapedagogicaindividual.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Lançar Faltas">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Lançar Falta</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div> <script>
 
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lançar Notas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div> <script>
 
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
                  <h6 class="m-0 font-weight-bold text-primary">Salário acumulado Nos Últimos 7 dias </h6>
                  <div class="dropdown no-arrow">
                    
                   
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <script>

              

         
          // Area Chart Example
          var ctx = document.getElementById("myAreaChart");
          var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
          labels: ['<?php print $ultimos_sete_dias[6]?>', '<?php print $ultimos_sete_dias[5]?>', '<?php print $ultimos_sete_dias[4]?>', '<?php print $ultimos_sete_dias[3]?>', '<?php print $ultimos_sete_dias[2]?>', '<?php print $ultimos_sete_dias[1]?>', '<?php print $ultimos_sete_dias[0]?>'],
          datasets: [{
         label: "Restou",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.3)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [<?php print $dia1v[0]+0?>, <?php print $dia2v[0]+0?>, <?php print $dia3v[0]+0?>, <?php print $dia4v[0]+0?>, <?php print $dia5v[0]+0?>, <?php print $dia6v[0]+0?>, <?php print $dia7v[0]+0?>],
          }],
          },
          options: {
          maintainAspectRatio: false,
          layout: {
          padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
          }
          },
          scales: {
          xAxes: [{
          time: {
          unit: 'date'
          },
          gridLines: {
          display: false,
          drawBorder: false
          },
          ticks: {
          maxTicksLimit: 7
          }
          }],
          yAxes: [{
          ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
          return '$' + number_format(value);
          }
          },
          gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
          }
          }],
          },
          legend: {
          display: false
          },
          tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
          label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
          }
          }
          }
          }
          });


</script>
 
<!-- Content Row -->
            <!-- Pie Chart -->
            <div class="col-xl-3 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">No livro de Ponto</h6>
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
                      <i class="fas fa-circle text-success"></i> Presença 
                    </span> 
                    <span class="mr-2">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> Falta
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
    labels: ["Ausência", "Presença"],
    datasets: [{
      data: [<?php print $ausencianessemes?>,   <?php print $presencanessemes?>],
      backgroundColor: ['red',  'green'],
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


<?php

ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL);//force php to show any error message
 
$boncos=["escola"];
foreach ($boncos as $key => $value) {

    backup_tables('localhost','root','',$value);

}

function backup_tables($host,$user,$pass,$name)
{
    $link = mysqli_connect($host,$user,$pass);
    mysqli_select_db($link, $name);
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        $i=0;
        while($row = mysqli_fetch_row($result))
        {
            $tables[$i] = $row[0];
            $i++;
        }
    $return = "";
    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $return .= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysqli_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j < $num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j < ($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
    //save file
    $handle = fopen('db_bkp/db-'.$name.'-'.date('Y-m-d').'.sql','w+');//Don' forget to create a folder to be saved, "db_bkp" in this case
    fwrite($handle, $return);
    fclose($handle); 
}?>



 


