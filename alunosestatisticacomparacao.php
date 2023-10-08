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
 
$idanolectivo1=isset($_GET['idanolectivo1'])?$_GET['idanolectivo1']:"";
$idanolectivo1=mysqli_escape_string($conexao, $idanolectivo1);

 
$idanolectivo2=isset($_GET['idanolectivo2'])?$_GET['idanolectivo2']:"";
$idanolectivo2=mysqli_escape_string($conexao, $idanolectivo2);

     
         
  
         
        $dadosdoanolectivo1 = mysqli_fetch_array(mysqli_query($conexao,"SELECT  anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo1'"));

       $anolectivo_escolhido1=$dadosdoanolectivo1["titulo"];


$totaldematriculaseconfirmacoes1 = mysqli_num_rows(mysqli_query($conexao,"SELECT  idanolectivo from matriculaseconfirmacoes where  idanolectivo='$idanolectivo1'"));


 $dadosdoanolectivo2 = mysqli_fetch_array(mysqli_query($conexao,"SELECT  anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo2'"));

       $anolectivo_escolhido2=$dadosdoanolectivo2["titulo"];


$totaldematriculaseconfirmacoes2 = mysqli_num_rows(mysqli_query($conexao,"SELECT  idanolectivo from matriculaseconfirmacoes where  idanolectivo='$idanolectivo2'"));


   include("cabecalho.php"); ?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Comparação de Aquisição de alunos <?php if(isset($_GET['idanolectivo1'])){ echo "( <a href='anolectivo.php?idanolectivo=$idanolectivo1'> $anolectivo_escolhido1 </a> | <a href='anolectivo.php?idanolectivo=$idanolectivo2'> $anolectivo_escolhido2 </a> )"; }?>  </h1>
          <h1 style="font-size: 70px; text-align: center">Total de alunos: (<?php echo $totaldematriculaseconfirmacoes1; ?> | <?php echo $totaldematriculaseconfirmacoes2; ?>)</h1>
           

   
        


