<?php
 
 
include("../conexao.php");

$idturma=$_POST['idturma'];

$dadoslectivos= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                                     $idperiodo=$dadoslectivos["idperiodo"];
                           $idcurso=$dadoslectivos["idcurso"];
                           $idsala=$dadoslectivos["idsala"];
                           $idclasse=$dadoslectivos["idclasse"];
                           $idanolectivo=$dadoslectivos["idanolectivo"];
                          

                         $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];
                            
                            $diadehoje=date("d/m/Y");


 $htm='
                                       
                   
   <form action="" method="post"><br> <hr><hr>

       
                    <div class="form-group">
                    <span>Tipo de Cadastro</span>
                    <select name="tipodecadastro"    class="form-control"> 
                        <option value="Matrícula">Matrícula</option>
                        <option value="Confirmação">Confirmação</option>

                    </select> 
                    </div>



               <div class="form-group">
                      <span>Tipo de Aluno</span>
                              <select name="tipodealuno"  class="form-control"   >  
                                     <option value="Normal">Normal</option>
                                     <option value="Bolseiro">Bolseiro</option>
                              </select> 
                     </div>
                    <div class="form-group">
                 <span>Data Da Matrícula</span>
                <input type="text" name="datadareconfirmacao" autocomplete="off" class="form-control js-datepicker" title="Digite data da Matrícula" placeholder="Data da Matrícula" value="'.$diadehoje.'">
              </div>

            <input type="hidden" name="idturma" value="'.$idturma.'"  >

                <div class="form-group row"> 
                      <div class="col-sm-2">   
                        <span>Sala</span> 
                                <input type="text" disabled="" id="sala" class="form-control " value="'.$sala.'" > 
                        </div>
                        <div class="col-sm-10"> 
                        <span>Curso</span>
                             <input type="text" disabled="" id="curso" class="form-control " value="'.$curso.'" > 
                        </div> 
                    </div>


                  <div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Período</span>
                                <input type="text" disabled="" id="periodo" class="form-control " value="'.$periodo.'" > 
                        </div>
                        <div class="col-sm-6"> 
                        <span>Classe</span>
                             <input type="text" disabled="" id="classe" class="form-control " value="'.$classe.'"  > 
                        </div> 
                    </div>

                      <hr> <hr> <hr>  <br><br>

                      <input type="hidden"   name="reconfirmacao"   min="0"  class="form-control " value="0"   > 
                       <input type="hidden"   name="desconto"   min="0"  class="form-control " value="0"   > 
                       <input type="hidden"   name="valorpago"   min="0"  class="form-control " value="0"   > 
                       <input type="hidden"   name="formadepagamento"   min="0"  class="form-control " value="0"   > 
  
                 <div class="form-group">
                    <span>Desconto Padrão nas Propinas</span>
                         <input type="number"   name="descontoparapropinas"   min="0"  class="form-control " value="0" placeholder="Desconto no pagamento de propinas" > 
                    </div> 

                  <div class="form-group">
                         <span>Observações sobre o Cadastro</span>
                        <textarea name="obsreconfirmacao" rows="3" class="form-control " title="Alguma observação?" ></textarea>
                    </div>

                     <br>
                    <input type="submit" name="cadastrar"  value="Concluir O Cadastro" class="btn btn-success" style="float: rigth;">

                     </form>


                        <script>

                            var valorpago=document.getElementById("valorpago");
                            var preco=document.getElementById("preco");
                            var desconto=document.getElementById("desconto");
                            var erro=document.getElementById("erro");
 

                           desconto.addEventListener("input", function(){

                                    var desconto=this.value; 
                                   valorpago.value=parseInt(preco.value-desconto);

                                   erro.innerHTML="";  
           
                          })

                            preco.addEventListener("input", function(){

                                
                                   valorpago.value=parseInt(preco.value-desconto.value);

                                   erro.innerHTML="";  
           
                          })


                           valorpago.addEventListener("input", function(){
    
                                    var valorporpagar=parseInt(preco.value-desconto.value);
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