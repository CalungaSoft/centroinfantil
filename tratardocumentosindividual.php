<?php 
include("conexao.php"); 
$salvar="";

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

$erros=[];

$idmatriculaeconfirmacao=isset($_GET['idmatriculaeconfirmacao'])?$_GET['idmatriculaeconfirmacao']:"";
$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $idmatriculaeconfirmacao); 

if($idmatriculaeconfirmacao==0){
  
  $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

     
      $idaluno=isset($_GET['idaluno'])?$_GET['idaluno']:"";
      $idaluno=mysqli_escape_string($conexao, $idaluno); 
      $idanolectivo=0;

    }else{

       $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno'];
      $idanolectivo=$dadoslectivos_confirmacao['idanolectivo'];


    }
  
    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));
 

$titulo_do_ano_lectivo=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0];
        
  



if(isset($_POST['tratardeclaracaosemnotas'])){
 
  if(!empty(trim($idaluno))){ 

      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));
     
      $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));
      $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));
      $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
      $tipodedocumento='Declaração sem notas';
     
      
          $divida=round($preco-$desconto-$valorpago,2); 
          if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"));
  
                         if($existe<-1){

                           $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"))[0];

                            $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                    
                                $info[]="Esse Aluno já tratou $tipodedocumento, não pode voltar a tratar! <br> <a class='btn btn-success' href='pdf/declaracaosemnotas.php?idmatriculaeconfirmacao=".$idmatriculaeconfirmacao."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 
                          }else{

  

                                 $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
 
 
                                   $salavando_nosdocumentos=mysqli_query($conexao,"INSERT INTO `documentostratados` (`iddocumentotratado`, `idaluno`, `idmatriculaeconfirmacao`, `tipodedocumento`, `preco`, `desconto`, `valorpago`, `datadeentrada`, `datadolevantamento`, `jalevantado`, idanolectivo) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipodedocumento', '$preco', '$desconto', '$valorpago', STR_TO_DATE('$datadaentrada', '%d/%m/%Y'),STR_TO_DATE('$datadasaida', '%d/%m/%Y'), '$jalevantou', '$idanolectivo')");


                                        if($salavando_nosdocumentos){

                                          $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "SELECT iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' order by iddocumentotratado desc limit 1 "))[0];


                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$tipodedocumento', 'Tratar Documento', '$iddocumentotratado', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                          

                                          if($salvar_financas){  



                                             $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                                            $acerto[]="Registro de tratamento de documento feito com sucesso <br>  <a class='btn btn-success' href='pdf/declaracaosemnotas.php?idmatriculaeconfirmacao=".$idmatriculaeconfirmacao."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | No Registro de financas";

                                          }

                                        }
                       
 
                          }

                         
                         
  
        
          }  
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }

 

}










if(isset($_POST['tratarguidetransferencia'])){
 
  if(!empty(trim($idaluno))){ 

      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));
     
      $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));
      $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));
      $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
      $escoladedestino=mysqli_escape_string($conexao, trim($_POST['escoladedestino']));
      $tipodedocumento='Guia de Transferência';
     
      
          $divida=round($preco-$desconto-$valorpago,2); 
          if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"));
  
                         if($existe<-1){

                           $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"))[0];

                            $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                    
                                $info[]="Esse Aluno já tratou $tipodedocumento, não pode voltar a tratar! <br> <a class='btn btn-success' href='pdf/guiadetransferencia.php?iddocumentotratado=".$iddocumentotratado."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 
                          }else{

  

                                 $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
 
 
                                   $salavando_nosdocumentos=mysqli_query($conexao,"INSERT INTO `documentostratados` (`iddocumentotratado`, `idaluno`, `idmatriculaeconfirmacao`, `tipodedocumento`, `preco`, `desconto`, `valorpago`, `datadeentrada`, `datadolevantamento`, `jalevantado`, escoladedestino, idanolectivo) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipodedocumento', '$preco', '$desconto', '$valorpago', STR_TO_DATE('$datadaentrada', '%d/%m/%Y'),STR_TO_DATE('$datadasaida', '%d/%m/%Y'), '$jalevantou', '$escoladedestino', '$idanolectivo')");


                                        if($salavando_nosdocumentos){

                                          $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "SELECT iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' order by iddocumentotratado desc limit 1 "))[0];


                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$tipodedocumento', 'Tratar Documento', '$iddocumentotratado', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                          

                                          if($salvar_financas){  



                                             $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                                            $acerto[]="Registro de tratamento de documento feito com sucesso <br>  <a class='btn btn-success' href='pdf/guiadetransferencia.php?iddocumentotratado=".$iddocumentotratado."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | No Registro de financas";

                                          }

                                        }
                       
 
                          }

                         
                         
  
        
          }  
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }

 

}












