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
   
      $titulo=mysqli_escape_string($conexao,$_POST['titulo']);
      $idanolectivo=mysqli_escape_string($conexao,$_POST['idanolectivo']); 
      $matricula=mysqli_escape_string($conexao,$_POST['matricula']);
      $descricao=mysqli_escape_string($conexao,$_POST['descricao']);
      $propina=mysqli_escape_string($conexao,$_POST['propina']); 
     
        $existe=mysqli_num_rows(mysqli_query($conexao, "select idactividade from actividades where titulo='$titulo' and idanolectivo='$idanolectivo'"));
      
          if($existe==0){
 
 
                                                


                $salvar= mysqli_query($conexao,"INSERT INTO `actividades` (titulo, idanolectivo, matricula, descricao, propina) VALUES ('$titulo', '$idanolectivo', '$matricula', '$descricao', '$propina')");
                 
               if($salvar){

                $acerto[]="Actividade $titulo foi Cadastrado com sucesso";

            }else{

              $erros[]="Ocorreu um erro Ao Cadastrar a Actividade";

            } 
          }else{

        $erros[]="Essa Actividade já existe";
      }

    }  else{
    $erros[]=" O campo título não pode ir vazio";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista de Actividades extras curriculares no ano lectivo (<?php echo $anolectivo_escolhido; ?>)</h1>
          <p class="mb-4">A seguir vai a lista de Actividades extras curriculares disponíveis na instituição</p>
     
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
   <button id="myBtn" class="btn btn-success">  <i class="fas fa-fw fa-plus"></i> Acrescentar um novo ATL</button>

 

<?php }else { ?>

<span id="myBtn"></span>
<?php  } ?>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="post" action=""> 
                <h3>Cadastrando um novo ATL</h3> <br>
                    <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select * from actividades"); 
                        
                          ?>
                      <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control"  placeholder="Título para o actividade extra curricular" required="">
                      <datalist id="datalist2">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 

                    


                    <div class="form-group">
                         <span>Descrição</span>
                        <textarea name="descricao" rows="2" class="form-control " title="Descreva a actividade" ></textarea>
                    </div>

                    <div class="form-group row">
                     <div class="col-sm-4">  
                                    <select name="idanolectivo" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                        <?php } ?> 
                                    </select> 
                                       
                        </div> 
                            <div class="col-sm-4"> 
                                        <?php

                                        $lista=mysqli_query($conexao, "SELECT distinct(matricula) from actividades"); 
                                
                                ?>
                            <input type="number" name="matricula" min="0" autocomplete="off" list="listamatricula" class="form-control"  placeholder="Preço da Matrícula" required="">
                            <datalist id="listamatricula">
                                <?php  while($exibir = $lista->fetch_array()){ ?>
                                <option value="<?php echo $exibir['matricula']; ?>"> 
                                <?php } ?>
                            </datalist>
                                       
                        </div> 
                                <div class="col-sm-4">  
                                    <?php

                                        $lista=mysqli_query($conexao, "SELECT distinct(propina) from actividades"); 
                                
                                ?>
                            <input type="number" name="propina" min="0" autocomplete="off" list="listapropina" class="form-control"  placeholder="Preço da Propina" required="">
                            <datalist id="listapropina">
                                <?php  while($exibir = $lista->fetch_array()){ ?>
                                <option value="<?php echo $exibir['propina']; ?>"> 
                                <?php } ?>
                            </datalist>
                                 </div> 
                    </div>
 
                     
                    <br>
                       <input type="submit" name="cadastrar" value="Dar abertura a nova actividade extra curricular" class="btn btn-success" style="float: rigth;">
                    
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
              <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Actividade</th> 
                      <th>Descrição</th> 
                      <th>Nº de Alunos</th> 
                      <th>Ver Mais</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from actividades where idanolectivo='$idanolectivo'"); 
                         while($exibir = $lista->fetch_array()){

                           $idactividade=$exibir["idactividade"]; 

                            
                            $alunos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaactividades where idactividade='$idactividade' and idanolectivo='$idanolectivo' and matriculaactividades.estatus='activo'"));

                  ?>
                    <tr>  
                      <td> <a  href="actividade.php?idactividade=<?php echo $exibir["idactividade"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td> 
                      <td>  <?php echo $exibir['descricao']; ?>  </td> 

                       <td><?php echo $alunos; ?></td>  
                      <td align="center" title="Veja mais opções sobre esse actividade">
                         <a  href="actividade.php?idactividade=<?php echo $exibir["idactividade"]; ?>" <?php echo $exibir["idactividade"]; ?>><i  class="fas fa-eye" ></i> </a>
                      </td>
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
            <span>Copyright &copy; CalungaSOFT 2022</span>
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