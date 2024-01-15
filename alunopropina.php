<?php 
include("conexao.php");

    
session_start();

if (!isset($_SESSION['logado'])) :
  header('Location: login.php');
endif;

$nome = $_SESSION['nomedoalunologado'];

$nomelogado = $_SESSION['nomedoalunologado'];
$painellogado = $_SESSION['painel'];

$idalunologado = $_SESSION['idalunologado'];

if (!($painellogado == "aluno")) {
  header('Location: login.php');
}

$idaluno = $idalunologado;
$idanolectivo_selecionado=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"4";


    $idmatriculaeconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from matriculaseconfirmacoes where idaluno='$idalunologado' and idanolectivo='$idanolectivo_selecionado' order by idaluno desc limit 1"))[0];
  

    $dados_da_matriculaeconfirmacao= mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 
 
    $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo_selecionado'"));

        include("cabecalhoaluno.php") ; ?>

<?php
                                   
                  $dadosdoaluno= mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' limit 1")); 
 
                           
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Propinas do aluno</h1>
     
          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

<?php 
            if(!empty($acertos)):
                        foreach($acertos as $acertos):
                          echo '<div class="alert alert-success">'.$acertos.'</div>';
                        endforeach;
                      endif;
            ?>


 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detalhes</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                   
                   
                    
