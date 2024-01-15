<?php 
include("conexao.php");

//problemas com limitar pagamentos novos
//divida em pagamentos individuais
    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

 
$identrada=isset($_GET['identrada'])?$_GET['identrada']:"";
$identrada=mysqli_escape_string($conexao, $identrada); 

$dados_da_entrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $tipo=$dados_da_entrada['tipo'];
                     $idtipo=$dados_da_entrada['idtipo'];
                     $idaluno=$dados_da_entrada['idaluno'];


          $idturma=$dados_da_entrada['idturma'];
          $idanolectivo=$dados_da_entrada['idanolectivo']; 
                    
$dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM alunos where idaluno='$idaluno'"));

      $dados_do_documento=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from documentostratados where iddocumentotratado='$idtipo'"));


$nomedoaluno=$dadosdoaluno['nomecompleto'];

$divida_total=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(divida) as divida FROM entradas where tipo='$tipo' and idtipo='$idtipo'"))[0];


if(isset($_POST['cadastrar'])){

    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']));   
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']) );    
 
          $divida_antigo=$divida_total;
      
          $nova_divida=round(($divida_antigo-$valor),2);
          
           
          if($nova_divida<0){
              $nova_divida=0;
          }



          $idturma=$dados_da_entrada['idturma'];
          $idanolectivo=$dados_da_entrada['idanolectivo']; 


           $zerando_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='0' WHERE tipo='$tipo' and idtipo='$idtipo'");

             if($zerando_dividas){


                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', '$tipo','$idtipo', '$valor', '$nova_divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                      
                      if($salvar_financas){

                        $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT  sum(valor) as totalpago FROM entradas where tipo='$tipo' and idtipo='$idtipo'"));

                          $totalpago=$dados_do_pagamento['totalpago'];
                        
                          $actualizandopagamentos=mysqli_query($conexao,"UPDATE `documentostratados` SET `valorpago` = '$totalpago' WHERE `documentostratados`.`iddocumentotratado` = '$idtipo'");

                          if($actualizandopagamentos){


                             $acerto[]="Pagamento feito com sucesso";


                          }else{

                            $erros[]="Ocorreu algum erro";

                        
                          }
                          



                      }else{

                        $erros[]="Ocorreu um erro Ao fazer o pagamento,Tente Novamente";

                      }



             }else{

               $erros[]="Ocorreu um erro Ao fazer o pagamento, ao zerrar as dívidas";
             }

                     
   
  }


if(isset($_POST['editaralteracoes'])){

    $identrada=mysqli_escape_string($conexao, trim($_POST['identrada']) );  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']) );   
    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']) );  
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']) );  
    $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']) );  

    
                     $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $divida_antigo=$dados_do_pagamento['divida'];
                     $valorpago_antigo=$dados_do_pagamento['valor'];
                     $datadaentrada_antigo=$dados_do_pagamento['datadaentrada'];
                     $descricao_antigo=$dados_do_pagamento['descricao'];
                     $formadepagamento_antigo=$dados_do_pagamento['formadepagamento'];
                                        

                    


                     
                $antigo="($descricao_antigo) | Pago: $valorpago_antigo | F. Pag: $formadepagamento_antigo | $datadaentrada_antigo";
                $novo="($descricao) | Pago: $valor  | F. Pag: $formadepagamento | $datadaentrada <a href=detalhesdafalta.php?identrada=$identrada>Clique para ver</a>";
                
                $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
            
            if($guardar2){

               $actualizando=mysqli_query($conexao, "UPDATE `entradas` SET `datadaentrada` = '$datadaentrada', `descricao` = '$descricao', `valor` = '$valor', `formadepagamento` = '$formadepagamento' WHERE identrada = '$identrada'");
        
                  $zerando_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='0' WHERE tipo='$tipo' and idtipo='$idtipo'");
                  
                   $preco=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(preco-desconto) as preco FROM documentostratados where iddocumentotratado='$idtipo' "))['preco'];

                   $valorpago=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valorpago FROM entradas where  tipo='$tipo' and idtipo='$idtipo' "))['valorpago'];

                   $divida_nova=round(($preco-$valorpago),2);

                   $insirindo_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='$divida_nova' WHERE tipo='$tipo' and idtipo='$idtipo' order by identrada desc limit 1");

                   $actualizando_nasmatriculas=mysqli_query($conexao,"UPDATE `documentostratados` SET  `valorpago` ='$valorpago' WHERE   iddocumentotratado='$idtipo' limit 1");

 
                if($actualizando_nasmatriculas){

                      

                    $acerto[]="Alterações feitas com sucesso!";
                
                }else{
                
                $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente | $tipo";
                
                } 

            }else{

                $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente | Histórico";
                

            }
   
  }








