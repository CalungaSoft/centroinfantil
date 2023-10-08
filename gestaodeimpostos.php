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



$tipomarcado=isset($_GET['tipomarcado'])?$_GET['tipomarcado']:"todos";
$nomedotipo=isset($_GET['nomedotipo'])?$_GET['nomedotipo']:"todos";

    $hoje=date('d');
    $mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
    
    $filtro = isset($_GET['filtro'])?$_GET['filtro']:"$hoje";
    $idfuncionario =$idlogado;

    
      

 
 


if(isset($_GET['del'])){
      
  $idimposto=mysqli_escape_string($conexao, trim($_GET['idimposto']));   
 
 
    $salvar1=mysqli_query($conexao,"DELETE from impostos where idimposto='$idimposto'");

    if($salvar1){
      $acertos[]="Categoria Eliminada com Sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 
 
    

 

}


if(isset($_POST['cadastrarnovoimposto'])){
      
  $imposto=mysqli_escape_string($conexao, $_POST['imposto']);   
  $incidencia=mysqli_escape_string($conexao, $_POST['incidencia']); 

  $percentagem=mysqli_escape_string($conexao, $_POST['percentagem']);   
  $obs=mysqli_escape_string($conexao, $_POST['obs']); 

  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao,"SELECT idimposto FROM `impostos` where imposto='$imposto' and incidencia='$incidencia' "));

  if($verificarexistencia==0){
    $salvar1=mysqli_query($conexao,"INSERT INTO `impostos` (`idimposto`, `imposto`, `incidencia`, `percentagem`, `obs`) VALUES (NULL, '$imposto', '$incidencia', '$percentagem', '$obs')");

    if($salvar1){
      $acertos[]="Categoria $imposto cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

  }else{
    $erros[]="Essa categoria de Imposto já foi cadastrada";
  }
    

 

}



