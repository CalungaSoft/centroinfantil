<?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";

$hoje=date('d');

$ano1=isset($_GET['ano1'])?$_GET['ano1']:"2020";  $ano1=mysqli_escape_string($conexao, $ano1);

$ano2=isset($_GET['ano2'])?$_GET['ano2']:"2019"; $ano2=mysqli_escape_string($conexao, $ano2);
 

        if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}
 
 
      for ($i=1; $i <=12 ; $i++) { 
          $dia1[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where '$ano1'=YEAR(datadaentrada)  and  MONTH(datadaentrada)='$i' "))[0]+0;
          $dia2[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where '$ano2'=YEAR(datadaentrada)  and  MONTH(datadaentrada)='$i' "))[0]+0;
      }

      $totaldeentradas1 = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  '$ano1'=YEAR(datadaentrada)"))[0];
      $totaldeentradas2 = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  '$ano2'=YEAR(datadaentrada)"))[0];

         
       
   include("cabecalho.php")?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">
<?php
      $totaldeentradas1=number_format($totaldeentradas1,2,",", ".");
      $totaldeentradas2=number_format($totaldeentradas2,2,",", ".");
?>
 

 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Entradas Financeiras (<?php   echo "$ano1 | $ano2"; ?>)  </h1>
          <h1 style="font-size: 50px; text-align:center">Entradas: (<?php echo $totaldeentradas1; ?> |<?php echo $totaldeentradas2; ?>)KZ  </h1>
           

        


<?php  include("estilocarde.php"); ?> 

    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Comparar Anos</button> 
 
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="get"> <br>
          Comparando Fluxo de entradas financeiras de Cliente nos anos:  <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="number" name="ano1" class="form-control " title="Primeiro ano a ser comparado" placeholder="Ano 1" required="" >
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="ano2" class="form-control " title="Segundo ano a ser comparado" placeholder="Ano 2" required="">
                        </div> 
                    </div>
                     

                          <br>
                       <input type="submit" value="Comparar"class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    
    <br><br>
                <script>
                   
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes"); 
                    var modalreclamacoes=document.getElementById("myModalreclamacoes"); 
                    var spanreclamacoes=document.getElementById("closereclamacoes");
                    
 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    } 
       

                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })


                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
              
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                
                    

                


                  </script>


       <!-- Content Row -->
       <div class="row">
        
        <?php

  
 
  $esseano1=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where YEAR(datadaentrada)='$ano1'"))[0]; 
  $esseano2=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where YEAR(datadaentrada)='$ano2'"))[0]; 



 
 
?>
           
 


           

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fluxo de Entradas Financeiras</h6>
                  <div class="dropdown no-arrow">
                    
                   
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body"> 
                 

                <form autocomplete="on">
                    <div class="row">
                    <div style="width: 95%">
		            <canvas id="canvas"></canvas>
                       
                <script>
		var barChartData = {
			labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho' , 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			datasets: [{
				label: '<?php echo $ano1; ?>',
				backgroundColor: window.chartColors.red, 
        data:[
					<?php print $dia1[1]?>,
					<?php print $dia1[2]?>,
					<?php print $dia1[3]?>,
					<?php print $dia1[4]?>,
					<?php print $dia1[5]?>,
					<?php print $dia1[6]?>,
					<?php print $dia1[7]?>,
					<?php print $dia1[8]?>,
					<?php print $dia1[9]?>,
					<?php print $dia1[10]?>,
					<?php print $dia1[11]?>,
					<?php print $dia1[12]?>  
				]
			}, {
				label: '<?php echo $ano2; ?>',
				backgroundColor: window.chartColors.grey, 
        data:[
					<?php print $dia2[1]?>,
					<?php print $dia2[2]?>,
					<?php print $dia2[3]?>,
					<?php print $dia2[4]?>,
					<?php print $dia2[5]?>,
					<?php print $dia2[6]?>,
					<?php print $dia2[7]?>,
					<?php print $dia2[8]?>,
					<?php print $dia2[9]?>,
					<?php print $dia2[10]?>,
					<?php print $dia2[11]?>,
					<?php print $dia2[12]?>  
				]
			}]

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
						text: 'Comparando o fluxo de aquisição entre <?php echo $ano1; ?> e <?php echo $ano2; ?>'
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
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: false,
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

</script>
 
<!-- Content Row -->
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Representação da Aquisição de entradas de <?php echo $ano1; ?> em relação a de <?php echo $ano2; ?></h6>
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
                      <i class="fas fa-circle text-success"></i> entradas de <?php echo $ano1; ?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-gray"></i> entradas <?php echo $ano2; ?>
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
    labels: ["entradas <?php echo $ano2; ?>", "entradas <?php echo $ano1; ?>"],
    datasets: [{
      data: [<?php print $esseano2?>, <?php print $esseano1?>],
      backgroundColor: ['gray', 'green'],
      hoverBackgroundColor: ['gray', 'green'],
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
        

      </div>
      <!-- End of Main Content -->

         </div>
    <!-- End of Content Wrapper -->

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