if(isset($_POST['editarpreco'])){

    $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
    $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));   
    $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));   
    $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));   
    $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
    
    $escoladedestino=isset($_POST['escoladedestino'])?$_POST['escoladedestino']:"";
    $escoladedestino=mysqli_escape_string($conexao, trim($escoladedestino));
    
    $idtrimestre=isset($_POST['idtrimestre'])?$_POST['idtrimestre']:"";
    $idtrimestre=mysqli_escape_string($conexao, trim($idtrimestre));
      
     
     $valorpago=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valorpago FROM entradas where  tipo='$tipo' and idtipo='$idtipo' "))['valorpago'];

          
      
          $nova_divida=round(($preco-$desconto-$valorpago),2);
          
           
          if($nova_divida<0){
              $nova_divida=0;
          }

   
                       
                        $insirindo_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='$nova_divida' WHERE tipo='$tipo' and idtipo='$idtipo' order by identrada desc limit 1");

                          if($insirindo_dividas){

                                $dados_antigos=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM documentostratados where documentostratados.`iddocumentotratado` = '$idtipo'"));

 
                                   $actualizandopagamentos=mysqli_query($conexao,"UPDATE `documentostratados` SET `preco` = '$preco', `desconto` = '$desconto' , `datadeentrada` = '$datadaentrada', `datadolevantamento` = '$datadasaida', `jalevantado` = '$jalevantou', `valorpago` = '$valorpago', `escoladedestino` = '$escoladedestino',  `idtrimestre` = '$idtrimestre' WHERE `documentostratados`.`iddocumentotratado` = '$idtipo'");


 
                                 



                                    if ($actualizandopagamentos) {

                                     $preco_antigo=$dados_antigos['preco'];

                                     
                                     $valorpago_antigo=$dados_antigos['valorpago'];
                                     $desconto_antigo=$dados_antigos['desconto'];
                                     $tipodedocumento_antigo=$dados_antigos['tipodedocumento'];
                                               

                                    
 

                                   $antigo="Tratar Documento ($dados_antigos[tipodedocumento]) | Preço $preco_antigo , Desconto $desconto_antigo , valor pago $valorpago_antigo";
                                  $novo="Preço $preco , Desconto $desconto , valor pago $valorpago |  <a href=detalhestratardocumentos.php?identrada=$identrada>Clique para ver</a>";



                                    

                                        $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                  



                                            $acerto[]="Alterações feitas com sucesso";

                                       
                                    }else{


                                      $erros[]="Ocorreu algum erro | Actualizando nas $tipo";




                                    }





                          }else{

                            $erros[]="Ocorreu algum erro | Actualizando nas finaças";

                        
                          }
                          

 
   
  }






