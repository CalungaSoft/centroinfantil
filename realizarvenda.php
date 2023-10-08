<?php 
 
include("conexao.php");


    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

 
$idcaixa=isset($_SESSION['idcaixa']);
$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

 

$idaluno=$_GET['idaluno'];   
 
if(isset($_POST['cancelarvenda'])){
   
$reservarvaga=mysqli_fetch_array(mysqli_query($conexao, "select idcompra from compras where idaluno='$idaluno' and obs='em fase de cadastramento' limit 1"))[0]; 
  
 
$listadeprodutos=mysqli_query($conexao,"SELECT *  FROM `compra`  where  iddacompra='$reservarvaga'");


while($exibir = $listadeprodutos->fetch_array()){

  $quantidade=$exibir["quantidade"];
  $idproduto=$exibir["idproduto"];

  $actualizando=mysqli_query($conexao, "UPDATE `produtos` SET `quantidade` = `quantidade`+'$quantidade' WHERE idproduto = '$idproduto'");
  $deletando=mysqli_query($conexao,"DELETE FROM `compra` where idproduto='$idproduto'");
  
}

$deletando=mysqli_query($conexao,"DELETE FROM `compras` where idcompra='$reservarvaga'");
 
}


if(isset($_POST['cadastrarvenda'])){
  
    $obs=$_POST['obs']; 
 
  $dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM alunos where idaluno='$idaluno'"));
  $nomedoaluno=$dadosdoaluno["nomedoaluno"]; 

  $factura=mysqli_fetch_array(mysqli_query($conexao, "select factura from entradas order by factura desc limit 1"))[0]+1;
 
  $reservarvaga=mysqli_fetch_array(mysqli_query($conexao, "select idcompra from compras where idaluno='$idaluno' and obs='em fase de cadastramento' limit 1"))[0]; 
  if($reservarvaga==""){
      $guardar=mysqli_query($conexao,"INSERT INTO `compras` (`idaluno`,`obs`) VALUES ('$idaluno', 'em fase de cadastramento')");
      $reservarvaga= mysqli_fetch_array(mysqli_query($conexao, "select idcompra from compras where idaluno='$idaluno' and obs='em fase de cadastramento' limit 1"))[0]; 
  }

 
$listadeprodutos=mysqli_query($conexao,"SELECT compra.*, produtos.nomedoproduto FROM `compra`, produtos where  compra.iddacompra='$reservarvaga' and compra.idproduto=produtos.idproduto");
$produtoscomprados="";

$cont=1;
$totalvalorproduto=0;
$totalpago=0;
  while($exibir = $listadeprodutos->fetch_array()){ 
    $totalvalorproduto+=$exibir["preco"]*$exibir["quantidade"];
    $totalpago+=$exibir["valorpago"];
    if($cont==1){
      $produtoscomprados.="$exibir[nomedoproduto]";
    }else{
      $produtoscomprados.=", $exibir[nomedoproduto]";
    }
    $cont++;
}
 
  $guardar=mysqli_query($conexao,"UPDATE `compras` SET `obs` = '$obs'  WHERE idcompra ='$reservarvaga'");
  $guardar=mysqli_query($conexao,"UPDATE `alunos` SET `ultimacompra` = CURRENT_TIMESTAMP  WHERE idaluno ='$idaluno'");

  $descricao="Venda para o aluno($nomedoaluno)| $produtoscomprados";
  $idfuncionario=$idlogado;

  $valordeentrada=$totalpago;  
  $divida=$totalvalorproduto-$valordeentrada;

   
  $guardar=mysqli_query($conexao,"INSERT INTO `entradas` (`idfuncionario`, `descricao`, `factura`, `valor`, `divida`, `idcompra`, `idaluno`) VALUES ('$idfuncionario', '$descricao', '$factura','$valordeentrada', '$divida', '$reservarvaga', '$idaluno')");
  header("location:index.php");
}



