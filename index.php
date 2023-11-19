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

  

   



  if(!( $painellogado=="secretaria1" || $painellogado=="secretaria2"  || $painellogado=="administrador" || $painellogado=="RH")){
   header('Location: login.php');
}

    if(isset($_POST['cadastrarsaida'])){
      
      $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
      $valorasair=mysqli_escape_string($conexao, trim($_POST['valorasair']));  
      $valorparaconsolidar=mysqli_escape_string($conexao, trim($_POST['valorparaconsolidar']));  
      $idtipo=mysqli_escape_string($conexao, trim($_POST['tipo'])); 
      $idanolectivo=mysqli_escape_string($conexao, trim($_POST['idanolectivo']));  
      $formadesaida=mysqli_escape_string($conexao, trim($_POST['formadesaida']));  
      $datadesaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));  

    
 
      $tipo=mysqli_fetch_array(mysqli_query($conexao,"SELECT tipo FROM `tipodesaidas` where idtipodesaida='$idtipo'"))[0];
      $updating=mysqli_query($conexao,"UPDATE `tipodesaidas` SET `numerodesaida` = `numerodesaida`+'1' WHERE `tipodesaidas`.`idtipodesaida` = '$idtipo'");

      

         $salvar1=mysqli_query($conexao,"INSERT INTO `saidas` (`idsaida`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `datadasaida`, `idtipo`, idanolectivo, formadesaida) VALUES (NULL, '$idlogado', '$descricao', '$tipo', '$valorasair', '$valorparaconsolidar', '$datadesaida', '$idtipo', '$idanolectivo', '$formadesaida')");

       if($salvar1){

            $mes=Date('m'); $ano=Date('Y');

            if(mysqli_num_rows(mysqli_query($conexao,"SELECT identrada FROM `entradas` where YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and idanolectivo='$idanolectivo'"))==0){

                 $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', 'Controlo', 'Outras', '0', '0', 0, CURRENT_TIMESTAMP, '', '$idanolectivo')");

            }
            
        $acertos[]="Registo de Saída cadastrado com sucesso!";
      }else{
        $erros[]="ocorreu algum erro!";
      } 

}
 
 


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
 


            $dia1v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 6 DAY)"));
            $dia2v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 5 DAY)"));
            $dia3v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 4 DAY)"));
            $dia4v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 3 DAY)"));
            $dia5v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 2 DAY)"));
            $dia6v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 1 DAY)"));
            $dia7v = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from entradas where Date(datadaentrada)=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"));
          
            $dia1vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where  Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 6 DAY)"));
            $dia2vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 5 DAY)"));
            $dia3vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 4 DAY)"));
            $dia4vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 3 DAY)"));
            $dia5vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 2 DAY)"));
            $dia6vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 1 DAY)"));
            $dia7vs = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"));
          

             
            $saidahoje = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"))[0];

            $totaldeaniversariantes=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where MONTH(datadenascimento)=MONTH(curdate())"));

            $totaldeActividades=mysqli_num_rows(mysqli_query($conexao, "select * from agenda where Week(datainicio)=Week(curdate())")); 


             $totaldelembretes=mysqli_num_rows(mysqli_query($conexao, "select * from lembretes where Week(datadolembrete)=Week(curdate())")); 
            
           
           for ($i=0; $i <=6 ; $i++) { 

            $dat=date('d-m-Y', strtotime("- $i days"));
 

              $datas[$i]=date('D', strtotime($dat)); 
                
           }
              $semana=array('Sun' =>'Domingo','Mon' =>'Segunda','Tue' =>'Terça','Wed' =>'Quarta', 'Thu' =>'Quinta','Fri' =>'Sexta','Sat' =>'Sábado');

          

           foreach ($datas as $key => $value) {

              $ultimos_sete_dias[]=$semana["$value"];
                
           }
 
              
        

            $anodehoje=date('Y');
  $mesdehoje=date('m');


 


   include("cabecalho.php"); ?>
 
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-500"><?php echo date("d"); echo "/"; echo date("m"); echo "/"; echo date("Y") ;?></h1>

              <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>
            <a href="pdf/pdfrelariodiario.php?" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Imprimir Livro de Caixa diario</a>
            <a href="presenca.php" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-fw fa-table"></i> Marcar Presença dos Funcionários</a>
            <?php } ?>
          </div>
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

