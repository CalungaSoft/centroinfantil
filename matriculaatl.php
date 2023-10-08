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

$idmatriculaeconfirmacao=isset($_GET['idmatriculaeconfirmacao'])?$_GET['idmatriculaeconfirmacao']:"0";
$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $idmatriculaeconfirmacao); 

 

if($idmatriculaeconfirmacao==0){
  
  $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

     
      $idaluno=isset($_GET['idaluno'])?$_GET['idaluno']:"";
      $idaluno=mysqli_escape_string($conexao, $idaluno); 
      $idanolectivo=0;

    }else{

       $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno'];
      $idanolectivo=$dadoslectivos_confirmacao['idanolectivo'];


    }
  
    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));
 

$titulo_do_ano_lectivo=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0];
        
 
                      

if(isset($_POST['cadastrar'])){
 
  if(!empty(trim($idaluno))){ 
    
 
      $datadamatricula=mysqli_escape_string($conexao, trim($_POST['datadamatricula'])); 
      $idatl=mysqli_escape_string($conexao, trim($_POST['idatl'])); 
      $obamatricula=mysqli_escape_string($conexao, trim($_POST['obsmatricula']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
       $descontoparapropinas=mysqli_escape_string($conexao, trim($_POST['descontoparapropinas']));
 
       $tipodealuno=mysqli_escape_string($conexao, trim($_POST['tipodealuno']));
 


                  $dadoslectivos= mysqli_fetch_array(mysqli_query($conexao, "select * from atl where idatl='$idatl' limit 1")); 

                           $atl=$dadoslectivos["titulo"];  
                           $idanolectivo=$dadoslectivos["idanolectivo"];

                           
                           $preco=mysqli_escape_string($conexao, trim($_POST['matricula']));
                           $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));  
                           $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago'])); 
                
                           
                            $divida=round($preco-$desconto-$valorpago,2); 
                            if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select idaluno from matriculaatl where idaluno='$idaluno' and idatl='$idatl'"));
  
                         if($existe==0){


                          

                           $salvar=mysqli_query($conexao,"INSERT INTO `matriculaatl` (`idmatriculaatl`, `idaluno`, `idanolectivo`, `idatl`,   `preco`, `desconto`, `valorpago`, `atl`, data,obs, tipodealuno, descontoparapropinas) VALUES (NULL, '$idaluno', '$idanolectivo', '$idatl',   '$preco', '$desconto', '$valorpago', '$atl',   STR_TO_DATE('$datadamatricula', '%d/%m/%Y'), '$obamatricula', '$tipodealuno', '$descontoparapropinas')");
                          
                     $datadehoje=Date("Y-m-d");

                                           $salvar=mysqli_query($conexao,"UPDATE `matriculaatl` SET data='$datadehoje' WHERE data='0000-00-00'");

                          if($salvar){

 
                                         $numero_de_processo=mysqli_fetch_array(mysqli_query($conexao, "select numerodeprocesso from alunos order by numerodeprocesso desc limit 1"))[0]+1;
          
                                         $alterando_numero_de_processo=mysqli_query($conexao, "UPDATE `alunos` SET `numerodeprocesso` = '$numero_de_processo' WHERE `alunos`.`idaluno` = '$idaluno' and numerodeprocesso=0");


                                 $idmatriculaatl=mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaatl from matriculaatl where idaluno='$idaluno' order by idmatriculaatl desc limit 1"))[0];
                      
                                 $descricao="Registro de Matrículo no ATL";
                                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Matrícula ATL', '$idmatriculaatl', '$valorpago', '$divida', '$idaluno', '0', STR_TO_DATE('$datadamatricula', '%d/%m/%Y'), '$formadepagamento', '$idanolectivo')");

                                      $identrada=mysqli_fetch_array(mysqli_query($conexao, "SELECT identrada from  entradas where idaluno='$idaluno' order by identrada desc limit 1"))[0]; 
                          
                          

                                          if($salvar_financas){  



                                            $acerto[]="Matrícula Feita com Sucesso <br> <a class='btn btn-info' href='aluno.php?idaluno=".$idaluno."'> Click aqui para ver mais dados sobre esse aluno</a> | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer a Matrícula do aluno | No Registro de finanças";

                                          }

                                    

                                }else{

                                     $erros[]="Ocorreu um erro ao fazer a Matrícula do aluno";
                                }
                        }else{

                                     $erros[]="Já existe uma Matrícula desse aluno nesse ATL";
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
          <h1 class="h3 mb-4 text-gray-800">Matricula aluno no ATL ( <a href="aluno.php?idaluno=<?php echo $idaluno; ?>"> <?php echo $Dados_do_aluno['nomecompleto']; ?> </a>)</h1>
       


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

                <span id="atldinamicas">
                    <span>ATL</span>
                    <div class="form-group">
                    <select name="atl" id='escolheatl' required  class="form-control">
                        <option value="0">Escolha o ATL</option> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from atl where idanolectivo='$anolectivo' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idatl"]; ?>"><?php echo $exibir["titulo"]; ?></option>
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
              var escolheatl=document.getElementById("escolheatl"); 


            
              escolheatl.addEventListener("change", function(){
    
                    var idatl=this.value;
 
                      if(idatl=='0'){

                         
                          var dadoslectivos=document.getElementById('dadoslectivos');
                            dadoslectivos.innerHTML='';

                      }else{


                         $.ajax({
                          url:"cadastro/pesquisaratl.php",
                          method:"POST",
                          data:{idatl},
                          success:function(data){

                          $("#dadoslectivos").html(data)
 

                          }
                        })


                      }
                    
                    
                    

               
                })
       

             anolectivo.addEventListener("change", function(){
    
                    var idanolectivo=this.value;
                     $.ajax({
                          url:"cadastro/pesquisaranolectivoalt.php",
                          method:"POST",
                          data:{idanolectivo},
                          success:function(data){

                          $("#atldinamicas").html(data)
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
