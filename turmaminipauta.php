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
$idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"11";
       

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
          <h1 class="h3 mb-4 text-gray-800">Minipauta da Turma</h1>
      <a href="turma.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Ver dados da turma</a> 
       <a href="pdf/pdfminipautageral.php?idturma=<?php echo $idturma; ?>&idtrimestre=<?php echo $idtrimestre; ?>" class="d-sm-inline-block btn btn-sm btn-success" > <i class="fas fa-fw fa-print"></i> Imprimir Minipauta</a> 
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
                                <input type="hidden" name="idturma" value="<?php echo "$idturma"; ?>">
                                <br>
                                <input type="submit" name="ver" value="Ver Minipauta" class="btn btn-success" style="float: rigth;">
                                
                    </form>
                    </div>
                </div>



                  <br><br>
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
                   
                   <a href="turmaminipauta.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Ver Minipauta</a>  <br><br>
                   

<br>
<br>
<button id="myBtn" class="btn btn-primary">  Escolher outro Trimestre</button>
<a href="pdf/pdfminipautageral.php?idturma=<?php echo $idturma; ?>&idtrimestre=<?php echo $idtrimestre; ?>"><button  class="btn btn-success">Imprimir Minipauta</button></a>
<br><br>
                <span id="resultado"> 

                    <?php 


 
$minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

 
$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 
 
if($dadosdaturma["eclassedeexame"]=='sim'){$tipodeturma="exame";}else{ $tipodeturma='transição';}
 
   $minipauta='
   
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>';

       
                           
        $minipauta.='

                
          <tr>  
            <th rowspan="2" align="center">Nome do Estudante</th>
            ';

            $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

            while($exibir = $lista_de_disciplina->fetch_array()){
              $iddisciplina=$exibir["iddisciplina"];
              $minipauta.='
              
            <th   align="center"><a href="disciplina.php?iddisciplina='.$iddisciplina.'">'.$exibir["abreviatura"].'</a></th>
            ';

            }

            $minipauta.='
            <th rowspan="2" >Classificação</th>
          </tr>
        ';

    
      
         
 
          
          $minipauta.='
          

         <tr>  
         ';

         $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");
         $nome_da_media=mysqli_fetch_array(mysqli_query($conexao, "select titulo from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='$tipodeturma'  and idtrimestre='$idtrimestre'  "))[0];

         while($exibir = $lista_de_disciplina->fetch_array()){
            
    
              
               
                    $minipauta.=' 
                      <th align="center">'.$nome_da_media.'</th> 
                    ';
                   
                    
           
          
          }
            
            $minipauta.='
        </tr>
      

      </thead>
      <tbody> 
        ';
         
        $arredondarmedia=mysqli_fetch_array(mysqli_query($conexao," SELECT arredondarmedia FROM mediasdoano where idanolectivo='$idanolectivo' and idtrimestre='$idtrimestre' limit 1 "))[0];


            $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by nomecompleto"); 

             while($exibir = $lista->fetch_array()){

              $idaluno=$exibir["idaluno"];

      $minipauta.='
        <tr>  
          <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'">'.$exibir['nomecompleto'].' </a></td>'; 

              

                     $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
                     $somatorio_geral=0;
                     $numero_de_notas_geral=0;
                     $somatorio_individual=0;
                     $contadordenegativa=0;
                     $somador_de_notas_finais=0;
                     $classificacaofinal='';
                
                     $lista_de_disciplina= mysqli_query($conexao, "select * from disciplinas where idturma='$idturma'  ");

                     while($exibir_disciplinas = $lista_de_disciplina->fetch_array()){
                     
                      $iddisciplina=$exibir_disciplinas["iddisciplina"];
              
                       
                           
                         
                                
                                $media=round(mysqli_fetch_array(mysqli_query($conexao," SELECT avg((notas.valordanota)) as media FROM notas, notasdoano where notasdoano.idnotadoano=notas.idnotadoano and notasdoano.idtrimestre='$idtrimestre' and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia);
                                
                              $somatorio_individual+=$media;
                                 
                          
                                if ($media>=$minimoparapositiva) {
                                  $cor="Blue";
                               }else{
                                 $cor="red";
                               }

                                $minipauta.='  
                                <th align="center" style="color: '.$cor.'" >'.$media.'</th>'; 
                                 

                                 if (!($media>=$minimoparapositiva)) { //se for negativa
                            
                                    $contadordenegativa++;
                                    
                                    
  
                                          if($exibir_disciplinas["tipodedisciplina"]=="Chave"){
                                            $contadordenegativa+=100; //para que reprove direito
                                        
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
                             
                              
        
       
                          }
       
       
                     }else{ //se tiver mais de duas negativas reprova direito
                        $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                         $cor_classificacaofinal_final="red";
                     }
       
       
                       

                     if($somatorio_individual==0){ //se não fez nenhuma prova de escola então sai como desistente.
       
                           $classificacaofinal='Desistente';
                            $cor_classificacaofinal_final="red";
       
                        }
                        $cor='';
                        $media=0;
                     
               $minipauta.='
               <td> <span style="color: '.$cor_classificacaofinal_final.'">'.$classificacaofinal.'</span></td> 
       
         </tr>   '; 
        
        }
       

        $minipauta.='
      </tbody>
    </table>
       
    ';


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

                <strong>APROVADO</strong>: todo aluno com <strong>uma ou duas negativas</strong> (Desde que essas negativas <strong>não sejam em disciplinas chaves</strong>)  <br><br>

                <strong>REPROVADO</strong>: Todo aluno com  <strong>negativa em pelo menos uma disciplina chave</strong>:  <br><br>
                <strong>REPROVADO</strong>: Todo aluno com <strong>mais de 2 disciplinas com negativa</strong> na media final:  <br><br>

                NOTA BEM: o (*) no final de uma classificação, indica de que o aluno deixou disciplinas em atraso



            </div>


            <script>
                   var btn=document.getElementById("myBtn");
                   

                    var modal=document.getElementById("myModal");
                   

                    var span=document.getElementById("close");
                   

                

                  
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }
  
                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })

                                                  
      
                                                  
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
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
