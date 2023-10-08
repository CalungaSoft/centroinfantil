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
    
 $diadevenda=isset($_GET['diadevenda'])?$_GET['diadevenda']:"";
$diadevenda=mysqli_escape_string($conexao, $diadevenda);
    
  
 

 


 
if(!isset($_GET['mesdevenda'])){  
   
  for ($i=0; $i <=23 ; $i++) { 

	  $horas[$i]=mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where DAY(datadaentrada)='$diadevenda' and HOUR(datadaentrada)='$i'"))[0];
	  $horass[$i]=mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where DAY(datadasaida)='$i'"))[0];

    } 
        $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas"))[0];
  	    $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas"))[0];
	  

 
}else if(isset($_GET['mesdevenda'])){ 

    for ($i=0; $i <=23 ; $i++) { 

	$horas[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from entradas where  '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) and  DAY(datadaentrada)='$diadevenda'  and HOUR(datadaentrada)='$i'"))[0];
	$horass[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) and  DAY(datadasaida)='$diadevenda'  and HOUR(datadasaida)='$i'"))[0];

  }
      $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) and DAY(datadaentrada)='$diadevenda'"))[0];
       $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) and DAY(datadasaida)='$diadevenda'"))[0];

		  
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
          <h1 class="h3 mb-2 text-gray-800">Entradas(<?php echo $entrada; ?>KZ) e Saídas (<?php echo $saida; ?>KZ) Financeira na empresa <?php if(isset($_GET['mesdevenda'])){ echo "| $diadevenda/$mesdevenda/$anodevenda"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"><?php echo $valornocaixa; ?>KZ</h1>
           
<br><br>
 

          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o dia</button>

          <a href="pdf/pdfrelariodiario.php?diadevenda=<?php echo $diadevenda; ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>"> <button   class="btn btn-info" >Imprimir Relatório Diário</button></a>
        

    
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">
                      <select name="anodevenda"  class="form-control" title="Escolha aqui o ano"  >

                          <?php 
                           $anoactual=date('Y');


                            $anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)) as ano from entradas");

                            while($exibir = $anos->fetch_array()){ 
                          ?>
                          <option <?php if($anoactual==$exibir["ano"]) { ?> selected="" <?php }?> value=<?php echo "$exibir[ano]";?>><?php echo "$exibir[ano]";?></option> 
                          <?php } ?>
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
                          

                           <br> <?php $diaactual=date('d');  ?>
                            <span>Dia</span>
                          <select name="diadevenda"  class="form-control">
                         

                          <?php for ($i=1; $i <=31 ; $i++) { ?>
                            <option <?php if($diaactual==$i) { ?> selected="" <?php }?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php     } ?>
                                        
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
			labels: [' 00 Horas', ' Uma Hora', ' Duas Horas', ' 03 Horas', ' 04 Horas', ' 05 Horas', ' 06 Horas', ' 07 Horas'  , ' 08 Horas', ' 09 Horas', ' 10 Horas', ' 11 Horas', ' 12 Horas', ' 13 Horas', ' 14 Horas', ' 15 Horas',  ' 16 Horas', ' 17 Horas'  , ' 18 Horas', ' 19 Horas', ' 20 Horas', ' 21 Horas', ' 22 Horas'  ,' 23 Horas'],
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

          <?php print $horas[0]-$horass[0]?>,
					<?php print $horas[1]-$horass[1]?>,
					<?php print $horas[2]-$horass[2]?>,
					<?php print $horas[3]-$horass[3]?>,
					<?php print $horas[4]-$horass[4]?>,
					<?php print $horas[5]-$horass[5]?>,
					<?php print $horas[6]-$horass[6]?>,
					<?php print $horas[7]-$horass[7]?>,
					<?php print $horas[8]-$horass[8]?>,
					<?php print $horas[9]-$horass[9]?>,
					<?php print $horas[10]-$horass[10]?>,
					<?php print $horas[11]-$horass[11]?>,
					<?php print $horas[12]-$horass[12]?>,
					<?php print $horas[13]-$horass[13]?>,
					<?php print $horas[14]-$horass[14]?>,
					<?php print $horas[15]-$horass[15]?>,
					<?php print $horas[16]-$horass[16]?>,
					<?php print $horas[17]-$horass[17]?>,
					<?php print $horas[18]-$horass[18]?>,
					<?php print $horas[19]-$horass[19]?>,
					<?php print $horas[20]-$horass[20]?>,
					<?php print $horas[21]-$horass[21]?>,
					<?php print $horas[22]-$horass[22]?>,
					<?php print $horas[23]-$horass[23]?> 
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
