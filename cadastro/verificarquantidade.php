<?php
 
 
 
include("../conexao.php");

$nomedoproduto=$_POST['nomedoproduto'];
$quantidade=$_POST['quantidade'];

$produtoencontrado= mysqli_fetch_array(mysqli_query($conexao, "select quantidade from produtos where nomedoproduto='$nomedoproduto' limit 1"))[0]; 

if($produtoencontrado==""){
 
    echo "";
}else {
    if($quantidade>$produtoencontrado){
        echo '<div class="alert alert-danger">A quantidade de '.$nomedoproduto.' Pedida('.$quantidade.') é maior do que a quantidade em stock('.$produtoencontrado.')</div>';
    } else {
        echo "";
    }
} 
?>
 
 