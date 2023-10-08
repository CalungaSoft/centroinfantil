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

 
 
if(isset($_POST['nome'])){

    $nomes=$_POST['nome'];
    $precos=$_POST['preco'];
    $quantidades=$_POST['quantidade'];
    $descontos=$_POST['desconto'];
    $pagos=$_POST['pago'];
    $entregues=$_POST['entregue'];

     if(isset($_POST['idmatriculaeconfirmacao'])){
      $idmatriculaeconfirmacao=$_POST['idmatriculaeconfirmacao'];
       
    }else{
      $idmatriculaeconfirmacao="";
    }

       $dadosdamatricula=mysqli_fetch_array(mysqli_query($conexao, "select idturma, idanolectivo from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 
        
        $idturma=$dadosdamatricula["idturma"];
        $idanolectivo=$dadosdamatricula["idanolectivo"];



    $idaluno=mysqli_escape_string($conexao, trim($_POST["idaluno"]));
    $obs=mysqli_escape_string($conexao, trim($_POST["obs"]));
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST["formadepagamento"]));
    $guardar=mysqli_query($conexao,"INSERT INTO `compras` (`idaluno`,`obs`) VALUES ('$idaluno', 'em fase de cadastramento')");
    $reservarvaga= mysqli_fetch_array(mysqli_query($conexao, "SELECT idcompra from compras where idaluno='$idaluno' and obs='em fase de cadastramento' order by idcompra desc limit 1"))[0]; 
                 
    for ($i=0; $i < count($nomes); $i++) { 
 
        $nome=$nomes[$i];
        $preco=mysqli_escape_string($conexao, trim($precos[$i]));
      
        $quantidade=mysqli_escape_string($conexao, trim($quantidades[$i]));
        $desconto=mysqli_escape_string($conexao, trim($descontos[$i]));
        $pago=mysqli_escape_string($conexao, trim($pagos[$i])); 
        $entregue=mysqli_escape_string($conexao, trim($entregues[$i])); 

        if($nome!=""){

            $idproduto=mysqli_fetch_array(mysqli_query($conexao, "select idproduto from produtos where nomedoproduto='$nome' limit 1"))[0]; 

            if($idproduto!=""){
                 
                  
                $qtd=mysqli_fetch_array(mysqli_query($conexao, "SELECT quantidade from `produtos` WHERE `produtos`.`idproduto` = '$idproduto'"))[0];

                if($idproduto==""){
                echo "<div class='alert alert-danger'>Não foi possível adicionar $nome, pois, não foi encontrado nenhum produto com esse nome, verifique se escreveu correctamente.</div>";
                }else{

                    if($qtd<$quantidade){
                    echo "<div class='alert alert-danger'>Não foi possível adicionar $nome, pois, a quantidade pedida é superior ao stock existente. Quantidade em Stock $qtd, quantidade pedida $quantidade</div>";
                    }else{


                    
                      $guardar=mysqli_query($conexao,"INSERT INTO `compra` (`idproduto`,`idaluno`,`iddacompra`, `preco`, `quantidade`, valorpago, desconto, entregue, idanolectivo) VALUES ('$idproduto', '$idaluno', '$reservarvaga', '$preco', '$quantidade', '$pago', '$desconto', '$entregue', '$idanolectivo')");

                    $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`-'$entregue', ultimavenda=now() WHERE `produtos`.`idproduto` = '$idproduto'");
 
                        if($guardar && $actualizando){
                            echo "<div class='alert alert-primary'>$quantidade $nome Insirido(a) na venda!</div>";
                        }
                    }
                        
                }
               
            }else{
                echo "<div class='alert alert-danger'>Não foi possível adicionar $nome, pois, não foi encontrado nenhum produto com esse nome, verifique se escreveu correctamente.</div>";
            }
        }
    }

  
   
      $dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM alunos where idaluno='$idaluno'"));
      $nomedoaluno=$dadosdoaluno["nomecompleto"]; 
    
     
     
    $listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$reservarvaga' and compra.idproduto=produtos.idproduto");
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
     
     
   
      $guardar=mysqli_query($conexao,"UPDATE `compras` SET `obs` = '$obs', `idfuncionario` = '$idlogado', idatendimento='$idmatriculaeconfirmacao'  WHERE idcompra ='$reservarvaga'");

    
    
      $descricao="Venda de $produtoscomprados";
      $idfuncionario=$idlogado;
    
      $valordeentrada=$totalpago;  
      $divida=$totalvalorproduto-$valordeentrada;
       $divida=round($divida,2);

      

      $guardar=mysqli_query($conexao," INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', 'Material Escolar', '$reservarvaga', '$valordeentrada', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");


                           $identrada=mysqli_fetch_array(mysqli_query($conexao, "SELECT identrada from  entradas where idaluno='$idaluno' and tipo='Material Escolar' order by identrada desc limit 1"))[0]; 


    if($guardar){
        echo "<div class='alert alert-success'>Compra Feita com Sucesso! | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a> </div>";
    }
}
 
?> 