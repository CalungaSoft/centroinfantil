<?php 
include("conexao.php"); 
$salvar="";

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

$erros=[];

if(isset($_POST['cadastrar'])){
 
  if(!empty(trim($_POST['nomecompleto']))){ 
   
  $nomecompleto=mysqli_escape_string($conexao, trim($_POST['nomecompleto'])); 
  $nomedopai=mysqli_escape_string($conexao, trim($_POST['nomedopai'])); 
  $nomedamae=mysqli_escape_string($conexao, trim($_POST['nomedamae'])); 
  $encarregado=mysqli_escape_string($conexao, trim($_POST['encarregado']));  
  $sexo=mysqli_escape_string($conexao, trim($_POST['sexo']));  
  $datadenascimento=mysqli_escape_string($conexao, trim($_POST['datadenascimento'])); 
  $nacionalidade=mysqli_escape_string($conexao, trim($_POST['nacionalidade']));  
  $naturalidade=mysqli_escape_string($conexao, trim($_POST['naturalidade'])); 
  $provincia=mysqli_escape_string($conexao, trim($_POST['provincia'])); 
  $numerodobioucedula=mysqli_escape_string($conexao, trim($_POST['numerodobioucedula'])); 
  $datadeexpiracao=mysqli_escape_string($conexao, trim($_POST['datadeexpiracao']));
  $arquivodeidentificacao=mysqli_escape_string($conexao, trim($_POST['arquivodeidentificacao'])); 
  $telefone=mysqli_escape_string($conexao, trim($_POST['telefone']));
  $telefoneencarregado=mysqli_escape_string($conexao, trim($_POST['telefoneencarregado']));
  $morada=mysqli_escape_string($conexao, trim($_POST['morada'])); 
  $deficiencia=mysqli_escape_string($conexao, trim($_POST['deficiencia'])); 
  $profissao=mysqli_escape_string($conexao, trim($_POST['profissao'])); 
  $email=mysqli_escape_string($conexao, trim($_POST['email']));  
  $religiao=mysqli_escape_string($conexao, trim($_POST['religiao'])); 




  $numerodeprocesso=mysqli_escape_string($conexao, trim($_POST['numerodeprocesso']));    
  $escoladeorigem=mysqli_escape_string($conexao, trim($_POST['escoladeorigem'])); 
  $anodeentrada=mysqli_escape_string($conexao, trim($_POST['anodeentrada']));


            

               
  $obs=mysqli_escape_string($conexao, trim($_POST['obs']));
    
    $existe=mysqli_num_rows(mysqli_query($conexao, "select idaluno from alunos where nomecompleto='$nomecompleto'"));
  
      if($existe==0){

  $salvar=mysqli_query($conexao,"INSERT INTO `alunos` (`idaluno`, `nomecompleto`, `sexo`, `nomedopai`, `nomedamae`, `naturalidade`, `nacionalidade`, `provincia`, `numerodobioucedula`, `arquivodeidentificacao`, `deficiencia`, `escoladeorigem`, `telefone`, `telefoneincarregados`, `profissao`, `email`, `anodeentrada`, `datadenascimento`, `datadeexpiracaodobi`, `numerodeprocesso`,  `morada`, `religiao`, `nomedoencarregado`, `datadecadastro`, `estatus`, `obs`) VALUES (NULL, '$nomecompleto', '$sexo', '$nomedopai', '$nomedamae', '$naturalidade', '$nacionalidade', '$provincia', '$numerodobioucedula', '$arquivodeidentificacao', '$deficiencia', '$escoladeorigem', '$telefone', '$telefoneencarregado', '$profissao', '$email', '$anodeentrada', STR_TO_DATE('$datadenascimento', '%d/%m/%Y'),  STR_TO_DATE('$datadeexpiracao', '%d/%m/%Y'), 0, '$morada', '$religiao', '$encarregado', CURRENT_TIMESTAMP, 'activo', '$obs')");


   
   
          if($salvar){


              $idaluno=mysqli_fetch_array(mysqli_query($conexao, "select idaluno from alunos where nomecompleto='$nomecompleto' order by idaluno desc limit 1"))[0];
                      
  $numero_de_processo=mysqli_fetch_array(mysqli_query($conexao, "select numerodeprocesso from alunos order by numerodeprocesso desc limit 1"))[0]+1;
          
          $alterando_numero_de_processo=mysqli_query($conexao, "UPDATE `alunos` SET `numerodeprocesso` = '$numero_de_processo' WHERE `alunos`.`idaluno` = '$idaluno' and numerodeprocesso=0");

                      header("Location: matricula.php?idaluno=$idaluno");

             


        }else{

          $erros[]="Ocorreu um erro Ao Cadastrar o(a) aluno(a)";

        } 

  }
  else{
    $erros[]="Já existe um aluno com esse nome";
  }


  }else{
    $erros[]=" O campo nome completo não pode ir vazio";
  }
   
   

}


