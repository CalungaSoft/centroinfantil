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

 
$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"2";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo);

$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"2021";
$anodevenda=mysqli_escape_string($conexao, $anodevenda); 
 

$anoinicio=isset($_GET['anoinicio'])?$_GET['anoinicio']:"2021";
$anoinicio=mysqli_escape_string($conexao, $anoinicio); 
$mesinicio=isset($_GET['mesinicio'])?$_GET['mesinicio']:"01";
$mesinicio=mysqli_escape_string($conexao, $mesinicio); 

$datainicio="$anoinicio-$mesinicio-01";

 

$anofim=isset($_GET['anofim'])?$_GET['anofim']:"2021";
$anofim=mysqli_escape_string($conexao, $anofim); 
$mesfim=isset($_GET['mesfim'])?$_GET['mesfim']:"01";
$mesfim=mysqli_escape_string($conexao, $mesfim); 
  
$datafim="$anofim-$mesfim-31";

 

      $totaldeentradas = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim'"))[0];

      $primeiradata=mysqli_fetch_array( mysqli_query($conexao,"SELECT datadaentrada from entradas where idanolectivo='$idanolectivo' order by datadaentrada asc limit 1"))[0];
    
      $ultimadata=mysqli_fetch_array( mysqli_query($conexao,"SELECT datadaentrada from entradas where idanolectivo='$idanolectivo' order by datadaentrada desc limit 1"))[0];
  
  
         
       
   include("cabecalho.php");?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php
      

       $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT * from anoslectivos where  idanolectivo='$idanolectivo'"));

       $anolectivo=$dadosdoanolectivo["titulo"];

      $totaldeentradas_f=number_format($totaldeentradas,2,",", ".");