if(isset($_POST['tratardeclaracaocomnotas'])){
 
  if(!empty(trim($idaluno))){ 

      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));
     
      $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));
      $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));
      $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
      $tipodedocumento='Declaração com notas';
     
      
          $divida=round($preco-$desconto-$valorpago,2); 
          if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"));
  
                         if($existe<-1){

                           $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"))[0];

                            $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                    
                                $info[]="Esse Aluno já tratou $tipodedocumento, não pode voltar a tratar! <br> <a class='btn btn-success' href='pdf/declaracaocomnotas.php?idmatriculaeconfirmacao=".$idmatriculaeconfirmacao."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a> "; 
                          }else{

  

                                 $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
 
 
                                   $salavando_nosdocumentos=mysqli_query($conexao,"INSERT INTO `documentostratados` (`iddocumentotratado`, `idaluno`, `idmatriculaeconfirmacao`, `tipodedocumento`, `preco`, `desconto`, `valorpago`, `datadeentrada`, `datadolevantamento`, `jalevantado`, idanolectivo) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipodedocumento', '$preco', '$desconto', '$valorpago', STR_TO_DATE('$datadaentrada', '%d/%m/%Y'),STR_TO_DATE('$datadasaida', '%d/%m/%Y'), '$jalevantou', '$idanolectivo')");


                                        if($salavando_nosdocumentos){

                                          $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "SELECT iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' order by iddocumentotratado desc limit 1 "))[0];


                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$tipodedocumento', 'Tratar Documento', '$iddocumentotratado', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                          

                                          if($salvar_financas){  



                                             $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                                            $acerto[]="Registro de tratamento de documento feito com sucesso <br>  <a class='btn btn-success' href='pdf/declaracaocomnotas.php?idmatriculaeconfirmacao=".$idmatriculaeconfirmacao."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | No Registro de financas";

                                          }

                                        }
                       
 
                          }

                         
                         
  
        
          }  
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }

 

}

















if(isset($_POST['tratarboletin'])){
 
  if(!empty(trim($idaluno))){ 

      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));
     
      $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));
      $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));
      $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
      $idtrimestre=mysqli_escape_string($conexao, trim($_POST['idtrimestre']));
      $tipodedocumento='Boletin';
     
       
          $divida=round($preco-$desconto-$valorpago,2); 
          if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' and idtrimestre='$idtrimestre'"));
  
                         if($existe<-1){



                           $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' and idtrimestre='$idtrimestre'"))[0];

                            $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                    
                                $info[]="Esse Aluno já tratou $tipodedocumento deste trimestre, não pode voltar a tratar! <br> <a class='btn btn-success' href='pdf/boletin.php?iddocumentotratado=".$iddocumentotratado."'> Click aqui se quiseres imprimir </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 
                          }else{

                                     

                                 $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
 
 
                                   $salavando_nosdocumentos=mysqli_query($conexao,"INSERT INTO `documentostratados` (`iddocumentotratado`, `idaluno`, `idmatriculaeconfirmacao`, `tipodedocumento`, `preco`, `desconto`, `valorpago`, `datadeentrada`, `datadolevantamento`, `jalevantado`, idtrimestre, idanolectivo) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipodedocumento', '$preco', '$desconto', '$valorpago', STR_TO_DATE('$datadaentrada', '%d/%m/%Y'),STR_TO_DATE('$datadasaida', '%d/%m/%Y'), '$jalevantou', '$idtrimestre', '$idanolectivo')");


                                        if($salavando_nosdocumentos){



                                          $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "SELECT iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' and idtrimestre='$idtrimestre' order by iddocumentotratado desc limit 1 "))[0];



                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$tipodedocumento', 'Tratar Documento', '$iddocumentotratado', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                          

                                          if($salvar_financas){  



                                             $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                                            $acerto[]="Registro de tratamento de documento feito com sucesso <br>  <a class='btn btn-success' href='pdf/boletin.php?iddocumentotratado=".$iddocumentotratado."'> Imprimir Boletin </a> ou <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a> | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | No Registro de financas";

                                          }

                                        }else{
                                          $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | Insirir nos documentos";

                                        }
                       
 
                          }

                         
                         
  
        
          }  
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }

 

}























