<?php
include("../conexao.php");

        $nomedofuncionario=$_POST['nomedofuncionario'];
        $cargo=$_POST['cargo'];
        $telefone=$_POST['telefone'];
        $localizacao=$_POST['localizacao'];
        $numerodobi=$_POST['numerodobi'];
        $datadenascimento=$_POST['datadenascimento'];
        $habilitacoesliteraria=$_POST['habilitacoesliteraria'];
        $contabancaria=$_POST['contabancaria'];
        $datadeentradanaescola=$_POST['datadeentradanaescola'];
        $salario=$_POST['salario'];
        $nomedeusuario=$_POST['nomedeusuario'];
        $senha=$_POST['senha'];
        $painel=$_POST['painel'];
       
        if($senha==""){
          $senha="calungaSOFT";
        }
        if($nomedeusuario==""){
          $nomedeusuario="calungaSOFT";
        }

        $guardar=mysqli_query($conexao,"INSERT INTO `funcionarios` (`idfuncionario`, `nomedofuncionario`, `cargo`, `telefone`, `localizacao`, `numerodobi`, `datadenascimento`, `habilitacoesliterarias`, `contabancaria`, `datadeentradanaescola`, `salario`, `user`, `senha`, `painel`) VALUES (NULL, '$nomedofuncionario', '$cargo', '$telefone', '$localizacao', '$numerodobi',  STR_TO_DATE('$datadenascimento', '%d/%m/%Y'), '$habilitacoesliteraria', '$contabancaria', STR_TO_DATE('$datadeentradanaescola', '%d/%m/%Y'), '$salario', '$nomedeusuario', '$senha', '$painel')");
        if($guardar){
            echo '<div class="alert alert-success">Funcionário Cadastrado com Sucesso! <a href="">Clique para recarregar a página</a></div>';
        }else{
            echo  '<div class="alert alert-danger">Ocorreu um erro ao cadastrar o funcionário!</div>';
        }



        
if(isset($_POST['cadastrarmaterial'])){
  $material= $_POST['material'];
  $preco= $_POST['preco'];
  $quantidade= $_POST['quantidade'];
  $marcas= $_POST['marcas']; 

  $salvar= mysqli_query($conexao,"INSERT INTO materiais (tipodematerial, preco , quantidade, marcas) VALUES ('$material', '$preco', '$quantidade', '$marcas')");
   
  
if(!$salvar){
  echo "Ocorreu um ERRO, verifique se todos os campos foram devidamente preenchidos!";
  
} else{
  echo "material cadastrado com sucesso!";
}

}
?>