<?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Ano Lectivo</button>
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Comparar Anos Lectivos</button> 
 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="alunosestatistica.php" method=""><br>
         
                      
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

  
  

  $anolectivo_n_1=mysqli_num_rows(mysqli_query($conexao, "select idmatriculaeconfirmacao FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo1'")); 

  $anolectivo_n_2=mysqli_num_rows(mysqli_query($conexao, "select idmatriculaeconfirmacao FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo2'")); 
 

 
  
      for ($i=1; $i <=12 ; $i++) { 

         $mesesdoanolectivo1[$i]=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where idanolectivo='$idanolectivo1' and  MONTH(data)='$i' "));

         $mesesdoanolectivo2[$i]=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where idanolectivo='$idanolectivo2' and  MONTH(data)='$i' "));
    }
       
         


 
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
               <script>
    var barChartData = {
      labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho' , 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      datasets: [{
        label: '<?php echo $anolectivo_escolhido1; ?>',
        backgroundColor: window.chartColors.red, 
        data:[
          <?php print $mesesdoanolectivo1[1]?>,
          <?php print $mesesdoanolectivo1[2]?>,
          <?php print $mesesdoanolectivo1[3]?>,
          <?php print $mesesdoanolectivo1[4]?>,
          <?php print $mesesdoanolectivo1[5]?>,
          <?php print $mesesdoanolectivo1[6]?>,
          <?php print $mesesdoanolectivo1[7]?>,
          <?php print $mesesdoanolectivo1[8]?>,
          <?php print $mesesdoanolectivo1[9]?>,
          <?php print $mesesdoanolectivo1[10]?>,
          <?php print $mesesdoanolectivo1[11]?>,
          <?php print $mesesdoanolectivo1[12]?>  
        ]
      }, {
        label: '<?php echo $anolectivo_escolhido2; ?>',
        backgroundColor: window.chartColors.grey, 
        data:[
          <?php print $mesesdoanolectivo2[1]?>,
          <?php print $mesesdoanolectivo2[2]?>,
          <?php print $mesesdoanolectivo2[3]?>,
          <?php print $mesesdoanolectivo2[4]?>,
          <?php print $mesesdoanolectivo2[5]?>,
          <?php print $mesesdoanolectivo2[6]?>,
          <?php print $mesesdoanolectivo2[7]?>,
          <?php print $mesesdoanolectivo2[8]?>,
          <?php print $mesesdoanolectivo2[9]?>,
          <?php print $mesesdoanolectivo2[10]?>,
          <?php print $mesesdoanolectivo2[11]?>,
          <?php print $mesesdoanolectivo2[12]?>  
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
            text: 'Comparando o fluxo de aquisição entre <?php echo $anolectivo_escolhido1; ?> e <?php echo $anolectivo_escolhido2; ?>'
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
                      <i class="fas fa-circle text-success"></i> alunos Adquiridos <?php echo $anolectivo_escolhido1; ?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-gray"></i> alunos Adquiridos <?php echo $anolectivo_escolhido2; ?>
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
    labels: ["", ""],
    datasets: [{
      data: [<?php print $anolectivo_n_2?>, <?php print $anolectivo_n_1?>],
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
              <h6 class="m-0 font-weight-bold text-primary">Estatísticas Por Classes</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                    
        
                <br>
                <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Ciclo</th>
                      <th>Classe</th>
                      <th><?php echo $anolectivo_escolhido1; ?></th>   
                      <th><?php echo $anolectivo_escolhido2; ?></th> 
                      <th>Resultado</th>      
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

                     
                     $total_alunos_por_ciclo1=0;
                     $total_alunos_por_ciclo2=0;

                   

                        $alunoscadastrados_nas_turmas=mysqli_query($conexao,"SELECT * from classes where idciclo='$idciclo'");
                        

                           
  
                           while($exibir = $alunoscadastrados_nas_turmas->fetch_array()){

                                $idclasse=$exibir["idclasse"];

                                $total=0;

                               
                            ?>

                            <tr>
                              <td><a href="ciclo.php?idciclo=<?php echo $exibir_ciclo['idciclo']; ?>"><?php echo $exibir_ciclo['titulo']; ?></a></td> 
                              <td><a href="classe.php?idclasse=<?php echo $exibir['idclasse']; ?>"><?php echo $exibir['titulo']; ?></a></td>  
                                <?php 

                                     

                                            $alunos_anolectivo_1 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and  turmas.idclasse='$idclasse' and matriculaseconfirmacoes.idanolectivo='$idanolectivo1' "));

                                            $alunos_anolectivo_2 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and  turmas.idclasse='$idclasse' and matriculaseconfirmacoes.idanolectivo='$idanolectivo2' "));
          
          
                                           

                                            $total_alunos_por_ciclo1+=$alunos_anolectivo_1;
                                            $total_alunos_por_ciclo2+=$alunos_anolectivo_2;

                                            

                                            if($alunos_anolectivo_1>$alunos_anolectivo_2){

                                               $R=$alunos_anolectivo_1-$alunos_anolectivo_2;
                                              $resultado="Diminuiu $R";
                                            }else if($alunos_anolectivo_1<$alunos_anolectivo_2) {

                                               $R=$alunos_anolectivo_2-$alunos_anolectivo_1;

                                              $resultado="Aumentou $R";
                                            }else if($alunos_anolectivo_1==$alunos_anolectivo_2) {
 
                                              $resultado="Manteve-se";
                                            }

                                           
                                       echo "<td>  $alunos_anolectivo_1</td>"; 
                                       echo "<td>$alunos_anolectivo_2</td>"; 
                                       echo "<td>$resultado</td>"; 


                                     

                                   
                             ?>    
                       
                    </tr> 
                   <?php } ?>


                          <tr>
                      <th><?php echo "$exibir_ciclo[titulo]"; ?> - Total </th>
                      <th></th>   
                         <?php
 

                             

                                            $alunos_anolectivo_1 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo1'  and turmas.idciclo='$idciclo'"));

                                              $alunos_anolectivo_2 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo2'  and turmas.idciclo='$idciclo'"));
          
           
                                             
                                          
                                            if($alunos_anolectivo_1>$alunos_anolectivo_2){

                                               $R=$alunos_anolectivo_1-$alunos_anolectivo_2;
                                              $resultado="Diminuiu $R";
                                            }else if($alunos_anolectivo_1<$alunos_anolectivo_2) {

                                               $R=$alunos_anolectivo_2-$alunos_anolectivo_1;

                                              $resultado="Aumentou $R";
                                            }else if($alunos_anolectivo_1==$alunos_anolectivo_2) {
 
                                              $resultado="Manteve-se";
                                            }

           
                                          
                                        echo "<td>  $alunos_anolectivo_1</td>"; 
                                       echo "<td>$alunos_anolectivo_2</td>"; 
                                       echo "<td>$resultado</td>"; 



 

                     ?>   
                    </tr>




                  <?php  }  ?>
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th>Total todos Cíclos</th>
                              <th></th>   
                               <?php
 

                             

                                            $alunos_anolectivo_1 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where   matriculaseconfirmacoes.idanolectivo='$idanolectivo1'"));

                                              $alunos_anolectivo_2 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where   matriculaseconfirmacoes.idanolectivo='$idanolectivo2'"));
          
           
                                             
                                          
                                            if($alunos_anolectivo_1>$alunos_anolectivo_2){

                                               $R=$alunos_anolectivo_1-$alunos_anolectivo_2;
                                              $resultado="Diminuiu $R";
                                            }else if($alunos_anolectivo_1<$alunos_anolectivo_2) {

                                               $R=$alunos_anolectivo_2-$alunos_anolectivo_1;

                                              $resultado="Aumentou $R";
                                            }else if($alunos_anolectivo_1==$alunos_anolectivo_2) {
 
                                              $resultado="Manteve-se";
                                            }

           
                                          
                                        echo "<td>  $alunos_anolectivo_1</td>"; 
                                       echo "<td>$alunos_anolectivo_2</td>"; 
                                       echo "<td>$resultado</td>"; 



 

                     ?>       
                            </tr>
                   </tfoot>
                </table>
              </div>
            </div>
          </div>



    <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Estatísticas Por estatus</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                    
        
                <br>
                <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Descrição</th>    
                      <th><?php echo $anolectivo_escolhido1; ?></th>   
                      <th><?php echo $anolectivo_escolhido2; ?></th>  
                    </tr>
                  </thead> 
                  <tbody>
                  <?php 

                  $litade_estatus=mysqli_query($conexao,"SELECT DISTINCT(estatus) as estatus from matriculaseconfirmacoes order by estatus asc");
                      
 
                   while($exibir_estatus = $litade_estatus->fetch_array()){
 
                    $titulo_do_estatus=$exibir_estatus["estatus"];

                     
                     
                    
                      
                               
                            ?>

                            <tr>

                                <td> <?php echo $exibir_estatus['estatus']; ?></td>  

                        <?php

                           
                                

                                    

                                    $alunos_anolectivo_1 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where idanolectivo='$idanolectivo1' and estatus='$titulo_do_estatus'"));

                                     $alunos_anolectivo_2 = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where idanolectivo='$idanolectivo2' and estatus='$titulo_do_estatus'"));
          

 
                              ?>

                                   <td> <?php echo $alunos_anolectivo_1; ?></td>  
                                   <td> <?php echo $alunos_anolectivo_2; ?></td>  


                         
  
                       
                    </tr>
                    <?php } ?> 
                  </tbody> 
                  

                    
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
            <span>Copyright &copy; CalungaSOFT 2022</span>
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