include("cabecalho.php") ; ?>


                              <?php
                                      $dadosdoaluno=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM alunos where idaluno='$idaluno' "));
                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Realizar venda</h1>
     
                               


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
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="aluno.php?idaluno=<?php echo $dadosdoaluno["idaluno"] ; ?>"><?php echo $dadosdoaluno["nomecompleto"] ; ?></a></div>
                                                <p id="mostra"> 

                                                <br> 	Morada:  <?php echo $dadosdoaluno["morada"]; ?> <br>
                                                  	Data de Cadastros:  <?php echo $dadosdoaluno["datadecadastro"]; ?> <br>
                                                 	Estatus:  <?php echo $dadosdoaluno["estatus"]; ?> <br>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Histórico</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          $valoragregado=mysqli_fetch_array(mysqli_query($conexao, "select sum(valor) FROM entradas where  entradas.idaluno='$idaluno'"))[0]+0; 
                                          $valoremdivida=mysqli_fetch_array(mysqli_query($conexao, "select sum(divida) FROM entradas where entradas.idaluno='$idaluno'"))[0]+0; 
                                          $numerodecompras=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM compras where idaluno='$idaluno'")); 

                                          $valoragregado=number_format($valoragregado,2,",", ".");
                                          $valoremdivida=number_format($valoremdivida,2,",", ".");

                                               $ultimacompra=mysqli_fetch_array(mysqli_query($conexao, "select data FROM compras where idaluno='$idaluno' order by data desc limit 1"))[0]; 

                                      ?>
 
                                             	Dívida:  <?php echo $valoremdivida; ?> KZ<br>
                                             	Nº de compras:  <?php echo $numerodecompras; ?> <br> 
                                             	Última compra:  <?php echo $ultimacompra; ?> <br>
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



                

 
            <!-- Collapsable Card Example -->


            <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Produtos Sendo Comprados</h6>
                </div>
                <div class="card-body"> 
                  
                   
                    <p>Descreva no campo abaixo os produtos a serem comprados
                   <span style="font-size: 10px">Separe cada produto por uma virgula</span></p>
                   <div class="form-group">
                      <input type="text" autocomplete="off" list="datalist1" id="produto" class="form-control "  title="Digite os produtos a serem comprados" placeholder="Produtos a serem comprados">
                      <datalist id="datalist1">
                        <?php
                             $listadeprodutos=mysqli_query($conexao, "select * from produtos where quantidade > 0 order by nomedoproduto asc "); 
                          while($exibir = $listadeprodutos->fetch_array()){ ?>
                          <option  value="<?php echo $exibir['nomedoproduto'];?>"> 
                        <?php } ?>  
                      </datalist>
 
                      <input type="hidden" style="width: 230px" step="any" min="0" max="100" id="percentagem" class="form-control" title="Digite aqui a percentagem a ser paga pelo paciente" value="100">
                   

                      <span id="listadeprodutos"> 
                      <table class="table table-bordered" id="tabelinha" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                              <th>Produto</th>
                             <th>Preço</th> 
                             <th>Qtd.</th>  
                             <th>Sub-Total</th>
                             <th>Desconto</th> 
                             <th>Total</th> 
                             <th>Pago</th> 
                             <th>Entregue</th> 
                             <th>Opção</th>
                            </tr>
                          </thead>
                          <tbody> 
                        </tbody>
                     </table> 
                     </span>
                    </div>  
                    <span id="mostrarototaltt"></span>
                   
                   <p id="erronome"></p>
                   <p id="erroquantidade"></p>
                   <p id="errodesconto"></p>
                   <p id="erropago"></p>

                   <p id="errodequantidade"></p>
                    <hr><hr><br><br>

                    <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Fazer o Pagamento</button>  
    <div id="myModal" class="modal">
        <div class="modal-content">
          <span id="close">&times;</span>
          <form action="" method="post">
          <br> <h1>Finalização da Venda</h1>
                    <div class="form-group">
                       <input type="text" id="obs" class="form-control" title="Podes fazer aqui qualquer observação que deseja" placeholder="Observações">
                    </div> 
                     
                      
                       
                        
                        
                     <div class="form-group row">
                        <div class="col-sm-6">
                        Valor Pago: <h1 id="valorapagar">0KZ</h1>
                        </div> 

                        <div class="col-sm-6">
                        Valor Não Consolidado: <h1 id="dividaapagar" title="Pode ser um valor que o aluno pagou amais, ou um valor que o aluno ficou devendo">0KZ</h1>
                        </div> 
                    </div>
               <div class="form-group">
                <span>Forma de Pagamento</span>
                      <select id="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                      <option disabled="">Formas de Pagamentos</option>
                      <?php
                          $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                          while($exibir = $formasdepagamento->fetch_array()){ ?>
                          <option value="<?php echo $exibir['formadepagamento']; ?>"><?php echo $exibir['formadepagamento']; ?> </option>
                        <?php } ?> 
                    </select> 
       
                    </div> 



                <span>Essa compra é para qual Matrícula?</span>
                          <select id="idmatriculaeconfirmacao"  class="form-control" title="Escolha aqui a Matrícula relacionada a essa venda" required="" >  
                          <?php
                              $matricula=mysqli_query($conexao, "select classe, curso, idmatriculaeconfirmacao   from matriculaseconfirmacoes where idaluno='$idaluno' order by idmatriculaeconfirmacao desc"); 

                              while($exibir = $matricula->fetch_array()){ ?>
                              <option value="<?php echo $exibir['idmatriculaeconfirmacao']; ?>"><?php echo $exibir['classe']; ?>  | <?php echo $exibir['curso']; ?></option>
                            <?php } ?> 
                        </select> 

                        <br>

                     <div class="form-group row">
                        <div class="col-sm-6">
                        <input type="number"name="valoramao" id="valoramao" class="form-control" title="Valor que o aluno está entregando, para que o computador faça o troco" placeholder="Valor Entregue a Mão">
                        </div> 
                        <div class="col-sm-6">
                        <input type="submit" value="Ver Troco" id="vertroco" class="btn btn-primary">
                        </div> 
                        
                    </div>
                    <h2 id="troco"></h2>

                          <br>
                          <span id="cadastro"></span>
                   <div class="form-group row">
               
                 
                        <div class="col-sm-12">
                            <input type="submit" value="Finalizar Venda" id="comfactura" class="btn btn-success">
                        </div> 
                    </div>
                       
            

          </form>
        </div>
    </div>
 
 
                 
                  <script>
                    var btn=document.getElementById("myBtn");
                    var modal=document.getElementById("myModal");

                    var span=document.getElementById("close");

                  
                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
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
 
 

