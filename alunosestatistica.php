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
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
 
$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo);

         
  
         
        $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT  anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo'"));

       $anolectivo_escolhido=$dadosdoanolectivo["titulo"];
$totaldematriculaseconfirmacoes = mysqli_num_rows(mysqli_query($conexao,"SELECT  idanolectivo from matriculaseconfirmacoes where  idanolectivo='$idanolectivo'"));


   include("cabecalho.php"); ?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Aquisição de alunos<?php if(isset($_GET['idanolectivo'])){ echo "| <a href='anolectivo.php?idanolectivo=$idanolectivo'> $anolectivo_escolhido </a>"; }?>  </h1>
          <h1 style="font-size: 70px; text-align: center">Total de alunos: <?php echo $totaldematriculaseconfirmacoes; ?></h1>
           

   
        


<?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Ano Lectivo</button>
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Comparar Anos Lectivos</button> 
 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method=""><br>
         
                      
                    <div class="form-group">
                     <span>Escolha outro Ano Lectivo</span>
                    <select name="idanolectivo" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                    <br>
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                   
                   

          </form>
        </div>
    </div>
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="alunosestatisticacomparacao.php" method="get"> <br>
          Comparando Aquisição de aluno nos anos:  <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            
                             
                             <span> Ano Lectivo 1</span>
                            <select name="idanolectivo1" required  class="form-control"> 
                              <?php
                                   $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                                  while($exibir = $lista->fetch_array()){ ?>
                                  <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                <?php } ?> 
                            </select> 
                           


                        </div>
                        <div class="col-sm-6">
                             <span> Ano Lectivo 2</span>
                            <select name="idanolectivo2" required  class="form-control"> 
                              <?php
                                   $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                                  while($exibir = $lista->fetch_array()){ ?>
                                  <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                <?php } ?> 
                            </select> 
                        </div> 
                    </div>
                     

                          <br>
                       <input type="submit" value="Comparar"class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    
    <br><br>
                <script>
                    var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");
                    

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                  
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }
 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })

                                                  
      
                                                  
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })

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

  
    
  $posicao_desse_ano=$dadosdoanolectivo["posicao"];
  
   $idanolectivo_anterior=mysqli_fetch_array( mysqli_query($conexao,"SELECT idanolectivo from anoslectivos where posicao<'$posicao_desse_ano' order by posicao desc limit 1 "))[0];


  $esseano=mysqli_num_rows(mysqli_query($conexao, "select idmatriculaeconfirmacao FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo'")); 

  $outrosanos=mysqli_num_rows(mysqli_query($conexao, "select idmatriculaeconfirmacao FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo_anterior'")); 
 

 
