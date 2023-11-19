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

$idmatriculaeconfirmacao=isset($_POST['id'])?$_POST['id']:"";
$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $idmatriculaeconfirmacao); 

   $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "SELECT YEAR(matriculaseconfirmacoes.data) as anoEntrada, MONTH(matriculaseconfirmacoes.data) as mesEntrada, YEAR(matriculaseconfirmacoes.ultimomespago) as ano, MONTH(matriculaseconfirmacoes.ultimomespago) as mes, matriculaseconfirmacoes.* from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno'];
      $idanolectivo=$dadoslectivos_confirmacao['idanolectivo'];
      $idturma=$dadoslectivos_confirmacao['idturma'];
      $descontoparapropinas=$dadoslectivos_confirmacao['descontoparapropinas'];

      $anoEntrada=$dadoslectivos_confirmacao['anoEntrada'];
      $mesEntrada=$dadoslectivos_confirmacao['mesEntrada'];

    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));

       $preco_da_propina=mysqli_fetch_array(mysqli_query($conexao, "select propina from turmas where idturma='$idturma' limit 1"))[0];
 

$dados_do_anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select * from anoslectivos where idanolectivo='$idanolectivo' limit 1"));
        
   $titulo_do_ano_lectivo=$dados_do_anolectivo["titulo"];
   $precodamulta=$dados_do_anolectivo["precodamulta"]; 
   $diadamulta=$dados_do_anolectivo["diadamulta"];
  
    // Função para verificar se o valor é percentual
    // Função para calcular o novo valor da multa com base no valor percentual ou exato
    function calcularMulta($valorPropina, $multa) {
        if (strpos($multa, '%') !== false) {
            return $valorPropina * floatval(str_replace('%', '', $multa)) / 100;
        } else {
            return floatval($multa);
        }
    }

  
   


 
   $anoactual=date('Y');
   $mesactual=date('m');
   $diaactual=date('d');

$numero_de_meses_pagos=mysqli_num_rows(mysqli_query($conexao, "select * from propinas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"));
    
    

 
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
                    
                    
 $datadecontagem="$proximo_pagamento_ano-$proximo_pagamento_mes-00"; 
 
 $diassemmultas=date('Y-m-d', strtotime('+'.$diadamulta.' DAYS', strtotime($datadecontagem)));

 
 $prazodepagamento=date('Y-m-d', strtotime('-'.$diadamulta.' DAYS', strtotime($datadecontagem)));

$dataDeHoje=date('Y-m-d');

 

if ($dataDeHoje > $diassemmultas) {
   
    $multa = calcularMulta($preco_da_propina, $precodamulta);
 
} else {

    $multa = 0;
}

if ($numero_de_meses_pagos==0) {
    $multa =0;
} 
 