?>
 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Fluxo de Caixa <?php if(isset($_GET['idanolectivo'])){ echo "| <a href='anolectivo.php?idanolectivo=$idanolectivo'> $anolectivo </a>"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center">Total de entrada: <?php echo $totaldeentradas_f; ?>KZ</h1>
           

   
         <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Período</button>
  
       <a href="pdf/pdfrelatoriodeentradamensal.php?mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>"> <button   class="btn btn-info" >Imprimir Relatório Mensal</button></a>
        
                           
 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                   <h3>Ver Relatório</h3> <br>
                      
                   <div class="form-group row">
               
                        <div class="col-sm-6"> 
                              <span>Desde o Ano</span> 
                              <select name="anoinicio"   required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas order by identrada asc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                                  <?php } ?> 
                              </select>  
                        </div>
                        <div class="col-sm-6"> 
                         <span>No Mês de </span> 
                              <select name="mesinicio"  required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes from entradas order by identrada asc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["mes"]; ?>"><?php

                                    if($exibir["mes"]==1){
                                      echo "Janeiro";
                                    }else if($exibir["mes"]==2){
                                      echo "Fevereiro";
                                    }else if($exibir["mes"]==3){
                                      echo "Março";
                                    }else if($exibir["mes"]==4){
                                      echo "Abril";
                                    }else if($exibir["mes"]==5){
                                      echo "Maio";
                                    }else if($exibir["mes"]==6){
                                      echo "Junho";
                                    }else if($exibir["mes"]==7){
                                      echo "Julho";
                                    }else if($exibir["mes"]==8){
                                      echo "Agosto";
                                    }else if($exibir["mes"]==9){
                                      echo "Setembro";
                                    }else if($exibir["mes"]==10){
                                      echo "Outubro";
                                    }else if($exibir["mes"]==11){
                                      echo "Novembro";
                                    }else if($exibir["mes"]==12){
                                      echo "Dezembro";
                                    } 
                                     



                                      ?></option>
                                  <?php } ?> 
                              </select> 
                        </div>  
                    </div>

                   
                    <div class="form-group row">
               
                        <div class="col-sm-6"> 
                              <span>Até o Ano</span> 
                              <select name="anofim"  id="anolectivo" required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas order by identrada desc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                                  <?php } ?> 
                              </select> 
                        </div>
                        <div class="col-sm-6"> 
                                <span>No Mês de </span> 
                              <select name="mesfim"   required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes from entradas order by identrada desc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["mes"]; ?>"><?php

                                    if($exibir["mes"]==1){
                                      echo "Janeiro";
                                    }else if($exibir["mes"]==2){
                                      echo "Fevereiro";
                                    }else if($exibir["mes"]==3){
                                      echo "Março";
                                    }else if($exibir["mes"]==4){
                                      echo "Abril";
                                    }else if($exibir["mes"]==5){
                                      echo "Maio";
                                    }else if($exibir["mes"]==6){
                                      echo "Junho";
                                    }else if($exibir["mes"]==7){
                                      echo "Julho";
                                    }else if($exibir["mes"]==8){
                                      echo "Agosto";
                                    }else if($exibir["mes"]==9){
                                      echo "Setembro";
                                    }else if($exibir["mes"]==10){
                                      echo "Outubro";
                                    }else if($exibir["mes"]==11){
                                      echo "Novembro";
                                    }else if($exibir["mes"]==12){
                                      echo "Dezembro";
                                    } 
                                     



                                      ?></option>
                                  <?php } ?> 
                              </select> 
                        </div>  
                    </div>


                    <span>Ano Lectivo</span>
                    <div class="form-group">
                    <select name="idanolectivo"  id="anolectivo" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option <?php if($exibir["vigor"]=='Sim'){ echo "selected";} ?> value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
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
         
        </div>
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

  
if(!isset($_GET['idanolectivo'])){  
 
  $esseano=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas"))[0]; 
  $outrosanos=0; 
}else{

  $posicao_desse_ano=$dadosdoanolectivo["posicao"];
  
   $idanolectivo_anterior=mysqli_fetch_array( mysqli_query($conexao,"SELECT idanolectivo from anoslectivos where posicao<'$posicao_desse_ano' order by posicao desc limit 1 "))[0];


  $esseano=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where idanolectivo='$idanolectivo' "))[0]; 
  $outrosanos=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where idanolectivo='$idanolectivo_anterior' "))[0]; 
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

                <?php

                $meses=[];
                $valormes=[];

                   $anoactual=date('Y');
               
                $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim' order by datadaentrada asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];

                   $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes  from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and ((MONTH(datadaentrada)>='$mesinicio' and MONTH(datadaentrada)<=12) or (MONTH(datadaentrada)>=1 and MONTH(datadaentrada)<='$mesfim') ) order by datadaentrada asc ");
                            
                            while($exibir = $lista->fetch_array()){ 
                                    

                                    $mes=$exibir["mes"];

                                    $valormes[] = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes'"))[0];

 
                                  
                                       
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
            text: 'Gráficos Mostrando o Fluxo de caixa do Ano lectivo'
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
                  <h6 class="m-0 font-weight-bold text-primary">Representação do fluxo de caixa deste ano lectivo em relação ao ano passado <br> OBS: Os valores são totais e não mudam em função do período</h6>
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
                      <i class="fas fa-circle text-success"></i> Fluxo de Caixa Esse Ano Lectivo
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-gray"></i> Fluxo de Caixa  Ano Lectivo Passado
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
    labels: ["Esse Ano Lectivo", "Fluxo de Caixa ano Lectivo passado"],
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
                      <th rowspan="2">Designação</th> 
                      <th colspan="2">Janeiro</th>
                      <th colspan="2">Fevereiro</th>  
                      <th colspan="2">Março</th>
                      <th colspan="2">Abril</th>
                      <th colspan="2">Maio</th>
                      <th colspan="2">Junho</th>
                      <th colspan="2">Julho</th> 
                      <th colspan="2">Agosto</th>  
                      <th colspan="2">Setembro</th>
                      <th colspan="2">Outubro</th>
                      <th colspan="2">Novembro</th>
                      <th colspan="2">Dezembro</th> 
                      <th colspan="2">Sub-Total</th> 

                    </tr>

                     <tr> 
                   <?php
                     for ($i=1; $i <=13 ; $i++) {  ?>

                      <th>Valor</th>
                      <th title="Dívida + Previsão de cobrança">Dívida</th>  
                  
                   <?php } ?>

                     

                    </tr>

                  </thead> 
                  <tbody>

                  <?php

                 

                  $dados_desse_ano=mysqli_fetch_array( mysqli_query($conexao,"SELECT * from anoslectivos where idanolectivo='$idanolectivo' limit 1 "));

                  $posicao_desse_ano=$dados_desse_ano["posicao"];
                  $precodareconfirmacao=$dados_desse_ano["precodareconfirmacao"];
                  $precodafalta=$dados_desse_ano["precodafalta"];
                  $datainicio=$dados_desse_ano["datainicio"];

                  $idanolectivo_anterior=mysqli_fetch_array( mysqli_query($conexao,"SELECT idanolectivo from anoslectivos where posicao<'$posicao_desse_ano' order by posicao desc limit 1 "))[0];

              

                       $tipodeentradas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas where  idanolectivo='$idanolectivo'");

                       $total_valor_por_mes[]=0;
                       $total_divida_por_mes[]=0;


                   while($exibir = $tipodeentradas->fetch_array()){

                    $tipodeentrada=$exibir['tipo'];

                      $total_valor_categoria=0;
                      $total_divida_categoria=0;
 
                      for ($i=1; $i <=12 ; $i++) { 

                        $divida_e_previsao_do_tipo[$i]=0;

                          $valor_do_tipo[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where idanolectivo='$idanolectivo'  and tipo='$tipodeentrada' and  MONTH(datadaentrada)='$i' "))[0]+0;

                          $total_valor_categoria+=$valor_do_tipo[$i];


                          $divida_do_tipo[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(divida) from entradas where idanolectivo='$idanolectivo'  and tipo='$tipodeentrada' and  MONTH(datadaentrada)='$i' "))[0]+0;

                          $divida_e_previsao_do_tipo[$i]=$divida_do_tipo[$i];
                          $previsao_do_tipo[$i]=0;

                          if($tipodeentrada=='Confirmação'){

                            $previsao_do_tipo[$i]=($precodareconfirmacao*(mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes where idanolectivo='$idanolectivo_anterior'  and  MONTH(data)='$i' and reconfirmou='0'"))));

                             $divida_e_previsao_do_tipo[$i]=$divida_do_tipo[$i]+$previsao_do_tipo[$i];

                          }else if($tipodeentrada=='Justificação de Faltas'){



                            $previsao_do_tipo[$i]=$precodafalta*(mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valordafalta)  from faltas where idanolectivo='$idanolectivo'  and  MONTH(data)='$i' "))[0]);

                             $divida_e_previsao_do_tipo[$i]=$divida_do_tipo[$i]+$previsao_do_tipo[$i];

                          }else if($tipodeentrada=='Material Escolar'){

                            $previsao_do_tipo[$i]=round((mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(preco*quantidade)  from produtos "))[0])/12);

                             $divida_e_previsao_do_tipo[$i]=$divida_do_tipo[$i]+$previsao_do_tipo[$i];

                          }


                          
                          $total_divida_categoria+=$divida_e_previsao_do_tipo[$i];

                        }


                         if($tipodeentrada=='Propina'){

                          

                         $numero_de_meses_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafim) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                         $numero_de_meses_exame=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafimexame) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

        
                          $primeiro_mes=mysqli_fetch_array( mysqli_query($conexao,"SELECT MONTH(datainicio)  from anoslectivos where idanolectivo='$idanolectivo'"))[0];


                          for ($i=1; $i <=12 ; $i++) { 


                            $j=$i-1;

                            if($j<=12-$primeiro_mes){


                                    if($i<=$numero_de_meses_normal){

                                      $previsao_do_tipo_normal[$j+$primeiro_mes]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   Date(data)<=DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and matriculaseconfirmacoes.estatus='activo' and Date(ultimomespago)<DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and turmas.eclassedeexame='Não'"))[0];


                                    }else{

                                      $previsao_do_tipo_normal[$j+$primeiro_mes]=0;

                                    }


                                   if($i<=$numero_de_meses_exame){
                              

                                    $previsao_do_tipo_exame[$j+$primeiro_mes]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   Date(data)<=DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and matriculaseconfirmacoes.estatus='activo' and Date(ultimomespago)<DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and turmas.eclassedeexame='Sim'"))[0];

                                     }else{

                                            $previsao_do_tipo_normal[$j+$primeiro_mes]=0;

                                          }

                                  
                                        $previsao_do_tipo[$j+$primeiro_mes]=$previsao_do_tipo_normal[$j+$primeiro_mes]+$previsao_do_tipo_exame[$j+$primeiro_mes];

                                        $divida_e_previsao_do_tipo[$j+$primeiro_mes]=$divida_do_tipo[$j+$primeiro_mes]+$previsao_do_tipo[$j+$primeiro_mes];

                            }else{

                               $p=$j-(12-$primeiro_mes);

                                  $previsao_do_tipo_normal[$p]=0;

                                 if($i<=$numero_de_meses_normal){

                                $previsao_do_tipo_normal[$p]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   Date(data)<=DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and matriculaseconfirmacoes.estatus='activo' and Date(ultimomespago)<DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and turmas.eclassedeexame='Não'"))[0]; 
                              
                              } 

                              
                              $previsao_do_tipo_exame[$p]=0;

                            if($i<=$numero_de_meses_exame){

                                $previsao_do_tipo_exame[$p]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   Date(data)<=DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and matriculaseconfirmacoes.estatus='activo' and Date(ultimomespago)<DATE_SUB('$datainicio', INTERVAL -'$j' MONTH) and turmas.eclassedeexame='Sim'"))[0]; 

                                 
                              } 
                                        $previsao_do_tipo[$p]=$previsao_do_tipo_normal[$p]+$previsao_do_tipo_exame[$p];

                                        $divida_e_previsao_do_tipo[$p]=$divida_do_tipo[$p]+$previsao_do_tipo[$p];


                                } 



                            }
                            
                          

                            
                          }
                      


 


                    ?>  

                   <tr>
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <?php


                        for ($i=1; $i <=12 ; $i++) { 

                        $n_total=number_format($divida_e_previsao_do_tipo[$i],2,",", "."); 

                        $total_a_receber=$valor_do_tipo[$i]+$divida_e_previsao_do_tipo[$i];
                        $total_a_receber_f=number_format($total_a_receber,2,",", ".");

                         ?>
                         
                         <td <?php   $n=number_format($valor_do_tipo[$i],2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> |Entrada(<?php echo $n; ?>) + Dívidas e previsões(<?php echo $n_total; ?>) = <?php echo $total_a_receber_f; ?> " ><?php echo $valor_do_tipo[$i]; ?></td> 

                          <td 

                            <?php 

                           $n_divida=number_format($divida_do_tipo[$i],2,",", ".");

                            $n_previsao=number_format($previsao_do_tipo[$i],2,",", ".");

                             ?> title="<?php echo $exibir['tipo']; ?> - D(<?php echo $n_divida; ?>) + P(<?php echo $n_previsao; ?>) = <?php echo $n_total; ?>" ><?php echo $divida_e_previsao_do_tipo[$i]; ?></td> 


                      <?php  } ?>

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 

                          <td <?php   $n=number_format($total_divida_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> - <?php echo $n; ?>" ><?php echo $total_divida_categoria; ?></td> 
                    </tr>
                  
                  <?php } ?>

                   </tbody> 

                   <tfoot>
                      <tr>
                      <th>Sub-total</th>



                      <?php

                       $total_valor_mes=0;
                       $total_divida_mes=0;

                        for ($i=1; $i <=12 ; $i++) {  


                        
                          $total_valor_por_mes[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where idanolectivo='$idanolectivo'  and  MONTH(datadaentrada)='$i' "))[0]+0;

                          $total_valor_mes+=$total_valor_por_mes[$i];

                          $total_divida_por_mes[$i]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(divida) from entradas where idanolectivo='$idanolectivo'  and  MONTH(datadaentrada)='$i' "))[0]+0;

                          $total_divida_mes+=$total_divida_por_mes[$i];

                         ?>
                         <th <?php   $n=number_format($total_valor_por_mes[$i],2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_valor_por_mes[$i]; ?></th> 

                          <th <?php   $n=number_format($total_divida_por_mes[$i],2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_divida_por_mes[$i]; ?></th> 


                      <?php  } ?>

                          <th <?php   $n=number_format($total_valor_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_valor_mes; ?></th> 

                          <th <?php   $n=number_format($total_divida_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_divida_mes; ?></th> 
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