if(isset($_POST['editarprecooutro'])){

    $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
    $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));   
    $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));   
    $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));   
    $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
     
    $tipodedocumento=mysqli_escape_string($conexao, trim($_POST['tipodedocumento']));
     
     $valorpago=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valorpago FROM entradas where  tipo='$tipo' and idtipo='$idtipo' "))['valorpago'];

          
      
          $nova_divida=round(($preco-$desconto-$valorpago),2);
          
           
          if($nova_divida<0){
              $nova_divida=0;
          }

   
                       
                        $insirindo_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='$nova_divida' WHERE tipo='$tipo' and idtipo='$idtipo' order by identrada desc limit 1");

                          if($insirindo_dividas){

                                $dados_antigos=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM documentostratados where documentostratados.`iddocumentotratado` = '$idtipo'"));
 

                                   $actualizandopagamentos=mysqli_query($conexao,"UPDATE `documentostratados` SET `preco` = '$preco', `desconto` = '$desconto' , `datadeentrada` = '$datadaentrada', `datadolevantamento` = '$datadasaida', `jalevantado` = '$jalevantou', `valorpago` = '$valorpago', `tipodedocumento` = '$tipodedocumento'  WHERE `documentostratados`.`iddocumentotratado` = '$idtipo'");



                               



                                    if ($actualizandopagamentos) {

                                     $preco_antigo=$dados_antigos['preco'];

                                     
                                     $valorpago_antigo=$dados_antigos['valorpago'];
                                     $desconto_antigo=$dados_antigos['desconto'];
                                     $tipodedocumento_antigo=$dados_antigos['tipodedocumento'];
                                               

                                    

                                   
                                  $antigo="Tratar Documento ($tipodedocumento_antigo) | Preço $preco_antigo , Desconto $desconto_antigo , valor pago $valorpago_antigo";
                                  $novo=" ($dados_antigos[tipodedocumento]) Preço $preco , Desconto $desconto , valor pago $valorpago |  <a href=detalhestratardocumentos.php?identrada=$identrada>Clique para ver</a>";
                                  
                               
 

                                        $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                                  



                                            $acerto[]="Alterações feitas com sucesso";

                                       
                                    }else{


                                      $erros[]="Ocorreu algum erro | Actualizando nas $tipo";




                                    }





                          }else{

                            $erros[]="Ocorreu algum erro | Actualizando nas finaças";

                        
                          }
                          

 
   
  }




$divida_total=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(divida) as divida FROM entradas where tipo='$tipo' and idtipo='$idtipo'"))[0];

    $dados_do_documento=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from documentostratados where iddocumentotratado='$idtipo'"));

    $idtrimestre=$dados_do_documento["idtrimestre"];

     $nomedo_trimestre=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from trimestres where idtrimestre='$idtrimestre'"))[0];

        include("cabecalho.php") ; ?>

<?php
                                 
                                      $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));
                                      
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Detalhes de Pagamento (<?php echo "$tipo";?>)| <a href="aluno.php?idaluno=<?php echo "$idaluno";?>"><?php echo "$nomedoaluno";?></a> </h1>

                <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>
              <?php 
            if(!empty($acerto)):
                        foreach($acerto as $acerto):
                          echo '<div class="alert alert-success">'.$acerto.'</div>';
                        endforeach;
                      endif;
            ?>

              
 
  <button id="myBtnreclamacoes" class="btn btn-success" title="Registrar Um Pagamento na data de hoje"><i  class="fas fa-money"></i>  Fazer um pagamento Novo</button>  

    <?php if($dados_do_documento["tipodedocumento"]=="Guia de Transferência"){ ?>
    <a class='btn btn-info' href="pdf/guiadetransferencia.php?iddocumentotratado=<?php echo $dados_do_documento["iddocumentotratado"]; ?>"> Imprimir <?php echo $dados_do_documento["tipodedocumento"];?></a>
    <?php }else if($dados_do_documento["tipodedocumento"]=="Declaração sem notas"){ ?>
      <a class='btn btn-info' href="pdf/declaracaosemnotas.php?idmatriculaeconfirmacao=<?php echo $dados_do_documento["idmatriculaeconfirmacao"]; ?>"> Imprimir <?php echo $dados_do_documento["tipodedocumento"];?></a>
    
      <?php }else if($dados_do_documento["tipodedocumento"]=="Boletin"){ ?>
      <a class='btn btn-info' href="pdf/boletin.php?iddocumentotratado=<?php echo $dados_do_documento["iddocumentotratado"]; ?>"> Imprimir <?php echo $dados_do_documento["tipodedocumento"];?></a>
    
 

     <?php }else if($dados_do_documento["tipodedocumento"]=="Declaração com notas"){ ?>
      <a class='btn btn-info' href="pdf/declaracaocomnotas.php?idmatriculaeconfirmacao=<?php echo $dados_do_documento["idmatriculaeconfirmacao"]; ?>"> Imprimir <?php echo $dados_do_documento["tipodedocumento"];?></a>
    <?php } ?>

    <?php   if($dados_do_documento["tipodedocumento"]=="Certificado"){ ?>
      

      <form action="pdf/<?php echo $dados_do_documento["ensino"]; ?>.php" method="get">
 <br>
                    <div class="form-group row"> 
                    <div class="col-sm-3"> 
                        
                                <input type="text"  name="municipio" id="desconto"  min="0" class="form-control " placeholder="Município" > 
                        </div>  
                         <div class="col-sm-3">  
                           
                                <input type="text"  name="dirmunicipal" id="preco"  min="0" class="form-control " placeholder="Direitor Municipal" > 
                        </div>   

                         <div class="col-sm-3"> 
                        
                                <input type="text"  name="livroregistro" id="desconto"  min="0" class="form-control " placeholder="Livros de Registro" > 
                        </div> 

                         <div class="col-sm-3"> 
                        
                                <input type="text"  name="folhas" id="desconto"  min="0" class="form-control " placeholder="Nas folhas" > 
                        </div> 


                    </div>
                      

                        <input type="text"  name="frase" list="datalist1"  min="0" class="form-control " placeholder="Frases Iniciais" > 
                        <datalist id="datalist1"> 
                                  <option value="Esmael Calunga, Director do Complexo Escolar Privado CalungaSoft VIN 1239, em Viana criada sob Decreto Executivo nº 12/12/2021"> 
                                  
                              </datalist>

                  <input type="hidden" name="iddocumentotratado" value="<?php echo $dados_do_documento["iddocumentotratado"]; ?>">  <br>

                     <button class='btn btn-info' type="submit" > Imprimir <?php echo $dados_do_documento["tipodedocumento"];?></button> 
    
                 </form>
    
   <?php } ?>

     | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=<?php echo "$dados_da_entrada[identrada]";?>'> Imprimir Recibo Geral</a> 
   
