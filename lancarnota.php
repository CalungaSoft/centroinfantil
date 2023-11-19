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

 


$iddisciplina=isset($_GET['iddisciplina'])?$_GET['iddisciplina']:"";

    $dadosdadisciplina= mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1")); 


 if(!(($dadosdadisciplina["idprofessor"]==$idlogado || $dadosdadisciplina["idprofessorauxiliar"]==$idlogado ) || $painellogado=="areapedagogica" || $painellogado=="administrador")){
   header('Location: login.php');
}



  if(isset($_GET['del'])){
      
      $iddanota=mysqli_escape_string($conexao, trim($_GET['id']));  
      
      if(isset($_GET['id']) || $_GET['id']>0){





         $dadosdanota_sendoeliminad=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM notas where idnota='$iddanota' limit 1"));

         $idmatriculaeconfirmacao=$dadosdanota_sendoeliminad["idmatriculaeconfirmacao"];
         $iddisciplina_eliminada=$dadosdanota_sendoeliminad["iddisciplina"];
         $valordanota=$dadosdanota_sendoeliminad["valordanota"];

         $dadosdadisciplina_sendoeliminada=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo, idprofessor, idprofessorauxiliar FROM disciplinas where iddisciplina='$iddisciplina_eliminada'"));

         $nomedadisciplina_s_eliminada=$dadosdadisciplina_sendoeliminada["titulo"];
         $idprofessor_eliminada=$dadosdadisciplina_sendoeliminada["idprofessor"];
         $idprofessorauxiliar_elimanda=$dadosdadisciplina_sendoeliminada["idprofessorauxiliar"];



         if($idlogado==$idprofessor_eliminada || $idlogado==$idprofessorauxiliar_elimanda || $painellogado=='areapedagogica' || $painellogado=='administrador'){


               $idaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT idaluno FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"))[0];


             

              $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];
 


                      $antigo="Foi eliminada a nota do aluno <a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a> da disciplina de $nomedadisciplina_s_eliminada |Valor da Nota: $valordanota ";
                     $novo="Eliminada";

                      $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)"); 

                     $salvar=mysqli_query($conexao,"DELETE FROM `notas` WHERE idnota='$iddanota'");

                if($salvar){
                  $acertos[]="Nota do Aluno Eliminada com Sucesso!";
                }else{
                  $erros[]="ocorreu algum erro!";
                } 

         }else{

          $erros[]="Você não tem permissão de eliminar essa nota!";

         }

        
  }else{
 $erros[]="Nenhuma Nota selecionada";
  }

}
 

        include("cabecalho.php") ; ?>

<?php
                                   
                  
                  $idprofessor=$dadosdadisciplina["idprofessor"];
                  $idprofessorauxiliar=$dadosdadisciplina["idprofessorauxiliar"];
                  $idanolectivo=$dadosdadisciplina["idanolectivo"];
 
                           $professor=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessor' limit 1"))[0];

                           $professorauxiliar=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar' limit 1"))[0];

                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Lançando Notas no Sistema | Minipauta</h1>
     
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
    <button id="myBtn" class="btn btn-primary">Lançar Outro tipo de Nota</button>