if(isset($_POST['editartipo'])){
      
  $idimposto=mysqli_escape_string($conexao, trim($_POST['idimposto'])); 
  $imposto=mysqli_escape_string($conexao, $_POST['imposto']);   
  $incidencia=mysqli_escape_string($conexao, $_POST['incidencia']); 

  $percentagem=mysqli_escape_string($conexao, $_POST['percentagem']);   
  $obs=mysqli_escape_string($conexao, $_POST['obs']); 

  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao," SELECT idimposto FROM impostos where imposto='$imposto' and  `idimposto` != '$idimposto'"));

  if($verificarexistencia==0){

     if(!($percentagem>100)){
      $guardar=mysqli_query($conexao,"UPDATE `impostos` SET `imposto` = '$imposto', `incidencia` = '$incidencia', `percentagem` = '$percentagem', `obs` = '$obs ' WHERE `impostos`.`idimposto` = '$idimposto'");
     }else {
      $erros[]="A percentagem não pode ser superior a 100";
     }
       
     
      
      if($guardar){
        header("location:gestaodeimpostos.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda");
      }else{
        $erros[]="ocorreu algum erro!";
      }
    }else{
      $erros[]="Já existe essa categoria de imposto";
    } 

}

 
if(!isset($_GET['mesdevenda'])){  
    
        $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas"))[0];
  	    $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas"))[0];
	  

 
}else if(isset($_GET['mesdevenda'])){ 

     
      $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
      $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where  '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];

		  
} 
include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php
      $valornocaixa=number_format($totaldeentrada-$totaldesaida,2,",", ".");
      $entrada=number_format($totaldeentrada,2,",", ".");
      $saida=number_format($totaldesaida,2,",", ".");
		?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Entradas(<?php echo $entrada; ?>KZ) e Saídas (<?php echo $saida; ?>KZ) Financeira no Hospital <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
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
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma nova categoria de imposto">Cadastrar Novo tipo de Imposto</button>
        
                           
                             
    <?php
  
  if($tipomarcado!="todos"){?>  
  
  <a href="gestaodeimpostos.php?del=yes&idimposto=<?php echo $tipomarcado; ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>"><button class="btn btn-danger">ELIMINAR ESSA CATEGORIA de <?php echo $nomedotipo; ?></button> </a>

<?php   } ?>

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">
                      <select name="anodevenda"  class="form-control" title="Escolha aqui o ano"  >
                          <option <?php $anoactual=date('Y'); if($anoactual==2020) { ?> selected="" <?php }?> value=2020>2020</option>
                          <option <?php if($anoactual==2021) { ?> selected="" <?php }?> value=2021>2021</option>
                          <option <?php if($anoactual==2022) { ?> selected="" <?php }?> value=2022>2022</option>
                          <option <?php if($anoactual==2023) { ?> selected="" <?php }?> value=2023>2023</option>
                          <option <?php if($anoactual==2024) { ?> selected="" <?php }?> value=2024>2024</option>
                          <option <?php if($anoactual==2025) { ?> selected="" <?php }?> value=2025>2025</option>
                          <option <?php if($anoactual==2026) { ?> selected="" <?php }?> value=2026>2026</option>
                          <option <?php if($anoactual==2027) { ?> selected="" <?php }?> value=2027>2027</option>
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
          <h3>Cadastrando Novo tipo de Imposto</h3>
                      <br>
                      <div class="form-group">

                             <span>Imposto</span>
                                 <input type="text" name="imposto" class="form-control" placeholder="Nome do Imposto">
                              </div> 
                               <div class="form-group">
                                  <span>Incidência</span>
                                     
                                    <select name="incidencia" required  class="form-control" title="sobre que, Incide esse imposto?"  > 
                          
                                        <option   value="entradas">Entradas Financeiras</option>
                                        <option  value="saidas">Saídas Financeiras</option>
                                        <option   value="lucros">Lucros (Entradas-Saídas)</option>
                                 
                                  </select> 
                
                               </div> 

                               <div class="form-group">
                             <span>percentagem</span>
                                 <input type="number" name="percentagem" class="form-control" placeholder="Percentagem de Incidência">
                              </div>

                              <div class="form-group">
                             <span>OBS</span>
                                 <input type="text" name="obs" class="form-control" placeholder="Alguma observação?">
                              </div>
                          <br>
                       <input type="submit" value="Cadastrar Novo tipo de Imposto" name="cadastrarnovoimposto" class="btn btn-success" style="float: rigth;">
            

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
<?php if(isset($_GET['tipomarcado'])){ 
                       
                       $tipo=$_GET['tipomarcado'];
                       $dadosdotipodeimposto=mysqli_fetch_array(mysqli_query($conexao," SELECT  *  FROM impostos where idimposto='$tipo'"));
                     
                     ?>  
 
                   <!-- Collapsable Card Example -->
                   <div class="card shadow mb-4">
                           <!-- Card Header - Accordion -->
                           <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                             <h6 class="m-0 font-weight-bold text-primary">Clique aqui para editar dados relativos a: <span style="color:red"> <?php echo $dadosdotipodeimposto["imposto"]; ?> </span> </h6>
                           </a>
                           <form class="user" action=""  method="post">
                             <!-- Card Content - Collapse -->
                           <div class="collapse" id="collapseCardExample">
                             <div class="card-body">
                          
 
                             <div class="form-group">
                             <span>Imposto</span>
                                 <input type="text" name="imposto" class="form-control" value="<?php echo $dadosdotipodeimposto["imposto"]; ?>">
                              </div> 
                               <div class="form-group">
                                  <span>Incidência</span>
                                     
                                    <select name="incidencia" required  class="form-control" title="sobre que, Incide esse imposto?"  > 
                          
                                        <option <?php if($tipomarcado=="entradas") { ?> selected="" <?php } ?> value="entradas">Entradas Financeiras</option>
                                        <option <?php if($tipomarcado=="saidas") { ?> selected="" <?php } ?> value="saidas">Saídas Financeiras</option>
                                        <option <?php if($tipomarcado=="lucros") { ?> selected="" <?php } ?> value="lucros">Lucros (Entradas-Saídas)</option>
                                 
                                  </select> 
                
                               </div> 

                               <div class="form-group">
                             <span>percentagem</span>
                                 <input type="number" name="percentagem" class="form-control" value="<?php echo $dadosdotipodeimposto["percentagem"]; ?>">
                              </div>

                              <div class="form-group">
                             <span>OBS</span>
                                 <input type="text" name="obs" class="form-control" value="<?php echo $dadosdotipodeimposto["obs"]; ?>">
                              </div>

                                     <br>
                                <input type="hidden" name="idimposto" value="<?php echo $dadosdotipodeimposto["idimposto"]; ?>">
                                <input type="submit" value="Guardar Alterações" name="editartipo" class="btn btn-success" style="float: rigth;">
                                  <br><br>
                                  
                                </form> 
 

                                 
                                    
                             </div>

                           </div>
                        
                         </div>

                         
                     <?php } ?>
                     <!-- Content Row -->
                    <!-- Content Row -->
                    <div class="row">  
                    <?php  

                          $diferentestipodesaidas=mysqli_query($conexao,"SELECT * from impostos");

                          while($exibir = $diferentestipodesaidas->fetch_array()){


                                $idtipo=$exibir["idimposto"];
                                $tipo=$exibir["imposto"];
                                $percentagem=$exibir["percentagem"]; 
                                $incidencia=$exibir["incidencia"]; 

                                 if($incidencia=="entradas"){
                              
                                   $valor=$totaldeentrada;
                                 }else
                                 if($incidencia=="saidas"){
                              
                                  $valor=$totaldesaida;
                                }else  if($incidencia=="lucros"){

                                  $valor=$totaldeentrada-$totaldesaida;
                                }
                                  
                                  ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4"> 
                  <a href="gestaodeimpostos.php?nomedotipo=<?php echo "$tipo";  ?>&tipomarcado=<?php echo "$idtipo";  ?><?php if(isset($_GET['mesdevenda'])){ ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?><?php }?>"><div class="card border-left-info shadow h-100 py-2" <?php if($tipomarcado==$idtipo){?> style="background-color: gray;" <?php } ?>>
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"> <h5><?php echo "$tipo";  ?></h5>  <br> |<?php echo "$incidencia";  ?> <br>| <?php $valorf=number_format($valor,2,",", "."); echo $valorf; ?> x <?php echo "$percentagem";  ?> %</div>
                          <div class="row no-gutters align-items-center"> = <?php if($valor==0){$valor=1;} $resultado=number_format(round($valor*$percentagem/100),2,",", "."); ?>
                            <div class="col-auto">
                              <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$resultado";  ?> KZ</div>
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
 

 </div> </div>
        
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
 

</body>

</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             