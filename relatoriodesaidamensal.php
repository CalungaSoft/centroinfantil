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


 
    $nomedotipo=isset($_GET['nomedotipo'])?$_GET['nomedotipo']:"todos";

    $hoje=date('d');
    $mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
    $mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
    $anodevenda=mysqli_escape_string($conexao, $anodevenda);
    
    $filtro = isset($_GET['filtro'])?$_GET['filtro']:"$hoje";
    $idfuncionario=$idlogado;

    $dia=date('d');
    $diadevenda=isset($_GET['diadevenda'])?$_GET['diadevenda']:"$dia";
    $diadevenda=mysqli_escape_string($conexao, $diadevenda);
        

 
  
 
 
 
if(!isset($_GET['mesdevenda'])){  
    
        $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas"))[0];
  	    
	  

 
}else if(isset($_GET['mesdevenda'])){ 

     
      $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)"))[0];
      

		  
} 
include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php
      $valornocaixa=number_format($totaldesaida,2,",", ".");
      $saida=number_format($totaldesaida,2,",", ".");
      
		?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Saídas Financeira na Escola <?php if(isset($_GET['mesdevenda'])){ echo "|  $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
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
    <button id="myBtn" class="btn btn-primary">Escolher o Mês</button>
   
    <a href="pdf/pdfrelatoriodesaidamensal.php?mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>&diadevenda=<?php echo $diadevenda; ?>"> <button   class="btn btn-info" >Imprimir Relatório Desse Mês</button></a>
        
                           
                           
     

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                   <?php    $anoactual=date('Y'); ?>
                     <div class="form-group"> 
                      <input type="number" id="anoescolhido" name="anodevenda" min="2010" max="2200" class="form-control"   placeholder="Ano" value="<?php echo "$anoactual";?>">
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

                          $diferentesformasdesaida=mysqli_query($conexao,"SELECT * from tipodesaidas");

                          while($exibir = $diferentesformasdesaida->fetch_array()){


                                $idtipo=$exibir["idtipodesaida"];
                                $tipo=$exibir["tipo"];
                                 
                                $totaldesaida_geral=$totaldesaida;
if(!isset($_GET['mesdevenda'])){   
    
    $totaldesaida_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where idtipo='$idtipo'"))[0];
      
  


}else if(isset($_GET['mesdevenda'])){ 

 
  $totaldesaida_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  idtipo='$idtipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];
  

      
} 

                                   $valor=$totaldesaida_parcial;
                                    if($totaldesaida_geral==0){$totaldesaida_geral=1;} 

                                    $percentagem=round($valor*100/$totaldesaida_geral);

                                    ?>
                                  

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
                      <?php   $listadefuncionários=mysqli_query($conexao, "select * from tipodesaidas"); 
                            while($exibir2 = $listadefuncionários->fetch_array()){ ?>
                      <th><?php echo $exibir2['tipo']; ?></th>
                      <?php } ?>
                      <th>Total</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $listadefuncionários=mysqli_query($conexao, "select DISTINCT(funcionarios.idfuncionario ), funcionarios.nomedofuncionario, funcionarios.idfuncionario from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario"); 
                   while($exibir = $listadefuncionários->fetch_array()){
                    $idfuncionario=$exibir["idfuncionario"];
                       ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                   
                      <?php   $listadefuncionários2=mysqli_query($conexao, "select * from tipodesaidas"); 
                      $total=0;
                            while($exibir2 = $listadefuncionários2->fetch_array()){ 
                                $idtipo=$exibir2["idtipodesaida"];
                                $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas  where idfuncionario='$idfuncionario' AND idtipo='$idtipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)"))[0];
  
                                $total+=$totaldesaida;
                                $valorf=number_format($totaldesaida,2,",", "."); 
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

    

 <div class="row">  
                    <?php  

                          $diferentesformasdeentrada=mysqli_query($conexao,"SELECT * from formasdepagamento");
  
                          $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];
      

                          while($exibir = $diferentesformasdeentrada->fetch_array()){


                                $idtipo=$exibir["idformadepagamento"];
                                $tipo=$exibir["formadepagamento"];
                                 
                                $totaldeentrada_geral=$totaldesaida;


if(!isset($_GET['mesdevenda'])){   
    
    $totaldeentrada_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where formadesaida='$tipo'"))[0];
      
  


}else if(isset($_GET['mesdevenda'])){ 

 
  $totaldeentrada_parcial = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  formadesaida='$tipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)"))[0];
  

      
} 

                                   $valor=$totaldeentrada_parcial;
                                    if($totaldeentrada_geral==0){$totaldeentrada_geral=1;} $percentagem=round($valor*100/$totaldeentrada_geral); ?>
                                  

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4"> 
                  <a href="gestaodecontas.php?nomedotipo=<?php echo "$tipo";  ?>&tipomarcado=<?php echo "$idtipo";  ?><?php if(isset($_GET['mesdevenda'])){ ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?><?php }?>"><div class="card border-left-info shadow h-100 py-2" >
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
                  </div></a>
              
              
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
                  <?php
                  
                  $listadefuncionários=mysqli_query($conexao, "select DISTINCT(funcionarios.idfuncionario ), funcionarios.nomedofuncionario, funcionarios.idfuncionario from funcionarios, saidas where funcionarios.idfuncionario=saidas.idfuncionario"); 
                   while($exibir = $listadefuncionários->fetch_array()){
                    $idfuncionario=$exibir["idfuncionario"];
                       ?>
                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>" ><?php echo $exibir['nomedofuncionario']; ?></a></td>
                   
                      <?php   $listadefuncionários2=mysqli_query($conexao, "select * from formasdepagamento"); 
                      $total=0;
                            while($exibir2 = $listadefuncionários2->fetch_array()){ 
                                $tipo=$exibir2["formadepagamento"];
                                $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas  where idfuncionario='$idfuncionario' AND formadesaida='$tipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];
  
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
              <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
            </div>
            <div class="card-body">

              <div class="table-responsive">
               <span id="mensagemdealerta"></span> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                  <tr>
                      <th>Funcionário</th> 
                      <th>Descrição</th>  
                      <th>Categoria</th>
                      <th>Valor</th>
                      <th>Em Falta</th>
                      <th>Data</th>
                      <th>Opção</th> 
                    </tr>
                  </thead> 
                  <tbody>
                  <?php
              
                        $registrosdesaidas=mysqli_query($conexao, "select  saidas.*, funcionarios.nomedofuncionario from saidas, funcionarios where '$anodevenda'=YEAR(saidas.datadasaida) AND '$mesdevenda'=MONTH(saidas.datadasaida) and funcionarios.idfuncionario=saidas.idfuncionario  order by saidas.idsaida desc");
                    
                      
                      $totalsaidas=0;
                      $totaldividas=0;
 while($exibir = $registrosdesaidas->fetch_array()){
                    

                      ?>

                     <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td> 
                      <td class="update" data-id="<?php echo $exibir["idsaida"]; ?>" data-column="descricao" <?php if($exibir["idtipo"]!="1"){?>  contenteditable <?php } ?> ><?php echo $exibir["descricao"]; ?></td> 
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idsaida"]; ?>" data-column="valor" <?php if($exibir["idtipo"]!="1"){?>  contenteditable <?php } ?>  title="<?php  $valor=number_format($exibir["valor"],2,",", ".");  echo $valor; ?>"><?php echo $exibir["valor"]; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idsaida"]; ?>" data-column="divida" <?php if($exibir["idtipo"]!="1"){?>  contenteditable <?php } ?>  title="<?php  $divida=number_format($exibir["divida"],2,",", "."); echo $divida; ?>"><?php echo $exibir["divida"]; ?></td>
                      <td><?php echo $exibir["datadasaida"]; ?></td>
                      <td>
                       
                        <a href="saidaseditar.php?idsaida=<?php echo $exibir["idsaida"]; ?>"  ><i  title="Visualizar ou editar essa saida" class="fas fa-eye"></i></a>
                    
                      
                     </td>
                    </tr> 
                   <?php }    ?>
                   </tbody>  
                </table>
              </div>
            </div>
          </div>

      </div>
      <!-- End of Main Content -->



      <script>


                                                        $(document).on("blur", ".update", function(){
                                                                var id=$(this).data("id");
                                                                var nomedacoluna=$(this).data("column");
                                                                var valor=$(this).text();
                                                                 

                                                                $.ajax({
                                                                    url:'cadastro/updatesaida.php',
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
                                                                    url:'cadastro/deletesaida.php',
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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
