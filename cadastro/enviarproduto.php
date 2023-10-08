<?php 
include("../conexao.php");

$tipodeproduto=$_POST['tipodeproduto'];  
$preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
$quantidade=mysqli_escape_string($conexao, trim($_POST['quantidade']));  
$idcliente=mysqli_escape_string($conexao, trim($_POST['idcliente']));  
$valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));  

$reservarvaga=mysqli_fetch_array(mysqli_query($conexao, "select idcompra from compras where idcliente='$idcliente' and obs='em fase de cadastramento' limit 1"))[0]; 
if($reservarvaga==""){
    $guardar=mysqli_query($conexao,"INSERT INTO `compras` (`idcliente`,`obs`) VALUES ('$idcliente', 'em fase de cadastramento')");
    $reservarvaga= mysqli_fetch_array(mysqli_query($conexao, "select idcompra from compras where idcliente='$idcliente' and obs='em fase de cadastramento' limit 1"))[0]; 
}
$idproduto= mysqli_fetch_array(mysqli_query($conexao, "select idproduto from produtos where nomedoproduto='$tipodeproduto' limit 1"))[0]; 

$qtd=mysqli_fetch_array(mysqli_query($conexao, "SELECT quantidade from `produtos` WHERE `produtos`.`idproduto` = '$idproduto'"))[0];

if($idproduto==""){
  echo "<div class='alert alert-danger'>Não foi possível adicionar $tipodeproduto, pois, não foi encontrado nenhum produto com esse nome, verifique se escreveu correctamente.</div>";
}else{

    if($qtd<$quantidade){
      echo "<div class='alert alert-danger'>Não foi possível adicionar $tipodeproduto, pois, a quantidade pedida é superior ao stock existente. Quantidade em Stock $qtd, quantidade pedida $quantidade</div>";
    }else{


      
    $guardar=mysqli_query($conexao,"INSERT INTO `compra` (`idproduto`,`idcliente`,`iddacompra`, `preco`, `quantidade`, valorpago) VALUES ('$idproduto', '$idcliente', '$reservarvaga', '$preco', '$quantidade', '$valorpago')");

    $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`-'$quantidade', ultimavenda=now() WHERE `produtos`.`idproduto` = '$idproduto'");

    echo "<div class='alert alert-success'> $tipodeproduto Adicionado com sucesso!</div>";
    }
        
}


$listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.*, produtos.quantidade as restante, compra.quantidade as quantidadedacompra  FROM `compra`, produtos where  compra.iddacompra='$reservarvaga' and compra.idproduto=produtos.idproduto");


$htm="produtos Adicionados: <br> <table class='table table-bordered' id='tabelinha' width='100%' cellspacing='0'>
                            <thead>
                              <tr>
                              <th>Produto</th>
                              <th>Preço</th>
                              <th>Qtd</th> 
                              <th>Concentração</th> 
                              <th>Total</th>  
                              <th>Pago</th>  
                              <th>Qtd Rest.</th>  
                              <th>Opção</th>   
                            </tr>
                          </thead>
                          <tbody> ";
                          $totalpreco=0; 
                          $totaltotalapagar=0;
                          $totaltotalpago=0;
                          while($exibir = $listadeprodutos->fetch_array()){
                              $id=$exibir["idcompra"];
                              $tim=$exibir["nomedoproduto"];
                              $vp=$exibir["valorpago"];
                              $totaltotalpago+=$vp;
                              $v=$exibir["preco"];
                              $totalpreco+=$v;
                              $q=$exibir["quantidadedacompra"]; 
                              $total=$v*$q;
                              $totaltotalapagar+=$total;

                                $quantidaderestante=$exibir["restante"]; 
                                $localizacao=$exibir["localizacao"]; 
                                $concentracao=$exibir["concentracao"]; 
                           $htm.="
                           <tr> 
                                <td>".$tim."</td>
                                <td>".$v."</td>
                                <td>".$q."</td>
                                <td>".$concentracao."</td>
                                <td>".$total." </td> 
                                <td>".$vp." </td> 
                                <td>".$quantidaderestante."</td> 
                                <td><a href=''  data-id='$id' class='eliminaritem'><i title='Eliminar' style='color:red;' class='fas fa-trash' ></i></a></td>
                           </tr>
                           ";
                          }

                          $divida=$totaltotalapagar-$totaltotalpago; 
                          $divida=number_format($divida,2,",", "."); 
                          $totaltotal=number_format($totaltotalapagar,2,",", "."); 
                          $totaltotalp=number_format($totaltotalpago,2,",", "."); 

                          $htm.="
                          <tr>
                                <td><strong>TOTAL</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>".$totaltotal."</td>
                                <td>".$totaltotalp."</td>
                                <td></td> 
                                <td><strong>Divida: ".$divida."</strong></td>
                           </tr>
                        </tbody>
                     </table> 
                           
                      ";

                     echo "$htm";
 
 

?>