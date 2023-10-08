 
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

$idpropina=isset($_GET['idpropina'])?$_GET['idpropina']:"";

 $dadosdapropina=mysqli_fetch_array(mysqli_query($conexao, "select DAY(datadopagamento) as diap, MONTH(datadopagamento) as mesp, YEAR(datadopagamento) as anop, YEAR(mespago) as ano, MONTH(mespago) as mes, propinas.* from  propinas where idpropina='$idpropina'")); 




$idmatriculaeconfirmacao=$dadosdapropina['idmatriculaeconfirmacao'];


$dados_da_matricula=mysqli_fetch_array(mysqli_query($conexao, "select * from  matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'")); 



 $codigo_da_ultimapropina=$dadosdapropina["codigodepropina"];
 $data_do_ultimopagamento=$dadosdapropina["datadopagamento"];
 $mesma_data="$dadosdapropina[anop]-$dadosdapropina[mesp]-$dadosdapropina[diap]";

$idaluno=$dados_da_matricula["idaluno"];
$idanolectivo=$dados_da_matricula["idanolectivo"];
$dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao, "select * from  alunos where idaluno='$idaluno'")); 
$dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));

 
$tamanho_da_pagina=800;

    $dia=date('d');  
    $mes=date('m');  
    $ano=date('Y'); 
   
 
        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

        $gerador=new DOMPDF(); 
        $htm=' 

        <style>
         
        body {
            font-size: 11px;
            margin:-20px;
        }

        .table tbody + tbody {
            border=0;
            vertical-align: none; 
          }
           
          
  
        </style>
          
                <div style="text-align: center;">
                <h3>'.$dadosdainstituicao["nome"].'</h3>
               
                '.$dadosdainstituicao["servicos"].'
                <br> 
                '.$dadosdainstituicao["telefone"].'

                <br>

                <br>
                <strong>NIF</strong>: '.$dadosdainstituicao["numerodecontribuinte"].'

                </div>

                <hr size="3px"> <br>
                Nome: 
                <strong>'.$dadosdoaluno["nomecompleto"].'</strong><br> 

                Classe: '.$dados_da_matricula["classe"].'   ------------ | Período: '.$dados_da_matricula["periodo"].'  <br>

                 Curso: '.$dados_da_matricula["curso"].'  ----------- | Sala: '.$dados_da_matricula["sala"].'   ';

                

                $htm.='<br><br>
                Fat. '.$codigo_da_ultimapropina.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|| &nbsp;&nbsp;&nbsp;'.$data_do_ultimopagamento.' ';
                
                 
                if(!empty($dadosdapropina["obs"])){ $htm.=' 
                <hr >
                Observações: '.$dadosdapropina["obs"].'
                <br>
                <hr> ';}
                
                $htm.='
                <hr size="5px"> 
              
                     
                                    
                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                    <thead>
                        <tr>
                        <td  width="auto" style="border: 1px solid; border-spacing:0px">Mês Pago</td>
                        <td  width="auto" style="border: 1px solid; border-spacing:0px">Preço</td>
                        <td  width="auto" style="border: 1px solid; border-spacing:0px">Multa</td> 
                        <td align="right"  width="auto" style="border: 1px solid; border-spacing:0px">Sub-Total</td>
                        </tr>
                    </thead> 
                    <tbody>
                       ';



                         $lista_de_propinas=mysqli_query($conexao,"SELECT  YEAR(mespago) as ano, MONTH(mespago) as mes, propinas.*  FROM propinas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  '$dadosdapropina[anop]'=YEAR(datadopagamento) and '$dadosdapropina[mesp]'=MONTH(datadopagamento) and '$dadosdapropina[diap]'=DAY(datadopagamento)"); 

                         $total_sem_desconto_geral=0;
                         $total_desconto=0;
                         $total_valor_pago=0;

                    while($exibir = $lista_de_propinas->fetch_array()){ 

                         $total_sem_desconto=$exibir["preco"]+$exibir["multa"];
                        
                            $total_sem_desconto_geral+=$total_sem_desconto;
                            $total_desconto+=$exibir["desconto"];
                            $total_valor_pago+=$exibir["valorpago"];

                        $tamanho_da_pagina+=20;
                        $htm.='
                        <tr>
                        <td >'.$exibir["mes"].'/'.$exibir["ano"].'</td>
                        <td align="center">'.$exibir["preco"].'</td>
                        <td align="center">'.$exibir["multa"].'</td>
                        <td align="right" >'.$total_sem_desconto.'</td>
                        </tr>
                         ';
                     }
                    

                    $total_sem_desconto_f=number_format($total_sem_desconto_geral,2,",", ".");
                    $desconto_formatado=number_format($total_desconto,2,",", ".");
                    
                    $total_com_desconto=$total_sem_desconto_geral-$total_desconto;
                    $total_com_desconto_f=number_format($total_com_desconto,2,",", ".");

                    $htm.='
                    </tbody>
                    </table>

                    <hr>

                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                  
                    </thead> 
                    <tbody>
                        <tr>
                        <td >Sub-total</td>
                        <td align="right">'.$total_sem_desconto_f.'</td>
                        </tr>
                        <tr>
                        <td >Desconto</td> 
                        <td align="right">'.$desconto_formatado.'</td>
                        </tr>
                        <tr>
                        <td >Retenção(0%)</td> 
                        <td align="right">0,00</td>
                        </tr>

                        

                    </tbody>
                    </table>
                        ';
 
                        $divida=$total_com_desconto-$total_valor_pago;
                        $divida_f=number_format($divida,2,",", ".");

                         $valorpago_f=number_format($total_valor_pago,2,",", ".");  

                         $forma_de_pagamento=mysqli_fetch_array(mysqli_query($conexao, "select formadepagamento from  entradas where idtipo='$idpropina' and tipo='Propina'"))[0]; 

                        $htm.='
                    <hr size="3px"> 
                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                  
                    </thead> 
                    <tbody> 
                        <tr>
                        <td ><strong>Total(AKZ)</strong></td> 
                        <td align="right">'.$total_com_desconto_f.'</td>
                        </tr>
                        <tr>
                        <td >Pago</td> 
                        <td align="right">'.$valorpago_f.'</td>
                        </tr>
                        <tr>
                        <td >F. Pag.</td> 
                        <td align="right">'.$forma_de_pagamento.'</td>
                        </tr>
                         <tr>
                        <td >Dívida</td> 
                        <td align="right">'.$divida_f.'</td>
                        </tr>
                    </tbody>
                    </table>


                    <hr>

                    Histórico de Pagamentos

                    <hr>

                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                  
                    </thead> 
                    <tbody>
                    ';

                    $janeiro=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='1' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($janeiro==1){
                        $janeiro='Pago';
                    }else{
                        $janeiro='N/Pago';
                    }


                     $fevereiro=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='2' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($fevereiro==1){
                        $fevereiro='Pago';
                    }else{
                        $fevereiro='N/Pago';
                    }



                     $marco=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='3' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($marco==1){
                        $marco='Pago';
                    }else{
                        $marco='N/Pago';
                    }



                     $abril=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='4' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($abril==1){
                        $abril='Pago';
                    }else{
                        $abril='N/Pago';
                    }



                     $maio=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='5' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($maio==1){
                        $maio='Pago';
                    }else{
                        $maio='N/Pago';
                    }



                     $junho=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='6' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($junho==1){
                        $junho='Pago';
                    }else{
                        $junho='N/Pago';
                    }



                     $julho=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='7' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($julho==1){
                        $julho='Pago';
                    }else{
                        $julho='N/Pago';
                    }



                     $agosto=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='8' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($agosto==1){
                        $agosto='Pago';
                    }else{
                        $agosto='N/Pago';
                    }



                     $setembro=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='9' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($setembro==1){
                        $setembro='Pago';
                    }else{
                        $setembro='N/Pago';
                    }


                     $outubro=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='10' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($outubro==1){
                        $outubro='Pago';
                    }else{
                        $outubro='N/Pago';
                    }


                     $novembro=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='11' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($novembro==1){
                        $novembro='Pago';
                    }else{
                        $novembro='N/Pago';
                    }


                     $dezembro=mysqli_num_rows(mysqli_query($conexao, "select idpropina  from  propinas where idanolectivo='$idanolectivo' and MONTH(mespago)='12'  and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1")); 

                    if($dezembro==1){
                        $dezembro='Pago';
                    }else{
                        $dezembro='N/Pago';
                    }


                     

                    $htm.='
                        <tr>
                        <th>Janeiro</th>
                        <td>'.$janeiro.'</td>
                        <th>Julho</th>
                        <td>'.$julho.'</td>
                        </tr>

                        <tr>
                        <th>Fevereiro</th>
                        <td>'.$fevereiro.'</td>
                        <th>Agosto</th>
                        <td>'.$agosto.'</td>
                        </tr>


                        <tr>
                        <th>Março</th>
                        <td>'.$marco.'</td>
                        <th>Setembro</th>
                        <td>'.$setembro.'</td>
                        </tr>


                        <tr>
                        <th>Abril</th>
                        <td>'.$abril.'</td>
                        <th>Outubro</th>
                        <td>'.$outubro.'</td>
                        </tr>


                        <tr>
                        <th>Maio</th>
                        <td>'.$maio.'</td>
                        <th>Novembro</th>
                        <td>'.$novembro.'</td>
                        </tr>

                        <tr>
                        <th>Junho</th>
                        <td>'.$junho.'</td>
                        <th>Dezembro</th>
                        <td>'.$dezembro.'</td>
                        </tr>


                          
                    </tbody>
                    </table>';


                     $dividas_anteriores=mysqli_fetch_array(mysqli_query($conexao, "select sum(divida) from  entradas where idaluno='$idaluno'"))[0]; 


                     if($dividas_anteriores!=0){

                            $dividas_anteriores_f=number_format($dividas_anteriores,2,",", "."); 

                        $htm.=' <hr>Total de Dívidas contraídas por esse aluno: '.$dividas_anteriores_f.' AKZ ';

                     }
                     

                    $htm.='
                        
  
                    <hr> 
                    Operador(a): '.$nomelogado.' <br>

                    <div style="text-align: center;">---------------------------------------------------------------</div>
                    Conta:<strong>'.$dadosdainstituicao["contabancaria"].'</strong>
                    <br>

                    <div style="text-align: center;">'.$dadosdainstituicao["localizacaoprecisa"].'</div>

                    <br>

                     <div style="text-align: center;">---------------------------------------------------------------</div>
                     <div>Sistema de Gestão - CalungaSoft  | tel:  941 452 153</div> <br>
                     <div style="text-align: center;">*OBRIGADO*</div>
        ';


        $gerador->load_html($htm); 
        $gerador->setPaper(array(0,0,210,$tamanho_da_pagina), 'portrait');
        $gerador->render();
    
        $gerador->stream(
            "reciboCalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 