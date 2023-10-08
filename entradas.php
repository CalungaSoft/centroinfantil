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

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}


$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";

    $hoje=date('d');
    $mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
     
    $idfuncionario =$idlogado;

    if(isset($_POST['cadastrarentrada'])){
      
      $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
      $valorapagar=mysqli_escape_string($conexao, trim($_POST['valorapagar']));  
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));   
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));   
      
        $idanolectivo=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim'"))['idanolectivo'];

      $divida=round(($valorapagar-$valorpago), 2);
         $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', '$descricao', 'Outras', '$valorpago', '$divida', 0, CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");

       if($salvar){
      $acertos[]="Registo de entrada cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

}
 

 

 
if(!isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado']) ){  
   
  for ($i=1; $i <=31 ; $i++) { 
      $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from entradas where DAY(datadaentrada)='$i'"))[0];
    } 
        $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas"))[0];

 
}else if(isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado']) ){ 

    for ($i=1; $i <=31 ; $i++) { 
    $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from entradas where  DAY(datadaentrada)='$i' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
  }
      $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];

}else if(!isset($_GET['mesdevenda']) && isset($_GET['tipomarcado']) ){ 
  
  for ($i=1; $i <=31 ; $i++) { 
    $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from entradas where  DAY(datadaentrada)='$i' and tipo='$tipomarcado' "))[0];
  }
    $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  tipo='$tipomarcado'"))[0];
 
}else if(isset($_GET['mesdevenda']) && isset($_GET['tipomarcado']) ) {

  for ($i=1; $i <=31 ; $i++) { 
    $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from entradas where  DAY(datadaentrada)='$i' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) and  tipo='$tipomarcado'"))[0];
  }
  
    $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) and  tipo='$tipomarcado'"))[0];
}

include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php
      $valordeentrada=number_format($totaldeentrada,2,",", ".");
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Entradas Financeira na empresa <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"><?php echo $valordeentrada; ?>KZ</h1>
           
