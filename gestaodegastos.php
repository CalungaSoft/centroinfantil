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
      
  $tipo=mysqli_escape_string($conexao, trim($_GET['idtipodesaida']));   

  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao,"SELECT idsaida FROM `saidas` where idtipo='$tipo'"));

  if($verificarexistencia==0){
    $salvar1=mysqli_query($conexao,"DELETE from tipodesaidas where idtipodesaida='$tipo'");

    if($salvar1){
      $acertos[]="Categoria Eliminada com Sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

  }else{
    $erros[]="Esse categoria de gasto não pode ser eliminada, porquê existem registro de saídas com essa categoria, elimine esses registos e tente novamente";
  }
    

 

}


if(isset($_POST['cadastrartipodesaida'])){
      
  $tipo=mysqli_escape_string($conexao, trim($_POST['tipo']));  
  $valorlimite=mysqli_escape_string($conexao, trim($_POST['valorlimite']));  
  $categoria=mysqli_escape_string($conexao, trim($_POST['categoria']));  
 
  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao,"SELECT idtipodesaida FROM `tipodesaidas` where tipo='$tipo'"));

  if($verificarexistencia==0){
    $salvar1=mysqli_query($conexao,"INSERT INTO `tipodesaidas` (`idtipodesaida`, `tipo`, `valorlimite`, categoria) VALUES (NULL, '$tipo', '$valorlimite', '$categoria')");

    if($salvar1){
      $acertos[]="Categoria $tipo cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

  }else{
    $erros[]="Essa categoria de gasto já foi cadastrada";
  }
    

 

}



if(isset($_POST['editartipo'])){
      
  $tipo=mysqli_escape_string($conexao, trim($_POST['tipo'])); 
  $valorlimite=mysqli_escape_string($conexao, $_POST['valorlimite']);   
  $idtipo=mysqli_escape_string($conexao, $_POST['idtipo']); 
  $categoria=mysqli_escape_string($conexao, $_POST['categoria']); 

  $verificarexistencia=mysqli_num_rows(mysqli_query($conexao," SELECT idtipodesaida FROM tipodesaidas where tipo='$tipo' and `tipodesaidas`.`idtipodesaida` != '$idtipo'"));

  if($verificarexistencia==0){

      if($idtipo==1){
        $guardar=mysqli_query($conexao,"UPDATE `tipodesaidas` SET `valorlimite` = '$valorlimite'  WHERE `tipodesaidas`.`idtipodesaida` = '$idtipo'");
      }else{
        $guardar=mysqli_query($conexao,"UPDATE `tipodesaidas` SET `tipo` = '$tipo', `valorlimite` = '$valorlimite', categoria='$categoria'  WHERE `tipodesaidas`.`idtipodesaida` = '$idtipo'");
      }
      
      if($guardar){
        header("location:gestaodegastos.php?mesdevenda=$mesdevenda&anodevenda=$anodevenda");
        
      }else{
        $erros[]="ocorreu algum erro!";
      }
    }else{
      $erros[]="Já existe essa categoria de gasto";
    } 

}


 
if(!isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado']) ){  
   
  for ($i=1; $i <=31 ; $i++) { 
      $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from saidas where DAY(datadasaida)='$i'"))[0];
    } 
      
    $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valorlimite) from tipodesaidas"))[0];

 
}else if(isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado']) ){ 

    for ($i=1; $i <=31 ; $i++) { 
    $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from saidas where  DAY(datadasaida)='$i' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) "))[0];

    $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valorlimite) from tipodesaidas"))[0];

  }
     

}else if(!isset($_GET['mesdevenda']) && isset($_GET['tipomarcado']) ){ 
  
  for ($i=1; $i <=31 ; $i++) { 
    $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from saidas where  DAY(datadasaida)='$i' and idtipo='$tipomarcado' "))[0];

    $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valorlimite) from tipodesaidas where idtipodesaida='$tipomarcado'"))[0];

  }
   
 
}else if(isset($_GET['mesdevenda']) && isset($_GET['tipomarcado']) ) {

  for ($i=1; $i <=31 ; $i++) { 
    $dia[$i]=mysqli_fetch_array( mysqli_query($conexao,"select SUM(valor) from saidas where  DAY(datadasaida)='$i' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida) and  idtipo='$tipomarcado'"))[0];
  }
  
  $totaldesaida = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valorlimite) from tipodesaidas where idtipodesaida='$tipomarcado'"))[0];
   
}

include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php
      
      $valordesaida=number_format($totaldesaida,2,",", ".");
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Previsão de Saídas Financeira Mensal na Escola <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($nomedotipo)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"><?php echo $valordesaida; ?>KZ</h1>
           
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
    <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma nova categoria de saida (Gastos)">Cadastrar Novo tipo de Saída</button>
        
                           
                             
    <?php
 
