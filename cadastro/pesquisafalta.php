<?php
 
 
include("../conexao.php");

$idfalta=$_POST['idfalta'];

    $idmatricula=mysqli_fetch_array(mysqli_query($conexao, "select idmatricula from faltas where idfalta='$idfalta' limit 1"))[0];

  $dadosda_r=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculas where idmatricula='$idmatricula' limit 1"));

                                   
                                  $idanolectivo=$dadosda_r["idanolectivo"];
 
$precodafalta= mysqli_fetch_array(mysqli_query($conexao, "select precodafalta from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0]; 
 
 $valor_a_pagar=$precodafalta;

 $htm='
                                       
               
   <form action="" method="post"> <br> <hr><hr>
 
 

            <input type="hidden" name="idfalta" value="'.$idfalta.'"  >

                
                      <hr> <hr> <hr>  <br><br>

                  <div class="form-group">
                      
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " value="'.$valor_a_pagar.'" > 
                        
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" value="'.$valor_a_pagar.'" > 
                             <span id="erro"></span>
                        </div> 
                        <div class="col-sm-6">  

                            <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                        $htm.='
                                      <option  value="'.$exibir["formadepagamento"].'">'.$exibir["formadepagamento"].'</option>
                                    ';}

                                    $htm.='
                                </select> 
       
                      
                        </div> 
 
                    </div>
 

                     <br>
                    <input type="submit" name="cadastrar"  value="Concluir a Justificação da Falta" class="btn btn-success" style="float: rigth;">

                     </form>


                        <script>

                            var valorpago=document.getElementById("valorpago");
                            var preco=document.getElementById("preco"); 
                            var erro=document.getElementById("erro");
                            
                            var quantidadedefalta=1;
  


                         preco.addEventListener("input", function(){

                                
                                   valorpago.value=parseInt(preco.value)*parseInt(quantidadedefalta);

                                   erro.innerHTML="";  
           
                          })


                           quantidadedefalta.addEventListener("input", function(){

                                
                                   valorpago.value=parseInt(preco.value);

                                   erro.innerHTML="";  
           
                          })

                           valorpago.addEventListener("input", function(){
    
                                    var valorporpagar=parseInt(preco.value);

                                    var valorpago=parseInt(this.value); 

                                     var divida=valorporpagar-valorpago;

                                      
                                       if(divida<0){
                                        divida=divida*(-1);

                                        ';

                                        $htm.="

                                        erro.innerHTML='<div class=alert alert-danger>O Aluno Pagou '+divida+' amais</div>' "; 
                                        $htm.="
                                     }else if(divida>0){

                                       erro.innerHTML='<div class=alert alert-danger>O Aluno Ficou devendo '+divida+' </div>' "; 
                                    $htm.="

                                      }else {

                                         erro.innerHTML='' ";

                                     $htm.=' }

                                      

                                   
           
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

echo "$htm"; 
?>