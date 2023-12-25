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
$obsavaliacao = mysqli_escape_string($conexao, $_POST['obsavaliacao']);
$datadaavaliacao = mysqli_escape_string($conexao, $_POST['datadaavaliacao']);



$dados_da_matriculaeconfirmacao = mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));
$idaluno = $dados_da_matriculaeconfirmacao["idaluno"];

 
if (trim($idmatriculaeconfirmacao) != '') {



    $jaexiste = mysqli_num_rows(mysqli_query($conexao, "SELECT id FROM avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y') limit 1"));


    if ($jaexiste != 0) {

        $dados_da_avaliacao = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM avaliacoesdosalunos where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y') order by id desc limit 1"));
        

        $salvar = mysqli_query($conexao, "UPDATE `avaliacoesdosalunos` SET `observacao` = '$obsavaliacao' WHERE  idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and datadaavaliacao=STR_TO_DATE('$datadaavaliacao', '%d/%m/%Y')");


        if ($salvar) {

            echo '<div class="alert alert-success">Observação Actualizada com sucesso!</div>';
        }
        
 
    }  
} else {


    echo '<div class="alert alert-danger">Nenhuma opção selecionada</div>';
}