$valorAPagarPropina=$preco_da_propina+$multa;

    $html.='
    
    
    <form class="user" action="" method="post">
    Pagar Propina do Aluno <h2>'.$nomecompleto.'</h2>

       <div class="alert alert-info">

             <h4> Pagando Propina de:</h4> 
             Ano Lectivo: <strong>'.$titulo_do_ano_lectivo.'</strong> | Turma: <strong>'.$dadoslectivos_confirmacao["turma"].'  </strong> <br>
             Classe: <strong>'.$dadoslectivos_confirmacao["classe"].'</strong>
              | Curso: <strong>'.$dadoslectivos_confirmacao["curso"].'</strong> <br>
             Período: <strong>'.$dadoslectivos_confirmacao["periodo"].'</strong>
              | Sala: <strong>'.$dadoslectivos_confirmacao["sala"].'</strong>


           <input type="hidden" id="diassemmultas"  value="'.$diassemmultas.'">
           <input type="hidden" id="precodamulta"  value="'.$precodamulta.'">

           <input type="hidden" id="prazodepagamento"  value="'.$diassemmultas.'">

           </div>

           <h4>Último mês pago: <strong> '.$ultimopagamento.' </strong></h4> <br>
           			Fazendo o Pagamento de: 
      			   
                     
                    
                      

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                         
                         <input  type="hidden" id="mesescolhido" min="2018" max="2100" class="form-control"   placeholder="Ano" value="'.$proximo_pagamento_mes.'" name="mes">

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

                             <input  type="hidden" id="anoescolhido" min="2015" max="2100" class="form-control"   placeholder="Ano" value="'.$proximo_pagamento_ano.'" name="ano" >

                      <input type="number" '; if($numero_de_meses_pagos!=0){ $html.='disabled'; }else { $html.=''; } $html.='  name="ano" min="2010"  max="2100" class="form-control"   placeholder="Ano" value="'.$proximo_pagamento_ano.'" >
                              
                      
                        </div> 
 
                    </div>


 					<div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Preço da Propina</span>
                                <input type="number" min="0" step="any" name="preco" id="preco" class="form-control " value="'.$preco_da_propina.'" > 
                        </div>
                        <div class="col-sm-6"> 
                        <span>Multa '; if($numero_de_meses_pagos!=0){ $html.='(+'.$precodamulta.'  se passar a data '.$diassemmultas.')'; } $html.=' </span>
                             <input type="text" min="0" step="any"  name="multa" id="multa" min="0"  class="form-control " value="'.$multa.'"> 
                        </div>  
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Desconto</span>
                             <input type="number" min="0" step="any" name="desconto" id="desconto" min="0"  class="form-control " value="'.$descontoparapropinas.'"> 
                           
                        </div> 
                        <div class="col-sm-6">  

                           <span>Valor Pago</span>
                             <input type="number" min="0" step="any" name="valorpago" id="valorpago" min="0"  class="form-control " value="'.$valorAPagarPropina.'"> 
                             
                              
                      
                        </div> 
 
                    </div>
                    
                    <div class="alert alert-danger" id="erro" style="display: none;"></div>


                     <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Referência de Pagamento</span>
                             <input type="text"  name="referencia"  class="form-control " placeholder="Insira o Código do Borderom"> 
                             
                        </div> 
                        <div class="col-sm-6">  

                           <span>Data de Depósito</span>
                             <input type="text"  name="datadedeposito" class="form-control  js-datepicker" placeholder="Data de Depósito" > 
                           
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
                     <input type="hidden" name="idmatriculaeconfirmacao"    value='.$idmatriculaeconfirmacao.'>
          

   <br>
                    <input type="submit" name="cadastrar"  value="Finalizar o Pagamento" class="btn btn-success" style="float: rigth;">



                     </form>




                     <script>
                        var valorpago = document.getElementById("valorpago");
                        var preco = document.getElementById("preco");
                        var multa = document.getElementById("multa");
                        var desconto = document.getElementById("desconto");
                        var erro = document.getElementById("erro");

                        // Função para formatar números como "2.000,00"
                        function formatarNumero(numero) {
                            return numero.toLocaleString("pt-BR", { minimumFractionDigits: 2 });
                        }

                        function calcularValorPago() {
                            var preco1 = parseFloat(preco.value);
                            var multaValue = multa.value.trim();
                            var desconto1 = parseFloat(desconto.value) || 0;
                            var preco_com_multa;

                            if (multaValue.endsWith("%")) {
                            // Se o valor da multa termina com "%", considera como valor percentual
                            var multaPercentual = parseFloat(multaValue) / 100;
                            preco_com_multa = preco1 + (preco1 * multaPercentual);
                            } else {
                            // Caso contrário, considera como um valor exato
                            var multa1 = parseFloat(multaValue);
                            preco_com_multa = preco1 + multa1;
                            }

                            valorpago.value = preco_com_multa - desconto1;
                            
                            erro.innerHTML = ""; // Limpar a mensagem de erro
                            erro.style.display = "none"; // Ocultar a mensagem de erro
                        }

                        function verificarPagamento() {
                            var valorPagoFloat = parseFloat(valorpago.value);
                            var precoFloat = parseFloat(preco.value);
                            var descontoFloat = parseFloat(desconto.value) || 0;
                            
                            var multaValue = multa.value.trim(); 
                        
                            if (multaValue.endsWith("%")) {
                              // Se o valor da multa termina com "%", considera como valor percentual
                              var multaPercentual = parseFloat(multaValue) / 100;
                              precoComMultaFloat =precoFloat+ precoFloat * multaPercentual - descontoFloat;
                            } else {
                              // Caso contrário, considera como um valor exato
                              var multa1 = parseFloat(multaValue);
                              precoComMultaFloat = precoFloat+multa1 - descontoFloat;
                            }
                        
                            if (valorPagoFloat === "" || isNaN(valorPagoFloat)) {
                                erro.innerHTML = "Digite um valor válido no campo de pagamento.";
                                erro.style.display = "block"; // Exibir a mensagem de erro
                            } else if (valorPagoFloat < precoComMultaFloat) {
                                erro.innerHTML = "O Estudante Ficou devendo " + formatarNumero(precoComMultaFloat - valorPagoFloat);
                                erro.style.display = "block"; // Exibir a mensagem de erro
                            } else if (valorPagoFloat > precoComMultaFloat) {
                                erro.innerHTML = "O Estudante pagou a mais " + formatarNumero(valorPagoFloat - precoComMultaFloat);
                                erro.style.display = "block"; // Exibir a mensagem de erro
                            } else {
                                erro.innerHTML = ""; // Limpar a mensagem de erro
                                erro.style.display = "none"; // Ocultar a mensagem de erro
                            }
                        }
                        

                        preco.addEventListener("input", calcularValorPago);
                        multa.addEventListener("input", calcularValorPago);
                        desconto.addEventListener("input", calcularValorPago);
                        valorpago.addEventListener("input", verificarPagamento);
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
