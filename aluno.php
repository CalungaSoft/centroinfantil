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




$idaluno = isset($_GET['idaluno']) ? $_GET['idaluno'] : "";
$idmatriculaeconfirmacao = isset($_GET['idmatriculaeconfirmacao']) ? $_GET['idmatriculaeconfirmacao'] : "0";


if ($idmatriculaeconfirmacao == 0) {

  $sql=mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idaluno' order by idmatriculaeconfirmacao desc limit 1");
 
  if (mysqli_num_rows($sql)>0) {
    $idmatriculaeconfirmacao_fora = mysqli_fetch_array($sql)[0];
  }else{
    $idmatriculaeconfirmacao_fora=null;
  }
   

} else {

  $dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

  $idaluno = $dados_da_matriculaeconfirmacao["idaluno"];
  $idanolectivo = $dados_da_matriculaeconfirmacao["idanolectivo"];
  $idanolectivo_selecionado = $dados_da_matriculaeconfirmacao["idanolectivo"];

  $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao, "SELECT MONTH(datainicio) as mesinicio, MONTH(datafim) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafim) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

  $anolectivo_selecionado = $dadosdoanolectivo["titulo"];

  $idmatriculaeconfirmacao_fora = $idmatriculaeconfirmacao;
}

if (!isset($_GET["idmatriculaeconfirmacao"])) {

  $sql=mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idaluno' order by idmatriculaeconfirmacao desc limit 1");
 
  if (mysqli_num_rows($sql)>0) {
    $idmatriculaeconfirmacao = mysqli_fetch_array($sql)[0];

    
  $dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

  $idaluno = $dados_da_matriculaeconfirmacao["idaluno"];
  $idanolectivo = $dados_da_matriculaeconfirmacao["idanolectivo"];
  $idanolectivo_selecionado = $dados_da_matriculaeconfirmacao["idanolectivo"];

  $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao, "SELECT MONTH(datainicio) as mesinicio, YEAR(datainicio) as anoinicio, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

  $anolectivo_selecionado = $dadosdoanolectivo["titulo"];

  $idmatriculaeconfirmacao_fora = $idmatriculaeconfirmacao;

  }else{
    $idmatriculaeconfirmacao=null;
  }
   
 


}


$idaluno = isset($_GET['idaluno']) ? $_GET['idaluno'] : "";

if (isset($_POST['cadastrar'])) {

  if (!empty(trim($_POST['divida']))) {
    $descricao = mysqli_escape_string($conexao, trim($_POST['descricao']));
    $divida = mysqli_escape_string($conexao, trim($_POST['divida']));

    if ($divida != 0) {


      if (empty(trim($_POST['descricao']))) {
        $descricao = "Dívida Precedente";
      }



      $salvar_financas = mysqli_query($conexao, "INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Inserção no Sistema', 0, 0, '$divida', '$idaluno', 0, CURRENT_TIMESTAMP, '', 0)");

      if ($salvar_financas) {

        $acertos[] = "Dívida Registrada com sucesso";
      } else {

        $erros[] = "Ocorreu um erro!";
      }
    }
  }
}

