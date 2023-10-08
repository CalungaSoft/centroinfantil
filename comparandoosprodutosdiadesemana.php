<?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
$tipodecomparacao=$_GET['tipodecomparacao'];
$mesdecomparacao=$_GET['mesdecomparacao'];
$anodecomparacao=$_GET['anodecomparacao'];
$produto1=$_GET['produto1'];
$produto2=$_GET['produto2']; 

$nomep1=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedoproduto FROM produtos  where produtos.idproduto='$produto1'"))[0];
$nomep2=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedoproduto FROM produtos  where produtos.idproduto='$produto2'"))[0];
 

            $segundav = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='0'"));
            $tercav = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='1'"));
            $quartav = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='2'"));
            $quintav = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='3'"));
            $sextav = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='4'"));
            $sabadov = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='5'"));
            $domingov = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='6'")); 
 



            $segundav = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='0'"))[0]/($segundav+0.000001));
            $tercav = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='1'"))[0]/($tercav+0.000001));
            $quartav = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='2'"))[0]/($quartav+0.000001));
            $quintav = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='3'"))[0]/($quintav+0.000001));
            $sextav = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='4'"))[0]/($sextav+0.000001));
            $sabadov = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='5'"))[0]/($sabadov+0.000001));
            $domingov = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='5'"))[0]/($domingov+0.000001));
             
 
            
            $segundap2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='0'"));
            $tercap2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='1'"));
            $quartap2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='2'"));
            $quintap2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='3'"));
            $sextap2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='4'"));
            $sabadop2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='5'"));
            $domingop2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='6'")); 
  
            $segundap2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='0'"))[0]/($segundap2v+0.000001));
            $tercap2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='1'"))[0]/($tercap2v+0.000001));
            $quartap2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='2'"))[0]/($quartap2v+0.000001));
            $quintap2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='3'"))[0]/($quintap2v+0.000001));
            $sextap2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='4'"))[0]/($sextap2v+0.000001));
            $sabadop2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='5'"))[0]/($sabadop2v+0.000001));
            $domingop2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (WEEKDAY(data))='5'"))[0]/($domingop2v+0.000001));
             

   include("cabecalho.php")?>
    <div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Estatísticas de Vendas por Dia de Semana</h1>
 

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Veja as vendas na semana actual e compare com outras semanas</h6>
                  <div class="dropdown no-arrow">
                    
                   
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <div style="width:100%;">
		<canvas id="canvas"></canvas>
	</div> 
	<script>
	  var nomep1="<?php print $nomep1 ?>";
     var nomep2="<?php print $nomep2?>";
		var config = {
			type: 'line',
			data: {
				labels: ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado","Domingo"],
				datasets: [{
					label: nomep1,
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [<?php print $segundav?>, <?php print $tercav?>, <?php print $quartav?>, <?php print $quintav?>, <?php print $sextav?>, <?php print $sabadov?>, <?php print $domingov?>],
					fill: false,
				}, {
					label: nomep2,
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data:  [<?php print $segundap2v?>, <?php print $tercap2v?>, <?php print $quartap2v?>, <?php print $quintap2v?>, <?php print $sextap2v?>, <?php print $sabadov?>, <?php print $domingov?>],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Comparando as vendas dos dois produtos em relação aos dias de semana'
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