<br>
 <br>
              <span id="mensagemdealerta"></span> 
              <h2>Histórico de Propinas</h2>
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
                  <?php
                      
 

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
 

                  ?>
                    <tr>  
                      <td><?php echo $mespago; ?></td>  
                      <td  title="<?php  $preco=number_format($exibir["preco"],2,",", "."); echo $preco; ?>"><?php echo $exibir['preco']; ?></td>
                      <td title="<?php  $multa=number_format($exibir["multa"],2,",", "."); echo $multa; ?>"><?php echo $exibir['multa']; ?></td>
                      <td title="<?php  $desconto=number_format($exibir["desconto"],2,",", "."); echo $desconto; ?>"><?php echo $exibir['desconto']; ?></td>
                      <td  title="<?php  $valorpago=number_format($exibir["valorpago"],2,",", "."); echo $valorpago; ?>"><?php echo $exibir['valorpago']; ?></td>
                      <td title="<?php  $divida=number_format($divida_n,2,",", "."); echo $divida; ?>"><?php echo $divida_n; ?></td>
                      <td><?php echo $exibir['codigodepropina']; ?></td>
                      <td><?php echo $exibir['datadopagamento']; ?></td>
                      <td align="center" title="Veja mais  ">
                         <a  href="propina.php?idpropina=<?php echo $exibir["idpropina"]; ?>"><i  class="fas fa-eye" ></i> </a>
                      </td>
 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>


                <br> <br>

                <br><h2>Previsão de Propinas</h2>
            <table class="table table-bordered"  width="100%" cellspacing="0">
                             
                  <thead>
                  <tr>
                      <th>Designação</th>

                         <?php

                $meses=[];
                $valormes=[];
                $saidames=[];
                $caixames=[];

                $datainicio_anolectivo=$dadosdoanolectivo["datainicio"];
                $datafim_anolectivo=$dadosdoanolectivo["datafimexame"];

                $mesinicio_anolectivo=$dadosdoanolectivo["mesinicio"];
                $mesfim_anolectivo=$dadosdoanolectivo["mesfim"];

                $anoinicio_anolectivo=$dadosdoanolectivo["anoinicio"];
                $anofim_anolectivo=$dadosdoanolectivo["anofim"];

                $previsao=[];

                $arrecadado=[];

                $emfalta=[];



                 $numero_de_meses_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafim) as numero  from anoslectivos where idanolectivo='$idanolectivo_selecionado'"))[0];

                 $numero_de_meses_exame=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafimexame) as numero  from anoslectivos where idanolectivo='$idanolectivo_selecionado'"))[0];

        

                   $anoactual=date('Y');
                
 
                   $contador_normal=0;
                   $contador_exame=0;

                  for ($i=$mesinicio_anolectivo; $i <=12 ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anoinicio_anolectivo;

  
                                   
 
                                 
                                    $data_de_cadastro_formada="$ano-$i-31"; //2021-08-31
                                    $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                              

                                    $previsao_normal=0; $previsao_exame=0;


                                    if($contador_normal<=$numero_de_meses_normal){

                                       $previsao_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                     

                                    $previsao[]=$previsao_normal+$previsao_exame;

 

                                  

                                       $arrecadado[]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propinas.valorpago)  from propinas  where idanolectivo='$idanolectivo_selecionado' and propinas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and mespago='$data_de_propina_formada'"))[0];

                                   

                                      


                                     
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                    $emfalta[]=$emfalta_normal+$emfalta_exame;


                                    $contador_normal++; $contador_exame++;

                                   if($mes==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($mes==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($mes==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($mes==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($mes==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($mes==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($mes==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($mes==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($mes==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($mes==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($mes==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($mes==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }



                               if($anoinicio_anolectivo!=$anofim_anolectivo){

                                    for ($i=1; $i <=$mesfim_anolectivo ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anofim_anolectivo;


                                     $data_de_cadastro_formada="$ano-$i-31"; //2022-01-31
                                      $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                                   

                                    $previsao_normal=0; $previsao_exame=0;


                                    if($contador_normal<=$numero_de_meses_normal){

                                       $previsao_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo'  and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo'  and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Sim'"))[0];

                                    }

                                     $previsao[]=$previsao_normal+$previsao_exame;


                                      $arrecadado[]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propinas.valorpago)  from propinas  where idanolectivo='$idanolectivo_selecionado' and propinas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao'  and mespago='$data_de_propina_formada'"))[0];
                                    

                                      $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo_selecionado' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and matriculaseconfirmacoes.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                    $emfalta[]=$emfalta_normal+$emfalta_exame;




                                     $contador_normal++; $contador_exame++;

                                   
                                       

                                       
                                   if($mes==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($mes==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($mes==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($mes==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($mes==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($mes==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($mes==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($mes==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($mes==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($mes==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($mes==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($mes==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }

                            }
                              
                               
                ?>


                      <?php 

                        foreach ($meses as $key => $value) {
                               echo "<th>$value</th>";  
                            } 

                     ?>

                        
                       
                    </tr>
 

                  </thead> 

                  <tbody>

                    <tr>
                      
                        <th>Previsão</th>
                      <?php 

                    

                        foreach ($previsao as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               echo "<td>$n</td>";  

                           

                            } 

                     ?>

                    </tr>

                    <tr>
                      
                        <td title="Soma Acumulada">Acumulada</td>
                      <?php 

                        $soma_acumulada=0;

                        foreach ($previsao as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                               echo "<td>$n</td>";  
                            } 

                     ?>

                    </tr>
                 
                   </tbody> 


                   <thead>
                  <tr>
                      <th style='background-color:blue'></th>
                      <?php 

                        foreach ($previsao as $key => $value) {
                               echo "<th style='background-color:blue'></th>";  
                            } 

                     ?>
 
                       
                    </tr>

                    </thead>


                     <tbody>

                    <tr>
                      
                        <th>Arrecadado</th>
                      <?php 

                    

                        foreach ($arrecadado as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               echo "<td>$n</td>";  

                           

                            } 

                     ?>

                    </tr>

                    <tr>
                      
                        <td title="Soma Acumulada">Acumulada</td>
                      <?php 

                        $soma_acumulada=0;

                        foreach ($arrecadado as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                               echo "<td>$n</td>";  
                            } 

                     ?>

                    </tr>
                 
                   </tbody> 
                
                 <thead>
                  <tr>
                      <th style='background-color:green'></th>
                      <?php 

                        foreach ($previsao as $key => $value) {
                               echo "<th style='background-color:green'></th>";  
                            } 

                     ?>
 
                       
                    </tr>

                    </thead>

                     <tbody>

                    <tr>
                      
                        <th>Em Falta</th>
                      <?php 

                    

                        foreach ($emfalta as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               echo "<td>$n</td>";  

                           

                            } 

                     ?>

                    </tr>

                    <tr>
                      
                        <td title="Soma Acumulada">Acumulada</td>
                      <?php 

                        $soma_acumulada=0;

                        foreach ($emfalta as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                               echo "<td>$n</td>";  
                            } 

                     ?>

                    </tr>
                 
                   </tbody> 

                    <thead>
                  <tr>
                      <th style='background-color:red'></th>
                      <?php 

                        foreach ($previsao as $key => $value) {
                               echo "<th style='background-color:red'></th>";  
                            } 

                     ?>
 
                       
                    </tr>

                    </thead>



                </table>

              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div> 
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
