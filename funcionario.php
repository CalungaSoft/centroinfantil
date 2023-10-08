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



$idfuncionario = $_GET['idfuncionario'];

$anodefuncionario = date('Y');
$mesdefuncionario = date('m');

if ($idfuncionario != $idlogado and $painellogado != "administrador") {
  $erros_de_permissao[] = "Você não tem permissão de ver dados de outro funcionário! <a href='meuperfil.php?anodevenda=" . $anodefuncionario . "&mesdevenda=" . $mesdefuncionario . "'>Clique aqui para ver o seu perfil</a>";
}
if (isset($_POST['editardadospessoais'])) {

  $nomedofuncionario = mysqli_escape_string($conexao, $_POST['nomedofuncionario']);

  if (!empty(trim($nomedofuncionario))) {


    $proveniencia = mysqli_escape_string($conexao, $_POST['proveniencia']);
    $categoria = mysqli_escape_string($conexao, $_POST['categoria']);
    $telefone = mysqli_escape_string($conexao, $_POST['telefone']);
    $localizacao = mysqli_escape_string($conexao, $_POST['localizacao']);
    $naturalidade = mysqli_escape_string($conexao, $_POST['naturalidade']);
    $habilitacoesliteraria = mysqli_escape_string($conexao, $_POST['habilitacoesliteraria']);
    $contabancaria = mysqli_escape_string($conexao, $_POST['contabancaria']);
    $datadeentrada = mysqli_escape_string($conexao, $_POST['datadeentrada']);

    $salario = mysqli_escape_string($conexao, $_POST['salario']);
    $numerodedias = mysqli_escape_string($conexao, $_POST['numerodedias']);
    $numerodehoras = mysqli_escape_string($conexao, $_POST['numerodehoras']);






    $salarioporhora = round(($salario / $numerodedias) / $numerodehoras);

    if (mysqli_num_rows(mysqli_query($conexao, " SELECT idfuncionario FROM funcionarios where nomedofuncionario='$nomedofuncionario' and idfuncionario!='$idfuncionario'")) == 0) {

      $guardar = mysqli_query($conexao, "UPDATE `funcionarios` SET `nomedofuncionario` = '$nomedofuncionario', `categoria` = '$categoria', `telefone` = '$telefone', `localizacao` = '$localizacao', `naturalidade` = '$naturalidade', `proveniencia` = '$proveniencia', `habilitacoesliterarias` = '$habilitacoesliteraria', `contabancaria` = '$contabancaria', `datadeentrada` = '$datadeentrada', `salario` = '$salario', `salarioporhora` = '$salarioporhora', `numerodedias` = '$numerodedias', `numerodehoras` = '$numerodehoras' WHERE `funcionarios`.`idfuncionario` = '$idfuncionario'");

      if ($guardar) {

        $acertos[] = "Dados do Funcionário alterados com Sucesso! ";
      } else {
        $erros[] = "Ocorreu um erro ao alterar dados do funcionário!";
      }
    } else {
      $erros[] = "Já Existe um funcionário como esse nome";
    }
  } else {
    $erros[] = "O nome do funcionário não pode estar vazio";
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
          
          $sql = "UPDATE funcionarios SET caminhodafoto = '$unique_file_name' WHERE idfuncionario = '$idfuncionario'";

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

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Funcionário</h1>


  <?php
  if (!empty($erros)) :
    foreach ($erros as $erros) :
      echo '<div class="alert alert-danger">' . $erros . '</div>';
    endforeach;
  endif;
  ?>
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

 

        
</style>

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
          <h6 class="m-0 font-weight-bold text-primary">Dados do Funcionário</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">



          <!-- Earnings (Monthly) Card Example -->
          <div class="row">


            <?php
            $dadospessoais = mysqli_fetch_array(mysqli_query($conexao, " SELECT * FROM funcionarios where idfuncionario='$idfuncionario' "));

            ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">

                <div class="student-image">
                  <img src="upload/<?php echo $dadospessoais['caminhodafoto'];?>" alt="Imagem do Estudante" class="student-image">
                </div>

                
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dados Pessoais
                        <div id="content-wrapper" class="d-flex flex-column">
                          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                            <div id="content">
                              <ul>
                                <li class="nav-item dropdown no-arrow">
                                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="h5 mb-0 mr-3 font-weight-bold"><?php echo $dadospessoais["nomedofuncionario"]; ?></div>

                                  </a>
                                </li>
                              </ul>
                          </nav>
                        </div>
                      </div>

                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <strong>Naturalidade:</strong> <?php echo $dadospessoais["naturalidade"]; ?> <br>
                          <strong>Habilitação Literária:</strong> <?php echo $dadospessoais["habilitacoesliterarias"]; ?> <br>
                          <strong>Nº de Telefone:</strong> <?php echo $dadospessoais["telefone"]; ?> <br>
                          <strong>Conta Bancária:</strong> <?php echo $dadospessoais["contabancaria"]; ?> <br>
                          <strong>Localização:</strong> <?php echo $dadospessoais["localizacao"]; ?><br>

                          <br>

                          <button id="myBtnfoto" class="btn btn-primary">Ver ou alterar foto</button>


                          <div id="myModalfoto" class="modal">
                            <div class="modal-content">
                              <span id="closefoto"> &times;</span>

                              <form action="#" method="post" enctype="multipart/form-data">
                                <div class="input-group mb-4 mt-4">
                                  <input type="file" accept="image/*" class="form-control" name="nova_foto">
                                  <button type="submit" class="btn btn-success">Alterar Foto</button>
                                </div>
                              </form>


                              <img src="upload/<?php echo $dadospessoais['caminhodafoto']; ?>" alt="Imagem do Estudante">




                              <br><br>
                            </div>
                          </div>



                          <script>
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
                          </script>

                        </div>

                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-6">
                          <!-- Card Header - Accordion -->
                          <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Informações</h6>
                          </a>
                          <!-- Card Content - Collapse -->
                          <div class="collapse in" id="collapseCardExample">
                            <div class="card-body">
                              <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                  <label>Nome</label>
                                  <input type="text" name="nomedofuncionario" required="" class="form-control" title="Digite o nome completo do Funcionário" value="<?php echo $dadospessoais["nomedofuncionario"]; ?>">
                                </div>

                                <div class="form-group">
                                  <label>Proveniencia</label>
                                  <input type="text" name="proveniencia" required="" class="form-control" value="<?php echo $dadospessoais["proveniencia"]; ?>">
                                </div>

                                <div class="form-group">
                                  <label>Categoria</label>
                                  <input type="text" name="categoria" class="form-control" title="Digite a categoria do funcionário" value="<?php echo $dadospessoais["categoria"]; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Telefone</label>
                                  <input type="text" name="telefone" class="form-control" title="Digite o Número de telefone do Funcionário" value="<?php echo $dadospessoais["telefone"]; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Natural</label>
                                  <input type="text" name="naturalidade" class="form-control" title="Digite a Naturalidade do funcionario" value="<?php echo $dadospessoais["naturalidade"]; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Localização</label>
                                  <input type="text" name="localizacao" class="form-control" title="Digite a Zona Onde mora o Funcionário" value="<?php echo $dadospessoais["localizacao"]; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Habilitação Literária</label>
                                  <input type="text" name="habilitacoesliteraria" class="form-control" title="Digite a Habilitação literária do Funcionário, Ex: 3º ano do Ensino Superior no curso de Mecânica" value="<?php echo $dadospessoais["habilitacoesliterarias"]; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Conta Bancária</label>
                                  <input type="text" name="contabancaria" class="form-control" title="Digite a  conta bancária do funcionário, pode ser também o IBAN, depois dê um espaço e ddigite o nome do Banco" value="<?php echo $dadospessoais["contabancaria"]; ?>">
                                </div>
                                <div class="form-group">
                                  <label>Data de Entrada na Empresa</label>
                                  <input type="text" name="datadeentrada" class="form-control" title="Digite a data em que o funcionário entrou na empresa" value="<?php echo $dadospessoais["datadeentrada"]; ?>">
                                </div>

                                <div class="form-group row">
                                  <div class="col-sm-4 mb-3 mb-sm-0">
                                    <span>Salario Mensal Base</span>
                                    <input type="number" id="salariobase" name="salario" required="" class="form-control" title="Digite o salário base que o funcionário receberá, digite apenas o valor numérico" value="<?php echo $dadospessoais["salario"]; ?>">
                                  </div>
                                  <div class="col-sm-4">
                                    <span>Dias de trabalho por mês</span>
                                    <input type="number" id="numerodedias" name="numerodedias" required="" class="form-control" title="Total de dias por mês que esse trabalhador trabalha" value="<?php echo $dadospessoais["numerodedias"]; ?>">
                                  </div>
                                  <div class="col-sm-4">
                                    <span>Horas de trabalho diárias</span>
                                    <input type="number" id="numerodehoras" name="numerodehoras" required="" class="form-control" title="Total de Horas por dia que esse trabalhador trabalha" value="<?php echo $dadospessoais["numerodehoras"]; ?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <span>Salário Por Hora</span>
                                  <input type="number" id="salarioporhora" disabled="" class="form-control " value="<?php echo $dadospessoais["salarioporhora"]; ?>">
                                </div>




                                <div id="info"> </div>

                                <div id="sms"> </div>




                                <div class="form-group">
                                  <input type="submit" name="editardadospessoais" value="Guardar Novas Informações" class="btn btn-success" title="Clique aqui para guardar as informação do funcionário no sistema">
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- Collapsable Card Example -->
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <?php


            $totaldehorastrabalhadas = mysqli_num_rows(mysqli_query($conexao, "select idfalta from presenca where idfuncionario='$idfuncionario'"));


            ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dados Profissionais</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $dadospessoais["categoria"]; ?></div>
                          <br>
                          <strong>Proveniência </strong>: <?php echo $dadospessoais["proveniencia"]; ?> <br>
                          <strong>Data de Entrada no Sistema </strong>: <?php echo $dadospessoais["datadeentradanosistema"]; ?> <br>
                          <strong>Data de entrada na empresa</strong>: <?php echo $dadospessoais["datadeentrada"]; ?> <br>
                          <strong>Salário Base</strong>: <?php echo $dadospessoais["salario"]; ?>KZ : Por Hora: <?php echo $dadospessoais["salarioporhora"]; ?>KZ <br> <strong>Total de Dias de trabalho</strong>: <?php echo $totaldehorastrabalhadas + 0; ?> dias<br>


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



      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Histórico de Salário Relacionadas a esse funcionário</h6>
        </div>
        <div class="card-body">

          <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Cargo</th>
                  <th>Salario Base</th>
                  <th title="Salário actual do funcionáio">Salário/H</th>
                  <th>Faltas</th>
                  <th title="total de horas trabalhadas durante o mês">Total de Horas</th>
                  <th title="total de horas extras durante o mês">Horas Extras</th>
                  <th title="total em salário de horas extras durante o mês">Total Extras</th>
                  <th>Salário Bruto</th>
                  <th title="Abono de Família">Abono de F.</th>
                  <th title="Percentual do IRT">IRT</th>
                  <th title="Segurança Social">Seg. Social</th>
                  <th title="Subsídio de Férias">Subsídio F.</th>
                  <th title="Subsídio de Natal">Subsídio N.</th>
                  <th title="Outros Descontos">O. Desc.</th>
                  <th title="total em valor que o funcionário deve receber">Salário Líquido</th>

                  <th title="total de valor que o funcionário recebeu">Valor Recebido</th>
                  <th title="Total em valores que o funcionário falta receber">Em falta</th>
                  <th>Forma de Pagamento</th>
                  <th>Data de Pagamento</th>
                  <th title="Observação">OBS</th>
                  <th>Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $folhadesalario = mysqli_query($conexao, "select funcionarios.nomedofuncionario, funcionarios.categoria,  salario.* from funcionarios, salario where funcionarios.idfuncionario=salario.idfuncionario and salario.idfuncionario='$idfuncionario'");

                $totalsalarioporhora = 0;
                $totalextra = 0;
                $totalirt = 0;
                $totalsalarioliquido = 0;
                $totalrecebido = 0;
                $totalsalariobase = 0;
                $totalsubsidiodeferias = 0;
                $totalsubsidionatal = 0;
                $totalabonodefamilia = 0;
                $totalsegurancasocial = 0;
                $totaloutrosdescontos = 0;
                $totalemfalta = 0;
                $totalsalariobruto = 0;

                while ($exibir = $folhadesalario->fetch_array()) {
                  $salariobruto = $exibir['salariobruto'] + $exibir['abonodefamilia'];
                  $irt = ($salariobruto * ($exibir['irt'] / 100));
                  $segurancasocial = (($salariobruto - $irt) * ($exibir['segurancasocial'] / 100));
                  $subsidiodenatal = (($salariobruto - $irt - $segurancasocial) * ($exibir['subsidiodenatal'] / 100));
                  $subsidiodeferias = (($salariobruto - $irt - $segurancasocial) * ($exibir['subsidiodeferias'] / 100));

                  $falta = $exibir['valorporreceber'] - $exibir['valorrecebido'];
                ?>
                  <tr>

                    <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
                    <td><?php echo $exibir['categoria']; ?></td>
                    <td><?php $totalsalariobase = $totalsalariobase + $exibir['salarioactualbase'];
                        $n = number_format($exibir['salarioactualbase'], 2, ",", ".");
                        echo $n; ?></td>
                    <td><?php $totalsalarioporhora = $totalsalarioporhora + $exibir['salarioactualporhora'];
                        $n = number_format($exibir['salarioactualporhora'], 2, ",", ".");
                        echo $n; ?></td>
                    <td><?php echo $exibir['faltas']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['horastrabalhadas']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['horasextras']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $totalextra = $totalextra + $exibir['valorextra'];
                                                                            echo $exibir['valorextra']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $totalsalariobruto = $totalsalariobruto + $exibir['salariobruto'];
                                                                            echo $exibir['salariobruto']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $totalabonodefamilia = $totalabonodefamilia + $exibir['abonodefamilia'];
                                                                            echo $exibir['abonodefamilia']; ?></td>
                    <td title="IRT:<?php echo $exibir["irt"]; ?>%"><?php $totalirt = $totalirt + $irt;
                                                                    $n = number_format($irt, 2, ",", ".");
                                                                    echo "$n"; ?></td>
                    <td title="Segurança Social:<?php echo $exibir["segurancasocial"]; ?>%"><?php $totalsegurancasocial = $totalsegurancasocial + $segurancasocial;
                                                                                            $n = number_format($segurancasocial, 2, ",", ".");
                                                                                            echo "$n"; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php $totalsubsidiodeferias = $totalsubsidiodeferias + $subsidiodeferias;
                                                                            echo $subsidiodeferias; ?></td>
                    <td title="Subsídio de Natal:<?php echo $exibir["subsidiodenatal"]; ?>%"><?php $totalsubsidionatal = $totalsubsidionatal + $subsidiodenatal;
                                                                                              $n = number_format($subsidiodenatal, 2, ",", ".");
                                                                                              echo "$n"; ?></td>
                    <td <?php $totaloutrosdescontos = $totaloutrosdescontos + $exibir["outrosdescontos"]; ?> title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['outrosdescontos']; ?></td>
                    <td><?php $totalsalarioliquido = $totalsalarioliquido + $exibir["valorporreceber"];
                        $n = number_format($exibir["valorporreceber"], 2, ",", ".");
                        echo "$n"; ?></td>
                    <td><?php $totalrecebido = $totalrecebido + $exibir["valorrecebido"];
                        $n = number_format($exibir["valorrecebido"], 2, ",", ".");
                        echo "$n"; ?></td>
                    <td><?php $totalemfalta = $totalemfalta + $falta;
                        $n = number_format($falta, 2, ",", ".");
                        echo "$n"; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['formapagamento']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['datadepagamento']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>"><?php echo $exibir['obs']; ?></td>
                    <td title="<?php echo $exibir["nomedofuncionario"]; ?>">
                      <a href="" class="delete" id="<?php echo $exibir["idsalario"]; ?>"><i style="color:red;" title="Eliminar Registro" class="fas fa-trash"></i></a>
                      <a href="pdf/pdfcomprovativo.php?idsalario=<?php echo $exibir["idsalario"]; ?>&idfuncionario=<?php echo $exibir["idfuncionario"]; ?>" title="Imprimir comprovativo de pagamento"> <i style="color:green;" class="fas fa-print"></i></a>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
              <tfoot>
                <?php
                $totalsalarioporhora = number_format($totalsalarioporhora, 2, ",", ".");
                $totalextra = number_format($totalextra, 2, ",", ".");
                $totalirt = number_format($totalirt, 2, ",", ".");
                $totalsalarioliquido = number_format($totalsalarioliquido, 2, ",", ".");
                $totalrecebido = number_format($totalrecebido, 2, ",", ".");
                $totalsalariobase = number_format($totalsalariobase, 2, ",", ".");
                $totalabonodefamilia = number_format($totalabonodefamilia, 2, ",", ".");
                $totalsubsidiodeferias = number_format($totalsubsidiodeferias, 2, ",", ".");
                $totalsubsidionatal = number_format($totalsubsidionatal, 2, ",", ".");
                $totalsegurancasocial = number_format($totalsegurancasocial, 2, ",", ".");
                $totalemfalta = number_format($totalemfalta, 2, ",", ".");
                $totalsalariobruto = number_format($totalsalariobruto, 2, ",", ".");
                $totaloutrosdescontos = number_format($totaloutrosdescontos, 2, ",", ".");
                ?>
                <tr>
                  <th><strong>Total</strong></th>
                  <th></th>
                  <th><?php echo $totalsalariobase; ?></th>
                  <th><?php echo $totalsalarioporhora; ?></th>
                  <th></th>
                  <th></th>
                  <th> </th>
                  <th><?php echo $totalextra; ?></th>
                  <th><?php echo $totalsalariobruto; ?></th>
                  <th><?php echo $totalabonodefamilia; ?></th>
                  <th><?php echo $totalirt; ?></th>
                  <th><?php echo $totalsegurancasocial; ?></th>
                  <th><?php echo $totalsubsidiodeferias; ?></th>
                  <th><?php echo $totalsubsidionatal; ?></th>
                  <th><?php echo $totaloutrosdescontos; ?></th>
                  <th><?php echo $totalsalarioliquido; ?></th>
                  <th><?php echo $totalrecebido; ?></th>
                  <th><?php echo $totalemfalta; ?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>


      <!-- DataTales Example -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
  $(document).on("click", ".delete", function(event) {
    event.preventDefault();
    var id = $(this).attr("id");
    console.log(id)
    if (confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")) {
      $(this).closest('tr').remove();
      $.ajax({
        url: 'cadastro/deletesalario.php',
        method: 'POST',
        data: {
          id: id
        },
        success: function(data) {
          $("#mensagemdealerta").html(data);

        }

      })
    }

  })



  $(document).on("blur", "#salariobase", function(event) {

    var salario = $("#salariobase").val();
    var dias = $("#numerodedias").val();
    var horas = $("#numerodehoras").val();

    var x = ((salario / dias) / horas);
    var salarioporhora = Math.round(x);
    $("#salarioporhora").val(salarioporhora);

  })

  $(document).on("blur", "#numerodedias", function(event) {

    var salario = $("#salariobase").val();
    var dias = $("#numerodedias").val();
    var horas = $("#numerodehoras").val();

    var x = ((salario / dias) / horas);
    var salarioporhora = Math.round(x);
    $("#salarioporhora").val(salarioporhora);

  })
  $(document).on("blur", "#numerodehoras", function(event) {

    var salario = $("#salariobase").val();
    var dias = $("#numerodedias").val();
    var horas = $("#numerodehoras").val();
    var x = ((salario / dias) / horas);
    var salarioporhora = Math.round(x);
    $("#salarioporhora").val(salarioporhora);

  })
</script>
<!-- Page level plugins -->
<!-- Footer -->

</nav>



<?php include("estilocarde.php"); ?>

<div id="myModal2" class="modal">
  <div class="modal-content">
    <span id="close2">&times;</span>
    <div id="formularioresposta"></div>
  </div>
</div>



<script>
  var modal2 = document.getElementById("myModal2");

  var span2 = document.getElementById("close2");

  $(document).on("click", ".vender", function(event) {
    event.preventDefault();

    modal2.style.display = "block";
    var id = $(this).data('id')


    $.ajax({
      url: 'cadastro/verpostosdosfuncionarios.php',
      method: 'POST',
      data: {
        id: id
      },
      success: function(data) {
        $('#formularioresposta').html(data);
      }
    })


  })

  span2.addEventListener("click", () => {
    modal2.style.display = "none";
  })
  window.onclick = (event) => {
    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
</script>

<?php if ($idlogado != $idfuncionario) { ?>
  <span id="mensagemdealertadeeliminacao"></span>
  <!-- Collapsable Card Example -->
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample2">
      <h6 class="m-0 font-weight-bold text-primary">Opções Avançadas | <span style="color: red"> Eliminar funcionario da empresa</span></h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse in" id="collapseCardExample2">
      <div class="card-body" style="color: red">
        Essa Opção serve para ELIMINAR TODOS OS DADOS DESSE funcionario NO SISTEMA <br>

        <?php if ($painellogado == "administrador") { ?>
          <div class="form-group"><br>
            <a href="" id="primeirapergunta" class="btn btn-danger" title="Ao Clicares aqui, você irá eliminar todos os dados gerais, todo seu histórico na empresa todas informações relacionadas com essa actual funcionario">Eliminar esse Funcionário</a>
          </div>
        <?php } else {
          echo "<br>Você não tem permissão de eliminar um funcionario do sistema, contacte o administrador!";
        } ?>
      </div>
    </div>
  </div>
  <!-- Collapsable Card Example -->
<?php } ?>
<script>
  $(document).on("click", "#primeirapergunta", function(event) {
    event.preventDefault();

    var idfuncionario = <?php echo $idfuncionario; ?>;
    if (confirm("Tens certeza que queres eliminar esse funcionário? Serão eliminados todos os dados financeiros, relacionados com esse funcionario!")) {


      $.ajax({
        url: 'cadastro/deletefuncionario.php',
        method: 'POST',
        data: {
          idfuncionario: idfuncionario
        },
        success: function(data) {
          $("#mensagemdealertadeeliminacao").html(data);

        }

      })
    }

  })
</script>

 

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

</body>

</html>