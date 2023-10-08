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

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

 
    $idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo); 

   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

if(isset($_POST['cadastrar'])){
  
  if(!empty(trim($_POST['idmatriculatransporte']))){ 
   
      $idmatriculatransporte=mysqli_escape_string($conexao,$_POST['idmatriculatransporte']); 
      $mes=mysqli_escape_string($conexao,$_POST['mes']); 
      $ano=mysqli_escape_string($conexao,$_POST['ano']); 
      $preco=mysqli_escape_string($conexao,$_POST['preco']); 
      $multa=mysqli_escape_string($conexao,$_POST['multa']); 
      $desconto=mysqli_escape_string($conexao,$_POST['desconto']); 
      $valorpago=mysqli_escape_string($conexao,$_POST['valorpago']);
      $obs=mysqli_escape_string($conexao,$_POST['obs']); 
      $formadepagamento=mysqli_escape_string($conexao,$_POST['formadepagamento']);

      $referencia=mysqli_escape_string($conexao,trim($_POST['referencia']));
      $datadedeposito=mysqli_escape_string($conexao,$_POST['datadedeposito']);

            $divida=round($preco+$multa-$desconto-$valorpago,2); 
            if($divida<0){$divida=0;}


   $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "SELECT matriculatransporte.* from matriculatransporte where idmatriculatransporte='$idmatriculatransporte' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno']; 
      $idtransporte=$dadoslectivos_confirmacao['idtransporte']; 


            $mes_pago="$ano-$mes-01";

            $proximo_idnaspropinas=mysqli_fetch_array(mysqli_query($conexao, "select idpropinadotransporte from propinasdotransporte order by idpropinadotransporte desc limit 1"))[0]+1;
            $numero_aleatorio=rand(10000, 99000);
 
      
            $codigodepropina="CDP".$idaluno."$proximo_idnaspropinas/$numero_aleatorio";

        $existe=mysqli_num_rows(mysqli_query($conexao, "select idpropinadotransporte from propinasdotransporte where idmatriculatransporte='$idmatriculatransporte' and mespago='$mes_pago' limit 1"));

      $jaExisteEsseCodigo=mysqli_fetch_array(mysqli_query($conexao, "select idpropinadotransporte from propinasdotransporte where  referencia='$referencia' and referencia!='' limit 1"))[0];

        if($jaExisteEsseCodigo==''){
      
          if($existe==0){

                $salvar= mysqli_query($conexao,"INSERT INTO `propinasdotransporte` (`idpropinadotransporte`, `idaluno`, `idmatriculatransporte`, `preco`, `multa`, `valorpago`, `desconto`, `mespago`, `datadopagamento`, `obs`, `codigodepropina`, idanolectivo, referencia,datadedeposito) VALUES ('$proximo_idnaspropinas', '$idaluno', '$idmatriculatransporte', '$preco', '$multa', '$valorpago', '$desconto', '$mes_pago', CURRENT_TIMESTAMP, '$obs', '$codigodepropina', '$idanolectivo', '$referencia', STR_TO_DATE('$datadedeposito', '%d/%m/%Y'))");

                 
               if($salvar){

                $ultimopagamento="1/".$mes."/".$ano."";
          
  
                $salvar2=mysqli_query($conexao,"UPDATE `matriculatransporte` SET `ultimomespago` = STR_TO_DATE('$ultimopagamento', '%d/%m/%Y') WHERE `matriculatransporte`.`idmatriculatransporte` = '$idmatriculatransporte' and ultimomespago<STR_TO_DATE('$ultimopagamento', '%d/%m/%Y')");

                          $descricao="Registro de Mensalidade do transporte de $mes/$ano (Ref: $referencia )";
                                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Mensalidade do transporte', '$proximo_idnaspropinas', '$valorpago', '$divida', '$idaluno', '0', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");


                                          if($salvar_financas){

                                $identrada_para_recibo=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas order by identrada desc limit 1"))[0];
          

                                              if(mysqli_num_rows(mysqli_query($conexao,"SELECT identrada FROM `entradas` where YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and idanolectivo='$idanolectivo'"))==0){

                                                   $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', 'Controlo', 'Outras', '0', '0', 0, '$mes_pago', '', '$idanolectivo')");

                                              }


 
                                               $acerto[]="Registro de pagamento de mensalidade ($codigodepropina) feito com sucesso!<br>  <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada_para_recibo."'> Click aqui se quiseres imprimir recibo </a>  "; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o Pagamento de propina do aluno | No Registro de financas";

                                          }

               

            }else{

              $erros[]="Ocorreu um erro Ao registrar o pagamento de propina";

            } 
          }else{

        $erros[]="Esse Aluno já pagou a mensalidade de $ano/$mes nessa turma";
      }

    }else {

        $erros[]="Esse código de mensalidade já exite! <a href='entradapropina.php?idpropina=$jaExisteEsseCodigo'> Clique aqui para ver</a>";
    }



    }  else{
    $erros[]="Nenhum estudante escolhido";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista Para Pagamento de propinas do transporte(<?php echo $anolectivo_escolhido; ?>)</h1>  
          <p>A seguir vai a lista dos alunos matriculados no transporte, escolha quem veio pagar propina</p> <br>
     
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
                      <th>transporte</th> 
                      <th>Último Mês</th> 
                      <th>Pagar</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "SELECT alunos.nomecompleto, YEAR(matriculatransporte.ultimomespago) as ano, MONTH(matriculatransporte.ultimomespago) as mes, matriculatransporte.* from matriculatransporte, alunos where matriculatransporte.idaluno=alunos.idaluno and matriculatransporte.idanolectivo='$idanolectivo'"); 

                         while($exibir = $lista->fetch_array()){

                          $anoactual=date('Y');
                          $ultimopagamento=$exibir['mes'];
                     if($exibir['mes']==1){
                          $ultimopagamento="Janeiro";
                          if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Janeiro/".$exibir['ano']."";
                          }
                     }else  if($exibir['mes']==2){
                        $ultimopagamento="Fevereiro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Fevereiro/".$exibir['ano']."";
                        }
                    }else  if($exibir['mes']==3){
                        $ultimopagamento="Março";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Março/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==4){
                        $ultimopagamento="Abril";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Abril/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==5){
                        $ultimopagamento="Maio";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Maio/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==6){
                        $ultimopagamento="Junho";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Junho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==7){
                        $ultimopagamento="Julho";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Julho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==8){
                        $ultimopagamento="Agosto";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Agosto/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==9){
                        $ultimopagamento="Setembro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Setembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==10){
                        $ultimopagamento="Outubro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Outubro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==11){
                        $ultimopagamento="Novembro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Novembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==12){
                        $ultimopagamento="Dezembro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Dezembro/".$exibir['ano']."";
                        }
                    } 
                    
                    if($exibir["estatus"]!="activo"){
                      $estatus="($exibir[estatus])";

                    }else{
                      $estatus="";
                    }

                  ?>
                    <tr>  
                        <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?>  </a> <?php echo $estatus; ?></td> 
 
                      <td><?php echo $exibir['transporte']; ?></td> 
                      <td><?php echo $ultimopagamento; ?></td> 

                      <td align="center" title="Pagar propina desse aluno">
                         <a class="pagarpropina" data-id="<?php echo $exibir['idmatriculatransporte']; ?>"  href=""> <button class="btn btn-success"> <i  class="fas fa-donate" ></i> </button> </a>
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
                    var btn=document.getElementsByClassName("pagarpropina");
                    var modal=document.getElementById("myModal");

                      

                    var span=document.getElementById("close");

                    $(document).on("click",  ".pagarpropina", function(event){
                              event.preventDefault(); 
                              
                              modal.style.display="block"; 
                              var id=$(this).data('id')
                              
                               
                                            $.ajax({
                              url:'cadastro/pagarpropinadotransporte.php',
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