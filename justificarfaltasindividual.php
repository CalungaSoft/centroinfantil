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

$idmatricula=isset($_GET['idmatricula'])?$_GET['idmatricula']:"";
$idmatricula=mysqli_escape_string($conexao, $idmatricula); 

if($idmatricula==0){
  
  $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculas where idmatricula='$idmatricula' limit 1"));

     
      $idaluno=isset($_GET['idaluno'])?$_GET['idaluno']:"";
      $idaluno=mysqli_escape_string($conexao, $idaluno); 
      $idanolectivo=0;

    }else{

       $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculas where idmatricula='$idmatricula' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno'];
      $idanolectivo=$dadoslectivos_confirmacao['idanolectivo'];


    }
  
    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));
 

$titulo_do_ano_lectivo=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0]; 
        
 
                      

if(isset($_POST['cadastrar'])){
 
  if(!empty(trim($idaluno))){ 
    
 
      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $idfalta=mysqli_escape_string($conexao, trim($_POST['idfalta']));
      $quantidadedefalta=1;
 
      
 
          $preco_novo=$preco*$quantidadedefalta;
                           
                            $divida=round($preco_novo-$valorpago,2); 
                            if($divida<0){$divida=0;}

  

                           $salvar=mysqli_query($conexao,"UPDATE `faltas` SET pago='1' WHERE `faltas`.`idfalta` ='$idfalta'");
                          

                          if($salvar){
                            
                              

                                 $dadosdafalta=mysqli_fetch_array(mysqli_query($conexao, "select * from faltas where idfalta='$idfalta' limit 1"));
 
 
                                 $idmatricula=$dadosdafalta["idmatricula"]; 
                                 $iddisciplina=$dadosdafalta["iddisciplina"];
                                 $diadafalta=$dadosdafalta["data"];
 
                                 $nomedadisciplina=mysqli_fetch_array(mysqli_query($conexao, "select titulo from disciplinas where iddisciplina='$iddisciplina' limit 1"))[0];

                                 $dadosda_r=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculas where idmatricula='$idmatricula' limit 1"));

                                  $idturma=$dadosda_r["idturma"];
                                  $idanolectivo=$dadosda_r["idanolectivo"];
 
 

                      
                                 $descricao="Justificação de $quantidadedefalta Faltas de $nomedadisciplina do $diadafalta";

                                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Justificação de Faltas', '$idfalta', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");

                                 $identrada=mysqli_fetch_array(mysqli_query($conexao, "SELECT identrada from  entradas where idaluno='$idaluno' and tipo='Justificação de Faltas' order by identrada desc limit 1"))[0]; 
                          

                                          if($salvar_financas){  

                                            $acerto[]="Justificação de Faltas Feita com Sucesso <br> <a class='btn btn-info' href='aluno.php?idaluno=".$idaluno."'> Click aqui para ver mais dados sobre esse aluno</a> | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a> "; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer a Justificação de Faltas do aluno | No Registro de financas";

                                          }

                                    

                                }else{

                                     $erros[]="Ocorreu um erro ao fazer a Justificação de Faltas do aluno";
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
          <h1 class="h3 mb-4 text-gray-800">Justificação de Faltas do Aluno | <a href="alunoanolectivo.php?idmatricula=<?php echo $idmatricula; ?>"> <?php echo $Dados_do_aluno['nomecompleto']; ?> </a></h1>

          
           <div class="alert alert-info">

             <h4> Dados Lectivos</h4> 
             Ano Lectivo: <strong><?php echo "$titulo_do_ano_lectivo" ?></strong> | Turma: <strong><?php echo "$dadoslectivos_confirmacao[turma]" ?></strong> <br>
              
                 Período: <strong><?php echo "$dadoslectivos_confirmacao[periodo]" ?></strong>
              | Sala: <strong><?php echo "$dadoslectivos_confirmacao[sala]" ?></strong>



           </div>


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
                  <h6 class="m-0 font-weight-bold text-primary">Justificação de Faltas</h6>
                </div>
                <div class="card-body">
 
                <span id="turmasdinamicas">
                    <span>Disciplina</span>
                    <div class="form-group">
                    <select name="turma" id='turma' required  class="form-control">
                        <option value="0" >Escolha a Disciplina</option> 
                     <?php
                        $lista = mysqli_query($conexao, "SELECT faltas.falta, faltas.idfalta, disciplinas.titulo, disciplinas.iddisciplina, faltas.data FROM disciplinas, faltas WHERE faltas.iddisciplina = disciplinas.iddisciplina AND faltas.idmatricula = '$idmatricula' AND (falta='F' OR falta='f') and pago!='1' ORDER BY titulo DESC");
                        
                        while ($exibir = $lista->fetch_array()) { 
                            $dataFormatada = date("d/m/Y", strtotime($exibir["data"]));
                        ?>
                            <option value="<?php echo $exibir["idfalta"]; ?>"><?php echo $exibir["titulo"]; ?> (<?php echo $dataFormatada; ?>) </option>
                        <?php
                        }
                        ?>
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
    

                    var idfalta=this.value;

                      if(idfalta=='0'){

                         
                          var dadoslectivos=document.getElementById('dadoslectivos');
                            dadoslectivos.innerHTML='';

                      }else{


                         $.ajax({
                          url:"cadastro/pesquisafalta.php",
                          method:"POST",
                          data:{idfalta},
                          success:function(data){

                          $("#dadoslectivos").html(data)
 

                          }
                        })


                      }
                    
                    
                    

               
                })
      

             anolectivo.addEventListener("change", function(){
    
                    var idanolectivo=this.value;
                     $.ajax({
                          url:"cadastro/pesquisaranolectivosimples.php",
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
            <span>Copyright &copy; CalungaSOFT 2023</span>
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
