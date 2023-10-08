<?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

 
$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";

 
$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"2";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo);

$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"2021";
$anodevenda=mysqli_escape_string($conexao, $anodevenda); 
 

      
if(!isset($_GET['anodevenda'])){  
   
    for ($i=1; $i <=12 ; $i++) { 
        $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from saidas where MONTH(datadasaida)='$i'"))[0];
      } 
          $totaldesaidas = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas"))[0];
  
   
  }else if(isset($_GET['anodevenda'])){ 
  
      for ($i=1; $i <=12 ; $i++) { 
      $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from saidas where YEAR(datadasaida)='$anodevenda'  and  MONTH(datadasaida)='$i' "))[0];
    }
      $totaldesaidas = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  YEAR(datadasaida)='$anodevenda'"))[0];
  
  } 
         
       
   include("cabecalho.php");?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php
      

   

      $totaldesaidas_f=number_format($totaldesaidas,2,",", ".");
?>
 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Saídas no Caixa | <?php  echo "($anodevenda)"; ?>   </h1>
          <h1 style="font-size: 70px; text-align: center">Total de Saídas: <?php echo $totaldesaidas_f; ?>KZ</h1>
           

   
         <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Ano</button>
  
       <a href="pdf/pdfrelatoriodesaidamensal.php?anodevenda=<?php echo $anodevenda; ?>"> <button   class="btn btn-info" >Imprimir Relatório Anual</button></a>
        
                           
 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">

              <?php    $anoactual=date('Y'); ?>
                     <div class="form-group"> 
                      <input type="number" id="anoescolhido" name="anodevenda" min="2010" max="2200" class="form-control"   placeholder="Ano" value="<?php echo "$anoactual";?>">
                    </div>
                                                <br>

                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                   

          </form>
        </div>
    </div>
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        
    </div>


     

    
    
                <script>
                    var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                    var btnsaida=document.getElementById("myBtnsaida");

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");
                    var modalsaida=document.getElementById("myModalsaida");

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");
                    var spanreclamacoes2=document.getElementById("closereclamacoes2");

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

                    window.onclick =(event)=>{
                        if(event.target == modalsaida){
                          modalsaida.style.display="none";
                        }
                    }

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }
 


                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
                      btnsaida.addEventListener("click", ()=>{
                      modalsaida.style.display="block";
                                                  })

                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                       spanreclamacoes2.addEventListener("click", ()=>{
                      modalreclamacoes2.style.display="none";
                                                  })
                    

                


                  </script>