<?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>
    <button id="myBtn" class="btn btn-primary">Registrar Entrada de Dinheiro</button>

     
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Registrar saída de dinheiro</button> 
<?php } ?>
<br><br>
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
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
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="post">
                      <br>
                    <div class="form-group">
                       <input type="text" name="descricao" class="form-control" title="Descreve aqui a saída" placeholder="Descrição da saída" required="">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="number" name="valorasair" class="form-control " title="Valor a sair nesse exacto momento" placeholder="Valor a sair" required="" >
                        </div>
                        <div class="col-sm-6">
                            <input type="number" name="valorparaconsolidar" class="form-control " title="Valor que faltará para que essa saída seja consolidada" placeholder="Valor em falta para sua consolidação" >
                        </div> 
                    </div>
                    <span>Categoria de Saída: </span>
                    <div class="form-group">
                    <select name="tipo" required  class="form-control" title="Escolha aqui a categoria onde essa saída se encaixa"> 
                      <?php
                           $diferentestipodesaidas=mysqli_query($conexao,"SELECT * from tipodesaidas order by numerodesaida desc");
                          while($exibir = $diferentestipodesaidas->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idtipodesaida"]; ?>"><?php echo $exibir["tipo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 


                     <?php 

                     $htm='

                        <div class="form-group"> 

                            <span>Forma de saída</span>
                                  <select name="formadesaida" required  class="form-control" title="Forma de Saída"  > 
                                  <option disabled="">Formas de Saída</option>
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

                   
                    <div class="form-group"> <?php $data_de_hoje=date('Y-m-d H:m'); ?>
                       <input type="text" name="datadasaida" class="form-control" title="Data da saida" placeholder="Data da saída" value="<?php echo $data_de_hoje; ?>">
                    </div>

                          <br>
                       <input type="submit" value="Cadastrar Saída" name="cadastrarsaida" class="btn btn-success" style="float: rigth;">
            

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


        <!-- Begin Page Content -->
        <div class="container-fluid">

    

          <!-- Content Row -->
          <div class="row">
          <!-- Earnings (Monthly) Card Example -->
          
          <div class="col-xl-3 col-md-6 mb-3">
          <a href="aniversariantes.php">
              <div class="card border-left-warning shadow h-100 py-2"> 
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total de Aniversariantes | actividades | Lembretes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totaldeaniversariantes; ?> | <?php echo $totaldeActividades; ?> | <?php echo $totaldelembretes; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>  </a>
            </div>
          

 

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-3">
             <a href="entradas.php?anodevenda=<?php echo $anodehoje; ?>&mesdevenda=<?php echo $mesdehoje; ?>">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entrada No Caixa Hoje</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php $n=number_format($dia7v[0],2,",", "."); echo $n; ?></div> <script>
 
                      </script> 
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>

            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-3">
            <a href="saidas.php?anodevenda=<?php echo $anodehoje; ?>&mesdevenda=<?php echo $mesdehoje; ?>">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Saída No Caixa Hoje</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php $n=number_format($saidahoje,2,",", "."); echo $n; ?></div> <script>
 
                      </script> 
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>

<?php 
$anoctual=date('Y');
$mesactual=date('m');

 $idanolectivo=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim'"))[0];

$data_de_hoje="$anoctual-$mesactual-01";
 
$totaldeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo'   and estatus='activo'")); 

$matriculaseconfirmacoesquejapagaram=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM matriculaseconfirmacoes where  (ultimomespago>='$data_de_hoje' or tipodealuno='Bolseiro') and idanolectivo='$idanolectivo'")); 

$mespassado=$mesactual-01;
$data_do_mespassado="$anoctual-$mespassado-01";
 

$matriculaseconfirmacoesquepagaramespassado=mysqli_num_rows(mysqli_query($conexao, "SELECT idaluno FROM matriculaseconfirmacoes where  (ultimomespago='$data_do_mespassado' and tipodealuno!='Bolseiro') and idanolectivo='$idanolectivo'")); 

$matriculaseconfirmacoesquenaopagarammespassado=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM matriculaseconfirmacoes where (ultimomespago<'$data_do_mespassado' and tipodealuno!='Bolseiro') and idanolectivo='$idanolectivo' and estatus='activo'")); 
  
if($totaldeestudantes==0){$totaldeestudantes=0.00001;}
$percentagemtotal=round($matriculaseconfirmacoesquejapagaram*100/$totaldeestudantes);
 
?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-3" title="<?php echo $percentagemtotal;  ?>% Dos alunos já pagaram a mensalidade para o Mês actual">
            <a href="propinaestatisticaematraso.php?idanolectivo=<?php echo $idanolectivo; ?>">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Estado das Propinas</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagemtotal";  ?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo "$percentagemtotal";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
 


           

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-9 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fluxo de Caixa Nos Últimos 7 dias (Entradas e Saídas)</h6>
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
          labels: ['<?php print $ultimos_sete_dias[6]?>', '<?php print $ultimos_sete_dias[5]?>', '<?php print $ultimos_sete_dias[4]?>', '<?php print $ultimos_sete_dias[3]?>', '<?php print $ultimos_sete_dias[2]?>', '<?php print $ultimos_sete_dias[1]?>', '<?php print $ultimos_sete_dias[0]?>'],
          datasets: [{
         label: "Restou",
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
          data: [<?php print $dia1v[0]-$dia1vs[0]+0?>, <?php print $dia2v[0]-$dia2vs[0]+0?>, <?php print $dia3v[0]-$dia3vs[0]+0?>, <?php print $dia4v[0]-$dia4vs[0]+0?>, <?php print $dia5v[0]-$dia5vs[0]+0?>, <?php print $dia6v[0]-$dia6vs[0]+0?>, <?php print $dia7v[0]-$dia7vs[0]+0?>],
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
          return '$' + number_format(value);
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
          backgroundColor: "rgb(255,255,255)",
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
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
          }
          }
          }
          }
          });


