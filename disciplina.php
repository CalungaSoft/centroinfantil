<?php
include("conexao.php");


session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];




$iddisciplina = isset($_GET['iddisciplina']) ? $_GET['iddisciplina'] : "";

if (isset($_POST['imprimirminipauta'])) {

  $idtrimestre = mysqli_escape_string($conexao, $_POST['idtrimestre']);


  if ($idtrimestre == 0) {
    header('location: pdf/pdfminipauta.php?iddisciplina=' . $iddisciplina . '');
  } else {
    header('location: pdf/pdfminipautatrimestral.php?iddisciplina=' . $iddisciplina . '&idtrimestre=' . $idtrimestre . '');
  }
}

if (isset($_POST['editardadosdadisciplina'])) {

  $titulo = mysqli_escape_string($conexao, $_POST['titulo']);
  $abreviatura = mysqli_escape_string($conexao, $_POST['abreviatura']);
  $tipodedisciplina = mysqli_escape_string($conexao, $_POST['tipodedisciplina']);
  $agrupamento = mysqli_escape_string($conexao, $_POST['agrupamento']);
  $idprofessor = mysqli_escape_string($conexao, $_POST['idprofessor']);
  $idprofessorauxiliar = mysqli_escape_string($conexao, $_POST['idprofessorauxiliar']);
  $obs = mysqli_escape_string($conexao, $_POST['obs']);

  $salarioportempo = mysqli_escape_string($conexao, $_POST['salarioportempo']);
  $salarioportempoauxiliar = mysqli_escape_string($conexao, $_POST['salarioportempoauxiliar']);

  $dadosdadisciplina = mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1"));

  $idturma = $dadosdadisciplina["idturma"];

  if (mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM disciplinas where titulo='$titulo' and idturma='$idturma' and iddisciplina!='$iddisciplina'")) == 0) {


    $salvar = mysqli_query($conexao, "UPDATE `disciplinas` SET salarioportempo='$salarioportempo', salarioportempoauxiliar='$salarioportempoauxiliar', `titulo` = '$titulo', `abreviatura` = '$abreviatura',`tipodedisciplina` = '$tipodedisciplina',`agrupamento` = '$agrupamento',`idprofessor` = '$idprofessor',`idprofessorauxiliar` = '$idprofessorauxiliar',`obs` = '$obs' WHERE `disciplinas`.`iddisciplina` = '$iddisciplina'");


    if ($salvar) {

      $acertos[] = "Alterações salvas com sucesso!";
    } else {

      $erros[] = "ocorreu algum erro!";
    }
  } else {
    $erros[] = "Já Existe outra disciplina com esse nome com esse Nome";
  }
}



include("cabecalho.php"); ?>

<?php

$dadosdadisciplina = mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1"));

$idprofessor = $dadosdadisciplina["idprofessor"];
$idprofessorauxiliar = $dadosdadisciplina["idprofessorauxiliar"];

$professor = mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessor' limit 1"))[0];