<br><br> 


    <!-- Content Row -->
                    <div class="row">  
                    <?php  

                          $diferentesformasdesaida=mysqli_query($conexao,"SELECT * from tipodesaidas");

                          while($exibir = $diferentesformasdesaida->fetch_array()){


                                $idtipo=$exibir["idtipodesaida"];
                                $tipo=$exibir["tipo"];
                                 
                                $totaldesaida_geral=$totaldesaidas;
if(!isset($_GET['mesdevenda'])){   
    
    $totaldesaida_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where idtipo='$idtipo'"))[0];
      
  


}else if(isset($_GET['mesdevenda'])){ 

 
  $totaldesaida_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  idtipo='$idtipo' and '$anodevenda'=YEAR(datadasaida) "))[0];
  

      
} 

                                   $valor=$totaldesaida_parcial;
                                    if($totaldesaida_geral==0){$totaldesaida_geral=1;} 

                                    $percentagem=round($valor*100/$totaldesaida_geral);

                                    ?>
                                  

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4"> 
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"> <h5><?php echo "$tipo";  ?></h5>  <br>    <?php $valorf=number_format($valor,2,",", ".");  ?> </div>
                          <div class="row no-gutters align-items-center">  
                          

                            <div class="col-auto">
                              <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$valorf";  ?> KZ</div>
                            </div>
                            <div class="col-auto">
                              <div class="h7 mb-0 mr-3 font-weight-bold text-gray-800">Equivalente à <?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                           

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto"> 
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
              
              
             <?php } ?>
                  </div>    
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Funcionários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Nome</th> 
                      <?php   $listadefuncionários=mysqli_query($conexao, "select * from tipodesaidas"); 
                            while($exibir2 = $listadefuncionários->fetch_array()){ ?>
                      <th><?php echo $exibir2['tipo']; ?></th>
                      <?php } ?>
                      <th>Total</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $listadefuncionários=mysqli_query($conexao, "select DISTINCT(funcionarios.idfuncionario ), funcionarios.nomedofuncionario, funcionarios.idfuncionario from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario"); 
                   while($exibir = $listadefuncionários->fetch_array()){
                    $idfuncionario=$exibir["idfuncionario"];
                       ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                   
                      <?php   $listadefuncionários2=mysqli_query($conexao, "select * from tipodesaidas"); 
                      $total=0;
                            while($exibir2 = $listadefuncionários2->fetch_array()){ 
                                $idtipo=$exibir2["idtipodesaida"];
                                $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas  where idfuncionario='$idfuncionario' AND idtipo='$idtipo' and '$anodevenda'=YEAR(datadasaida)"))[0];
  
                                $total+=$totaldesaida;
                                $valorf=number_format($totaldesaida,2,",", "."); 
                                ?>
                      <td><?php echo $valorf; ?></td>
                    
                      <?php }
                      $totalf=number_format($total,2,",", "."); 
                      
                      ?>
                      <td><?php echo $totalf; ?></td>
                    </tr> 
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    


 <div class="row">  
                    <?php  

                          $diferentesformasdeentrada=mysqli_query($conexao,"SELECT * from formasdepagamento");
  
                          $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) "))[0];
      

                          while($exibir = $diferentesformasdeentrada->fetch_array()){


                                $idtipo=$exibir["idformadepagamento"];
                                $tipo=$exibir["formadepagamento"];
                                 
                                $totaldeentrada_geral=$totaldesaida;


if(!isset($_GET['mesdevenda'])){   
    
    $totaldeentrada_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where formadesaida='$tipo'"))[0];
      
  


}else if(isset($_GET['mesdevenda'])){ 

 
  $totaldeentrada_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  formadesaida='$tipo' and '$anodevenda'=YEAR(datadasaida)"))[0];
  

      
} 

                                   $valor=$totaldeentrada_parcial;
                                    if($totaldeentrada_geral==0){$totaldeentrada_geral=1;} $percentagem=round($valor*100/$totaldeentrada_geral); ?>
                                  

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4"> 
                  <a href="gestaodecontas.php?nomedotipo=<?php echo "$tipo";  ?>&tipomarcado=<?php echo "$idtipo";  ?><?php if(isset($_GET['mesdevenda'])){ ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?><?php }?>"><div class="card border-left-info shadow h-100 py-2" >
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"> <h5><?php echo "$tipo";  ?></h5>  <br>    <?php $valorf=number_format($valor,2,",", ".");  ?> </div>
                          <div class="row no-gutters align-items-center">  
                          

                            <div class="col-auto">
                              <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$valorf";  ?> KZ</div>
                            </div>
                            <div class="col-auto">
                              <div class="h7 mb-0 mr-3 font-weight-bold text-gray-800">Equivalente à <?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                           

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto"> 
                        </div>
                      </div>
                    </div>
                  </div>
                  </div></a>
              
              
             <?php } ?>
                  </div>    
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Funcionários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Nome</th> 
                      <?php   $listadefuncionários=mysqli_query($conexao, "select * from formasdepagamento"); 
                            while($exibir2 = $listadefuncionários->fetch_array()){ ?>
                      <th><?php echo $exibir2['formadepagamento']; ?></th>
                      <?php } ?>
                      <th>Total</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $listadefuncionários=mysqli_query($conexao, "select DISTINCT(funcionarios.idfuncionario ), funcionarios.nomedofuncionario, funcionarios.idfuncionario from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario"); 
                   while($exibir = $listadefuncionários->fetch_array()){
                    $idfuncionario=$exibir["idfuncionario"];
                       ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                   
                      <?php   $listadefuncionários2=mysqli_query($conexao, "select * from formasdepagamento"); 
                      $total=0;
                            while($exibir2 = $listadefuncionários2->fetch_array()){ 
                                $tipo=$exibir2["formadepagamento"];
                                $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas  where idfuncionario='$idfuncionario' AND formadesaida='$tipo' and '$anodevenda'=YEAR(datadasaida) "))[0];
  
                                $total+=$totaldeentrada;
                                $valorf=number_format($totaldeentrada,2,",", "."); 
                                ?>
                      <td><?php echo $valorf; ?></td>
                    
                      <?php }
                      $totalf=number_format($total,2,",", "."); 
                      
                      ?>
                      <td><?php echo $totalf; ?></td>
                    </tr> 
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    






       <div class="row">
        
        <?php

  
if(!isset($_GET['anodevenda'])){  
 
  $esseano=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM saidas"))[0]; 
  $outrosanos=0; 
}else{

  $esseano=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM saidas where YEAR(datadasaida)='$anodevenda'"))[0]; 
  $outrosanos=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM saidas where YEAR(datadasaida)+1='$anodevenda'"))[0]; 
}

 
 
?>
           
 

 
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fluxo Anual</h6>
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
        label: '',
        backgroundColor: [
          window.chartColors.red,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.purple, 
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
          window.chartColors.red
        ],
        yAxisID: 'y-axis-1',
        data:[
          <?php print $dia[1]?>,
          <?php print $dia[2]?>,
          <?php print $dia[3]?>,
          <?php print $dia[4]?>,
          <?php print $dia[5]?>,
          <?php print $dia[6]?>,
          <?php print $dia[7]?>,
          <?php print $dia[8]?>,
          <?php print $dia[9]?>,
          <?php print $dia[10]?>,
          <?php print $dia[11]?>,
          <?php print $dia[12]?>  
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
            text: 'Gráficos  '
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

</script>
 
<!-- Content Row -->
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Representação das Saídas financeiras esse ano em relação aos outros</h6>
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
                      <i class="fas fa-circle text-success"></i> Saídas esse ano
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-gray"></i> Saídas ano passado
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
    labels: ["Saídas ano passado", "Saídas deste ano"],
    datasets: [{
      data: [<?php print $outrosanos?>, <?php print $esseano?>],
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
        
 
   <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Designação</th> 
                      <th>Janeiro</th>
                      <th>Fevereiro</th>  
                      <th>Março</th>
                      <th>Abril</th>
                      <th>Maio</th>
                      <th>Junho</th>
                      <th>Julho</th> 
                      <th>Agosto</th>  
                      <th>Setembro</th>
                      <th>Outubro</th>
                      <th>Novembro</th>
                      <th>Dezembro</th> 
                      <th>Sub-Total</th> 

                    </tr>
 

                  </thead> 
                  <tbody>

                  <?php

                 

                   

                       $tipodesaidas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from saidas where  YEAR(datadasaida)='$anodevenda'");

                       $total_valor_por_mes[]=0;
                    


                   while($exibir = $tipodesaidas->fetch_array()){

                    $tipodesaida=$exibir['tipo'];

                      $total_valor_categoria=0;
                   
 
                      for ($i=1; $i <=12 ; $i++) { 
 

                          $valor_do_tipo[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from saidas where YEAR(datadasaida)='$anodevenda'  and tipo='$tipodesaida' and  MONTH(datadasaida)='$i' "))[0]+0;

                          $total_valor_categoria+=$valor_do_tipo[$i];

  
 

 
                            
                          }
                      


 


                    ?>  

                   <tr>
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <?php


                        for ($i=1; $i <=12 ; $i++) {  

                         ?>
                         
                         <td <?php   $n=number_format($valor_do_tipo[$i],2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> |saida(<?php echo $n; ?>)  " ><?php echo $valor_do_tipo[$i]; ?></td> 

                           


                      <?php  } ?>

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 
 
                    </tr>
                  
                  <?php } ?>

                   </tbody> 

                   <tfoot>
                      <tr>
                      <th>Sub-total</th>



                      <?php

                       $total_valor_mes=0;
                    

                        for ($i=1; $i <=12 ; $i++) {  


                        
                          $total_valor_por_mes[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from saidas where YEAR(datadasaida)='$anodevenda'  and  MONTH(datadasaida)='$i' "))[0]+0;

                          $total_valor_mes+=$total_valor_por_mes[$i];

                        

                         ?>
                         <th <?php   $n=number_format($total_valor_por_mes[$i],2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_valor_por_mes[$i]; ?></th> 
 


                      <?php  } ?>

                          <th <?php   $n=number_format($total_valor_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_valor_mes; ?></th> 
 
                    </tr>
                  

                   </tfoot>
                    
                </table>
              </div>
            </div>
          </div>

       
      <!-- End of Main Content -->

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
