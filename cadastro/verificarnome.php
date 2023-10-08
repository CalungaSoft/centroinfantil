<?php
 
 
 
include("../conexao.php");

 
if(isset($_POST['nomes'])){
    $nomes=$_POST['nomes'];

    for ($i=0; $i < count($nomes); $i++) { 
        $nome=$nomes[$i];

        if($nome!=""){

            $produtoencontrado=mysqli_num_rows(mysqli_query($conexao, "select nomedoproduto from produtos where nomedoproduto='$nome' limit 1")); 

            if($produtoencontrado==0){
                echo '<div class="alert alert-danger">O Produto '.$nome.'  não Existe, por favor elimine-o!</div>';
            
               
            }else{
                echo "";
            }
        }
    }
}
 

?>