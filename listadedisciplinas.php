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

   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

if(isset($_POST['cadastrar'])){
  
  if(!empty(trim($_POST['titulo']))){ 
   
      $idtipodedisciplina=mysqli_escape_string($conexao,$_POST['idtipodedisciplina']);
      $idanolectivo=mysqli_escape_string($conexao,$_POST['idanolectivo']);

      $titulo=mysqli_escape_string($conexao,$_POST['titulo']);
      $abreviatura=mysqli_escape_string($conexao,$_POST['abreviatura']); 
      $tipodedisciplina=mysqli_escape_string($conexao,$_POST['tipodedisciplina']);
      $agrupamento=mysqli_escape_string($conexao,$_POST['agrupamento']);
      $idprofessor=mysqli_escape_string($conexao,$_POST['idprofessor']);
      $idprofessorauxiliar=mysqli_escape_string($conexao,$_POST['idprofessorauxiliar']);
      $obs=mysqli_escape_string($conexao,$_POST['obs']);

      $idturma=mysqli_escape_string($conexao,$_POST['idturma']);
      $idturma2=mysqli_escape_string($conexao,$_POST['idturma2']);
      $idturma3=mysqli_escape_string($conexao,$_POST['idturma3']);
       




              $existe=mysqli_num_rows(mysqli_query($conexao, "select iddisciplina from disciplinas where titulo='$titulo' and idturma='$idturma' and idtipodedisciplina='$idtipodedisciplina'"));
              
                $turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from turmas where idturma='$idturma'"))[0];

                if($existe==0){

                      $salvar= mysqli_query($conexao,"INSERT INTO `disciplinas` (`iddisciplina`, `idprofessor`, `idprofessorauxiliar`, `idtipodedisciplina`, `titulo`, `abreviatura`, `idturma`, `idanolectivo`, `tipodedisciplina`, `agrupamento`, `obs`) VALUES (NULL, '$idprofessor', '$idprofessorauxiliar', '$idtipodedisciplina', '$titulo', '$abreviatura', '$idturma', '$idanolectivo', '$tipodedisciplina', '$agrupamento', 'obs')");
                       
                     if($salvar){

                       


                      $acerto[]="Disciplina $titulo da turma $turma foi Cadastrada com sucesso";

                  }else{

                    $erros[]="Ocorreu um erro Ao Cadastrar a disciplina $titulo da turma $turma ";

                  } 
                }else{

              $erros[]="Essa disciplina já existe na turma $turma ";
            }








            if ($idturma2!=0) {
            
                          $existe=mysqli_num_rows(mysqli_query($conexao, "select iddisciplina from disciplinas where titulo='$titulo' and idturma='$idturma2' and idtipodedisciplina='$idtipodedisciplina'"));
                        
                        $turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from turmas where idturma='$idturma2'"))[0];

                        if($existe==0){

                              $salvar= mysqli_query($conexao,"INSERT INTO `disciplinas` (`iddisciplina`, `idprofessor`, `idprofessorauxiliar`, `idtipodedisciplina`, `titulo`, `abreviatura`, `idturma`, `idanolectivo`, `tipodedisciplina`, `agrupamento`, `obs`) VALUES (NULL, '$idprofessor', '$idprofessorauxiliar', '$idtipodedisciplina', '$titulo', '$abreviatura', '$idturma2', '$idanolectivo', '$tipodedisciplina', '$agrupamento', 'obs')");
                               
                             if($salvar){

                               


                              $acerto[]="Disciplina $titulo da turma $turma foi Cadastrada com sucesso";

                          }else{

                            $erros[]="Ocorreu um erro Ao Cadastrar a disciplina $titulo da turma $turma ";

                          } 
                        }else{

                      $erros[]="Essa disciplina já existe na turma $turma ";
                    }



            }
            









  


            if ($idturma3!=0) {
            
                          $existe=mysqli_num_rows(mysqli_query($conexao, "select iddisciplina from disciplinas where titulo='$titulo' and idturma='$idturma3' and idtipodedisciplina='$idtipodedisciplina'"));

                          $turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from turmas where idturma='$idturma3'"))[0];
                    
                        if($existe==0){

                              $salvar= mysqli_query($conexao,"INSERT INTO `disciplinas` (`iddisciplina`, `idprofessor`, `idprofessorauxiliar`, `idtipodedisciplina`, `titulo`, `abreviatura`, `idturma`, `idanolectivo`, `tipodedisciplina`, `agrupamento`, `obs`) VALUES (NULL, '$idprofessor', '$idprofessorauxiliar', '$idtipodedisciplina', '$titulo', '$abreviatura', '$idturma3', '$idanolectivo', '$tipodedisciplina', '$agrupamento', 'obs')");
                               
                             if($salvar){

                               


                              $acerto[]="Disciplina $titulo da turma $turma foi Cadastrada com sucesso";

                          }else{

                            $erros[]="Ocorreu um erro Ao Cadastrar a disciplina $titulo da turma $turma ";

                          } 
                        }else{

                      $erros[]="Essa disciplina já existe na turma $turma ";
                    }



            }
            



    }  else{
    $erros[]=" O campo título não pode ir vazio";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista de disciplinas no ano lectivo (<?php echo $anolectivo_escolhido; ?>)</h1>
          <p class="mb-4">A seguir vai a lista de disciplinas disponíveis na instituição</p>
     
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

  <?php if($painellogado=="administrador" ||  $painellogado=="areapedagogica"){ ?>

        <button id="myBtn" class="btn btn-success">  <i class="fas fa-fw fa-plus"></i> Acrescentar uma nova disciplina</button>

    

<?php }else { ?>

<span id="myBtn"></span>

<?php  } ?>
  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

   <a href="categoriadedisciplinas.php"><button  class="btn btn-primary"> Ver Categorias de Disciplinas</button></a> 



    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>

                <h3>Cadastrando uma nova disciplina</h3> <br>
                  
                      
                      <div class="form-group">
                      <span>Disciplina de:</span>
                    <select id="idtipodedisciplina"  required  class="form-control"> 
                      <option value="0">Escolha uma Disciplina</option>
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from tipodedisciplinas order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idtipodedisciplina"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                <span id="dadosdadisciplina"></span>
                      
               
        </div>
    </div>


    <script type="text/javascript">
      
           var idtipodedisciplina=document.getElementById("idtipodedisciplina"); 


             idtipodedisciplina.addEventListener("change", function(){
    

                    var idtipodedisciplina=this.value;
                    var idanolectivo=<?php echo "$idanolectivo";?>;

                      if(idtipodedisciplina=='0'){

                         
                          var dadosdadisciplina=document.getElementById('dadosdadisciplina');
                            dadosdadisciplina.innerHTML='';

                      }else{


                         $.ajax({
                          url:"cadastro/pesquisartipodedisciplina.php",
                          method:"POST",
                          data:{idtipodedisciplina, idanolectivo},
                          success:function(data){

                          $("#dadosdadisciplina").html(data)
 

                          }
                        })


                      }
                    
                    
                    

               
                })
      
    </script>


    


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
              <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Disciplina</th>  
                      <th>Professor</th> 
                      <th>Auxiliar</th> 
                      <th>Tipo</th>  
                      <th>Classe</th> 
                      <th>Curso</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from disciplinas where idanolectivo='$idanolectivo'"); 
                         while($exibir = $lista->fetch_array()){

                           $iddisciplina=$exibir["iddisciplina"];

                           $idprofessor=$exibir["idprofessor"];
                           $idprofessorauxiliar=$exibir["idprofessorauxiliar"];

                           $Professor=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessor'"))[0];

                          $Professorauxiliar=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar'"))[0];


                           $idturma=$exibir["idturma"];

                           $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));

                            $idcurso=$dadosdaturma["idcurso"]; 
                           $idclasse=$dadosdaturma["idclasse"];

 
                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0]; 

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0]; 

                  ?>
                    <tr>  
                      <td> <a  href="disciplina.php?iddisciplina=<?php echo $exibir["iddisciplina"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td>  
                      <td><a  href="funcionario.php?idfuncionario=<?php echo $exibir["idprofessor"]; ?>"><?php echo $Professor; ?></a></td>
                      <td><a  href="funcionario.php?idfuncionario=<?php echo $exibir["idprofessorauxiliar"]; ?>"><?php echo $Professorauxiliar; ?></a></td>
                       <td><?php echo $exibir["tipodedisciplina"]; ?></td>  
                      <td><a  href="classe.php?idclasse=<?php echo $idclasse; ?>"><?php echo $classe; ?></a></td>  
                      <td><a  href="curso.php?idcurso=<?php echo $idcurso; ?>"><?php echo $curso; ?></a></td> 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

  
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