if (isset($_POST['editardadosdoaluno'])) {

  if (!empty(trim($_POST['nomecompleto']))) {

    $nomecompleto = mysqli_escape_string($conexao, trim($_POST['nomecompleto']));
    $nomedopai = mysqli_escape_string($conexao, trim($_POST['nomedopai']));
    $nomedamae = mysqli_escape_string($conexao, trim($_POST['nomedamae']));
    $encarregado = mysqli_escape_string($conexao, trim($_POST['encarregado']));
    $sexo = mysqli_escape_string($conexao, trim($_POST['sexo']));
    $datadenascimento = mysqli_escape_string($conexao, trim($_POST['datadenascimento']));
    $nacionalidade = mysqli_escape_string($conexao, trim($_POST['nacionalidade']));
    $naturalidade = mysqli_escape_string($conexao, trim($_POST['naturalidade']));
    $provincia = mysqli_escape_string($conexao, trim($_POST['provincia']));
    $numerodobioucedula = mysqli_escape_string($conexao, trim($_POST['numerodobioucedula']));
    $datadeexpiracao = mysqli_escape_string($conexao, trim($_POST['datadeexpiracao']));
    $arquivodeidentificacao = mysqli_escape_string($conexao, trim($_POST['arquivodeidentificacao']));
    $telefone = mysqli_escape_string($conexao, trim($_POST['telefone']));
    $telefoneencarregado = mysqli_escape_string($conexao, trim($_POST['telefoneencarregado']));
    $morada = mysqli_escape_string($conexao, trim($_POST['morada']));
    $deficiencia = mysqli_escape_string($conexao, trim($_POST['deficiencia']));
    $profissao = mysqli_escape_string($conexao, trim($_POST['profissao']));
    $email = mysqli_escape_string($conexao, trim($_POST['email']));
    $religiao = mysqli_escape_string($conexao, trim($_POST['religiao']));


    $contactopai = mysqli_escape_string($conexao, trim($_POST['contactopai']));
    $contactomae = mysqli_escape_string($conexao, trim($_POST['contactomae']));




    $numerodeprocesso = mysqli_escape_string($conexao, trim($_POST['numerodeprocesso']));
    $escoladeorigem = mysqli_escape_string($conexao, trim($_POST['escoladeorigem']));
    $anodeentrada = mysqli_escape_string($conexao, trim($_POST['anodeentrada']));


    $nifencarregado = mysqli_escape_string($conexao, trim($_POST['nifencarregado']));
    



    $obs = mysqli_escape_string($conexao, trim($_POST['obs']));

    $existe = mysqli_num_rows(mysqli_query($conexao, "select idaluno from alunos where nomecompleto='$nomecompleto' and idaluno!='$idaluno'"));

    if ($existe == 0) {

      $salvar = mysqli_query($conexao, "UPDATE `alunos` SET nifencarregado='$nifencarregado',contactopai='$contactopai',contactomae='$contactomae', `nomecompleto` = '$nomecompleto', `sexo` = '$sexo', `nomedopai` = '$nomedopai', `nomedamae` = '$nomedamae', `naturalidade` = '$naturalidade', `nacionalidade` = '$nacionalidade', `provincia` = '$provincia', `numerodobioucedula` = '$numerodobioucedula', `arquivodeidentificacao` = '$arquivodeidentificacao', `deficiencia` = '$deficiencia', `escoladeorigem` = '$escoladeorigem', `telefone` = '$telefone', `telefoneincarregados` = '$telefoneencarregado', `profissao` = '$profissao', `email` = '$email', `anodeentrada` = '$anodeentrada', `datadenascimento` = '$datadenascimento', `datadeexpiracaodobi` = '$datadeexpiracao', `numerodeprocesso` = '$numerodeprocesso', `morada` = '$morada', `religiao` = '$religiao', `nomedoencarregado` = '$encarregado', `obs` = '$obs' WHERE `alunos`.`idaluno` = '$idaluno'");




      if ($salvar) {




        header("Location: aluno.php?idaluno=$idaluno");
      } else {

        $erros[] = "Ocorreu um erro Ao Editar Dados do(a) aluno(a)";
      }
    } else {
      $erros[] = "Já existe um outro aluno com esse nome";
    }
  } else {
    $erros[] = " O campo nome completo não pode ir vazio";
  }
}


if (isset($_FILES['nova_foto'])) {
  $upload_directory = 'upload/';
  $file_name = $_FILES['nova_foto']['name'];
  $file_temp = $_FILES['nova_foto']['tmp_name'];
  $file_size = $_FILES['nova_foto']['size'];
  $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif'); // Extensões permitidas

  // Verifique o tamanho máximo (por exemplo, 2MB)
  $max_size = 10 * 1024 * 1024; // 2MB em bytes

  // Verifique a extensão do arquivo
  $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

  // Gere um nome único para o arquivo
  $unique_file_name = uniqid() . '.' . $file_extension;
  
  if (in_array($file_extension, $allowed_extensions) && $file_size <= $max_size) {
      // Verifique se o upload foi bem-sucedido
      if (move_uploaded_file($file_temp, $upload_directory . $unique_file_name)) {
          // Atualize o nome da foto na tabela "aluno"
          
          $sql = "UPDATE alunos SET caminhodafoto = '$unique_file_name' WHERE idaluno = '$idaluno'";

          if (mysqli_query($conexao, $sql)) {
            $acertos[]= "A foto foi alterada com sucesso!";
          } else {
            $erros[]= "Erro ao atualizar a foto: " . mysqli_error($conexao);
          }
      } else {
        $erros[]= "Erro ao fazer o upload da foto.";
      }
  } else {
    $erros[]= "O arquivo não é válido. Certifique-se de que seja uma imagem (jpg, jpeg, png ou gif) e não exceda 2MB de tamanho.";
  }

}




  




include("cabecalho.php"); ?>

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

$dadosdoaluno = mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1"));


