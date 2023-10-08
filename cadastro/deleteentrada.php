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

        $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM compra where idcompra='$id'"));
        
        $iddacompra=$dados["iddacompra"];
        $idaluno=$dados["idaluno"]; 
        $valordesaida=($dados["valorpago"])*(-1);
        $quantidade=$dados["entregue"];
        $idproduto=$dados["idproduto"]; 
    
          $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`+'$quantidade' WHERE idproduto = '$idproduto'");

          
        $deletando=mysqli_query($conexao, "Delete from compra where idcompra='$id'");


                
 
                    $listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$iddacompra' and compra.idproduto=produtos.idproduto");
                    
                    $produtoscomprados="";

                    $cont=1;
                    $totalvalorproduto=0;
                    $totalpago=0;
                    while($exibir = $listadeprodutos->fetch_array()){ 
                        $totalvalorproduto+=($exibir["preco"]*$exibir["quantidade"])-$exibir["desconto"];
                        $totalpago+=$exibir["valorpago"];
                        if($cont==1){
                          $produtoscomprados.="$exibir[quantidade]  $exibir[nomedoproduto]";
                        }else{
                          $produtoscomprados.=", $exibir[quantidade] $exibir[nomedoproduto]";
                        }
                        $cont++;
                    }
                     
                    $dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT nomecompleto FROM alunos where idaluno='$idaluno'"));
                    $nomedoaluno=$dadosdoaluno["nomecompleto"]; 

                    
                    $descricao="Venda para o aluno($nomedoaluno)| $produtoscomprados";
                    $idfuncionario=$idlogado;

                    $valordeentrada=$totalpago;  
                    $divida=$totalvalorproduto-$valordeentrada;
                        $divida=round($divida,2);

                    $entradaantiga=mysqli_fetch_array(mysqli_query($conexao," SELECT descricao, sum(valor) as valor, sum(divida) as divida  FROM entradas where `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo'"));
                    $zerando=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` = '0' WHERE `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo'");
                    $guardar=mysqli_query($conexao,"UPDATE `entradas` SET `descricao` = '$descricao' WHERE `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo' order by identrada asc limit 1");
                    
                    $dadosdaentrada=mysqli_fetch_array(mysqli_query($conexao, "select * from entradas where `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo' order by identrada asc limit 1"));
          
                    $descricao="Actualização($dadosdaentrada[descricao])";
                    $tipo='Material Escolar';
                    $formadepagamento=$dadosdaentrada["formadepagamento"];
                    $idturma=$dadosdaentrada['idturma'];
                    $idanolectivo=$dadosdaentrada['idanolectivo']; 
                    $idaluno=$dadosdaentrada['idaluno']; 



                    if($guardar && $zerando){
                       
                        $novaentrada=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', '$tipo','$iddacompra', '$valordesaida', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                  }

 
           $descricaoantiga=$entradaantiga["descricao"];
           $valorantigoh=number_format($entradaantiga["valor"],2,",", "."); 
           $dividaantigoh=number_format($entradaantiga["divida"],2,",", ".");  

           $antigo="$descricaoantiga | Valor: $valorantigoh KZ | Dívida $dividaantigoh KZ";
           $novo="$descricao | Valor: $valordeentrada KZ | Dívida $divida KZ";
           
           $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
         
         
  
        if($guardar && $guardar2){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>