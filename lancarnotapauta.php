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
 
                           $professor=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessor' limit 1"))[0];

                           $professorauxiliar=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar' limit 1"))[0];

                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Lançando Notas no Sistema | Pauta</h1>
     
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

              
              <a href="lancarnota.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Minipauta</a>  <br>


               <span id="escolheu"   class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Pauta</span> <br>


        </div>
    </div>
 
                <script>
                    var btn=document.getElementById("myBtn");
                    
                    var modal=document.getElementById("myModal");
                    
                    var span=document.getElementById("close"); 
                     var escolheu=document.getElementById("escolheu");

                         
                    
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
 
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where vigor='Sim'"));

                                             $idanolectivo=$anolectivo["idanolectivo"];
 

                                                    $idturma=$dadosdadisciplina["idturma"];
                                           $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                                               $turma=$dadosdaturma["titulo"]; 
                                               $idperiodo=$dadosdaturma["idperiodo"];
                                               $idcurso=$dadosdaturma["idcurso"];
                                               $idsala=$dadosdaturma["idsala"];
                                               $idclasse=$dadosdaturma["idclasse"];
                                              


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
              <h6 class="m-0 font-weight-bold text-primary">Mini Pauta / Pauta | <a href="turmapauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" >Ver Pauta</a></h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
             
                     
                              <?php 
            if(isset($_GET['eliminar'])){ ?>

              <a href="lancarnota.php?iddisciplina=<?php echo $iddisciplina; ?>&eliminar=cadeira" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Minipauta</a> <br><br> 
                        
                         <?php  echo '<div class="alert alert-info">Depois de Alterar a nota do aluno que quer eliminar a cadeira, <a href="turmapauta.php?idturma='.$idturma.  '">Clique aqui para o sistema verificar se o aluno pode ou não elimnar a cadeira</a></div>';
                         
                      }else{?>

                        <a href="lancarnota.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Minipauta</a> <br><br>

                    <?php  };
            ?> 
              <span id="mensagemdealerta"></span>
              <span id="resultado">


                  <?php
 
   
 

 
    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
 

 $minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

  $dadosdadisciplina= mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1")); 
  $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

  if ($dadosdaturma["eclassedeexame"]!='Sim') {
    
     $minipauta='
     
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>';

         
          $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
          $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' "));

          $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                                  
          $minipauta.='

          <tr>  
            <th rowspan="2" align="center">Nome do Estudante</th>
            <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
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

           foreach ($vetor_trimestres as $key => $idtrimestre_v) {
          
                  
                  $lista= mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  ");

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
                                  $cor='';

                                       
                    
                          }  



                       }
 
                $minipauta.='


          </tr>   '; }
          $minipauta.='
        </tbody>
      </table>
      
 
      ';


      echo "$minipauta";
 }else {
    $minipauta='
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>';

   
    $numerodenotas_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
    $numerodemedias_transicao=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' "));

    $colSpan_dis=$numerodenotas_transicao+$numerodemedias_transicao;
                            
    $minipauta.='

    <tr>  
      <th rowspan="2" align="center">Nome do Estudante</th>
      <th colspan="'.$colSpan_dis.'" align="center">'.$dadosdadisciplina["titulo"].'</th>
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

                 $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao desc limit 1 ");
                 $somatorio_geral=0;
                 $numero_de_notas_geral=0;
                 $somatorio_individual=0;


                 while($observar = $listadetrimestre->fetch_array()){

                     $idtrimestre=$observar["idtrimestre"];

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
                            <th align="center" style="color: '.$cor.'" >'.$media_geral.' </th>'; 
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
                           <th align="center" style="color: '.$cor.'" contenteditable class="update" data-id="'.$idmatriculaeconfirmacao.'" data-column="'.$idnotadoano.'" >'.$nota.' </th>'; 
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
                          <th align="center" style="color: '.$cor.'" >'.$nota_ponderada.' </th>'; 
                           $cor='';

                     

                        //nota do recurso
                        $notada_prova= mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipo='recurso' and idtrimestre='$idtrimestre_v'  ");

                        while($visualizar = $notada_prova->fetch_array()){
                          
                          $idnotadoano=$visualizar["idnotadoano"];
    
                          $nota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
    
                            
                              if ($nota>=$minimoparapositiva) {
                                $cor="Blue";
                             }else{
                               $cor="red";
                             }
    
                              $minipauta.='  
                              <th align="center" style="color: '.$cor.'" contenteditable class="update" data-id="'.$idmatriculaeconfirmacao.'" data-column="'.$idnotadoano.'" >'.$nota.' </th>'; 
                               $cor='';
    
                                    
                            }

 


                 }

          $minipauta.='


    </tr>   '; }
    $minipauta.='
  </tbody>
</table>

 

';

 
      echo "$minipauta";

      echo '
      
      <br> 

      <a href="lancarnotapauta.php?iddisciplina='.$iddisciplina.'"><button  class="btn btn-primary"> Lançar Nota da Pauta </button></a>
        
      <br><br>
      
      
      ';
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


                                  $(document).on("blur", ".update", function(){

                                        var idmatriculaeconfirmacao=$(this).data("id");
                                        var idnotadoano=$(this).data("column");
                                        var valordanota=$(this).text();

                                        var iddisciplina=<?php echo $iddisciplina; ?>; 
                                         
                                        
                                        $.ajax({
                                              url:'cadastro/lancarnota.php',
                                              method:'POST',

                                              data:{idmatriculaeconfirmacao, idnotadoano, valordanota, iddisciplina},

                                              success: function(data){
                                                  $("#mensagemdealerta").html(data); 
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
