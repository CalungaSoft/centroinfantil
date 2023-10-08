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

   $idturma_padrao=mysqli_fetch_array(mysqli_query($conexao, "select idturma from turmas where idanolectivo='$idanolectivo' order by idclasse desc"))[0];
 
    $idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"$idtrimestre_padrao";
$idtrimestre=mysqli_escape_string($conexao, $idtrimestre); 

   $idturma=isset($_GET['idturma'])?$_GET['idturma']:"$idturma_padrao";
$idturma=mysqli_escape_string($conexao, $idturma); 

   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0]; 

 
   $nome_do_trimestre=mysqli_fetch_array(mysqli_query($conexao, "select titulo from trimestres where idtrimestre='$idtrimestre' limit 1"))[0]; 

   $nome_do_turma=mysqli_fetch_array(mysqli_query($conexao, "select titulo from turmas where idturma='$idturma' limit 1"))[0];
 


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
          <h1 class="h3 mb-2 text-gray-800">Mapa de Aproveitamento por Disciplinas ( <a href="anolectivo.php?idanolectivo=<?php echo "$idanolectivo"; ?>"> <?php echo $anolectivo_escolhido; ?> </a>) | <?php echo $nome_do_trimestre; ?> Trimestre | Turma: <a href="turma.php?idturma=<?php echo "$idturma"; ?>"> <?php echo $nome_do_turma; ?> </a></h1>
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
    <button id="myBtn" class="btn btn-success">  Escolher outra Turma e Trimestre</button>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

  <?php

  echo '<a href="mapadeaproveitamento.php?idanolectivo='.$idanolectivo.'&idtrimestre='.$idtrimestre.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-print"></i> Ver Mapa de Turmas </a> ';
 
 echo '<a href="mapadeaproveitamentoqualitativo.php?idanolectivo='.$idanolectivo.'&idtrimestre='.$idtrimestre.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-print"></i> Ver Mapa qualitativo </a> ';

  ?>
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="get" action=""> 
                <h3>Escolha uma Turma e Trimestre</h3> <br> 

                 <div class="form-group">
                 <span>Escolha a Turma</span>
                    <select name="idturma" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from turmas where idanolectivo='$idanolectivo' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idturma"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                    <div class="form-group">
                    <span>Escolha o Trimestre</span>
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

                $minipauta='

                <h2> <a href="pdf/pdfmapadedisciplina.php?idturma='.$idturma.'&idtrimestre='.$idtrimestre.'" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir </a>  </h2>  <br><br>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      
                      <th>Disciplina</th> 
                      <th>Matriculados</th> 
                      <th>Desistentes</th> 
                      <th>Avaliados</th> 
                      <th>Nº de Positivas</th> 
                      <th>Perc. %</th>  
                    </tr> 
                  </thead> 
                  <tbody>';

                        $dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));

                         $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM turmas where idturma='$idturma' "));

 
                        $arredondarmedia_anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT arredondarmedia FROM mediasdoano where idanolectivo='$idanolectivo' and idtrimestre='$idtrimestre' limit 1 "))[0];

                        $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 

 

                  $listadedisciplina=mysqli_query($conexao,"SELECT * from disciplinas where idanolectivo='$idanolectivo' and idturma='$idturma' order by titulo desc");



                  $soma_percentagem=0;

                  while($exibir_disciplina = $listadedisciplina->fetch_array()){

                   
                   

                    $iddisciplina=$exibir_disciplina["iddisciplina"];
                    $nome_da_disciplina=$exibir_disciplina["titulo"];
                    $tipodedisciplina=$exibir_disciplina['tipodedisciplina'];

                     

                                $numerodepositivasdaturma=0;
                                $numerode_avaliado=0; 
                                $maior_avalidado=0;

 

                                $matriculados=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));
 

                                $desistentes=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus!='activo'"));

                               
                                  $lista=mysqli_query($conexao, "select alunos.sexo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' and matriculaseconfirmacoes.estatus='activo' order by alunos.nomecompleto"); 

                                      

                     


                                            while($exibir = $lista->fetch_array()){ 

                                              $idaluno=$exibir["idaluno"]; 
                                              $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
 
 
 
 
 
 
                                                      


                                                        

                                                         $mediatrimestral=round(mysqli_fetch_array(mysqli_query($conexao," SELECT avg(valordanota) as media FROM notas, notasdoano where notasdoano.idnotadoano=notas.idnotadoano and notasdoano.idtrimestre='$idtrimestre' and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);
   
                                                           
                                                             
                                                                    if($mediatrimestral>=$minimoparapositiva) {

                                                                      $numerodepositivasdaturma++;

                                                                    }

                                                                    if($mediatrimestral>0) {

                                                                      $numerode_avaliado++;

                                                                    }       

 
                                                      }
 


                                                       


                                                    if($numerode_avaliado>0){

                                                      $percentagem_por_disciplina=round($numerodepositivasdaturma*100/$numerode_avaliado);
                                                    }else{

                                                      $percentagem_por_disciplina=round($numerodepositivasdaturma*100/0.0001);

                                                    }
                                                       
  
                             $minipauta.='

                            <tr>
                              <td><a href="disciplina.php?iddisciplina='.$iddisciplina.'">'.$nome_da_disciplina.'</a></td>  

                              <td>'.$matriculados.'</td> 
                              <td>'.$desistentes.'</td> 

                              <td>'.$numerode_avaliado.'</td> 
                              <td>'.$numerodepositivasdaturma.'</td> 

                              <td>'.$percentagem_por_disciplina.'%</td> 
                              
                       
                    </tr> 
                    ';
                                    if($maior_avalidado<$numerode_avaliado){
                                      $maior_avalidado=$numerode_avaliado;
                                    }

                                    $soma_percentagem+=$percentagem_por_disciplina;

                  }   


                                    $numero_de_disciplinas=mysqli_num_rows($listadedisciplina);

                                    if($numero_de_disciplinas==0){
                                      $numero_de_disciplinas=0.0001;
                                    }

                                    $total_percentagem=round($soma_percentagem/$numero_de_disciplinas);
                    $minipauta.='
                   </tbody>  
                   <tfoot>
                            <tr>
                              <th>Total </th>
                              <th>'.$matriculados.'</th> 
                              <th>'.$desistentes.'</th> 
                              <th>-</th> 
                              <th> - </th> 
                              <th>'.$total_percentagem.' %</th>     
                            </tr>
                   </tfoot>
                </table>';

                echo "$minipauta";

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