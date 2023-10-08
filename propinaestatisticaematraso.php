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

$hoje=date('d');
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
 
$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo);

         
if(!isset($_GET['anodevenda'])){  
   
     
          $totaldematriculaseconfirmacoes = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where idanolectivo='$idanolectivo'"));
  
   
  }else if(isset($_GET['anodevenda'])){ 
  
      
      $totaldematriculaseconfirmacoes = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  '$anodevenda'=YEAR(data) and idanolectivo='$idanolectivo'"));
  
  } 
         
     $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo'"));


       $anolectivo_escolhido=$dadosdoanolectivo["titulo"];


   include("cabecalho.php"); ?>
 
          <!-- Page Heading -->
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

 
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Estatísticas de Propinas<?php if(isset($_GET['idanolectivo'])){ echo "| <a href='anolectivo.php?idanolectivo=$idanolectivo'> $anolectivo_escolhido </a>"; }?>  </h1>
          <h1 style="font-size: 70px; text-align: center">Total de alunos: <?php echo $totaldematriculaseconfirmacoes; ?></h1>
           

   
        


<?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Escolher o Ano Lectivo</button>
 
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
          <form action="mesesaquisicao.php" method="get"> <br>
          Comparando Aquisição de aluno nos anos:  <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            
                             
                             <span> Ano Lectivo 1</span>
                            <select name="idanolectivo2" required  class="form-control"> 
                              <?php
                                   $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                                  while($exibir = $lista->fetch_array()){ ?>
                                  <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                <?php } ?> 
                            </select> 
                           


                        </div>
                        <div class="col-sm-6">
                             <span> Ano Lectivo 2</span>
                            <select name="idanolectivo1" required  class="form-control"> 
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
            <div class="col-xl-12 col-lg-2">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fluxo de Aquisição /Alunos inactivos / Alunos com propinas em atraso / Alunos com Pagamentos regulares</h6>
                  <div class="dropdown no-arrow">
                    
                   
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body"> 
                 

                <form autocomplete="on">
                    <div class="row">
                    <div style="width: 95%; height: 20%">
                <canvas id="canvas"></canvas>
               <?php

                $meses=[];
                $valormes=[];

                 $alunos_com_propinas_ematraso=[];
                 $alunos_com_propinas_pagas=[];
                 $alunos_inactivos=[];

                $listadeanos=[];

                   $anoactual=date('Y');
                   $mesactual=date('m');


                $mesinicio_anolectivo=$dadosdoanolectivo["mesinicio"];
                $mesfim_anolectivo=$dadosdoanolectivo["mesfim"];

                $anoinicio_anolectivo=$dadosdoanolectivo["anoinicio"];
                $anofim_anolectivo=$dadosdoanolectivo["anofim"];


                 $numero_de_meses_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafim) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                 $numero_de_meses_exame=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafimexame) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

               
                 $contador_normal=0;
                   $contador_exame=0;

                  for ($i=$mesinicio_anolectivo; $i <=12 ; $i++) { 
                        
                                    

                                   
                                    $mes=$i;
                                    $ano=$anoinicio_anolectivo;

  
                                   
 
                                 
                                    $data_de_cadastro_formada="$ano-$i-31"; //2021-08-31
                                    $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                              

                                    $previsao_normal=0; $previsao_exame=0;
                                    $previsao_normal_inactivo=0; $previsao_exame_inactivo=0;


                                    if($contador_normal<=$numero_de_meses_normal){

                                       $previsao_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo'   and turmas.eclassedeexame='Não'"));

                                        $previsao_normal_inactivo=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus!='activo'  and turmas.eclassedeexame='Não'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and turmas.eclassedeexame='Sim'"));

                                        $previsao_exame_inactivo=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus!='activo' and turmas.eclassedeexame='Sim'"));


                                    }


                                     

                                    $valormes[]=$previsao_normal+$previsao_exame;
                                    $alunos_inactivos[]=$previsao_normal_inactivo+$previsao_exame_inactivo;

 

                                  

                                       $alunos_com_propinas_pagas[]=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes where   idanolectivo='$idanolectivo' and   data<='$data_de_cadastro_formada' and estatus='activo' and (ultimomespago>='$data_de_propina_formada' or tipodealuno='Bolseiro')"));

                                     

                                   

                                      


                                     
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"));

                                    }


                                    $alunos_com_propinas_ematraso[]=$emfalta_normal+$emfalta_exame;


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
                                    $previsao_normal_inactivo=0; $previsao_exame_inactivo=0;


                                    if($contador_normal<=$numero_de_meses_normal){

                                       $previsao_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo'   and turmas.eclassedeexame='Não'"));

                                        $previsao_normal_inactivo=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus!='activo'  and turmas.eclassedeexame='Não'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and turmas.eclassedeexame='Sim'"));

                                        $previsao_exame_inactivo=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus!='activo' and turmas.eclassedeexame='Sim'"));


                                    }


                                     

                                    $valormes[]=$previsao_normal+$previsao_exame;
                                    $alunos_inactivos[]=$previsao_normal_inactivo+$previsao_exame_inactivo;

 

                                  

                                       $alunos_com_propinas_pagas[]=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao  from matriculaseconfirmacoes where   idanolectivo='$idanolectivo' and   data<='$data_de_cadastro_formada' and estatus='activo' and (ultimomespago>='$data_de_propina_formada' or tipodealuno='Bolseiro')"));

                                     

                                   

                                      


                                     
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"));

                                    }


                                    $alunos_com_propinas_ematraso[]=$emfalta_normal+$emfalta_exame;




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
        label: 'Número de alunos Activos',
        backgroundColor: window.chartColors.blue, 
        data:[
           <?php 

          foreach ($valormes as $key => $value) {
                 echo "'$value' ,";  
              } 


       ?> 
        ]
      }, {
        label: 'Alunos Inactivos',
        backgroundColor: window.chartColors.grey, 
         data:[
           <?php 

          foreach ($alunos_inactivos as $key => $value) {
                 echo "'$value' ,";  
              } 

       ?> 
        ]
      },{
        label: 'Alunos Com Propinas em atraso',
        backgroundColor: window.chartColors.red, 
         data:[
           <?php 

          foreach ($alunos_com_propinas_ematraso as $key => $value) {
                 echo "'$value' ,";  
              } 

       ?> 
        ]
      }, 
      {
        label: 'Alunos Com Propinas Pagas',
        backgroundColor: window.chartColors.green, 
         data:[
           <?php 

          foreach ($alunos_com_propinas_pagas as $key => $value) {
                 echo "'$value' ,";  
              } 

       ?> 
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
 <?php 
$anoctual=date('Y');
$mesactual=date('m');

 
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
<!-- Content Row -->
            <!-- Pie Chart -->
         
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tabela</h6>
                  <div class="dropdown no-arrow">
                    
                  </div>
                </div>
                
              </div>
            </div>
          </div>
 


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Estatísticas Por Turmas</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                     <a href="" id="alunosactivos" class="d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-fw fa-print"></i> Alunos Activo</a>   
                  
                    <a href=""  id="alunosinactivos" class="d-sm-inline-block btn btn-sm btn-secondary" ><i class="fas fa-fw fa-book"></i> Alunos Inactivos</a> 
 
                   
 

                  <a href="" id="alunoscompropinasematraso" class="d-sm-inline-block btn btn-sm btn-danger" ><i class="fas fa-fw fa-calendar"></i> Propinas em Atraso </a> 

                  <a href="" id="alunoscompropinaspagas" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-money"></i> Propinas Regular </a>  <br><br>

        
                <br>
                <span id="mensagemdealerta"> 


                <?php 

                $htm='

                <h2>Alunos Activos   <a href="pdf/pdfalunosactivos.php?idanolectivo='.$idanolectivo.'" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir </a>  </h2> 

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Ciclo</th>
                      <th>Turma</th>';

                      $listadeanos=[];
                      $meses=[];
                      $valormes_total=[];

                      $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(data)), YEAR(data) as ano from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and estatus='activo' order by data asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];

                                  $listadeanos[]=$ano;

                                  $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano'and estatus='activo'  order by data asc ");
                            
                                        while($exibir = $lista->fetch_array()){ 
                                    

                                                          $mes=$exibir["mes"];

                                    $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 


                                      $valormes_total[] = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and matriculaseconfirmacoes.data<='$data_de_cadastro_formada'  and estatus='activo'"));

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

                       

                        foreach ($meses as $key => $value) {
                               $htm.='<th>'.$value.'</th>';  
                            } 

                     $htm.='    
                    </tr>
                  </thead> 
                  <tbody>';


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
 
                               
                             $htm.='

                            <tr>
                              <td><a href="ciclo.php?idciclo='.$exibir_ciclo["idciclo"].'">'.$exibir_ciclo["titulo"].'</a></td> 
                              <td><a href="turma.php?idturma='.$idturma.'">'.$exibir["titulo"].'</a></td> '; 
                                 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and estatus='activo' order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                             $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 



                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and  matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and idturma='$idturma' and estatus='activo'"));
 
          
          
                                            $total+=$numerodealunos;

                                            $total_alunos_por_ciclo+=$numerodealunos;

                                        

                                           
                                       $htm.='<td  >'.$numerodealunos.'</td>'; 


                                    } 

                                          

                                       
                                  }

                                   
                            $htm.='
                            
                       
                    </tr> 
                    ';

                  }  

                  $htm.='

                          <tr>
                            <th>'.$exibir_ciclo["titulo"].' - Total </th>
                            <th></th>   
                         ';
 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and estatus='activo'  order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                                $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 




                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo' and matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and turmas.idciclo='$idciclo' and estatus='activo'"));

                                          
           
                                         
                                          
                                       $htm.='<td  >'.$numerodealunos.'</td>'; 


                                    } 

                                          

                                       
                                  }
 

                     $htm.='
                      
                    </tr> ';

                    }  

                    $htm.='
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th>Total todos Cíclos</th>
                              <th></th>   
                               ';


                                foreach ($valormes_total as $key => $value) {
                                       $htm.='<th>'.$value.'</th>';  
                                    } 

                             $htm.='
                                       
                            </tr>
                   </tfoot>
                </table>';

                echo "$htm";

                ?>

                 </span> 
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

          <script type="text/javascript">
            
                               $(document).on("click", "#alunosactivos", function(event){
                                      event.preventDefault(); 
                                     
                                      var idanolectivo=<?php echo $idanolectivo; ?>; 
                                      
                                          
                                          $.ajax({
                                          url:'cadastro/alunosactivos.php',
                                          method:'POST',
                                          data:{
                                              idanolectivo
                                          },
                                          success: function(data){
                                              $("#mensagemdealerta").html(data);
                                
                                          }

                                      })
                                     
                                     
                                  })


                               $(document).on("click", "#alunosinactivos", function(event){
                                      event.preventDefault(); 
                                     
                                      var idanolectivo=<?php echo $idanolectivo; ?>; 
                                      
                                          
                                          $.ajax({
                                          url:'cadastro/alunosinactivos.php',
                                          method:'POST',
                                          data:{
                                              idanolectivo
                                          },
                                          success: function(data){
                                              $("#mensagemdealerta").html(data);
                                
                                          }

                                      })
                                     
                                     
                                  })


                               $(document).on("click", "#alunoscompropinasematraso", function(event){
                                      event.preventDefault(); 
                                     
                                      var idanolectivo=<?php echo $idanolectivo; ?>; 
                                      
                                          
                                          $.ajax({
                                          url:'cadastro/alunoscompropinasematraso.php',
                                          method:'POST',
                                          data:{
                                              idanolectivo
                                          },
                                          success: function(data){
                                              $("#mensagemdealerta").html(data);
                                
                                          }

                                      })
                                     
                                     
                                  })

                                   $(document).on("click", "#alunoscompropinaspagas", function(event){
                                      event.preventDefault(); 
                                     
                                      var idanolectivo=<?php echo $idanolectivo; ?>;

                                      
                                          
                                          $.ajax({
                                          url:'cadastro/alunoscompropinaspagas.php',
                                          method:'POST',
                                          data:{
                                              idanolectivo
                                          },
                                          success: function(data){
                                              $("#mensagemdealerta").html(data);
                                
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
