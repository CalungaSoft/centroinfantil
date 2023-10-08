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
$acertos=[];

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}


$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";
$nomedotipo=isset($_GET['nomedotipo'])?$_GET['nomedotipo']:"todos";

    $hoje=date('d');
    $mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
    
    $filtro = isset($_GET['filtro'])?$_GET['filtro']:"$hoje";
    $idfuncionario =$idlogado;

    $dia=date('d');
    $diadevenda=isset($_GET['diadevenda'])?$_GET['diadevenda']:"$dia";
    $diadevenda=mysqli_escape_string($conexao, $diadevenda);
        

  

 
 
if(!isset($_GET['mesdevenda'])){  
    
        $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas"))[0];
  	    
	  

 
}else if(isset($_GET['mesdevenda'])){ 

     
      $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
      

		  
} 
include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php
      $valornocaixa=number_format($totaldeentrada,2,",", ".");
      $entrada=number_format($totaldeentrada,2,",", ".");
      
		?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Entradas Financeira na Escola <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($nomedotipo)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"><?php echo $valornocaixa; ?>KZ</h1>
           

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
  

    <?php echo "<a title='Imprimir relatório Mensal' class='btn btn-success'  href='pdf/pdfrelatoriodeentradamensal.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda'> <i class='fas fa-fw fa-print'></i> Imprimir Relatório Mensal</a>"; ?>
        
                           
  

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">

                                  <span>Ano Lectivo</span>
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
                              <option <?php if($mesactual==3) { ?> selected="" <?php }?> value="03">Marco</option>
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
          <h3>Cadastrando Novo tipo de Forma de Pagamento</h3>
                      <br>
                      <div class="form-group">

                             <span>Forma de Pagamento</span>
                                 <input type="text" name="formadepagamento" class="form-control" placeholder="Forma de Pagamento">
                              </div>  
                       <input type="submit" value="Cadastrar Novo tipo de Imposto" name="cadastrarformadepagamento" class="btn btn-success" style="float: rigth;">
            

          </form>
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

                          $diferentesformasdeentrada=mysqli_query($conexao,"SELECT * from formasdepagamento");

                          while($exibir = $diferentesformasdeentrada->fetch_array()){


                                $idtipo=$exibir["idformadepagamento"];
                                $tipo=$exibir["formadepagamento"];
                                 
                                $totaldeentrada_geral=$totaldeentrada;
if(!isset($_GET['mesdevenda'])){   
    
    $totaldeentrada_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where formadepagamento='$tipo'"))[0];
      
  


}else if(isset($_GET['mesdevenda'])){ 

 
  $totaldeentrada_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  formadepagamento='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
  

      
} 

                                   $valor=$totaldeentrada_parcial;
                                    if($totaldeentrada_geral==0){$totaldeentrada_geral=1;} $percentagem=round($valor*100/$totaldeentrada_geral); ?>
                                  

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
                      <?php   $listadefuncionários=mysqli_query($conexao, "select * from formasdepagamento"); 
                            while($exibir2 = $listadefuncionários->fetch_array()){ ?>
                      <th><?php echo $exibir2['formadepagamento']; ?></th>
                      <?php } ?>
                      <th>Total</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php $listadefuncionários=mysqli_query($conexao, "select DISTINCT(funcionarios.idfuncionario ), funcionarios.nomedofuncionario, funcionarios.idfuncionario from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario");
                   while($exibir = $listadefuncionários->fetch_array()){
                    $idfuncionario=$exibir["idfuncionario"];
                       ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                   
                      <?php   $formasdepagamentolista=mysqli_query($conexao, "select * from formasdepagamento"); 
                      $total=0;
                            while($exibir2 = $formasdepagamentolista->fetch_array()){ 
                                $tipo=$exibir2["formadepagamento"];
                                $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas  where idfuncionario='$idfuncionario' AND formadepagamento='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
  
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



  <!-- DataTales Example -->
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Resumo</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