$professorauxiliar = mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar' limit 1"))[0];

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Dados da disciplina</h1>

  <?php
  if (!empty($erros)) :
    foreach ($erros as $erros) :
      echo '<div class="alert alert-danger">' . $erros . '</div>';
    endforeach;
  endif;
  ?>

  <?php
  if (!empty($acertos)) :
    foreach ($acertos as $acertos) :
      echo '<div class="alert alert-success">' . $acertos . '</div>';
    endforeach;
  endif;
  ?>



  <div class="col-lg">
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Dados da disciplina</h6>
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
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">disciplina</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="disciplina.php?iddisciplina=<?php echo $dadosdadisciplina["iddisciplina"]; ?>"><?php echo $dadosdadisciplina["titulo"]; ?></a></div> <br>

                         Abreviatura: <strong> <?php echo $dadosdadisciplina["abreviatura"]; ?> </strong> <br>

                         Tipo de Disciplina: <strong> <?php echo $dadosdadisciplina["tipodedisciplina"]; ?> </strong> <br>

                         Agrupamento: <strong> <?php echo $dadosdadisciplina["agrupamento"]; ?> </strong> <br>

                         Observações: <strong> <?php echo $dadosdadisciplina["obs"]; ?> </strong> <br>


                         Salário Por tempo Efectivos: <strong> <?php echo $dadosdadisciplina["salarioportempo"]; ?> KZ </strong>  <br>
                         Salário Por tempo Auxiliares: <strong> <?php echo $dadosdadisciplina["salarioportempoauxiliar"]; ?> KZ </strong> <br>
                        
                        
                        <br><br>



                      </div>

                      <?php if ($painellogado == "administrador" || $painellogado == "areapedagogica") { ?>
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-6">
                          <!-- Card Header - Accordion -->
                          <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Informações</h6>
                          </a>
                          <!-- Card Content - Collapse -->
                          <div class="collapse in" id="collapseCardExample">
                            <div class="card-body">
                              <form action="" method="post" class="user">

                                <div class="form-group">
                                  <label>Título:</label>
                                  <input type="text" name="titulo" class="form-control  " value="<?php echo $dadosdadisciplina["titulo"]; ?>">
                                </div>

                                <?php

                                $htm = '
                      <div class="form-group row"> 
                      <div class="col-sm-3">   
                        <span>Abreviatura</span> 
                                <input type="text"  name="abreviatura" class="form-control " value="' . $dadosdadisciplina["abreviatura"] . '" > 
                        </div>

                        <div class="col-sm-4"> 
                        <span>Tipo de Disciplina</span>
                                  <select name="tipodedisciplina" required  class="form-control">
                                    <option value="Normal" ';
                                if ($dadosdadisciplina["tipodedisciplina"] == "Normal") {
                                  $htm .= 'selected="" ';
                                }
                                $htm .= '>Normal</option> 
                                    <option value="Chave" ';
                                if ($dadosdadisciplina["tipodedisciplina"] == "Chave") {
                                  $htm .= 'selected="" ';
                                }
                                $htm .= '>Chave</option> 
                                  </select> 
                        </div> 

                         <div class="col-sm-5">  
                          <span>Agrupamento</span>
                          <select name="agrupamento" required  class="form-control">
                            <option value="Formação Geral" ';
                                if ($dadosdadisciplina["agrupamento"] == "Formação Geral") {
                                  $htm .= 'selected="" ';
                                }
                                $htm .= '>Formação Geral</option> 
                            <option value="Formação Específica" ';
                                if ($dadosdadisciplina["agrupamento"] == "Formação Específica") {
                                  $htm .= 'selected="" ';
                                }
                                $htm .= '>Formação Específica</option> 
                             <option value="Opção" ';
                                if ($dadosdadisciplina["agrupamento"] == "Opção") {
                                  $htm .= 'selected="" ';
                                }
                                $htm .= '>Opção</option> 
                          </select> 
                        </div> 


                    </div>

                     

                  
                  <div class="form-group row"> 
                      <div class="col-sm-5">   
                        <span>Professor Efectivo</span> 
                                 <select name="idprofessor" required  class="form-control">

                                  ';

                                $lista = mysqli_query($conexao, "select nomedofuncionario, idfuncionario from funcionarios");
                                while ($exibir = $lista->fetch_array()) {
                                  $htm .= '
                                    <option ';
                                  if ($dadosdadisciplina["idprofessor"] == $exibir["idfuncionario"]) {
                                    $htm .= 'selected="" ';
                                  }
                                  $htm .= ' value="' . $exibir["idfuncionario"] . '">' . $exibir["nomedofuncionario"] . '</option>
                                    ';
                                }
                                $htm .= '
                                  </select> 
                        </div>
                        <div class="col-sm-7"> 
                        <span>Professor Auxiliar</span>
                                  <select name="idprofessorauxiliar" required  class="form-control">
                                    <option value="0">Sem Professor Auxiliar</option>
                                  ';

                                $lista = mysqli_query($conexao, "select nomedofuncionario, idfuncionario from funcionarios");
                                while ($exibir = $lista->fetch_array()) {
                                  $htm .= '
                                    <option  ';
                                  if ($dadosdadisciplina["idprofessorauxiliar"] == $exibir["idfuncionario"]) {
                                    $htm .= 'selected="" ';
                                  }
                                  $htm .= ' value="' . $exibir["idfuncionario"] . '">' . $exibir["nomedofuncionario"] . '</option>
                                    ';
                                }
                                $htm .= '
                                  </select> 
                        </div> 
                    </div>

                    <div class="form-group row"> 
                      <div class="col-sm-5">   
                        <span>Salário/Tempo Efectivo</span> 
                        <input type="number"  name="salarioportempo" class="form-control " value="' . $dadosdadisciplina["salarioportempo"] . '" > 
                        </div>
                        <div class="col-sm-7"> 
                        <span>Salário/Tempo Auxiliar</span>
                         <input type="number"  name="salarioportempoauxiliar" class="form-control " value="' . $dadosdadisciplina["salarioportempoauxiliar"] . '" > 
                        </div> 
                    </div>

                      <div class="form-group">
                         <span>Observações sobre a Disciplina</span>
                        <textarea name="obs" rows="2" class="form-control " title="Alguma observação?" >' . $dadosdadisciplina["obs"] . '</textarea>
                    </div>


                    ';

                                echo "$htm";

                                ?>



                                <div class="form-group">
                                  <input type="submit" name="editardadosdadisciplina" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- Collapsable Card Example -->

                      <?php } ?>
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
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dados Lectivo</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                        <p id="mostra1"> <br>



                          <?php

                          $idanolectivo = $dadosdadisciplina["idanolectivo"];


                          $anolectivo = mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo'"));



                          $idturma = $dadosdadisciplina["idturma"];
                          $dadosdaturma = mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1"));

                          $turma = $dadosdaturma["titulo"];
                          $idperiodo = $dadosdaturma["idperiodo"];
                 
                          $idsala = $dadosdaturma["idsala"];
                          
                          $minimoparapositiva = $dadosdaturma["minimoparapositiva"];



                          $periodo = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                        
                          $sala = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from salas where idsala='$idsala'"))[0];

                        
                          ?>

                           Ano Lectivo: <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo["titulo"]; ?> </a><br>

                           Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a><br>
 
                           Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                           Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a>
                          <br><br>


                           Porfessor: <strong> <a href="idfuncionario.php?idfuncionario=<?php echo $idprofessor; ?>"><?php echo $professor; ?></a> </strong> <br>

                           Porfessor Auxiliar: <strong> <a href="idfuncionario.php?idfuncionario=<?php echo $idprofessorauxiliar; ?>"><?php echo $professorauxiliar; ?></a> </strong> <br>



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
      <h6 class="m-0 font-weight-bold text-primary">Lista de Estudantes desta disciplina</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <a href="pdf/pdfconsultass.php" id="pauta" class="d-sm-inline-block btn btn-sm btn-success"><i class="fas fa-fw fa-print"></i> Pauta</a>

        <a href="" id="minipauta" class="d-sm-inline-block btn btn-sm btn-secondary"><i class="fas fa-fw fa-print"></i> Mini-Pauta </a>

        <a href="" class="d-sm-inline-block btn btn-sm btn-info" id="faltas"><i class="fas fa-fw fa-calendar"></i> Faltas </a>



        <a href="" id="alunoscomcadeirasematraso" class="d-sm-inline-block btn btn-sm btn-danger"><i class="fas fa-fw fa-users"></i> Alunos com cadeira em atraso </a> <br><br>





        <span id="resultado">

          <?php $htm = '
                <form action="" method="post">
                <input type="hidden" id="iddisciplina" value="' . $iddisciplina . '">  
              <br>
              <h2>Minipauta de(o)  
                    <select  id="idtrimestre" name="idtrimestre" required  class="d-sm-inline-block" > 
                    <option  value="0">Todos</option>
                     ';
          $lista = mysqli_query($conexao, "SELECT * from trimestres where idanolectivo='$idanolectivo' order by titulo desc");
          while ($exibir = $lista->fetch_array()) {
            $htm .= '
                          <option  value="' . $exibir["idtrimestre"] . '">' . $exibir["titulo"] . '</option>
                      ';
          }
          $htm .= '
                    </select>  

                    Trimestre 
                    <button  name="imprimirminipauta" class="d-sm-inline-block btn btn-sm btn-success" > <i class="fas fa-fw fa-print"></i> Imprimir Minipauta</button>
                    <br> 
                    </form>
                    </h2> <br> ';

          echo $htm;
          ?>

          <?php
          if ($dadosdaturma["eclassedeexame"] != 'Sim') {

            $minipauta = '
               
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>';


            $numerodenotas_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
            $numerodemedias_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas' "));

            $colSpan_dis = $numerodenotas_transicao + $numerodemedias_transicao;

            $minipauta .= '

                    <tr>  
                      <th rowspan="3" align="center">Nome do Estudante</th>
                      <th colspan="' . $colSpan_dis . '" align="center">' . $dadosdadisciplina["titulo"] . '</th>
                    </tr>
                    <tr>  ';



            $lista_de_trimestre = mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc");


            while ($exibir = $lista_de_trimestre->fetch_array()) {

              $idtrimestre = $exibir["idtrimestre"];

              $vetor_trimestres[] = $idtrimestre;

              $numerodenotas_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' "));
              $numerodemedias_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='Transição' and tipodemedia='denotas'  "));

              $colSpan_tri = $numerodenotas_transicao + $numerodemedias_transicao;



              $minipauta .= '

                      <th align="center" colspan="' . $colSpan_tri . '">' . $exibir["titulo"] . '</th> 
                       ';
            }

            $minipauta .= '
                        </tr>

                     <tr>  
                     ';

            foreach ($vetor_trimestres as $key => $idtrimestre_v) {

              $lista = mysqli_query($conexao, "select * from notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição' and idtrimestre='$idtrimestre_v' order by posicao asc");

              while ($exibir = $lista->fetch_array()) {

                $minipauta .= ' 
                                    <th align="center">' . $exibir["titulo"] . '</th> 
                                ';
              }

              $lista = mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='Transição'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

              while ($exibir = $lista->fetch_array()) {

                $minipauta .= ' 
                                  <th align="center">' . $exibir["titulo"] . '</th> 
                                ';
              }
            }

            $minipauta .= '
                    </tr>
                  

                  </thead>
                  <tbody> 
                    ';

            $lista = mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'");

            while ($exibir = $lista->fetch_array()) {





              $minipauta .= '
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=' . $exibir["idaluno"] . '">' . $exibir['nomecompleto'] . ' </a></td>';



              $idmatriculaeconfirmacao = $exibir["idmatriculaeconfirmacao"];

              $listadetrimestre = mysqli_query($conexao, " SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

              while ($observar = $listadetrimestre->fetch_array()) {

                $idtrimestre = $observar["idtrimestre"];

                $lista_de_medias = mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='Transição' and tipodemedia='denotas'");

                while ($visualizar = $lista_de_medias->fetch_array()) {

                  $idmedia = $visualizar["idmediadoano"];

                  $lista_de_nota = mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'");

                  $somatorio = 0;
                  $numero_de_notas = mysqli_num_rows($lista_de_nota);

                  while ($ver = $lista_de_nota->fetch_array()) {

                    $idnotadoano = $ver["idnotadoano"];

                    $nota = mysqli_fetch_array(mysqli_query($conexao, " SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                    $somatorio += $nota;
                    if ($nota >= $minimoparapositiva) {
                      $cor = "Blue";
                    } else {
                      $cor = "red";
                    }

                    $minipauta .= '  
                                              <th align="center" style="color: ' . $cor . '" >' . $nota . '</th>';
                  }

                  $media = round($somatorio / $numero_de_notas, $visualizar["arredondarmedia"]);
                  if ($media >= $minimoparapositiva) {
                    $cor = "Blue";
                  } else {
                    $cor = "red";
                  }

                  $minipauta .= '  
                                            <th align="center" style="color: ' . $cor . '" >' . $media . '</th>';
                  $cor = '';
                }
              }

              $minipauta .= '
 

                    </tr>   ';
            }
            $minipauta .= '
                  </tbody>
                </table>';


            echo "$minipauta";
          } else {

            $minipauta = '
               
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>';


            $numerodenotas_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM notasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' "));
            $numerodemedias_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas' "));

            $colSpan_dis = $numerodenotas_transicao + $numerodemedias_transicao;

            $minipauta .= '

                    <tr>  
                      <th rowspan="3" align="center">Nome do Estudante</th>
                      <th colspan="' . $colSpan_dis . '" align="center">' . $dadosdadisciplina["titulo"] . '</th>
                    </tr>
                    <tr>  ';



            $lista_de_trimestre = mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo' order by posicao asc");


            while ($exibir = $lista_de_trimestre->fetch_array()) {

              $idtrimestre = $exibir["idtrimestre"];

              $vetor_trimestres[] = $idtrimestre;

              $numerodenotas_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM notasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='exame' "));
              $numerodemedias_transicao = mysqli_num_rows(mysqli_query($conexao, " SELECT * FROM mediasdoano where idtrimestre='$idtrimestre' and  idanolectivo='$idanolectivo' and  tipodeturma='exame' and tipodemedia='denotas'  "));

              $colSpan_tri = $numerodenotas_transicao + $numerodemedias_transicao;



              $minipauta .= '

                      <th align="center" colspan="' . $colSpan_tri . '">' . $exibir["titulo"] . '</th> 
                       ';
            }

            $minipauta .= '
                        </tr>

                     <tr>  
                     ';

            foreach ($vetor_trimestres as $key => $idtrimestre_v) {

              $lista = mysqli_query($conexao, "select * from notasdoano where tipo='normal' and idanolectivo='$idanolectivo' and  tipodeturma='exame' and idtrimestre='$idtrimestre_v' order by posicao asc");

              while ($exibir = $lista->fetch_array()) {

                $minipauta .= ' 
                                    <th align="center">' . $exibir["titulo"] . '</th> 
                                ';
              }

              $lista = mysqli_query($conexao, "select * from mediasdoano where idanolectivo='$idanolectivo' and  tipodeturma='exame'  and idtrimestre='$idtrimestre_v'  and tipodemedia='denotas' ");

              while ($exibir = $lista->fetch_array()) {

                $minipauta .= ' 
                                  <th align="center">' . $exibir["titulo"] . '</th> 
                                ';
              }
            }

            $minipauta .= '
                    </tr>
                  

                  </thead>
                  <tbody> 
                    ';

            $lista = mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma'");

            while ($exibir = $lista->fetch_array()) {


              $minipauta .= '
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=' . $exibir["idaluno"] . '">' . $exibir['nomecompleto'] . ' </a></td>';



              $idmatriculaeconfirmacao = $exibir["idmatriculaeconfirmacao"];

              $listadetrimestre = mysqli_query($conexao, " SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

              while ($observar = $listadetrimestre->fetch_array()) {

                $idtrimestre = $observar["idtrimestre"];

                $lista_de_medias = mysqli_query($conexao, "select * from mediasdoano where idtrimestre='$idtrimestre' and idanolectivo='$idanolectivo' and tipodeturma='exame' and tipodemedia='denotas'");

                while ($visualizar = $lista_de_medias->fetch_array()) {

                  $idmedia = $visualizar["idmediadoano"];

                  $lista_de_nota = mysqli_query($conexao, "select * from notasdoano where idmediaaquepertence='$idmedia'");

                  $somatorio = 0;
                  $numero_de_notas = mysqli_num_rows($lista_de_nota);

                  while ($ver = $lista_de_nota->fetch_array()) {

                    $idnotadoano = $ver["idnotadoano"];

                    $nota = mysqli_fetch_array(mysqli_query($conexao, " SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and idnotadoano='$idnotadoano' and iddisciplina='$iddisciplina'  limit 1"))[0];
                    $somatorio += $nota;
                    if ($nota >= $minimoparapositiva) {
                      $cor = "Blue";
                    } else {
                      $cor = "red";
                    }

                    $minipauta .= '  
                                              <th align="center" style="color: ' . $cor . '" >' . $nota . '</th>';
                  }

                  $media = round($somatorio / $numero_de_notas, $visualizar["arredondarmedia"]);
                  if ($media >= $minimoparapositiva) {
                    $cor = "Blue";
                  } else {
                    $cor = "red";
                  }

                  $minipauta .= '  
                                            <th align="center" style="color: ' . $cor . '" >' . $media . '</th>';
                  $cor = '';
                }
              }

              $minipauta .= '
 

                    </tr>   ';
            }
            $minipauta .= '
                  </tbody>
                </table>';


            echo "$minipauta";
          }


          echo '

<br> 
      
<a href="lancarnota.php?iddisciplina=' . $iddisciplina . '"><button  class="btn btn-primary"> Lançar Nota da Minipauta </button></a>
<a href="lancarnotapauta.php?iddisciplina=' . $iddisciplina . '"><button  class="btn btn-primary"> Lançar Nota da Pauta </button></a>
  
<br><br>


';

          ?>
        </span>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->



</div>
<!-- End of Main Content -->
<br><br><br>

<?php if ($dadosdadisciplina["estatus"] == 1) { ?>
  <span id="mensagemdealertadeeliminacao"></span>
  <!-- Collapsable Card Example -->
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
      <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar Disciplina</span></h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse in" id="collapseCardExample2">
      <div class="card-body" style="color: red">
        Essa Opção serve para Eliminar disciplina

        <?php if ($painellogado == "administrador") { ?>
          <div class="form-group"><br>
            <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá apagar esse disciplina">Apagar disciplina</a>
          </div>
        <?php } else {
          echo "<br>Você não tem permissão de apagar disciplina, contacte o administrador!";
        } ?>
      </div>
    </div>
  </div>
  <!-- Collapsable Card Example -->
<?php } ?>
<script>
  $(document).on("click", "#primeirapergunta", function(event) {
    event.preventDefault();

    var iddisciplina = <?php echo $iddisciplina; ?>;
    if (confirm("Tens certeza que queres Apagar essa disciplina?")) {


      $.ajax({
        url: 'cadastro/deletedisciplina.php',
        method: 'POST',
        data: {
          id: iddisciplina
        },
        success: function(data) {
          $("#mensagemdealertadeeliminacao").html(data);

        }

      })
    }

  })

  $(document).on("click", "#minipauta", function(event) {
    event.preventDefault();

    var iddisciplina = <?php echo $iddisciplina; ?>;
    var idanolectivo = <?php echo $idanolectivo; ?>;
    var idturma = <?php echo $idturma; ?>;


    $.ajax({
      url: 'cadastro/minipauta.php',
      method: 'POST',
      data: {
        iddisciplina,
        idanolectivo,
        idturma
      },
      success: function(data) {
        $("#resultado").html(data);

      }

    })


  })


  $(document).on("click", "#pauta", function(event) {
    event.preventDefault();

    var iddisciplina = <?php echo $iddisciplina; ?>;
    var idanolectivo = <?php echo $idanolectivo; ?>;
    var idturma = <?php echo $idturma; ?>;


    $.ajax({
      url: 'cadastro/pauta.php',
      method: 'POST',
      data: {
        iddisciplina,
        idanolectivo,
        idturma
      },
      success: function(data) {
        $("#resultado").html(data);

      }

    })


  })



  $(document).on("click", "#faltas", function(event) {
    event.preventDefault();

    var iddisciplina = <?php echo $iddisciplina; ?>;
    var idanolectivo = <?php echo $idanolectivo; ?>;
    var idturma = <?php echo $idturma; ?>;


    $.ajax({
      url: 'cadastro/faltas.php',
      method: 'POST',
      data: {
        iddisciplina,
        idanolectivo,
        idturma
      },
      success: function(data) {
        $("#resultado").html(data);

      }

    })


  })



  $(document).on("click", "#alunoscomcadeirasematraso", function(event) {
    event.preventDefault();

    var iddisciplina = <?php echo $iddisciplina; ?>;
    var idanolectivo = <?php echo $idanolectivo; ?>;
    var idturma = <?php echo $idturma; ?>;


    $.ajax({
      url: 'cadastro/alunoscomcadeirasematraso.php',
      method: 'POST',
      data: {
        iddisciplina,
        idanolectivo,
        idturma
      },
      success: function(data) {
        $("#resultado").html(data);

      }

    })


  })


  $(document).on("change", "#idtrimestre", function(event) {
    event.preventDefault();

    var iddisciplina = <?php echo $iddisciplina; ?>;

    var idtrimestre = $("#idtrimestre option:selected").val();

    var idturma = "<?php echo $idturma; ?>";
    var idanolectivo = "<?php echo $idanolectivo; ?>";

    if (idtrimestre != 0) {

      $.ajax({
        url: 'cadastro/minipautatrimestral.php',
        method: 'POST',
        data: {
          iddisciplina,
          idtrimestre,
          idturma,
          idanolectivo
        },
        success: function(data) {
          $("#resultado").html(data);

        }

      })

    } else {
      $.ajax({
        url: 'cadastro/minipauta.php',
        method: 'POST',
        data: {
          iddisciplina,
          idturma,
          idanolectivo
        },
        success: function(data) {
          $("#resultado").html(data);

        }

      })
    }
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