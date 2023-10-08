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

 


$idturma=isset($_GET['idturma'])?$_GET['idturma']:"";
    

if(isset($_POST['editardadosdaturma'])){

      $titulo=mysqli_escape_string($conexao,$_POST['titulo']); 
      $idperiodo=mysqli_escape_string($conexao,$_POST['idperiodo']); 
      $idcurso=mysqli_escape_string($conexao,$_POST['idcurso']);
      $idsala=mysqli_escape_string($conexao,$_POST['idsala']);
      $idclasse=mysqli_escape_string($conexao,$_POST['idclasse']);
      $idciclo=mysqli_escape_string($conexao,$_POST['idciclo']);
      $matricula=mysqli_escape_string($conexao,$_POST['matricula']);
      $reconfirmacao=mysqli_escape_string($conexao,$_POST['reconfirmacao']);
      $propina=mysqli_escape_string($conexao,$_POST['propina']);
      $eclassedeexame=mysqli_escape_string($conexao,$_POST['eclassedeexame']);
      $classificacaopositiva=mysqli_escape_string($conexao,$_POST['classificacaopositiva']);
      $classificacaonegativa=mysqli_escape_string($conexao,$_POST['classificacaonegativa']);

       $minimoparapositiva=mysqli_escape_string($conexao,$_POST['minimoparapositiva']);
      $valorminimo=mysqli_escape_string($conexao,$_POST['valorminimo']);
      $valormaximo=mysqli_escape_string($conexao,$_POST['valormaximo']);

      $idcoordenador=mysqli_escape_string($conexao,$_POST['idcoordenador']);
       
       
  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM turmas where titulo='$titulo' and idturma!='$idturma'"))==0){ 

    $classificacoes=mysqli_fetch_array(mysqli_query($conexao," SELECT classificacaonegativa, classificacaopositiva FROM turmas where idturma='$idturma'"));
 
    $salvar= mysqli_query($conexao,"UPDATE `turmas` SET `titulo` = '$titulo', `idperiodo` = '$idperiodo', `idcurso` = '$idcurso', `idsala` = '$idsala', `idclasse` = '$idclasse',`idciclo` = '$idciclo', `propina` = '$propina', `reconfirmacao` = '$reconfirmacao', `matricula` = '$matricula', `eclassedeexame` = '$eclassedeexame', `classificacaopositiva` = '$classificacaopositiva', `classificacaonegativa` = '$classificacaonegativa' , `minimoparapositiva` = '$minimoparapositiva' , `valormaximo` = '$valormaximo' , `valorminimo` = '$valorminimo', `idcoordenador` = '$idcoordenador' WHERE `turmas`.`idturma` = '$idturma'");




                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                            


    
      $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `turma` = '$titulo',`curso` = '$curso',`sala` = '$sala',`periodo` = '$periodo',`classe` = '$classe'  WHERE idturma = '$idturma'");


      $classificacaopositiva_antiga=$classificacoes["classificacaopositiva"];
      $classificacaonegativa_antiga=$classificacoes["classificacaonegativa"];

      if($classificacaopositiva!=$classificacaopositiva_antiga){

           $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `classificacaofinal` = '$classificacaopositiva' WHERE idturma = '$idturma' and classificacaofinal='$classificacaopositiva_antiga'");

      }
   
      if($classificacaonegativa!=$classificacaonegativa_antiga){

                 $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `classificacaofinal` = '$classificacaonegativa'  WHERE idturma = '$idturma' and classificacaofinal='$classificacaonegativa_antiga'");
      
      }
      


    
    if($salvar){
      $acertos[]="Alterações salvas com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outra turma com esse Nome";
   }


  }

        include("cabecalho.php") ; ?>

