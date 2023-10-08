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

 
 
if(isset($_POST['cadastrar'])){
  
  $nomedofuncionario=mysqli_escape_string($conexao, $_POST['nomedofuncionario']);

  if(!empty(trim($nomedofuncionario))){

    
      $proveniencia=mysqli_escape_string($conexao, $_POST['proveniencia']);
      $categoria=mysqli_escape_string($conexao, $_POST['categoria']);
      $telefone=mysqli_escape_string($conexao, $_POST['telefone']);
      $localizacao=mysqli_escape_string($conexao, $_POST['localizacao']);
      $naturalidade=mysqli_escape_string($conexao, $_POST['naturalidade']);
      $habilitacoesliteraria=mysqli_escape_string($conexao, $_POST['habilitacoesliteraria']);
      $contabancaria=mysqli_escape_string($conexao, $_POST['contabancaria']);
      $datadeentrada=mysqli_escape_string($conexao, $_POST['datadeentrada']);
 
      $salario=mysqli_escape_string($conexao, $_POST['salario']);
      $numerodedias=mysqli_escape_string($conexao, $_POST['numerodedias']);
      $numerodehoras=mysqli_escape_string($conexao, $_POST['numerodehoras']);

 
 

       

        $salarioporhora=round(($salario/$numerodedias)/$numerodehoras);
  
              if(mysqli_num_rows(mysqli_query($conexao," SELECT idfuncionario FROM funcionarios where nomedofuncionario='$nomedofuncionario'"))==0){ 

                $guardar=mysqli_query($conexao,"INSERT INTO `funcionarios` (`idfuncionario`, `nomedofuncionario`, `categoria`, `telefone`, `localizacao`, `naturalidade`, `proveniencia`, `habilitacoesliterarias`, `contabancaria`, `datadeentrada`, `salario`, `datadeentradanosistema`, `salarioporhora`, `numerodedias`, `numerodehoras`, `estatus`) VALUES (NULL, '$nomedofuncionario', '$categoria', '$telefone', '$localizacao', '$naturalidade', '$proveniencia', '$habilitacoesliteraria', '$contabancaria', STR_TO_DATE('$datadeentrada', '%d/%m/%Y'), '$salario', CURRENT_TIMESTAMP, '$salarioporhora', '$numerodedias', '$numerodehoras', 'activo')");
                
                if($guardar){
          
                  $acertos[]="Funcionário Cadastrado com Sucesso! ";
                    
                }else{
                  $erros[]="Ocorreu um erro ao cadastrar o funcionário!";
                    
                }


              }else{
                $erros[]="Já Existe um funcionário como esse nome";
              }

    
 
    }else{
      $erros[]="O nome do funcionário não pode estar vazio";
    }
}

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Professores</h1>
          <p class="mb-4">Abaixo vai a lista de todos os Professores da Instituição.</p>

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


            
 


<script>


 


                      $(document).on("blur",  "#salariobase", function(event){
                        
                        var salario=$("#salariobase").val();
                          var dias=$("#numerodedias").val();
                          var horas=$("#numerodehoras").val(); 
                            
                             var x=((salario/dias)/horas);
                          var salarioporhora=Math.round(x);
                          $("#salarioporhora").val(salarioporhora);
                  
                      }) 

                      $(document).on("blur",  "#numerodedias", function(event){
                        
                        var salario=$("#salariobase").val();
                          var dias=$("#numerodedias").val();
                          var horas=$("#numerodehoras").val(); 
                            
                             var x=((salario/dias)/horas);
                          var salarioporhora=Math.round(x);
                          $("#salarioporhora").val(salarioporhora);
                  
                      }) 
                      $(document).on("blur",  "#numerodehoras", function(event){
                        
                        var salario=$("#salariobase").val();
                          var dias=$("#numerodedias").val();
                          var horas=$("#numerodehoras").val(); 
                            var x=((salario/dias)/horas);
                          var salarioporhora=Math.round(x);
                          $("#salarioporhora").val(salarioporhora);
                  
                      }) 


</script>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Funcionários</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php 

                    $htm='  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Disciplina</th>  
                      <th>Professor</th> 
                      <th>Auxiliar</th> 
                      <th>Tipo</th>  
                      <th>Classe</th> 
                      <th>Curso</th> 
                      <th>Ver Mais</th>
                    </tr>
                  </thead>
                  <tbody>
                  ';
                        $lista=mysqli_query($conexao, "select * from disciplinas"); 
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

                   $htm.='
                    <tr>  
                      <td> <a  href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'"> '.$exibir['titulo'].' </a></td>  
                      <td><a  href="funcionario.php?idfuncionario='.$exibir["idprofessor"].'">'.$Professor.'</a></td>
                      <td><a  href="funcionario.php?idfuncionario='.$exibir["idprofessorauxiliar"].'">'.$Professorauxiliar.'</a></td>
                       <td>'.$exibir["tipodedisciplina"].'</td>  
                      <td><a  href="classe.php?idclasse='.$idclasse.'">'.$classe.'</a></td>  
                      <td><a  href="curso.php?idcurso='.$idcurso.'">'.$curso.'</a></td>      
                      <td align="center" title="Veja mais opções sobre esse disciplina">
                         <a  href="disciplina.php?iddisciplina='.$exibir["iddisciplina"].'" '.$exibir["iddisciplina"].'><i  class="fas fa-eye" ></i> </a>
                      </td>
                    </tr> 
                    '; } $htm.='
                  </tbody>
                </table>';

                echo "$htm";
                ?>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php  include("estilocarde.php"); ?>

      <div id="myModal2" class="modal"  >
    <div class="modal-content">
      <span id="close2">&times;</span>
      <div id="formularioresposta"></div>
    </div>
</div>



      <script>
                   
                    var modal2=document.getElementById("myModal2");

                    var span2=document.getElementById("close2");

                    $(document).on("click",  ".vender", function(event){
                              event.preventDefault(); 
                              
                              modal2.style.display="block"; 
                              var id=$(this).data('id')
                              
                               
                                            $.ajax({
                                              url:'cadastro/verpostosdosfuncionarios.php',
                                              method:'POST',
                                              data: {
                                                id: id  
                                            },
                                              success:function(data){ 
                                                $('#formularioresposta').html(data);  
                                              }
                                            })

         
                            })
                            
                    span2.addEventListener("click", ()=>{
                      modal2.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modal2){
                          modal2.style.display="none";
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
