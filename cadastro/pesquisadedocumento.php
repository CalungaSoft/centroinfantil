<?php
 
 
include("../conexao.php");

$tipodedocumento=$_POST['tipodedocumento'];
$idmatriculaeconfirmacao=$_POST['idmatriculaeconfirmacao'];
$htm='';
$diadehoje=date("d/m/Y");

  $dadosda_reconfirmacao=mysqli_fetch_array(mysqli_query($conexao, "select * from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

                                  $idturma=$dadosda_reconfirmacao["idturma"];
                                  $idanolectivo=$dadosda_reconfirmacao["idanolectivo"];
                                  $classe=$dadosda_reconfirmacao["classe"];
                                  $idaluno=$dadosda_reconfirmacao["idaluno"];

  $eclassedeexame=mysqli_fetch_array(mysqli_query($conexao, "select eclassedeexame from turmas where idturma='$idturma' limit 1"))[0];

 
 if($tipodedocumento=="declaracaosemnotas"){
 
  $htm='

          <form action="" method="post">

                    <div class="form-group row">  
                         <div class="col-sm-6"> 
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " placeholder="Preço a Pagar" > 
                        </div> 
                        <div class="col-sm-6"> 
                          <span>Desconto</span>
                                <input type="number"  name="desconto" id="desconto"  min="0" class="form-control " placeholder="Desconto" > 
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" > 
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
 
                   <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" autocomplete="off" class="form-control js-datepicker" title="Digite data de Entrada" placeholder="Data da Entrada" value="'.$diadehoje.'">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" autocomplete="off" class="form-control js-datepicker" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="'.$diadehoje.'">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option>Não</option> 
                        <option>Sim</option>  
                        
                    </select> 
                    </div>

                     <br>
                    <input type="submit" name="tratardeclaracaosemnotas"  value="Fazer o Pagamento e imprimir a declaração" class="btn btn-success" style="float: rigth;">

                     </form>




  ';

    
 } 










 if($tipodedocumento=="declaracaocomnotas"){

  $htm='

          <form action="" method="post">

                    <div class="form-group row">  
                         <div class="col-sm-6"> 
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " placeholder="Preço a Pagar" > 
                        </div> 
                        <div class="col-sm-6"> 
                          <span>Desconto</span>
                                <input type="number"  name="desconto" id="desconto"  min="0" class="form-control " placeholder="Desconto" > 
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" > 
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
 

                   <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" autocomplete="off" class="form-control js-datepicker" title="Digite data de Entrada" placeholder="Data da Entrada" value="'.$diadehoje.'">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" autocomplete="off" class="form-control js-datepicker" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="'.$diadehoje.'">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option>Não</option> 
                        <option>Sim</option>  
                        
                    </select> 
                    </div>

                     
                     <br>
                    <input type="submit" name="tratardeclaracaocomnotas"  value="Fazer o Pagamento e imprimir a declaração" class="btn btn-success" style="float: rigth;">

                     </form>




  ';

    
 } 
















 if($tipodedocumento=="certificado"){





  if($eclassedeexame!="Sim"){

$htm='
    <div class="alert alert-danger">Essa Opção Está Disponível Apenas Para classe de Exame</div>
';
  }
  else{



  $htm='

          <form action="" method="post">

                  <div class="form-group">
                    <span>Tipo de Certificado</span>
                    <select name="tipodecertificado" disabled id="tipodecertificado"   class="form-control">
                        <option '; if($classe=='13ª'){ $htm.='selected'; } $htm.=' value="medio13">Ensino Médio (13ª)</option> 
                        <option '; if($classe=='12ª'){ $htm.='selected'; } $htm.=' value="medio12">Ensino Médio (12ª)</option> 
                        <option '; if($classe=='9ª'){ $htm.='selected'; } $htm.=' value="primeirociclo">Primeiro Ciclo</option>  
                        <option '; if($classe=='6ª'){ $htm.='selected'; } $htm.=' value="ensinoprimario">Ensino Primário</option> 
                        
                    </select> 
                    </div>


                    <span id="tipodedecertificado">
';

                      
  if($classe=="13ª"){



    $htm.='

         
          <div class="form-group">
           <span>Notas da 13ª</span>
           <select name="classequatro" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 13ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno' and matriculaseconfirmacoes.classe='13ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='13ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>


           <div class="form-group">
           <span>Notas da 12ª</span>
           <select name="classetres" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 12ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='12ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='12ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>




           <div class="form-group">
           <span>Notas da 11ª</span>
           <select name="classedois" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 11ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='11ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='11ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>



           <div class="form-group">
           <span>Notas da 10ª</span>
           <select name="classeum" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 10ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='10ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='10ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>
 
    ';
  }




           
  if($classe=="12ª"){



    $htm.='

          

  <input type="hidden" value="0" name="classequatro">

           <div class="form-group">
           <span>Notas da 12ª</span>
           <select name="classetres" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 12ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='12ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='12ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>




           <div class="form-group">
           <span>Notas da 11ª</span>
           <select name="classedois" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 11ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='11ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='11ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>



           <div class="form-group">
           <span>Notas da 10ª</span>
           <select name="classeum" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 10ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='10ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='10ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>
 
    ';
  }

















              
  if($classe=="9ª"){



    $htm.='
   <input type="hidden" value="0" name="classequatro">
           <div class="form-group">
           <span>Notas da 9ª</span>
           <select name="classetres" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 9ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='9ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='9ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>




           <div class="form-group">
           <span>Notas da 8ª</span>
           <select name="classedois" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 8ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='8ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='8ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>



           <div class="form-group">
           <span>Notas da 7ª</span>
           <select name="classeum" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 7ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='7ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='7ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>
 
    ';
  }
   







              
  if($classe=="6ª"){



    $htm.='
          
            <input type="hidden" value="0" name="classequatro">
           <div class="form-group">
           <span>Notas da 6ª</span>
           <select name="classetres" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 6ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='6ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='6ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>




           <div class="form-group">
           <span>Notas da 4ª</span>
           <select name="classedois" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 4ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='4ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='4ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>



           <div class="form-group">
           <span>Notas da 2ª</span>
           <select name="classeum" required  class="form-control" title="Escolha a Matrícula onde sairá as notas para 2ª classe"  >  
               ';
                    $matriculas=mysqli_query($conexao, "select anoslectivos.titulo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, anoslectivos where idaluno='$idaluno'  and matriculaseconfirmacoes.classe='2ª' and anoslectivos.idanolectivo=matriculaseconfirmacoes.idanolectivo"); 
                    while($exibir = $matriculas->fetch_array()){ 
                      $htm.='
                    <option  '; if($exibir["classe"]=='2ª'){ $htm.='selected'; } $htm.='  value="'.$exibir["idturma"].'">Ano Lectivo: '.$exibir["titulo"].' -- '.$exibir["classe"].' | '.$exibir["curso"].' | '.$exibir["data"].'</option>
                  ';}

                  $htm.='
              </select> 
          </div>
 
    ';
  }
   


$htm.='
 

                    </span> <br>

                
                    <div class="form-group row">  
                         <div class="col-sm-6"> 
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " placeholder="Preço a Pagar" > 
                        </div> 
                        <div class="col-sm-6"> 
                          <span>Desconto</span>
                                <input type="number"  name="desconto" id="desconto"  min="0" class="form-control " placeholder="Desconto" > 
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" > 
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
 

 
                   <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" autocomplete="off" class="form-control js-datepicker" title="Digite data de Entrada" placeholder="Data da Entrada" value="'.$diadehoje.'">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" autocomplete="off" class="form-control js-datepicker" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="'.$diadehoje.'">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option>Não</option> 
                        <option>Sim</option>  
                        
                    </select> 
                    </div>

                     <br>
                    <input type="submit" name="tratarcertificado"  value="Fazer o Pagamento e imprimir o certificado" class="btn btn-success" style="float: rigth;">

                     </form>




  ';

     } 
}











 if($tipodedocumento=="boletin"){

  $htm='

          <form action="" method="post">


               <div class="form-group">

                            <span>Trimestre</span>
                                  <select name="idtrimestre" required  class="form-control" title="Trimestre"  > 
                                  <option disabled="">Trimestre</option>
                                 ';
                                      $trimestres=mysqli_query($conexao, "select * from trimestres where idanolectivo='$idanolectivo'"); 
                                      while($exibir = $trimestres->fetch_array()){ 
                                        $htm.='
                                      <option  value="'.$exibir["idtrimestre"].'">'.$exibir["titulo"].'</option>
                                    ';}

                                    $htm.='
                                </select> 
       
                      
                        </div> 


                    <div class="form-group row">  
                         <div class="col-sm-6"> 
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " placeholder="Preço a Pagar" > 
                        </div> 
                        <div class="col-sm-6"> 
                          <span>Desconto</span>
                                <input type="number"  name="desconto" id="desconto"  min="0" class="form-control " placeholder="Desconto" > 
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" > 
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
 
                   <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" autocomplete="off" class="form-control js-datepicker" title="Digite data de Entrada" placeholder="Data da Entrada" value="'.$diadehoje.'">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" autocomplete="off" class="form-control js-datepicker" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="'.$diadehoje.'">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option>Não</option> 
                        <option>Sim</option>  
                        
                    </select> 
                    </div>

                     

                     <br>
                    <input type="submit" name="tratarboletin"  value="Fazer o Pagamento e imprimir o boletin" class="btn btn-success" style="float: rigth;">

                     </form>




  ';

    
 } 





















if($tipodedocumento=="guiadetransferencia"){

  $htm='

          <form action="" method="post">


               <div class="form-group">
                          

                          <input type="text"  name="escoladedestino" class="form-control " placeholder="Escola de Destino" required > 
                      
               </div> 


                    <div class="form-group row">  
                         <div class="col-sm-6"> 
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " placeholder="Preço a Pagar" > 
                        </div> 
                        <div class="col-sm-6"> 
                          <span>Desconto</span>
                                <input type="number"  name="desconto" id="desconto"  min="0" class="form-control " placeholder="Desconto" > 
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" > 
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
 
                   <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" autocomplete="off" class="form-control js-datepicker" title="Digite data de Entrada" placeholder="Data da Entrada" value="'.$diadehoje.'">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" autocomplete="off" class="form-control js-datepicker" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="'.$diadehoje.'">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option>Não</option> 
                        <option>Sim</option>  
                        
                    </select> 
                    </div>


                     <br>
                    <input type="submit" name="tratarguidetransferencia"  value="Fazer o Pagamento e imprimir Guia de Transferência" class="btn btn-success" style="float: rigth;">

                     </form>




  ';

    
 } 









if($tipodedocumento=="outros"){

  $htm='

          <form action="" method="post">


               <div class="form-group">
                          

                          <input type="text"  name="tipodedocumento" class="form-control " placeholder="Tipo de Documento" required > 
                      
               </div> 
 

                    <div class="form-group row">  
                         <div class="col-sm-6"> 
                          <span>Preço</span>
                                <input type="number"  name="preco" id="preco"  min="0" class="form-control " placeholder="Preço a Pagar" > 
                        </div> 
                        <div class="col-sm-6"> 
                          <span>Desconto</span>
                                <input type="number"  name="desconto" id="desconto"  min="0" class="form-control " placeholder="Desconto" > 
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6"> 
                        <span>Valor Pago</span>
                             <input type="number"  name="valorpago" id="valorpago" min="0"  class="form-control " placeholder="Valor pago" > 
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
 
                   <div class="form-group">
                      <span>Data da Entrada</span>
                          <input type="text" name="datadaentrada" autocomplete="off" class="form-control js-datepicker" title="Digite data de Entrada" placeholder="Data da Entrada" value="'.$diadehoje.'">
                      </div>

                      <div class="form-group">
                      <span>Data do Levantamento</span>
                          <input type="text" name="datadasaida" autocomplete="off" class="form-control js-datepicker" title="Digite data do Levantamento" placeholder="Data do Levantamento" value="'.$diadehoje.'">
                      </div>


                    <div class="form-group">
                    <span>Já recebeu o documento?</span>
                    <select name="jalevantou"   class="form-control">
                        <option>Não</option> 
                        <option>Sim</option>  
                        
                    </select> 
                    </div>


                     <br>
                    <input type="submit" name="trataroutrodocumento"  value="Finalizar o Pagamento" class="btn btn-success" style="float: rigth;">

                     </form>




  ';

    
 } 



 $htm.='
                        <script>

                            var valorpago=document.getElementById("valorpago");
                            var preco=document.getElementById("preco"); 
                            var desconto=document.getElementById("desconto"); 
                            var erro=document.getElementById("erro");
 
 
 


                         preco.addEventListener("input", function(){

                                
                                   valorpago.value=parseInt(preco.value-desconto.value);

                                   erro.innerHTML="";  
           
                          })


                          desconto.addEventListener("input", function(){

                                
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