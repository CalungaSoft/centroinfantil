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
   $valor=mysqli_real_escape_string($conexao, $_POST["valor"]); 
   $nomedacoluna=mysqli_real_escape_string($conexao, $_POST["nomedacoluna"]); 
   $formadepagamento=mysqli_real_escape_string($conexao, $_POST["formadepagamento"]); 

     $tipo='Material Escolar';

            

        
        if($nomedacoluna=="quantidade"){

            $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT compra.*, produtos.nomedoproduto, compra.quantidade  as quantidadecomprada, produtos.quantidade as quantidaderestante FROM `compra`, produtos where idcompra='$id' and compra.idproduto=produtos.idproduto"));
            $nomedoproduto=$dados["nomedoproduto"];
            $quantidadeantigo=$dados["quantidadecomprada"];
            $iddacompra=$dados["iddacompra"]; 
            $idaluno=$dados["idaluno"];
            $idproduto=$dados["idproduto"];

            $quantidaderestante=$dados["quantidaderestante"];
            $quantidadeincremental=$valor-$dados["quantidadecomprada"];
          
            if($quantidadeantigo!=$valor){

             if($valor>0){
                if($quantidaderestante>$quantidadeincremental || $quantidadeincremental==$quantidaderestante){

                                $actualizando=mysqli_query($conexao, "UPDATE `compra` SET `quantidade` = '$valor' WHERE idcompra = '$id'");

                                
                                     //$actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`-'$quantidadeincremental' WHERE idproduto = '$idproduto'");

                              
          
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
                                
                                $divida=$totalvalorproduto-$totalpago;
                                    $divida=round($divida,2);
                                
                                $zerando=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` = '0' WHERE `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo'");
                             
                                $guardar=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` = '$divida' WHERE `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo' order by identrada desc limit 1");
                                $guardar=mysqli_query($conexao,"UPDATE `entradas` SET  `descricao` = '$produtoscomprados' WHERE `entradas`.`idtipo` = '$iddacompra'  and tipo='$tipo' order by identrada asc limit 1");


                                if($guardar){
                    
                                    $antigo="Mudado a quantidade do produto $nomedoproduto, na : <a href=detalhesdacompra.php?idtipo=$iddacompra>venda $iddacompra </a> | Quantidade: $quantidadeantigo";
                                    $novo="quantidade nova $valor";
                                    
                                    $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                
                                if($guardar2){
                                        echo '<div class="alert alert-success"> Quantidade alterada de '.$quantidadeantigo.' para '.$valor.' | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                   }
                                else{
                                    echo '<div class="alert alert-danger">Ocorreu um erro ao Alterar o registro!</div>';
                                
                                }
                                
                                } else{
                                    echo '<div class="alert alert-danger">Ocorreu um erro ao Alterar o registro!</div>';
                                
                                }
                            
                    
                           

                    }else{

                        echo '<div class="alert alert-danger">Não foi possível fazer a alteração, pois a quantidade pedida ('.$quantidadeincremental.') é superior a quantidade restante('.$quantidaderestante.')</div>';
                    }

                    }else{
                        echo '<div class="alert alert-danger">A quantidade é sempre um valor maior que zero.</div>';
                    }
                }

        }



        if($nomedacoluna=="entregue"){

            $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT compra.*, produtos.nomedoproduto, compra.quantidade  as quantidadecomprada, produtos.quantidade as quantidaderestante FROM `compra`, produtos where idcompra='$id' and compra.idproduto=produtos.idproduto"));
            $nomedoproduto=$dados["nomedoproduto"];
            $quantidadeantigo=$dados["quantidadecomprada"];
            $iddacompra=$dados["iddacompra"];
            $idaluno=$dados["idaluno"];
            $idproduto=$dados["idproduto"];
            $entregueantigo=$dados["entregue"];

            $quantidaderestante=$dados["quantidaderestante"];
            $entregueincremental=$valor-$dados["entregue"];
          
            if($entregueantigo!=$valor){

             if($valor>0 || $valor==0){
                if($quantidaderestante>$entregueincremental || $entregueincremental==$quantidaderestante){

                    if ($valor<$quantidadeantigo || $valor==$quantidadeantigo) {
                        
                                    $actualizando=mysqli_query($conexao, "UPDATE `compra` SET `entregue` = '$valor' WHERE idcompra = '$id'");

                                            
                                    $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`-'$entregueincremental' WHERE idproduto = '$idproduto'");


                                        if($actualizando){
                            
                                            $antigo="Mudado a quantidade entregue do produto $nomedoproduto, na : <a href=detalhesdacompra.php?idcompra=$iddacompra>venda $iddacompra </a> | Quantidade entregue: $entregueantigo";
                                            $novo="quantidade entregue nova $valor";
                                            
                                            $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                        
                                        
                                        }
                                    
                            
                                    if($guardar2){
                                        echo '<div class="alert alert-success"> Quantidade entregue alterada de '.$entregueantigo.' para '.$valor.' | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                                }
                                else{
                                    echo '<div class="alert alert-danger">Ocorreu um erro ao Alterar o registro!</div>';
                                
                                }

                         }else {
                          
                            echo '<div class="alert alert-danger">Não foi possível fazer a alteração, pois a quantidade a ser entregue agora ('.$valor.') é superior a quantidade que foi comprada ('.$quantidadeantigo.')</div>';

                         }

                    }else{

                        echo '<div class="alert alert-danger">Não foi possível fazer a alteração, pois a quantidade a ser entregue agora ('.$entregueincremental.') é superior a quantidade restante('.$quantidaderestante.')</div>';
                    }

                    }else{
                        echo '<div class="alert alert-danger">A quantidade entegue é sempre um valor maior ou igual a zero.</div>';
                    }
                }

        }




        
        if($nomedacoluna=="valor"){

            $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where idcompra='$id' and compra.idproduto=produtos.idproduto"));
            $nomedoproduto=$dados["nomedoproduto"];
            $valorantigo=$dados["valorpago"];
            $iddacompra=$dados["iddacompra"];
            $idaluno=$dados["idaluno"];


             $dados_da_entrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where idtipo='$iddacompra' and tipo='$tipo' limit 1 ")); 
 
          $idturma=$dados_da_entrada['idturma'];
          $idanolectivo=$dados_da_entrada['idanolectivo']; 


            if($valorantigo!=$valor){
                 $valor=round($valor,2);
                                
                    if(!($valor>0 || $valor==0)){

                        echo '<div class="alert alert-danger">A Valor pago é sempre um valor maior ou igual a zero.</div>' ;
                    }else {
                
                                $listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$iddacompra' and compra.idproduto=produtos.idproduto");
                                 
                                $totalpagoantesdoupdate=0;
                                while($exibir = $listadeprodutos->fetch_array()){  
                                    $totalpagoantesdoupdate+=$exibir["valorpago"]; 
                                }



                                $actualizando=mysqli_query($conexao, "UPDATE `compra` SET `valorpago` = '$valor' WHERE idcompra = '$id'");

                                    if($actualizando){

                                        $listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$iddacompra' and compra.idproduto=produtos.idproduto");
                                        
                                
                                        $totalvalorproduto=0;
                                        $totalpago=0;
                                        while($exibir = $listadeprodutos->fetch_array()){ 
                                            $totalvalorproduto+=($exibir["preco"]*$exibir["quantidade"])-$exibir["desconto"];
                                            $totalpago+=$exibir["valorpago"]; 
                                        }
        
                                        $valordeentrada=$totalpago-$totalpagoantesdoupdate;
                                         $valordeentrada=round($valordeentrada,2);
                                        $divida=$totalvalorproduto-$totalpago;
                                            $divida=round($divida,2);
                                        $guardar=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` = '0' WHERE `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo'");
        
                                        $dadosdaentrada=mysqli_fetch_array(mysqli_query($conexao, "select * from entradas where `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo' order by identrada asc limit 1"));
          
                                            $descricao="Actualização($dadosdaentrada[descricao])";
                             
                                        if($guardar){

                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', '$tipo','$iddacompra', '$valordeentrada', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                      
                                        }
                                        
        
                                    }
                               
                            
                    
                            if($salvar_financas){
                                echo '<div class="alert alert-success"> Um novo registro de entrada foi criado com um valor incremental de '.$valordeentrada.' KZ| Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                        }
                        else{
                            echo '<div class="alert alert-danger">Ocorreu um erro ao Alterar o registro!</div>';
                        
                        }
                    }
                }
        }


        if($nomedacoluna=="desconto"){

            $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where idcompra='$id' and compra.idproduto=produtos.idproduto"));
            $nomedoproduto=$dados["nomedoproduto"];
            $descontoantigo=$dados["desconto"];
            $iddacompra=$dados["iddacompra"];
            $idaluno=$dados["idaluno"];
            $totalapagar=$dados["quantidade"]*$dados["preco"];

            if($descontoantigo!=$valor){

              if($valor<$totalapagar || $valor==$totalapagar){
                  $valor=round($valor,2);
                if(!($valor>0 || $valor==0)){
                    echo '<div class="alert alert-danger">O Desconto é sempre um valor maior ou igual a zero.</div>';
                }else {

              
                                $actualizando=mysqli_query($conexao, "UPDATE `compra` SET `desconto` = '$valor' WHERE idcompra = '$id'");

                                $listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$iddacompra' and compra.idproduto=produtos.idproduto");
                                        
                                
                                $totalvalorproduto=0;
                                $totalpago=0;
                                while($exibir = $listadeprodutos->fetch_array()){ 
                                    $totalvalorproduto+=($exibir["preco"]*$exibir["quantidade"])-$exibir["desconto"];
                                    $totalpago+=$exibir["valorpago"]; 
                                }
                                
                                $divida=$totalvalorproduto-$totalpago;
                                    $divida=round($divida,2);
                                $guardar=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` = '$divida' WHERE `entradas`.`idtipo` = '$iddacompra' and tipo='$tipo' order by identrada desc limit 1");


                                if($guardar){
                    
                                    $antigo="Mudado o Desconto do produto $nomedoproduto, na : <a href=detalhesdacompra.php?idcompra=$iddacompra>venda $iddacompra </a> | Desconto: $descontoantigo KZ ";
                                    $novo="Desconto novo $valor KZ";
                                    
                                    $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                
                                
                                }
                            
                    
                            if($guardar2){
                                echo '<div class="alert alert-success"> Desconto alterado de '.$descontoantigo.' para '.$valor.' | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                        }
                        else{
                            echo '<div class="alert alert-danger">Ocorreu um erro ao Alterar o registro!</div>';
                        
                        }
                    }

                  } else{
                    echo '<div class="alert alert-danger">O valor a descontar é sempre menor que o valor da compra</div>';
                
                }
                }
        }
        
        

          
 

}


?>