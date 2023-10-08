<?php   include("conexao.php"); 
 $hojemes=date('m');
 $hojeano=date('Y');
$mes=isset($_GET['mes'])?$_GET['mes']:"$hojemes";
$ano=isset($_GET['ano'])?$_GET['ano']:"$hojeano";

$mes_escolhido=mysqli_escape_string($conexao, $mes);
$ano=mysqli_escape_string($conexao, $ano);

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

  
if(isset($_GET['del'])){ 
  $idfalta=mysqli_escape_string($conexao, $_GET['id']); 
   $editando=mysqli_query($conexao, "DELETE FROM `presenca` WHERE `presenca`.`idfalta` = '$idfalta'"); 
   if($editando){
    $acertos[]="O registo de controlo de presença foi eliminado com sucesso!";
  }else{
    $erros[]="ocorreu algum erro, tente novamente!";
  } 
}

 
    

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Presença Mensal | <?php  echo "$mes_escolhido";  ?>/<?php echo "$ano";  ?></h1>
          <p class="mb-4">Abaixo vai a tabela de presenças e faltas ao longo do mês</p>

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

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="get">
                   
                    <div class="form-group">
                      <?php $ano=date("Y"); ?>
                      <span>Ano </span>
                      <input type="number" name="ano" min="2010" max="2200" class="form-control"  value="<?php echo "$ano"; ?>">
                    </div>   
                    
                     
                    <div class="form-group">
                          <select name="mes"  class="form-control">
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
 
 <br> <br>
    <span id="mensagemdealerta"></span>
                  <script>
                    var btn=document.getElementById("myBtn");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                  
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

                  </script>

                  <br><br>
  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Presença</h6>
            </div>
           
            <div class="card-body">
           
              <div class="table-responsive">
              
                  <a href="pdf/pdflistadepresenca.php?mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>" class="d-sm-inline-block btn btn-sm btn-primary" title="Imprimir lista de presença mensal"><i class="fas fa-fw fa-download"></i>Imprimir lista de Presença</a>
                  <a href="horasextras.php?mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>" class="d-sm-inline-block btn btn-sm btn-primary" title="Preenchas as horas extras de cada funcionário"><i class="fas fa-fw fa-clock"></i>Tabela de Horas Extras</a> <br><br>
                   <br><br>

                   <span id="mensagemdealerta2"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr> 
                      <th>Funcionário</th> 
                      <th>Cargo</th> 
                      <?php 
                      $totaldedias=cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                        for ($i=1; $i <=$totaldedias; $i++) {  ?>
                            <th><?php echo  $i; ?></th>
                       <?php } ?>
                      <th>Total(Horas)</th>
                      <th>Total(salário)</th>
                    </tr> 
                  </thead> 
                  <tbody>
                  <?php

                  $listadefuncionários=mysqli_query($conexao,"SELECT * FROM funcionarios");
                  $salariodetodos=0; 
                   while($exibir = $listadefuncionários->fetch_array()){ 
                     $idfuncionario=$exibir['idfuncionario'];
                     $totaldehoras=0;
                     $salariototal=0;
                     $totaldehorassemextra=0;
                     $totaldehorasextras=0;

                     $totaldevalorsemextra=0;
                     $totaldevalorextras=0;

                     $salariopordia=$exibir['salarioporhora']*$exibir['numerodehoras'];

                    ?>
                    <tr>
                      <td title="Salário por dia: <?php echo $salariopordia; ?>"><a href="funcionario.php?idfuncionario=<?php echo $idfuncionario; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
 
                      <td title="Salário por dia: <?php echo $salariopordia; ?>"><?php echo $exibir['categoria']; ?></td>
                      <?php for ($i=1; $i <=$totaldedias; $i++) { 

                      $data="$i-$mes-$ano";
                     
                        $cor="red";
                        $imprimir="";
                        $falta=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$i' and mes='$mes' limit 1")); 
                          $totaldehorassemextra=$totaldehorassemextra+mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(horastrabalhadas) FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$i' and mes='$mes' limit 1"))[0];
                          $totaldehorasextras=$totaldehorasextras+mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(horasextras) FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$i' and mes='$mes' limit 1"))[0];

                          $totaldehoras=$totaldehorassemextra+$totaldehorasextras;


                          $totaldevalorsemextra=$totaldevalorsemextra+mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(salariopordia) FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$i' and mes='$mes' limit 1"))[0];
                          $totaldevalorextras=$totaldevalorextras+mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(salariopelahorasextras) FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$i' and mes='$mes' limit 1"))[0];
 

                          $salariototal=$salariototal+$falta["salariopordia"]+$falta["salariopelahorasextras"];
                          $imprimir="$falta[falta]";
                         if(date('N', strtotime($data))==6){$cor="yellow";}else if(date('N', strtotime($data))==7){$cor='rgb(255,135,135)';}else{$cor='';}
                       
                         
                        
                        ?>
                          <td <?php if($falta["horasextras"]!=0){?> title="+<?php echo $falta["horasextras"]; ?> Horas extras | funcionário: <?php echo $exibir['nomedofuncionario']; ?>" <?php }else { ?> title="<?php echo $exibir['nomedofuncionario']; ?>" <?php } ?> class="update" data-id="<?php echo $idfuncionario; ?>" data-column="<?php echo $i; ?>"  style="background-color: <?php echo $cor; ?>;" contenteditable><strong><?php    echo $imprimir; ?></strong></td>
                      <?php } ?>
                      <td title="Horas Normais de trabalho: <?php echo $totaldehorassemextra; ?>H | Horas Extras: <?php echo $totaldehorasextras; ?>H"><?php echo $totaldehoras; ?></td> 
                      <td title="Salário Normal de trabalho: <?php echo $totaldevalorsemextra; ?>KZ | Salário horas Extras: <?php echo $totaldevalorextras; ?>KZ"><?php $salariodetodos=$salariodetodos+$salariototal; $n=number_format($salariototal,2,",", "."); echo $n; ?> Kz</td>
                    </tr>
                      <?php } ?>
                      
                  </tbody>
                      <tfoot>
                      <tr>
                      <td><strong>Total</strong></td>
                      <td></td> 
                      <?php for ($i=1; $i <=$totaldedias; $i++) { ?>
                         <td></td>
                      <?php } ?>
                      <td></td>
                      <td><strong><?php $n=number_format($salariodetodos,2,",", "."); echo $n; ?> Kz</strong></td>
                    </tr>
                      </tfoot>
                  </table>
              </div>
            </div>
          </div>



             <!-- Earnings (Monthly) Card Example -->
             <div class="row">

                            

                                            
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Algumas Informações</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Referente as Faltas Sem Remuneração</div>
                                    <p id="mostra">  
                                    12| Licença<br>  
                                    67| Falta Justificada <br>
                                    68| Falta injustificada <br>
                                    69| Falta por Doença <br> 
                                    72| Meia falta justificada <br>
                                    73| Meia Falta injustificada <br> </div>


                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300" id="botao"></i> 
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                                        
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outras Informações</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Referente Faltas com Remuneração</div>
                                    <p id="mostra"> 
                                    02| Doença Especial <br> 
                                    13| Falta por doença <br>
                                    21| Falta justificada <br>
                                    22| Licença de Materninadade<br> 
                                    70| Dias de férias <br> 
                                    79| Dia de interrupção de serviço<br></div>
                            </div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300" ></i> 
                            </div>
                    </div>
                    </div>
                </div>
                </div>
                </div> 
                OBS: O salário mensal dos funcionários é calculado com base ao salário/dia multiplicado com Número de dias de cada mês <br> NOTA: se o salário do funcionário for alterado isso não afectara no salário dos dias em que foram marcados com o salário antigo. 
                </div> 
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
      <script>
      
      
      
                                   $(document).on("blur", ".update", function(){
                                        var idfuncionario=$(this).data("id");
                                        var dia=$(this).data("column");
                                        var falta=$(this).text();

                                        var ano=<?php echo $ano; ?>; 
                                        var mes=<?php echo $mes; ?>;  
                                        
                                        $.ajax({
                                              url:'cadastro/preencherfalta.php',
                                              method:'POST',

                                              data:{idfuncionario, dia, falta, ano, mes },

                                              success: function(data){
                                                  $("#mensagemdealerta").html(data);
                                                  $("#mensagemdealerta2").html(data);
                                              }

                                          })

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
