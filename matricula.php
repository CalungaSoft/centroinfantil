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

$idaluno=isset($_GET['idaluno'])?$_GET['idaluno']:"";
$idaluno=mysqli_escape_string($conexao, $idaluno); 

 
if(!($painellogado=="administrador" || $painellogado=="areapedagogica" || $painellogado=="secretaria1" || $painellogado=="secretaria2"  )){ 

    header('Location: login.php');
}

  $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));
                      

if(isset($_POST['cadastrar'])){
 
  if(!empty(trim($_GET['idaluno']))){ 
    
 
      $datadamatricula=mysqli_escape_string($conexao, trim($_POST['datadamatricula'])); 
      $idturma=mysqli_escape_string($conexao, trim($_POST['idturma'])); 
      $obsmatricula=mysqli_escape_string($conexao, trim($_POST['obsmatricula']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $tipodealuno=mysqli_escape_string($conexao, trim($_POST['tipodealuno']));
      $descontoparapropinas=mysqli_escape_string($conexao, trim($_POST['descontoparapropinas']));
 
      


                  $dadoslectivos= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                           $turma=$dadoslectivos["titulo"]; 
                           $idperiodo=$dadoslectivos["idperiodo"];
                           $idcurso=$dadoslectivos["idcurso"];
                           $idsala=$dadoslectivos["idsala"];
                           $idclasse=$dadoslectivos["idclasse"];
                           $idanolectivo=$dadoslectivos["idanolectivo"];

                           
                           $preco=mysqli_escape_string($conexao, trim($_POST['matricula'])); 
                           $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));  
                           $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago'])); 
                
                           
                            $divida=round($preco-$desconto-$valorpago,2); 
                            if($divida<0){$divida=0;}


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                   $existe=mysqli_num_rows(mysqli_query($conexao, "select idaluno from matriculaseconfirmacoes where idaluno='$idaluno' and idturma='$idturma'"));
  
                         if($existe==0){


                            $numero_de_processo=mysqli_fetch_array(mysqli_query($conexao, "select numerodeprocesso from alunos order by numerodeprocesso desc limit 1"))[0]+1;
          
                            $alterando_numero_de_processo=mysqli_query($conexao, "UPDATE `alunos` SET `numerodeprocesso` = '$numero_de_processo' WHERE `alunos`.`idaluno` = '$idaluno' and numerodeprocesso=0");

                           $salvar=mysqli_query($conexao,"INSERT INTO `matriculaseconfirmacoes` (`idmatriculaeconfirmacao`, `idaluno`, `idanolectivo`, `idturma`, `tipo`, `preco`, `desconto`, `valorpago`, `turma`, `sala`, `curso`, `periodo`, `classe`, data,obs, tipodealuno, descontoparapropinas) VALUES (NULL, '$idaluno', '$idanolectivo', '$idturma', 'Matrícula', '$preco', '$desconto', '$valorpago', '$turma', '$sala', '$curso', '$periodo', '$classe', STR_TO_DATE('$datadamatricula', '%d/%m/%Y'), '$obsmatricula',  '$tipodealuno', '$descontoparapropinas')");
                          

                          if($salvar){
                            
                              

                                 $idmatriculaeconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idaluno' order by idmatriculaeconfirmacao desc limit 1"))[0];
                      
                                 $descricao="Registro de Matrícula";
                                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Matrícula', '$idmatriculaeconfirmacao', '$valorpago', '$divida', '$idaluno', '$idturma', STR_TO_DATE('$datadamatricula', '%d/%m/%Y'), '$formadepagamento', '$idanolectivo')");

                                     $identrada=mysqli_fetch_array(mysqli_query($conexao, "SELECT identrada from  entradas where idaluno='$idaluno' and tipo='Matrícula' order by identrada desc limit 1"))[0]; 
                          

                                          if($salvar_financas){ 

                                            $datadehoje=Date("Y-m-d");

                                           $salvar=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET data='$datadehoje' WHERE data='0000-00-00'");
 

                                            $acerto[]="Matrícula Feita com Sucesso <br> <a class='btn btn-info' href='aluno.php?idaluno=".$idaluno."'> Click aqui para ver mais dados sobre esse aluno</a> | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer a matrícula do aluno | No Registro de financas";

                                          }

                                    

                                }else{

                                     $erros[]="Ocorreu um erro ao fazer a matrícula do aluno";
                                }
                        }else{

                                     $erros[]="Já existe uma matrícula desse aluno nessa turma";
                                }
   
   
          

 

  }
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }


   
   
   

}


