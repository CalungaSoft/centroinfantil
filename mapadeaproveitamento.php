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
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo); 

   $idtrimestre_padrao=mysqli_fetch_array(mysqli_query($conexao, "select idtrimestre from trimestres where idanolectivo='$idanolectivo' order by titulo desc"))[0]; 
 
    $idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"$idtrimestre_padrao";
$idtrimestre=mysqli_escape_string($conexao, $idtrimestre); 


   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0]; 

 
   $nome_do_trimestre=mysqli_fetch_array(mysqli_query($conexao, "select titulo from trimestres where idtrimestre='$idtrimestre' limit 1"))[0]; 
 


if(isset($_POST['cadastrar'])){
  
  if(!empty(trim($_POST['titulo']))){ 
   
      $titulo=mysqli_escape_string($conexao,$_POST['titulo']);
      $idanolectivo=mysqli_escape_string($conexao,$_POST['idanolectivo']);
      $idperiodo=mysqli_escape_string($conexao,$_POST['idperiodo']); 
      $idcurso=mysqli_escape_string($conexao,$_POST['idcurso']);
      $idsala=mysqli_escape_string($conexao,$_POST['idsala']);
      $idclasse=mysqli_escape_string($conexao,$_POST['idclasse']);
      $matricula=mysqli_escape_string($conexao,$_POST['matricula']);
      $reconfirmacao=mysqli_escape_string($conexao,$_POST['reconfirmacao']);
      $propina=mysqli_escape_string($conexao,$_POST['propina']);
      $eclassedeexame=mysqli_escape_string($conexao,$_POST['eclassedeexame']);
      $classificacaopositiva=mysqli_escape_string($conexao,$_POST['classificacaopositiva']);
      $classificacaonegativa=mysqli_escape_string($conexao,$_POST['classificacaonegativa']);
       
        $existe=mysqli_num_rows(mysqli_query($conexao, "select idturma from turmas where titulo='$titulo' and idanolectivo='$idanolectivo' and idperiodo='$idperiodo' and idcurso='$idcurso' and idsala='$idsala' and idclasse='$idclasse'"));
      
          if($existe==0){

                $salvar= mysqli_query($conexao,"INSERT INTO `turmas` (titulo, idanolectivo, idperiodo, idcurso, idsala, idclasse, matricula, reconfirmacao, propina, eclassedeexame, classificacaopositiva, classificacaonegativa) VALUES ('$titulo', '$idanolectivo', '$idperiodo', '$idcurso', '$idsala', '$idclasse', '$matricula', '$reconfirmacao', '$propina', '$eclassedeexame', '$classificacaopositiva', '$classificacaonegativa')");
                 
               if($salvar){

                $acerto[]="Turma $titulo foi Cadastrada com sucesso";

            }else{

              $erros[]="Ocorreu um erro Ao Cadastrar a turma";

            } 
          }else{

        $erros[]="Essa turma já existe";
      }

    }  else{
    $erros[]=" O campo título não pode ir vazio";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Mapa de Aproveitamento por Turmas ( <a href="anolectivo.php?idanolectivo=<?php echo "$idanolectivo"; ?>"> <?php echo $anolectivo_escolhido; ?> </a>) | <?php echo $nome_do_trimestre; ?> Trimestre </h1>
          <p class="mb-4">A seguir vai a lista de turmas disponíveis na instituição</p>
     
      <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>
              <?php 
            if(!empty($acerto)):
                        foreach($acerto as $acerto):
                          echo '<div class="alert alert-success">'.$acerto.'</div>';
                        endforeach;
                      endif;
            ?>


                    
                        
          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-success">  Escolher outro Trimestre</button>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

  <?php

  echo '<a href="mapadedisciplinas.php?idanolectivo='.$idanolectivo.'&idtrimestre='.$idtrimestre.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-print"></i> Ver Mapa de Disciplinas </a> ';

 echo '<a href="mapadeaproveitamentoqualitativo.php?idanolectivo='.$idanolectivo.'&idtrimestre='.$idtrimestre.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-print"></i> Ver Mapa qualitativo </a> ';


  ?> 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="get" action=""> 
                <h3>Escolha um Trimestre</h3> <br> 
                    <div class="form-group">
                    <select name="idtrimestre" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from trimestres where idanolectivo='$idanolectivo' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idtrimestre"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 
                   
                     <input type="hidden" name="idanolectivo" value="<?php echo "$idanolectivo"; ?>">
                    <br>
                       <input type="submit" name="ver" value="Ver Mapa de Aproveitamento" class="btn btn-success" style="float: rigth;">
                    
          </form>
        </div>
    </div>


    


    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="get">
                      <br>
                     
                    <span>Escolha outro Ano Lectivo</span>
                    <div class="form-group">
                    <select name="idanolectivo" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                          <br>
                            <input type="submit" value="Ver" name="mudaranolectivo" class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    


    <script>
                   var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");
                    

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                  
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }
 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })

                                                  
      
                                                  
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })

                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })


                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
              
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                
                    

                  </script>

                  <br> <br>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Mapa de Aproveitamento por turmas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <span id="mensagemdealerta">
                  
                   <?php 

                $htm='

                <h2> <a href="pdf/pdfmapadeaproveitamento.php?idtrimestre='.$idtrimestre.'" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir </a>  </h2>  <br><br>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th rowspan="2">Ciclo</th>
                      <th rowspan="2">Turma</th> 
                      <th colspan="2">Matriculados</th> 
                      <th colspan="2">Desistentes</th> 
                      <th colspan="2">Avaliados</th> 
                      <th colspan="3" title="Com Aproveitamento">C/Aproveitamento</th> 
                      <th colspan="3" title="Sem Aproveitamento">S/Aproveitamento</th> 
                      <th colspan="2">Nº de Prof.</th>
                    </tr>
                     <tr>
                       
                      <th title="Masculino + Femenino" >MF</th> 
                      <th title="Femenino">F</th> 
                      <th title="Masculino + Femenino">MF</th> 
                      <th title="Femenino">F</th> 
                      <th title="Masculino + Femenino">MF</th> 
                      <th title="Femenino">F</th>  
                      <th title="Masculino + Femenino">MF</th> 
                      <th title="Femenino">F</th>  
                      <th>%</th> 
                      <th title="Masculino + Femenino">MF</th> 
                      <th title="Femenino">F</th>  
                      <th>%</th> 
                      <th>Nº</th> 
                      <th>Aux</th>    
                    </tr>
                  </thead> 
                  <tbody>';

                        $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
                        
                        $arredondarmedia=mysqli_fetch_array(mysqli_query($conexao," SELECT arredondarmedia FROM mediasdoano where idanolectivo='$idanolectivo' and idtrimestre='$idtrimestre' limit 1 "))[0];

 


                        $numero_de_ciclos=0;

                  $litadeciclos=mysqli_query($conexao,"SELECT * from ciclos order by idciclo desc");
                      
                    
                   $listade_ciclos=[];

                   $total_ciclo_matriculado=0;
                   $total_ciclo_matriculado_femenino=0;

                   $total_ciclo_desistente=0;
                   $total_ciclo_desistente_femenino=0;

                   $total_ciclo_avaliado=0;
                   $total_ciclo_avaliado_femenino=0;

                   $total_ciclo_com_aproveitamento=0;
                   $total_ciclo_com_aproveitamento_femenino=0;
                   $total_ciclo_com_aproveitamento_percentagem=0;


                   $total_ciclo_sem_aproveitamento=0;
                   $total_ciclo_sem_aproveitamento_femenino=0;
                   $total_ciclo_sem_aproveitamento_percentagem=0;

                  while($exibir_ciclo = $litadeciclos->fetch_array()){

                    $numero_de_ciclos++;

                   $ciclo_matriculado=0;
                   $ciclo_matriculado_femenino=0;

                   $ciclo_desistente=0;
                   $ciclo_desistente_femenino=0;

                   $ciclo_avaliado=0;
                   $ciclo_avaliado_femenino=0;

                   $ciclo_com_aproveitamento=0;
                   $ciclo_com_aproveitamento_femenino=0;
                   $ciclo_com_aproveitamento_percentagem=0;


                   $ciclo_sem_aproveitamento=0;
                   $ciclo_sem_aproveitamento_femenino=0;
                   $ciclo_sem_aproveitamento_percentagem=0;


                    $idciclo=$exibir_ciclo["idciclo"];
                    $titulo_do_ciclo=$exibir_ciclo["titulo"];

                    $listade_ciclos[$idciclo]=$titulo_do_ciclo;

                     
                     $total_alunos_por_ciclo=0;

                   

                        $alunoscadastrados_nas_turmas=mysqli_query($conexao,"SELECT * from turmas where  idanolectivo='$idanolectivo' and idciclo='$idciclo'");

                        $numero_de_turmas=0;
                        

                           
    
                           while($exibir_turma = $alunoscadastrados_nas_turmas->fetch_array()){

                            $numero_de_turmas++;

                                $idturma=$exibir_turma["idturma"];

                                 $minimoparapositiva=$exibir_turma["minimoparapositiva"];  

                                $numerodepositivasdaturma_masculino=0;
                                $numerodenegativasdaturma_femenino=0;

                                $numerodepositivasdaturma_femenino=0;
                                $numerodenegativasdaturma_masculino=0;


                                $numerode_nao_avaliados=0;
                                $numerode_nao_avaliados_femenino=0;



                                $matriculados=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));

                                $matriculados_femeninos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(matriculaseconfirmacoes.idaluno) from matriculaseconfirmacoes, alunos where alunos.idaluno=matriculaseconfirmacoes.idaluno and alunos.sexo='Femenino' and idturma='$idturma' and idanolectivo='$idanolectivo'"));

                                $matriculados_masculino=$matriculados-$matriculados_femeninos;

                                $ciclo_matriculado+=$matriculados;
                                $ciclo_matriculado_femenino+=$matriculados_femeninos;


                                $desistentes=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus!='activo'"));

                                 $desistentes_femeninos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(matriculaseconfirmacoes.idaluno) from matriculaseconfirmacoes, alunos where alunos.idaluno=matriculaseconfirmacoes.idaluno and alunos.sexo='Femenino' and idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus!='activo'"));

                                 $ciclo_desistente+=$desistentes;
                                 $ciclo_desistente_femenino+=$desistentes_femeninos;



                                     

                                           $lista=mysqli_query($conexao, "select alunos.sexo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' and matriculaseconfirmacoes.estatus='activo' order by alunos.nomecompleto"); 

                                      

                     


                                            while($exibir = $lista->fetch_array()){ 

                                              $idaluno=$exibir["idaluno"];
                                              $sexo=$exibir["sexo"];
                                              $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
 

                                                     $contadordenegativa=0;
                                                     $disciplinas_em_atraso=[];
                                                     $disciplinas_em_atraso_nota=[];

                                                $lista_disciplinas=mysqli_query($conexao, "SELECT disciplinas.* from disciplinas where disciplinas.idturma='$idturma'"); 

                                                $notaacumulada=0;

                                                     while($mostrar = $lista_disciplinas->fetch_array()){ 

                                                      $iddisciplina=$mostrar['iddisciplina'];
                                                      $tipodedisciplina=$mostrar['tipodedisciplina'];


                                                        

                                                         $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT avg((notas.valordanota)) as media FROM notas, notasdoano where notasdoano.idnotadoano=notas.idnotadoano and notasdoano.idtrimestre='$idtrimestre' and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia);
  
                                                          $notaacumulada+=$mediadostrimestres;

                                                           
                                                            $nota_final=$mediadostrimestres;
                                                          

                                                                           if ($nota_final<$minimoparapositiva){
                                                                            
                                                                            
                                                                            $contadordenegativa++;

                                                                          

                                                                                if($tipodedisciplina=='Chave'){
                                                                                  $contadordenegativa+=100; //não pode ter negativa nas diciplinas chaves se não reprova
                                                                                } 
                                                                          }


 
                                                        }
 


                                                        if($contadordenegativa<=2){ //se tiver menos de duas negativas
                                                           
                                                              
                                                                
                                                            
                                                            if(mysqli_num_rows($lista_disciplinas)!=0){

                                                              if($sexo='Masculino'){
                                                                  $numerodepositivasdaturma_masculino++;
                                                                }else{
                                                                  $numerodepositivasdaturma_femenino++;
                                                                }
                                                            }


                                                        }else{ //se tiver mais de duas negativas reprova direito

                                                            if($notaacumulada!=0){

                                                               if($sexo='Masculino'){
                                                                  $numerodenegativasdaturma_masculino++;
                                                                }else{
                                                                  $numerodenegativasdaturma_femenino++;
                                                                }
                                                            

                                                           }
 


                                                      }


                                                   

                                                       
 
                                          }

                                         
                                           $numerode_avaliados_femenino=$numerodenegativasdaturma_femenino+$numerodepositivasdaturma_femenino;

                                          $numerode_avaliado=$numerodenegativasdaturma_masculino+$numerodepositivasdaturma_masculino+$numerode_avaliados_femenino;

                                                        $ciclo_avaliado+=$numerode_avaliado;
                                                        $ciclo_avaliado_femenino+=$numerode_avaliados_femenino;

                                          $com_aproveitamento=$numerodepositivasdaturma_masculino+$numerodepositivasdaturma_femenino;

                                                        $ciclo_com_aproveitamento+=$com_aproveitamento;


                                          $sem_aproveitamento=$numerodenegativasdaturma_masculino+$numerodenegativasdaturma_femenino;

                                                        $ciclo_sem_aproveitamento+=$sem_aproveitamento;

                                          $com_aproveitamento_femenino=$numerodepositivasdaturma_femenino;
                                          $sem_aproveitamento_femenino=$numerodenegativasdaturma_femenino;

                                                        $ciclo_com_aproveitamento_femenino+=$com_aproveitamento_femenino;
                                                        $ciclo_sem_aproveitamento_femenino+=$sem_aproveitamento_femenino;

                                          if($numerode_avaliado==0){
                                            $percentagem_com_aproveitamento=round($com_aproveitamento*100/0.001);
                                            $percentagem_sem_aproveitamento=round($sem_aproveitamento*100/0.001);
                                          }else{
                                            $percentagem_com_aproveitamento=round($com_aproveitamento*100/$numerode_avaliado);
                                            $percentagem_sem_aproveitamento=round($sem_aproveitamento*100/$numerode_avaliado);
                                          }

                                          
                                                      $ciclo_com_aproveitamento_percentagem+=$percentagem_com_aproveitamento;
                                                      $ciclo_sem_aproveitamento_percentagem+=$percentagem_sem_aproveitamento;

                                        $numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessor) from disciplinas where disciplinas.idturma='$idturma'")); 

                                        $numerodeprofessores_auxiliares=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessorauxiliar) from disciplinas where disciplinas.idturma='$idturma' and idprofessorauxiliar!='0'")); 

                                        $total_professores=$numerodeprofessores+$numerodeprofessores_auxiliares;

                               
                             $htm.='

                            <tr>
                              <td><a href="ciclo.php?idciclo='.$exibir_ciclo["idciclo"].'">'.$exibir_ciclo["titulo"].'</a></td> 
                              <td><a href="turma.php?idturma='.$idturma.'">'.$exibir_turma["titulo"].'</a></td> 


                              <td title="Masculino='.$matriculados_masculino.' | Femenino='.$matriculados_femeninos.'">'.$matriculados.'</td> 
                              <td title="Masculino='.$matriculados_masculino.' | Femenino='.$matriculados_femeninos.'" >'.$matriculados_femeninos.'</td> 

                              <td>'.$desistentes.'</td> 
                              <td>'.$desistentes_femeninos.'</td> 

                              <td>'.$numerode_avaliado.'</td> 
                              <td>'.$numerode_avaliados_femenino.'</td>

                              <td>'.$com_aproveitamento.'</td> 
                              <td>'.$com_aproveitamento_femenino.'</td> 
                              <td>'.$percentagem_com_aproveitamento.'%</td> 

                              <td>'.$sem_aproveitamento.'</td> 
                              <td>'.$sem_aproveitamento_femenino.'</td> 
                              <td>'.$percentagem_sem_aproveitamento.'%</td> 


                              <td>'.$total_professores.'</td>  
                              <td>'.$numerodeprofessores_auxiliares.'</td>  
                       
                    </tr> 
                    ';

                  }   


                          if($ciclo_com_aproveitamento==0){$ciclo_com_aproveitamento_percentagem=0;}else{
                         $ciclo_com_aproveitamento_percentagem=round($ciclo_com_aproveitamento*100/$ciclo_avaliado);
                       }
                       if($ciclo_sem_aproveitamento==0){$ciclo_sem_aproveitamento_percentagem=0;}else{
                         $ciclo_sem_aproveitamento_percentagem=round($ciclo_sem_aproveitamento*100/$ciclo_avaliado);
                       }
                             


                   $total_ciclo_matriculado+=$ciclo_matriculado;
                   $total_ciclo_matriculado_femenino+=$ciclo_matriculado_femenino;

                   $total_ciclo_desistente+=$ciclo_desistente;
                   $total_ciclo_desistente_femenino+=$ciclo_desistente_femenino;

                   $total_ciclo_avaliado+=$ciclo_avaliado;
                   $total_ciclo_avaliado_femenino+=$ciclo_avaliado_femenino;

                   $total_ciclo_com_aproveitamento+=$ciclo_com_aproveitamento;
                   $total_ciclo_com_aproveitamento_femenino+=$ciclo_com_aproveitamento_femenino;
                   $total_ciclo_com_aproveitamento_percentagem+=$ciclo_com_aproveitamento_percentagem;


                   $total_ciclo_sem_aproveitamento+=$ciclo_sem_aproveitamento;
                   $total_ciclo_sem_aproveitamento_femenino+=$ciclo_sem_aproveitamento_femenino;
                   $total_ciclo_sem_aproveitamento_percentagem+=$ciclo_sem_aproveitamento_percentagem;


                     
                             


                      $ciclo_numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessor) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idciclo='$idciclo' and turmas.idanolectivo='$idanolectivo'")); 

                                        $ciclo_numerodeprofessores_auxiliares=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessorauxiliar) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idciclo='$idciclo' and turmas.idanolectivo='$idanolectivo' and idprofessorauxiliar!='0'")); 

                                        $ciclo_total_professores=$ciclo_numerodeprofessores+$ciclo_numerodeprofessores_auxiliares;



                  $htm.='

                          <tr>
                            <th>'.$exibir_ciclo["titulo"].'  - </th>
                            <th>Total</th> 
                              <th>'.$ciclo_matriculado.'</th> 
                              <th>'.$ciclo_matriculado_femenino.'</th> 
                              <th>'.$ciclo_desistente.'</th> 
                              <th>'.$ciclo_desistente_femenino.'</th> 
                              <th>'.$ciclo_avaliado.'</th> 
                              <th>'.$ciclo_avaliado_femenino.'</th>
                              <th>'.$ciclo_com_aproveitamento.'</th> 
                              <th>'.$ciclo_com_aproveitamento_femenino.'</th> 
                              <th>'.$ciclo_com_aproveitamento_percentagem.'%</th> 
                              <th>'.$ciclo_sem_aproveitamento.'</th> 
                              <th>'.$ciclo_sem_aproveitamento_femenino.'</th> 
                              <th>'.$ciclo_sem_aproveitamento_percentagem.'%</th> 
                              <th>'.$ciclo_total_professores.'</th>
                              <th>'.$ciclo_numerodeprofessores_auxiliares.'</th>    
                          
                    </tr> ';

                    }  

                            
                                if($total_ciclo_com_aproveitamento==0){$total_ciclo_com_aproveitamento_percentagem=0;}else{
                                 $total_ciclo_com_aproveitamento_percentagem=round($total_ciclo_com_aproveitamento*100/$total_ciclo_avaliado);
                               }
                               if($total_ciclo_sem_aproveitamento==0){$total_ciclo_sem_aproveitamento_percentagem=0;}else{
                                 $total_ciclo_sem_aproveitamento_percentagem=round($total_ciclo_sem_aproveitamento*100/$total_ciclo_avaliado);
                               }
                             




                               $total_ciclo_numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessor) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idanolectivo='$idanolectivo'")); 

                                        $total_ciclo_numerodeprofessores_auxiliares=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessorauxiliar) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idanolectivo='$idanolectivo' and idprofessorauxiliar!='0'")); 

                                        $total_ciclo_total_professores=$total_ciclo_numerodeprofessores+$total_ciclo_numerodeprofessores_auxiliares;
                    $htm.='
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th>Total </th>
                              <th>Todos Cíclos</th> 
                              <th>'.$total_ciclo_matriculado.'</th> 
                              <th>'.$total_ciclo_matriculado_femenino.'</th> 
                              <th>'.$total_ciclo_desistente.'</th> 
                              <th>'.$total_ciclo_desistente_femenino.'</th> 
                              <th>'.$total_ciclo_avaliado.'</th> 
                              <th>'.$total_ciclo_avaliado_femenino.'</th>
                              <th>'.$total_ciclo_com_aproveitamento.'</th> 
                              <th>'.$total_ciclo_com_aproveitamento_femenino.'</th> 
                              <th>'.$total_ciclo_com_aproveitamento_percentagem.'%</th> 
                              <th>'.$total_ciclo_sem_aproveitamento.'</th> 
                              <th>'.$total_ciclo_sem_aproveitamento_femenino.'</th> 
                              <th>'.$total_ciclo_sem_aproveitamento_percentagem.'%</th> 
                              <th>'.$total_ciclo_total_professores.'</th>
                              <th>'.$total_ciclo_numerodeprofessores_auxiliares.'</th>   
                            </tr>
                   </tfoot>
                </table>';

                echo "$htm";

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
                                                                var id=$(this).data("id");
                                                                var nomedacoluna=$(this).data("column");
                                                                var valor=$(this).text();
                                                                 

                                                                $.ajax({
                                                                    url:'cadastro/updateagenda.php',
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
                                                                if(confirm("Tens certeza que queres eliminar esssa actividade?")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deleteagenda.php',
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
      
            <div class="alert alert-info"> <h2>Critério de Aproveitamento</h2> <br>

                <strong>COM APROVEITAMENTO</strong>: todo aluno que não tiver <strong>nenhuma negativa na média final do trimestre em qualquer uma disciplina</strong>.<br>

                <strong>COM APROVEITAMENTO</strong>: todo aluno com <strong>uma ou duas negativas</strong> na média final do trimestre (Desde que essas negativas <strong>não sejam em disciplinas chaves</strong>) <br><br>


                <strong>SEM APROVEITAMENTO</strong>: Todo aluno com  <strong>negativa na média final do trimestre em pelo menos uma disciplina chave</strong>:  <br> 
                <strong>SEM APROVEITAMENTO</strong>: Todo aluno com <strong>mais de 2 disciplinas com negativa</strong> na media final do trimestre   <br> <br> 
              
                ATENÇÂO: a média trimestral do 3º trimestre não incluir a nota da prova de escola nem a do recurso.


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