if(isset($_POST['tratarcertificado'])){
 
  if(!empty(trim($idaluno))){ 

      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));
     
      $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));
      $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));
      $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
      $tipodedocumento="Certificado";
       
      $classeum=mysqli_escape_string($conexao, trim($_POST['classeum']));
      $classedois=mysqli_escape_string($conexao, trim($_POST['classedois']));
      $classetres=mysqli_escape_string($conexao, trim($_POST['classetres']));
      $classequatro=mysqli_escape_string($conexao, trim($_POST['classequatro']));

      $tipodedocumento="Certificado";


      $classedo_aluno=$dadoslectivos_confirmacao['classe'];

      if($classedo_aluno=="13ª"){
        $ensino="medio13";
      }else if($classedo_aluno=="12ª"){
        $ensino="medio12";
      }else if($classedo_aluno=="9ª"){
        $ensino="primeirociclo";
      }else{
        $ensino="primario";
      }
 
     
      
     
      
          $divida=round($preco-$desconto-$valorpago,2); 
          if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' and ensino='$ensino'"));
  
                         if($existe<-1){

                           $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' and ensino='$ensino'"))[0];

                            $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                    
                                $info[]="Esse Aluno já tratou ($tipodedocumento), não pode voltar a tratar! <br>  <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 
                          }else{

  

                                 $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
 
 
                                   $salavando_nosdocumentos=mysqli_query($conexao,"INSERT INTO `documentostratados` (`iddocumentotratado`, `idaluno`, `idmatriculaeconfirmacao`, `tipodedocumento`, `preco`, `desconto`, `valorpago`, `datadeentrada`, `datadolevantamento`, `jalevantado`, ensino, classeum, classedois, classetres, classequatro, idanolectivo) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipodedocumento', '$preco', '$desconto', '$valorpago', STR_TO_DATE('$datadaentrada', '%d/%m/%Y'),STR_TO_DATE('$datadasaida', '%d/%m/%Y'), '$jalevantou', '$ensino', '$classeum', '$classedois', '$classetres', '$classequatro', '$idanolectivo')");


                                        if($salavando_nosdocumentos){

                                          $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "SELECT iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento' and ensino='$ensino'  order by iddocumentotratado desc limit 1 "))[0];


                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$tipodedocumento', 'Tratar Documento', '$iddocumentotratado', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                          

                                          if($salvar_financas){  



                                             $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                                            $acerto[]="Registro de tratamento de documento feito com sucesso <br>    <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | No Registro de financas";

                                          }

                                        }
                       
 
                          }

                         
                         
  
        
          }  
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }

 

}


















 