<br><br>
    

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
           
           <h2>Qual tipo de Nota Você quer lançar?</h2>

              
               <a href="lancarnotaavaliacao.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Avaliação contínua</a> <br>

              
               <span id="escolheu"   class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Minipauta</span> <br>

              <a href="lancarnotapauta.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Pauta</a> 

        </div>
    </div>
 
                <script>
                    var btn=document.getElementById("myBtn");
                    
                    var modal=document.getElementById("myModal");
                    
                    var span=document.getElementById("close"); 
                     var escolheu=document.getElementById("escolheu");

                          modal.style.display="block";
                    
                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })

                     escolheu.addEventListener("click", ()=>{
 
                      modal.style.display="none";
                                                  })

                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }

                    
                  </script>


          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados da disciplina</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">disciplina</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="disciplina.php?iddisciplina=<?php echo $dadosdadisciplina["iddisciplina"] ; ?>"><?php echo $dadosdadisciplina["titulo"] ; ?></a></div> <br>

                                            Abreviatura: <strong> <?php echo $dadosdadisciplina["abreviatura"]; ?> </strong> <br>

                                            Tipo de Disciplina: <strong> <?php echo $dadosdadisciplina["tipodedisciplina"]; ?> </strong> <br>

                                            Agrupamento: <strong> <?php echo $dadosdadisciplina["agrupamento"]; ?> </strong> <br>

                                            Observações: <strong> <?php echo $dadosdadisciplina["obs"]; ?> </strong> <br><br><br>

                                        

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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dados Lectivo</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1">  <br>
                                        
   

                                            <?php
 
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo'"));

                                             $idanolectivo=$anolectivo["idanolectivo"];
 

                                                    $idturma=$dadosdadisciplina["idturma"];
                                           $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                                               $turma=$dadosdaturma["titulo"]; 
                                               $idperiodo=$dadosdaturma["idperiodo"];
                                               $idcurso=$dadosdaturma["idcurso"];
                                               $idsala=$dadosdaturma["idsala"];
                                               $idclasse=$dadosdaturma["idclasse"];
                                              
                                               $minimoparapositiva=$dadosdaturma["minimoparapositiva"];
                                              


                                               $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                                                $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                                                $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                                                $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                                                ?>

                                                 Ano Lectivo: <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo["titulo"]; ?> </a><br>
                                                   
                                                  Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a><br>

                                                  Curso: <a href="curso.php?idcurso=<?php echo $idcurso; ?>"> <?php echo $curso; ?> </a><br>

                                                 Classe: <a href="classe.php?idclasse=<?php echo $idclasse; ?>"> <?php echo $classe; ?> </a><br>

                                                  Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                                                    Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a>
                                                      <br><br>


                                                    Porfessor: <strong> <a href="idfuncionario.php?idfuncionario=<?php echo $idprofessor; ?>"><?php echo $professor; ?></a>  </strong> <br>

                                             Porfessor Auxiliar: <strong> <a href="idfuncionario.php?idfuncionario=<?php echo $idprofessorauxiliar; ?>"><?php echo $professorauxiliar; ?></a>  </strong> <br>
 
 
                                          
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
              <h6 class="m-0 font-weight-bold text-primary">Mini Pauta  | <a href="turmapauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" >Ver Pauta</a></h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
             
       <?php 
            if(isset($_GET['eliminar'])){ ?>

              <a href="lancarnotapauta.php?iddisciplina=<?php echo $iddisciplina; ?>&eliminar=cadeira" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Pauta</a> <br><br>

                   
                        
                         <?php  echo '<div class="alert alert-info">Depois de Alterar a nota do aluno que quer eliminar a cadeira, <a href="turmapauta.php?idturma='.$idturma.  '">Clique aqui para o sistema verificar se o aluno pode ou não elimnar a cadeira</a></div>';
                         
              }else{?>

                        <a href="lancarnotapauta.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Pauta</a> <br><br>
                   

                    <?php  };
            ?> 
           

              <span id="mensagemdealerta"></span>
              <span id="resultado">