include("cabecalho.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Matrícula do Aluno</h1>
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


                    

          <div class="row">

            <div class="col-lg-5">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Dados Pessoais</h6>
                </div>
                <div class="card-body">
                 <form class="user" action="" method="post">


                    <div class="form-group">
                      <input type="text" name="nomecompleto" disabled="" class="form-control " title="Digite o nome completo do aluno" placeholder="Nome do aluno" value="<?php echo $Dados_do_aluno['nomecompleto']; ?>" >
                    </div>

                    <div class="form-group">
                    <span>Nº de Processo</span>
                      <input type="text" name="numerodeprocesso" disabled=""  class="form-control"   placeholder="Número de processo do aluno"  value="<?php echo $Dados_do_aluno['numerodeprocesso']; ?>">
                    </div>

                    <div class="form-group">
                    <span>Nome do Pai</span>
                      <input type="text" name="nomedopai" disabled="" class="form-control " title="Digite o nome completo do Pai" placeholder="Nome do Pai" value="<?php echo $Dados_do_aluno['nomedopai']; ?>">
                    </div>
                    <div class="form-group">
                    <span>Nome da Mãe</span>
                      <input type="text" name="nomedamae" disabled="" class="form-control " title="Digite o nome completo do Mãe" placeholder="Nome do Mãe" value="<?php echo $Dados_do_aluno['nomedamae']; ?>">
                    </div>

 
                      <div class="form-group">
                      <span>Data de Nascimento</span>
                          <input type="text" name="datadenascimento" disabled=""  autocomplete="off" class="form-control js-datepicker" title="Digite data de nascimento"  value="<?php echo $Dados_do_aluno['datadenascimento']; ?>">
                      </div>

 
                    
                      <div class="form-group row">
                        <div class="col-sm-6">  
                          <span>Telefone do Aluno</span>
                                <input type="text" name="telefone" disabled="" class="form-control "  placeholder="Nº de telefone do aluno"  value="<?php echo $Dados_do_aluno['telefone']; ?>"> 
                        </div>
                        <div class="col-sm-6"> 
                        <span>Telefone dos Encarregados</span>
                             <input type="text" name="telefoneencarregado" disabled="" class="form-control "  placeholder="Nº dos Encarregados"  value="<?php echo $Dados_do_aluno['telefoneincarregados']; ?>"> 
                        </div> 
                    </div>


                    <div class="form-group">
                    <span>Morada</span>
                        <input type="text" name="morada" class="form-control " disabled="" title="Local onde mora o aluno" placeholder="Morada"  value="<?php echo $Dados_do_aluno['morada']; ?>">
                    </div>

                    

                    <div class="form-group">
                         <span>Observações sobre o aluno</span>
                        <textarea name="obs"   class="form-control " disabled="" title="Alguma observação?" >
                          <?php echo $Dados_do_aluno['obs']; ?> 
                        </textarea>
                    </div>


                   
                   

                   

                </div>
              </div>

            

            </div>

            <div class="col-lg-7">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Matrícula</h6>
                </div>
                <div class="card-body">


                

                     

                    <span>Ano Lectivo</span>
                    <div class="form-group">
                    <select name="idanolectivo"  id="anolectivo" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option <?php if($exibir["vigor"]=='Sim'){ echo "selected";} ?> value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div>


<?php
 
 $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim' limit 1"))[0];
      
?>

                <span id="turmasdinamicas">
                    <span>Turma</span>
                    <div class="form-group">
                    <select name="turma" id='turma' required  class="form-control">
                        <option value="0">Escolha a Turma</option> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from turmas where idanolectivo='$anolectivo' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idturma"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div>
                </span>



                <span id="dadoslectivos"></span>
                 







 

                 
 
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
              
              var anolectivo=document.getElementById("anolectivo");
              var turma=document.getElementById("turma"); 


             turma.addEventListener("change", function(){
    

                    var idturma=this.value;

                      if(idturma=='0'){

                         
                          var dadoslectivos=document.getElementById('dadoslectivos');
                            dadoslectivos.innerHTML='';

                      }else{


                         $.ajax({
                          url:"cadastro/pesquisarturma.php",
                          method:"POST",
                          data:{idturma},
                          success:function(data){

                          $("#dadoslectivos").html(data)
 

                          }
                        })


                      }
                    
                    
                    

               
                })
      

             anolectivo.addEventListener("change", function(){
    
                    var idanolectivo=this.value;
                     $.ajax({
                          url:"cadastro/pesquisaranolectivo.php",
                          method:"POST",
                          data:{idanolectivo},
                          success:function(data){

                          $("#turmasdinamicas").html(data)
                          var dadoslectivos=document.getElementById('dadoslectivos');
                            dadoslectivos.innerHTML='';

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
