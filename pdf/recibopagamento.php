 
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

$identrada=isset($_GET['identrada'])?$_GET['identrada']:"";

 $dadosdacompra=mysqli_fetch_array(mysqli_query($conexao, "select DAY(datadaentrada) as diap, MONTH(datadaentrada) as mesp, YEAR(datadaentrada) as anop, entradas.* from  entradas where identrada='$identrada'")); 


$idaluno=$dadosdacompra["idaluno"];
$idanolectivo=$dadosdacompra["idanolectivo"];

$idmatriculaeconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select idmatriculaeconfirmacao from  matriculaseconfirmacoes where idaluno='$idaluno' and idanolectivo='$idanolectivo'"))[0]; 

  

$dados_da_matricula=mysqli_fetch_array(mysqli_query($conexao, "select * from  matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'")); 


 
 $mesma_data="$dadosdacompra[anop]-$dadosdacompra[mesp]-$dadosdacompra[diap]";
 
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
                Fat. Nº'.$identrada.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|| &nbsp;&nbsp;&nbsp;'.$mesma_data.' ';
                
                 
                if(!empty($dadosdacompra["obs"])){ $htm.=' 
                <hr >
                Observações: '.$dadosdacompra["obs"].'
                <br>
                <hr> ';}
                
                $htm.='
                <hr size="5px"> 
              
                     
                                    
                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                    <thead>
                        <tr>
                        <td  width="auto" style="border: 1px solid; border-spacing:0px">Descrição</td>
                        <td  width="auto" style="border: 1px solid; border-spacing:0px">Preço</td>
                        <td  width="auto" style="border: 1px solid; border-spacing:0px">Pago</td>  
                        </tr>
                    </thead> 
                    <tbody>
                       ';



                         $lista_de_propinas=mysqli_query($conexao,"SELECT  * FROM entradas where idaluno='$idaluno' and idanolectivo='$idanolectivo' and  '$dadosdacompra[anop]'=YEAR(datadaentrada) and '$dadosdacompra[mesp]'=MONTH(datadaentrada) and '$dadosdacompra[diap]'=DAY(datadaentrada)"); 

                         $total_sem_desconto_geral=0;
                         $total_divida=0;
                         $total_valor_pago=0;

                    while($exibir = $lista_de_propinas->fetch_array()){  

                            $total_divida+=$exibir["divida"];
                            $total_valor_pago+=$exibir["valor"];

                        $tamanho_da_pagina+=20;



                        $preco=$exibir["valor"]+$exibir["divida"];
                        $htm.='
                        <tr>
                        <td >'.$exibir["descricao"].'</td>
                        <td align="center">'.$preco.'</td>
                        <td align="center">'.$exibir["valor"].'</td> 
                        </tr>
                         ';
                     }
                    

                    $total_sem_desconto_f=number_format($total_valor_pago+$total_divida,2,",", ".");
                     
                    $htm.='
                    </tbody>
                    </table>

                    <hr>

                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                  
                    </thead>  
                    </table>
                        ';

                         //compra

                        $desconto_em_compras=mysqli_fetch_array(mysqli_query($conexao,"SELECT  sum(desconto) FROM compra where idaluno='$idaluno' and idanolectivo='$idanolectivo' and  '$dadosdacompra[anop]'=YEAR(data) and '$dadosdacompra[mesp]'=MONTH(data) and '$dadosdacompra[diap]'=DAY(data)"))[0];
                        //Documentos tratados
                         $desconto_em_compras+=mysqli_fetch_array(mysqli_query($conexao,"SELECT  sum(desconto) FROM documentostratados where idaluno='$idaluno' and idanolectivo='$idanolectivo' and  '$dadosdacompra[anop]'=YEAR(datadeentrada) and '$dadosdacompra[mesp]'=MONTH(datadeentrada) and '$dadosdacompra[diap]'=DAY(datadeentrada)"))[0];
                        //Matricula e reconfirmações

                          $desconto_em_compras+=mysqli_fetch_array(mysqli_query($conexao,"SELECT  sum(desconto) FROM matriculaseconfirmacoes where idaluno='$idaluno' and idanolectivo='$idanolectivo' and  '$dadosdacompra[anop]'=YEAR(data) and '$dadosdacompra[mesp]'=MONTH(data) and '$dadosdacompra[diap]'=DAY(data)"))[0];

                        //Propinas

                            $desconto_em_compras+=mysqli_fetch_array(mysqli_query($conexao,"SELECT  sum(desconto) FROM propinas where idaluno='$idaluno' and idanolectivo='$idanolectivo' and  '$dadosdacompra[anop]'=YEAR(datadopagamento) and '$dadosdacompra[mesp]'=MONTH(datadopagamento) and '$dadosdacompra[diap]'=DAY(datadopagamento)"))[0];



                        $desconto_em_compras_f=number_format($desconto_em_compras,2,",", ".");

                        $divida_f=number_format($total_divida,2,",", ".");

                         $valorpago_f=number_format($total_valor_pago,2,",", ".");  

                         $forma_de_pagamento=$dadosdacompra["formadepagamento"]; 

                        $htm.='
                    <hr size="3px"> 
                    <table class="table table-striped" style="border:0px solid; border-spacing:0px;" width="100%">
                  
                    </thead> 
                    <tbody> 
                        <tr>
                        <td ><strong>Total(AKZ)</strong></td> 
                        <td align="right">'.$total_sem_desconto_f.'</td>
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
                        <td >Total desconto Aplicado:</td> 
                        <td align="right">'.$desconto_em_compras_f.'</td>
                        </tr>
                         <tr>
                        <td >Dívida</td> 
                        <td align="right">'.$divida_f.'</td>
                        </tr>
                    </tbody>
                    </table>


                    <hr>';
 

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
            "recibo-".$dadosdoaluno["nomecompleto"]."-CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 