<?php 
if ($dadosdaturma["eclassedeexame"]!='Sim') {
  
   $minipauta='
   
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>';

       
        $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
        $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' "));

        $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                
        $minipauta.='

        <tr>  
          <th rowspan="3" align="center">Nome do Estudante</th>
          <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
        </tr>
        <tr>  ';

    

        $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

            
          while($exibir = $lista_de_trimestre->fetch_array()){
            
            $idtrimestre=$exibir["idtrimestre"];
            
            $vetor_trimestres[]=$idtrimestre;

            $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
            $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas'  "));

            $colSpan_tri=$numerodenotas_transicao+$numerodemedias_transicao;
               
            
            
            $minipauta.='

          <th align="center" colspan="'.$colSpan_tri.'">'.$exibir["titulo"].'</th> 
           '; } 
          
          $minipauta.='
            </tr>

         <tr>  
         ';

         foreach ($vetor_trimestres as $key => $idtrimestre_v) {
        
                $lista= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre_v' order by posicao asc");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                        <th align="center">'.$exibir["titulo"].'</th> 
                    ';
                    
                    } 
                    
                $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                      <th align="center">'.$exibir["titulo"].'</th> 
                    ';
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
                                if ($nota>=$minimoparapositiva) {
                                   $cor="Blue";
                                }else{
                                  $cor="red";
                                }
                              
                                  $minipauta.='  
                                  <th align="center" style="color: '.$cor.'" contenteditable class="update" data-id="'.$idmatriculaeconfirmacao.'" data-column="'.$idnotadoano.'">'.$nota.'</th>'; 
                               
                                } 

                                $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                                if ($media>=$minimoparapositiva) {
                                  $cor="Blue";
                               }else{
                                 $cor="red";
                               }

                                $minipauta.='  
                                <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                 $cor='';

                                      
                   
                         }  


                     }

              $minipauta.='


        </tr>   '; }
        $minipauta.='
      </tbody>
    </table>';


    echo "$minipauta";
}else {
  
   $minipauta='
   
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>';

       
        $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' "));
        $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas' "));

        $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                
        $minipauta.='

        <tr>  
          <th rowspan="3" align="center">Nome do Estudante</th>
          <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
        </tr>
        <tr>  ';

    

        $lista_de_trimestre= mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc"); 

            
          while($exibir = $lista_de_trimestre->fetch_array()){
            
            $idtrimestre=$exibir["idtrimestre"];
            
            $vetor_trimestres[]=$idtrimestre;

            $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='exame' "));
            $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas'  "));

            $colSpan_tri=$numerodenotas_transicao+$numerodemedias_transicao;
               
            
            
            $minipauta.='

          <th align="center" colspan="'.$colSpan_tri.'">'.$exibir["titulo"].'</th> 
           '; } 
          
          $minipauta.='
            </tr>

         <tr>  
         ';

         foreach ($vetor_trimestres as $key => $idtrimestre_v) {
        
                $lista= mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idanolectivo='$idanolectivo' and  tipodeturma='exame' and idtrimestre='$idtrimestre_v' order by posicao asc");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                        <th align="center">'.$exibir["titulo"].'</th> 
                    ';
                    
                    } 
                    
                $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

                  while($exibir = $lista->fetch_array()){
                    
                    $minipauta.=' 
                      <th align="center">'.$exibir["titulo"].'</th> 
                    ';
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

                     $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

                     while($observar = $listadetrimestre->fetch_array()){

                         $idtrimestre=$observar["idtrimestre"];
         
                          $lista_de_medias= mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='denotas'"); 

                          while($visualizar = $lista_de_medias->fetch_array()){
                            
                            $idmedia=$visualizar["idmediadoano"];
                   
                              $lista_de_nota= mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'"); 

                              $somatorio=0;
                              $numero_de_notas=mysqli_num_rows($lista_de_nota);
                           
                              while($ver = $lista_de_nota->fetch_array()){
                                
                                $idnotadoano=$ver["idnotadoano"];
                            
                                $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                                $somatorio+=$nota;
                                if ($nota>=$minimoparapositiva) {
                                   $cor="Blue";
                                }else{
                                  $cor="red";
                                }
                              
                                  $minipauta.='  
                                  <th align="center" style="color: '.$cor.'" contenteditable class="update" data-id="'.$idmatriculaeconfirmacao.'" data-column="'.$idnotadoano.'">'.$nota.'</th>'; 
                               
                                } 

                                $media=round($somatorio/$numero_de_notas,$visualizar["arredondarmedia"]);
                                if ($media>=$minimoparapositiva) {
                                  $cor="Blue";
                               }else{
                                 $cor="red";
                               }

                                $minipauta.='  
                                <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                 $cor='';

                                      
                   
                         }  


                     }

              $minipauta.='


        </tr>   '; }
        $minipauta.='
      </tbody>
    </table>';


    echo "$minipauta";

    
}



echo '

<br> 
      
<a href="lancarnota.php?iddisciplina='.$iddisciplina.'"><button  class="btn btn-primary"> Lançar Nota da Minipauta </button></a>
  
<br><br>


';
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
