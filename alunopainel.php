<?php 
include("conexao.php");


session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedoalunologado'];

$nomelogado = $_SESSION['nomedoalunologado'];
$painellogado = $_SESSION['painel'];

$idalunologado = $_SESSION['idalunologado'];

if (!($painellogado == "aluno")) {
  header('Location: login.php');
}

$idaluno=$idalunologado;
$idmatriculaeconfirmacao=isset($_GET['idmatriculaeconfirmacao'])?$_GET['idmatriculaeconfirmacao']:"0";
 
 if($idmatriculaeconfirmacao==0){

       $idmatriculaeconfirmacao_fora= mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idaluno' order by idmatriculaeconfirmacao desc limit 1"))[0];


 
  }else{

     $dados_da_matriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

      $idaluno=$dados_da_matriculaeconfirmacao["idaluno"];
      $idanolectivo=$dados_da_matriculaeconfirmacao["idanolectivo"];
      $idanolectivo_selecionado=$dados_da_matriculaeconfirmacao["idanolectivo"];

     $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

       $anolectivo_selecionado=$dadosdoanolectivo["titulo"];

       $idmatriculaeconfirmacao_fora=$idmatriculaeconfirmacao;
  }

   if(!isset($_GET["idmatriculaeconfirmacao"])){

      $idmatriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idaluno' order by idmatriculaeconfirmacao desc limit 1"))[0];



     $dados_da_matriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

      $idaluno=$dados_da_matriculaeconfirmacao["idaluno"];
      $idanolectivo=$dados_da_matriculaeconfirmacao["idanolectivo"];
      $idanolectivo_selecionado=$dados_da_matriculaeconfirmacao["idanolectivo"];

     $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

       $anolectivo_selecionado=$dadosdoanolectivo["titulo"];

       $idmatriculaeconfirmacao_fora=$idmatriculaeconfirmacao;
  }

  
         include("cabecalhoaluno.php") ; ?>

<style>
  .student-container {
    position: relative;
    width: 200px;
    height: 200px;
    border: 1px solid #ccc;
  }

  /* Estilo para a imagem dentro da div */
  .student-image {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: auto;
    width: auto;
    height: 100%;

    opacity: 0.3;
  }

  
        /* Estilo para o botão */
        .modal-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Estilo para o modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 3;
            justify-content: center;
            align-items: center;
        }

        /* Estilo para a imagem no modal */
        .modal-image {
            max-width: 90%;
            max-height: 90%;
        }

        /* Estilo para fechar o modal */
        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }
</style>


