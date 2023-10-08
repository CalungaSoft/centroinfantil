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

 


$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
    

if(isset($_POST['cadastrar'])){

  $titulo=mysqli_escape_string($conexao, $_POST['titulo']);     
  $posicao=mysqli_escape_string($conexao, $_POST['posicao']);   

  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM trimestres where titulo='$titulo' and idanolectivo='$idanolectivo'"))==0){ 
 
    $salvar= mysqli_query($conexao,"INSERT INTO `trimestres` (`idtrimestre`, `titulo`,  `idanolectivo`, `posicao`) VALUES (NULL, '$titulo', '$idanolectivo', '$posicao')");

    
    if($salvar){
      $acertos[]="$titulo Trimestre cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outro Trimestre com esse Nome";
   }


  }








if(isset($_GET['createProof'])){

 
    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));


      $nome_da_provadeescola=$dadosdoanolectivo["nomedaprovadeescola"];
      $nome_da_provaderecurso=$dadosdoanolectivo["nomedaprovadeexame"];



  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and (titulo='$nome_da_provaderecurso' or titulo='$nome_da_provaderecurso') and especial='1'"))==0){ 

    $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);

    $salvar= mysqli_query($conexao,"INSERT INTO `notasdoano` (`idtipodenota`, `titulo`, `idanolectivo`, `idtrimestre`, `percentagemnotrimestre`, `posicao`, `especial`) VALUES (NULL, '$nome_da_provadeescola', '$idanolectivo', '0',  '$percentagemrestante', '1', '1')");


    $salvar= mysqli_query($conexao,"INSERT INTO `notasdoano` (`idtipodenota`, `titulo`, `idanolectivo`, `idtrimestre`, `percentagemnotrimestre`, `posicao`, `especial`) VALUES (NULL, '$nome_da_provaderecurso', '$idanolectivo', '0', '1', '2', '1')");

    
    if($salvar){
      $acertos[]="Notas  $nome_da_provadeescola e $nome_da_provaderecurso  cadastradas com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outro Tipo de Nota com esse Nome Nesse Ano Lectivo";
   }


  }



  if(isset($_POST['cadastrarnota'])){

    $titulo=mysqli_escape_string($conexao, $_POST['titulo']);  
    $tipo=mysqli_escape_string($conexao, $_POST['tipo']); 
    $tipodeturma=mysqli_escape_string($conexao, $_POST['tipodeturma']); 
    $idtrimestre=mysqli_escape_string($conexao, $_POST['idtrimestre']); 
    $posicao=mysqli_escape_string($conexao, $_POST['posicao']);  
   
    if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where titulo='$titulo' and idtrimestre='$idtrimestre' and tipodeturma='$tipodeturma'"))==0){ 
   
      $salvar= mysqli_query($conexao,"INSERT INTO `notasdoano` (`idnotadoano`, `titulo`, `idtrimestre`, `idanolectivo`, `tipodeturma`, `posicao`, `tipo`) VALUES (NULL, '$titulo', '$idtrimestre', '$idanolectivo', '$tipodeturma', '$posicao', '$tipo')");
      
      
      if($salvar){
   
        $acertos[]="Tipo de Nota $titulo  cadastrado com sucesso!";
      }else{
        $erros[]="ocorreu algum erro!";
      } 
  
     
    }else {
        $erros[]="Já Existe um Outro Tipo de Nota com esse Nome Nesse trimestre";
     }
  
  
    }


    