include("cabecalho.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Cadastramento do Aluno</h1>
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


                     <a href="escolheralunorematricula.php" class="btn  btn-info shadow-sm" style="float: right;"><i class="fas fa-user fa-sm text-white-50"></i> Rematricular  aluno que já está no sistema</a> <br><br><br> 


          <div class="row">

            <div class="col-lg-6">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Dados Pessoais</h6>
                </div>
                <div class="card-body">
                 <form class="user" action="" method="post">


                    <div class="form-group">
                      <input type="text" name="nomecompleto" class="form-control " title="Digite o nome completo do aluno" placeholder="Nome do aluno" required="">
                    </div>


                     <div class="form-group">
                              <select name="sexo"  class="form-control" title="Escolha o genero do aluno"  > 
                                     <option disabled="">Sexo</option>
                                     <option value="Masculino">Masculino</option>
                                     <option value="Femenino">Femenino</option>
                              </select> 
                     </div>


                    <div class="form-group">
                      <input type="text" name="nomedopai"  id="nomedopai" class="form-control " title="Digite o nome completo do Pai" placeholder="Nome do Pai" >
                    </div>
                    <div class="form-group">
                      <input type="text" name="nomedamae" class="form-control " title="Digite o nome completo do Mãe" placeholder="Nome do Mãe" >
                    </div>

                  


                   

                      <div class="form-group">
                          <input type="text" name="datadenascimento" autocomplete="off" class="form-control js-datepicker" title="Digite data de nascimento" placeholder="Data de Nascimento">
                      </div>


                       <div class="form-group row">
                        <div class="col-sm-6">
                          <span>Nacionalidade</span>
                           <input type="text" name="nacionalidade" class="form-control" placeholder="Nacionalidade" value="Angolana">
                        </div>
                        <div class="col-sm-6">
                             <span>Naturalidade</span>
                             <input type="text" name="naturalidade" class="form-control" placeholder="Naturalidade">
                        </div> 
                    </div>

                    <div class="form-group">
                        <span>Província de:</span>
                        <input type="text" name="provincia" class="form-control " title="Digite a Província onde o estudante nasceu"  placeholder="Província">
                    </div>

                    
                   

                    <div class="form-group row">
                        <div class="col-sm-6">  
                                <input type="text" name="numerodobioucedula" class="form-control " title="Digite o Número do B.I. ou Cédula Pessoal" placeholder="Número do B.I. ou Cédula "> 
                        </div>
                        <div class="col-sm-6"> 
                             <input type="text" name="datadeexpiracao" autocomplete="off" class="form-control js-datepicker" title="Digite Data de Expiração do B.I." placeholder="Data de Expiração do B.I.">
                        </div> 
                    </div>

                    <div class="form-group">
                    <span>Passado pelo arquivo de identificação de:</span>
                      <input type="text" name="arquivodeidentificacao" class="form-control "  placeholder="Passado pelo arquivo de identificação de:" value="Luanda">
                    </div>

                    

                    <div class="form-group">
                        <input type="text" name="morada" class="form-control " title="Local onde mora o aluno" placeholder="Morada">
                    </div>

                    <div class="form-group">
                      <input type="text" name="deficiencia" class="form-control " title="O Estudante Apresenta alguma deficiencia física ou psicomotora?" placeholder="Deficiência">
                    </div>



                    <div class="form-group">
                      <input type="text" name="profissao" class="form-control " title="Digite o Profissão" placeholder="Profissão">
                    </div>

               

                    <div class="form-group">
                        <input type="email" name="email" class="form-control " title="Digite o email do cliente" placeholder="Email">
                    </div>

                    
                    <div class="form-group">
                      <span>Crença Religiona</span>
                        <input type="text" name="religiao" class="form-control " title="Aqui Religião ou igreja pertence o aluno" placeholder="Religião / Igreja">
                    </div>
                    

                    

                </div>
              </div>

            

            </div>

            <div class="col-lg-6">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Dados Lectivos</h6>
                </div>
                <div class="card-body">

                      <div class="form-group">
                          <span>Encarregado de Educação</span>
                          <input type="text" name="encarregado" id="encarregado" class="form-control " title="Digite o nome completo do Encarregado de Educação" placeholder="Encarregado de Educação" >
                    </div>

                      <div class="form-group row">
                        <div class="col-sm-6">  
                                <input type="text" name="telefone" class="form-control "  placeholder="Nº de telefone do aluno"> 
                        </div>
                        <div class="col-sm-6"> 
                             <input type="text" name="telefoneencarregado" class="form-control "  placeholder="Nº dos Encarregados"> 
                        </div> 
                    </div>



                    <div class="form-group">
                      <input type="text" name="numerodeprocesso" class="form-control"   placeholder="Número de processo do aluno">
                    </div>

                     
                   

                    <div class="form-group">
                        <input type="text" name="escoladeorigem" class="form-control " title="Nome da Escola de Onde vem" placeholder="Escola de Origem">
                    </div>
                   

                    <div class="form-group">
                      <?php $ano=date("Y"); ?>
                      <span>Ano de Entrada na Instituição</span>
                      <input type="number" name="anodeentrada" class="form-control"   placeholder="Ano em que entrou na instituição" value="<?php echo "$ano"; ?>">
                    </div>

                    <div class="form-group">
                         <span>Observações sobre o aluno</span>
                        <textarea name="obs" rows="3" class="form-control " title="Alguma observação?" ></textarea>
                    </div>
 
  
   <br>
                    <input type="submit" name="cadastrar"  value="Cadastrar aluno" class="btn btn-success" style="float: rigth;">

                       



 

                 
 
                </div>

                 </form>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



            <script>
              
              var encarregado=document.getElementById("encarregado");
              var nomedopai=document.getElementById("nomedopai"); 


             nomedopai.addEventListener("change", function(){
    
                    var nomedopai=this.value;
                      
                    encarregado.value=nomedopai;

               
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