<br> <br>

                      <!-- Collapsable Card Example -->
                      <hr><hr>
                      </div>
                </div>
              </div>


            <script>
                var produto=document.getElementById("produto")
                var listademateriais=document.getElementById("listademateriais") 
                var total=0; 
                var contador=1; 
                var totalfeicho=0;
         
                produto.addEventListener("keyup", function(event){
                  var tecla=event.key;
                    

                  if(tecla==","){
                    
                    var textodigitado= document.getElementById("produto").value;
                    textodigitado=textodigitado.replace(",", "")
                    $.ajax({
                                  url:"cadastro/pesquisaporproduto.php",
                                  method:"POST",
                                  data: {
                                    tipodeproduto: textodigitado
                                    
                                },
                                  success:function(data){ 
                                  $("#mostrarototaltt").html(data); 
                                  produto.value=""
                                  var html='';
                                    
                                    html+='<tr id="linha'+contador+'">'
                                    html+='<td class="nomedoproduto" id="nome'+contador+'">' 
                                    html+=textodigitado
                                    html+='</td>'
                                    html+='<td class="preco" data-row="'+contador+'" contenteditable id="preco'+contador+'">' 
                                    html+=v 
                                   var qt=0;
                                    html+='</td><td contenteditable class="quantidade" data-row="'+contador+'" id="quantidade'+contador+'" ></td>'
                                    html+='<td class="subtotal" id="subtotal'+contador+'"></td>'
                                    html+='<td class="desconto" contenteditable id="desconto'+contador+'" data-row="'+contador+'">0</td>'
                                    html+='<td class="total" id="total'+contador+'">0</td>'
                                    html+='<td contenteditable class="pago" id="pago'+contador+'" data-row="'+contador+'"></td>'
                                    html+='<td contenteditable class="entregue" id="entregue'+contador+'" data-row="'+contador+'"></td>'
                                    html+='<td><a data-row="linha'+contador+'" href="" class="remover"><i title="Remover" style="color:red" class="fas fa-trash" ></i></a></td>'
                                    html+='</tr>'
                                    
                                    $("#tabelinha").append(html)
                                  
                                     contador++;
                                     
                                     if(contador==2){
                                      var html2='';
                                        
                                        html2+='<tfoot><tr style="background-color:rgba(0, 0, 0, 0.16);"  id="linha'+contador+'">'
                                        html2+='<td><strong>Total</strong></td>'
                                        html2+='<td id="totalpreco"></td>'
                                        html2+='<td></td>'
                                        html2+='<td id="totalsubtotal"></td>'
                                        html2+='<td id="totaldesconto"></td>'
                                        html2+='<td id="totaltotal">0</td>'
                                        html2+='<td id="totalpago"></td>'
                                        html2+='<td></td>'
                                        html2+='<td id="divida"></td>'
                                        html2+='</tr></tfoot>'
                                        
                                        $("#tabelinha").append(html2)
                                      
                                     }
                                  }
                                })
                                
                                                      var nomes=[];
                                                    $('.nomedoproduto').each(function() {
                                                     nomes.push($(this).text());
                                                       })

                                                    $.ajax({
                                                      url:"cadastro/verificarnome.php",
                                                      method:"POST",
                                                      data:{nomes:nomes},
                                                      success:function(data){
                                                          $("#erronome").html(data)
                                                           
                                                      }
                                                    })
                               
                  }

                             
                    
                })
                                
                                    
                             
                    
                                      
 
                                      


                                      // multiplicar o preco pela quantidade
                                      $(document).on("input",  ".quantidade", function(){
                                        var id=$(this).data("row")

                                        var nome= $("#nome"+id+"").text();

                                        var preco= $("#preco"+id+"").text();
                                             
                                        var quantidade= $("#quantidade"+id+"").text();
                                        var entregue= $("#entregue"+id+"").text();

                                        var subtotal=preco*quantidade;
                                         
                                         $("#subtotal"+id+"").text(subtotal);
                                         $("#entregue"+id+"").text(quantidade);

                                        var desconto= $("#desconto"+id+"").text();
                                       

                                        var total=(preco*quantidade)-desconto;
                                         $("#total"+id+"").text(total);

                                          percentagem=$("#percentagem").val();

                                          pagamento=((total*percentagem)/100);
                                      
                                         $("#pago"+id+"").text(pagamento);
                                    

                                      
                                        
                                                var totalsubtotal=0;
                                                var totaldesconto=0;
                                                var totaltotal=0;
                                                var totalpago=0;


 

                                                  $('.subtotal').each(function() {
                                                    totalsubtotal+=Number($(this).text());
                                                    $("#totalsubtotal").text(totalsubtotal);
                                                  })

                                                  $('.desconto').each(function() {
                                                    totaldesconto+=Number($(this).text());
                                                    $("#totaldesconto").text(totaldesconto);
                                                  })

                                                  $('.total').each(function() {
                                                    totaltotal+=Number($(this).text());
                                                    $("#totaltotal").text(totaltotal);
                                                  })

                                                  $('.pago').each(function() {
                                                    totalpago+=Number($(this).text());
                                                    $("#totalpago").text(totalpago);
                                                    
                                                  })
                                                  $("#valorapagar").text(totalpago+"KZ");
                                                   totalfeicho=totalpago;



                                                  $.ajax({
                                                          url:"cadastro/verificarquantidade.php",
                                                          method:"POST",
                                                          data: {
                                                            nomedoproduto: nome,
                                                            quantidade:quantidade
                                                            
                                                        },
                                                          success:function(data){  

                                                            $("#erroquantidade").html(data)
                                                           
                                                          }
                                                        })


                                                var divida=totaltotal-totalpago;

                                                  if(divida>0){
                                                       $("#divida").text("Dívida:"+divida+"KZ");
                                                       $("#dividaapagar").text("Dívida:"+divida+"KZ");
                                                    }else if(divida==0){
                                                      $("#divida").text(" ");
                                                    }else if(divida<0){
                                                      divida=divida*(-1)
                                                      $("#divida").text("Pagou:"+divida+"KZ amais"); 
                                                      $("#dividaapagar").text("Pagou:"+divida+"KZ amais"); 
                                                    }

                                                  })
                                          
                                        
                                  
                                          
                                      


                                      // multiplicar o preco pela quantidade
                                      $(document).on("input",  ".preco", function(){
                                        var id=$(this).data("row")

                                        var nome= $("#nome"+id+"").text();

                                        var preco= $("#preco"+id+"").text();
                                             
                                        var quantidade= $("#quantidade"+id+"").text();
                                        var entregue= $("#entregue"+id+"").text();

                                        var subtotal=preco*quantidade;
                                         
                                         $("#subtotal"+id+"").text(subtotal);
                                         $("#entregue"+id+"").text(quantidade);

                                        var desconto= $("#desconto"+id+"").text();
                                       

                                        var total=(preco*quantidade)-desconto;
                                         $("#total"+id+"").text(total);
                                           percentagem=$("#percentagem").val();

                                          pagamento=((total*percentagem)/100);
                                         
                                         $("#pago"+id+"").text(pagamento);
                                    

                                    

                                      
                                        
                                                var totalsubtotal=0;
                                                var totaldesconto=0;
                                                var totaltotal=0;
                                                var totalpago=0;


 

                                                  $('.subtotal').each(function() {
                                                    totalsubtotal+=Number($(this).text());
                                                    $("#totalsubtotal").text(totalsubtotal);
                                                  })

                                                  $('.desconto').each(function() {
                                                    totaldesconto+=Number($(this).text());
                                                    $("#totaldesconto").text(totaldesconto);
                                                  })

                                                  $('.total').each(function() {
                                                    totaltotal+=Number($(this).text());
                                                    $("#totaltotal").text(totaltotal);
                                                  })

                                                  $('.pago').each(function() {
                                                    totalpago+=Number($(this).text());
                                                    $("#totalpago").text(totalpago);
                                                    
                                                  })
                                                  $("#valorapagar").text(totalpago+"KZ");
                                                   totalfeicho=totalpago;



                                                  $.ajax({
                                                          url:"cadastro/verificarquantidade.php",
                                                          method:"POST",
                                                          data: {
                                                            nomedoproduto: nome,
                                                            quantidade:quantidade
                                                            
                                                        },
                                                          success:function(data){  

                                                            $("#erroquantidade").html(data)
                                                           
                                                          }
                                                        })


                                                var divida=totaltotal-totalpago;

                                                  if(divida>0){
                                                       $("#divida").text("Dívida:"+divida+"KZ");
                                                       $("#dividaapagar").text("Dívida:"+divida+"KZ");
                                                    }else if(divida==0){
                                                      $("#divida").text(" ");
                                                    }else if(divida<0){
                                                      divida=divida*(-1)
                                                      $("#divida").text("Pagou:"+divida+"KZ amais"); 
                                                      $("#dividaapagar").text("Pagou:"+divida+"KZ amais"); 
                                                    }

                                                  })
                                          
                                        
                                  
                                          
                                      
  // multiplicar o preco pela quantidade
                                      $(document).on("input",  ".quantidade", function(){
                                        var id=$(this).data("row")

                                        var nome= $("#nome"+id+"").text();

                                        var preco= $("#preco"+id+"").text();
                                             
                                        var quantidade= $("#quantidade"+id+"").text();
                                        var entregue= $("#entregue"+id+"").text();

                                        var subtotal=preco*quantidade;
                                         
                                         $("#subtotal"+id+"").text(subtotal);
                                         $("#entregue"+id+"").text(quantidade);

                                        var desconto= $("#desconto"+id+"").text();
                                       

                                        var total=(preco*quantidade)-desconto;
                                         $("#total"+id+"").text(total);
                                           percentagem=$("#percentagem").val();

                                          pagamento=((total*percentagem)/100);
                                         
                                         $("#pago"+id+"").text(pagamento);
                                    

                                    

                                      
                                        
                                                var totalsubtotal=0;
                                                var totaldesconto=0;
                                                var totaltotal=0;
                                                var totalpago=0;


 

                                                  $('.subtotal').each(function() {
                                                    totalsubtotal+=Number($(this).text());
                                                    $("#totalsubtotal").text(totalsubtotal);
                                                  })

                                                  $('.desconto').each(function() {
                                                    totaldesconto+=Number($(this).text());
                                                    $("#totaldesconto").text(totaldesconto);
                                                  })

                                                  $('.total').each(function() {
                                                    totaltotal+=Number($(this).text());
                                                    $("#totaltotal").text(totaltotal);
                                                  })

                                                  $('.pago').each(function() {
                                                    totalpago+=Number($(this).text());
                                                    $("#totalpago").text(totalpago);
                                                    
                                                  })
                                                  $("#valorapagar").text(totalpago+"KZ");
                                                   totalfeicho=totalpago;



                                                  $.ajax({
                                                          url:"cadastro/verificarquantidade.php",
                                                          method:"POST",
                                                          data: {
                                                            nomedoproduto: nome,
                                                            quantidade:quantidade
                                                            
                                                        },
                                                          success:function(data){  

                                                            $("#erroquantidade").html(data)
                                                           
                                                          }
                                                        })


                                                var divida=totaltotal-totalpago;

                                                  if(divida>0){
                                                       $("#divida").text("Dívida:"+divida+"KZ");
                                                       $("#dividaapagar").text("Dívida:"+divida+"KZ");
                                                    }else if(divida==0){
                                                      $("#divida").text(" ");
                                                    }else if(divida<0){
                                                      divida=divida*(-1)
                                                      $("#divida").text("Pagou:"+divida+"KZ amais"); 
                                                      $("#dividaapagar").text("Pagou:"+divida+"KZ amais"); 
                                                    }

                                                  })
                                          
                                        
                                  
                                          
                                      





                                      // multiplicar o preco pela entregue
                                      $(document).on("input",  ".entregue", function(){
                                        var id=$(this).data("row")
                                        var nome= $("#nome"+id+"").text();
 

                                        var quantidade= $("#quantidade"+id+"").text();
                                        var entregue= $("#entregue"+id+"").text();

                                          if(Number(entregue)>Number(quantidade)){
                                            var erro='<div class="alert alert-danger">A quantidade de '+nome+' que está sendo entregue é maior que o quantidade comprada pelo aluno</div>';
                                            $("#errodequantidade").html(erro);
                                             
                                          }else{

                                            var erro='';
                                            $("#errodequantidade").html(erro);

                                          }

                                                  })
                                          
                                        
                                  
                                          
                                      


                                          $(document).on("input",  ".desconto", function(){
                                                 var id=$(this).data("row")
                                                 var nome= $("#nome"+id+"").text();

                                                var preco= $("#preco"+id+"").text();
                                                var quantidade= $("#quantidade"+id+"").text();

                                                var subtotal=preco*quantidade;
                                                $("#subtotal"+id+"").text(subtotal);

                                                var desconto= $("#desconto"+id+"").text();

                                                var total=(preco*quantidade)-desconto;
                                                $("#total"+id+"").text(total);
                                                

                                                percentagem=$("#percentagem").val();

                                                pagamento=((total*percentagem)/100);
                                            
                                               $("#pago"+id+"").text(pagamento);
                                    


 
                                                var totalsubtotal=0;
                                                var totaldesconto=0;
                                                var totaltotal=0;
                                                var totalpago=0;

                                                console.log(desconto, subtotal)
                                                if(Number(desconto)>Number(subtotal)){
                                                  $("#errodesconto").html("<div class='alert alert-danger'>A quantidade descontada no "+nome+" é maior do que o valor a se pagar</div>")
                                                }else{
                                                  $("#errodesconto").html("")
                                                }
                                              

                                                  $('.subtotal').each(function() {
                                                    totalsubtotal+=Number($(this).text());
                                                    $("#totalsubtotal").text(totalsubtotal);
                                                  })

                                                  $('.desconto').each(function() {
                                                    totaldesconto+=Number($(this).text());
                                                    $("#totaldesconto").text(totaldesconto);
                                                  })

                                                  $('.total').each(function() {
                                                    totaltotal+=Number($(this).text());
                                                    $("#totaltotal").text(totaltotal);
                                                  })

                                                  $('.pago').each(function() {
                                                    totalpago+=Number($(this).text());
                                                   $("#totalpago").text(totalpago);
                                                    
                                                  })
                                                  $("#valorapagar").text(totalpago+"KZ");
                                                   totalfeicho=totalpago;

                                                    
                                                    var divida=totaltotal-totalpago;

                                                    if(divida>0){
                                                       $("#divida").text("Dívida:"+divida+"KZ");
                                                       $("#dividaapagar").text("Dívida:"+divida+"KZ");
                                                    }else if(divida==0){
                                                      $("#divida").text(" ");
                                                    }else if(divida<0){
                                                      divida=divida*(-1)
                                                      $("#divida").text("Pagou:"+divida+"KZ amais"); 
                                                      $("#dividaapagar").text("Pagou:"+divida+"KZ amais"); 
                                                    }

                                                  })

                                        
                                      
  

                                          $(document).on("input",  ".pago", function(){
                                                 var id=$(this).data("row")

                                                var preco= $("#preco"+id+"").text();
                                                var quantidade= $("#quantidade"+id+"").text();

                                                var subtotal=preco*quantidade;
                                                $("#subtotal"+id+"").text(subtotal);

                                                var desconto= $("#desconto"+id+"").text();

                                                var total=(preco*quantidade)-desconto;
                                                $("#total"+id+"").text(total); 



                                        
                                                var totalsubtotal=0;
                                                var totaldesconto=0;
                                                var totaltotal=0;
                                                var totalpago=0;



                                                

                                                  $('.subtotal').each(function() {
                                                    totalsubtotal+=Number($(this).text());
                                                    $("#totalsubtotal").text(totalsubtotal);
                                                  })

                                                  $('.desconto').each(function() {
                                                    totaldesconto+=Number($(this).text());
                                                    $("#totaldesconto").text(totaldesconto);
                                                  })

                                                  $('.total').each(function() {
                                                    totaltotal+=Number($(this).text());
                                                    $("#totaltotal").text(totaltotal);
                                                  })

                                                  $('.pago').each(function() {
                                                    totalpago+=Number($(this).text());
                                                   $("#totalpago").text(totalpago);
                                                    
                                                  })
                                                  $("#valorapagar").text(totalpago+"KZ");
                                                   totalfeicho=totalpago;


                                                  var divida=totaltotal-totalpago;

                                                  if(divida>0){
                                                       $("#divida").text("Dívida:"+divida+"KZ");
                                                       $("#dividaapagar").text("Dívida:"+divida+"KZ");
                                                    }else if(divida==0){
                                                      $("#divida").text(" ");
                                                    }else if(divida<0){
                                                      divida=divida*(-1)
                                                      $("#divida").text("Pagou:"+divida+"KZ amais"); 
                                                      $("#dividaapagar").text("Pagou:"+divida+"KZ amais"); 
                                                    }

                                                  })
                                      

                                           
                                          $(document).on("click",  ".remover", function(event){
                                            event.preventDefault();
                                            var linhapradeletar=$(this).data("row")  
                                            
                                             $("#"+linhapradeletar).remove();
                                         
                                         
                                        
                                             var totalsubtotal=0;
                                                var totaldesconto=0;
                                                var totaltotal=0;
                                                var totalpago=0;



                                                

                                                  $('.subtotal').each(function() {
                                                    totalsubtotal+=Number($(this).text());
                                                    $("#totalsubtotal").text(totalsubtotal);
                                                  })

                                                  $('.desconto').each(function() {
                                                    totaldesconto+=Number($(this).text());
                                                    $("#totaldesconto").text(totaldesconto);
                                                  })

                                                  $('.total').each(function() {
                                                    totaltotal+=Number($(this).text());
                                                    $("#totaltotal").text(totaltotal);
                                                  })

                                                  $('.pago').each(function() {
                                                    totalpago+=Number($(this).text());
                                                   $("#totalpago").text(totalpago);
                                                    
                                                  })
                                                  $("#valorapagar").text(totalpago+"KZ");
                                                   totalfeicho=totalpago;


                                                  var divida=totaltotal-totalpago;
                                                  
                                                  if(divida>0){
                                                       $("#divida").text("Dívida:"+divida+"KZ");
                                                       $("#dividaapagar").text("Dívida:"+divida+"KZ");
                                                    }else if(divida==0){
                                                      $("#divida").text(" ");
                                                    }else if(divida<0){
                                                      divida=divida*(-1)
                                                      $("#divida").text("Pagou:"+divida+"KZ amais"); 
                                                      $("#dividaapagar").text("Pagou:"+divida+"KZ amais"); 
                                                    }



                                                    var nomes=[];
                                                    $('.nomedoproduto').each(function() {
                                                      nomes.push($(this).text());
                                                       })

                                                    $.ajax({
                                                      url:"cadastro/verificarnome.php",
                                                      method:"POST",
                                                      data:{nomes:nomes},
                                                      success:function(data){
                                                          $("#erronome").html(data)
                                                           
                                                      }
                                                    })
                                                  
                                                       
                                          })


                                          $(document).on("click",  "#vertroco", function(event){
                                            event.preventDefault();
                                              
                                            var valoremmao=$("#valoramao").val();
                                             var troco=valoremmao-totalfeicho;
                                             if(troco<0){
                                              troco=troco*(-1);
                                              $("#troco").text("Está faltando:"+troco+"KZ");
                                             }else if(troco==0){
                                              $("#troco").text("Não Há troco");
                                             }else{
                                              $("#troco").text("Troco de:"+troco+"KZ");
                                             
                                             }

                                          })


                                          $(document).on("click",  "#semfactura", function(event){
                                            event.preventDefault();
                                              
                                            var obs=$("#obs").val();
                                              
                                            $("#comfactura").remove();
                                             var formadepagamento=$("#formadepagamento option:selected").val();
                                            
                                                var nome=[];
                                                var preco=[];
                                                var quantidade=[];
                                                var desconto=[];
                                                var pago=[]; 
                                                var entregue=[];

                                                var idaluno=<?php echo $idaluno; ?>;



                                                    
                                                    $('.nomedoproduto').each(function() {
                                                      nome.push($(this).text());
                                                       })
 
                                                    $('.desconto').each(function() {
                                                      desconto.push($(this).text());
                                                    })

                                                    $('.preco').each(function() {
                                                      preco.push($(this).text());
                                                    })

                                                    $('.quantidade').each(function() {
                                                      quantidade.push($(this).text());
                                                    })
 
                                                    $('.pago').each(function() {
                                                      pago.push($(this).text());
                                                    })

                                                    $('.entregue').each(function() {
                                                      entregue.push($(this).text());
                                                    })
 

                                                    $.ajax({
                                                      url:"cadastro/cadastrarvenda.php",
                                                      method:"POST",
                                                      data:{formadepagamento, obs, nome, desconto, preco, quantidade,pago, entregue, idaluno},
                                                      success:function(data){
                                                          $("#cadastro").html(data)
                                                           
                                                      }
                                                    })

                                          })


                                          $(document).on("click",  "#comfactura", function(event){
                                            event.preventDefault();
                                              
                                            var obs=$("#obs").val();
                                              
                                            $("#comfactura").remove();
                                            var formadepagamento=$("#formadepagamento option:selected").val();
                                            var idmatriculaeconfirmacao=$("#idmatriculaeconfirmacao option:selected").val();
                                            
                                            

                                                var nome=[];
                                                var preco=[];
                                                var quantidade=[];
                                                var desconto=[];
                                                var entregue=[];
                                                var pago=[]; 

                                                var idaluno=<?php echo $idaluno; ?>;



                                                    
                                                    $('.nomedoproduto').each(function() {
                                                      nome.push($(this).text());
                                                       })
 
                                                    $('.desconto').each(function() {
                                                      desconto.push($(this).text());
                                                    })

                                                    $('.preco').each(function() {
                                                      preco.push($(this).text());
                                                    })

                                                    $('.quantidade').each(function() {
                                                      quantidade.push($(this).text());
                                                    })
 
                                                    $('.pago').each(function() {
                                                      pago.push($(this).text());
                                                    })

                                                    $('.entregue').each(function() {
                                                      entregue.push($(this).text());
                                                    })
 

                                                    $.ajax({
                                                      url:"cadastro/cadastrarvendafactura.php",
                                                      method:"POST",
                                                      data:{formadepagamento, obs, nome, desconto, preco, quantidade,pago,entregue, idaluno, idmatriculaeconfirmacao},
                                                      success:function(data){
                                                          $("#cadastro").html(data)
                                                           
                                                      }
                                                    })

                                          })



                                     

                                          
                         

              </script>
            

        
            </div>

          </div>
          </div>
         <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2021</span>
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