if(isset($_POST['cadastrarmedia'])){

  $titulo=mysqli_escape_string($conexao, $_POST['titulo']);  
  
  $tipodeturma=mysqli_escape_string($conexao, $_POST['tipodeturma']); 
  $idtrimestre=mysqli_escape_string($conexao, $_POST['idtrimestre']); 
  $posicao=mysqli_escape_string($conexao, $_POST['posicao']);  
  $arredondarmedia=mysqli_escape_string($conexao, $_POST['arredondarmedia']); 
  $tipodemedia=mysqli_escape_string($conexao, $_POST['tipodemedia']); 
  
  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where titulo='$titulo' and idtrimestre='$idtrimestre' and tipodeturma='$tipodeturma'"))==0){ 
 
    $salvar= mysqli_query($conexao,"INSERT INTO `mediasdoano` (`idmediadoano`, `titulo`, `idtrimestre`, `idanolectivo`, `tipodeturma`, `posicao`, `arredondarmedia`, tipodemedia) VALUES (NULL, '$titulo', '$idtrimestre', '$idanolectivo', '$tipodeturma', '$posicao', '$arredondarmedia', '$tipodemedia')");
    
    
    if($salvar){
 
      $acertos[]="Tipo de media $titulo  cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outro Tipo de media com esse Nome Nesse trimestre";
   }


  }






