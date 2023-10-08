<?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

            $dia1v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='01'"));
            $dia2v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='02'"));
            $dia3v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='03'"));
            $dia4v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='04'"));
            $dia5v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='05'"));
            $dia6v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='06'"));
            $dia7v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='07'"));
            $dia8v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='08'"));
            $dia9v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='09'"));
            $dia10v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='10'")); 

            $dia11v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='11'"));
            $dia12v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='12'"));
            $dia13v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='13'"));
            $dia14v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='14'"));
            $dia15v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='15'"));
            $dia16v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='16'"));
            $dia17v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='17'"));
            $dia18v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='18'"));
            $dia19v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='19'"));
            $dia20v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='20'"));
            $dia21v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='21'"));
            $dia22v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='22'"));
            $dia23v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='23'"));
            $dia24v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='24'"));
            $dia25v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='25'"));
            $dia26v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='26'"));
            $dia27v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='27'"));
            $dia28v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='28'"));
            $dia29v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='29'"));
            $dia30v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='30'"));
            $dia31v = mysqli_num_rows(mysqli_query($conexao,"select distinct(MONTH(data)) from compra where (DAY(data))='31'"));
      


            $dia1v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='01'"))[0]/($dia1v+0.000001));
            $dia2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='02'"))[0]/($dia2v+0.000001));
            $dia3v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='03'"))[0]/($dia3v+0.000001));
            $dia4v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='04'"))[0]/($dia4v+0.000001));
            $dia5v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='05'"))[0]/($dia5v+0.000001));
            $dia6v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='06'"))[0]/($dia6v+0.000001));
            $dia7v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='07'"))[0]/($dia7v+0.000001));
            $dia8v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='08'"))[0]/($dia8v+0.000001));
            $dia9v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='09'"))[0]/($dia9v+0.000001));
            $dia10v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='10'"))[0]/($dia10v+0.000001));
            $dia11v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='11'"))[0]/($dia11v+0.000001));
            $dia12v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='12'"))[0]/($dia12v+0.000001));
            $dia13v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='13'"))[0]/($dia13v+0.000001));
            $dia14v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='14'"))[0]/($dia14v+0.000001));
            $dia15v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='15'"))[0]/($dia15v+0.000001));
            $dia16v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='16'"))[0]/($dia16v+0.000001));
            $dia17v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='17'"))[0]/($dia17v+0.000001));
            $dia18v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='18'"))[0]/($dia18v+0.000001));
            $dia19v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='19'"))[0]/($dia19v+0.000001));
            $dia20v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='20'"))[0]/($dia20v+0.000001)); 
            $dia21v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='21'"))[0]/($dia21v+0.000001));
            $dia22v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='22'"))[0]/($dia22v+0.000001));
            $dia23v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='23'"))[0]/($dia23v+0.000001));
            $dia24v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='24'"))[0]/($dia24v+0.000001));
			$dia25v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='25'"))[0]/($dia25v+0.000001)); 
            $dia26v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='26'"))[0]/($dia26v+0.000001));
            $dia27v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='27'"))[0]/($dia27v+0.000001));
            $dia28v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='28'"))[0]/($dia28v+0.000001));
            $dia29v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='29'"))[0]/($dia29v+0.000001));
			$dia30v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='30'"))[0]/($dia30v+0.000001)); 
            $dia31v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where (DAY(data))='31'"))[0]/($dia31v+0.000001)); 
            
			




            $dia1= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='01'"))[0]+0;
            $dia2= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='02'"))[0]+0;
            $dia3= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='03'"))[0]+0;
            $dia4= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='04'"))[0]+0;
            $dia5= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='05'"))[0]+0;
            $dia6= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='06'"))[0]+0;
            $dia7= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='07'"))[0]+0;
            $dia8= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='08'"))[0]+0;
            $dia9= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='09'"))[0]+0;
            $dia10= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='10'"))[0]+0;
            $dia11= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='11'"))[0]+0;
            $dia12= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='12'"))[0]+0;
            $dia13= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='13'"))[0]+0;
            $dia14= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='14'"))[0]+0;
            $dia15= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='15'"))[0]+0;
            $dia16= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='16'"))[0]+0;
            $dia17= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='17'"))[0]+0;
            $dia18= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='18'"))[0]+0;
            $dia19= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='19'"))[0]+0;
            $dia20= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='20'"))[0]+0;
            $dia21= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='21'"))[0]+0;
            $dia22= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='22'"))[0]+0;
            $dia23= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='23'"))[0]+0;
            $dia24= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='24'"))[0]+0;
			$dia25= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='25'"))[0]+0;
            $dia26= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='26'"))[0]+0;
            $dia27= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='27'"))[0]+0;
            $dia28= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='28'"))[0]+0;
            $dia29= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='29'"))[0]+0;
			$dia30= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='30'"))[0]+0;
            $dia31= mysqli_fetch_array(mysqli_query($conexao,"select sum(quantidade) from compra where YEAR(CURDATE())=YEAR(data) AND MONTH(CURDATE())=MONTH(data)  AND DAY(data)='31'"))[0]+0; 

   include("cabecalho.php")?>
    <div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Estatísticas de Vendas por dias</h1>

         
                    
    

          <!-- Content Row -->
          <div class="row">

            
            
 


           

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Veja quais dias há o maior média de número de vendas</h6>
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
          labels: ["1", "2", "3", "4", "5", "6","7", "8", "9",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
          datasets: [{
          label: "Número de Produtos Vendidos:",
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
          data: [<?php print $dia1v?>, <?php print $dia2v?>, <?php print $dia3v?>, <?php print $dia4v?>, <?php print $dia5v?>, <?php print $dia6v?>, <?php print $dia7v?>, <?php print $dia8v?>, <?php print $dia9v?>, <?php print $dia10v?>, <?php print $dia11v?>, <?php print $dia12v?>, <?php print $dia13v?>, <?php print $dia14v?>, <?php print $dia15v?>, <?php print $dia16v?>, <?php print $dia17v?>, <?php print $dia18v?>, <?php print $dia19v?>, <?php print $dia20v?>, <?php print $dia21v?>, <?php print $dia22v?>, <?php print $dia23v?>, <?php print $dia24v?>, <?php print $dia25v?>, <?php print $dia26v?>, <?php print $dia27v?>, <?php print $dia28v?>, <?php print $dia29v?>, <?php print $dia30v?>, <?php print $dia31v?>],
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
          return number_format(value);
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
          backgroundColor: "rgb(255,255,600)",
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
          return datasetLabel  + number_format(tooltipItem.yLabel);
          }
          }
          }
          }
          });