<br><br>


           

          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do aluno</h6>
                  <div class="dropdown no-arrow">
                     
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">


                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">aluno</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"] ; ?>"><?php echo $dadosdoaluno["nomecompleto"] ; ?></a></div> <br>

                                            Sexo: <strong> <?php echo $dadosdoaluno["sexo"]; ?> </strong> <br>

                                            Nome do Pai: <strong> <?php echo $dadosdoaluno["nomedopai"]; ?> </strong> <br>

                                            Nome da Mãe: <strong> <?php echo $dadosdoaluno["nomedamae"]; ?> </strong> <br>

                                            Data de Nascimento: <strong> <?php echo $dadosdoaluno["datadenascimento"]; ?> </strong>  <br><br>
  
                                          
 <?php
                                           $idanolectivo=$dados_da_entrada["idanolectivo"];
 
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo'")); ?>
                                        
 Ano Lectivo
                                          <h3><strong> <?php echo $anolectivo["titulo"]; ?> </strong></h3>


                                            <?php
 
                                              

                                          

                                              $matriculasdesseano= mysqli_query($conexao, "select * from matriculaseconfirmacoes WHERE idturma='$idturma' and idaluno='$idaluno'");

                                              while($exibir = $matriculasdesseano->fetch_array()){

                                                    $idturma=$exibir["idturma"];
                                           $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                                               $turma=$dadosdaturma["titulo"]; 
                                               $idperiodo=$dadosdaturma["idperiodo"]; 
                                               $idsala=$dadosdaturma["idsala"]; 
                                             
                                             

                                               $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                                              
                                                $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                                              
                                                ?>
                                                  <hr> <hr>
                                                  Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a> |

                                               
                                                  Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a>  | 

                                                    Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a>

                                                       <?php if ($exibir["tipodealuno"]=="Bolseiro") {
                                                          echo "  <strong>Aluno Bolseiro</strong>";
                                                       } ?>

                                          <?php 
                                              } ?>



                                                </div>
 
                                    </div>
                                    </div> 
                                </div>
                                </div>
                            </div>
                            </div>
   
                                                      
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo "$tipo";?></div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1">  <br> <?php


                                           

                                           
                                             $preco=number_format($dados_do_documento["preco"],2,",", ".");

                                             $desconto=number_format($dados_do_documento["desconto"],2,",", ".");
                                           
                                             $valorpago=number_format($dados_do_documento["valorpago"],2,",", ".");

                                              $totalcobrado=number_format($dados_do_documento["preco"]-$dados_do_documento["desconto"],2,",", ".");
                     
                                             $divida=number_format($dados_do_documento["preco"]-$dados_do_documento["desconto"]-$dados_do_documento["valorpago"],2,",", ".");
                     
                                            ?> 
 

                                                
                                                   Preço:<strong>   <?php echo $preco; ?> </strong> |  

                                                     Desconto:<strong>   <?php echo $desconto; ?> </strong> |  
                                                        Total Cobrado:<strong>   <?php echo $totalcobrado; ?> </strong> <br> 
 

                                                  Valor Pago:<strong>  <?php echo $valorpago; ?> </strong> | <br>

                                                  Dívida:<strong>   <?php echo $divida; ?> </strong><br>  <hr>  

                                                  Tipo de Documento:<strong>   <?php echo $dados_do_documento["tipodedocumento"]; ?> </strong>  

                                                 <?php if($dados_do_documento["tipodedocumento"]=="Guia de Transferência"){?>  
                                                 ( Escola de Destino:<strong>  <?php echo $dados_do_documento["escoladedestino"]; ?> ) </strong> <?php } ?> 

                                                  <?php if($dados_do_documento["tipodedocumento"]=="Boletin"){?>  
                                                ( <strong>  <?php echo $nomedo_trimestre; ?> Trimestre  </strong>) <?php } ?> 

                                                 <br> <br> 



                                                  Data | Entrada:<strong>   <?php echo $dados_do_documento["datadeentrada"]; ?> </strong>
                                                |   Levantamento:<strong>   <?php echo $dados_do_documento["datadolevantamento"]; ?> </strong><br>

                                                   Já Levantou:<strong>   <?php echo $dados_do_documento["jalevantado"]; ?> </strong><br>  <br>    
 

                                               <!-- Collapsable Card Example -->
                                              <div class="card shadow mb-6">
                                              <!-- Card Header - Accordion -->
                                              <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Editar Informações acima</h6>
                                              </a>
                                              <!-- Card Content - Collapse -->
                                              <div class="collapse in" id="collapseCardExample">
                                                <div class="card-body">
                                                <form action="" method="post">

                        <?php if($dados_do_documento["tipodedocumento"]!="Boletin" && $dados_do_documento["tipodedocumento"]!="Guia de Transferência" && $dados_do_documento["tipodedocumento"]!="Certificado" && $dados_do_documento["tipodedocumento"]!="Declaração com notas" && $dados_do_documento["tipodedocumento"]!="Declaração sem notas"){?>  
                         <div class="form-group">
                       <span>Tipo de Documento</span>
                          <input type="text" name="tipodedocumento" class="form-control"   placeholder="Tipo de documento" value="<?php echo $dados_do_documento["tipodedocumento"] ; ?>">
                      </div>

                       <?php } ?>

 
                                                      
                                                      <div class="form-group">
                                                          <label>Preço</label>
                                                        <input type="number" min='0' name="preco" class="form-control  "  value="<?php echo $dados_do_documento["preco"] ; ?>">
                                                      </div> 

                                                      <div class="form-group">
                                                          <label>Desconto</label>
                                                        <input type="number" min='0' name="desconto" class="form-control  "  value="<?php echo $dados_do_documento["desconto"] ; ?>">
                                                      </div> 


                      <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" class="form-control" title="Digite data de Entrada" placeholder="Data da Entrada" value="<?php echo $dados_do_documento["datadeentrada"] ; ?>">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" class="form-control" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="<?php echo $dados_do_documento["datadolevantamento"] ; ?>">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option <?php if($dados_do_documento["jalevantado"]=="Não"){ echo "selected";}?>>Não</option> 
                        <option <?php if($dados_do_documento["jalevantado"]=="Sim"){ echo "selected";}?>>Sim</option>  
                        
                    </select> 
                    </div>


                         <?php if($dados_do_documento["tipodedocumento"]=="Guia de Transferência"){?>  
                         <div class="form-group">
                       <span>Escola de Destino</span>
                          <input type="text" name="escoladedestino" autocomplete="off" class="form-control"   placeholder="Escola de Destino" value="<?php echo $dados_do_documento["escoladedestino"] ; ?>">
                      </div>

                       <?php } ?>

                       <?php if($dados_do_documento["tipodedocumento"]=="Boletin"){?>  
                         <div class="form-group">
                       <span>Trimestre</span>

                               <select name="idtrimestre" required  class="form-control" title="Trimestre"  > 
                                  <option disabled="">Trimestre</option>
                                  
                                  <?php 
                                      $trimestres=mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo'"); 
                                      while($exibir = $trimestres->fetch_array()){ 
                                      ?>

                                      <option <?php if($idtrimestre==$exibir['idtrimestre']){ echo "selected";} ?> value="<?php echo $exibir['idtrimestre']; ?>"><?php echo $exibir["titulo"]; ?></option>

                                     <?php } ?>

                                    
                                </select> 
                      </div>

                       <?php } ?>



                         <?php if($dados_do_documento["tipodedocumento"]!="Boletin" && $dados_do_documento["tipodedocumento"]!="Guia de Transferência" && $dados_do_documento["tipodedocumento"]!="Certificado" && $dados_do_documento["tipodedocumento"]!="Declaração com notas" && $dados_do_documento["tipodedocumento"]!="Declaração sem notas"){?>  

                                                      <div class="form-group">
                                                          <input type="submit" name="editarprecooutro" value="Guardar Novas Informações" class="btn btn-success">
                                                      </div> 
                                  <?php }else{?>

                                                      <div class="form-group">
                                                          <input type="submit" name="editarpreco" value="Guardar Novas Informações" class="btn btn-success">
                                                      </div> 

                                  <?php   } ?>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- Collapsable Card Example -->




                                          
                                        </div>


                            
                                        </div>
                                        </div> 



                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>



                 
      </div>
      <!-- End of Main Content -->



    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="POST">
          <h2>Fazendo novo pagamento</h2>
                      <br>

                       <div class="form-group">
                 <span>Descrição</span>
                <input type="text" name="descricao" autocomplete="on" class="form-control" title="Digite a Descrição" placeholder="Descrição" required="">
                </div>
  
 
  
                <div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Valor A acrescentar</span>

                             <input type="number" step="any" min="0"  max="<?php echo $divida_total; ?>" name="valor" autocomplete="on" class="form-control" title="Digite o valor a acrescentar" placeholder="Valor a acrescentar" required="">
  
                        </div>
                        <div class="col-sm-6"> 
                        <span>Dívida</span>
                             <input type="number" disabled="" step="any" min="0"  name="divida" id="divida" min="0"  class="form-control " placeholder="Dívida" value="<?php echo $divida_total; ?>"> 
 
                        </div>  
                    </div>
                     
                     <div class="form-group"> 
                      <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                 <?php
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                     ?>
                                      <option  value="<?php echo $exibir["formadepagamento"]; ?>"><?php echo $exibir["formadepagamento"]; ?></option>

                                     <?php } ?>
                                </select> 
                    </div>

              

                          <br>
                            <input type="submit" value="Concluir Pagamento" name="cadastrar" class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    


    <script>
                     var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                     var modalreclamacoes=document.getElementById("myModalreclamacoes");
                     var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                   
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })


                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
              
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                
                    

                  </script>

                  <br> <br>
          <div class="col-lg">
         
      
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Histórico de Pagamentos</h6>
            </div>
            <div class="card-body">
           

  <span id="mensagemdealerta"></span> 
          
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Funcionário</th>
                      <th>Descrição</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Data</th> 
                      <th title="Forma de Pagamento">F. de Pag.</th> 
                      <th>Editar</th>  
                      <th>Eliminar</th>  
                    </tr>
                  </thead> 
                  <tbody>
                  
                     <?php
                     
                       

                          $registrosdeentrada=mysqli_query($conexao, "select funcionarios.nomedofuncionario, entradas.* from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario and tipo='$tipo' and idtipo='$idtipo' order by datadaentrada desc"); 
 
                       

                      $totalentradas=0;
                      $totademdivida=0;
                      $primeiroid=mysqli_fetch_array(mysqli_query($conexao," SELECT identrada FROM entradas where idtipo='$idtipo' and tipo='$tipo' order by identrada asc limit 1"))[0];

                      while($exibir = $registrosdeentrada->fetch_array()){
                            
                          $totalentradas+=$exibir["valor"];
                          $totademdivida+=$exibir["divida"];
                        
                      
                     
                     ?>
                      
                    <tr>
                    <td> <a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?> </a></td>
                    <td ><?php echo $exibir["descricao"]; ?></td> 
                     
                      <td ><?php   $n=number_format($exibir["valor"],2,",", "."); echo $n; ?></td>
                      <td><?php   $n=number_format($exibir["divida"],2,",", "."); echo $n; ?></td>
                      <td><?php echo $exibir["datadaentrada"]; ?></td> 
                      <td><?php echo $exibir["formadepagamento"]; ?></td>  
                      <td><a href="" class="btn btn-info mudavalor" data-column="Aumentar" data-id="<?php echo $exibir["identrada"]; ?>" ><i style="color:white" title="Mudar dados nesse registro" class="fas fa-edit"></i></a></td>  

                       <td>

                      <?php if($exibir["identrada"]!=$primeiroid){?> 

                       <a href="" class="btn btn-danger delete" data-column="Aumentar" data-id="<?php echo $exibir["identrada"]; ?>" ><i style="color:white" title="Eliminar esse registro específico" class="fas fa-trash"></i></a>

                        <?php  } ?>

                        </td>  
                         
                         

 
                    

                    </tr> 
                    </tr>
                    <?php  } 

                     $totalentradas=number_format($totalentradas,2,",", ".");
                     $totademdivida=number_format($totademdivida,2,",", ".");


                    ?>
                    </tbody>
                    <tfoot>
                      <th>Total</th>
                      <th></th>
                      <th><?php echo $totalentradas; ?></th>
                      <th><?php echo $totademdivida; ?></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tfoot>
                 
                </table>
          
              </div>
            </div>
          </div>
 
            </div>
          </div>
   


                <a href="" class="btn btn-danger deletevenda" id="<?php echo $identrada; ?>" ><i style="color:white" title="Eliminar todos os dados dessa venda, incluíndo a própria venda" class="fas fa-trash"></i>ELIMINAR Todos registros financeiros deste documento tratado</a>


  <?php  include("estilocarde.php"); ?>
   
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <div id="formularioresposta"></div>
        </div>
    </div>
    
      <script>
                    var btn=document.getElementsByClassName("mudavalor");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                    $(document).on("click",  ".mudavalor", function(event){
                              event.preventDefault(); 
                              
                              modal.style.display="block"; 
                              var id=$(this).data('id')
                              var tipo=$(this).data("column");
                             
                               
                                            $.ajax({
                              url:'cadastro/alterarvalordamatricula.php',
                              method:'POST',
                              data: {
                                id, tipo 
                            },
                              success:function(data){ 
                                $('#formularioresposta').html(data);  
                              }
                            })

         
                            })
                            
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }

                  </script>

            <script>
             

                                                            $(document).on("click", ".deletevenda", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletevendadocumento.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })
 




                     $(document).on("click", ".delete", function(event){
                                event.preventDefault(); 

                                var id=$(this).data("id");

                              
                                if(confirm("Tens certeza que queres eliminar esse registro? Isso não apagará a dívida, pelo contrário só a acrescentará, isso em detrimento do valor pago apagado!")){
                                    $(this).closest('tr').remove(); 
                                    $.ajax({
                                    url:'cadastro/deletedocumento.php',
                                    method:'POST',
                                    data:{
                                        id
                                    },
                                    success: function(data){
                                        $("#mensagemdealerta").html(data);
                          
                                    }

                                })
                                }
                               
                            })

            
            </script>
        
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2021</span>
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
