<?php
 
 
include("../conexao.php");

$nomedoproduto=$_POST['tipodeproduto'];
$produtoencontrado= mysqli_fetch_array(mysqli_query($conexao, "select preco from produtos where nomedoproduto='$nomedoproduto' limit 1"))[0]; 

if($produtoencontrado==""){
    $produtoencontrado=0;
}
echo " <script>
        var v=".$produtoencontrado." 
        </script>
  "; 
?>