</script>
 
<!-- Content Row -->
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
               
          </div>
<script>
  
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [" Produtos Esgotados", "Produtos muito procurado", "Produtos Nunca vendidos"],
    datasets: [{
      data: [<?php print $totaldeprodutosesgotados?>, <?php print 5?>, <?php print 2?>],
      backgroundColor: ['red', 'green', 'blue'],
      hoverBackgroundColor: ['red', 'green', 'blue'],
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
      </div>
      <!-- End of Main Content -->


      

        
      
      <br><br><br><br>
      

           

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Veja as vendas no mês actual e compare-as com a média dos outros meses</h6>
                  <div class="dropdown no-arrow">
                    
                   
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <div style="width:100%;">
		<canvas id="canvas"></canvas>
	</div> 
	<script>
	
		var config = {
			type: 'line',
			data: {
				labels: ["1", "2", "3", "4", "5", "6","7", "8", "9",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
				datasets: [{
					label: 'Nº de Vendas: Outros Meses',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [<?php print $dia1v?>, <?php print $dia2v?>, <?php print $dia3v?>, <?php print $dia4v?>, <?php print $dia5v?>, <?php print $dia6v?>, <?php print $dia7v?>, <?php print $dia8v?>, <?php print $dia9v?>, <?php print $dia10v?>, <?php print $dia11v?>, <?php print $dia12v?>, <?php print $dia13v?>, <?php print $dia14v?>, <?php print $dia15v?>, <?php print $dia16v?>, <?php print $dia17v?>, <?php print $dia18v?>, <?php print $dia19v?>, <?php print $dia20v?>, <?php print $dia21v?>, <?php print $dia22v?>, <?php print $dia23v?>, <?php print $dia24v?>, <?php print $dia25v?>, <?php print $dia26v?>, <?php print $dia27v?>, <?php print $dia28v?>, <?php print $dia29v?>, <?php print $dia30v?>, <?php print $dia31v?>],
					fill: false,
				}, {
					label: 'Mês actual',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data:[<?php print $dia1?>, <?php print $dia2?>, <?php print $dia3?>, <?php print $dia4?>, <?php print $dia5?>, <?php print $dia6?>, <?php print $dia7?>, <?php print $dia8?>, <?php print $dia9?>, <?php print $dia10?>, <?php print $dia11?>, <?php print $dia12?>, <?php print $dia13?>, <?php print $dia14?>, <?php print $dia15?>, <?php print $dia16?>, <?php print $dia17?>, <?php print $dia18?>, <?php print $dia19?>, <?php print $dia20?>, <?php print $dia21?>, <?php print $dia22?>, <?php print $dia23?>, <?php print $dia24?>, <?php print $dia25?>, <?php print $dia26?>, <?php print $dia27?>, <?php print $dia28?>, <?php print $dia29?>, <?php print $dia30?>, <?php print $dia31?>],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Vendas do Mês actual em relação a média de outros meses'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: false,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: false,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});

			});

			window.myLine.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var colorName = colorNames[config.data.datasets.length % colorNames.length];
			var newColor = window.chartColors[colorName];
			var newDataset = {
				label: 'Dataset ' + config.data.datasets.length,
				backgroundColor: newColor,
				borderColor: newColor,
				data: [],
				fill: false
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
			}

			config.data.datasets.push(newDataset);
			window.myLine.update();
		});

		document.getElementById('addData').addEventListener('click', function() {
			if (config.data.datasets.length > 0) {
				var month = MONTHS[config.data.labels.length % MONTHS.length];
				config.data.labels.push(month);

				config.data.datasets.forEach(function(dataset) {
					dataset.data.push(randomScalingFactor());
				});

				window.myLine.update();
			}
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myLine.update();
		});

		document.getElementById('removeData').addEventListener('click', function() {
			config.data.labels.splice(-1, 1); // remove the label first

			config.data.datasets.forEach(function(dataset) {
				dataset.data.pop();
			});

			window.myLine.update();
		});
	</script>
        
        <!-- /.container-fluid -->
        </div>
      </div>
      <!-- End of Main Content -->

<?php include("rodape.php") ?>