?>
           
 


           

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fluxo de Aquisição</h6>
                  <div class="dropdown no-arrow">
                    
                   
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body"> 
                 

                <form autocomplete="on">
                    <div class="row">
                    <div style="width: 95%">
		            <canvas id="canvas"></canvas>
               <?php

                $meses=[];
                $valormes=[];

                $listadeanos=[];

                   $anoactual=date('Y');
               
                $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(data)), YEAR(data) as ano from matriculaseconfirmacoes where  idanolectivo='$idanolectivo'  order by data asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];

                                  $listadeanos[]=$ano;

                                

                   $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano'  order by data asc ");
                            
                            while($exibir = $lista->fetch_array()){ 
                                    

                                    $mes=$exibir["mes"];

                                    $valormes[] = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and MONTH(data)='$mes'"));
 
                                       
                                   if($exibir['mes']==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($exibir['mes']==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($exibir['mes']==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($exibir['mes']==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($exibir['mes']==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($exibir['mes']==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($exibir['mes']==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($exibir['mes']==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($exibir['mes']==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($exibir['mes']==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($exibir['mes']==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($exibir['mes']==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }
                              }



                              
                               
                ?>


                       
     <script>
    var barChartData = {
      labels: [

          <?php 

          foreach ($meses as $key => $value) {
                 echo "'$value' ,";  
              } 

       ?>

            ],


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
           <?php 

          foreach ($valormes as $key => $value) {
                 echo "'$value' ,";  
              } 

       ?> 
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
						text: 'Gráficos Mostrando o Fluxo de Aquisição de aluno'
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
                  <h6 class="m-0 font-weight-bold text-primary">Representação da Aquisição de alunos esse ano em relação ao ano lectivo anterior</h6>
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
                      <i class="fas fa-circle text-success"></i> alunos Adquiridos esse ano
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-gray"></i> alunos Adquiridos ano passado
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
    labels: ["alunos ano passado", "alunos deste ano"],
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
        
 
</div>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Estatísticas Por Turmas</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                    
        
                <br>
                <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Ciclo</th>
                      <th>Turma</th>   
                       <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th>$value</th>";  
                            } 

                     ?> 
                       <th>Total</th>   
                    </tr>
                  </thead> 
                  <tbody>
                  <?php 

                  $litadeciclos=mysqli_query($conexao,"SELECT * from ciclos order by idciclo desc");
                      
                    
                   $listade_ciclos=[];
                   while($exibir_ciclo = $litadeciclos->fetch_array()){

                    $idciclo=$exibir_ciclo["idciclo"];
                    $titulo_do_ciclo=$exibir_ciclo["titulo"];

                    $listade_ciclos[$idciclo]=$titulo_do_ciclo;

                     
                     $total_alunos_por_ciclo=0;

                   

                        $alunoscadastrados_nas_turmas=mysqli_query($conexao,"SELECT * from turmas where  idanolectivo='$idanolectivo' and idciclo='$idciclo'");
                        

                           
  
                           while($exibir = $alunoscadastrados_nas_turmas->fetch_array()){

                                $idturma=$exibir["idturma"];

                                $total=0;

                               
                            ?>

                            <tr>
                              <td><a href="ciclo.php?idciclo=<?php echo $exibir_ciclo['idciclo']; ?>"><?php echo $exibir_ciclo['titulo']; ?></a></td> 
                              <td><a href="turma.php?idturma=<?php echo $exibir['idturma']; ?>"><?php echo $exibir['titulo']; ?></a></td>  
                                <?php 

                                  
                                  

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and MONTH(data)='$mes' and idturma='$idturma'"));

                                            $numerodealunos_inactivos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and MONTH(data)='$mes' and idturma='$idturma' and estatus!='activo'"));
          
          
                                            $total+=$numerodealunos;

                                            $total_alunos_por_ciclo+=$numerodealunos;

                                            if($numerodealunos_inactivos==0){
                                              $texto="Todos Activos";
                                            }else{
                                              $texto="$numerodealunos_inactivos aluno(s) inactivo(s)";
                                            }

                                           
                                       echo "<td title='$texto'>$numerodealunos</td>"; 


                                    } 

                                          

                                       
                                  }

                                   
                             ?>   

                             <td><?php echo "$total"; ?></td>
                       
                    </tr> 
                   <?php } ?>


                          <tr>
                      <th><?php echo "$exibir_ciclo[titulo]"; ?> - Total </th>
                      <th></th>   
                         <?php
 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo' and YEAR(matriculaseconfirmacoes.data)='$ano' and MONTH(matriculaseconfirmacoes.data)='$mes' and turmas.idciclo='$idciclo'"));

                                              $numerodealunos_inactivos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo' and YEAR(matriculaseconfirmacoes.data)='$ano' and MONTH(matriculaseconfirmacoes.data)='$mes' and turmas.idciclo='$idciclo' and estatus!='activo'"));
          
           
                                             
                                            if($numerodealunos_inactivos==0){
                                              $texto="Todos Activos";
                                            }else{
                                              $texto="$numerodealunos_inactivos aluno(s) inactivo(s)";
                                            }

           
                                          
                                       echo "<td title='$texto'>$numerodealunos</td>"; 


                                    } 

                                          

                                       
                                  }
 

                     ?> 
                       <th><?php echo "$total_alunos_por_ciclo"; ?></th>   
                    </tr>




                  <?php  }  ?>
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th>Total todos Cíclos</th>
                              <th></th>   
                               <?php 

                                foreach ($valormes as $key => $value) {
                                       echo "<th>$value</th>";  
                                    } 

                             ?> 
                                   <th><?php echo "$totaldematriculaseconfirmacoes"; ?></th>     
                            </tr>
                   </tfoot>
                </table>
              </div>
            </div>
          </div>



    <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Estatísticas Por Ciclos</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                    
        
                <br>
                <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Descrição</th>    
                       <?php 

                        foreach ($listade_ciclos as $key => $value) {
                               echo "<th><a href='ciclo.php?idciclo=$key'> $value </a></th>";  
                            } 

                     ?> 
                       <th>Total</th>   
                    </tr>
                  </thead> 
                  <tbody>
                  <?php 

                  $litade_estatus=mysqli_query($conexao,"SELECT DISTINCT(estatus) as estatus from matriculaseconfirmacoes order by estatus asc");
                      
 
                   while($exibir_estatus = $litade_estatus->fetch_array()){
 
                    $titulo_do_estatus=$exibir_estatus["estatus"];

                     
                     
                   
                       $total_alunos_por_estatus=0;
                      
                               
                            ?>

                            <tr>

                                <td> <?php echo $exibir_estatus['estatus']; ?></td>  

                        <?php

                            foreach ($listade_ciclos as $key => $value) {
                                   
                                $idciclo=$key;

                                

                                   $numerodealunos= mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo'   and turmas.idciclo='$idciclo' and estatus='$titulo_do_estatus'"));

                                    $total_alunos_por_estatus+=$numerodealunos;
                              ?>

                                   <td> <?php echo $numerodealunos; ?></td>  


                        <?php } ?>

                             <td><?php echo "$total_alunos_por_estatus"; ?> 

                             <?php if($titulo_do_estatus!='activo'){?>
                                    <a href="desistente.php"><i title="Visualizar alunos inactivos" class="fas fa-eye"></i></a>
                              <?php } ?> 

                             </td>
                       
                    </tr>
                    <?php } ?> 
                  </tbody> 
                  <tfoot>
                  

 

                            <tr>

                                <th>Total</th>  

                        <?php

                          $total_alunos_por_ciclo=0;

                            foreach ($listade_ciclos as $key => $value) {
                                   
                                $idciclo=$key;

                                

                                   $numerodealunos= mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo'   and turmas.idciclo='$idciclo'"));

                                    $total_alunos_por_ciclo+=$numerodealunos;
                              ?>

                                   <th> <?php echo $numerodealunos; ?></th>  


                        <?php } ?>

                             <th><?php echo "$total_alunos_por_ciclo"; ?></th>
                       
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