if(isset($_POST['trataroutrodocumento'])){
 
  if(!empty(trim($idaluno))){ 

      $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));
      $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));
     
      $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']));
      $datadasaida=mysqli_escape_string($conexao, trim($_POST['datadasaida']));
      $jalevantou=mysqli_escape_string($conexao, trim($_POST['jalevantou']));
      $tipodedocumento=mysqli_escape_string($conexao, trim($_POST['tipodedocumento']));
       
     
      
          $divida=round($preco-$desconto-$valorpago,2); 
          if($divida<0){$divida=0;}

 
                   $existe=mysqli_num_rows(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"));
  
                         if($existe<-1){

                           $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "select iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'"))[0];

                            $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                    
                                $info[]="Esse Aluno já tratou ($tipodedocumento), não pode voltar a tratar! <br>  <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 
                          }else{

  

                                 $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
 
 
                                   $salavando_nosdocumentos=mysqli_query($conexao,"INSERT INTO `documentostratados` (`iddocumentotratado`, `idaluno`, `idmatriculaeconfirmacao`, `tipodedocumento`, `preco`, `desconto`, `valorpago`, `datadeentrada`, `datadolevantamento`, `jalevantado`, idanolectivo) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$tipodedocumento', '$preco', '$desconto', '$valorpago', STR_TO_DATE('$datadaentrada', '%d/%m/%Y'),STR_TO_DATE('$datadasaida', '%d/%m/%Y'), '$jalevantou', '$idanolectivo')");


                                        if($salavando_nosdocumentos){

                                          $iddocumentotratado=mysqli_fetch_array(mysqli_query($conexao, "SELECT iddocumentotratado from documentostratados where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and tipodedocumento='$tipodedocumento'   order by iddocumentotratado desc limit 1 "))[0];


                                          $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$tipodedocumento', 'Tratar Documento', '$iddocumentotratado', '$valorpago', '$divida', '$idaluno', '$idturma', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                          

                                          if($salvar_financas){  



                                             $identrada=mysqli_fetch_array(mysqli_query($conexao, "select identrada from entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0];

                                            $acerto[]="Registro de tratamento de documento feito com sucesso <br>    <a class='btn btn-info' href='detalhestratardocumentos.php?identrada=".$identrada."'> Aqui se quiseres ver</a>  | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=".$identrada."'> Imprimir Recibo </a>"; 

                                          }else{

                                            $erros[]="Ocorreu um erro ao fazer o registro do tratamento de documento | No Registro de financas";

                                          }

                                        }
                       
 
                          }

                         
                         
  
        
          }  
  else{
    $erros[]="Nenhum Aluno Foi Selecionado";
  }

 

}


