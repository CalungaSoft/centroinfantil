 
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

 

$diav=date('d');
$mesv=date('m');
$anov=date('Y'); 


$hoje=date('d');
$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"2";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo); 

$anoinicio=isset($_GET['anoinicio'])?$_GET['anoinicio']:"2021";
$anoinicio=mysqli_escape_string($conexao, $anoinicio);
$mesinicio=isset($_GET['mesinicio'])?$_GET['mesinicio']:"07";
$mesinicio=mysqli_escape_string($conexao, $mesinicio);

$anofim=isset($_GET['anofim'])?$_GET['anofim']:"2025";
$anofim=mysqli_escape_string($conexao, $anofim);
$mesfim=isset($_GET['mesfim'])?$_GET['mesfim']:"06";
$mesfim=mysqli_escape_string($conexao, $mesfim); 


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


         $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo'"));

       $anolectivo=$dadosdoanolectivo["titulo"];



$datainicio="$anoinicio-$mesinicio-01"; 
  
$datafim="$anofim-$mesfim-31";

 

      $TOTALCAIXA = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim'"))[0] -  mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM saidas where idanolectivo='$idanolectivo'  and datadasaida>='$datainicio' and datadasaida<='$datafim' "))[0]; 
 ;

      $primeiradata=mysqli_fetch_array( mysqli_query($conexao,"SELECT datadaentrada from entradas where idanolectivo='$idanolectivo' order by datadaentrada asc limit 1"))[0];
    
      $ultimadata=mysqli_fetch_array( mysqli_query($conexao,"SELECT datadaentrada from entradas where idanolectivo='$idanolectivo' order by datadaentrada desc limit 1"))[0];
  


                $meses=[];
                $valormes=[];
                $saidames=[];
                $caixames=[]; 


                $mes_c=[];
                $ano_c=[];

 
                $previsao=[];

                $arrecadado=[]; 

                $emfalta=[];


                   $anoactual=date('Y');
               
                $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim' order by datadaentrada asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];

                   $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes  from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and ((MONTH(datadaentrada)>='$mesinicio' and MONTH(datadaentrada)<=12) or (MONTH(datadaentrada)>=1 and MONTH(datadaentrada)<='$mesfim') ) order by datadaentrada asc ");
                            
                            while($exibir = $lista->fetch_array()){ 
                                    

                                    $mes=$exibir["mes"];

                                    $mes_c[]=$mes;
                                    $ano_c[]=$ano;


                                     $valornasentradas=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and tipo!='Propina'"))[0];

                                    $valornaspropinas= mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from propinas where  idanolectivo='$idanolectivo' and YEAR(mespago)='$ano' and MONTH(mespago)='$mes'"))[0];

                                    $valormes[] = $valornasentradas+$valornaspropinas;


                                    $saidames[] = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  idanolectivo='$idanolectivo' and YEAR(datadasaida)='$ano' and MONTH(datadasaida)='$mes'"))[0];

 
                                  $caixames[]= $valornasentradas+$valornaspropinas-mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  idanolectivo='$idanolectivo' and YEAR(datadasaida)='$ano' and MONTH(datadasaida)='$mes'"))[0];

                                       
                                   if($exibir['mes']==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($exibir['mes']==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($exibir['mes']==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($exibir['mes']==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($exibir['mes']==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($exibir['mes']==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($exibir['mes']==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($exibir['mes']==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($exibir['mes']==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($exibir['mes']==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($exibir['mes']==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($exibir['mes']==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }
                              }





        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

        $gerador=new DOMPDF(); 
        $htm=' 
        <style>  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 18px; font-family: forte">'.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |Fluxo de Caixa Anual: '.$anolectivo.'  </span>
            <br> <br> <br> 
       
       <table class="table table-bordered"  width="100%" id="dataTable" cellspacing="0" align=center>
                  <thead>
                  <tr>

                     <th width="auto" style="border: 1px solid; border-spacing:0px">Designação</th>  

                     ';


                        foreach ($meses as $key => $value) {
                              $htm.="
                               <th width='auto' style='border: 1px solid; border-spacing:0px'>".$value."</th> ";

                            } 

                      $htm.="

                        <th width='auto' style='border: 1px solid; border-spacing:0px'>Total</th>  
                               
                       
                    </tr>
 

                  </thead> 


                   <thead>
                  <tr>
                      <th style='background-color:blue'></th>
                      ";


                        foreach ($meses as $key => $value) {
                          $htm.="
                             <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:blue''>&nbsp; </td>  
                           ";

                            } 

                      $htm.="

                         <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:blue''>&nbsp; </td>  
                       
                    </tr>

                    </thead>


                  <tbody>

                  

                  
                               <tr> 
                                <td width='auto' style='border: 1px solid; border-spacing:0px'>Propinas</td> 
                                ";


                         $total_valor_categoria=0;
                    foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria =  mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago-multa) from propinas where  idanolectivo='$idanolectivo' and YEAR(mespago)='$ano' and MONTH(mespago)='$mes'"))[0];



                                       $total_valor_categoria+=$valormes_categoria;
                                          $n=number_format($valormes_categoria,2,",", "."); 

                                          
                                          $htm.="

                                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 


                                       ";
                                   
                                     
                              }


                               $n=number_format($total_valor_categoria,2,",", ".");
                  $htm.=" 

                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 
 
                    </tr>

                  
                    
                       

                       
                        <tr> 
                                <td width='auto' style='border: 1px solid; border-spacing:0px'>Multa</td> 
                                ";


                         $total_valor_categoria=0;
                    foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria =  mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(multa) from propinas where  idanolectivo='$idanolectivo' and YEAR(mespago)='$ano' and MONTH(mespago)='$mes'"))[0];



                                       $total_valor_categoria+=$valormes_categoria;
                                          $n=number_format($valormes_categoria,2,",", "."); 

                                          
                                          $htm.="

                                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 


                                       ";
                                   
                                     
                              }


                               $n=number_format($total_valor_categoria,2,",", ".");
                  $htm.=" 

                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 
 
                    </tr>

                  ";

                    
                       //Para trazer as propinas

                       



                       $tipodeentradas =mysqli_query($conexao,"SELECT DISTINCT(tipo) from entradas where  idanolectivo='$idanolectivo' and tipo!='Tratar Documento' and tipo!='Material Escolar' and tipo!='Propina'");

                       $total_valor_por_mes[]=0;
                    


                   while($exibir_ca = $tipodeentradas->fetch_array()){

                    $tipodeentrada=$exibir_ca['tipo'];

                      $total_valor_categoria=0;
                   
  
                     
                      
                           $htm.="
                             <tr>
                           <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir_ca["tipo"]."</td> 

                            ";


                     
                    foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and  tipo='$tipodeentrada'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                          $n=number_format($valormes_categoria,2,",", ".");
                                          
                                          $htm.="
 
                                           <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 

                                        ";
                                  
                                   
                                     
                              }



                    

               
                    
                        

                            $n=number_format($total_valor_categoria,2,",", "."); 

                      $htm.="
   
                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 
 
                    </tr>
                    ";

                     } 


                    //Para trazer os documentos Tratados 


                       $documentos_tratados =mysqli_query($conexao,"SELECT DISTINCT(tipodedocumento) from documentostratados where  idanolectivo='$idanolectivo' ");

          


                   while($exibir_ca = $documentos_tratados->fetch_array()){

                    $tipodeentrada=$exibir_ca['tipodedocumento'];
                               $total_valor_categoria=0;
                   

                   $htm.="
                  <tr> 
                                <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir_ca["tipodedocumento"]."</td> 
                            ";


                     
                    foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from documentostratados where  idanolectivo='$idanolectivo' and YEAR(datadeentrada)='$ano' and MONTH(datadeentrada)='$mes' and  tipodedocumento='$tipodeentrada'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;

                                        $n=number_format($valormes_categoria,2,",", "."); 

                                          
                                          $htm.=" 
                                           <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 

                                      ";
                                  
                                   
                                    
                              }

                              $n=number_format($total_valor_categoria,2,",", ".");

                              $htm.="   <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 
 
  
                    </tr>

                    ";


 
                       //Para trazer os documentos Tratados 

                        } 


 

                    //Para trazer materiais escolares


                       $produtos_comprados =mysqli_query($conexao,"SELECT DISTINCT(compra.idproduto) as idproduto, produtos.nomedoproduto from compra, produtos where  idanolectivo='$idanolectivo' and compra.idproduto=produtos.idproduto");

          


                   while($exibir_ca = $produtos_comprados->fetch_array()){

                    $tipodeentrada=$exibir_ca['idproduto'];

                   




                               $total_valor_categoria=0;
                     $htm.="
                              
                               <tr> 
                                <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir_ca["nomedoproduto"]."</td> 
                                ";


                    
                    foreach ($mes_c as $key => $value) {
                       
                                    

                                    $mes=$value;
                                    $ano=$ano_c[$key];

                                    $valormes_categoria = mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from compra where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and MONTH(data)='$mes' and  idproduto='$tipodeentrada'"))[0];


                                       $total_valor_categoria+=$valormes_categoria;
                                          $n=number_format($valormes_categoria,2,",", "."); 

                                          
                                          $htm.="

                                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 


                                       ";
                                   
                                     
                              }


                               $n=number_format($total_valor_categoria,2,",", ".");
                  $htm.=" 

                          <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 
 
                    </tr>

                  ";

                    
                       //Para trazer os documentos Tratados 

                        }  


                        $htm.="
                   </tbody> 

                   <tbody>
                      <tr> 
                         <th width='auto' style='border: 1px solid; border-spacing:0px'>Sub-total Entradas</th> 

  
        ";

                       $total_valor_mes=0;
                    
   

                        foreach ($valormes as $key => $value) {
                           $n=number_format($value,2,",", ".");
                               $htm.="
                          <th width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</th> "; 

                                $total_valor_mes+=$value;  
                            } 


                             $n=number_format($total_valor_mes,2,",", ".");
 
                         $htm.="
                          <th width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</th> 
 
                    </tr>
                  

                   </tbody>
 

                    <thead>
                     <tr>
                      
                         <th width='auto' style='border: 1px solid; border-spacing:0px; background-color:red'>&nbsp; </th>
                     ";


                        foreach ($meses as $key => $value) {
                                  
                                   $htm.="
                                <th   width='auto' style='border: 1px solid; border-spacing:0px; background-color:red'></th> 
                                ";
                            } 

                    

                         $htm.="
                                <th   width='auto' style='border: 1px solid; border-spacing:0px; background-color:red'></th> 
                               
                    </tr>

                    </thead>


                     <tbody>
                       <tr>
                         <th width='auto' style='border: 1px solid; border-spacing:0px'>Custo</th> 
                      ";

                        foreach ($meses as $key => $value) {
                               $htm.="  <th width='auto' style='border: 1px solid; border-spacing:0px'>---</th> ";  
                            } 

                     $htm.=" 
                       <th width='auto' style='border: 1px solid; border-spacing:0px'>---</th>
                       
                    </tr>
 


                    
                     ";


                     $lista_das_categorias=mysqli_query($conexao,"SELECT DISTINCT(categoria) from tipodesaidas");
                            
                            while($vercategorias = $lista_das_categorias->fetch_array()){   

                              $categoria_saida=$vercategorias["categoria"];

                              $soma_categoria=0;

                       
                          $htm.=" <tr>
 
                          <th width='auto' style='border: 1px solid; border-spacing:0px'>".$vercategorias["categoria"]."</th> ";

                        
                            $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(datadaentrada)), YEAR(datadaentrada) as ano from entradas where  idanolectivo='$idanolectivo' and datadaentrada>='$datainicio' and datadaentrada<='$datafim' order by datadaentrada asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];

                                     $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(datadaentrada)), MONTH(datadaentrada) as mes  from entradas where  idanolectivo='$idanolectivo' and YEAR(datadaentrada)='$ano' and ((MONTH(datadaentrada)>='$mesinicio' and MONTH(datadaentrada)<=12) or (MONTH(datadaentrada)>=1 and MONTH(datadaentrada)<='$mesfim') ) order by datadaentrada asc ");
                                    
                                    while($exibir = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir["mes"];

                                             $lista_de_categoria_desaida=mysqli_query($conexao,"SELECT DISTINCT(idtipodesaida)  from tipodesaidas where categoria='$categoria_saida' ");

                                             $valormes_categoria_saida=0;
                                    
                                          while($ver = $lista_de_categoria_desaida->fetch_array()){ 

                                                  $idtipo=$ver["idtipodesaida"];



                                                  $valormes_categoria_saida+= mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valor) from saidas where  idanolectivo='$idanolectivo' and YEAR(datadasaida)='$ano' and MONTH(datadasaida)='$mes' and  idtipo='$idtipo'"))[0];

                                                }
                                               $soma_categoria+=$valormes_categoria_saida;

                                               $n=number_format($valormes_categoria_saida,2,",", ".");

                                                  $htm.="
                                                   <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";
 
                                           
                                            }
                            }


                          $n=number_format($soma_categoria,2,",", ".");

                    $htm.="
 
                        <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> 
 
                       
                    </tr>

                    "; }  $htm.="
 

                 </tbody> 


                   <tbody>
                      <tr>
                       
                        <th width='auto' style='border: 1px solid; border-spacing:0px'>Sub-total Saídas</th> ";


                       $total_valor_mes=0;
                     

                        foreach ($saidames as $key => $value) {

                           $n=number_format($value,2,",", ".");
                                  
                                  $htm.="
                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td>"; 

                                $total_valor_mes+=$value;  
                            } 

                             $n=number_format($total_valor_mes,2,",", "."); 

                            $htm.="
                     
                                  <th width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</th> 
 
 
                    </tr>
                  

                   </tbody>


                      <thead>
                  <tr> 
                      <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:green'>&nbsp; </td> 
 
                      ";


                        foreach ($meses as $key => $value) {
                          $htm.="
                     
                            <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:green'>&nbsp;</td> ";
  
                            } 

                     $htm.="
                     
                      <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:green'>&nbsp;</td> 
 
                       
                    </tr>

                    </thead>


      
                   <tbody>
                      <tr>
 
                         <th width='auto' style='border: 1px solid; border-spacing:0px'>Total no Caixa</th> 


                         ";
                

                       $total_valor_mes=0;
                    
   
 

                        foreach ($caixames as $key => $value) {

                           $n=number_format($value,2,",", ".");

                           $htm.="

                                  <th width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</th>"; 

                                $total_valor_mes+=$value;  
                            } 

                               $n=number_format($total_valor_mes,2,",", ".");

                          $htm.="

                          <th width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</th> 
 
                    </tr>
                  

                   </tbody>
                    
                </table>






              <h2>   Previsão de Propinas </h2> <br><br>



                      <table class='table table-bordered'  width='100%' id='dataTable' cellspacing='0' align=center>

                  <thead>
                  <tr>
                   
                             <th width='auto' style='border: 1px solid; border-spacing:0px'>Designação</th>

                        ";

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



                 $numero_de_meses_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafim) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                 $numero_de_meses_exame=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafimexame) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

        

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

                                       $previsao_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.tipodealuno!='Bolseiro'  and turmas.eclassedeexame='Sim'"))[0];

                                    }


                                     

                                    $previsao[]=$previsao_normal+$previsao_exame;

 

                                  

                                       $arrecadado[]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propinas.valorpago-propinas.multa)  from propinas  where idanolectivo='$idanolectivo'  and mespago='$data_de_propina_formada'"))[0];

                                   

                                      


                                     
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"))[0];

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

                                       $previsao_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo'  and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $previsao_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo'  and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"))[0];

                                    }

                                     $previsao[]=$previsao_normal+$previsao_exame;


                                      $arrecadado[]=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propinas.valorpago-propinas.multa)  from propinas  where idanolectivo='$idanolectivo'  and mespago='$data_de_propina_formada'"))[0];
                                    

                                      $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"))[0];

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(propina-descontoparapropinas)  from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"))[0];

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
                              
                               
                 

                        foreach ($meses as $key => $value) {
                               
                               $htm.="

                                  <th width='auto' style='border: 1px solid; border-spacing:0px'>".$value."</th> ";

                            } 
 
                    

                           $htm.="
                       
                    </tr>
 

                  </thead> 

                  <tbody>

                    <tr>
                      
                      
                         <th width='auto' style='border: 1px solid; border-spacing:0px'>Previsão</th>
                      ";

                        foreach ($previsao as $key => $value) {
                            $n=number_format($value,2,",", ".");

                              
                                   $htm.="

                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";


                           

                            } 

                       $htm.="

                    </tr>

                    <tr>
                       
                             <td width='auto' style='border: 1px solid; border-spacing:0px'>Acumulada</td>
                      ";

                        $soma_acumulada=0;

                        foreach ($previsao as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                                 $htm.="

                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";

 
                            } 

                      $htm.="

                    </tr>
                 
                   </tbody> 


                   <thead>
                  <tr> 
                       <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:blue'>&nbsp; </td> 
 
                     ";

                        foreach ($previsao as $key => $value) {
                               $htm.="

                                 <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:blue'>&nbsp; </td> ";

                            } 

                     $htm.="

                    </tr>

                    </thead>


                     <tbody>

                    <tr>
                       
                             <th width='auto' style='border: 1px solid; border-spacing:0px;  '> Arrecadado </th> 
                    ";

                    

                        foreach ($arrecadado as $key => $value) {
                            $n=number_format($value,2,",", ".");

                               $htm.="

                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";
 

                           

                            } 

                        $htm.="
                    </tr>

                    <tr> 
                       
                             <td width='auto' style='border: 1px solid; border-spacing:0px'>Acumulada</td>
                      ";

                        $soma_acumulada=0;

                        foreach ($arrecadado as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              $htm.="

                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";
 
                            } 

                     $htm.="
                    </tr>
                 
                   </tbody> 
                
                 <thead>
                  <tr>
                      <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:green'>&nbsp; </td> 
                     ";

                        foreach ($previsao as $key => $value) {
                               
                                $htm.="

                               <td width='auto' style='border: 1px solid; border-spacing:0px; background-color:green'>&nbsp; </td> ";  
                            } 

                      $htm.="

                       
                    </tr>

                    </thead>

                     <tbody>

                    <tr>
                      
                     
                        <th width='auto' style='border: 1px solid; border-spacing:0px'>Em Falta</th>
                      ";
                    

                        foreach ($emfalta as $key => $value) {
                            $n=number_format($value,2,",", ".");

                              $htm.="

                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";
 
                           

                            } 

                       $htm.="

                    </tr>

                    <tr>
                      
                           
                             <td width='auto' style='border: 1px solid; border-spacing:0px'>Acumulada</td>
                      ";

                        $soma_acumulada=0;

                        foreach ($emfalta as $key => $value) {

                            $soma_acumulada+=$value;

                            $n=number_format($soma_acumulada,2,",", ".");

                              
                            $htm.="

                                  <td width='auto' style='border: 1px solid; border-spacing:0px'>".$n."</td> ";
 
                            
                            } 

                       $htm.="

                    </tr>
                 
                   </tbody> 

                    <thead>
                  <tr> 
                       <th width='auto' style='border: 1px solid; border-spacing:0px; background-color:red'>&nbsp; </th> 
                      ";

                        foreach ($previsao as $key => $value) {
                          $htm.="
                          
                            <th width='auto' style='border: 1px solid; border-spacing:0px; background-color:red'>&nbsp; </th> ";

                            } 

                       $htm.="
 
                       
                    </tr>

                    </thead>



                </table>
                
                







        </div>
        ";


           $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
       
        $gerador->stream(
                 "FluxoDeCaixa-CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 