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

$identrada=isset($_POST['id'])?$_POST['id']:"";
$identrada=mysqli_escape_string($conexao, $identrada); 
 
 $tipo=isset($_POST['tipo'])?$_POST['tipo']:"";
$tipo=mysqli_escape_string($conexao, $tipo); 
                    
                     $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $divida=$dados_do_pagamento["divida"];
                     $valorpago=$dados_do_pagamento["valor"];
                     $datadaentrada=$dados_do_pagamento["datadaentrada"];
                     $descricao=$dados_do_pagamento["descricao"];
                     $formadepagamento=$dados_do_pagamento["formadepagamento"];
                                        

    $html='
    
    
    <form class="user" action="" method="post">  

             <div class="form-group">
                 <span>Descrição</span>
                <input type="text" name="descricao" autocomplete="on" class="form-control" title="Digite a Descrição" placeholder="Descrição" value="'.$descricao.'">
                </div>
  

 					<div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Valor Pago</span>
 
                                <input type="number"  step="any"  min="0" name="valor" id="valoraaterar" class="form-control " placeholder="Valor Pago" value="'.$valorpago.'">  
                        </div>
                        <div class="col-sm-6"> 
                        <span>Dívida?</span>
                             <input type="number" step="any" min="0"  name="divida" id="divida" min="0"  class="form-control " placeholder="Dívida" value="'.$divida.'"> 
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
                                      <option '; if($formadepagamento==$exibir["formadepagamento"]){$html.=' selected=""'; } $html.=' value="'.$exibir["formadepagamento"].'">'.$exibir["formadepagamento"].'</option>
                                    ';}

                                    $html.='
                                </select> 
                    </div>

                     <div class="form-group">
                 <span>Data</span>
                <input type="text" name="datadaentrada" autocomplete="on" class="form-control" title="Digite data" placeholder="Data da Entrada" value="'.$datadaentrada.'">
                </div>
 
 
                     <input type="hidden" name="identrada"    value='.$identrada.'>
          

   <br>
                    <input type="submit" name="editaralteracoes"  value="Guardar Alterações" class="btn btn-success" style="float: rigth;">



                     </form>

 

                          
        '; 


echo $html;

}




?>