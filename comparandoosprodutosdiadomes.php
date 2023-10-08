<?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 
$tipodecomparacao=$_GET['tipodecomparacao'];
$mesdecomparacao=$_GET['mesdecomparacao'];
$anodecomparacao=$_GET['anodecomparacao'];
$produto1=$_GET['produto1'];
$produto2=$_GET['produto2']; 

$nomep1=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedoproduto FROM produtos  where produtos.idproduto='$produto1'"))[0];
$nomep2=mysqli_fetch_array(mysqli_query($conexao," SELECT nomedoproduto FROM produtos  where produtos.idproduto='$produto2'"))[0];
 
            $dia1v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='01'"));
            $dia2v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='02'"));
            $dia3v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='03'"));
            $dia4v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='04'"));
            $dia5v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='05'"));
            $dia6v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='06'"));
            $dia7v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='07'"));
            $dia8v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='08'"));
            $dia9v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='09'"));
            $dia10v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='10'")); 
            $dia11v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='11'"));
            $dia12v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='12'"));
            $dia13v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='13'"));
            $dia14v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='14'"));
            $dia15v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='15'"));
            $dia16v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='16'"));
            $dia17v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='17'"));
            $dia18v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='18'"));
            $dia19v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='19'"));
            $dia20v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='20'"));
            $dia21v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='21'"));
            $dia22v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='22'"));
            $dia23v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='23'"));
            $dia24v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='24'"));
            $dia25v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='25'"));
            $dia26v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='26'"));
            $dia27v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='27'"));
            $dia28v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='28'"));
            $dia29v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='29'"));
            $dia30v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='30'"));
            $dia31v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='31'"));




            $dia1v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='01'"))[0]/($dia1v+0.000001));
            $dia2v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='02'"))[0]/($dia2v+0.000001));
            $dia3v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='03'"))[0]/($dia3v+0.000001));
            $dia4v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='04'"))[0]/($dia4v+0.000001));
            $dia5v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='05'"))[0]/($dia5v+0.000001));
            $dia6v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='06'"))[0]/($dia6v+0.000001));
            $dia7v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='07'"))[0]/($dia7v+0.000001));
            $dia8v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='08'"))[0]/($dia8v+0.000001));
            $dia9v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='09'"))[0]/($dia9v+0.000001));
            $dia10v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='10'"))[0]/($dia10v+0.000001));
            $dia11v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='11'"))[0]/($dia11v+0.000001));
            $dia12v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='12'"))[0]/($dia12v+0.000001));
            $dia13v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='13'"))[0]/($dia13v+0.000001));
            $dia14v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='14'"))[0]/($dia14v+0.000001));
            $dia15v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='15'"))[0]/($dia15v+0.000001));
            $dia16v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='16'"))[0]/($dia16v+0.000001));
            $dia17v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='17'"))[0]/($dia17v+0.000001));
            $dia18v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='18'"))[0]/($dia18v+0.000001));
            $dia19v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='19'"))[0]/($dia19v+0.000001));
            $dia20v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='20'"))[0]/($dia20v+0.000001)); 
            $dia21v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='21'"))[0]/($dia21v+0.000001));
            $dia22v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='22'"))[0]/($dia22v+0.000001));
            $dia23v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='23'"))[0]/($dia23v+0.000001));
            $dia24v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='24'"))[0]/($dia24v+0.000001));
            $dia25v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='25'"))[0]/($dia25v+0.000001));
            $dia26v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='26'"))[0]/($dia26v+0.000001));
            $dia27v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='27'"))[0]/($dia27v+0.000001)); 
            $dia28v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='28'"))[0]/($dia28v+0.000001));
            $dia29v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='29'"))[0]/($dia29v+0.000001));
            $dia30v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='30'"))[0]/($dia30v+0.000001));
            $dia31v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto1' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='31'"))[0]/($dia31v+0.000001));
             
 
             $diap21v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='01'"));
            $diap22v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='02'"));
            $diap23v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='03'"));
            $diap24v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='04'"));
            $diap25v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='05'"));
            $diap26v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='06'"));
            $diap27v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='07'"));
            $diap28v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='08'"));
            $diap29v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='09'"));
            $diap210v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='10'")); 
            $diap211v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='11'"));
            $diap212v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='12'"));
            $diap213v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='13'"));
            $diap214v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='14'"));
            $diap215v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='15'"));
            $diap216v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='16'"));
            $diap217v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='17'"));
            $diap218v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='18'"));
            $diap219v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='19'"));
            $diap220v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='20'"));
            $diap221v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='21'"));
            $diap222v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='22'"));
            $diap223v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='23'"));
            $diap224v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='24'"));
            $diap225v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='25'"));
            $diap226v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='26'"));
            $diap227v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='27'"));
            $diap228v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='28'"));
            $diap229v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='29'"));
            $diap230v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='30'"));
            $diap231v = mysqli_num_rows(mysqli_query($conexao,"select idcompra from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='31'"));



            $diap21v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='01'"))[0]/($diap21v+0.000001));
            $diap22v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='02'"))[0]/($diap22v+0.000001));
            $diap23v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='03'"))[0]/($diap23v+0.000001));
            $diap24v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='04'"))[0]/($diap24v+0.000001));
            $diap25v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='05'"))[0]/($diap25v+0.000001));
            $diap26v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='06'"))[0]/($diap26v+0.000001));
            $diap27v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='07'"))[0]/($diap27v+0.000001));
            $diap28v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='08'"))[0]/($diap28v+0.000001));
            $diap29v = round(mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='09'"))[0]/($diap29v+0.000001));
            $diap210v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='10'"))[0]/($diap210v+0.000001));
            $diap211v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='11'"))[0]/($diap211v+0.000001));
            $diap212v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='12'"))[0]/($diap212v+0.000001));
            $diap213v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='13'"))[0]/($diap213v+0.000001));
            $diap214v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='14'"))[0]/($diap214v+0.000001));
            $diap215v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='15'"))[0]/($diap215v+0.000001));
            $diap216v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='16'"))[0]/($diap216v+0.000001));
            $diap217v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='17'"))[0]/($diap217v+0.000001));
            $diap218v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='18'"))[0]/($diap218v+0.000001));
            $diap219v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='19'"))[0]/($diap219v+0.000001));
            $diap220v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='20'"))[0]/($diap220v+0.000001)); 
            $diap221v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='21'"))[0]/($diap221v+0.000001));
            $diap222v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='22'"))[0]/($diap222v+0.000001));
            $diap223v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='23'"))[0]/($diap223v+0.000001));
            $diap224v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='24'"))[0]/($diap224v+0.000001));
            $diap225v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='25'"))[0]/($diap225v+0.000001));
            $diap226v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='26'"))[0]/($diap226v+0.000001));
            $diap227v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='27'"))[0]/($diap227v+0.000001)); 
            $diap228v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='28'"))[0]/($diap228v+0.000001));
            $diap229v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='29'"))[0]/($diap229v+0.000001));
            $diap230v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='30'"))[0]/($diap230v+0.000001));
            $diap231v =round( mysqli_fetch_array(mysqli_query($conexao,"select sum(".$tipodecomparacao.") from compra where idproduto='$produto2' and YEAR(data)='$anodecomparacao' AND MONTH(data)='$mesdecomparacao' and (DAY(data))='31'"))[0]/($diap231v+0.000001));
            



 
   include("cabecalho.php")?>
    <div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Estatísticas de Vendas por dias</h1>

         
                    
    

          <!-- Content Row -->
          <div class="row">

            
            
 


           
 
         
                <!-- Card Body -->
                <div class="card-body">
                <div style="width:100%;">
		<canvas id="canvas"></canvas>
	</div> 
	<script>
    
     var nomep1="<?php print $nomep1 ?>";
     var nomep2="<?php print $nomep2?>";

     console.log(nomep1, nomep2)
		var config = {
			type: 'line',
			data: {
				labels: ["01", "02", "03", "04", "05", "06","07", "08", "09",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
				datasets: [{
					label: nomep1,
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [<?php print $dia1v?>, <?php print $dia2v?>, <?php print $dia3v?>, <?php print $dia4v?>, <?php print $dia5v?>, <?php print $dia6v?>, <?php print $dia7v?>, <?php print $dia8v?>, <?php print $dia9v?>, <?php print $dia10v?>, <?php print $dia11v?>, <?php print $dia12v?>, <?php print $dia13v?>, <?php print $dia14v?>, <?php print $dia15v?>, <?php print $dia16v?>, <?php print $dia17v?>, <?php print $dia18v?>, <?php print $dia19v?>, <?php print $dia20v?>, <?php print $dia21v?>, <?php print $dia22v?>, <?php print $dia23v?>, <?php print $dia24v?>, <?php print $dia25v?>, <?php print $dia26v?>, <?php print $dia27v?>, <?php print $dia28v?>, <?php print $dia29v?>, <?php print $dia30v?>, <?php print $dia31v?>],
					fill: false,
				}, {
					label: nomep2,
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [<?php print $diap21v?>, <?php print $diap22v?>, <?php print $diap23v?>, <?php print $diap24v?>, <?php print $diap25v?>, <?php print $diap26v?>, <?php print $diap27v?>, <?php print $diap28v?>, <?php print $diap29v?>, <?php print $diap210v?>, <?php print $diap211v?>, <?php print $diap212v?>, <?php print $diap213v?>, <?php print $diap214v?>, <?php print $diap215v?>, <?php print $diap216v?>, <?php print $diap217v?>, <?php print $diap218v?>, <?php print $diap219v?>, <?php print $diap220v?>, <?php print $diap221v?>, <?php print $diap222v?>, <?php print $diap223v?>, <?php print $diap224v?>, <?php print $diap225v?>, <?php print $diap226v?>, <?php print $diap227v?>, <?php print $diap228v?>, <?php print $diap229v?>, <?php print $diap230v?>, <?php print $diap231v?>],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Comparando  em relação a vendas por dias'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: false,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: false,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});

			});

			window.myLine.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var colorName = colorNames[config.data.datasets.length % colorNames.length];
			var newColor = window.chartColors[colorName];
			var newDataset = {
				label: 'Dataset ' + config.data.datasets.length,
				backgroundColor: newColor,
				borderColor: newColor,
				data: [],
				fill: false
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
			}

			config.data.datasets.push(newDataset);
			window.myLine.update();
		});

		document.getElementById('addData').addEventListener('click', function() {
			if (config.data.datasets.length > 0) {
				var month = MONTHS[config.data.labels.length % MONTHS.length];
				config.data.labels.push(month);

				config.data.datasets.forEach(function(dataset) {
					dataset.data.push(randomScalingFactor());
				});

				window.myLine.update();
			}
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myLine.update();
		});

		document.getElementById('removeData').addEventListener('click', function() {
			config.data.labels.splice(-1, 1); // remove the label first

			config.data.datasets.forEach(function(dataset) {
				dataset.data.pop();
			});

			window.myLine.update();
		});
	</script>
        
        <!-- /.container-fluid -->
        </div>
      </div>
      <!-- End of Main Content -->

<?php include("rodape.php") ?>
