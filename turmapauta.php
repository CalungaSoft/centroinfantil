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

 
if(!($painellogado=="administrador" || $painellogado=="areapedagogica" || $painellogado=="professor")){ 

    header('Location: login.php');
}


$idturma=isset($_GET['idturma'])?$_GET['idturma']:"";
     

        include("cabecalho.php") ; ?>

<?php
                                   
                  $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                           $turma=$dadosdaturma["titulo"]; 
                           $idperiodo=$dadosdaturma["idperiodo"];
                           $idcurso=$dadosdaturma["idcurso"];
                           $idsala=$dadosdaturma["idsala"];
                           $idclasse=$dadosdaturma["idclasse"];
                           $idanolectivo=$dadosdaturma["idanolectivo"];

                           $propina=$dadosdaturma["propina"];
                           $matricula=$dadosdaturma["matricula"];
                           $reconfirmacao=$dadosdaturma["reconfirmacao"];
 


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Pauta da Turma</h1>
      <a href="turma.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Ver dados da turma</a> 
       <a href="pdf/pauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" > <i class="fas fa-fw fa-print"></i> Imprimir Pauta</a> 
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

                                               $anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM anoslectivos where idanolectivo='$idanolectivo' "))[0];

                                              ?>


                                                  Ano Lectivo: <strong> <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo; ?> </a><br></strong>

                                                  Curso: <a href="curso.php?idcurso=<?php echo $idcurso; ?>"> <?php echo $curso; ?> </a><br>

                                                 Classe: <a href="classe.php?idclasse=<?php echo $idclasse; ?>"> <?php echo $classe; ?> </a><br>

                                                  Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                                                    Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a><br> <br>








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

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma' and (tipo='Matrícula' or tipo='Rematrícula')")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM matriculaseconfirmacoes where idturma='$idturma' and tipo='Confirmação'")); 

                                           $numerodedisciplinas=mysqli_num_rows(mysqli_query($conexao, "select idturma FROM disciplinas where idturma='$idturma'"));


                                          $numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "select distinct(idprofessor) FROM disciplinas where idturma='$idturma'")); 

                                          $numerodeprofessoresauxiliar=mysqli_num_rows(mysqli_query($conexao, "select distinct(idprofessorauxiliar) FROM disciplinas where idturma='$idturma'")); 
 
  
                                      ?>

                                        <br>  Número de Estudantes: <strong>  <?php echo $numerodeestudantes; ?> <br> </strong>
                                           
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
                  <?php  } ?> 
                   
                   <a href="turmapauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Ver Pauta</a>  <br><br>
                   
                   <br>
                   <a href="pdf/pauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" > <i class="fas fa-fw fa-print"></i> Imprimir Pauta</a> 
        <br><br><br>

                <span id="resultado"> 

                    <?php 


 
$minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

 
$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

      if ($dadosdaturma["eclassedeexame"]!='Sim') {
        
        $minipauta='
        
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>';

            
              $numerodenotas_transicao=0;
              $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'"));

              $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                      
              $minipauta.='

                      
                <tr>  
                  <th rowspan="2" align="center">Nome do Estudante</th>
                  ';

                  $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

                  while($exibir = $lista_de_disciplina->fetch_array()){
                    $iddisciplina=$exibir["iddisciplina"];
                    $minipauta.='
                    
                  <th colspan="'.$colSpan_dis.'" align="center"><a href="disciplina.php?iddisciplina='.$iddisciplina.'">'.$exibir["abreviatura"].'</a></th>
                  ';

                  }

                  $minipauta.='
                  <th rowspan="2" >Classificação</th>
                </tr>
              ';

          
            
              

              $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

                  
                while($exibir = $lista_de_trimestre->fetch_array()){
                  
                  $idtrimestre=$exibir["idtrimestre"];
                  
                  $vetor_trimestres[]=$idtrimestre;

                  
                    }  
                
                $minipauta.='
                

              <tr>  
              ';

              $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

              while($exibir = $lista_de_disciplina->fetch_array()){
                  
              foreach ($vetor_trimestres as $key => $idtrimestre_v) {
              
                      
                      $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  ");

                        while($exibir = $lista->fetch_array()){
                          
                          $minipauta.=' 
                            <th align="center">'.$exibir["titulo"].'</th> 
                          ';
                        }
                          
                  }
                
                }
                  
                  $minipauta.='
              </tr>
            

            </thead>
            <tbody> 
              ';
              $id_ultimo_trimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao desc limit 1 "))[0];
            

                  $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'"); 

                  while($exibir = $lista->fetch_array()){

                    $idaluno=$exibir["idaluno"];

            $minipauta.='
              <tr>  
                <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'">'.$exibir['nomecompleto'].' </a></td>'; 

                    

                          $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
                          $contadordenegativa=0;
                          $numero_de_notas_geral=0;

                          $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

                          while($exibir_disciplinas = $lista_de_disciplina->fetch_array()){
                          
                            $iddisciplina=$exibir_disciplinas["iddisciplina"];
                            $somatorio_geral=0;
                      
                            $somatorio_individual=0;
                          
                            $somador_de_notas_finais=0;

                            $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

                          while($observar = $listadetrimestre->fetch_array()){

                              $idtrimestre=$observar["idtrimestre"];
              
                                $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='denotas'"); 

                                while($visualizar = $lista_de_medias->fetch_array()){

                                  
                                  $idmedia=$visualizar["idmediadoano"];

                                  
                        
                                    $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                                    $somatorio=0;
                                    $numero_de_notas=mysqli_num_rows($lista_de_nota);
                                
                                    while($ver = $lista_de_nota->fetch_array()){
                                      
                                      $idnotadoano=$ver["idnotadoano"];
                                  
                                      $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                                      $somatorio+=$nota;
                                      
                                        
                                  
                                    
                                      } 

                                      $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                                      $idmediamaior=$visualizar["idmediamaior"];

                                      $vetor_media_mediamaior[$idmedia]=$idmediamaior; // vai fazer um par de chaves - [idmedia]=[mediamaiorqueelapertence]
                                      $vetor_media[$idmedia]=$media; //vai guardar as médias

                                      if ($media>=$minimoparapositiva) {
                                        $cor="Blue";
                                    }else{
                                      $cor="red";
                                    }

                                      $minipauta.='  
                                      <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                      $cor='';
                                      $media=0;

                                    
                                            
                        
                              }
                              
                              
                              $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='demedias'"); 

                              while($visualizar = $lista_de_medias->fetch_array()){
                                
                                $idmedia=$visualizar["idmediadoano"];

                                $somatorio=0;
                                $cont_medias=0;
                                  foreach ($vetor_media_mediamaior as $key => $value) {
                                    
                                    if($value==$idmedia){
                                      $cont_medias++;
                                    $somatorio+=$vetor_media[$key];
                                    }

                                  }


                                    $media=round($somatorio/$cont_medias,$visualizar["arredondarmedia"]);
                                    if ($media>=$minimoparapositiva) {
                                      $cor="Blue";
                                    }else{
                                      $cor="red";
                                    }

                                    $minipauta.='  
                                    <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                      
                                      $somatorio=0;
                                      $cor='';
                                  

                                      if (!($media>=$minimoparapositiva)) { //se for negativa
                                  
                                        $contadordenegativa++;
                                        
                                        

                                              if($exibir_disciplinas["tipodedisciplina"]=="Chave"){
                                                $contadordenegativa+=100; //para que reprove direito
                                            
                                            }else { //so tera cadeira se a disciplinao nao for chave
                                              $vetor_cadeiras_deixadas[]=$iddisciplina;
                                              $vetor_nota_da_disciplina[$iddisciplina]=$media;
                                            }
          
                                      
          
                                  }else { // caso a media for positiva, então elimina a cadeira
                                    
                                    
                                    
                                    $Eliminando_caso=mysqli_query($conexao, "DELETE FROM `cadeirasdeixadas` WHERE idaluno='$idaluno' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$iddisciplina' ");
      
                                  } 
                        
                              }  

                            }

                          }

                          $cor_classificacaofinal_final="";


                          if($contadordenegativa<=2){ //se tiver menos de duas negativas
                              
                                if($contadordenegativa==0){ //se não tiver nenhuma negativa entao: Aprova
            
                                $classificacaofinal=$dadosdaturma['classificacaopositiva'];
            
                                  $cor_classificacaofinal_final="Blue";
                                
            
                                }else{ // se tiver 1 ou 2 negativas
              
                                  $classificacaofinal="$dadosdaturma[classificacaopositiva]*";
            
                                    $cor_classificacaofinal_final="Blue";
                                  
                                    foreach ($vetor_cadeiras_deixadas as $key => $disciplina) {
                                        $data_de_hoje=date('Y-m-d');
                                        $valordanota_cadeira=$vetor_nota_da_disciplina[$disciplina];
                                        
                                        $id_cadeira_deixada=mysqli_fetch_array(mysqli_query($conexao, "SELECT idcadeiradeixada from cadeirasdeixadas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and iddisciplina='$disciplina'"))[0];

                                        if($id_cadeira_deixada==0){

                                          $inserindo_cadeiras_em_atraso=mysqli_query($conexao, "INSERT INTO `cadeirasdeixadas` (`idcadeiradeixada`, `idaluno`, `idmatriculaeconfirmacao`, `iddisciplina`, `valordanota`, `data`) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$disciplina', '$valordanota_cadeira', '$data_de_hoje')");
      
                                        }else{

                                          $actualizandoanota=mysqli_query($conexao, "UPDATE `cadeirasdeixadas` SET `valordanota` = '$valordanota_cadeira' WHERE `cadeirasdeixadas`.`idcadeiradeixada` = '$id_cadeira_deixada'");
      
                                        }



                                    }
                                  
              
            
                                }
            
            
                          }else{ //se tiver mais de duas negativas reprova direito
                              $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                              $cor_classificacaofinal_final="red";
                          }
            
            
                            
                          $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idtrimestre='$id_ultimo_trimestre' and tipodeturma='Transição'"); 

                                    $somador_de_notas_finais=0;
                                    
                                    while($ver = $lista_de_nota->fetch_array()){
                                      $idnotadoano=$ver["idnotadoano"];
                                      $somador_de_notas_finais+=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano'  limit 1"))[0];
                                    }

                          if($somador_de_notas_finais==0){ //se não fez nenhuma prova de escola então sai como desistente.
            
                                $classificacaofinal='Desistente';
                                  $cor_classificacaofinal_final="red";
            
                              }
            
                              $vetor_cadeiras_deixadas=[];
                    $minipauta.='
                    <td> <span style="color: '.$cor_classificacaofinal_final.'">'.$classificacaofinal.'</span></td> 
            
              </tr>   '; 
              
              }
            

              $minipauta.='
            </tbody>
          </table>
            
          ';


          echo "$minipauta";
      }else {
        $minipauta='
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>';

      
        $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and (tipo='exame' or tipo='recurso')"));
        $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and (tipodemedia='ponderada' or tipodemedia='demedias')"));

        $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                
        $minipauta.='

        <tr>  
          <th rowspan="2" align="center">Nome do Estudante</th>
          ';

          $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

          while($exibir = $lista_de_disciplina->fetch_array()){
          $iddisciplina=$exibir["iddisciplina"];
            $minipauta.='
            
          <th colspan="'.$colSpan_dis.'" align="center"><a href="disciplina.php?iddisciplina='.$iddisciplina.'">'.$exibir["abreviatura"].'</a></th>
          ';

          }

          $minipauta.='
          <th rowspan="2" >Classificação</th>
        </tr>
        ';

        

        $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

            
          while($exibir = $lista_de_trimestre->fetch_array()){
            
            $idtrimestre=$exibir["idtrimestre"];
            
            $vetor_trimestres[]=$idtrimestre;

            
              } 
          
          $minipauta.='
          

        <tr>  
        ';

        $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

        while($exibir = $lista_de_disciplina->fetch_array()){ 

        foreach ($vetor_trimestres as $key => $idtrimestre_v) {
        
                
                $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='demedias' and percentagem!=0 and idtrimestre='$idtrimestre_v'  ");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                      <th align="center">'.$exibir["titulo"].'</th> 
                    ';
                  }

                  $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='exame' and idtrimestre='$idtrimestre_v'  ");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                      <th align="center">'.$exibir["titulo"].'</th> 
                    ';
                  }

                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='ponderada' and idtrimestre='$idtrimestre_v'  ");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                      <th align="center">'.$exibir["titulo"].'</th> 
                    ';
                  }


                  $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                      <th align="center">'.$exibir["titulo"].'</th> 
                    ';
                    }
                    
            }

          }
            
            $minipauta.='
        </tr>


      </thead>
      <tbody> 
        ';

            $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'"); 

            while($exibir = $lista->fetch_array()){

          

      $minipauta.='
        <tr>  
          <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'">'.$exibir['nomecompleto'].' </a></td>'; 

              

                    $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                    $contadordenegativa=0;
                  
                    $somador_de_nota_do_recurso_e_ponderada=0;
                    $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

                    while($exibir_disciplinas = $lista_de_disciplina->fetch_array()){
                    
                      $somatorio_geral=0;
                      $numero_de_notas_geral=0;
                      $somatorio_individual=0;
                    
                      
                      
                      $iddisciplina=$exibir_disciplinas["iddisciplina"];

                      $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao desc limit 1 ");
                      while($observar = $listadetrimestre->fetch_array()){

                        $idtrimestre_v=$observar["idtrimestre"];

                        //buscando media das médias dos trimestre
                        $listademeiamaior=mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='demedias' and percentagem!=0 and idtrimestre='$idtrimestre_v'  ");

                        
                      
                        
                        while($enxergar = $listademeiamaior->fetch_array()){
                          
                          $idmediamaior=$enxergar["idmediadoano"];

                          $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='denotas' and idmediamaior='$idmediamaior'"); 

                            //buscando as medias dos trimestre
                          while($visualizar = $lista_de_medias->fetch_array()){

                            
                            $idmedia=$visualizar["idmediadoano"];

                        
                  
                              $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                              $somatorio=0;
                              
                              $numero_de_notas=mysqli_num_rows($lista_de_nota);

                              //buscando as notas de cada média

                              
                              while($ver = $lista_de_nota->fetch_array()){
                                
                                $idnotadoano=$ver["idnotadoano"];
                                
                              
                                $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                            
                                $somatorio_individual+=$nota;
                                $numero_de_notas_geral++;
                                
                                  
                            
                              
                                } 

                              
                                
                              
                              

                                      
                  
                            }
                              
                            $media_geral=round($somatorio_individual/$numero_de_notas_geral,$enxergar["arredondarmedia"]);
                            if ($media_geral>=$minimoparapositiva) {
                                  $cor="Blue";
                              }else{
                                $cor="red";
                              }

                                $valor_da_media=$media_geral; //media das medias do trimestre
                                $percentagem_media=$enxergar["percentagem"];

                                $minipauta.='  
                                <th align="center" style="color: '.$cor.'" >'.$media_geral.'  </th>'; 
                                $somatorio_individual=0;
                                $cor='';
                        }
                        



                        //nota da prova final
                        $notada_prova= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='exame' and idtrimestre='$idtrimestre_v'  ");

                        $notas_da_prova=0;
                    

                        while($visualizar = $notada_prova->fetch_array()){
                          
                          $idnotadoano=$visualizar["idnotadoano"];

                          $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];

                            
                              if ($nota>=$minimoparapositiva) {
                                $cor="Blue";
                              }else{
                                $cor="red";
                              }

                              $notas_da_prova+=$nota*$visualizar["percentagem"];
                              $minipauta.='  
                              <th align="center" style="color: '.$cor.'" >'.$nota.' </th>'; 
                                $cor='';

                                    
                  
                        }  


                        //media Ponderada

                        $arredondar_ponderada=mysqli_fetch_array(mysqli_query($conexao, "select arredondarmedia from mediasdoano where idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='ponderada'"))[0]; 


                          $nota_ponderada=round(($percentagem_media*$valor_da_media)+$notas_da_prova,$arredondar_ponderada);
                              if ($nota_ponderada>=$minimoparapositiva) {
                                $cor="Blue";
                            }else{




                              $cor="red";
                            }

                              $minipauta.='  
                              <th align="center" style="color: '.$cor.'" >'.$nota_ponderada.'  </th>'; 
                              $cor='';



                        

                            //nota do recurso
                            $notada_prova= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");

                            while($visualizar = $notada_prova->fetch_array()){
                              
                              $idnotadoano=$visualizar["idnotadoano"];
        
                              $nota_do_recurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
        
                                
                                  if ($nota_do_recurso>=$minimoparapositiva) {
                                    $cor="Blue";

                                    $recurso_lhe_aprovou=true;

                                }else{
                                  $cor="red";

                                  $recurso_lhe_aprovou=false;
                                }
        
                                  $minipauta.='  
                                  <th align="center" style="color: '.$cor.'" >'.$nota_do_recurso.' </th>'; 
                                  $cor='';
        
                                        
                                }

                                $somador_de_nota_do_recurso_e_ponderada+=$nota_do_recurso+$nota_ponderada;
                              
                            if (!($nota_ponderada>=$minimoparapositiva)) { //se for negativa
                                

                                  if(!$recurso_lhe_aprovou){ //se o recurso não lhe aprovou
                                    $contadordenegativa++;

                                    if($exibir_disciplinas["tipodedisciplina"]=="Chave"){
                                      $contadordenegativa+=100; //para que reprove direito
                                  
                                  }
      
                                  }

                              } 
        
                              


                    }

                    

                    }


                    $cor_classificacaofinal_final="";


                    if($contadordenegativa<=2){ //se tiver menos de duas negativas
                      
                        if($contadordenegativa==0){ //se não tiver nenhuma negativa entao: Aprova

                          $classificacaofinal=$dadosdaturma['classificacaopositiva'];

                          $cor_classificacaofinal_final="Blue";
                        

                        }else{ // se tiver alguma negativa

                          if($dadosdaturma["eclassedeexame"]=='Sim'){  //verifica se é classe de exame se for: então vai ao recurso nessas disciplinas

                            $classificacaofinal='Recurso';
                            $cor_classificacaofinal_final="red";


                          }else{ // Se não for uma classe de exame deve deixar essas disciplinas, ou seja, fica com cadeiras em atraso

                            $classificacaofinal="$dadosdaturma[classificacaopositiva]*";

                            $cor_classificacaofinal_final="Blue";
                            


                          }

                        }


                    }else{ //se tiver mais de duas negativas reprova direito
                      $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                        $cor_classificacaofinal_final="red";
                    }


                    
                  
                    if($somador_de_nota_do_recurso_e_ponderada==0){ //se não fez nenhuma prova de escola então sai como desistente.

                          $classificacaofinal='Desistente';
                          $cor_classificacaofinal_final="red";

                      }


              $minipauta.='
              <td> <span style="color: '.$cor_classificacaofinal_final.'">'.$classificacaofinal.'</span></td> 

        </tr>   '; }
        $minipauta.='
      </tbody>
      </table>
      
      ';


          echo "$minipauta";
      }


     
                    ?>

                </span>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
      <!-- End of Main Content -->
       
            <script>
                                                         
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



            <div class="alert alert-info"> <h2>Critério de Classificação Final</h2> <br>

                <strong>APROVADO</strong>: todo aluno que não tiver <strong>nenhuma negativa</strong>.<br><br>

                <strong>APROVADO</strong>: todo aluno com <strong>uma ou duas negativas</strong> (Desde que essas negativas <strong>não sejam em disciplinas chaves</strong>) <br>se for de uma <strong>classe de exame</strong>, então <strong>VAI A RECURSO</strong>, se <strong>não for classe de exame</strong>, automaticamente <strong>DEIXA A DISCIPLINA EM ATRASO</strong><br><br>

                <strong>REPROVADO</strong>: Todo aluno com  <strong>negativa em pelo menos uma disciplina chave</strong>:  <br><br>
                <strong>REPROVADO</strong>: Todo aluno com <strong>mais de 2 disciplinas com negativa</strong> na media final:  <br><br>

                NOTA BEM: o (*) no final de uma classificação, indica de que o aluno deixou disciplinas em atraso



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

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