if(isset($_POST['editardadosdoanolectivo'])){

  $nomedamediadostrimestres=mysqli_escape_string($conexao, $_POST['nomedamediadostrimestres']);  
  $percentagemdamediadostrimestres=mysqli_escape_string($conexao, $_POST['percentagemdamediadostrimestres']); 
  $nomedaprovadeescola=mysqli_escape_string($conexao, $_POST['nomedaprovadeescola']); 
  $nomedaprovadeexame=mysqli_escape_string($conexao, $_POST['nomedaprovadeexame']); 
  $nomedamediaanual=mysqli_escape_string($conexao, $_POST['nomedamediaanual']); 
  $arredondarmedia=mysqli_escape_string($conexao, $_POST['arredondarmedia']); 


 
    $salvar= mysqli_query($conexao,"UPDATE `anoslectivos` SET nomedamediadostrimestres='$nomedamediadostrimestres', percentagemdamediadostrimestres='$percentagemdamediadostrimestres', nomedaprovadeescola='$nomedaprovadeescola', nomedaprovadeexame='$nomedaprovadeexame', nomedamediaanual='$nomedamediaanual', arredondarmedia='$arredondarmedia'  WHERE `anoslectivos`.`idanolectivo` = '$idanolectivo'");

    
    if($salvar){
      $acertos[]="Alterações salvas com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  

  }
        include("cabecalho.php") ;
        
        
        
        $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo'"); 

                        
        while($exibir = $lista_de_medias->fetch_array()){
        
          if ($exibir["tipodemedia"]=="denotas") {

              $idmediadoano=$exibir["idmediadoano"];
              $tipodeturma=$exibir["tipodeturma"];
              $trimestre_sendo_verificado=$exibir["idtrimestre"];
 

              $lista_de_notas_do_trimestre= mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idtrimestre='$trimestre_sendo_verificado' and tipodeturma='$tipodeturma'"); 

                        
              while($ver = $lista_de_notas_do_trimestre->fetch_array()){

                  $idnota=$ver["idnotadoano"];
                  $acturalizando= mysqli_query($conexao, "UPDATE `notasdoano` SET `idmediaaquepertence` = '$idmediadoano' WHERE `notasdoano`.`idnotadoano` = '$idnota' and idmediaaquepertence='0'"); 
 
                  
              }      

          }


        }





           
        $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodemedia='demedias'"); 

                        
        while($exibir = $lista_de_medias->fetch_array()){
         
    

              $idmediadoano=$exibir["idmediadoano"];
              $tipodeturma=$exibir["tipodeturma"];

              $lista_de_mediado_ano= mysqli_query($conexao, "select * from mediasdoano where tipodemedia='denotas' and tipodeturma='$tipodeturma'"); 

                        
              while($ver = $lista_de_mediado_ano->fetch_array()){

                  $idmedia_das_medias=$ver["idmediadoano"];
                   $acturalizando= mysqli_query($conexao, "UPDATE `mediasdoano` SET `idmediamaior` = '$idmediadoano' WHERE  idmediadoano = '$idmedia_das_medias' and idmediamaior='0'"); 
 
                  
              }      

          


        }

        
        
        
        ?>

<?php
                                      $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Notas e Provas do Ano Lectivo</h1>
     
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
            ?>  <?php  include("estilocarde.php"); ?>
   

 
    <button id="myBtnreclamacoes" class="btn btn-primary">Cadastrar Novo Trimestre</button>
    <button id="myBtn" class="btn btn-info" title="Cadastrar uma saida">Cadastrar Nota</button> 
    <button id="myBtnmedia" class="btn btn-secondary" title="Cadastrar uma saida">Cadastrar Média</button> 

     

     <br><br>
   




     <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="post">
                <h3>Cadastrando Nota</h3>

                <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select distinct(titulo) from notasdoano"); 
                        
                          ?>
                          <span>Título da Nota</span>
                      <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control"  placeholder="Título para a nota" required="">
                      <datalist id="datalist2">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 
                     
                    <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo'"); 
                        
                          ?>
                          <span>Trimestre</span>
                       <select name="idtrimestre" class="form-control" >
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['idtrimestre']; ?>"><?php echo $exibir['titulo']; ?> </option> 
                        <?php } ?>
                        </select>
      
                    </div> 
                    
                    <div class="form-group">
                            <span>Classe de exame</span>
                              <select name="tipodeturma" required  class="form-control"> 
                                  <option value="Transição">Não</option>
                                  <option value="Exame">Sim</option> 
                              </select> 
                        </div> 
 
                        <div class="form-group">
                            <span>Tipo de Nota</span>
                              <select name="tipo" required  class="form-control"> 
                                  <option value="Normal">Normal</option>
                                  <option value="Recurso">Nota do Recurso</option> 
                              </select> 
                        </div> 

                        <div class="form-group">
                          <?php

                                $posicao=mysqli_num_rows(mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo'"))+1; 
                        
                          ?>
                          <span>Posição da nota no ano Lectivo</span>
                      <input type="number" step="1" min="0" max="61" name="posicao" autocomplete="off" list="datalist4" class="form-control"  placeholder="Percentagem da Nota no Ano lectivo" required="" value="<?php echo "$posicao";?>"> 
                    </div> 
                    
                       <input type="submit" value="Cadastrar Nota" name="cadastrarnota" class="btn btn-success" style="float: rigth;">
                

          </form>
        </div>
    </div>
 
 
    


    <div id="myModalmedia" class="modal"  >
        <div class="modal-content">
          <span id="closemedia">&times;</span>
          <form class="user" action="" method="post">
                <h3>Cadastrando Média</h3>

                <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select distinct(titulo) from mediasdoano"); 
                        
                          ?>
                          <span>Título da Média</span>
                      <input type="text" name="titulo" autocomplete="off" list="datalist3" class="form-control"  placeholder="Título para a Média" required="">
                      <datalist id="datalist3">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 
                     
                    <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo'"); 
                        
                          ?>
                          <span>Trimestre</span>
                       <select name="idtrimestre" class="form-control" >
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['idtrimestre']; ?>"><?php echo $exibir['titulo']; ?> </option> 
                        <?php } ?>
                        </select>
      
                    </div> 
                    
                    <div class="form-group">
                            <span>Classe de exame</span>
                              <select name="tipodeturma" required  class="form-control"> 
                                  <option value="Transição">Não</option>
                                  <option value="Exame">Sim</option> 
                              </select> 
                        </div> 
 
                       
                        <div class="form-group"> 
                                <span>Arredondar Média</span>
                                <select name="arredondarmedia" class="form-control" >
                                  <option value="2"  >Arredondar Pra duas casas decimal</option>
                                  <option value="1"  >Arredondar Pra Uma casa decimal</option>
                                  <option value="0" selected="" >Para o Número inteiro mais próximo</option>
                                </select>
                          </div> 

                          <div class="form-group"> 
                                <span>Tipo de Média</span>
                                <select name="tipodemedia" class="form-control" >
                                  <option value="denotas"  >De Notas</option>
                                  <option value="demedias"  >De Médias</option>
                                  <option value="absoluta"   >Absoluta (Recurso)</option>
                                  <option value="ponderada"   >Média Ponderada (%)</option>
                                </select>
                          </div> 


                        <div class="form-group">
                          <?php

                                $posicao=mysqli_num_rows(mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo'"))+1; 
                        
                          ?>
                          <span>Posição da Média no ano Lectivo</span>
                      <input type="number" step="1" min="0" max="61" name="posicao" autocomplete="off" list="datalist4" class="form-control"  placeholder="Percentagem da Média no Ano lectivo" required="" value="<?php echo "$posicao";?>"> 
                    </div> 
                    
                       <input type="submit" value="Cadastrar Média" name="cadastrarmedia" class="btn btn-success" style="float: rigth;">
                

          </form>
        </div>
    </div>
 
 
    


    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="post">
                      <br>
                    <h2>Cadastrando um novo Trimestre</h2>

                     <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select distinct(titulo) from trimestres"); 
                        
                          ?>
                          <span>Título do Trimestre</span>
                      <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control"  placeholder="Título para o trimestre" required="" value="Iº">
                      <datalist id="datalist2">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 


 
 


                     <div class="form-group">
                          <?php

                                $posicao=mysqli_num_rows(mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo'"))+1; 
                        
                          ?>
                          <span>Posição do Trimestre no ano Lectivo</span>
                      <input type="number" step="1" min="0" max="61" name="posicao" autocomplete="off" list="datalist4" class="form-control"  placeholder="Percentagem da Nota no Ano lectivo" required="" value="<?php echo "$posicao";?>"> 
                    </div> 



             

 
                          <br>
                            <input type="submit" name="cadastrar" value="Cadastrar Trimestre"  class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    


    <script>
                     var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes"); 
                    var btnmedia=document.getElementById("myBtnmedia"); 
                  

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");
                    var modalmedia=document.getElementById("myModalmedia");
                    

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");
                    var spanmedia=document.getElementById("closemedia");
                    

                

                  
                    window.onclick =(event)=>{
                        if(event.target == modal || event.target == modalmedia){
                          modal.style.display="none";
                          modalmedia.style.display="none";
                          modalreclamacoes.style.display="none";
                        }
                    }
 

                    

                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })

                                                  
      
                                                  
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                      modalmedia.style.display="none";
                                                  })

                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                      
                      btnmedia.addEventListener("click", ()=>{
                      modalmedia.style.display="block";
                                                  })

                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
              
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                
                    
                  spanmedia.addEventListener("click", ()=>{
                      modalmedia.style.display="none";
                                                  })
                


                    

                  </script>

          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do Ano Lectivo</h6>
                  <div class="dropdown no-arrow">
                     
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">


                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ano Lectivo</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="anolectivo.php?idanolectivo=<?php echo $dadosdoanolectivo["idanolectivo"] ; ?>">Ano Lectivo <?php echo $dadosdoanolectivo["titulo"] ; ?></a></div> <br>

                                             

                                               <br>

                                                </div>

                                              
                                    </div>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Histórico</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                        <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Matrícula' or tipo='Rematrícula'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Confirmação'")); 

  
                                      ?>  <br>
                                           

                                        <br>  Número de Estudantes:  <?php echo $numerodeestudantes; ?> <br> 
                                               Número de Matrículas:  <?php echo $numerodematriculas; ?>  <br> 
                                               Número de Confimações:  <?php echo $numerodereconfirmacoes; ?> <br>


                                        </div>

                            
                                        </div>
                                        </div> 
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>



                 
      </div>
      <!-- End of Main Content --> 

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Modelo de Pauta/Mini Pauta  & Lista de Trimestres</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
 


              <span id="resultado">

                <h2>Notas - Transição</h2>
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>

                  <?php  
                    
                    $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
                    $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' "));

                    $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                            
                    ?>

                    <tr>  
                      <th rowspan="3" align="center">Nome do Estudante</th>
                      <th colspan="<?php echo "$colSpan_dis";  ?>" align="center">Disciplina</th>
                    </tr>
                    <tr>  
                    <?php   

                    $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

                        
                      while($exibir = $lista_de_trimestre->fetch_array()){
                        
                        $idtrimestre=$exibir["idtrimestre"];
                        
                        $vetor_trimestres[]=$idtrimestre;

                        $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
                        $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas'  "));
    
                        $colSpan_tri=$numerodenotas_transicao+$numerodemedias_transicao;
                           
                        
                        
                        ?>

                      <th align="center" colspan="<?php echo "$colSpan_tri";  ?>"><a href="trimestre.php?idtrimestre=<?php echo "$idtrimestre"; ?>"><?php echo $exibir["titulo"]; ?> </a> </th> 
                      <?php } ?>
                    </tr>

                     <tr>  
                     <?php   

                     foreach ($vetor_trimestres as $key => $idtrimestre_v) {
                    
                    $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre_v' order by posicao asc");

                      while($exibir = $lista->fetch_array()){ ?>
  
                      <th align="center"><a href="nota.php?idnota=<?php echo "$exibir[idnotadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                         <?php } ?>

                         <?php   
                    $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                      while($exibir = $lista->fetch_array()){ ?>
  
                      <th align="center"><a href="media.php?idmedia=<?php echo "$exibir[idmediadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                         <?php }
                        
                        } ?>
                    </tr>
                  

                  </thead>
                  <tbody> 
                    <tr>  
                      <td> Estudante 1</td> 

                      <?php for ($i=0; $i < $colSpan_dis; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 2</td> 

                       <?php for ($i=0; $i < $colSpan_dis; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 3</td> 

                       <?php for ($i=0; $i < $colSpan_dis; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                  </tbody>
                </table>

                <h3>Pauta - transição </h3>

                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>

                  <?php  
                    
                    $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
                    $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));

                    $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                            
                    ?>

                    <tr>  
                      <th rowspan="2" align="center">Nome do Estudante</th>
                      <th colspan="<?php echo "$colSpan_dis";  ?>" align="center">Disciplina</th>
                    </tr>
                    

                     <tr>  
                     <?php   

                     foreach ($vetor_trimestres as $key => $idtrimestre_v) {
                      
                    $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v' ");

                      while($exibir = $lista->fetch_array()){ ?>
  
                      <th align="center"><a href="media.php?idmedia=<?php echo "$exibir[idmediadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                         <?php }
                        
                        } ?>
                    </tr>
                  

                  </thead>
                  <tbody> 
                    <tr>  
                      <td> Estudante 1</td> 

                      <?php for ($i=0; $i < $numerodemedias_transicao; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 2</td> 

                       <?php for ($i=0; $i < $numerodemedias_transicao; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 3</td> 

                       <?php for ($i=0; $i < $numerodemedias_transicao; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                  </tbody>
                </table>



                </span> 

                           <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
                  <h6 class="m-0 font-weight-bold text-primary">Legenda - entenda como as médias são feitas</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample2">
                  <div class="card-body">
                  <table class="table table-bordered"  width="100%" cellspacing="0">
                        
                        <tr>

                            <th>Média</th>
                            <th>Descrição</th>
                             

                        </tr>

                        <?php 
                             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='denotas'"); 

                             while($exibir = $lista->fetch_array()){
                               
                               $idmedia=$exibir["idmediadoano"];
                               
                               ?>

                                
                        <tr>
                              <td><?php echo "$exibir[titulo]"; ?></td>
                              <td>
                              
                                      (
                                      <?php 
                                          $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                                          $cont=mysqli_num_rows($lista_de_nota);
                                          $cont_1=0;
                                          while($ver = $lista_de_nota->fetch_array()){
                                            $cont_1++;
                                          
                                              echo "$ver[titulo]";
                                              if($cont_1<$cont){ echo "+";}
                                            } 
                                              
                                              ?>
                                      )/<?php echo "$cont";?> -------- || ------- Arredondar resultado:  (   <?php if($exibir["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($exibir["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($exibir["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )
                              
                              </td>
                        </tr>
                             <?php } ?>


                             <?php 
                             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='demedias'"); 

                             while($exibir = $lista->fetch_array()){
                               
                               $idmedia=$exibir["idmediadoano"];
                               
                               ?>

                                
                        <tr>
                              <td><?php echo "$exibir[titulo]"; ?></td>
                              <td>
                              
                                      (
                                      <?php 
                                          $lista_de_nota= mysqli_query($conexao, "select * from mediasdoano where idmediamaior='$idmedia'"); 

                                          $cont=mysqli_num_rows($lista_de_nota);
                                          $cont_1=0;
                                          while($ver = $lista_de_nota->fetch_array()){
                                            $cont_1++;
                                          
                                              echo "$ver[titulo]";
                                              if($cont_1<$cont){ echo "+";}
                                            } 
                                              
                                              ?>
                                      )/<?php echo "$cont";?> -------- || ------- Arredondar resultado:  (   <?php if($exibir["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($exibir["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($exibir["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )
                              
                              </td>
                        </tr>
                             <?php } ?>


                        </table>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->


<br><br>
                <h2>Notas - Exame</h2>
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>

                  <?php  
                    
                    $numerodenotas_exame=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Exame' "));
                    $numerodemedias_exame=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Exame' "));

                    $colSpan_dis=$numerodenotas_exame+$numerodemedias_exame;
                                            
                    ?>

                    <tr>  
                      <th rowspan="3" align="center">Nome do Estudante</th>
                      <th colspan="<?php echo "$colSpan_dis";  ?>" align="center">Disciplina</th>
                    </tr>
                    <tr>  
                    <?php   

                    $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

                        
                      while($exibir = $lista_de_trimestre->fetch_array()){
                        
                        $idtrimestre=$exibir["idtrimestre"];
                        
                        $vetor_trimestres_exame[]=$idtrimestre;

                        $numerodenotas_exame=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Exame' "));
                        $numerodemedias_exame=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Exame' "))+mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Exame' and tipo='recurso' "));
    
                        $colSpan_tri=$numerodenotas_exame+$numerodemedias_exame;
                           
                        
                        
                        ?>

<th align="center" colspan="<?php echo "$colSpan_tri";  ?>"><a href="trimestre.php?idtrimestre=<?php echo "$idtrimestre"; ?>"><?php echo $exibir["titulo"]; ?> </a> </th> 
                      <?php } ?>
                    </tr>

                     <tr>  
                     <?php   

                      $n_notas=0;
                     foreach ($vetor_trimestres_exame as $key => $idtrimestre_v) {
                    
                    $lista= mysqli_query($conexao, "select * from notasdoano where tipo='normal'  and idanolectivo='$idanolectivo' and  tipodeturma='Exame' and idtrimestre='$idtrimestre_v' order by posicao asc");

                      while($exibir = $lista->fetch_array()){

                            $n_notas++;
                        ?>
  
                       <th align="center"><a href="nota.php?idnota=<?php echo "$exibir[idnotadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                         <?php } ?>

                         <?php   
                    $lista= mysqli_query($conexao, "select * from mediasdoano where tipodemedia='denotas'  and idanolectivo='$idanolectivo' and  tipodeturma='Exame'  and idtrimestre='$idtrimestre_v' ");

                      while($exibir = $lista->fetch_array()){ 
                        
                        $n_notas++;?>
  
                     <th align="center"><a href="media.php?idmedia=<?php echo "$exibir[idmediadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                         <?php }
                        
                        } ?>
                    </tr>
                  

                  </thead>
                  <tbody> 
                    <tr>  
                      <td> Estudante 1</td> 

                      <?php for ($i=0; $i < $n_notas; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 2</td> 

                       <?php for ($i=0; $i < $n_notas; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 3</td> 

                       <?php for ($i=0; $i < $n_notas; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                  </tbody>
                </table>



                        <h3>Pauta - Exame </h3>

                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>

                  

                    <tr>  
                      <th rowspan="2" align="center">Nome do Estudante</th>
                      <th colspan="<?php echo "$numerodemedias_exame";  ?>" align="center">Disciplina</th>
                    </tr>
                    

                     <tr>  
                     <?php   

                     foreach ($vetor_trimestres as $key => $idtrimestre_v) {
                      
                    $lista= mysqli_query($conexao, "select * from mediasdoano where tipodemedia!='denotas'  and idanolectivo='$idanolectivo' and  tipodeturma='Exame'  and idtrimestre='$idtrimestre_v' limit 1 ");

                      while($exibir = $lista->fetch_array()){
                        
                        $id_media_usada=$exibir["idmediadoano"];?>
  
                        
                      <th align="center"><a href="media.php?idmedia=<?php echo "$exibir[idmediadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                         <?php }
                        
                        } ?>

                      <?php   
 
                      $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Exame' and (tipo='exame')  order by posicao desc");

                      while($exibir = $lista->fetch_array()){ ?>

                       <th align="center"><a href="nota.php?idnota=<?php echo "$exibir[idnotadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                          <?php } ?>
                          
                          <?php   

                    foreach ($vetor_trimestres as $key => $idtrimestre_v) {
                    
                    $lista= mysqli_query($conexao, "select * from mediasdoano where tipodemedia!='denotas'  and idanolectivo='$idanolectivo' and  tipodeturma='Exame'  and idtrimestre='$idtrimestre_v' and idmediadoano!='$id_media_usada' order by posicao asc ");

                    while($exibir = $lista->fetch_array()){ ?>

                   <th align="center"><a href="media.php?idmedia=<?php echo "$exibir[idmediadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th>  
                        <?php }
                      
                      } ?>

                <?php   
                
                $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Exame' and tipo='Recurso'  order by posicao desc limit 1");

                while($exibir = $lista->fetch_array()){ ?>

                  <th align="center"><a href="nota.php?idnota=<?php echo "$exibir[idnotadoano]"; ?>"><?php echo $exibir["titulo"]; ?></a></th> 
                    <?php } ?>

                    </tr>
                  

                  </thead>
                  <tbody> 
                    <tr>  
                      <td> Estudante 1</td> 

                      <?php for ($i=0; $i < $numerodemedias_exame; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 2</td> 

                       <?php for ($i=0; $i < $numerodemedias_exame; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                    <tr>  
                      <td> Estudante 3</td> 

                       <?php for ($i=0; $i < $numerodemedias_exame; $i++) { ?>
                        <td></td>
                      <?php } ?>
                     


                    </tr> 

                  </tbody>
                </table>


        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample3">
                  <h6 class="m-0 font-weight-bold text-primary">Legenda - entenda como as médias são feitas</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample3">
                  <div class="card-body">
                  <table class="table table-bordered"  width="100%" cellspacing="0">
                        
                        <tr>

                            <th>Média</th>
                            <th>Descrição</th>
                             

                        </tr>

                        <?php 
                             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='denotas'"); 

                             while($exibir = $lista->fetch_array()){
                               
                               $idmedia=$exibir["idmediadoano"];
                               
                               ?>

                                
                        <tr>
                              <td><?php echo "$exibir[titulo]"; ?></td>
                              <td>
                              
                                      (
                                      <?php 
                                          $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                                          $cont=mysqli_num_rows($lista_de_nota);
                                          $cont_1=0;
                                          while($ver = $lista_de_nota->fetch_array()){
                                            $cont_1++;
                                          
                                              echo "$ver[titulo]";
                                              if($cont_1<$cont){ echo "+";}
                                            } 
                                              
                                              ?>
                                      )/<?php echo "$cont";?> -------- || ------- Arredondar resultado:  (   <?php if($exibir["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($exibir["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($exibir["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )
                              
                              </td>
                        </tr>
                             <?php } ?>


                             <?php 
                             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='demedias'"); 

                             while($exibir = $lista->fetch_array()){
                               
                               $idmedia=$exibir["idmediadoano"];
                               
                               ?>

                                
                        <tr>
                              <td><?php echo "$exibir[titulo]"; ?></td>
                              <td>
                              
                                      (
                                      <?php 
                                          $lista_de_nota= mysqli_query($conexao, "select * from mediasdoano where idmediamaior='$idmedia'"); 

                                          $cont=mysqli_num_rows($lista_de_nota);
                                          $cont_1=0;
                                          while($ver = $lista_de_nota->fetch_array()){
                                            $cont_1++;
                                          
                                              echo "$ver[titulo]";
                                              if($cont_1<$cont){ echo "+";}
                                            } 
                                              
                                              ?>
                                      )/<?php echo "$cont";?> -------- || ------- Arredondar resultado:  (   <?php if($exibir["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($exibir["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($exibir["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )
                              
                              </td>
                        </tr>
                             <?php } ?>


                             <?php 
                             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='ponderada'"); 

                             while($exibir = $lista->fetch_array()){
                               
                               $idmedia=$exibir["idmediadoano"];
                               
                               ?>

                                
                        <tr>
                              <td><?php echo "$exibir[titulo]"; ?></td>
                              <td>
                              
                                      (
                                      <?php 
                                          $lista_de_nota= mysqli_query($conexao, "select * from mediasdoano where idmediamaior='$idmedia'"); 
                                          $lista_de_nota_especial= mysqli_query($conexao, "select * from notasdoano where tipo='exame' and idmediaaquepertence='$idmedia'"); 

                                          $cont=mysqli_num_rows($lista_de_nota)+mysqli_num_rows($lista_de_nota_especial);
                                          $cont_1=0;
                                          while($ver = $lista_de_nota->fetch_array()){
                                            $cont_1++;
                                          
                                              echo "$ver[titulo]*$ver[percentagem]";
                                              if($cont_1<$cont){ echo "+";}
                                            } 

                                           
                                            
                                            
                                            while($ver = $lista_de_nota_especial->fetch_array()){
                                              $cont_1++;
                                            
                                                echo "$ver[titulo]*$ver[percentagem]";
                                                if($cont_1<$cont){ echo "+";}
                                              } 

                                              
                                              ?>
                                      )  -------- || ------- Arredondar resultado:  (   <?php if($exibir["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($exibir["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($exibir["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )
                              
                              </td>
                        </tr>
                             <?php } ?>





                             
                             <?php 
                             $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='absoluto'"); 

                             while($exibir = $lista->fetch_array()){
                               
                               $idmedia=$exibir["idmediadoano"];
                               
                               ?>

                                
                        <tr>
                              <td><?php echo "$exibir[titulo]"; ?></td>
                              <td>
                              
                                       Valor absoluto caso aplicável -------- || ------- Arredondar resultado:  (   <?php if($exibir["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($exibir["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($exibir["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )
                              
                              </td>
                        </tr>
                             <?php } ?>




                        </table>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->


 </div>
<br><br><br>

 




              </div>
           
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
      
      <script>


            $(document).on("click", "#modelodeminipauta", function(event){

                    event.preventDefault(); 

                    var idanolectivo=<?php echo "$idanolectivo"; ?>;

                          $.ajax({
                            url:'cadastro/modelodeminipauta.php',
                            method:'POST',
                            data:{idanolectivo 
                            },
                            success: function(data){
                                $("#resultado").html(data);
                  
                            }

                        })

                     
                   
                })



            $(document).on("click", "#modelodepauta", function(event){

                    event.preventDefault(); 
      

                var idanolectivo=<?php echo "$idanolectivo"; ?>;

                          $.ajax({
                            url:'cadastro/modelodepauta.php',
                            method:'POST',
                            data:{
                                idanolectivo 
                            },
                            success: function(data){
                                $("#resultado").html(data);
                  
                            }

                        })

                     
                   
                })


           


                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idanolectivo=<?php echo $idanolectivo; ?>;
                                                                if(confirm("Tens certeza que queres eliminar esse anolectivo?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deleteanolectivo.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idanolectivo:idanolectivo 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })

            </script>




 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <div id="formularioresposta"></div>
        </div>
    </div>
    
      <script>
                    var btn=document.getElementsByClassName("vernotasdotrimestre");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                    $(document).on("click",  ".vernotasdotrimestre", function(event){
                              event.preventDefault(); 
                              
                              modal.style.display="block"; 
                              var id=$(this).data('id')
                              
                               
                                            $.ajax({
                              url:'cadastro/vernotasdotrimestre.php',
                              method:'POST',
                              data: {
                                id: id  
                            },
                              success:function(data){ 
                                $('#formularioresposta').html(data);  
                              }
                            })

         
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
