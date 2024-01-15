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

 

 
$idmatriculaeconfirmacao=isset($_GET['idmatriculaeconfirmacao'])?$_GET['idmatriculaeconfirmacao']:"";
    $idaluno=mysqli_fetch_array(mysqli_query($conexao, "select idaluno from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' order by idaluno desc limit 1"))[0];
                      
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
  $tipodealuno=mysqli_escape_string($conexao, trim($_POST['tipodealuno']));  
  $escoladeorigem=mysqli_escape_string($conexao, trim($_POST['escoladeorigem'])); 
  $anodeentrada=mysqli_escape_string($conexao, trim($_POST['anodeentrada']));


            

               
  $obs=mysqli_escape_string($conexao, trim($_POST['obs']));
    
    $existe=mysqli_num_rows(mysqli_query($conexao, "select idaluno from alunos where nomecompleto='$nomecompleto'"));
  
      if($existe==0){

  $salvar=mysqli_query($conexao,"INSERT INTO `alunos` (`idaluno`, `nomecompleto`, `sexo`, `nomedopai`, `nomedamae`, `naturalidade`, `nacionalidade`, `provincia`, `numerodobioucedula`, `arquivodeidentificacao`, `deficiencia`, `escoladeorigem`, `telefone`, `telefoneincarregados`, `profissao`, `email`, `anodeentrada`, `datadenascimento`, `datadeexpiracaodobi`, `numerodeprocesso`, `tipodealuno`, `morada`, `religiao`, `nomedoencarregado`, `datadecadastro`, `estatus`, `obs`) VALUES (NULL, '$nomecompleto', '$sexo', '$nomedopai', '$nomedamae', '$naturalidade', '$nacionalidade', '$provincia', '$numerodobioucedula', '$arquivodeidentificacao', '$deficiencia', '$escoladeorigem', '$telefone', '$telefoneencarregado', '$profissao', '$email', '$anodeentrada', STR_TO_DATE('$datadenascimento', '%d/%m/%Y'),  STR_TO_DATE('$datadeexpiracao', '%d/%m/%Y'), '$numerodeprocesso', '$tipodealuno', '$morada', '$religiao', '$encarregado', CURRENT_TIMESTAMP, 'activo', '$obs')");


   
   
          if($salvar){


              $idaluno=mysqli_fetch_array(mysqli_query($conexao, "select idaluno from alunos where nomecompleto='$nomecompleto' order by idaluno desc limit 1"))[0];
                      


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


        include("cabecalho.php") ; ?>

<?php
                                   
                  $dadosdoaluno= mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1")); 
 
                           
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados do aluno</h1>
     
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



          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do aluno</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">aluno</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"] ; ?>"><?php echo $dadosdoaluno["nomecompleto"] ; ?></a></div> <br>

                                            Sexo: <strong> <?php echo $dadosdoaluno["sexo"]; ?> </strong> <br>

                                            Nome do Pai: <strong> <?php echo $dadosdoaluno["nomedopai"]; ?> </strong> <br>

                                            Nome da Mãe: <strong> <?php echo $dadosdoaluno["nomedamae"]; ?> </strong> <br>

                                            Data de Nascimento: <strong> <?php echo $dadosdoaluno["datadenascimento"]; ?> </strong> <br>
  
                                            Nº do B.I. ou Cédula: <strong> <?php echo $dadosdoaluno["numerodobioucedula"]; ?> </strong> <br>
  

                                            <hr> <br>

                                           Deficiência: <strong> <?php echo $dadosdoaluno["deficiencia"]; ?> </strong> <br>
  
                                           Profissão: <strong> <?php echo $dadosdoaluno["profissao"]; ?> </strong> <br>
 
                                             Nº de Telefone : <strong> <?php echo $dadosdoaluno["telefone"]; ?> </strong> <br>

                                            Email: <strong> <?php echo $dadosdoaluno["email"]; ?> </strong> <br>

                                             Morada: <strong> <?php echo $dadosdoaluno["morada"]; ?> </strong> <br>

                                          
 
                                             Nome do Encarregado: <strong> <?php echo $dadosdoaluno["nomedoencarregado"]; ?> </strong> <br>

                                            Telefone do Encarregado: <strong> <?php echo $dadosdoaluno["telefoneincarregados"]; ?> </strong> <br>

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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outros Dados</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1">  <br>
                                        

                                         Número de processo: <strong> <?php echo $dadosdoaluno["numerodeprocesso"]; ?> </strong> <br>

                                            Escola de Origem: <strong> <?php echo $dadosdoaluno["escoladeorigem"]; ?> </strong> <br>

                                            Ano de Entrada na instituição: <strong> <?php echo $dadosdoaluno["anodeentrada"]; ?> </strong> <br>
  
                                            Data de Cadastro no sistema: <strong> <?php echo $dadosdoaluno["datadecadastro"]; ?> </strong> <br>

                                            OBS: <strong> <?php echo $dadosdoaluno["obs"]; ?> </strong> <br> <hr> <br>

 
                                            <hr> <br>
                                            Ano Lectivo
                                          <h3><strong> <?php echo $anolectivo["titulo"]; ?> </strong></h3>


                                            <?php
 
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where vigor='Sim'"));

                                             $idanolectivo=$anolectivo["idanolectivo"];

                                              $matriculasdesseano= mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'");

                                              while($exibir = $matriculasdesseano->fetch_array()){

                                                    $idturma=$exibir["idturma"];
                                           $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                                               $turma=$dadosdaturma["titulo"]; 
                                               $idperiodo=$dadosdaturma["idperiodo"];
                                               $idsala=$dadosdaturma["idsala"];
                                               
                                               $propina=$dadosdaturma["propina"];

                                             $tipo=$exibir["tipo"];                                              
                                             $preco=number_format($exibir["preco"],2,",", ".");
                                             $desconto=number_format($exibir["desconto"],2,",", ".");
                                             $valorpago=number_format($exibir["valorpago"],2,",", ".");
                                             $divida=number_format($exibir["preco"]-$exibir["desconto"]-$exibir["valorpago"],2,",", ".");
                     


                                               $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                                              
                                                $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                                              
                                                ?>
                                                  <hr> <hr>
                                                  Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a><br>
 
                                                  Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                                                    Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a>

                                                       <?php if ($exibir["tipodealuno"]=="Bolseiro") {
                                                          echo "  <strong>Aluno Bolseiro</strong>";
                                                       } ?>


                                                    <hr> <hr>                                               <?php 
                                              }

                                              if (mysqli_num_rows($matriculasdesseano)==0) {
                                                  echo "<div class='alert alert-info'>Esse aluno não fez a Matrícula para esse ano!</div>";
                                              }
                                            ?> <br><br>
                                          
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
              <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                   
                   
                   
                     <a href="pdf/pdfconsultass.php" id="pauta" class="d-sm-inline-block btn btn-sm btn-success"><i class="fas fa-fw fa-print"></i> Pauta</a> 
                  
                    <a href=""  id="minipauta" class="d-sm-inline-block btn btn-sm btn-secondary" ><i class="fas fa-fw fa-print"></i> Mini-Pauta </a> 
 
                  <a href="turmafinanca.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-calendar"></i> Faltas </a> 

 

                  <a href="turmafinanca.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-danger" ><i class="fas fa-fw fa-book"></i> Cadeira em atraso </a> 

                  <a href="turmafinanca.php?idturma=<?php echo $idturma; ?>" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-money"></i> Finanças </a> 

<br>
 <br>
              <span id="mensagemdealerta"></span> 
              <h2>Histórico de Propinas</h2>
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>    
                      <th>Mês Pago</th> 
                      <th>Preço</th>
                      <th>Multa</th> 
                      <th>Desconto</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Código</th> 
                      <th>Data</th> 
                      <th>Ver Mais</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      
 

                              $lista=mysqli_query($conexao, "SELECT   YEAR(propinas.mespago) as ano, MONTH(propinas.mespago) as mes, matriculaseconfirmacoes.*, propinas.* from matriculaseconfirmacoes, propinas  where propinas.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao'");
                                

                              

                         while($exibir = $lista->fetch_array()){


                          $anoactual=date('Y');
                          $mespago=$exibir['mes'];
                     if($exibir['mes']==1){
                          $mespago="Janeiro";
                          if($exibir['ano']!=$anoactual){
                            $mespago="Janeiro/".$exibir['ano']."";
                          }
                     }else  if($exibir['mes']==2){
                        $mespago="Fevereiro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Fevereiro/".$exibir['ano']."";
                        }
                    }else  if($exibir['mes']==3){
                        $mespago="Março";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Março/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==4){
                        $mespago="Abril";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Abril/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==5){
                        $mespago="Maio";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Maio/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==6){
                        $mespago="Junho";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Junho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==7){
                        $mespago="Julho";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Julho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==8){
                        $mespago="Agosto";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Agosto/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==9){
                        $mespago="Setembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Setembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==10){
                        $mespago="Outubro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Outubro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==11){
                        $mespago="Novembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Novembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==12){
                        $mespago="Dezembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Dezembro/".$exibir['ano']."";
                        }
                    } 



                    $divida_n=round(($exibir['preco']+$exibir['multa']-$exibir['valorpago']-$exibir['desconto']),2);
 

                  ?>
                    <tr>  
                      <td><?php echo $mespago; ?></td>  
                      <td  title="<?php  $preco=number_format($exibir["preco"],2,",", "."); echo $preco; ?>"><?php echo $exibir['preco']; ?></td>
                      <td title="<?php  $multa=number_format($exibir["multa"],2,",", "."); echo $multa; ?>"><?php echo $exibir['multa']; ?></td>
                      <td title="<?php  $desconto=number_format($exibir["desconto"],2,",", "."); echo $desconto; ?>"><?php echo $exibir['desconto']; ?></td>
                      <td  title="<?php  $valorpago=number_format($exibir["valorpago"],2,",", "."); echo $valorpago; ?>"><?php echo $exibir['valorpago']; ?></td>
                      <td title="<?php  $divida=number_format($divida_n,2,",", "."); echo $divida; ?>"><?php echo $divida_n; ?></td>
                      <td><?php echo $exibir['codigodepropina']; ?></td>
                      <td><?php echo $exibir['datadopagamento']; ?></td>
                      <td align="center" title="Veja mais opções">
                         <a  href="propina.php?idpropina=<?php echo $exibir["idpropina"]; ?>"><i  class="fas fa-eye" ></i> </a>
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
