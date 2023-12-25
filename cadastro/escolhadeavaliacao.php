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
$datadaavaliacao = mysqli_escape_string($conexao, $_POST['datadaavaliacao']);



$dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));
$idaluno = $dados_da_matriculaeconfirmacao["idaluno"];
 
$nomeDaAvaliacao = mysqli_fetch_array(mysqli_query($conexao, "select titulo from tiposdeavalicoes where id='$idavaliacao' limit 1"))[0];

if (trim($escolha) != '') {



    $jaexiste = mysqli_num_rows(mysqli_query($conexao, "SELECT id FROM avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and idavaliacao='$idavaliacao' and datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y') limit 1"));


    if ($jaexiste == 0) {


        $salvar = mysqli_query($conexao, "INSERT INTO `avaliacoesdosalunos` ( `idmatriculaeconfirmacao`, idaluno,idavaliacao,resposta,observacao,datadaavaliacao) VALUES ('$idmatriculaeconfirmacao', '$idaluno','$idavaliacao', '$escolha','', STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y'))");

        if ($salvar) {

            echo '<div class="alert alert-success">Avaliação ' . $nomeDaAvaliacao . '  Inserida com sucesso! ( ' . $escolha . ' )</div>';
        }
    } else {


        $dados_da_avaliacao = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and idavaliacao='$idavaliacao' limit 1"));
        -$idavaliacao = $dados_da_avaliacao["id"];

        $salvar = mysqli_query($conexao, "UPDATE `avaliacoesdosalunos` SET `resposta` = '$escolha' WHERE `avaliacoesdosalunos`.`id` = '$idavaliacao'");


        if ($salvar) {

            echo '<div class="alert alert-success">Avaliação ' . $nomeDaAvaliacao . '  Actualizada com sucesso! para ' . $escolha . '</div>';
        }
    }
} else {


    echo '<div class="alert alert-danger">Nenhuma opção selecionada</div>';
}
