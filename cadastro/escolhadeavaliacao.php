<?php

include("../conexao.php");


session_start();

if (!isset($_SESSION['logado'])) :
    header('Location: login.php');
endif;

$nome = $_SESSION['nomedofuncionariologado'];

$idlogado = $_SESSION['funcionariologado'];
$nomelogado = $_SESSION['nomedofuncionariologado'];
$painellogado = $_SESSION['painel'];





$idmatriculaeconfirmacao = mysqli_escape_string($conexao, $_POST['idmatriculaeconfirmacao']);
$escolha = mysqli_escape_string($conexao, $_POST['escolha']);
$idavaliacao = mysqli_escape_string($conexao, $_POST['idavaliacao']);



$dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));
$idaluno = $dados_da_matriculaeconfirmacao["idaluno"];


if (trim($escolha) != '') {




    $salvar = mysqli_query($conexao, "INSERT INTO `avaliacoesdosalunos` ( `idmatriculaeconfirmacao`, idaluno,idavaliacao,resposta,observacao,datadaavaliacao) VALUES ('$idmatriculaeconfirmacao', '$idaluno','$idavaliacao', '$escolha', STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y'), '$obs')");


    $dadosdanota = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM ementamensal where dia='$data' and tipoderefeicao='$tipoderefeicao' limit 1"));

    $descricaodarefeicao_antiga = $dadosdanota["descricaodarefeicao"];
    $idementa = $dadosdanota["id"];

    if ($descricaodarefeicao != $descricaodarefeicao_antiga) {

        $actualizar = mysqli_query($conexao, "UPDATE `ementamensal` SET `descricaodarefeicao` = '$descricaodarefeicao' WHERE id = '$idementa'");

        if ($actualizar) {

            echo '<div class="alert alert-success">' . $descricaodarefeicao . ' - Ementa Mensal Actualizada com sucesso!</div>';
        }
    }
} else {


    echo '<div class="alert alert-danger">O campo está vazio</div>';
}
