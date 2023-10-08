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
 

         
if(!isset($_GET['anodevenda'])){  
   
    for ($i=1; $i <=12 ; $i++) { 
        $dia[$i]=mysqli_num_rows( mysqli_query($conexao,"SELECT idaluno from alunos where MONTH(datadecadastro)='$i'"));
      } 
          $totaldealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idaluno from alunos"));
  
   
  }else if(isset($_GET['anodevenda'])){ 
  
      for ($i=1; $i <=12 ; $i++) { 
      $dia[$i]=mysqli_num_rows( mysqli_query($conexao,"SELECT idaluno from alunos where '$anodevenda'=YEAR(datadecadastro)  and  MONTH(datadecadastro)='$i' "));
    }
      $totaldealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idaluno from alunos where  '$anodevenda'=YEAR(datadecadastro)"));
  
  } 
         
       
   include("cabecalho.php")?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Alunos na Instituição<?php if(isset($_GET['anodevenda'])){ echo "| $anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center">Total de alunos: <?php echo $totaldealunos; ?></h1>
           

   
        


<?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Ano</button> 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method=""><br>
         
                    <div class="form-group"> 
                    <?php $ano=date("Y"); ?>

                    <input type="number" autocomplete="" name="anodevenda" class="form-control " title="Digite o Ano que desejas" placeholder="Ano" required="" value="<?php echo "$ano"; ?>">
                    </div>
                    
                    <br>
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                   
                   

          </form>
        </div>
    </div>
 
 
                 
    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="mesesaquisicao.php" method="get"> <br>
          Comparando Aquisição de aluno nos anos:  <br>
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

  
if(!isset($_GET['anodevenda'])){  
 
  $homens=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where sexo='Masculino'")); 
  $mulheres=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where sexo='Femenino'")); 
}else{

  $homens=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where sexo='Masculino' and YEAR(datadecadastro)='$anodevenda'")); 
  $mulheres=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where sexo='Femenino' and YEAR(datadecadastro)='$anodevenda'")); 
}

 
 
?>
           
 


           

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fluxo de Entradas de alunos</h6>
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
            text: 'Gráficos Mostrando o Fluxo de Entrada de aluno'
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
                  <h6 class="m-0 font-weight-bold text-primary">Representação dos alunos </h6>
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
                      <i class="fas fa-circle text-success"></i>Número de alunos Sexo Masculino
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-red"></i>Número de alunos Sexo Femenino
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
    labels: ["Mulheres", "Homens"],
    datasets: [{
      data: [<?php print $mulheres?>, <?php print $homens?>],
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
        

      </div>
      <!-- End of Main Content -->

        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de alunos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Nome Completo</th>
                      <th title="Número de processo">Nº Proc.</th>
                      <th>Nome do Pai</th>
                      <th>Nome da Mãe</th>
                      <th>Sexo</th>
                      <th>Entrada</th> 
                      <th>Telefone</th> 
                      <th>Idade</th>
                      <th>Morada</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                         
                        if(!isset($_GET['anodevenda'])){ 

                          $lista=mysqli_query($conexao, "select TIMESTAMPDIFF(YEAR,datadenascimento,CURDATE()) as idade, alunos.* from alunos");
                        
                         
                        }else{

                          $lista=mysqli_query($conexao, "select TIMESTAMPDIFF(YEAR,datadenascimento,CURDATE()) as idade, alunos.* from alunos where anodeentrada='$anodevenda'");


                        }


                         while($exibir = $lista->fetch_array()){
     

                  ?>
                    <tr >  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 

                      <td><?php echo $exibir['numerodeprocesso']; ?></td>
                      <td><?php echo $exibir['nomedopai']; ?></td>
                      <td><?php echo $exibir['nomedamae']; ?></td>
                      <td><?php echo $exibir['sexo']; ?></td>
                      <td><?php echo $exibir['anodeentrada']; ?></td> 
                      <td><?php echo $exibir['telefone']; ?></td>
                      <td title="<?php echo $exibir['datadenascimento']; ?>"><?php echo $exibir['idade']; ?></td> 
                      <td><?php echo $exibir['morada']; ?></td> 
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
