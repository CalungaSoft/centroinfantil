 
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

 
    $dia=date('d');  
    $mes=date('m');  
    $ano=date('Y'); 
    if($mes==1) 
    $mes="Janeiro"; 
    else if($mes==2) 
    $mes="Fevereiro"; 
    else if($mes==3) 
    $mes="Março"; 
    else if($mes==4) 
    $mes="Abril"; 
    else if($mes==5) 
    $mes="Maio"; 
    else if($mes==6) 
    $mes="Junho"; 
    else if($mes==7) 
    $mes="Julho"; 
    else if($mes==8) 
    $mes="Agosto"; 
    else if($mes==9) 
    $mes="Setembro"; 
    else if($mes==10) 
    $mes="Outubro"; 
    else if($mes==11) 
    $mes="Novembro"; 
    else if($mes==12) 
    $mes="Dezembro"; 


    $dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));
    $total=mysqli_num_rows(mysqli_query($conexao, "select * from  clientes")); 

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

        $gerador=new DOMPDF(); 
        $htm=' 
        <style>  #centro{text-align: center;} figure {margin-top:-45px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/logotipo.png"> 
                </figure>
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 22px; font-family: forte"> '.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |LISTA DE CLIENTES NA Farmácia ('.$total.')</span>
            <br> <br> <br> 
        <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="98%" align=center>
                  <thead>
                  <thead>
                  <tr>
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">id</th>
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">Nome</th>
                    <th  width="auto" style="border: 1px solid; border-spacing:0px">Telefone</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Viatura</th> 
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Motorista</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Valor Agregado</th> 
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Dívida</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Nº de Vezes</th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Localização</th> 
                  </tr> 
                </thead> 
                <tbody> 
                     ';

                    $listadefuncionários=mysqli_query($conexao,"SELECT * FROM clientes order by data asc"); 
                   while($exibir = $listadefuncionários->fetch_array()){ 
                     $idcliente=$exibir['idcliente'];

                    $dadospessoais=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM clientes where idcliente='$idcliente' ")) ;
                    $viatura=mysqli_fetch_array(mysqli_query($conexao," SELECT marca, idviatura FROM viaturas where cliente='$idcliente' order by idviatura desc"));

                    $totaldepintura=mysqli_num_rows(mysqli_query($conexao, "select pintura.idviatura FROM viaturas, pintura where pintura.idviatura=viaturas.idviatura and viaturas.cliente='$idcliente'")); 
                    $totaldechaparia=mysqli_num_rows(mysqli_query($conexao, "select chaparia.idviatura FROM viaturas, chaparia where chaparia.idviatura=viaturas.idviatura and viaturas.cliente='$idcliente'")); 
                    $totaldereparacao=mysqli_num_rows(mysqli_query($conexao, "select reparacao.idviatura FROM viaturas, reparacao where reparacao.idviatura=viaturas.idviatura and viaturas.cliente='$idcliente'")); 
                    $totalderevisao=mysqli_num_rows(mysqli_query($conexao, "select revisao.idviatura FROM viaturas, revisao where revisao.idviatura=viaturas.idviatura and viaturas.cliente='$idcliente'")); 
                    
                    $totaldeviaturas=$totalderevisao+$totaldereparacao+$totaldepintura+$totaldechaparia;

                    $totalvalorpintura=mysqli_fetch_array(mysqli_query($conexao, "select SUM(valor) FROM entradas, viaturas, pintura where pintura.idviatura=viaturas.idviatura and pintura.idpintura=entradas.idobra and entradas.tipo='pintura' and viaturas.cliente='$idcliente' "))[0]; 
                    $totalvalorreparacao=mysqli_fetch_array(mysqli_query($conexao, "select SUM(valor) FROM entradas, viaturas, reparacao where reparacao.idviatura=viaturas.idviatura and reparacao.idreparacao=entradas.idobra and entradas.tipo='reparacao' and viaturas.cliente='$idcliente' "))[0]; 
                    $totalvalorrevisao=mysqli_fetch_array(mysqli_query($conexao, "select SUM(valor) FROM entradas, viaturas, revisao where revisao.idviatura=viaturas.idviatura and revisao.idrevisao=entradas.idobra and entradas.tipo='revisao' and viaturas.cliente='$idcliente' "))[0]; 
                    $totalvalorchaparia=mysqli_fetch_array(mysqli_query($conexao, "select SUM(valor) FROM entradas, viaturas, chaparia where chaparia.idviatura=viaturas.idviatura and chaparia.idchaparia=entradas.idobra and entradas.tipo='chaparia' and viaturas.cliente='$idcliente' "))[0]; 

                    $totalvalorviaturas=$totalvalorpintura+$totalvalorchaparia+$totalvalorreparacao+$totalvalorrevisao;

                    $totaldividapintura=mysqli_fetch_array(mysqli_query($conexao, "select SUM(divida) FROM entradas, viaturas, pintura where pintura.idviatura=viaturas.idviatura and pintura.idpintura=entradas.idobra and entradas.tipo='pintura'  and viaturas.cliente='$idcliente' "))[0]; 
                    $totaldividareparacao=mysqli_fetch_array(mysqli_query($conexao, "select SUM(divida) FROM entradas, viaturas, reparacao where reparacao.idviatura=viaturas.idviatura and reparacao.idreparacao=entradas.idobra and entradas.tipo='reparacao'  and viaturas.cliente='$idcliente' "))[0]; 
                    $totaldividarevisao=mysqli_fetch_array(mysqli_query($conexao, "select SUM(divida) FROM entradas, viaturas, revisao where revisao.idviatura=viaturas.idviatura and revisao.idrevisao=entradas.idobra and entradas.tipo='revisao'  and viaturas.cliente='$idcliente' "))[0]; 
                    $totaldividachaparia=mysqli_fetch_array(mysqli_query($conexao, "select SUM(divida) FROM entradas, viaturas, chaparia where chaparia.idviatura=viaturas.idviatura and chaparia.idchaparia=entradas.idobra and entradas.tipo='chaparia'  and viaturas.cliente='$idcliente' "))[0]; 
                    $totaldividaviaturas=$totaldividapintura+$totaldividachaparia+$totaldividareparacao+$totaldividarevisao;
                    
                    $totalvalorviaturas=number_format($totalvalorviaturas,2,",", "."); 
                    $htm.="
                         
                        <tr>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["idcliente"]."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomedocliente"]."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["telefone"]."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$viatura["marca"]."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomedomotorista"]."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totalvalorviaturas."</td> 
                            ";
                                            $hoje=date("Y-m-d");
                                                    
                                            $dividadoclientenoparque=0;

                                            $parque=mysqli_query($conexao, "select parque.* from parque, clientes, viaturas where parque.idviatura=viaturas.idviatura and viaturas.cliente=clientes.idcliente and viaturas.cliente='$idcliente'");  
                                        
                                            while($mostrar = $parque->fetch_array()){
                                            $idparque=$mostrar['idparque']; 
                                            if($mostrar['datafim']==NULL){
                                                $mostrar['datafim']=$hoje;
                                            }
                                            $datafim=$mostrar['datafim'];
                                            $dias=mysqli_fetch_array(mysqli_query($conexao," SELECT TIMESTAMPDIFF(DAY,datainicio,'$datafim') FROM parque where idparque='$idparque'"))[0];
                                            if($mostrar['datainicio']>$datafim){ $dias=0;}
                                                
                                            $dividadoclientenoparque+=($dias*$mostrar['valorpordia']-$mostrar['valorpago']);
                                            }
                                            $dividadocliente=number_format($totaldividaviaturas+$dividadoclientenoparque,2,",", ".");
                            $htm.="
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$dividadocliente."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$totaldeviaturas."</td>
                            <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["localizacao"]."</td> 
                        </tr>

                         ";
                        }

        $htm.="</tbody>
             </table> 
        

             <br>
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>
        </div>
        ";


        $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "relatorio.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 