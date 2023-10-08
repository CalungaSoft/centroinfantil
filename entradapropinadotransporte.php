<?php 
include("conexao.php");

//problemas com limitar pagamentos novos
//divida em pagamentos individuais
    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif; 

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

$identrada=isset($_GET['identrada'])?$_GET['identrada']:"0";
$identrada=mysqli_escape_string($conexao, $identrada); 

 if(!isset($_GET['identrada'])){

$idpropinadotransporte=isset($_GET['idpropinadotransporte'])?$_GET['idpropinadotransporte']:"";
$idpropinadotransporte=mysqli_escape_string($conexao, $idpropinadotransporte); 

$identrada=mysqli_fetch_array(mysqli_query($conexao," SELECT identrada FROM entradas where tipo='Mensalidade do transporte' and idtipo='$idpropinadotransporte'"))[0];
 }


$dados_da_entrada=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $tipo=$dados_da_entrada['tipo'];
                     $idtipo=$dados_da_entrada['idtipo'];
                     $idaluno=$dados_da_entrada['idaluno'];


          
          $idanolectivo=$dados_da_entrada['idanolectivo']; 
                    
$dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM alunos where idaluno='$idaluno'"));

$nomedoaluno=$dadosdoaluno['nomecompleto'];

$divida_total=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(divida) as divida FROM entradas where tipo='$tipo' and idtipo='$idtipo'"))[0];