<?php
                                   
                  $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                           $turma=$dadosdaturma["titulo"]; 
                           $idperiodo=$dadosdaturma["idperiodo"];
                           $idcurso=$dadosdaturma["idcurso"];
                           $idsala=$dadosdaturma["idsala"];
                           $idclasse=$dadosdaturma["idclasse"];
                           $idanolectivo=$dadosdaturma["idanolectivo"];
                           $idciclo=$dadosdaturma["idciclo"];

                           $propina=$dadosdaturma["propina"];
                           $matricula=$dadosdaturma["matricula"];
                           $reconfirmacao=$dadosdaturma["reconfirmacao"];
 


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                            $ciclo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from ciclos where idciclo='$idciclo'"))[0];

                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados da Turma</h1>
      <a href="pdf/pdflistadaturma.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir Lista da Turma</a>  <br><br>
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



          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados da turma</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">turma</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="turma.php?idturma=<?php echo $dadosdaturma["idturma"] ; ?>">Turma: <?php echo $dadosdaturma["titulo"] ; ?></a></div> <br>

                                            <?php

                                            $idanolectivo=$dadosdaturma["idanolectivo"];
                                             $idcoordenador=$dadosdaturma["idcoordenador"];

                                               $anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM anoslectivos where idanolectivo='$idanolectivo' "))[0];

                                               $nomedocoordenador=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedofuncionario FROM funcionarios where idfuncionario='$idcoordenador' "))[0];



                                              ?>


                                                  Ano Lectivo: <strong> <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo; ?> </a><br></strong>
                                                  Curso: <strong> <a href="curso.php?idcurso=<?php echo $idcurso; ?>"> <?php echo $curso; ?> </a><br></strong>

                                                 Classe: <strong> <a href="classe.php?idclasse=<?php echo $idclasse; ?>"> <?php echo $classe; ?> </a><br></strong>

                                                  Período: <strong> <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br></strong>

                                                    Sala: <strong> <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a><br></strong> 

                                                   Ciclo: <strong> <a href="ciclo.php?idciclo=<?php echo $idciclo; ?>"> <?php echo $ciclo; ?> </a><br></strong> 

                                                 É uma classe de exame?: <strong> <?php echo $dadosdaturma["eclassedeexame"]; ?> </strong>   <br> 


                                                 Classificação Positiva: <strong> <?php echo $dadosdaturma["classificacaopositiva"]; ?> </strong>   <br> 


                                                 Classificação Negativa: <strong> <?php echo $dadosdaturma["classificacaonegativa"]; ?> </strong>   <br> 

                                                  Nota mínima: <strong> <?php echo $dadosdaturma["valorminimo"]; ?> </strong>   <br> 
                                                   Mínimo para Positiva: <strong> <?php echo $dadosdaturma["minimoparapositiva"]; ?> </strong>   <br> 
                                                    Nota Máxima: <strong> <?php echo $dadosdaturma["valormaximo"]; ?> </strong>   <br> 


                                                       Coordenador de Turma: <strong> <?php echo $nomedocoordenador; ?> </strong>   <br> 




                                                <br>








                                                </div> 

                                                  <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" || $painellogado=="areapedagogica"){ ?>

                                              <!-- Collapsable Card Example -->
                                              <div class="card shadow mb-6">
                                              <!-- Card Header - Accordion -->
                                              <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Editar Informações</h6>
                                              </a>
                                              <!-- Card Content - Collapse -->
                                              <div class="collapse in" id="collapseCardExample">
                                                <div class="card-body">
                                                <form action="" method="post" class="user">
                                                      
                                                    <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select * from turmas"); 
                        
                          ?>
                      <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control"  placeholder="Título para a turma" required="" value="<?php echo $dadosdaturma["titulo"]; ?>">
                      <datalist id="datalist2">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 

                      <div class="form-group row">
                     
                        <div class="col-sm-4"> 
                                <span>Período</span>
                                  <select name="idperiodo"  required  class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from periodos order by titulo desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option <?php if($dadosdaturma["idperiodo"]==$exibir["idperiodo"]){ echo "selected";} ?> value="<?php echo $exibir["idperiodo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                        </div> 

                       <div class="col-sm-8">  
                                  <span>Curso</span>
                                    <select name="idcurso" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT * from cursos order by titulo desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option <?php if($dadosdaturma["idcurso"]==$exibir["idcurso"]){ echo "selected";} ?> value="<?php echo $exibir["idcurso"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                        <?php } ?> 
                                    </select> 
                        </div>

                    </div>



                     
                     <div class="form-group row">
                       
                           <div class="col-sm-3"> 
                             <span>Sala</span>
                              <select name="idsala" required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT * from salas order by titulo desc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option <?php if($dadosdaturma["idsala"]==$exibir["idsala"]){ echo "selected";} ?> value="<?php echo $exibir["idsala"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                  <?php } ?> 
                              </select> 
                        </div> 
                        <div class="col-sm-4"> 
                               <span>Classe</span>
                                  <select  name="idclasse" required  class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from classes order by titulo desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option <?php if($dadosdaturma["idclasse"]==$exibir["idclasse"]){ echo "selected";} ?> value="<?php echo $exibir["idclasse"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                        </div> 

                         <div class="col-sm-5"> 
                            <span>Classe de exame</span>
                              <select name="eclassedeexame" required  class="form-control"> 
                                  <option <?php if($dadosdaturma["eclassedeexame"]=="Não"){ echo "selected";} ?> value="Não">Não</option>
                                  <option <?php if($dadosdaturma["eclassedeexame"]=="Sim"){ echo "selected";} ?>  value="Sim">Sim</option> 
                              </select> 
                        </div> 

                    </div>


                   
                      <div class="form-group">
                         <span>Cíclo</span>
                                  <select name="idciclod" disabled="" required  class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from ciclos order by titulo desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option <?php if($dadosdaturma["idciclo"]==$exibir["idciclo"]){ echo "selected";} ?> value="<?php echo $exibir["idciclo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                      </div>

                      <input type="hidden" name="idciclo" value="<?php echo $dadosdaturma["idciclo"]; ?>">

                  <div class="form-group">
                  <span>Preço da Matrícula</span>
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(matricula) from turmas"); 
                        
                          ?>
                      <input type="number" name="matricula" min="0" autocomplete="off" list="listamatricula" class="form-control"  placeholder="Preço da Matrícula" required="" value="<?php echo $dadosdaturma["matricula"]; ?>">
                      <datalist id="listamatricula">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['matricula']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 

                    <div class="form-group">
                    <span>Preço da Confirmação</span>
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(reconfirmacao) from turmas"); 
                        
                          ?>
                      <input type="number" name="reconfirmacao" min="0" autocomplete="off" list="listareconfirmacao" class="form-control"  placeholder="Preço da Confirmação" required="" value="<?php echo $dadosdaturma["reconfirmacao"]; ?>">
                      <datalist id="listareconfirmacao">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['reconfirmacao']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 


                       <div class="form-group">
                        <span>Propina</span>
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(propina) from turmas"); 
                        
                          ?>
                      <input type="number" name="propina" min="0" autocomplete="off" list="listapropina" class="form-control"  placeholder="Preço da Propina" required="" value="<?php echo $dadosdaturma["propina"]; ?>">
                      <datalist id="listapropina">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['propina']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 


                      <div class="form-group row">
                        <div class="col-sm-6">  
                                  <span>Classificação Positiva</span>

                                    <input type="text" name="classificacaopositiva"  list="clap" class="form-control"  placeholder="Classificação Positiva" required="" value="<?php echo $dadosdaturma["classificacaopositiva"]; ?>">

                                      <datalist id="clap"> 
                                         <option value="Apto"> 
                                         <option value="Transita"> 
                                    </datalist>
                        </div>
                        <div class="col-sm-6"> 
                                <span>Classificação Negativa</span>
                                
                                    <input type="text" name="classificacaonegativa"  list="clan" class="form-control"  placeholder="Classificação Negativa" required="" value="<?php echo $dadosdaturma["classificacaonegativa"]; ?>" >

                                      <datalist id="clan"> 
                                         <option value="N/ Apto"> 
                                         <option value="N/ Transita"> 
                                    </datalist>
                        </div>  
                    </div>

                    <span> «««««««««« Notas dos Alunos »»»»»»»»»»»</span>
                    <div class="form-group row">
                     <div class="col-sm-4"> 
                                <span>Valor mínimo da Nota</span>
                                
                                    <input type="number" name="valorminimo" max="20" min="0" list="clan1" class="form-control"  placeholder="Valor mínimo" required="" value="<?php echo $dadosdaturma["valorminimo"]; ?>">

                                       
                        </div> 
                         <div class="col-sm-4"> 
                                <span>Mínimo Para Positiva</span>
                                
                                    <input type="number" name="minimoparapositiva" max="20" min="0" list="clan1" class="form-control"  placeholder="Nota mínima para Positiva" required="" value="<?php echo $dadosdaturma["minimoparapositiva"]; ?>">

                                       
                        </div> 
                        <div class="col-sm-4">  
                                  <span>Valor máximo da Nota</span>

                                    <input type="number" name="valormaximo" max="20" min="0" class="form-control"  placeholder="Valor máximo" required="" value="<?php echo $dadosdaturma["valormaximo"]; ?>"> 
                        </div> 
                    </div>

                     

                <div class="form-group">
                         <span>Coordenador de Turma</span>
                                  <select name="idcoordenador"    class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from funcionarios");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option <?php if($dadosdaturma["idcoordenador"]==$exibir["idfuncionario"]){ echo "selected";} ?> value="<?php echo $exibir["idfuncionario"]; ?>"><?php echo $exibir["nomedofuncionario"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                      </div>
                                                      

                                                      <div class="form-group">
                                                          <input type="submit" name="editardadosdaturma" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                                                      </div> 
                                  
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- Collapsable Card Example -->

                                          <?php } ?>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outros Dados</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma' and tipo='Matrícula'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma' and tipo='Confirmação'")); 

                                           $numerodedisciplinas=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM disciplinas where idturma='$idturma'"));


                                          $numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "select distinct(idprofessor) FROM disciplinas where idturma='$idturma'")); 

                                          $numerodeprofessoresauxiliar=mysqli_num_rows(mysqli_query($conexao, "select distinct(idprofessorauxiliar) FROM disciplinas where idturma='$idturma'")); 

                                          $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where idturma='$idturma'"))[0]+0;

                                          $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(divida) FROM entradas where idturma='$idturma'"))[0]+0;

                                          $valoragregado=number_format($valoragregado,2,",", ".");
                                          $valoremdivida=number_format($valoremdivida,2,",", ".");

                                          $precodapropina=number_format($dadosdaturma["propina"],2,",", ".");
                                          $precodamatricula=number_format($dadosdaturma["matricula"],2,",", ".");
                                          $precodareconfirmacao=number_format($dadosdaturma["reconfirmacao"],2,",", ".");
  
                                      ?>

                                        <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" ){ ?>

                                       Preço da Propina: <strong> <?php echo $precodapropina; ?> </strong>   <br> 


                                       Preço da Matrícula: <strong> <?php echo $precodamatricula; ?> </strong>   <br> 


                                       Preço da Confirmação: <strong> <?php echo $precodareconfirmacao; ?> </strong>   <br> 
                                        
                                           Valor Agregado: <strong>  <?php echo $valoragregado; ?> Kz<br></strong>
                                           Valor em Dívida: <strong>  <?php echo $valoremdivida; ?> Kz<br>  </strong>

                                      <?php } ?>

                                        <br>  Número de Estudantes: <strong>  <?php echo $numerodeestudantes; ?> <br> </strong>
                                               Número de Matrículas: <strong>  <?php echo $numerodematriculas; ?>  <br> </strong>
                                               Número de Confimações: <strong>  <?php echo $numerodereconfirmacoes; ?> <br></strong>

                                             Número de Disciplina: <strong>  <?php echo $numerodedisciplinas; ?> <br>  </strong>

                                              Número de Professores efectivos: <strong>  <?php echo $numerodeprofessores; ?> <br></strong>

                                              Número de Professores Auxiliares: <strong>  <?php echo $numerodeprofessoresauxiliar; ?> <br> </strong>

                                         
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
              <h6 class="m-0 font-weight-bold text-primary">Lista de Estudantes desta turma</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                   
                   
                    
                <a href="turma.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-user"></i> Ver Lista de Aluno</a> 
                  
                    <a href="" id="verdisciplina" class="d-sm-inline-block btn btn-sm btn-secondary" ><i class="fas fa-fw fa-book"></i> Ver Disciplinas e Professores </a> 
  
      <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>

                  <a href="turmafinanca.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-money"></i> Ver Finanças</a>  
         <?php } ?>

           <?php if($painellogado=="administrador" || $painellogado=="areapedagogica" || $painellogado=="professor"){ ?>

                   <a href="turmaminipauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-print"></i> Ver Minipauta</a>
                   <a href="turmapauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Ver Pauta</a>  <br><br>
          <?php } ?>


              <span id="resultado"> 

              <h2>Lista de Alunos</h2>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Nome Completo</th>
                      <th>Tipo</th>   
                      <th>Status</th>
                      <th>Data</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'"); 

                         while($exibir = $lista->fetch_array()){
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 

                      <td><?php echo $exibir['tipo']; ?></td>   
                      <td><?php echo $exibir['estatus']; ?></td>
                      <td><?php echo $exibir['data']; ?></td> 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>
                </span>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
      <!-- End of Main Content -->
        <br><br><br>
      <span id="mensagemdealertadeeliminacao"></span> 
                    <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
                  <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar essa turma</span></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse in" id="collapseCardExample2">
                  <div class="card-body" style="color: red">
                                 Essa Opção serve para ELIMINAR TODOS OS DADOS DESSA turma NO SISTEMA <br> a turma  será eliminada
                                 
                                <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" || $painellogado=="areapedagogica"){ ?>
                                 <div class="form-group"><br>
                                     <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá eliminar todos os dados dessa turma, ou seja, essa turma deixará de existir">Eliminar Essa turma</a>
                                  </div> 
                                 <?php } else{ echo "<br>Você não tem permissão de eliminar uma turma do sistema, contacte o administrador!"; }?>
                  </div>
                </div>
              </div>
            <!-- Collapsable Card Example -->
              
            <script>
                                                            $(document).on("click", "#primeirapergunta", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idturma=<?php echo $idturma; ?>;
                                                                if(confirm("Tens certeza que queres eliminar essa turma?")){
                                                              
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/deleteturma.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idturma:idturma 
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertadeeliminacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })


                                                             $(document).on("click", "#verdisciplina", function(event){
                                                                event.preventDefault(); 
                                                               
                                                                var idturma=<?php echo $idturma; ?>;
                                                                
                                                                    
                                                                    $.ajax({
                                                                    url:'cadastro/listadedisciplinasdaturma.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        idturma:idturma 
                                                                    },
                                                                    success: function(data){
                                                                        $("#resultado").html(data);
                                                          
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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
