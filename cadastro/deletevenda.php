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

   $iddacompra=mysqli_escape_string($conexao, $_POST['id']);
 $tipo='Material Escolar';
      
           $entradaantiga=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valor, sum(divida) as divida, entradas.* FROM entradas where `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo'"));
                    
           $descricaoantiga=$entradaantiga["descricao"];
           $valorantigoh=number_format($entradaantiga["valor"],2,",", "."); 
           $dividaantigoh=number_format($entradaantiga["divida"],2,",", ".");  

           $antigo="$descricaoantiga | Valor: $valorantigoh KZ | Dívida $dividaantigoh KZ";
           $novo="ELIMINADO";
           
           $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
         

           $listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$iddacompra' and compra.idproduto=produtos.idproduto");
                    
            
           while($exibir = $listadeprodutos->fetch_array()){ 

                  $idnacompra=$exibir["idcompra"];

            $dados=mysqli_fetch_array(mysqli_query($conexao, "select entregue, idproduto, iddacompra from compra where idcompra='$idnacompra'")); 
            $quantidade=$dados["entregue"];
            $idproduto=$dados["idproduto"]; 
        
              $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`+'$quantidade' WHERE idproduto = '$idproduto'");
    
              
           }

           if($guardar2){
           
            $deletando=mysqli_query($conexao, "Delete from compra where iddacompra='$iddacompra'");

               if($deletando){

                  $deletando2=mysqli_query($conexao, "Delete from compras where idcompra='$iddacompra'");

                     if($deletando2){

                        $deletando3=mysqli_query($conexao, "Delete from entradas where idtipo='$iddacompra' and tipo='$tipo'");


                     }
               }

           }
         
  
        if($guardar2 && $deletando && $deletando2 && $deletando3){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | <a href="index.php">Clique aqui para voltar a página principal!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>