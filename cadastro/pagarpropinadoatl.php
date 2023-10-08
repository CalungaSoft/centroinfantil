<?php



session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

include("../conexao.php"); 

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["id"])){ 

$idmatriculaatl=isset($_POST['id'])?$_POST['id']:"";
$idmatriculaatl=mysqli_escape_string($conexao, $idmatriculaatl); 

   $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "SELECT YEAR(matriculaatl.ultimomespago) as ano, MONTH(matriculaatl.ultimomespago) as mes, matriculaatl.* from matriculaatl where idmatriculaatl='$idmatriculaatl' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno'];
      $idanolectivo=$dadoslectivos_confirmacao['idanolectivo'];
      $idatl=$dadoslectivos_confirmacao['idatl'];
      $descontoparapropinas=$dadoslectivos_confirmacao['descontoparapropinas'];

    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));

       $preco_da_propina=mysqli_fetch_array(mysqli_query($conexao, "select propina from atl where idatl='$idatl' limit 1"))[0];
 

$dados_do_anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select * from anoslectivos where idanolectivo='$idanolectivo' limit 1"));
        
   $titulo_do_ano_lectivo=$dados_do_anolectivo["titulo"];
   $precodamulta=$dados_do_anolectivo["precodamulta"]; 
   $diadamulta=$dados_do_anolectivo["diadamulta"];
 
   $anoactual=date('Y');
   $mesactual=date('m');
   $diaactual=date('d');

$numero_de_meses_pagos=mysqli_num_rows(mysqli_query($conexao, "select * from propinasdoatl where idmatriculaatl='$idmatriculaatl'"));
    
    

 $datadecontagem=date('Y-m-d'); 
 $diassemmultas=date('Y-m-d', strtotime('+'.$diadamulta.' DAYS', strtotime($datadecontagem)));

 
 $prazodepagamento=date('Y-m-d', strtotime('-'.$diadamulta.' DAYS', strtotime($datadecontagem)));
 
