<?php include("conexao.php");  

    
    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];
    
$categoria=isset($_GET['categoria'])?$_GET['categoria']:"todos";
 
if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}


if(isset($_POST['cadastrar'])){

  $nomedameta= $_POST['nomedameta']; 
  $sector= $_POST['sector']; 
  $diainicio= $_POST['diainicio'];
  $diafim= $_POST['diafim']; 
  $valor= $_POST['valor']; 
  $obs= $_POST['obs']; 
  
  $salvar= mysqli_query($conexao,"INSERT INTO `metas` (`idmeta`, `nomedameta`, `diainicio`, `diafim`, `valor`, `obs`, `data`, sector) VALUES (NULL, '$nomedameta', STR_TO_DATE('$diainicio', '%d/%m/%Y'),  STR_TO_DATE('$diafim', '%d/%m/%Y'), '$valor', '$obs', CURRENT_TIMESTAMP, '$sector')");

  if(!$salvar){
    $erros[]= "Ocorreu um ERRO, verifique se todos os campos foram devidamente preenchidos!";
    
  }else{
    header('Location: metas.php');
  } 


}

$cardeeditar="";



 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
<?php

$totaldemetas=mysqli_num_rows(mysqli_query($conexao, "select idmeta FROM metas")); 

?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Minhas Metas | <?php echo $totaldemetas; 
 if($totaldemetas==0){$totaldemetas=0.00000001;} ?></h1>
          <p class="mb-4">A seguir vai a lista de Metas que foram traçadas</p>
 
          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>
  <!-- Content Row -->
 
          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Cadastrar Meta</button>

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="post" action=""> 
           
                    <div class="form-group">
                      <input type="text" name="nomedameta" class="form-control"  title="Digite o nome que você quer dar para essa meta" placeholder="Nome da Meta" required="">
                    </div> 
                    <div class="form-group">
                     <label>Sector</label>
                      <select name="sector"  class="form-control" title="Escolha aqui o sector">
                      <option value="Todos">Todos</option>
                     <?php $listadeprodutos=mysqli_query($conexao,"SELECT distinct(tipo) FROM entradas"); 
                         while($exibir = $listadeprodutos->fetch_array()){  ?>
                          <option value="<?php echo $exibir["tipo"]?>"><?php echo $exibir["tipo"]?></option>
                   <?php } ?>
                     </select>
                    </div>  
                    <div class="form-group row"> 
                      <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" name="diainicio" class="form-control js-datepicker" title="Que dia irá iniciar?" placeholder="Data de Início" required="">
                      </div>
                      <div class="col-sm-6">
                      <input type="text" name="diafim" class="form-control js-datepicker" title="Que dia irá terminar? OBS: As metas têm duração de no máximo um mês, ou seja no máximo devem ter duração de 31 dias" placeholder="Data final" required="">
                      </div>
                    </div> 

                    <div class="form-group">
                      <input type="number" name="valor" class="form-control"  title="Digite a quantia em valor que você quer alcançar nesse período de tempo" placeholder="Quantia a alcançar" required="">
                    </div> 
                    <div class="form-group">
                      <input type="text" name="obs" class="form-control"  title="Se tiver alguma informação relevante para essa meta, digite-a aqui" placeholder="Algumas observações">
                    </div> 
                    
                    <br>
                       <input type="submit" name="cadastrar" value="Cadastrar Meta" class="btn btn-primary" style="float: rigth;">
                    
          </form>
        </div>
    </div>


    
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

                  <br> <br>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabela de preços</h6>
            </div>
            <div class="card-body">
            <span id="mensagemdealerta"></span> 
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Meta</th> 
                      <th>Sector</th>
                      <th>Início</th> 
                      <th>Fim</th> 
                      <th title="Total de dias para a meta ser cumprida">Dias</th> 
                      <th title="Total de dias que já se passaram até a data actual">Dias já passado</th>
                      <th title="Quantia a alcançar">Quantia</th> 
                      <th title="Quantia alcançada">Alcance</th>  
                      <th title="Percentagem da conclusão da meta">Meta(%)</th>  
                      <th>Cadastrado em</th>  
                      <th>Opção</th>  
                    </tr>
                  </thead>
                  <tbody>
        <?php     $totalpreco=0;
                  $totalagregado=0;
                  $totaldivida=0;
                  $totaldecompras=0;
                  $totalmeta=0;
                  $totalpercentagemmeta=0;
                  
                    $listademetas=mysqli_query($conexao, "select * from metas"); 
                
                 
                   while($exibir = $listademetas->fetch_array()){

                    $sector=$exibir['sector']; 
                    $diainicio=$exibir['diainicio']; 
                    $diafim=$exibir['diafim']; 
                    $idmeta=$exibir['idmeta']; 
 
                    if($sector=="Todos"){
                      
                      $valorjaconseguido=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where (datadaentrada>'$diainicio' or datadaentrada='$diainicio') and (datadaentrada<'$diafim' or datadaentrada='$diafim')"))[0]+0; 
                   
                    }else{
                       
                      $valorjaconseguido=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where tipo='$sector' and (datadaentrada>'$diainicio' or datadaentrada='$diainicio') and (datadaentrada<'$diafim' or datadaentrada='$diafim')"))[0]+0; 
                   
                    }

                    $totaldedias=mysqli_fetch_array(mysqli_query($conexao," SELECT TIMESTAMPDIFF(DAY,'$diainicio','$diafim') FROM metas where idmeta='$idmeta'"))[0];
                    
                    $hoje=date("Y-m-d");

                    if($hoje>$diafim){ $hoje=$diafim;}
                    $diasjaconsumidos=mysqli_fetch_array(mysqli_query($conexao," SELECT TIMESTAMPDIFF(DAY,'$diainicio','$hoje') FROM metas where idmeta='$idmeta'"))[0];
                  

        ?>
                    <tr>
                      <td><?php echo $exibir['nomedameta']; ?></td>
                      <td><?php echo $sector; ?></td> 
                      <td><?php echo $exibir['diainicio']; ?></td>   
                      <td><?php echo $exibir['diafim']; ?></td>  
                      <td><?php echo $totaldedias; ?></td>   
                      <td title="<?php if($totaldedias==0){$totaldedias=1;} if($diasjaconsumidos<0){ $diasjaconsumidos2=$diasjaconsumidos*(-1); echo "Faltam $diasjaconsumidos2 dias para começar a meta |";} $percentagem=round($diasjaconsumidos*100/$totaldedias); echo $percentagem; ?>% dos dias já consumidos"><?php echo $diasjaconsumidos; ?></td>
                      <td ><?php $n=number_format($exibir['valor'],2,",", "."); echo $n;  ?></td>
                      <td title="<?php $n=number_format($valorjaconseguido,2,",", ".");?>"><?php echo $n; ?></td>
                      <td><?php $percentagemdameta=round($valorjaconseguido*100/$exibir['valor']); echo $percentagemdameta; ?>%</td> 
                      <td><?php echo $exibir['data']; ?></td> 
                      <td><a href="" class="delete" id="<?php echo $exibir["idmeta"]; ?>" ><i style="color:red" title="Eliminar essa Meta" class="fas fa-trash"></i></a></td>
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
      
      
                                                            $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar essa Meta?")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletemeta.php',
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