<?php
                                   
                  $dadosdoaluno= mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1")); 
 
                           
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados do aluno <a   href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"] ; ?>"><?php echo $dadosdoaluno["nomecompleto"] ; ?></a>   <?php if($idmatriculaeconfirmacao!=0){ echo "( $anolectivo_selecionado )"; }?>  </h1>
     
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



                   
          <?php  include("estilocarde.php"); ?>
 
 

                  <br> <br>

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
                                <div class="student-image">
                  <img src="upload/<?php echo $dadosdoaluno['caminhodafoto'];?>" alt="Imagem do Estudante" class="student-image">
                </div>
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
 

                                            Naturalidade: <strong> <?php echo $dadosdoaluno["naturalidade"]; ?> </strong> <br>

                                            Nacionalidade: <strong> <?php echo $dadosdoaluno["nacionalidade"]; ?> </strong> <br>

                                            Província de: <strong> <?php echo $dadosdoaluno["provincia"]; ?> </strong> <br> <hr> <br>
                                            Nº do B.I. ou Cédula: <strong> <?php echo $dadosdoaluno["numerodobioucedula"]; ?> </strong> <br>

                                            Arquivo de Identificação : <strong> <?php echo $dadosdoaluno["arquivodeidentificacao"]; ?> </strong> <br>

                                            Data de Expiração: <strong> <?php echo $dadosdoaluno["datadeexpiracaodobi"]; ?> </strong> <br>

                                            <hr> <br>

                                           Deficiência: <strong> <?php echo $dadosdoaluno["deficiencia"]; ?> </strong> <br>
  
                                           Profissão: <strong> <?php echo $dadosdoaluno["profissao"]; ?> </strong> <br>

                                           Religião: <strong> <?php echo $dadosdoaluno["religiao"]; ?> </strong> <br>



                                          <button id="myBtnfoto" class="btn btn-primary">Ver foto</button>

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

                                             Nº de Telefone : <strong> <?php echo $dadosdoaluno["telefone"]; ?> </strong> <br>

                                            Email: <strong> <?php echo $dadosdoaluno["email"]; ?> </strong> <br>

                                             Morada: <strong> <?php echo $dadosdoaluno["morada"]; ?> </strong> <br>

                                          
 
                                             Nome do Encarregado: <strong> <?php echo $dadosdoaluno["nomedoencarregado"]; ?> </strong> <br>

                                            Telefone do Encarregado: <strong> <?php echo $dadosdoaluno["telefoneincarregados"]; ?> </strong> <br>
 
                                            


                                            <?php
  

                                             if(!isset($_GET['idaluno'])){   
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo_selecionado'"));

                                              }else{

                                              $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where vigor='Sim'"));
                                             }
                                             ?>

                                             <hr> <br>
                                            Ano Lectivo
                                          <h3><strong> <?php echo $anolectivo["titulo"]; ?> </strong></h3>
                                            <?php

                                             $idanolectivo=$anolectivo["idanolectivo"];

                                              $matriculasdesseano= mysqli_query($conexao, "select * from matriculaseconfirmacoes where idaluno='$idaluno' and idanolectivo='$idanolectivo'");


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
                                                  Turma:  <?php echo $turma; ?> <br> 

                                                  Período:  <?php echo $periodo; ?> <br>

                                                    Sala:  <?php echo $sala; ?> 

                                                    <?php if($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2"){ ?>

                                                     

                                                      <?php } ?>

                                                       <?php if ($exibir["tipodealuno"]=="Bolseiro") {
                                                          echo "  <strong>Aluno Bolseiro</strong>";
                                                       } ?>


                                                    <hr> <hr>                                               <?php 
                                              }

                                              
                                            ?> <br><br>
                                          <span id="mensagemdealertamatricula"></span>
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



                 
      </div></div>
      <!-- End of Main Content -->
 
      <div id="myModalfoto" class="modal">
    <div class="modal-content">
      <span id="closefoto"> &times;</span>

      


      <img src="upload/<?php echo $dadosdoaluno['caminhodafoto'];?>" alt="Imagem do Estudante"  >

      


      <script>
    var btn = document.getElementById("myBtn");
    var btnreclamacoes = document.getElementById("myBtnreclamacoes");
   
    var botaorelatorio = document.getElementById("relatoriodoaluno");

    var modal = document.getElementById("myModal");
    var modalreclamacoes = document.getElementById("myModalreclamacoes");
  
    var relatorio = document.getElementById("relatorio");



    var span = document.getElementById("close");
    var spanreclamacoes = document.getElementById("closereclamacoes");
    


    var btnfoto = document.getElementById("myBtnfoto");
    var modalfoto = document.getElementById("myModalfoto");
    var spanfoto = document.getElementById("closefoto");

    window.onclick = (event) => {
      if (event.target == modalfoto) {
        modalfoto.style.display = "none";
      }
    }

    btnfoto.addEventListener("click", () => {
      modalfoto.style.display = "block";
    })

    spanfoto.addEventListener("click", () => {
      modalfoto.style.display = "none";
    })

    



    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }



    window.onclick = (event) => {
      if (event.target == relatorio) {
        relatorio.style.display = "none";
      }
    }



    window.onclick = (event) => {
      if (event.target == modalreclamacoes) {
        modalreclamacoes.style.display = "none";
      }
    }

   

    btn.addEventListener("click", () => {
      modal.style.display = "block";
    })

    botaorelatorio.addEventListener("click", () => {
      relatorio.style.display = "block";
    })





    span.addEventListener("click", () => {
      modal.style.display = "none";
    })

    relatoriofechar.addEventListener("click", () => {
      relatorio.style.display = "none";
    })

    spanreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "none";
    })




    btnreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "block";
    })

    spanreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "none";
    })
  </script>

        <br><br>
    </div>
  </div>
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
