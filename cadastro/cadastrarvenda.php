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

    $idcliente=mysqli_escape_string($conexao, trim($_POST["idcliente"]));
    $obs=mysqli_escape_string($conexao, trim($_POST["obs"]));
    $guardar=mysqli_query($conexao,"INSERT INTO `compras` (`idcliente`,`obs`) VALUES ('$idcliente', 'em fase de cadastramento')");
    $reservarvaga= mysqli_fetch_array(mysqli_query($conexao, "SELECT idcompra from compras where idcliente='$idcliente' and obs='em fase de cadastramento' order by idcompra desc limit 1"))[0]; 
                 
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

                      if($entregue>$quantidade){
                        
                        echo "<div class='alert alert-danger'>Não foi possível adicionar $nome, pois, a quantidade entregue é superior a quantidade comprada. Quantidade em comprada $quantidade, quantidade entregue $entregue</div>";

                      }else{
                  
                        if($qtd<$quantidade){
                            echo "<div class='alert alert-danger'>Não foi possível adicionar $nome, pois, a quantidade pedida é superior ao stock existente. Quantidade em Stock $qtd, quantidade pedida $quantidade</div>";
                            }else{


                            
                            $guardar=mysqli_query($conexao,"INSERT INTO `compra` (`idproduto`,`idcliente`,`iddacompra`, `preco`, `quantidade`, valorpago, desconto, entregue) VALUES ('$idproduto', '$idcliente', '$reservarvaga', '$preco', '$quantidade', '$pago', '$desconto', '$entregue')");

                            $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`-'$entregue', ultimavenda=now() WHERE `produtos`.`idproduto` = '$idproduto'");
        
                                if($guardar && $actualizando){
                                    echo "<div class='alert alert-primary'>$quantidade $nome Insirido(a) na venda!</div>";
                                }
                            }
                  }
                        
                }
               
            }else{
                echo "<div class='alert alert-danger'>Não foi possível adicionar $nome, pois, não foi encontrado nenhum produto com esse nome, verifique se escreveu correctamente.</div>";
            }
        }
    }

  
   
      $dadosdocliente=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM clientes where idcliente='$idcliente'"));
      $nomedocliente=$dadosdocliente["nomedocliente"]; 
    
      $factura=mysqli_fetch_array(mysqli_query($conexao, "select factura from entradas order by factura desc limit 1"))[0]+1;
     
    
     
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
     
     
    if(isset($_POST['idatendimento'])){
      $idantendimento=$_POST['idatendimento'];
       
    }else{
      $idantendimento="";
    }

      $guardar=mysqli_query($conexao,"UPDATE `compras` SET `obs` = '$obs', `idfuncionario` = '$idlogado', idatendimento='$idantendimento'  WHERE idcompra ='$reservarvaga'");

      $guardar=mysqli_query($conexao,"UPDATE `clientes` SET `ultimacompra` = CURRENT_TIMESTAMP  WHERE idcliente ='$idcliente'");
    
      $descricao="Venda para o cliente($nomedocliente)| $produtoscomprados";
      $idfuncionario=$idlogado;
    
      $valordeentrada=$totalpago;  
      $divida=$totalvalorproduto-$valordeentrada;
    
       
      $guardar=mysqli_query($conexao,"INSERT INTO `entradas` (`idfuncionario`, `descricao`, `factura`, `valor`, `divida`, `idcompra`, `idcliente`) VALUES ('$idfuncionario', '$descricao', '$factura','$valordeentrada', '$divida', '$reservarvaga', '$idcliente')");
 

    if($guardar){
        echo "<div class='alert alert-success'>Compra Feita com Sucesso! <a href=''> Clique aqui para Terminar a Venda!</a></div>";
    }
}
 

?>