if(isset($_POST['cadastrar'])){

    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']));   
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']) );    
 
          $divida_antigo=$divida_total;
      
          $nova_divida=round(($divida_antigo-$valor),2);
          
           
          if($nova_divida<0){
              $nova_divida=0;
          }



           
          $idanolectivo=$dados_da_entrada['idanolectivo']; 


           $zerando_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='0' WHERE tipo='$tipo' and idtipo='$idtipo'");

             if($zerando_dividas){


                $salvar_financas=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idfuncionario`, `descricao`, `tipo`, `idtipo`, `valor`, `divida`, `idaluno`, `idturma`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL, '$idlogado', '$descricao', '$tipo','$idtipo', '$valor', '$nova_divida', '$idaluno', '0', CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");
                      
                      if($salvar_financas){

                        $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT  sum(valor) as totalpago FROM entradas where tipo='$tipo' and idtipo='$idtipo'"));

                          $totalpago=$dados_do_pagamento['totalpago'];
                        
                          $actualizandopagamentos=mysqli_query($conexao,"UPDATE `propinasdotransporte` SET `valorpago` = '$totalpago' WHERE `propinasdotransporte`.`idpropinadotransporte` = '$idtipo'");

                          if($actualizandopagamentos){


                             $acerto[]="Pagamento feito com sucesso";


                          }else{

                            $erros[]="Ocorreu algum erro";

                        
                          }
                          



                      }else{

                        $erros[]="Ocorreu um erro Ao fazer o pagamento,Tente Novamente";

                      }



             }else{

               $erros[]="Ocorreu um erro Ao fazer o pagamento, ao zerrar as dívidas";
             }

                     
   
  }


if(isset($_POST['editaralteracoes'])){

    $identrada=mysqli_escape_string($conexao, trim($_POST['identrada']) );  
    $valor=mysqli_escape_string($conexao, trim($_POST['valor']) );   
    $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']) );  
    $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']) );  
    $datadaentrada=mysqli_escape_string($conexao, trim($_POST['datadaentrada']) );  

    
                     $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));

                     $divida_antigo=$dados_do_pagamento['divida'];
                     $valorpago_antigo=$dados_do_pagamento['valor'];
                     $datadaentrada_antigo=$dados_do_pagamento['datadaentrada'];
                     $descricao_antigo=$dados_do_pagamento['descricao'];
                     $formadepagamento_antigo=$dados_do_pagamento['formadepagamento'];
                                        

                    


                     
                $antigo="($descricao_antigo) | Pago: $valorpago_antigo | F. Pag: $formadepagamento_antigo | $datadaentrada_antigo";
                $novo="($descricao) | Pago: $valor  | F. Pag: $formadepagamento | $datadaentrada <a href=entradapropinadotransporte.php?identrada=$identrada>Clique para ver</a>";
                
                $guardar2=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");
            
            if($guardar2){

               $actualizando=mysqli_query($conexao, "UPDATE `entradas` SET `datadaentrada` = '$datadaentrada', `descricao` = '$descricao', `valor` = '$valor', `formadepagamento` = '$formadepagamento' WHERE identrada = '$identrada'");
        
                  $zerando_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='0' WHERE tipo='$tipo' and idtipo='$idtipo'");
                  
                   $preco=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(preco-desconto+multa) as preco FROM propinasdotransporte where idpropinadotransporte='$idtipo' "))['preco'];

                   $valorpago=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valorpago FROM entradas where  tipo='$tipo' and idtipo='$idtipo' "))['valorpago'];

                   $divida_nova=round(($preco-$valorpago),2);

                   $insirindo_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='$divida_nova' WHERE tipo='$tipo' and idtipo='$idtipo' order by identrada desc limit 1");

                   $actualizando_nasmatriculas=mysqli_query($conexao,"UPDATE `propinasdotransporte` SET  `valorpago` ='$valorpago' WHERE   idpropinadotransporte='$idtipo' limit 1");

 
                if($actualizando_nasmatriculas){

                      

                    $acerto[]="Alterações feitas com sucesso!";
                
                }else{
                
                $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente | $tipo";
                
                } 

            }else{

                $erros[]="Ocorreu um erro Ao fazer as alterações, por favor, tente novamente | Histórico";
                

            }
   
  }








if(isset($_POST['editarpreco'])){

    $preco=mysqli_escape_string($conexao, trim($_POST['preco']));  
    $desconto=mysqli_escape_string($conexao, trim($_POST['desconto']));   
    $multa=mysqli_escape_string($conexao, trim($_POST['multa']));   
     
     $valorpago=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valorpago FROM entradas where  tipo='$tipo' and idtipo='$idtipo' "))['valorpago'];

          
      
          $nova_divida=round(($preco+$multa-$desconto-$valorpago),2);
          
           
          if($nova_divida<0){
              $nova_divida=0;
          }

   
                          $insirindo_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='$nova_divida' WHERE tipo='$tipo' and idtipo='$idtipo' order by identrada desc limit 1");


                          if($insirindo_dividas){


                                $actualizandopagamentos=mysqli_query($conexao,"UPDATE `propinasdotransporte` SET `preco` = '$preco', `desconto` = '$desconto', `multa` = '$multa' WHERE `propinasdotransporte`.`idpropinadotransporte` = '$idtipo'");


                                    if ($actualizandopagamentos) {



                                            $acerto[]="Alterações feitas com sucesso";

                                       
                                    }else{


                                      $erros[]="Ocorreu algum erro | Actualizando nas $tipo";




                                    }





                          }else{

                            $erros[]="Ocorreu algum erro | Actualizando nas finaças";

                        
                          }
                          

 
   
  }




$divida_total=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(divida) as divida FROM entradas where tipo='$tipo' and idtipo='$idtipo'"))[0];


        include("cabecalho.php") ; ?>

<?php
                                 
                                      $dados_do_pagamento=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$identrada' "));
                                      
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Detalhes de Pagamento da Propina do transporte| <a href="aluno.php?idaluno=<?php echo "$idaluno";?>"><?php echo "$nomedoaluno";?></a> </h1>

                <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>
              <?php 
            if(!empty($acerto)):
                        foreach($acerto as $acerto):
                          echo '<div class="alert alert-success">'.$acerto.'</div>';
                        endforeach;
                      endif;
            ?>

              
 
  <button id="myBtnreclamacoes" class="btn btn-info" title="Registrar Um Pagamento na data de hoje"><i  class="fas fa-money"></i>  Fazer um pagamento Novo</button>  

    
    | <a class='btn btn-success' href='pdf/recibopagamento.php?identrada=<?php echo "$dados_da_entrada[identrada]";?>'> Imprimir Recibo Geral</a>


 
<br><br>



          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do aluno</h6>
                  <div class="dropdown no-arrow">
                     
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">


                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">aluno</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"] ; ?>"><?php echo $dadosdoaluno["nomecompleto"] ; ?></a></div> <br>

                                            Sexo: <strong> <?php echo $dadosdoaluno["sexo"]; ?> </strong> <br>

                                            Nome do Pai: <strong> <?php echo $dadosdoaluno["nomedopai"]; ?> </strong> <br>

                                            Nome da Mãe: <strong> <?php echo $dadosdoaluno["nomedamae"]; ?> </strong> <br>

                                            Data de Nascimento: <strong> <?php echo $dadosdoaluno["datadenascimento"]; ?> </strong>  <br><br>
  
                                          
 <?php
                                           $idanolectivo=$dados_da_entrada["idanolectivo"];
 
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo'")); ?>
                                        
 Ano Lectivo
                                          <h3><strong> <?php echo $anolectivo["titulo"]; ?> </strong></h3>


                                         
                                              

                                          
 



                                                </div>
 
                                    </div>
                                    </div> 
                                </div>
                                </div>
                            </div>
                            </div>
   
                                                      
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Propina Paga</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1">  <br> <?php


                                                 $propina_paga=mysqli_fetch_array(mysqli_query($conexao,"SELECT YEAR(mespago) as ano, MONTH(mespago) as mes, propinasdotransporte.* from propinasdotransporte where idpropinadotransporte='$idtipo'"));

                                             $codigodepropina=$propina_paga["codigodepropina"];

                                             $preco=number_format($propina_paga["preco"],2,",", ".");
                                             $desconto=number_format($propina_paga["desconto"],2,",", ".");

                                              $multa=number_format($propina_paga["multa"],2,",", ".");
                                             $valorpago=number_format($propina_paga["valorpago"],2,",", ".");

                                              $totalcobrado=number_format($propina_paga["preco"]-$propina_paga["desconto"]+$propina_paga["multa"],2,",", ".");
                     
                                             $divida=number_format($propina_paga["preco"]+$propina_paga["multa"]-$propina_paga["desconto"]-$propina_paga["valorpago"],2,",", ".");
                     
                                            ?> 
 

                                                     <h3>   <?php if($propina_paga["mes"]<10){echo "0";}?><?php echo $propina_paga["mes"]; ?>/<?php echo $propina_paga["ano"]; ?> </h3> | Código: <strong> <?php echo $codigodepropina; ?> </strong> <br> <br> | Referência do Bolderom: <strong> <?php echo $propina_paga["referencia"]; ?> </strong> <br> | Data de Depósito: <strong> <?php echo $propina_paga["datadedeposito"]; ?> </strong> <br> <br>

                                                   Preço:<strong>   <?php echo $preco; ?> </strong> | 

                                                  Desconto:<strong>  <?php echo $desconto; ?> </strong>| 

                                                  Multa:<strong>  <?php echo $multa; ?> </strong><br> 

                                                 Total:<strong>   <?php echo $totalcobrado; ?> </strong><br> <br>

                                                  Valor Pago:<strong>  <?php echo $valorpago; ?> </strong> |

                                                  Dívida:<strong>   <?php echo $divida; ?> </strong><br>   


                                               <!-- Collapsable Card Example -->
                                              <div class="card shadow mb-6">
                                              <!-- Card Header - Accordion -->
                                              <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Editar Preço, Desconto e/ou Multa</h6>
                                              </a>
                                              <!-- Card Content - Collapse -->
                                              <div class="collapse in" id="collapseCardExample">
                                                <div class="card-body">
                                                <form action="" method="post">
 
                                                      
                                                      <div class="form-group">
                                                          <label>Preço</label>
                                                        <input type="number" min='0' name="preco" class="form-control  "  value="<?php echo $propina_paga["preco"] ; ?>">
                                                      </div> 

                                                      <div class="form-group">
                                                          <label>Desconto</label>
                                                        <input type="number" min='0' name="desconto" class="form-control  "  value="<?php echo $propina_paga["desconto"]; ?>">
                                                      </div> 



                                                      <div class="form-group">
                                                          <label>Multa</label>
                                                        <input type="number" min='0' name="multa" class="form-control  "  value="<?php echo $propina_paga["multa"]; ?>">
                                                      </div> 

                                                      
                                                      
                                                      <div class="form-group">
                                                          <input type="submit" name="editarpreco" value="Guardar Novas Informações" class="btn btn-success">
                                                      </div> 
                                  
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- Collapsable Card Example -->




                                          
                                        </div>


                            
                                        </div>
                                        </div> 



                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>



                 
      </div>
      <!-- End of Main Content -->



    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="POST">
          <h2>Fazendo novo pagamento</h2>
                      <br>

                       <div class="form-group">
                 <span>Descrição</span>
                <input type="text" name="descricao" autocomplete="on" class="form-control" title="Digite a Descrição" placeholder="Descrição" required="">
                </div>
  
 
  
                <div class="form-group row">
                        <div class="col-sm-6"> 
                          <span>Valor A acrescentar</span>

                             <input type="number" step="any" min="0"  max="<?php echo $divida_total; ?>" name="valor" autocomplete="on" class="form-control" title="Digite o valor a acrescentar" placeholder="Valor a acrescentar" required="">
  
                        </div>
                        <div class="col-sm-6"> 
                        <span>Dívida</span>
                             <input type="number" disabled="" step="any" min="0"  name="divida" id="divida" min="0"  class="form-control " placeholder="Dívida" value="<?php echo $divida_total; ?>"> 
 
                        </div>  
                    </div>
                     
                     <div class="form-group"> 
                      <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                 <?php
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                     ?>
                                      <option  value="<?php echo $exibir["formadepagamento"]; ?>"><?php echo $exibir["formadepagamento"]; ?></option>

                                     <?php } ?>
                                </select> 
                    </div>

              

                          <br>
                            <input type="submit" value="Concluir Pagamento" name="cadastrar" class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 

    


    <script>
                     var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                     var modalreclamacoes=document.getElementById("myModalreclamacoes");
                     var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                   
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })


                    btnreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="block";
                                                  })
              
                    spanreclamacoes.addEventListener("click", ()=>{
                      modalreclamacoes.style.display="none";
                                                  })
                
                    

                  </script>

                  <br> <br>
          <div class="col-lg">
         
      
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Histórico de Pagamentos</h6>
            </div>
            <div class="card-body">
           

  <span id="mensagemdealerta"></span> 
          
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Funcionário</th>
                      <th>Descrição</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Data</th> 
                      <th title="Forma de Pagamento">F. de Pag.</th> 
                      <th>Editar</th>  
                      <th>Eliminar</th>  
                    </tr>
                  </thead> 
                  <tbody>
                  
                     <?php
                     
                       

                          $registrosdeentrada=mysqli_query($conexao, "select funcionarios.nomedofuncionario, entradas.* from funcionarios, entradas where funcionarios.idfuncionario=entradas.idfuncionario and tipo='$tipo' and idtipo='$idtipo' order by datadaentrada desc"); 
 
                       

                      $totalentradas=0;
                      $totademdivida=0;
                      $primeiroid=mysqli_fetch_array(mysqli_query($conexao," SELECT identrada FROM entradas where idtipo='$idtipo' and tipo='$tipo' order by identrada asc limit 1"))[0];

                      while($exibir = $registrosdeentrada->fetch_array()){
                            
                          $totalentradas+=$exibir["valor"];
                          $totademdivida+=$exibir["divida"];
                        
                      
                     
                     ?>
                      
                    <tr>
                    <td> <a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?> </a></td>
                    <td ><?php echo $exibir["descricao"]; ?></td> 
                     
                      <td ><?php   $n=number_format($exibir["valor"],2,",", "."); echo $n; ?></td>
                      <td><?php   $n=number_format($exibir["divida"],2,",", "."); echo $n; ?></td>
                      <td><?php echo $exibir["datadaentrada"]; ?></td> 
                      <td><?php echo $exibir["formadepagamento"]; ?></td>  
                      <td><a href="" class="btn btn-info mudavalor" data-column="Aumentar" data-id="<?php echo $exibir["identrada"]; ?>" ><i style="color:white" title="Mudar dados nesse registro" class="fas fa-edit"></i></a></td>  

                       <td>

                      <?php if($exibir["identrada"]!=$primeiroid){?> 

                       <a href="" class="btn btn-danger delete" data-column="Aumentar" data-id="<?php echo $exibir["identrada"]; ?>" ><i style="color:white" title="Eliminar esse registro específico" class="fas fa-trash"></i></a>

                        <?php  } ?>

                        </td>  
                         
                         

 
                    

                    </tr> 
                    </tr>
                    <?php  } 

                     $totalentradas=number_format($totalentradas,2,",", ".");
                     $totademdivida=number_format($totademdivida,2,",", ".");


                    ?>
                    </tbody>
                    <tfoot>
                      <th>Total</th>
                      <th></th>
                      <th><?php echo $totalentradas; ?></th>
                      <th><?php echo $totademdivida; ?></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tfoot>
                 
                </table>
          
              </div>
            </div>
          </div>
 
            </div>
          </div>
   


                <a href="" class="btn btn-danger deletevenda" id="<?php echo $identrada; ?>" ><i style="color:white" title="Eliminar todos os dados dessa venda, incluíndo a própria venda" class="fas fa-trash"></i>ELIMINAR Todos registros financeiros dessa <?php echo "$tipo"; ?></a>


  <?php  include("estilocarde.php"); ?>
   
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <div id="formularioresposta"></div>
        </div>
    </div>
    
      <script>
                    var btn=document.getElementsByClassName("mudavalor");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                    $(document).on("click",  ".mudavalor", function(event){
                              event.preventDefault(); 
                              
                              modal.style.display="block"; 
                              var id=$(this).data('id')
                              var tipo=$(this).data("column");
                             
                               
                                            $.ajax({
                              url:'cadastro/alterarvalordamatricula.php',
                              method:'POST',
                              data: {
                                id, tipo 
                            },
                              success:function(data){ 
                                $('#formularioresposta').html(data);  
                              }
                            })

         
                            })
                            
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }

                  </script>

            <script>
             

                                                            $(document).on("click", ".deletevenda", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados financeiros relacionados com esse registro!")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deletevendapropinatransporte.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })
 




                     $(document).on("click", ".delete", function(event){
                                event.preventDefault(); 

                                var id=$(this).data("id");

                              
                                if(confirm("Tens certeza que queres eliminar esse registro? Isso não apagará a dívida, pelo contrário só a acrescentará, isso em detrimento do valor pago apagado!")){
                                    $(this).closest('tr').remove(); 
                                    $.ajax({
                                    url:'cadastro/deleteentradapropinatransporte.php',
                                    method:'POST',
                                    data:{ 
                                        id
                                    },
                                    success: function(data){
                                        $("#mensagemdealerta").html(data);
                          
                                    }

                                })
                                }
                               
                            })

            
            </script>
        
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2022</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
