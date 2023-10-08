<?php 
include("../conexao.php");

    $produtoasereliminado=$_POST['produtoasereliminado'];  

    $dados=mysqli_fetch_array(mysqli_query($conexao, "select quantidade, idproduto, iddacompra from compra where idcompra='$produtoasereliminado'")); 
    $quantidade=$dados["quantidade"];
    $idproduto=$dados["idproduto"];
    $iddacompra=$dados["iddacompra"];

      $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`+'$quantidade' WHERE idproduto = '$idproduto'");

    $deletando=mysqli_query($conexao,"DELETE FROM `compra` where idcompra='$produtoasereliminado'");

   

  

$listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.*, produtos.quantidade as restante, compra.quantidade as quantidadedacompra  FROM `compra`, produtos where  compra.iddacompra='$iddacompra' and compra.idproduto=produtos.idproduto");


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