$html="";
          
                              
    $nomecompleto=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno' limit 1"))[0];

     $anoactual=date('Y');
                    
                  $ultimopagamento=$dadoslectivos_confirmacao['mes'];

                  
                  $proximo_pagamento="$dadoslectivos_confirmacao[ano]-$dadoslectivos_confirmacao[mes]-01";
                  $proximo_pagamento_ano=date('Y', strtotime('+ 1 MONTH', strtotime($proximo_pagamento)));
                  $proximo_pagamento_mes=date('m', strtotime('+ 1 MONTH', strtotime($proximo_pagamento)));


                     if($dadoslectivos_confirmacao['mes']==1){
                          $ultimopagamento="Janeiro";
                          if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Janeiro/".$dadoslectivos_confirmacao['ano']."";
                          }
                     }else  if($dadoslectivos_confirmacao['mes']==2){
                        $ultimopagamento="Fevereiro";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Fevereiro/".$dadoslectivos_confirmacao['ano']."";
                        }
                    }else  if($dadoslectivos_confirmacao['mes']==3){
                        $ultimopagamento="Março";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Março/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==4){
                        $ultimopagamento="Abril";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Abril/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==5){
                        $ultimopagamento="Maio";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Maio/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==6){
                        $ultimopagamento="Junho";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Junho/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==7){
                        $ultimopagamento="Julho";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Julho/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==8){
                        $ultimopagamento="Agosto";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Agosto/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==9){
                        $ultimopagamento="Setembro";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Setembro/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==10){
                        $ultimopagamento="Outubro";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Outubro/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==11){
                        $ultimopagamento="Novembro";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Novembro/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } else if($dadoslectivos_confirmacao['mes']==12){
                        $ultimopagamento="Dezembro";
                        if($dadoslectivos_confirmacao['ano']!=$anoactual){
                            $ultimopagamento="Dezembro/".$dadoslectivos_confirmacao['ano']."";
                        }
                    } 
                    

    $html.='
    
    
    <form class="user" action="" method="post">
    Pagar Propina do Aluno <h2>'.$nomecompleto.'</h2>

       <div class="alert alert-info">

             <h4> Pagando Propina de:</h4> 
             Ano Lectivo: <strong>'.$titulo_do_ano_lectivo.'</strong> | ATL: <strong>'.$dadoslectivos_confirmacao["atl"].'  </strong> <br>
         

           <input type="hidden" id="diassemmultas"  value="'.$diassemmultas.'">
           <input type="hidden" id="precodamulta"  value="'.$precodamulta.'">

           <input type="hidden" id="prazodepagamento"  value="'.$prazodepagamento.'">

           </div>

           <h4>Último mês pago: <strong> '.$ultimopagamento.' </strong></h4> <br>
           			Fazendo o Pagamento de: 
      			   
                     
                    
                      

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                         
                         <input  type="hidden" id="mesescolhido" min="2010" max="2100" class="form-control"   placeholder="Ano" value="'.$proximo_pagamento_mes.'" name="mes">

                          <select  '; if($numero_de_meses_pagos!=0){ $html.='disabled'; }else { $html.=''; } $html.=' name="mes" class="form-control">
                          <option '; if($proximo_pagamento_mes==1) {  $html.=' selected="" '; } $html.=' value="01">Janeiro</option>
                              <option '; if($proximo_pagamento_mes==2) {  $html.=' selected="" '; } $html.=' value="02">Fevereiro</option>
                              <option '; if($proximo_pagamento_mes==3) {  $html.=' selected="" '; } $html.=' value="03">Março</option>
                              <option '; if($proximo_pagamento_mes==4) {  $html.=' selected="" '; } $html.=' value="04">Abril</option>
                              <option '; if($proximo_pagamento_mes==5) {  $html.=' selected="" '; } $html.=' value="05">Maio</option>
                              <option '; if($proximo_pagamento_mes==6) {  $html.=' selected="" '; } $html.=' value="06">Junho</option>
                              <option '; if($proximo_pagamento_mes==7) {  $html.=' selected="" '; } $html.=' value="07">Julho</option>
                              <option '; if($proximo_pagamento_mes==8) {  $html.=' selected="" '; } $html.=' value="08">Agosto</option>
                              <option '; if($proximo_pagamento_mes==9) {  $html.=' selected="" '; } $html.=' value="09" >Setembro</option>
                              <option '; if($proximo_pagamento_mes==10) {  $html.=' selected="" '; } $html.=' value="10">Outubro</option>
                              <option '; if($proximo_pagamento_mes==11) {  $html.=' selected="" '; } $html.=' value="11">Novembro</option>
                              <option '; if($proximo_pagamento_mes==12) {  $html.=' selected="" '; } $html.=' value="12">Dezembro</option> 
                          </select> 
                              
                        </div>  
                        <div class="col-sm-6">  

                             <input  type="hidden" id="anoescolhido" min="2010" max="2100" class="form-control"   placeholder="Ano" value="'.$proximo_pagamento_ano.'" name="ano" >

                      <input type="number" '; if($numero_de_meses_pagos!=0){ $html.='disabled'; }else { $html.=''; } $html.='  name="ano" min="2010"  max="2100" class="form-control"   placeholder="Ano" value="'.$proximo_pagamento_ano.'" >
                              
                      
                        </div> 
 
                    </div>


 					<div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Preço da Propina</span>
                                <input type="number" min="0" step="any" name="preco" id="preco" class="form-control " value="'.$preco_da_propina.'" > 
                        </div>
                        <div class="col-sm-6"> 
                        <span>Multa</span>
                             <input type="number" min="0" step="any"  name="multa" id="multa" min="0"  class="form-control " value="0"> 
                        </div>  
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Desconto</span>
                             <input type="number" min="0" step="any" name="desconto" id="desconto" min="0"  class="form-control " value="'.$descontoparapropinas.'"> 
                             <span id="erro"></span>
                        </div> 
                        <div class="col-sm-6">  

                           <span>Valor Pago</span>
                             <input type="number" min="0" step="any" name="valorpago" id="valorpago" min="0"  class="form-control " value="'.$preco_da_propina.'"> 
                             <span id="erro"></span> 
                              
                      
                        </div> 
 
                    </div>

                     <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Referência de Pagamento</span>
                             <input type="text"  name="referencia"  class="form-control " placeholder="Insira o Código do Borderom"> 
                             <span id="erro"></span>
                        </div> 
                        <div class="col-sm-6">  

                           <span>Data de Depósito</span>
                             <input type="text"  name="datadedeposito" class="form-control  js-datepicker" placeholder="Data de Depósito" > 
                             <span id="erro"></span> 
                              
                      
                        </div> 
 
                    </div>



                   
 
 				   <div class="form-group"> 
                      <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                        $html.='
                                      <option  value="'.$exibir["formadepagamento"].'">'.$exibir["formadepagamento"].'</option>
                                    ';}

                                    $html.='
                                </select> 
                    </div>


                     <div class="form-group">
                         <span>Observações sobre o pagamento dessa propina</span>
                        <textarea name="obs" rows="2" class="form-control " title="Alguma observação?" ></textarea>
                    </div>
                     <input type="hidden" name="idmatriculaatl"    value='.$idmatriculaatl.'>
          

   <br>
                    <input type="submit" name="cadastrar"  value="Finalizar o Pagamento" class="btn btn-success" style="float: rigth;">



                     </form>





                       <script>

                            var valorpago=document.getElementById("valorpago");
                            var preco=document.getElementById("preco");
                            var multa=document.getElementById("multa");
                            var desconto=document.getElementById("desconto");
                            var erro=document.getElementById("erro");
 
                              var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);

                              var preco_com_multa=parseFloat(preco1+multa1);
                              valorpago.value=parseFloat(preco_com_multa-desconto1);
                                   
                                   erro.innerHTML=""; 

                           desconto.addEventListener("input", function(){

                              var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);

 								              var preco_com_multa=parseFloat(preco1+multa1);
                              valorpago.value=parseFloat(preco_com_multa-desconto1);
                                   
                                   erro.innerHTML="";  
           
                          })


                           preco.addEventListener("input", function(){

                                  var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);

                              var preco_com_multa=parseFloat(preco1+multa1);
                              valorpago.value=parseFloat(preco_com_multa-desconto1);
                                   
                                   erro.innerHTML=""; 
           
                          })


                           multa.addEventListener("input", function(){

                                
                                    var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);

                              var preco_com_multa=parseFloat(preco1+multa1);
                              valorpago.value=parseFloat(preco_com_multa-desconto1);
                                   
                                   erro.innerHTML=""; 
           
                          })


                           valorpago.addEventListener("input", function(){
    
                              var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);
                              var valorpago1=parseFloat(valorpago.value);

                              var preco_com_multa=parseFloat(preco1+multa1); 
                                   
                                   erro.innerHTML=""; 
                                     var divida=parseFloat(preco_com_multa-desconto1-valorpago1);

                                      
                                       if(divida<0){
                                        divida=divida*(-1);

                                        ';

                                        $html.="

                                        erro.innerHTML='<div class=alert alert-danger>O Aluno Pagou '+divida+' amais</div>' "; 
                                        $html.="
                                     }else if(divida>0){

                                       erro.innerHTML='<div class=alert alert-danger>O Aluno Ficou devendo '+divida+' </div>' "; 
                                    $html.="

                                      }else {

                                         erro.innerHTML='' ";

                                     $html.=' }

                                      

                                   
           
                          })

                     
      
                                    var prazodepagamento=document.getElementById("prazodepagamento");
                                 var prazodepagamento=prazodepagamento.value;
                                    var mesapagar=mesescolhido.options[mesescolhido.selectedIndex].value 
                                    var anoapagar=anoescolhido.value;

                                  
                                    var datadehoje=new Date();
                                    var diaactual=String(datadehoje.getDate()).padStart(2,"0");
 
                                     var mesdehoje=String(datadehoje.getMonth()+1).padStart(2,"0");
                                     var anodehoje=datadehoje.getFullYear();

                                     var datadapropina=anoapagar+"-"+mesapagar+"-"+"01";
                                     var datadehoje=anodehoje+"-"+mesdehoje+"-"+diaactual;
                                    
                                     var datasemmulta=diassemmultas.value;
                                     var valordamulta=precodamulta.value;

                                    if(datadapropina<=prazodepagamento){ 

                                     multa.value=parseFloat(valordamulta);

                                    }else{
                                      multa.value=parseFloat(0);
                                    }
       
                            mesescolhido.addEventListener("change", function(){
 
                                 var prazodepagamento=document.getElementById("prazodepagamento");
                                 var prazodepagamento=prazodepagamento.value;
                                    var mesapagar=mesescolhido.options[mesescolhido.selectedIndex].value 
                                    var anoapagar=anoescolhido.value;

                                  
                                    var datadehoje=new Date();
                                    var diaactual=String(datadehoje.getDate()).padStart(2,"0");
 
                                     var mesdehoje=String(datadehoje.getMonth()+1).padStart(2,"0");
                                     var anodehoje=datadehoje.getFullYear();

                                     var datadapropina=anoapagar+"-"+mesapagar+"-"+"01";
                                     var datadehoje=anodehoje+"-"+mesdehoje+"-"+diaactual;
                                    
                                     var datasemmulta=diassemmultas.value;
                                     var valordamulta=precodamulta.value;

                                    if(datadapropina<=prazodepagamento){ 

                                     multa.value=parseFloat(valordamulta);

                                    }else{
                                      multa.value=parseFloat(0);
                                    }


                                     var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);

                              var preco_com_multa=parseFloat(preco1+multa1);
                              valorpago.value=parseFloat(preco_com_multa-desconto1);
                                   
                                   erro.innerHTML=""; 
 
                          })





                            anoescolhido.addEventListener("change", function(){
 

                                    var prazodepagamento=document.getElementById("prazodepagamento");
                                 var prazodepagamento=prazodepagamento.value;
                                    var mesapagar=mesescolhido.options[mesescolhido.selectedIndex].value 
                                    var anoapagar=anoescolhido.value;

                                  
                                    var datadehoje=new Date();
                                    var diaactual=String(datadehoje.getDate()).padStart(2,"0");
 
                                     var mesdehoje=String(datadehoje.getMonth()+1).padStart(2,"0");
                                     var anodehoje=datadehoje.getFullYear();

                                     var datadapropina=anoapagar+"-"+mesapagar+"-"+"01";
                                     var datadehoje=anodehoje+"-"+mesdehoje+"-"+diaactual;
                                    
                                     var datasemmulta=diassemmultas.value;
                                     var valordamulta=precodamulta.value;

                                    if(datadapropina<=prazodepagamento){ 

                                     multa.value=parseFloat(valordamulta);

                                    }else{
                                      multa.value=parseFloat(0);
                                    }



                                     var preco1=parseFloat(preco.value);
                              var multa1=parseFloat(multa.value);
                              var desconto1=parseFloat(desconto.value);

                              var preco_com_multa=parseFloat(preco1+multa1);
                              valorpago.value=parseFloat(preco_com_multa-desconto1);
                                   
                                   erro.innerHTML=""; 
                                           
                          })
                  

                  

                        </script>

                         <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
        '; 


echo $html;

}




?>