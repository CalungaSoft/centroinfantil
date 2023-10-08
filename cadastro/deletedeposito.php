<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["id"])){

   $id=mysqli_escape_string($conexao, $_POST['id']);

        $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM stock where idstock='$id'"));

   
        $quantidade=$dados["quantidade"];
        $precodecompra=$dados["precodecompra"];
        $precodevenda=$dados["precodevenda"];
        $idproduto=$dados["idproduto"];
 
        $dadosdoproduto=mysqli_fetch_array(mysqli_query($conexao," SELECT produtos.nomedoproduto, produtos.quantidade FROM produtos where produtos.idproduto='$idproduto'"));
        
        $nomedoproduto=$dadosdoproduto["nomedoproduto"];
        $quantidadeantiga=$dadosdoproduto["quantidade"];


           $idfuncionario=$idlogado;

           $precodecompra=number_format($precodecompra,2,",", "."); 
           $precodevenda=number_format($precodevenda,2,",", ".");  

           $antigo="Deposito do produto $nomedoproduto| Quantidade: $quantidade; Preço de compra:$precodecompra KZ | Preço de venda: $precodevenda KZ";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
         
           $quantidadedebitada=$quantidadeantiga-$quantidade;
           if($quantidadedebitada<0){
               $quantidadedebitada=0;
           }
           $salvar= mysqli_query($conexao,"UPDATE `produtos` SET `quantidade` ='$quantidadedebitada'  WHERE `produtos`.`idproduto` = '$idproduto'");

  
        if(mysqli_query($conexao, "Delete from stock where idstock='$id'")){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>