</script>
 
<!-- Content Row -->
            <!-- Pie Chart -->
            <div class="col-xl-3 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Estado das Mensalidades</h6>
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
                      <i class="fas fa-circle text-success"></i> Alunos com esse mês pago ______
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-gray"></i> Alunos com esse mês em atraso ____
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i>Alunos Com vários meses em atraso 
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
    labels: ["Com vários meses em atraso ", "com esse mês em atraso", "com esse mês pago"],
    datasets: [{
      data: [<?php print $matriculaseconfirmacoesquenaopagarammespassado?>, <?php print $matriculaseconfirmacoesquepagaramespassado?>, <?php print $matriculaseconfirmacoesquejapagaram?>],
      backgroundColor: ['red', 'gray', 'green'],
      hoverBackgroundColor: ['red', 'gray', 'green'],
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
      <!-- End of Main Content -->
      </div>
      <!-- End of Main Content -->
            </div>
      <!-- End of Main Content -->
<?php include("rodape.php");


ini_set('display_errors',0); ini_set('display_startup_erros',0); error_reporting(E_ALL);//force php to show any error message
    
backup_tables($hostname,$user,$password,$database);
  
 

function backup_tables($hostname,$user,$password,$database)
{
    $link = mysqli_connect($hostname,$user,$password);
    mysqli_select_db($link, $database);
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        $i=0;
        while($row = mysqli_fetch_row($result))
        {
            $tables[$i] = $row[0];
            $i++;
        }
    $return = "";
    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $return .= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysqli_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j < $num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j < ($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
    //save file
    $handle = fopen('db_bkp/db-'.$database.'-'.date('Y-m-d').'.sql','w+');//Don' forget to create a folder to be saved, "db_bkp" in this case
    fwrite($handle, $return);
    fclose($handle); 
}?>



 


