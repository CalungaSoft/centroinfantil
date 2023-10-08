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

  
      $TOTALCAIXA = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim'"))[0] -  mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM saidas where idanolectivo='$idanolectivo'  and datadasaida>='$datainicio' and datadasaida<='$datafim' "))[0]; 
 ;

      $primeiradata=mysqli_fetch_array( mysqli_query($conexao,"SELECT datadaentrada from entradas where idanolectivo='$idanolectivo' order by datadaentrada asc limit 1"))[0];
    
      $ultimadata=mysqli_fetch_array( mysqli_query($conexao,"SELECT datadaentrada from entradas where idanolectivo='$idanolectivo' order by datadaentrada desc limit 1"))[0];
  
  
         
       
   include("cabecalho.php");?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php
      

       $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo'"));

       $anolectivo=$dadosdoanolectivo["titulo"];

      $TOTALCAIXA_f=number_format($TOTALCAIXA,2,",", ".");
?>
 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Fluxo de Caixa <?php if(isset($_GET['idanolectivo'])){ echo "| <a href='anolectivo.php?idanolectivo=$idanolectivo'> $anolectivo </a>"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?> | De <?php echo $datainicio; ?> até <?php echo $datafim; ?> </h1>
          <h1 style="font-size: 70px; text-align: center">Total No caixa: <?php echo $TOTALCAIXA_f; ?>KZ</h1>
           

   
         <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Período</button>
  
       <a href="pdf/relatorioanual.php?idanolectivo=<?php echo $idanolectivo; ?>&mesinicio=<?php echo $mesinicio; ?>&anoinicio=<?php echo $anoinicio; ?>&mesfim=<?php echo $mesfim; ?>&anofim=<?php echo $anofim; ?>"> <button   class="btn btn-info" >Imprimir Relatório Anual</button></a>
        
              <br> <br>              
 
 <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de  Antendimentos por funcionário / Formas de Pagamento</h6>
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
                  <?php $listadefuncionários=mysqli_query($conexao, "select DISTINCT(funcionarios.idfuncionario ), funcionarios.nomedofuncionario, funcionarios.idfuncionario from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario and entradas.idanolectivo='$idanolectivo'");
                   while($exibir = $listadefuncionários->fetch_array()){
                    $idfuncionario=$exibir["idfuncionario"];
                       ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                   
                      <?php   $formasdepagamentolista=mysqli_query($conexao, "select * from formasdepagamento"); 
                      $total_entrada=0;
                      $total_saida=0;
                            while($exibir2 = $formasdepagamentolista->fetch_array()){ 
                                $tipo=$exibir2["formadepagamento"];

                                $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas  where idfuncionario='$idfuncionario' AND formadepagamento='$tipo' and idanolectivo='$idanolectivo'"))[0];

                                $totalsaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas  where idfuncionario='$idfuncionario' AND formadesaida='$tipo' and idanolectivo='$idanolectivo'"))[0];
  
                                $total_entrada+=$totaldeentrada;
                                $total_saida+=$totalsaida;

                                $valorf=number_format($totaldeentrada-$totalsaida,2,",", "."); 
                                ?>
                      <td title="Entradas(<?php echo $totaldeentrada; ?>) - Saídas(<?php echo $totalsaida; ?>) "><?php echo $valorf; ?></td>
                    
                      <?php }
                      $totalf=number_format($total_entrada-$total_saida,2,",", "."); 
                      
                      ?>
                      <td title="Entradas(<?php echo $total_entrada; ?>) - Saídas(<?php echo $total_saida; ?>) " ><?php echo $totalf; ?></td>
                    </tr> 
                  <?php } ?>

                      <tr>
                        <th>Total</th>
                   <?php   $listadefuncionários=mysqli_query($conexao, "select * from formasdepagamento"); 

                      $total_todos_entradas=0;
                      $total_todos_saidas=0;
                            while($exibir2 = $listadefuncionários->fetch_array()){ 
                                   $tipo=$exibir2["formadepagamento"];

                                          $totaldeentrada_for = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas  where  formadepagamento='$tipo' and idanolectivo='$idanolectivo'"))[0];
                                          $totaldesaida_for = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas  where  formadesaida='$tipo' and idanolectivo='$idanolectivo'"))[0];


                                          $total_todos_entradas+=$totaldeentrada_for;
                                          $total_todos_saidas+=$totaldesaida_for;
                                          $valorf=number_format($totaldeentrada_for-$totaldesaida_for,2,",", ".");
                                   ?>
                        <th title="Entradas(<?php echo $totaldeentrada_for; ?>) - Saídas(<?php echo $totaldesaida_for; ?>) " ><?php echo $valorf; ?></th>
                        <?php }      $valor_todos_f=number_format($total_todos_entradas-$total_todos_saidas,2,",", "."); ?>
                        
                        <th title="Entradas(<?php echo $total_todos_entradas; ?>) - Saídas(<?php echo $total_todos_saidas; ?>) " ><?php echo $valor_todos_f; ?></th>

                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>




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
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas order by datadaentrada asc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                                  <?php } ?> 
                              </select>  
                        </div>
                        <div class="col-sm-6"> 
                         <span>No Mês de </span> 
                              <select name="mesinicio"  required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes from entradas order by datadaentrada asc");
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
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas order by datadaentrada desc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                                  <?php } ?> 
                              </select> 
                        </div>
                        <div class="col-sm-6"> 
                                <span>No Mês de </span> 
                              <select name="mesfim"   required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes from entradas order by datadaentrada desc");
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

  
 
  $entradas=mysqli_fetch_array(mysqli_query($conexao, "SELECT sum(valor) FROM entradas where idanolectivo='$idanolectivo'  and datadaentrada>='$datainicio' and datadaentrada<='$datafim'"))[0]; 
  $saidas=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM saidas where idanolectivo='$idanolectivo'  and datadasaida>='$datainicio' and datadasaida<='$datafim' "))[0]; 
 
 
 
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

                $lista_de_anos=[];

                $mes_c=[];
                $ano_c=[];

                $valormes=[];
                $saidames=[];
                $caixames=[];

                   $anoactual=date('Y');
               
                $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim' order by datadaentrada asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];
                                $lista_de_anos[]=$ano;

                   $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes  from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and ((MONTH(datadaentrada)>='$mesinicio' and MONTH(datadaentrada)<=12) or (MONTH(datadaentrada)>=1 and MONTH(datadaentrada)<='$mesfim') ) order by datadaentrada asc ");
                            
                            while($exibir = $lista->fetch_array()){ 
                                    

                                    $mes=$exibir["mes"];

                                    $mes_c[]=$mes;
                                    $ano_c[]=$ano;



                                    $valornasentradas=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and tipo!='Propina'"))[0];

                                    $valornaspropinas= mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from propinas where  idanolectivo='$idanolectivo' and YEAR(mespago)='$ano' and MONTH(mespago)='$mes'"))[0];

                                    $valormes[] = $valornasentradas+$valornaspropinas;

                                    $saidames[] = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  idanolectivo='$idanolectivo' and YEAR(datadasaida)='$ano' and MONTH(datadasaida)='$mes'"))[0];

 
                                  $caixames[]= $valornasentradas+$valornaspropinas -mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  idanolectivo='$idanolectivo' and YEAR(datadasaida)='$ano' and MONTH(datadasaida)='$mes'"))[0];

                                       
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

          foreach ($caixames as $key => $value) {
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
                  <h6 class="m-0 font-weight-bold text-primary">Representação do fluxo de caixa deste ano lectivo - Entradas e saídas</h6>
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
                      <i class="fas fa-circle text-success"></i> Fluxo de Entradas
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> Fluxo de saídas
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
    labels: ["Saídas", "Entradas"],
    datasets: [{
      data: [<?php print $saidas?>, <?php print $entradas?>],
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
                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th>$value</th>";  
                            } 

                     ?>

                        <th>Total</th>
                       
                    </tr>
 

                  </thead> 


                   <thead>
                  <tr>
                      <th style='background-color:blue'></th>
                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th style='background-color:blue'></th>";  
                            } 

                     ?>

                        <th style='background-color:blue'></th>
                       
                    </tr>

                    </thead>


                  <tbody>

                  <?php

                 

                   

                       $tipodeentradas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas where  idanolectivo='$idanolectivo' and tipo!='Tratar Documento' and tipo!='Material Escolar' and tipo!='Propina'");

                       $total_valor_por_mes[]=0;
                    


                   while($exibir_ca = $tipodeentradas->fetch_array()){

                    $tipodeentrada=$exibir_ca['tipo'];

                      $total_valor_categoria=0;
                   
  
                     
                      
                          ?>

                             <tr>
                                <td><?php echo $exibir_ca["tipo"]; ?></td>


                    <?php

                    foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and  tipo='$tipodeentrada'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                          
                                          ?>

                                           <td <?php   $n=number_format($valormes_categoria,2,",", "."); ?> title="<?php echo $exibir_ca['tipo']; ?> |Entrada(<?php echo $n; ?>)  " ><?php echo $valormes_categoria; ?></td> 

                                        <?php
                                  
                                   
                                    }
                             


                    ?>  

               
                    
                        

                           


                   

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 
 
                    </tr>
                  
                  <?php } ?>


 
                  <tr>
                                <td>Propinas</td>


                    <?php

                          $total_valor_categoria=0;

                  foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago-multa) from propinas where  idanolectivo='$idanolectivo' and YEAR(mespago)='$ano' and MONTH(mespago)='$mes'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                          
                                          ?>

                                           <td <?php   $n=number_format($valormes_categoria,2,",", "."); ?> title="Propinas |Entrada(<?php echo $n; ?>)  " ><?php echo $valormes_categoria; ?></td> 

                                        <?php
                                  
                                   
                                    }

                                
                           


                    ?>  

               
                    
                        

                           


                   

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 
 
                    </tr>




                     <tr>
                                <td>Multa (Propinas)</td>


                    <?php

                          $total_valor_categoria=0;

                     foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(multa) from propinas where  idanolectivo='$idanolectivo' and YEAR(mespago)='$ano' and MONTH(mespago)='$mes'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                          
                                          ?>

                                           <td <?php   $n=number_format($valormes_categoria,2,",", "."); ?> title="Propinas |Entrada(<?php echo $n; ?>)  " ><?php echo $valormes_categoria; ?></td> 

                                        <?php
                                  
                                   
                                    
                           
                                  }

                   
                    ?>  

               
                    
                        

                           


                   

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 
 
                    </tr>



               


                    <?php

                       //Para trazer as propinas

                        
 

                    //Para trazer os documentos Tratados 


                       $documentos_tratados =mysqli_query($conexao,"SELECT DISTINCT(tipodedocumento) from documentostratados where  idanolectivo='$idanolectivo' ");

          


                   while($exibir_ca = $documentos_tratados->fetch_array()){

                    $tipodeentrada=$exibir_ca['tipodedocumento'];
                               $total_valor_categoria=0;
                    ?>
                  <tr>
                                <td><?php echo $exibir_ca["tipodedocumento"]; ?></td>


                    <?php


                   foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from documentostratados where  idanolectivo='$idanolectivo' and YEAR(datadeentrada)='$ano' and MONTH(datadeentrada)='$mes' and  tipodedocumento='$tipodeentrada'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                          
                                          ?>

                                           <td <?php   $n=number_format($valormes_categoria,2,",", "."); ?> title="<?php echo $exibir_ca['tipodedocumento']; ?> |Entrada(<?php echo $n; ?>)  " ><?php echo $valormes_categoria; ?></td> 

                                        <?php
                                  
                                   
                                    }
                             



                    ?>  

               
                    
                        

                           


                   

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 
 
                    </tr>



                    <?php

                       //Para trazer os documentos Tratados 

                        } ?>






                          <?php

                    //Para trazer materiais escolares


                       $produtos_comprados =mysqli_query($conexao,"SELECT DISTINCT(compra.idproduto) as idproduto, produtos.nomedoproduto from compra, produtos where  idanolectivo='$idanolectivo' and compra.idproduto=produtos.idproduto");

          


                   while($exibir_ca = $produtos_comprados->fetch_array()){

                    $tipodeentrada=$exibir_ca['idproduto'];

                   




                               $total_valor_categoria=0;
                    ?>
                  <tr>
                                <td><?php echo $exibir_ca["nomedoproduto"]; ?></td>


                    <?php

                   foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from compra where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and MONTH(data)='$mes' and  idproduto='$tipodeentrada'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                          
                                          ?>

                                           <td <?php   $n=number_format($valormes_categoria,2,",", "."); ?> title="<?php echo $exibir_ca['nomedoproduto']; ?> |Entrada(<?php echo $n; ?>)  " ><?php echo $valormes_categoria; ?></td> 

                                        <?php
                                  
                                   
                                    
                              }



                    ?>  

               
                    
                        

                           


                   

                          <td <?php   $n=number_format($total_valor_categoria,2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> | <?php echo $n; ?>" ><?php echo $total_valor_categoria; ?></td> 
 
                    </tr>



                    <?php
                    
                       //Para trazer os documentos Tratados 

                        } ?>



                   </tbody> 

                   <tbody>
                      <tr>
                      <th>Sub-total Entradas</th>



                      <?php

                       $total_valor_mes=0;
                    
  
                         

                        

                         ?>
                          
 

                           <?php 

                        foreach ($valormes as $key => $value) {
                           $n=number_format($value,2,",", ".");
                               echo "<th>$n</th>"; 

                                $total_valor_mes+=$value;  
                            } 

                         ?>
 


                  

                          <th <?php   $n=number_format($total_valor_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $n; ?></th> 
 
                    </tr>
                  

                   </tbody>

                    <thead>
                  <tr>
                      <th style='background-color:red'></th>
                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th style='background-color:red'></th>";  
                            } 

                     ?>

                        <th style='background-color:red'></th>
                       
                    </tr>

                    </thead>


                     <thead>
                  <tr>
                      <th>Custos</th>
                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th>--</th>";  
                            } 

                     ?>

                        <th>-</th>
                       
                    </tr>

                    </thead>


                   
                    <tbody>
                    <?php

                     $lista_das_categorias=mysqli_query($conexao,"SELECT DISTINCT(categoria) from tipodesaidas");
                            
                            while($vercategorias = $lista_das_categorias->fetch_array()){   

                              $categoria_saida=$vercategorias["categoria"];

                              $soma_categoria=0;

                       echo " <tr>

                        <td>$vercategorias[categoria]</td>"; 

                        
                            foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                             $lista_de_categoria_desaida=mysqli_query($conexao,"SELECT DISTINCT(idtipodesaida)  from tipodesaidas where categoria='$categoria_saida' ");

                                             $valormes_categoria_saida=0;
                                    
                                          while($ver = $lista_de_categoria_desaida->fetch_array()){ 

                                                  $idtipo=$ver["idtipodesaida"];



                                                  $valormes_categoria_saida+= mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  idanolectivo='$idanolectivo' and YEAR(datadasaida)='$ano' and MONTH(datadasaida)='$mes' and  idtipo='$idtipo'"))[0];

                                                }
                                               $soma_categoria+=$valormes_categoria_saida;

                                                  
                                                  ?>

                                                   <td <?php   $n=number_format($valormes_categoria_saida,2,",", "."); ?> title="<?php echo $vercategorias['categoria']; ?> |Saída(<?php echo $n; ?>)  " ><?php echo $valormes_categoria_saida; ?></td> 

                                                <?php
                                          
                                           
                                            
                            }


 

                     ?>

                       <th <?php   $n=number_format($soma_categoria,2,",", "."); ?>   ><?php echo $n; ?></th> 
                       
                    </tr>

                    <?php } ?>


 

                 </tbody> 


                   <tbody>
                      <tr>
                      <th>Sub-total Saídas</th>



                      <?php

                       $total_valor_mes=0;
                    
  
                         

                        

                         ?>
                          
 

                           <?php 

                        foreach ($saidames as $key => $value) {

                           $n=number_format($value,2,",", ".");

                               echo "<th>$n</th>"; 

                                $total_valor_mes+=$value;  
                            } 

                         ?>
 


                  

                          <th <?php   $n=number_format($total_valor_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $n; ?></th> 
 
                    </tr>
                  

                   </tbody>


                      <thead>
                  <tr>
                      <th style='background-color:green'></th>
                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th style='background-color:green'></th>";  
                            } 

                     ?>

                        <th style='background-color:green'></th>
                       
                    </tr>

                    </thead>


      
                   <tbody>
                      <tr>
                      <th>Total no Caixa</th>



                      <?php

                       $total_valor_mes=0;
                    
  
                         

                        

                         ?>
                          
 

                           <?php 

                        foreach ($caixames as $key => $value) {

                           $n=number_format($value,2,",", ".");

                               echo "<th>$n</th>"; 

                                $total_valor_mes+=$value;  
                            } 

                         ?>
 


                  

                          <th <?php   $n=number_format($total_valor_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $n; ?></th> 
 
                    </tr>
                  

                   </tbody>
                    
                </table>
              </div>
            </div>
          </div>

       
      <!-- End of Main Content -->




        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Previsão de cobrança de propinas</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                    
        
                <br>
                <span id="mensagemdealerta"></span> 
                <table class="table table-bordered"  width="100%" cellspacing="0">
                   
                  <thead>
                  <tr>
                      <th>Designação</th>

                         <?php

                $meses=[];
                $valormes=[];
                $saidames=[];
                $caixames=[];
 

                $mesinicio_anolectivo=$dadosdoanolectivo["mesinicio"];
                $mesfim_anolectivo=$dadosdoanolectivo["mesfim"];

                $anoinicio_anolectivo=$dadosdoanolectivo["anoinicio"];
                $anofim_anolectivo=$dadosdoanolectivo["anofim"];

                $previsao=[];

                $arrecadado=[]; 

                $emfalta=[];



                 $numero_de_meses_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafim) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                 $numero_de_meses_exame=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafimexame) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

        

                   $anoactual=date('Y');
                
 
                   $contador_normal=0;
                   $contador_exame=0;

                  for ($i=$mesinicio_anolectivo; $i <=12 ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anoinicio_anolectivo;

  
                                   
 
                                 
                                    $data_de_cadastro_formada="$ano-$i-31"; //2021-08-31
                                    $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                              

                                    $previsao_normal=0; $previsao_exame=0;


                                    if($contador_normal<=$numero_de_meses_normal){

                                       $previsao_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro'  and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                     

                                    $previsao[]=$previsao_normal+$previsao_exame;

 

                                  

                                       $arrecadado[]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propinas.valorpago-propinas.multa)  from propinas  where idanolectivo='$idanolectivo'  and mespago='$data_de_propina_formada'"))[0];

                                     

                                   

                                      


                                     
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                    $emfalta[]=$emfalta_normal+$emfalta_exame;


                                    $contador_normal++; $contador_exame++;

                                   if($mes==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($mes==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($mes==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($mes==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($mes==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($mes==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($mes==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($mes==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($mes==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($mes==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($mes==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($mes==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }



                               if($anoinicio_anolectivo!=$anofim_anolectivo){

                                    for ($i=1; $i <=$mesfim_anolectivo ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anofim_anolectivo;


                                     $data_de_cadastro_formada="$ano-$i-31"; //2022-01-31
                                      $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                                   

                                    $previsao_normal=0; $previsao_exame=0;


                                    if($contador_normal<=$numero_de_meses_normal){

                                       $previsao_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"))[0];

                                    }

                                     $previsao[]=$previsao_normal+$previsao_exame;


                                      $arrecadado[]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propinas.valorpago-propinas.multa)  from propinas  where idanolectivo='$idanolectivo'  and mespago='$data_de_propina_formada'"))[0];
 

                                      $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                    $emfalta[]=$emfalta_normal+$emfalta_exame;




                                     $contador_normal++; $contador_exame++;

                                   
                                       

                                       
                                   if($mes==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($mes==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($mes==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($mes==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($mes==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($mes==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($mes==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($mes==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($mes==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($mes==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($mes==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($mes==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }

                            }
                              
                               
                ?>


                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th>$value</th>";  
                            } 

                     ?>

                        
                       
                    </tr>
 

                  </thead> 

                  <tbody>

                    <tr>
                      
                        <th>Previsão</th>
                      <?php 

                    

                        foreach ($previsao as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               echo "<td>$n</td>";  

                           

                            } 

                     ?>

                    </tr>

                    <tr>
                      
                        <td title="Soma Acumulada">Acumulada</td>
                      <?php 

                        $soma_acumulada=0;

                        foreach ($previsao as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                               echo "<td>$n</td>";  
                            } 

                     ?>

                    </tr>
                 
                   </tbody> 


                   <thead>
                  <tr>
                      <th style='background-color:blue'></th>
                      <?php 

                        foreach ($previsao as $key => $value) {
                               echo "<th style='background-color:blue'></th>";  
                            } 

                     ?>
 
                       
                    </tr>

                    </thead>


                     <tbody>

                    <tr>
                      
                        <th>Arrecadado</th>
                      <?php 

                    

                        foreach ($arrecadado as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               echo "<td>$n</td>";  

                           

                            } 

                     ?>

                    </tr>

                    <tr>
                      
                        <td title="Soma Acumulada">Acumulada</td>
                      <?php 

                        $soma_acumulada=0;

                        foreach ($arrecadado as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                               echo "<td>$n</td>";  
                            } 

                     ?>

                    </tr>
                  
                    
                   </tbody> 
                
                 <thead>
                  <tr>
                      <th style='background-color:green'></th>
                      <?php 

                        foreach ($previsao as $key => $value) {
                               echo "<th style='background-color:green'></th>";  
                            } 

                     ?>
 
                       
                    </tr>

                    </thead>

                     <tbody>

                    <tr>
                      
                        <th>Em Falta</th>
                      <?php 

                    

                        foreach ($emfalta as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               echo "<td>$n</td>";  

                           

                            } 

                     ?>

                    </tr>

                    <tr>
                      
                        <td title="Soma Acumulada">Acumulada</td>
                      <?php 

                        $soma_acumulada=0;

                        foreach ($emfalta as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                               echo "<td>$n</td>";  
                            } 

                     ?>

                    </tr>
                 
                   </tbody> 

                    <thead>
                  <tr>
                      <th style='background-color:red'></th>
                      <?php 

                        foreach ($previsao as $key => $value) {
                               echo "<th style='background-color:red'></th>";  
                            } 

                     ?>
 
                       
                    </tr>

                    </thead>



                </table>
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