include("cabecalho.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Tratar Documento do Aluno | <a href="alunoanolectivo.php?idmatriculaeconfirmacao=<?php echo $idmatriculaeconfirmacao; ?>"> <?php echo $Dados_do_aluno['nomecompleto']; ?> </a></h1>

          
           <div class="alert alert-info">

             <h4> Dados Lectivos</h4> 
             Ano Lectivo: <strong><?php echo "$titulo_do_ano_lectivo" ?></strong> | Turma: <strong><?php echo "$dadoslectivos_confirmacao[turma]" ?></strong> <br>
             Classe: <strong><?php echo "$dadoslectivos_confirmacao[classe]" ?></strong>
              | Curso: <strong><?php echo "$dadoslectivos_confirmacao[curso]" ?></strong> <br>
             Período: <strong><?php echo "$dadoslectivos_confirmacao[periodo]" ?></strong>
              | Sala: <strong><?php echo "$dadoslectivos_confirmacao[sala]" ?></strong>



           </div>


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

            <?php 
            if(!empty($info)):
                        foreach($info as $info):
                          echo '<div class="alert alert-info">'.$info.'</div>';
                        endforeach;
                      endif;
            ?>


                    

          <div class="row">

            <div class="col-lg-5">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Dados Pessoais</h6>
                </div>
                <div class="card-body">
                 <form class="user" action="" method="post">


                    <div class="form-group">
                      <input type="text" name="nomecompleto" disabled="" class="form-control " title="Digite o nome completo do aluno" placeholder="Nome do aluno" value="<?php echo $Dados_do_aluno['nomecompleto']; ?>" >
                    </div>

                    <div class="form-group">
                    <span>Nº de Processo</span>
                      <input type="text" name="numerodeprocesso" disabled=""  class="form-control"   placeholder="Número de processo do aluno"  value="<?php echo $Dados_do_aluno['numerodeprocesso']; ?>">
                    </div>
 
                    <div class="form-group">
                    <span>Nome do Pai</span>
                      <input type="text" name="nomedopai" disabled="" class="form-control " title="Digite o nome completo do Pai" placeholder="Nome do Pai" value="<?php echo $Dados_do_aluno['nomedopai']; ?>">
                    </div>
                    <div class="form-group">
                    <span>Nome da Mãe</span>
                      <input type="text" name="nomedamae" disabled="" class="form-control " title="Digite o nome completo do Mãe" placeholder="Nome do Mãe" value="<?php echo $Dados_do_aluno['nomedamae']; ?>">
                    </div>

 
                      <div class="form-group">
                      <span>Data de Nascimento</span>
                          <input type="text" name="datadenascimento" disabled=""  autocomplete="off" class="form-control js-datepicker" title="Digite data de nascimento"  value="<?php echo $Dados_do_aluno['datadenascimento']; ?>">
                      </div>

 
                    
                      <div class="form-group row">
                        <div class="col-sm-6">  
                          <span>Telefone do Aluno</span>
                                <input type="text" name="telefone" disabled="" class="form-control "  placeholder="Nº de telefone do aluno"  value="<?php echo $Dados_do_aluno['telefone']; ?>"> 
                        </div>
                        <div class="col-sm-6"> 
                        <span>Telefone dos Encarregados</span>
                             <input type="text" name="telefoneencarregado" disabled="" class="form-control "  placeholder="Nº dos Encarregados"  value="<?php echo $Dados_do_aluno['telefoneincarregados']; ?>"> 
                        </div> 
                    </div>


                    <div class="form-group">
                    <span>Morada</span>
                        <input type="text" name="morada" class="form-control " disabled="" title="Local onde mora o aluno" placeholder="Morada"  value="<?php echo $Dados_do_aluno['morada']; ?>">
                    </div>

                    

                    <div class="form-group">
                         <span>Observações sobre o aluno</span>
                        <textarea name="obs"   class="form-control " disabled="" title="Alguma observação?" >
                          <?php echo $Dados_do_aluno['obs']; ?> 
                        </textarea>
                    </div>


                   
                   

                     

                </div>
              </div>

            

            </div>

            <div class="col-lg-7">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tratar Documentos</h6>
                </div>
                <div class="card-body">

                <?php   $ultimo_mes=mysqli_fetch_array(mysqli_query($conexao, "select YEAR(ultimomespago) as ano, MONTH(ultimomespago) as mes from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 


                echo '<div class="alert alert-info">Último Pagamento: '.$ultimo_mes["mes"].'/'.$ultimo_mes["ano"].'</div>';  ?>
                              
                <span id="turmasdinamicas">

                

                    <span>Tipo de Documento</span>
                  
                    <div class="form-group">
                    <select name="turma" id='turma' required  class="form-control">
                        <option value="0" >Escolha o Tipo de Documento</option> 
                        <option value="declaracaosemnotas" >Declaração sem notas</option> 
                        <option value="declaracaocomnotas" >Declaração Com notas</option> 
                        <option value="certificado" >Certificado</option>
                        <option value="boletin" >Boletin</option>
                        <option value="guiadetransferencia" >Guia de Transferência</option> 
                        <option value="outros" >Outro Tipo de Documento</option> 

                      
                    </select> 
                    </div>


                </span>



                <span id="dadoslectivos"></span>
                 







 

                 
 
                </div>

                 </form>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



            <script>
              
              var anolectivo=document.getElementById("anolectivo");
              var turma=document.getElementById("turma"); 


             turma.addEventListener("change", function(){
    

                    var tipodedocumento=this.value;

                    var idmatriculaeconfirmacao=<?php echo "$idmatriculaeconfirmacao";?>;

                      if(tipodedocumento=='0'){

                         
                          var dadoslectivos=document.getElementById('dadoslectivos');
                            dadoslectivos.innerHTML='';

                      }else{


                         $.ajax({
                          url:"cadastro/pesquisadedocumento.php",
                          method:"POST",
                          data:{tipodedocumento, idmatriculaeconfirmacao},
                          success:function(data){

                          $("#dadoslectivos").html(data)
 

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
