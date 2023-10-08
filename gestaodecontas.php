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
    
  $idformadepagamento=mysqli_escape_string($conexao, trim($_GET['idformadepagamento']));
     
  $formadepagamento=mysqli_fetch_array(mysqli_query($conexao,"SELECT formadepagamento FROM `formasdepagamento` where idformadepagamento='$idformadepagamento'"))[0];


  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao,"SELECT identrada FROM `entradas` where formadepagamento='$formadepagamento'"));

  if($verificarexistencia==0){
    $salvar1=mysqli_query($conexao,"DELETE from formasdepagamento where idformadepagamento='$idformadepagamento'");
    if($salvar1){
        $acertos[]="Forma de pagamento Eliminado com Sucesso!";
      }else{
        $erros[]="ocorreu algum erro!";
      } 
  }else{
    $erros[]="Não pode eliminar essa forma de pagamento, pois alguns registros de pagamentos foram registrado sob essa forma";
  }
   
   
 
    

 

}


if(isset($_POST['cadastrarformadepagamento'])){
      
  $formadepagamento=mysqli_escape_string($conexao, $_POST['formadepagamento']);   
   
  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao,"SELECT idformadepagamento FROM `formasdepagamento` where formadepagamento='$formadepagamento' "));

  if($verificarexistencia==0){
    $salvar1=mysqli_query($conexao,"INSERT INTO `formasdepagamento` (`formadepagamento`) VALUES ('$formadepagamento')");

    if($salvar1){
      $acertos[]="Forma de Pagamento $formadepagamento cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

  }else{
    $erros[]="Essa forma de pagamento já foi cadastrada antes";
  }
    

 

}


 
 
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
          <h1 class="h3 mb-2 text-gray-800">Entradas Financeira no Escola <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($tipomarcado)"; }?>   </h1>
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
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma nova categoria de formadepagamento">Cadastrar Novo tipo de Forma de Pagamento</button>
        
                           
                             
    <?php
  
  if($tipomarcado!="todos"){?>  
  
  <a href="gestaodecontas.php?del=yes&idformadepagamento=<?php echo $tipomarcado; ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>"><button class="btn btn-danger">ELIMINAR ESSA CATEGORIA de <?php echo $nomedotipo; ?></button> </a>

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
          <h3>Cadastrando Novo tipo de Forma de Pagamento</h3>
                      <br>
                      <div class="form-group">

                             <span>Forma de Pagamento</span>
                                 <input type="text" name="formadepagamento" class="form-control" placeholder="Forma de Pagamento">
                              </div>  
                       <input type="submit" value="Cadastrar Novo tipo de formadepagamento" name="cadastrarformadepagamento" class="btn btn-success" style="float: rigth;">
            

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
                       $dadosdaconta=mysqli_fetch_array(mysqli_query($conexao," SELECT  *  FROM formasdepagamento where idformadepagamento='$tipo'"));
                     
                     ?>  
 
                   
                         
                     <?php } ?>
                     <!-- Content Row -->
                    <!-- Content Row -->
                    <div class="row">  
                    <?php  

                          $diferentesformasdeentrada=mysqli_query($conexao,"SELECT * from formasdepagamento");
                             $totaldeentrada_geral=$totaldeentrada;

                          while($exibir = $diferentesformasdeentrada->fetch_array()){


                                $idtipo=$exibir["idformadepagamento"];
                                $tipo=$exibir["formadepagamento"];
                                 
                             
if(!isset($_GET['mesdevenda'])){   
    
    $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where formadepagamento='$tipo'"))[0];
      
  


}else if(isset($_GET['mesdevenda'])){ 

 
  $totaldeentrada = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from entradas where  formadepagamento='$tipo' and '$anodevenda'=YEAR(datadaentrada) AND '$mesdevenda'=MONTH(datadaentrada) "))[0];
  

      
} 

                                   $valor=$totaldeentrada;
                                    if($totaldeentrada_geral==0){$totaldeentrada_geral=1;} $percentagem=round($valor*100/$totaldeentrada_geral); ?>
                                  

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4"> 
                  <a href="gestaodecontas.php?nomedotipo=<?php echo "$tipo";  ?>&tipomarcado=<?php echo "$idtipo";  ?><?php if(isset($_GET['mesdevenda'])){ ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?><?php }?>"><div class="card border-left-info shadow h-100 py-2" <?php if($tipomarcado==$idtipo){?> style="background-color: gray;" <?php } ?>>
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
 
 </div>    </div>   

        
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
