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

 if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2" || $painellogado=="areapedagogica")){ 

    header('Location: login.php');
}


    $idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo); 

   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

if(isset($_POST['cadastrar'])){
   
  if(!empty(trim($_POST['idaluno']))){ 
   
      $idmatriculaeconfirmacao=mysqli_escape_string($conexao,$_POST['idmatriculaeconfirmacao']); 
      $idaluno=mysqli_escape_string($conexao,$_POST['idaluno']); 
      $tipo=mysqli_escape_string($conexao,$_POST['tipo']);   
      $descricao=mysqli_escape_string($conexao,$_POST['descricao']); 
      $data=mysqli_escape_string($conexao,$_POST['data']); 

        $existe=mysqli_num_rows(mysqli_query($conexao, "select iddescadastrado from descadastrados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipo='$tipo'"));
      
          if($existe==0){

                $salvar= mysqli_query($conexao,"INSERT INTO `descadastrados` (`iddescadastrado`, `idaluno`, `idmatriculaeconfirmacao`, `tipo`, `descricao`, `data`) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipo', '$descricao', STR_TO_DATE('$data', '%d/%m/%Y'))");
                 
               if($salvar){


                $salvar2=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `estatus` = '$tipo' WHERE `matriculaseconfirmacoes`.`idmatriculaeconfirmacao` = '$idmatriculaeconfirmacao' limit 1");

                $acerto[]="O Estudante foi Descadastrado com sucesso";

            }else{

              $erros[]="Ocorreu um erro Ao decadastrar o estudante";

            } 
          }else{

        $erros[]="O Estudante já se encontra descadastrado com o motivo $tipo";
      }

    }  else{
    $erros[]=" Nenhum Estudante selecionado";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Descadastrando Alunos (<?php echo $anolectivo_escolhido; ?>)</h1> <br>
     
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
   

  <button id="myBtnreclamacoes" class="btn btn-primary" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

    


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
                     var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                     var modalreclamacoes=document.getElementById("myModalreclamacoes");
                     var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                   
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
                      <th>Nome Completo</th>
                      <th>Tipo</th>
                      <th>Turma</th> 
                      <th>Periodo</th>  
                      <th>Status</th>
                      <th>Data</th>
                      <th>Descadastrar</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idanolectivo='$idanolectivo'"); 

                         while($exibir = $lista->fetch_array()){

                          $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 

                      <td><?php echo $exibir['tipo']; ?></td>
                      <td><?php echo $exibir['turma']; ?></td> 
                      <td><?php echo $exibir['periodo']; ?></td> 
                      <td><?php echo $exibir['estatus']; ?></td>
                      <td><?php echo $exibir['data']; ?></td>

                      <td align="center" title="Mudar o estatus do aluno">
                         <a  href="" class="descadastrar" data-id="<?php echo $exibir['idmatriculaeconfirmacao']; ?>" > <button class="btn btn-danger"> <i  class="fas fa-user" ></i> <sup><i  class="fas fa-trash" ></i></sup> </button> </a>
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

 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <div id="formularioresposta"></div>
        </div>
    </div>
    
      <script>
                    var btn=document.getElementsByClassName("descadastrar");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                    $(document).on("click",  ".descadastrar", function(event){
                              event.preventDefault(); 
                              
                              modal.style.display="block"; 
                              var id=$(this).data('id')
                              
                               
                                            $.ajax({
                              url:'cadastro/descadastrar.php',
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