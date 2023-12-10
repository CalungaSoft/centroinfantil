<?php include("conexao.php");



session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];


$idanolectivo = isset($_GET['idanolectivo']) ? $_GET['idanolectivo'] : "";
$idanolectivo = mysqli_escape_string($conexao, $idanolectivo);


if (!($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2")) {

  header('Location: login.php');
}

if (isset($_POST['cadastrar'])) {

  if (!empty(trim($_POST['mes']))) {

    $mes = mysqli_escape_string($conexao,  $_POST['mes']);
    $ano = mysqli_escape_string($conexao,  $_POST['ano']);
    $idanolectivo = mysqli_escape_string($conexao,  $_POST['idanolectivo']);
    $semanas = mysqli_escape_string($conexao,  $_POST['semanas']);
    $descricao = mysqli_escape_string($conexao,  $_POST['descricao']);
    $actividades = mysqli_escape_string($conexao,  $_POST['actividades']);
    $objectivo = mysqli_escape_string($conexao,  $_POST['objectivo']);
    $participantes = mysqli_escape_string($conexao,  $_POST['participantes']);
    $temas = mysqli_escape_string($conexao,  $_POST['temas']);
    $materiais = mysqli_escape_string($conexao,  $_POST['materiais']);
   
  
  

    $planoanual = mysqli_num_rows(mysqli_query($conexao, "SELECT id FROM planoanual where descricao='$descricao' and mes='$mes' and ano='$ano' and idanolectivo='$idanolectivo'"));

    if ($planoanual == 0) {
 
        $salvar = mysqli_query($conexao, "INSERT INTO `planoanual` (`id`, `ano`, `mes`, `idanolectivo`, `descricao`, `semanas`, `temas`, `actividades`, `objectivo`, `participantes`, `materiais`) VALUES (NULL, '$ano', '$mes', '$idanolectivo', '$descricao', '$semanas', '$temas', '$actividades', '$objectivo', '$participantes', '$materiais')");

        

      if ($salvar) {

        $acerto[] = "Plano anual para $mes/$ano Criado com sucesso";
      } else {
        $erros[] = "Ocorreu um erro Ao cadastrar o  plano, tente novamente";
      }
    } else {
      $erros[] = "Já Existe um plano para $mes/$ano";
    }
  } else {
    $erros[] = "Um mês deve ser selecionado";
  }
}




include("cabecalho.php"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">






  <?php

$anolectivo= mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0]; 
 

  ?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Plano Anual <a href="anolectivo.php?idanolectivo=<?php   echo "$idanolectivo"; ?>"><?php   echo "$anolectivo"; ?> </a> </h1> <br>
 
 <?php
  if (!empty($erros)) :
    foreach ($erros as $erros) :
      echo '<div class="alert alert-danger">' . $erros . '</div>';
    endforeach;
  endif;
  ?>
  <?php
  if (!empty($acerto)) :
    foreach ($acerto as $acerto) :
      echo '<div class="alert alert-success">' . $acerto . '</div>';
    endforeach;
  endif;
  ?>

  <?php include("estilocarde.php"); ?>
  <button id="myBtn" class="btn btn-primary">Escolher outro ano lectivo</button>

  
    <button id="myBtnreclamacoes" class="btn btn-info">Cadastrar Plano Anual</button>
 
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
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



  <div id="myModalreclamacoes" class="modal">
    <div class="modal-content">
      <span id="closereclamacoes"> &times;</span>
      <form class="user" method="post" action="">
        <h2>Cadastrar plano anual mês por mês</h2>
        <span style="font-size: 11px"> </span>

        <br> 

        <div class="form-group">
            <span>Ano Lectivo</span>
                    <select name="idanolectivo" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                    <div class="form-group row">
                        <div class="col-sm-5">
                        <span>Ano</span>
                            <select name="ano" required class="form-control">
                            <?php

                            $ano = date('Y');
                            $lista = mysqli_query($conexao, "SELECT DISTINCT(YEAR(datadaentrada)) as ano from entradas order by YEAR(datadaentrada) desc");

                            while ($exibir = $lista->fetch_array()) {

                                $ano = $exibir["ano"];
                            ?>
                                <option <?php if (date('Y') == $exibir["ano"]) { ?> selected="" <?php } ?> value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                            <?php } ?>
                            <option <?php if (date('Y') == $ano + 1) { ?> selected="" <?php } ?> value="<?php echo $ano + 1; ?>"><?php echo $ano + 1; ?></option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                                 <span>Mês</span>
                                <select name="mes" class="form-control">
                                <option <?php $mesactual = date('m');
                                        if ($mesactual == 1) { ?> selected="" <?php } ?> value="01">Janeiro</option>
                                <option <?php if ($mesactual == 2) { ?> selected="" <?php } ?> value="02">Fevereiro</option>
                                <option <?php if ($mesactual == 3) { ?> selected="" <?php } ?> value="03">Marco</option>
                                <option <?php if ($mesactual == 4) { ?> selected="" <?php } ?> value="04">Abril</option>
                                <option <?php if ($mesactual == 5) { ?> selected="" <?php } ?> value="05">Maio</option>
                                <option <?php if ($mesactual == 6) { ?> selected="" <?php } ?> value="06">Junho</option>
                                <option <?php if ($mesactual == 7) { ?> selected="" <?php } ?> value="07">Julho</option>
                                <option <?php if ($mesactual == 8) { ?> selected="" <?php } ?> value="08">Agosto</option>
                                <option <?php if ($mesactual == 9) { ?> selected="" <?php } ?> value="09">Setembro</option>
                                <option <?php if ($mesactual == 10) { ?> selected="" <?php } ?> value="10">Outubro</option>
                                <option <?php if ($mesactual == 11) { ?> selected="" <?php } ?> value="11">Novembro</option>
                                <option <?php if ($mesactual == 12) { ?> selected="" <?php } ?> value="12">Dezembro</option>
                                </select>
                            
                        </div> 
                        <div class="col-sm-2">
                        <span>Semanas</span>
                             <select name="semanas" class="form-control"> 
                                <option   value="01">1</option>
                                <option  value="02">2</option>
                                <option  value="03">3</option>
                                <option selected=""    value="04">4</option>
                                <option  value="05">5</option> 
                            </select>
                        </div>
                    </div>

  

                    <div class="form-group">
                    <span>Descrição Geral</span>
                      <textarea name="descricao" id="" cols="30" rows="4" class="form-control" ></textarea>
                    </div> 

                    <div class="form-group">
                    <span>Temas</span>
                      <textarea name="temas" id="" cols="30" rows="4" class="form-control" ></textarea>
                    </div> 


                    <div class="form-group">
                    <span>Actividades</span>
                      <textarea name="actividades" id="" cols="30" rows="4" class="form-control" ></textarea>
                    </div> 


                    <div class="form-group">
                    <span>Objectivos</span>
                      <textarea name="objectivo" id="" cols="30" rows="4" class="form-control" ></textarea>
                    </div> 

                    <div class="form-group">
                    <span>Participantes</span>
                      <textarea name="participantes" id="" cols="30" rows="4" class="form-control" ></textarea>
                    </div> 

                    <div class="form-group">
                    <span>Materiais</span>
                      <textarea name="materiais" id="" cols="30" rows="4" class="form-control" ></textarea>
                    </div> 






          <br>
          <input type="submit" name="cadastrar" value="Fazer Ementa Mensal" class="btn btn-primary" style="float: rigth;">

      </form>
    </div>
  </div>


  <script>
    var btn = document.getElementById("myBtn");
    var btnreclamacoes = document.getElementById("myBtnreclamacoes");

    var modal = document.getElementById("myModal");
    var modalreclamacoes = document.getElementById("myModalreclamacoes");

    var span = document.getElementById("close");
    var spanreclamacoes = document.getElementById("closereclamacoes");

    btn.addEventListener("click", () => {
      modal.style.display = "block";
    })
    span.addEventListener("click", () => {
      modal.style.display = "none";
    })
    window.onclick = (event) => {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    btnreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "block";
    })
    spanreclamacoes.addEventListener("click", () => {
      modalreclamacoes.style.display = "none";
    })
    window.onclick = (event) => {
      if (event.target == modalreclamacoes) {
        modalreclamacoes.style.display = "none";
      }
    }
  </script>

  <br><br>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabela </h6>
    </div>
    <div class="card-body">

    <span id="mensagemdealerta"></span>

      <div class="table-responsive"> 

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                        <th>Ver Plano</th>
                      <th>Ano</th> 
                      <th>Mês</th>
                      <th>Descrição</th> 
                      <th>Semanas</th>
                      <th>Temas</th>
                      <th>Actividades</th>
                      <th>Objectivo</th>
                      <th>Participantes</th>
                      <th>Materiais</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "SELECT * FROM planoanual where idanolectivo='$idanolectivo'"); 
                         while($exibir = $lista->fetch_array()){

                            if ($exibir["mes"]==1) {
                               $mes="Janeiro";
                            }else if ($exibir["mes"]==2) {
                                $mes="Fevereiro";
                             }else if ($exibir["mes"]==3) {
                                $mes="Março";
                             }else if ($exibir["mes"]==4) {
                                $mes="Abril";
                             }else if ($exibir["mes"]==5) {
                                $mes="Maio";
                             }else if ($exibir["mes"]==6) {
                                $mes="Junho";
                             }else if ($exibir["mes"]==7) {
                                $mes="Julho";
                             }else if ($exibir["mes"]==8) {
                                $mes="Agosto";
                             }else if ($exibir["mes"]==9) {
                                $mes="Setembro";
                             }else if ($exibir["mes"]==10) {
                                $mes="Outubro";
                             }else if ($exibir["mes"]==11) {
                                $mes="Novembro";
                             }else if ($exibir["mes"]==12) {
                                $mes="Dezembro";
                             } 

                            ?>
                    <tr>  
                        <td align="center" title="Ver ou editar plano desse mês">
                            <a  href="plano.php?idplano=<?php echo $exibir['id']; ?>" ><i  class="fas fa-eye" ></i> </a>
                        </td>
                        <td><?php echo $exibir['ano']; ?></td> 
                        <td><?php echo $mes; ?></td>  
                        <td><?php echo $exibir['descricao']; ?></td> 
                        <td><?php echo $exibir['semanas']; ?></td> 
                        <td><?php echo $exibir['temas']; ?></td> 
                        <td><?php echo $exibir['actividades']; ?></td> 
                        <td><?php echo $exibir['objectivo']; ?></td> 
                        <td><?php echo $exibir['participantes']; ?></td> 
                        <td><?php echo $exibir['materiais']; ?></td> 
                     
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


<script>
  $(document).on("blur", ".update", function() {
    var dia = $(this).data("id");
    var tipoderefeicao = $(this).data("column");
    var descricaodarefeicao = $(this).text();

    var ano = <?php echo $anoAtual; ?>;
    var mes = <?php echo $mesAtual; ?>;

    $.ajax({
      url: 'cadastro/updateementa.php',
      method: 'POST',

      data: {
        dia,
        tipoderefeicao,
        descricaodarefeicao,
        ano,
        mes
      },

      success: function(data) {
        $("#mensagemdealerta").html(data); 
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