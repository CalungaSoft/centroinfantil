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

$idsaida=isset($_POST['id'])?$_POST['id']:"";
$idsaida=mysqli_escape_string($conexao, $idsaida); 
                 
                     $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM saidas where idsaida='$idsaida' "));

                     $divida=$dados_do_pagamento["divida"];
                     $valorpago=$dados_do_pagamento["valor"];
                     $datadasaida=$dados_do_pagamento["datadasaida"];
                     $descricao=$dados_do_pagamento["descricao"];
                     $formadesaida=$dados_do_pagamento["formadesaida"];
                     $idtipo=$dados_do_pagamento["idtipo"];
                     $idanolectivo=$dados_do_pagamento["idanolectivo"];
                                        

    $html='
    
    
    <form class="user" action="" method="post">  

          <h3>Editar Dados da Saída</h3> <br>
             <div class="form-group">
                 <span>Descrição</span>
                <input type="text" name="descricao" autocomplete="on" class="form-control" title="Digite a Descrição" placeholder="Descrição" value="'.$descricao.'">
                </div>
  

 					          <div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Valor de Saída</span>
 
                                <input type="number"  step="any"  min="0" name="valor"   class="form-control " placeholder="Valor de Saída" value="'.$valorpago.'">  
                        </div>
                        <div class="col-sm-6"> 
                        <span>Dívida?</span>
                             <input type="number" step="any" min="0"  name="divida" id="divida" min="0"  class="form-control " placeholder="Dívida" value="'.$divida.'"> 
                        </div>  
                    </div>

                     <div class="form-group row">
                        <div class="col-sm-6"> 
                           <span>Categoria</span>
                                  <select name="idtipo" required  class="form-control" title="Categoria de Saída"  > 
                                  <option disabled="">Categoria de Saída</option>
                                 ';
                                      $tipodesaidas=mysqli_query($conexao, "select * from tipodesaidas"); 
                                      while($exibir = $tipodesaidas->fetch_array()){ 
                                        $html.='
                                      <option '; if($idtipo==$exibir["idtipodesaida"]){$html.=' selected=""'; } $html.=' value="'.$exibir["idtipodesaida"].'">'.$exibir["tipo"].'</option>
                                    ';}

                                    $html.='
                                </select>  
                        </div>
                        <div class="col-sm-6"> 
                           <span>Forma de Saída</span>
                                  <select name="formadesaida" required  class="form-control" title="Forma de Saída"  > 
                                  <option disabled="">Formas de Saída</option>
                                 ';
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                        $html.='
                                      <option '; if($formadesaida==$exibir["formadepagamento"]){$html.=' selected=""'; } $html.=' value="'.$exibir["formadepagamento"].'">'.$exibir["formadepagamento"].'</option>
                                    ';}

                                    $html.='
                                </select> 
                        </div>  
                    </div>

                 
                <div class="form-group row">
                        <div class="col-sm-6"> 
                           <span>Ano Lectivo</span>
                                  <select name="idanolectivo" required  class="form-control" title="Ano Lectivo"  > 
                                  <option disabled="">Ano Lectivo</option>
                                 ';
                                      $anoslectivos=mysqli_query($conexao, "select * from anoslectivos"); 
                                      while($exibir = $anoslectivos->fetch_array()){ 
                                        $html.='
                                      <option '; if($idanolectivo==$exibir["idanolectivo"]){$html.=' selected=""'; } $html.=' value="'.$exibir["idanolectivo"].'">'.$exibir["titulo"].'</option>
                                    ';}

                                    $html.='
                                </select> 
                        </div>
                        <div class="col-sm-6"> 
                         <span>Data</span>
                          <input type="text" name="datadasaida" autocomplete="on" class="form-control" title="Digite data" placeholder="Data da saida" value="'.$datadasaida.'">
                        </div>  
                    </div>

                     
 
 
                     <input type="hidden" name="idsaida"    value='.$idsaida.'>
          

   <br>
                    <input type="submit" name="editaralteracoes"  value="Guardar Alterações" class="btn btn-success" style="float: rigth;">



                     </form>

 

                          
        '; 


echo $html;

}




?>