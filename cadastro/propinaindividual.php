
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

 

$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $_POST['idmatriculaeconfirmacao']);
$idturma=mysqli_escape_string($conexao, $_POST['idturma']);


  $dados_da_matriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

      $idaluno=$dados_da_matriculaeconfirmacao["idaluno"];
      $idanolectivo=$dados_da_matriculaeconfirmacao["idanolectivo"];
 

$htm='
 
<h2>Histórico de Propinas do Aluno </h2>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>    
                      <th>Mês Pago</th> 
                      <th>Preço</th>
                      <th>Multa</th> 
                      <th>Desconto</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Código</th> 
                      <th>Data</th> 
                      <th>Ver Mais</th> 
                    </tr>
                  </thead>
                  <tbody>
           ';

 

                              $lista=mysqli_query($conexao, "SELECT   YEAR(propinas.mespago) as ano, MONTH(propinas.mespago) as mes, matriculaseconfirmacoes.*, propinas.* from matriculaseconfirmacoes, propinas  where propinas.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao'");
                                

                              

                         while($exibir = $lista->fetch_array()){


                          $anoactual=date('Y');
                          $mespago=$exibir['mes'];
                     if($exibir['mes']==1){
                          $mespago="Janeiro";
                          if($exibir['ano']!=$anoactual){
                            $mespago="Janeiro/".$exibir['ano']."";
                          }
                     }else  if($exibir['mes']==2){
                        $mespago="Fevereiro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Fevereiro/".$exibir['ano']."";
                        }
                    }else  if($exibir['mes']==3){
                        $mespago="Março";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Março/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==4){
                        $mespago="Abril";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Abril/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==5){
                        $mespago="Maio";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Maio/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==6){
                        $mespago="Junho";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Junho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==7){
                        $mespago="Julho";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Julho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==8){
                        $mespago="Agosto";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Agosto/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==9){
                        $mespago="Setembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Setembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==10){
                        $mespago="Outubro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Outubro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==11){
                        $mespago="Novembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Novembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==12){
                        $mespago="Dezembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Dezembro/".$exibir['ano']."";
                        }
                    } 



                    $divida_n=round(($exibir['preco']+$exibir['multa']-$exibir['valorpago']-$exibir['desconto']),2);
 
                    $preco=number_format($exibir["preco"],2,",", ".");
                    $multa=number_format($exibir["multa"],2,",", ".");
                    $desconto=number_format($exibir["desconto"],2,",", ".");
                    $valorpago=number_format($exibir["valorpago"],2,",", "."); 
                    $divida=number_format($divida_n,2,",", ".");

                  $htm.='
                    <tr>  
                      <td>'.$mespago.'</td>  
                      <td  title="'.$preco.'">'.$exibir["preco"].'</td>
                      <td title="'.$multa.'">'.$exibir["multa"].'</td>
                      <td title="'.$desconto.'">'.$exibir["desconto"].'</td>
                      <td  title="'.$valorpago.'">'.$exibir["valorpago"].'</td>
                      <td title="'.$divida.'">'.$divida_n.'</td>
                      <td>'.$exibir["codigodepropina"].'</td>
                      <td>'.$exibir["datadopagamento"].'</td>
                      <td align="center" title="Veja mais opções sobre esse curso">
                         <a  href="propina.php?idpropina='.$exibir["idpropina"].'"><i  class="fas fa-eye" ></i> </a>
                      </td>
 
                    </tr> 
                    '; }

                    $htm.='
                  </tbody>
                </table>
                <script> $("#botaoavaliacao").html("");</script>
 ';




echo "$htm";
