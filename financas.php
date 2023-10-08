<?php 

include("conexao.php");


    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

$erros=[];


$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";

    $hoje=date('d');
    $mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
    
    $filtro = isset($_GET['filtro'])?$_GET['filtro']:"$hoje";
    $idfuncionario =$idlogado;

    


 
if(!isset($_GET['mesdevenda'])){  
   
  for ($i=1; $i <=31 ; $i++) { 

	  $dia[$i]=mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where DAY(datadaentrada)='$i'"))[0];
	  $dias[$i]=mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where DAY(datadasaida)='$i'"))[0];

    } 
        $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas"))[0];
  	    $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas"))[0];
	  

 
}else if(isset($_GET['mesdevenda'])){ 

    for ($i=1; $i <=31 ; $i++) { 

	$dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from entradas where  DAY(datadaentrada)='$i' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)"))[0];
	$dias[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from saidas where  DAY(datadasaida)='$i' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];

  }
      $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
       $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];

		  
} 


include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php
      $valornocaixa=number_format($totaldeentrada-$totaldesaida,2,",", ".");
      $entrada=number_format($totaldeentrada,2,",", ".");
      $saida=number_format($totaldesaida,2,",", ".");
		?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Entradas(<?php echo $entrada; ?>KZ) e Saídas (<?php echo $saida; ?>KZ) Financeira na empresa <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"><?php echo $valornocaixa; ?>KZ</h1>
           
<br><br>
 

          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o mês</button>

          <a href="pdf/relatoriodecaixamensal.php?mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>"> <button   class="btn btn-info" >Imprimir Relatório Mensal</button></a>
        

    
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">
                      <select name="anodevenda"  class="form-control" title="Escolha aqui o ano"  >
                          <option <?php $anoactual=date('Y'); if($anoactual==2020) { ?> selected="" <?php }?> value=2020>2020</option>
                          <option <?php if($anoactual==2021) { ?> selected="" <?php }?> value=2021>2021</option>
                          <option <?php if($anoactual==2022) { ?> selected="" <?php }?> value=2022>2022</option>
                          <option <?php if($anoactual==2023) { ?> selected="" <?php }?> value=2023>2023</option>
                          <option <?php if($anoactual==2024) { ?> selected="" <?php }?> value=2024>2024</option>
                          <option <?php if($anoactual==2025) { ?> selected="" <?php }?> value=2025>2025</option>
                          <option <?php if($anoactual==2026) { ?> selected="" <?php }?> value=2026>2026</option>
                          <option <?php if($anoactual==2027) { ?> selected="" <?php }?> value=2027>2027</option>
                      </select>
                    </div> 
                    
                     
                    <div class="form-group">
                          <select name="mesdevenda"  class="form-control">
                          <option <?php $mesactual=date('m'); if($mesactual==1) { ?> selected="" <?php }?> value="01">Janeiro</option>
                              <option <?php if($mesactual==2) { ?> selected="" <?php }?> value="02">Fevereiro</option>
                              <option <?php if($mesactual==3) { ?> selected="" <?php }?> value="03">março</option>
                              <option <?php if($mesactual==4) { ?> selected="" <?php }?> value="04">Abril</option>
                              <option <?php if($mesactual==5) { ?> selected="" <?php }?> value="05">Maio</option>
                              <option <?php if($mesactual==6) { ?> selected="" <?php }?> value="06">Junho</option>
                              <option <?php if($mesactual==7) { ?> selected="" <?php }?> value="07">Julho</option>
                              <option <?php if($mesactual==8) { ?> selected="" <?php }?> value="08">Agosto</option>
                              <option <?php if($mesactual==9) { ?> selected="" <?php }?> value="09" >Setembro</option>
                              <option <?php if($mesactual==10) { ?> selected="" <?php }?> value="10">Outubro</option>
                              <option <?php if($mesactual==11) { ?> selected="" <?php }?> value="11">Novembro</option>
                              <option <?php if($mesactual==12) { ?> selected="" <?php }?> value="12">Dezembro</option> 
                          </select>
                          <br>
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                    </div>

          </form>
        </div>
    </div>
 
 
 
    
                <script>
                    var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes");

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");

                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }

                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
					 })
					 
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
					 })
					 
                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                  </script>

<br><br>
             

          <div class="container-fluid">
            <div class="container-flat-form"> 
                <form autocomplete="on">
                    <div class="row">
                    <div style="width: 95%">
		            <canvas id="canvas"></canvas>
                       
	   <script>
		var barChartData = {
			labels: ['Dia 1', 'Dia 2', 'Dia 3', 'Dia 4', 'Dia 5', 'Dia 6', 'Dia 7' , 'Dia 8', 'Dia 9', 'Dia 10', 'Dia 11', 'Dia 12', 'Dia 13', 'Dia 14', 'Dia 15',  'Dia 16', 'Dia 17' , 'Dia 18', 'Dia 19', 'Dia 20', 'Dia 21', 'Dia 22' ,'Dia 23', 'Dia 24', 'Dia 25','Dia 26', 'Dia 27', 'Dia 28','Dia 29', 'Dia 30', 'Dia 31'],
			datasets: [{
				label: '',
				backgroundColor: [
					window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
                    window.chartColors.red,
                    window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.red,
					window.chartColors.purple
				],
				yAxisID: 'y-axis-1',
				data:[
					<?php print $dia[1]-$dias[1]?>,
					<?php print $dia[2]-$dias[2]?>,
					<?php print $dia[3]-$dias[3]?>,
					<?php print $dia[4]-$dias[4]?>,
					<?php print $dia[5]-$dias[5]?>,
					<?php print $dia[6]-$dias[6]?>,
					<?php print $dia[7]-$dias[7]?>,
					<?php print $dia[8]-$dias[8]?>,
					<?php print $dia[9]-$dias[9]?>,
					<?php print $dia[10]-$dias[10]?>,
					<?php print $dia[11]-$dias[11]?>,
					<?php print $dia[12]-$dias[12]?>,
					<?php print $dia[13]-$dias[13]?>,
					<?php print $dia[14]-$dias[14]?>,
					<?php print $dia[15]-$dias[15]?>,
					<?php print $dia[16]-$dias[16]?>,
					<?php print $dia[17]-$dias[17]?>,
					<?php print $dia[18]-$dias[18]?>,
					<?php print $dia[19]-$dias[19]?>,
					<?php print $dia[20]-$dias[20]?>,
					<?php print $dia[21]-$dias[21]?>,
					<?php print $dia[22]-$dias[22]?>,
					<?php print $dia[23]-$dias[23]?>,
					<?php print $dia[24]-$dias[24]?>,
					<?php print $dia[25]-$dias[25]?>,
					<?php print $dia[26]-$dias[26]?>,
					<?php print $dia[27]-$dias[27]?>,
					<?php print $dia[28]-$dias[28]?>,
					<?php print $dia[29]-$dias[29]?>,
					<?php print $dia[30]-$dias[30]?>,
					<?php print $dia[31]-$dias[31]?> 
				]
			},]

		};
		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Gráficos Mostrando o Fluxo de Entradas e Saídas'
					},
					tooltips: {
						mode: 'index',
						intersect: true
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
							gridLines: {
								drawOnChartArea: false
							}
						}],
					}
				}
			});
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			barChartData.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});
			window.myBar.update();
		});
	</script>
	

                        </div>
                    </div>
  
            </div>
        </div>

   </div>
        </div>






        
 
      
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2021</span>
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