?>
<!-- Begin Page Content -->
<div class="container-fluid">

 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">Dados do aluno <a href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"]; ?>"><?php echo $dadosdoaluno["nomecompleto"]; ?></a> <?php if ($idmatriculaeconfirmacao != 0) {
                                                                                                                                                                          echo "( $dados_da_matriculaeconfirmacao[turma] | Sala $dados_da_matriculaeconfirmacao[sala] - $anolectivo_selecionado )";
                                                                                                                                                                        } ?>  </h1>

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




  <?php include("estilocarde.php"); ?>


  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Especificar um Ano Lectivo</button>

  <?php if ($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2") { ?>

    <button id="myBtn" class="btn btn-success"> <i class="fas fa-fw fa-plus"></i>Registrar Dívida do aluno</button>

    <a href="pdf/estratodoaluno.php?idmatriculaeconfirmacao=<?php echo $idmatriculaeconfirmacao_fora; ?>"> <button class="btn btn-primary">Imprimir Extrato do Aluno</button></a>
    <a href="pdf/fichadematricula.php?idmatriculaeconfirmacao=<?php echo $idmatriculaeconfirmacao_fora; ?>"> <button class="btn btn-primary">Imprimir Ficha de Matrícula</button></a>

  <?php } else { ?>

    <span id="myBtn"></span>

  <?php } ?>

  <button id="relatoriodoaluno" class="btn btn-success"> Ver Relatórios Diário</button>


  <div id="myModal" class="modal">
    <div class="modal-content">
      <span id="close">&times;</span>
      <form class="user" method="post" action="">
        <h3>Cadastrando dívida de aluno</h3> <br>

        <div class="form-group">

          <input type="text" name="descricao" autocomplete="on" list="datalist2" class="form-control" placeholder="Motivo da Dívida" required="">

        </div>

        <div class="form-group">

          <input type="number" name="divida" autocomplete="on" list="datalist2" class="form-control" placeholder="Dívida" required="">

        </div>



        <br>
        <input type="submit" name="cadastrar" value="Cadastrar Dívida" class="btn btn-success" style="float: rigth;">

      </form>
    </div>
  </div>





  <div id="myModalreclamacoes" class="modal">
    <div class="modal-content">
      <span id="closereclamacoes"> &times;</span>
      <form action="" method="get">
        <br>

        <span>Escolha outro Ano Lectivo</span>
        <div class="form-group">
          <select name="idmatriculaeconfirmacao" required class="form-control">
            <option value="0">Todos os anos lectivos </option>

            <?php
            $lista = mysqli_query($conexao, "SELECT matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where matriculaseconfirmacoes.idanolectivo=anoslectivos.idanolectivo   and idaluno='$idaluno' order by titulo desc");
            while ($exibir = $lista->fetch_array()) { ?>
              <option value="<?php echo $exibir["idmatriculaeconfirmacao"]; ?>"><?php echo $exibir["curso"]; ?> | <?php echo $exibir["classe"]; ?> | Turma: <?php echo $exibir["turma"]; ?></option>
            <?php } ?>
          </select>
        </div>
        <input type="hidden" name="idaluno" value="<?php echo $idaluno; ?>">
        <br>
        <input type="submit" value="Ver" name="mudaranolectivo" class="btn btn-success" style="float: rigth;">


      </form>
    </div>
  </div>


  <div id="relatorio" class="modal">
    <div class="modal-content">
      <span id="relatoriofechar"> &times;</span>

      <h1>Relatorio Diário de Aluno</h1> <br>
      <span id="mensagemdealertarelatorio"></span>

      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nº</th>
            <th>Disciplina</th>
            <th>Relatório</th>
            <th>Data</th>
            <th>Opção</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $lista_relatorio = mysqli_query($conexao, "SELECT    matriculaseconfirmacoes.classe,matriculaseconfirmacoes.estatus, relatoriodiario.* from relatoriodiario, matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and relatoriodiario.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao  and relatoriodiario.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' order by data desc");
          $n = 0;

          while ($exibir_relatorio = $lista_relatorio->fetch_array()) {

            $n++;


            $iddisciplina = $exibir_relatorio["iddisciplina"];

            $nomedadisciplina = mysqli_fetch_array(mysqli_query($conexao, "select titulo from disciplinas where iddisciplina='$iddisciplina' limit 1"))[0];



          ?>
            <tr>
              <td><?php echo $n; ?></td>
              <td> <a href="diciplina.php?iddiciplina=<?php echo $exibir_relatorio["iddiciplina"]; ?>"> <?php echo $nomedadisciplina; ?> </a> </td>
              <td class="update" data-id="<?php echo $exibir_relatorio["idrelatoriodiario"]; ?>" data-column="descricao" <?php if ($exibir_relatorio["idprofessor"] == $idlogado) { ?> contenteditable <?php } ?>><?php echo $exibir_relatorio['descricao']; ?></td>
              <td class="update" data-id="<?php echo $exibir_relatorio["idrelatoriodiario"]; ?>" data-column="data" <?php if ($exibir_relatorio["idprofessor"] == $idlogado) { ?> contenteditable <?php } ?>><?php echo $exibir_relatorio['data']; ?></td>

              <td align="center" title="Eliminar Relatório">
                <?php if ($exibir_relatorio["idprofessor"] == $idlogado) { ?>
                  <a href="" class="delete" id="<?php echo $exibir_relatorio["idrelatoriodiario"]; ?>"><i style="color:red" title="Eliminar esse relatório" class="fas fa-trash"></i></a>
                <?php }  ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>





  <div id="myModalfoto" class="modal">
    <div class="modal-content">
      <span id="closefoto"> &times;</span>

      <form action="#" method="post" enctype="multipart/form-data">
            <div class="input-group mb-4 mt-4">
                <input type="file" accept="image/*" class="form-control" name="nova_foto">
                <button type="submit" class="btn btn-success" >Alterar Foto</button>
            </div>
        </form>


      <img src="upload/<?php echo $dadosdoaluno['caminhodafoto'];?>" alt="Imagem do Estudante"  >

      


        <br><br>
    </div>
  </div>






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
            <div class="card border-left-danger shadow h-100 py-2  ">
              <div class="card-body ">
                <div class="student-image">
                  <img src="upload/<?php echo $dadosdoaluno['caminhodafoto'];?>" alt="Imagem do Estudante" class="student-image">
                </div>

                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">aluno</div>
                    <div class="row no-gutters align-items-center ">
                      <div class="col-auto ">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"]; ?>"><?php echo $dadosdoaluno["nomecompleto"]; ?></a></div> <br>



                         Sexo: <strong> <?php echo $dadosdoaluno["sexo"]; ?> </strong> <br>

                         Nome do Pai: <strong> <?php echo $dadosdoaluno["nomedopai"]; ?> </strong> <br>

                         Nome da Mãe: <strong> <?php echo $dadosdoaluno["nomedamae"]; ?> </strong> <br>

                         Data de Nascimento: <strong> <?php echo $dadosdoaluno["datadenascimento"]; ?> </strong> <br>


                         Naturalidade: <strong> <?php echo $dadosdoaluno["naturalidade"]; ?> </strong> <br>

                         Nacionalidade: <strong> <?php echo $dadosdoaluno["nacionalidade"]; ?> </strong> <br>

                         Província de: <strong> <?php echo $dadosdoaluno["provincia"]; ?> </strong> <br>
                        <hr> <br>
                         Nº do B.I. ou Cédula: <strong> <?php echo $dadosdoaluno["numerodobioucedula"]; ?> </strong> <br>

                         Arquivo de Identificação : <strong> <?php echo $dadosdoaluno["arquivodeidentificacao"]; ?> </strong> <br>

                         Data de Expiração: <strong> <?php echo $dadosdoaluno["datadeexpiracaodobi"]; ?> </strong> <br>

                        <hr> <br>

                         Deficiência: <strong> <?php echo $dadosdoaluno["deficiencia"]; ?> </strong> <br>

                         Profissão: <strong> <?php echo $dadosdoaluno["profissao"]; ?> </strong> <br>

                         Religião: <strong> <?php echo $dadosdoaluno["religiao"]; ?> </strong> <br>

                         NIF do Encarregado: <strong> <?php echo $dadosdoaluno["nifencarregado"]; ?> </strong> <br>



                        <br>
                       


                            <button id="myBtnfoto" class="btn btn-primary">Ver ou alterar foto</button>
                      </div>

                      <?php if ($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2") { ?>

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
                                  <span>Nome Completo</span>
                                  <input type="text" name="nomecompleto" class="form-control " title="Digite o nome completo do aluno" placeholder="Nome do aluno" value="<?php echo $dadosdoaluno["nomecompleto"]; ?>" required="">
                                </div>


                                <div class="form-group">
                                  <select name="sexo" class="form-control" title="Escolha o genero do aluno">
                                    <option disabled="">Sexo</option>
                                    <option <?php if ($dadosdoaluno["sexo"] == 'Masculino') {
                                              echo "selected";
                                            } ?> value="Masculino">Masculino</option>
                                    <option <?php if ($dadosdoaluno["sexo"] == 'Femenino') {
                                              echo "selected";
                                            } ?> value="Femenino">Femenino</option>
                                  </select>
                                </div>


                                <div class="form-group">
                                  <span>Nome do Pai</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["nomedopai"]; ?>" name="nomedopai" id="nomedopai" class="form-control " title="Digite o nome completo do Pai" placeholder="Nome do Pai">
                                </div>
                                <div class="form-group">
                                  <span>Nome da Mãe</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["nomedamae"]; ?>" name="nomedamae" class="form-control " title="Digite o nome completo do Mãe" placeholder="Nome do Mãe">
                                </div>






                                <div class="form-group">
                                  <span>Data de Nascimento</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["datadenascimento"]; ?>" name="datadenascimento" autocomplete="off" class="form-control" title="Digite data de nascimento" placeholder="Data de Nascimento">
                                </div>


                                <div class="form-group row">
                                  <div class="col-sm-6">
                                    <span>Nacionalidade</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["nacionalidade"]; ?>" name="nacionalidade" class="form-control" placeholder="Nacionalidade" value="Angolana">
                                  </div>
                                  <div class="col-sm-6">
                                    <span>Naturalidade</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["naturalidade"]; ?>" name="naturalidade" class="form-control" placeholder="Naturalidade">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <span>Província de:</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["provincia"]; ?>" name="provincia" class="form-control " title="Digite a Província onde o estudante nasceu" placeholder="Província">
                                </div>




                                <div class="form-group row">
                                  <div class="col-sm-6">
                                    <span>Nº do B.I. ou Cédula</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["numerodobioucedula"]; ?>" name="numerodobioucedula" class="form-control " title="Digite o Número do B.I. ou Cédula Pessoal" placeholder="Número do B.I. ou Cédula ">
                                  </div>
                                  <div class="col-sm-6">
                                    <span>Data de Expiração</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["datadeexpiracaodobi"]; ?>" name="datadeexpiracao" autocomplete="off" class="form-control js-datepicker" title="Digite Data de Expiração do B.I." placeholder="Data de Expiração do B.I.">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <span>Passado pelo arquivo de identificação de:</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["arquivodeidentificacao"]; ?>" name="arquivodeidentificacao" class="form-control " placeholder="Passado pelo arquivo de identificação de:" value="Luanda">
                                </div>



                                <div class="form-group">
                                  <span>Morada</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["morada"]; ?>" name="morada" class="form-control " title="Local onde mora o aluno" placeholder="Morada">
                                </div>

                                <div class="form-group">
                                  <span>Deficiencia </span>
                                  <input type="text" value="<?php echo $dadosdoaluno["deficiencia"]; ?>" name="deficiencia" class="form-control " title="O Estudante Apresenta alguma deficiencia física ou psicomotora?" placeholder="Deficiência">
                                </div>



                                <div class="form-group">
                                  <span>Profissão</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["profissao"]; ?>" name="profissao" class="form-control " title="Digite o Profissão" placeholder="Profissão">
                                </div>



                                <div class="form-group">
                                  <span>Email</span>
                                  <input type="email" value="<?php echo $dadosdoaluno["email"]; ?>" name="email" class="form-control " title="Digite o email do cliente" placeholder="Email">
                                </div>


                                <div class="form-group">
                                  <span>Crença Religiona</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["religiao"]; ?>" name="religiao" class="form-control " title="Aqui Religião ou igreja pertence o aluno" placeholder="Religião / Igreja">
                                </div>


                                <div class="form-group">
                                  <span>Encarregado de Educação</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["nomedoencarregado"]; ?>" name="encarregado" id="encarregado" class="form-control " title="Digite o nome completo do Encarregado de Educação" placeholder="Encarregado de Educação">
                                </div>

                                <div class="form-group">
                                  <span>NIF do Encarregado de Educação</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["nifencarregado"]; ?>" name="nifencarregado" id="nifencarregado" class="form-control " title="Digite o NIF do Encarregado de Educação" placeholder="NIF do Encarregado de Educação">
                                </div>

                                <div class="form-group row">
                                  <div class="col-sm-6">
                                    <span>Telefone</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["telefone"]; ?>" name="telefone" class="form-control " placeholder="Nº de telefone do aluno">
                                  </div>
                                  <div class="col-sm-6">
                                    <span>Telefone do Encarregado</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["telefoneincarregados"]; ?>" name="telefoneencarregado" class="form-control " placeholder="Nº dos Encarregados">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <div class="col-sm-6">
                                    <span>Contacto do Pai</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["contactopai"]; ?>" name="contactopai" class="form-control " placeholder="Nº de telefone do Pai">
                                  </div>
                                  <div class="col-sm-6">
                                    <span>Contacto da Mãe</span>
                                    <input type="text" value="<?php echo $dadosdoaluno["contactomae"]; ?>" name="contactomae" class="form-control " placeholder="Nº de telefone da Mãe">
                                  </div>
                                </div>


                                <div class="form-group">
                                  <span>Nº de Processo</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["numerodeprocesso"]; ?>" name="numerodeprocesso" class="form-control" placeholder="Número de processo do aluno">
                                </div>




                                <div class="form-group">
                                  <span>Escola de Origem</span>
                                  <input type="text" value="<?php echo $dadosdoaluno["escoladeorigem"]; ?>" name="escoladeorigem" class="form-control " title="Nome da Escola de Onde vem" placeholder="Escola de Origem">
                                </div>


                                <div class="form-group">
                                  <?php $ano = date("Y"); ?>
                                  <span>Ano de Entrada na Instituição</span>
                                  <input type="number" value="<?php echo $dadosdoaluno["anodeentrada"]; ?>" name="anodeentrada" class="form-control" placeholder="Ano em que entrou na instituição" value="<?php echo "$ano"; ?>">
                                </div>

                                <div class="form-group">
                                  <span>Observações sobre o aluno</span>
                                  <textarea name="obs" rows="3" class="form-control " title="Alguma observação?"><?php echo $dadosdoaluno["obs"]; ?></textarea>
                                </div>




                                <div class="form-group">
                                  <input type="submit" name="editardadosdoaluno" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
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
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outros Dados</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                        <p id="mostra1"> <br>


                           Número de processo: <strong> <?php echo $dadosdoaluno["numerodeprocesso"]; ?> </strong> <br>

                           Escola de Origem: <strong> <?php echo $dadosdoaluno["escoladeorigem"]; ?> </strong> <br>

                           Ano de Entrada na instituição: <strong> <?php echo $dadosdoaluno["anodeentrada"]; ?> </strong> <br>

                           Data de Cadastro no sistema: <strong> <?php echo $dadosdoaluno["datadecadastro"]; ?> </strong> <br>

                           OBS: <strong> <?php echo $dadosdoaluno["obs"]; ?> </strong> <br>
                          <hr> <br>

                           Nº de Telefone : <strong> <?php echo $dadosdoaluno["telefone"]; ?> </strong> <br>

                           Email: <strong> <?php echo $dadosdoaluno["email"]; ?> </strong> <br>

                           Morada: <strong> <?php echo $dadosdoaluno["morada"]; ?> </strong> <br>



                           Nome do Encarregado: <strong> <?php echo $dadosdoaluno["nomedoencarregado"]; ?> </strong> <br>

                           Telefone do Encarregado: <strong> <?php echo $dadosdoaluno["telefoneincarregados"]; ?> </strong> <br>




                          <?php


                          if (!isset($_GET['idaluno'])) {
                            $anolectivo = mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo_selecionado'"));
                          } else {

                            $anolectivo = mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where vigor='Sim'"));
                          }
                          ?>

                          <hr> <br>
                          Ano Lectivo
                        <h3><strong> <?php echo $anolectivo["titulo"]; ?> </strong></h3>
                        <?php

                        $idanolectivo = $anolectivo["idanolectivo"];

                        $matriculasdesseano = mysqli_query($conexao, "select * from matriculaseconfirmacoes where idaluno='$idaluno' and idanolectivo='$idanolectivo'");


                        while ($exibir = $matriculasdesseano->fetch_array()) {

                          $idturma = $exibir["idturma"];
                          $dadosdaturma = mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1"));

                          $turma = $dadosdaturma["titulo"];
                          $idperiodo = $dadosdaturma["idperiodo"];
                         
                        
                          
                        
                          $idsala = $dadosdaturma["idsala"];
                          $idsala = $dadosdaturma["idsala"];
                         
                          $idsala = $dadosdaturma["idsala"]; 
                         

                          $propina = $dadosdaturma["propina"];

                          $tipo = $exibir["tipo"];
                          $preco = number_format($exibir["preco"], 2, ",", ".");
                          $desconto = number_format($exibir["desconto"], 2, ",", ".");
                          $valorpago = number_format($exibir["valorpago"], 2, ",", ".");
                          $divida = number_format($exibir["preco"] - $exibir["desconto"] - $exibir["valorpago"], 2, ",", ".");



                          $periodo = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];


                          $idcoordenador=$dadosdaturma["idcoordenador"];

                          $buscaCordenador=mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idcoordenador'");
                         
                    
                          
                          if (mysqli_num_rows($buscaCordenador)!=0) {
                            $nomedocoordenador=mysqli_fetch_array($buscaCordenador)[0];

                          }else {
                            $nomedocoordenador='';
                          }

                          $sala = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from salas where idsala='$idsala'"))[0];

 

                        ?>
                          <hr>
                          <hr>
                           Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a><br>

 
  

                           Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                           Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a><br>
                           Educador(a): <a href="funcionario.php?idfuncionario=<?php echo $idcoordenador; ?>"> <?php echo $nomedocoordenador; ?> </a>

                          <?php if ($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2") { ?>

                            <div class="form-group">
                              <select id="tipodematricula" class="form-control">
                                <option <?php if ($exibir["tipo"] == "Matrícula") {
                                          echo "selected";
                                        } ?> value="Matrícula">Matrícula</option>
                                <option <?php if ($exibir["tipo"] == "Confirmação") {
                                          echo "selected";
                                        } ?> value="Confirmação">Confirmação</option>
                                <option <?php if ($exibir["tipo"] == "Rematrícula") {
                                          echo "selected";
                                        } ?> value="Rematrícula">Rematrícula</option>


                              </select>
                            </div>

                          <?php } ?>

                          <?php if ($exibir["tipodealuno"] == "Bolseiro") {
                            echo "  <strong>Aluno Bolseiro</strong>";
                          } ?>


                          <hr>
                          <hr> <?php
                              }

                              if (mysqli_num_rows($matriculasdesseano) == 0) {
                                echo "<div class='alert alert-info'>Esse aluno não fez a Matrícula para esse ano! 
                                                  <a href='reconfirmacao.php?idaluno=$idaluno' id='veralunos' class='d-sm-inline-block btn btn-sm btn-primary' ><i class='fas fa-fw fa-sync'></i>Fazer Confirmação</a>       <br><br>             
                                                   <a href='rematricula.php?idaluno=$idaluno'  class='d-sm-inline-block btn btn-sm btn-info ' ><i class='fas fa-fw fa-user'></i> Fazer (Re)Matrícula</a> 


                                                    </div>";
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




  </div>
  <!-- End of Main Content -->

  


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


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Estrato financeiro do Aluno</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">


        <a href="aluno.php?idaluno=<?php echo "$idaluno"; ?>" class="d-sm-inline-block btn btn-sm btn-secondary"><i class="fas fa-fw fa-user"></i> Finanças </a>
<!-- 
        <a href="" id="avaliacao" class="d-sm-inline-block btn btn-sm btn-info"><i class="fas fa-fw fa-check"></i> Avaliações </a> -->
<!--  
        <a href="" id="falta" class="d-sm-inline-block btn btn-sm btn-info"><i class="fas fa-fw fa-calendar"></i> Faltas </a> -->

 

        <a href="" id="propina" class="d-sm-inline-block btn btn-sm btn-success"><i class="fas fa-fw fa-money"></i> Propinas </a> <br><br>


        <span id="botaoavaliacao"></span>

        <span id="mensagemdealerta">




          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Funcionário</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Dívida</th>
                <th>Data</th>
                <th>Opção</th>
              </tr>
            </thead>
            <tbody>
              <?php


              if ($idmatriculaeconfirmacao == 0) {

                $registrosdeentradas = mysqli_query($conexao, "select entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios where funcionarios.idfuncionario=entradas.idfuncionario and entradas.idaluno='$idaluno' order by entradas.identrada desc");
              } else {

                $registrosdeentradas = mysqli_query($conexao, "select entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios where funcionarios.idfuncionario=entradas.idfuncionario and entradas.idaluno='$idaluno' and idanolectivo='$idanolectivo_selecionado' order by entradas.identrada desc");


              ?>



              <?php

              }

              $total_valor = 0;
              $total_divida = 0;

              while ($exibir = $registrosdeentradas->fetch_array()) {

                $idaluno = $exibir["idaluno"];

                $total_valor += $exibir["valor"];
                $total_divida += $exibir["divida"];



              ?>
                <?php if ($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2") { ?>
                  <tr>
                    <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
                    <td <?php if ($exibir["tipo"] == "Outras") { ?> contenteditable <?php } ?>><?php echo $exibir["descricao"]; ?></td>
                    <td><?php echo $exibir["tipo"]; ?></td>
                    <td <?php if ($exibir["tipo"] == "Outras") { ?> contenteditable <?php } ?> title="<?php $valor = number_format($exibir["valor"], 2, ",", ".");
                                                                                                      echo $valor; ?>"><?php echo $exibir["valor"]; ?></td>
                    <td <?php if ($exibir["tipo"] == "Outras") { ?> contenteditable <?php } ?> title="<?php $divida = number_format($exibir["divida"], 2, ",", ".");
                                                                                                      echo $divida; ?>"><?php echo $exibir["divida"]; ?></td>
                    <td><?php echo $exibir["datadaentrada"]; ?></td>
                    <td>
                      <?php  
                        if (($exibir["tipo"]=="Propina")) { ?>
                          <a href="entradapropina.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php  }
                        if ($exibir["tipo"]=="Matrícula" || $exibir["tipo"]=="Confirmação" || $exibir["tipo"]=="Rematrícula") { ?>
                          <a href="entradamatricula.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Material Escolar") { ?>
                          <a href="detalhesdacompra.php?idtipo=<?php echo $exibir["idtipo"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 
                       if ($exibir["tipo"]=="Justificação de Faltas") { ?>
                          <a href="detalhesdafalta.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                       if ($exibir["tipo"]=="Inserção no Sistema") { ?>
                          <a href="insercao.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Tratar Documento") { ?>
                          <a href="detalhestratardocumentos.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 


                        if ($exibir["tipo"]=="Propina do ATL") { ?>
                          <a href="entradapropinadoatl.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Matrícula ATL") { ?>
                          <a href="entradadamatriculadoatl.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                          if ($exibir["tipo"]=="Mensalidade do transporte") { ?>
                          <a href="entradapropinadotransporte.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Matrícula transporte") { ?>
                          <a href="entradadamatriculadotransporte.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 


                       if ($exibir["tipo"]=="Outras") { ?>
                          <a href="entradasoutras.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 
                        ?>
                           
                     
                      
                     </td>
                  </tr>
              <?php }
              }

              $total_valor = number_format($total_valor, 2, ",", ".");
              $total_divida = number_format($total_divida, 2, ",", ".");

              ?>
            </tbody>
            <?php if ($painellogado == "administrador" || $painellogado == "secretaria1" || $painellogado == "secretaria2") { ?>
              <tfoot>
                <th>Total</th>
                <th></th>
                <th></th>
                <th><?php echo $total_valor; ?></th>
                <th><?php echo $total_divida; ?></th>
                <th></th>
                <th></th>
              </tfoot>
            <?php } ?>
          </table>


     
        </span>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->



</div>
<!-- End of Main Content -->
<br><br><br>
<span id="mensagemdealertadeeliminacao"></span>


<?php

$sql=mysqli_query($conexao, "select idturma from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' order by idmatriculaeconfirmacao desc limit 1");

if (mysqli_num_rows($sql)!=0) {
 
$idturma = mysqli_fetch_array($sql)[0];
}else{
  $idturma=0;
}

$idtrimestre_padrao = mysqli_fetch_array(mysqli_query($conexao, "select idtrimestre from trimestres where idanolectivo='$idanolectivo' order by titulo desc"))[0];

?>

<script>
  $(document).on("blur", ".update", function() {
    var id = $(this).data("id");
    var nomedacoluna = $(this).data("column");
    var valor = $(this).text();


    $.ajax({
      url: 'cadastro/updaterelatorio.php',
      method: 'POST',
      data: {
        id: id,
        nomedacoluna: nomedacoluna,
        valor: valor
      },
      success: function(data) {
        $("#mensagemdealertarelatorio").html(data);
      }

    })
  })


  $(document).on("click", ".delete", function(event) {
    event.preventDefault();
    var id = $(this).attr("id");
    console.log(id)
    if (confirm("Tens certeza que queres eliminar esse registro? ")) {
      $(this).closest('tr').remove();
      $.ajax({
        url: 'cadastro/deleterelatorio.php',
        method: 'POST',
        data: {
          id: id
        },
        success: function(data) {
          $("#mensagemdealertarelatorio").html(data);

        }

      })
    }

  })


  $(document).on("click", "#primeirapergunta", function(event) {
    event.preventDefault();

    var idaluno = <?php echo $idaluno; ?>;
    if (confirm("Tens certeza que queres eliminar esse aluno?")) {


      $.ajax({
        url: 'cadastro/deletealuno.php',
        method: 'POST',
        data: {
          idaluno: idaluno
        },
        success: function(data) {
          $("#mensagemdealertadeeliminacao").html(data);

        }

      })
    }

  })


  $(document).on("click", "#avaliacao", function(event) {
    event.preventDefault();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;
    var idturma = "<?php echo $idturma; ?>";
    var idtrimestre = "<?php echo $idtrimestre_padrao; ?>";

    var htm = "<h2>Avaliações Contínuas do Aluno do";
    htm += '<select  id="idtrimestre" required  class="d-sm-inline-block" >';

    <?php $lista = mysqli_query($conexao, "SELECT * from trimestres where idanolectivo='$idanolectivo' order by titulo desc");
    while ($exibir = $lista->fetch_array()) { ?>
      htm += "<option  value='<?php echo $exibir["idtrimestre"]; ?>'><?php echo $exibir["titulo"]; ?></option>";
    <?php }  ?>

    htm += '  </select>   Trimestre ';

    $("#botaoavaliacao").html(htm);


    $.ajax({
      url: 'cadastro/avaliacaoindividual.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao,
        idturma,
        idtrimestre
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);

      }

    })


  })



  $(document).on("click", "#pauta", function(event) {
    event.preventDefault();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;
    var idturma = "<?php echo $idturma; ?>";


    $.ajax({
      url: 'cadastro/pautaindividual.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao,
        idturma
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);

      }

    })


  })


  $(document).on("click", "#minipauta", function(event) {
    event.preventDefault();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;
    var idturma = "<?php echo $idturma; ?>";




    $.ajax({
      url: 'cadastro/minipautaindividual.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao,
        idturma
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);

      }

    })


  })



  $(document).on("click", "#falta", function(event) {
    event.preventDefault();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;
    var idturma = "<?php echo $idturma; ?>";


    $.ajax({
      url: 'cadastro/faltaindividual.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao,
        idturma
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);

      }

    })


  })



  $(document).on("click", "#cadeira", function(event) {
    event.preventDefault();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;
    var idturma = "<?php echo $idturma; ?>";


    $.ajax({
      url: 'cadastro/cadeiraindividual.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao,
        idturma
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);

      }

    })


  })




  $(document).on("click", "#propina", function(event) {
    event.preventDefault();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao; ?>;
    var idturma = "<?php echo $idturma; ?>";


    $.ajax({
      url: 'cadastro/propinaindividual.php',
      method: 'POST',
      data: {
        idmatriculaeconfirmacao,
        idturma
      },
      success: function(data) {
        $("#mensagemdealerta").html(data);

      }

    })


  })


  $(document).on("change", "#tipodematricula", function(event) {
    event.preventDefault();
    var tipodematricula = $("#tipodematricula option:selected").val();

    var idmatriculaeconfirmacao = <?php echo $idmatriculaeconfirmacao_fora; ?>;


    if (confirm("Tens certeza de que desejas mudar o tipo de inscrição? Dados financeiros serão também alterados")) {
      $(this).closest('tr').remove();
      $.ajax({
        url: 'cadastro/alterarinscricao.php',
        method: 'POST',
        data: {
          tipodematricula,
          idmatriculaeconfirmacao
        },
        success: function(data) {
          $("#mensagemdealertamatricula").html(data);

        }

      })
    }

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