$existe=mysqli_num_rows(mysqli_query($conexao,"SELECT idsaida  FROM saidas where idtipo='$tipomarcado'"));

  if($existe==0 && $tipomarcado!="todos" && $tipomarcado!=1){?>  
  
  <a href="gestaodegastos.php?del=yes&idtipodesaida=<?php echo $tipomarcado; ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?>"><button class="btn btn-danger">ELIMINAR ESSA CATEGORIA de <?php echo $nomedotipo; ?></button> </a>

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
                      <br>
      
                    <div class="form-group">
                      <input type="text" autocomplete="off" list="datalist1" name="tipo" class="form-control "  title="Descreve aqui a categoria de saída" placeholder="Tipo de saída" required="" >
                      <datalist id="datalist1">
                        <?php
                             $diferentestipodesaidas=mysqli_query($conexao,"SELECT tipo from tipodesaidas");
                          while($exibir = $diferentestipodesaidas->fetch_array()){ ?>
                          <option value="<?php echo $exibir['tipo'];?>"> 
                        <?php } ?>  
                      </datalist>
                    </div>

                     <div class="form-group">
                      <input type="text" autocomplete="off" list="datalist2" name="categoria" class="form-control "  title="Descreve aqui a categoria de saída" placeholder="Categoria de saída" required="" >
                      <datalist id="datalist2">
                        <?php
                             $diferentecategorias=mysqli_query($conexao,"SELECT distinct(categoria) from tipodesaidas");
                          while($exibir = $diferentecategorias->fetch_array()){ ?>
                          <option value="<?php echo $exibir['categoria'];?>"> 
                        <?php } ?>  
                      </datalist>
                    </div>


                      <div class="form-group">
                            <input type="number" name="valorlimite" class="form-control " title="Digite aqui o valor limite previsto para esse tipo de gasto" placeholder="Valor limite mensal">
                        </div> 

                          <br>
                       <input type="submit" value="Cadastrar Novo tipo de saída" name="cadastrartipodesaida" class="btn btn-success" style="float: rigth;">
            

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
                       $dadosdotipodesaida=mysqli_fetch_array(mysqli_query($conexao," SELECT  *  FROM tipodesaidas where idtipodesaida='$tipo'"));
                     
                     ?>  
 
                   <!-- Collapsable Card Example -->
                   <div class="card shadow mb-4">
                           <!-- Card Header - Accordion -->
                           <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                             <h6 class="m-0 font-weight-bold text-primary">Clique aqui para editar dados relativos a: <span style="color:red"> <?php echo $dadosdotipodesaida["tipo"]; ?> </span> </h6>
                           </a>
                           <form class="user" action=""  method="post">
                             <!-- Card Content - Collapse -->
                           <div class="collapse" id="collapseCardExample">
                             <div class="card-body">
                          
 
                             <div class="form-group">
                             <span>Tipo de Saída</span>
                                 <input type="text" name="tipo" class="form-control" value="<?php echo $dadosdotipodesaida["tipo"]; ?>">
                               </div> 

                                <div class="form-group">
                      <input type="text" autocomplete="off" list="datalist2" name="categoria" class="form-control "  title="Descreve aqui a categoria de saída" placeholder="Categoria de saída" required="" value="<?php echo $dadosdotipodesaida["categoria"]; ?>" >
                      <datalist id="datalist2">
                        <?php
                             $diferentecategorias=mysqli_query($conexao,"SELECT distinct(categoria) from tipodesaidas");
                          while($exibir = $diferentecategorias->fetch_array()){ ?>
                          <option value="<?php echo $exibir['categoria'];?>"> 
                        <?php } ?>  
                      </datalist>
                    </div>

                               <div class="form-group">
                               <span>Valor Limite</span>
                                 <input type="number" name="valorlimite" class="form-control" value="<?php echo $dadosdotipodesaida["valorlimite"]; ?>">
                               </div> 

                                     <br>
                                <input type="hidden" name="idtipo" value="<?php echo $dadosdotipodesaida["idtipodesaida"]; ?>">
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

                          $diferentestipodesaidas=mysqli_query($conexao,"SELECT * from tipodesaidas");

                          while($exibir = $diferentestipodesaidas->fetch_array()){


                                $idtipo=$exibir["idtipodesaida"];
                                $tipo=$exibir["tipo"];
                                $valorlimite=$exibir["valorlimite"]; 

                                if(!isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado'])){
                                  $quantidadedesaidas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where idtipo='$idtipo'"))[0];
                                }
                                 else if(isset($_GET['mesdevenda']) && isset($_GET['tipomarcado'])){ 

                                  $quantidadedesaidas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where idtipo='$idtipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)"))[0];}

                                 else if(!isset($_GET['mesdevenda']) && isset($_GET['tipomarcado'])){
                                  $quantidadedesaidas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where idtipo='$idtipo'"))[0]; }
                                  
                                 else  if(isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado'])){
                                  $quantidadedesaidas = mysqli_fetch_array(mysqli_query($conexao,"select SUM(valor) from saidas where idtipo='$idtipo' and '$anodevenda'=YEAR(datadasaida) AND '$mesdevenda'=MONTH(datadasaida)"))[0];}
                                 
                                  $valorlimitef=number_format($valorlimite,2,",", "."); 
                                  $quantidadedesaidasf=number_format($quantidadedesaidas,2,",", "."); 

                                  ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4" title="Para Essa Secção estão previsto gasto de <?php echo $valorlimitef; ?>KZ até agora foram gastos <?php echo $quantidadedesaidasf; ?>KZ  "> 
                  <a href="gestaodegastos.php?nomedotipo=<?php echo "$tipo";  ?>&tipomarcado=<?php echo "$idtipo";  ?><?php if(isset($_GET['mesdevenda'])){ ?>&mesdevenda=<?php echo $mesdevenda; ?>&anodevenda=<?php echo $anodevenda; ?><?php }?>"><div class="card border-left-info shadow h-100 py-2" <?php if($tipomarcado==$idtipo){?> style="background-color: gray;" <?php } ?>>
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <?php echo $tipo;  ?> | <?php echo $quantidadedesaidasf; ?> /<?php  echo $valorlimitef; ?></div>
                          <div class="row no-gutters align-items-center"><?php if($valorlimite==0){$valorlimite=1;} $percentagem=round($quantidadedesaidas*100/$valorlimite); ?>
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
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












  </div>  
   </div> 


        
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