<br><br>
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

          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o mês</button>
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma entrada">Registrar Entradas</button> 
    <?php echo "<a title='Imprimir relatório Mensal' class='btn btn-success'  href='pdf/pdfrelatoriodeentradamensal.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda'> <i class='fas fa-fw fa-print'></i> Imprimir Relatório Mensal</a>"; ?>

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">

                                  <span>Ano</span>
                                    <select name="anodevenda" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)) as ano from entradas order by YEAR(datadaentrada) desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
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
                          <br>
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                    </div>

          </form>
        </div>
    </div>
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="post">
                      <br>
                    <div class="form-group">
                       <input type="text" name="descricao" class="form-control" title="Descreve aqui a entrada" placeholder="Descricao da Entrada" required="">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="number" name="valorapagar" class="form-control " title="Valor a ser pago pelo aluno" placeholder="Valor a Pagar" required="" >
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="valorpago" class="form-control " title="Valor pago pelo aluno" placeholder="Valor Pago" required="">
                        </div> 
                    </div> 

                    <?php 

                     $htm='

                        <div class="form-group"> 

                            <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                        $htm.='
                                      <option  value="'.$exibir["formadepagamento"].'">'.$exibir["formadepagamento"].'</option>
                                    ';}

                                    $htm.='
                                </select> 
       
                      
                        </div> ';

                        echo "$htm";



                    ?>
                                <br>OBS: As entradas feitas aqui, irão todas na categorias "Outras". e será registado como um valor do ano lectivo em vigor
                          <br> 
                       <input type="submit" value="Cadastrar Entrada" name="cadastrarentrada" class="btn btn-success" style="float: rigth;">
            

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
                    
                    <!-- Content Row -->
                    <div class="row">  
                    <?php  

                          $diferentestipodeentradas=mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas");

                          while($exibir = $diferentestipodeentradas->fetch_array()){


                                $tipo=$exibir["tipo"]; 

                                if(!isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado'])){
                                  $quantidadedeentradas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where tipo='$tipo'"))[0];
                                }
                                 else if(isset($_GET['mesdevenda']) && isset($_GET['tipomarcado'])){ 

                                  $quantidadedeentradas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where tipo='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)"))[0];}

                                 else if(!isset($_GET['mesdevenda']) && isset($_GET['tipomarcado'])){
                                  $quantidadedeentradas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where tipo='$tipo'"))[0]; }
                                  
                                 else  if(isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado'])){
                                  $quantidadedeentradas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where tipo='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)"))[0];}
                                 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4"> 
                  <a href="entradas.php?tipomarcado=<?php echo "$tipo";  ?><?php if(isset($_GET['mesdevenda'])){ ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?><?php }?>"><div class="card border-left-info shadow h-100 py-2" <?php if($tipomarcado==$tipo){?> style="background-color: gray;" <?php } ?>>
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <?php echo $exibir["tipo"];  ?> | <?php $quantidadedeentradasf=number_format($quantidadedeentradas,2,",", "."); echo $quantidadedeentradasf; ?> /<?php   echo $totaldeentrada; ?></div>
                          <div class="row no-gutters align-items-center"><?php if($totaldeentrada==0){$totaldeentrada=1;} $percentagem=round($quantidadedeentradas*100/$totaldeentrada); ?>
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
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
					<?php print $dia[12]?>,
					<?php print $dia[13]?>,
					<?php print $dia[14]?>,
					<?php print $dia[15]?>,
					<?php print $dia[16]?>,
					<?php print $dia[17]?>,
					<?php print $dia[18]?>,
					<?php print $dia[19]?>,
					<?php print $dia[20]?>,
					<?php print $dia[21]?>,
					<?php print $dia[22]?>,
					<?php print $dia[23]?>,
					<?php print $dia[24]?>,
					<?php print $dia[25]?>,
					<?php print $dia[26]?>,
					<?php print $dia[27]?>,
					<?php print $dia[28]?>,
					<?php print $dia[29]?>,
					<?php print $dia[30]?>,
					<?php print $dia[31]?> 
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
						text: 'Gráficos Mostrando o Fluxo de Entradas'
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






        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Registros de Entradas</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
              
                <br>
                <span id="mensagemdealerta"></span> 
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Designação</th> 

                      <?php

                             $diferentesdias= mysqli_query($conexao,"select DISTINCT(DAY(datadaentrada)) from entradas where '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada)");

                             $dias_diferentes=[];

                         while($exibir_dia = $diferentesdias->fetch_array()){

                              $dias_diferentes[]=$exibir_dia[0];

                            echo "<th><a href='contaseusuariosdiario.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda&diadevenda=$exibir_dia[0]'>Dia $exibir_dia[0]</a> | <a title='Imprimir relatório dia $exibir_dia[0]' href='pdf/pdfrelatoriodeentradadiario.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda&diadevenda=$exibir_dia[0]'> <i class='fas fa-fw fa-print'></i></a></th>";
                      } ?>
                         


                      <th>Sub-Total <?php echo "<a title='Imprimir relatório Mensal' href='pdf/pdfrelatoriodeentradamensal.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda'> <i class='fas fa-fw fa-print'></i></a>"; ?></th> 

                    </tr>
 

                  </thead> 
                  <tbody>

                  <?php

                 

                   

                       $tipodeentradas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas where  YEAR(datadaentrada)='$anodevenda' AND '$mesdevenda'=MONTH(datadaentrada) ");

                       $total_valor_por_mes[]=0;
                    


                   while($exibir = $tipodeentradas->fetch_array()){



                    $tipodeentrada=$exibir['tipo'];

                      $total_valor_categoria=0;
                   
   
                      


 


                    ?>  

                   <tr>
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <?php


                        foreach ($dias_diferentes as $key => $value) {
                  
                         $valor_do_tipo[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where  tipo='$tipodeentrada' and YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value' "))[0]+0;

                          $total_valor_categoria+=$valor_do_tipo[$value];

  

                         ?>
                         
                         <td <?php   $n=number_format($valor_do_tipo[$value],2,",", "."); ?> title="<?php echo $exibir['tipo']; ?> |Entrada(<?php echo $n; ?>)  " ><?php echo $valor_do_tipo[$value]; ?></td> 

                           


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
                    

                              foreach ($dias_diferentes as $key => $value) {
                 
                        
                          $total_valor_por_mes[$value]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(valor) from entradas where YEAR(datadaentrada)='$anodevenda'  and  MONTH(datadaentrada)='$mesdevenda' and DAY(datadaentrada)='$value' "))[0]+0;

                          $total_valor_mes+=$total_valor_por_mes[$value];

                        

                         ?>
                         <th <?php   $n=number_format($total_valor_por_mes[$value],2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_valor_por_mes[$value]; ?></th> 
 


                      <?php  } ?>

                          <th <?php   $n=number_format($total_valor_mes,2,",", "."); ?> title="<?php echo $n; ?>" ><?php echo $total_valor_mes; ?></th> 
 
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

      <script>


                                                        $(document).on("blur", ".update", function(){
                                                                var id=$(this).data("id");
                                                                var nomedacoluna=$(this).data("column");
                                                                var valor=$(this).text();
                                                                 

                                                                $.ajax({
                                                                    url:'cadastro/updateentradas.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id, 
                                                                        nomedacoluna:nomedacoluna,
                                                                         valor:valor
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                                    }

                                                                })
                                                            })


                                                            $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deleteentrada.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })



      </script>
      
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
