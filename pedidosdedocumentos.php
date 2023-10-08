<?php
include("conexao.php"); 


    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 $idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"";
    
 
$mesespecifico=isset($_GET['mesespecifico'])?$_GET['mesespecifico']:"";


 if(isset($_GET['mesespecifico'])){

    $total_cobrado_semdesconto=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(documentostratados.preco) from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and datadeentrada='$mesespecifico'"))[0];
 
      $total_em_desconto=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(documentostratados.desconto) from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and datadeentrada='$mesespecifico'"))[0];
     
      $total_em_valorpago=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(documentostratados.valorpago) from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and datadeentrada='$mesespecifico'"))[0];

      $total_em_divida=$total_cobrado_semdesconto-$total_em_desconto-$total_em_valorpago;


 }else{


    $total_cobrado_semdesconto=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(documentostratados.preco) from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo'"))[0];
 
      $total_em_desconto=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(documentostratados.desconto) from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo'"))[0];
     
      $total_em_valorpago=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(documentostratados.valorpago) from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo'"))[0];

      $total_em_divida=$total_cobrado_semdesconto-$total_em_desconto-$total_em_valorpago;



 }



  $total_cobrado_semdesconto=number_format($total_cobrado_semdesconto,2,",", ".");  
  $total_em_desconto=number_format($total_em_desconto,2,",", "."); 
  $total_em_valorpago=number_format($total_em_valorpago,2,",", "."); 
  $total_em_divida=number_format($total_em_divida,2,",", "."); 


 
$nomedoanolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where   idanolectivo='$idanolectivo'"))[0];

$nomedomes=str_replace('-01', '', $mesespecifico);
$nomedomes=str_replace('-', '/', $nomedomes);

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Pedidos de Documentos do ano lectivo <a href="anolectivo.php?idanolectivo=<?php echo "$idanolectivo"; ?>"><?php echo "$nomedoanolectivo"; ?></a> <?php if(isset($_GET['mesespecifico'])){ echo "($nomedomes)"; }?> </h1>
          
            <div class="alert alert-info">

             <h3>Total Valor Pago : <strong><?php echo "$total_em_valorpago"; ?> KZ</strong></h3>  <br>

             <h4>Total cobrado: <strong><?php echo "$total_cobrado_semdesconto"; ?> KZ</strong></h4> 
            
             <h4>Total de desconto :<strong><?php echo "$total_em_desconto"; ?> KZ</strong></h4> 
             <h4>Total Valor Pago : <strong><?php echo "$total_em_valorpago"; ?> KZ</strong></h4> 
             <h4>Total em Dívida : <strong><?php echo "$total_em_divida"; ?> KZ</strong></h4> 
            
           </div>

     
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


                    
          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-success">  <i class="fas fa-fw fa-calendar"></i> Escolher um Mês específico</button>

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="get" action=""> 
                <h3>Escolhendo um mês</h3> <br>
                    
                         <div class="col-sm-12"> 
                                <span>Mês Específico</span>
                                  <select name="mesespecifico" required  class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT distinct(datadeentrada), YEAR(documentostratados.datadeentrada) as ano, MONTH(documentostratados.datadeentrada) as mes from documentostratados, matriculaseconfirmacoes where  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo' order by datadeentrada desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option value="<?php echo $exibir["datadeentrada"]; ?>"><?php echo $exibir["ano"]; ?>/<?php echo $exibir["mes"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                        </div> 
                    <br>

                       <input type="hidden" name="idanolectivo" value="<?php echo $idanolectivo; ?>">
                       <input type="submit" name="verrelatorio" value="Ver Relatório do mês escolhido" class="btn btn-success" style="float: rigth;">
                    
          </form>
        </div>
    </div>


    

  <button id="myBtnreclamacoes" class="btn btn-primary" title="Cadastrar uma saida">Escolher outro ano lectivo</button>  <br> 

    


    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="get">
                      <br>
                     
                    <span>Escolha outro Ano Lectivo</span>
                    <div class="form-group">
                    <select name="idanolectivo" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                          <br>
                            <input type="submit" value="Ver" name="mudaranolectivo" class="btn btn-success" style="float: rigth;">
            

          </form>
        </div>
    </div>
 



    <script>
                   var btn=document.getElementById("myBtn");
                    var btnreclamacoes=document.getElementById("myBtnreclamacoes");
                  

                    var modal=document.getElementById("myModal");
                    var modalreclamacoes=document.getElementById("myModalreclamacoes");
                    

                    var span=document.getElementById("close");
                    var spanreclamacoes=document.getElementById("closereclamacoes");
                    

                

                  
                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }
 

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }

                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })

                                                  
      
                                                  
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })

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
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Nome Completo</th> 
                      <th>Turma</th> 
                      <th>Tipo de Documento</th>
                      <th>Preço</th> 
                      <th>Desconto</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th>  
                      <th>Deu-se Entrada</th> 
                      <th title="(Já se levantou?)">Levantamento</th>  
                      <th>Ver Mais</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      


                         if(isset($_GET['mesespecifico'])){

                             $lista=mysqli_query($conexao, "SELECT alunos.nomecompleto,  matriculaseconfirmacoes.*, documentostratados.preco as precododocumento, documentostratados.desconto as descontododocumento, documentostratados.valorpago as valorpagododocumento, documentostratados.* from matriculaseconfirmacoes, documentostratados, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and datadeentrada='$mesespecifico'");
 
                               }else{

                              $lista=mysqli_query($conexao, "SELECT alunos.nomecompleto,  matriculaseconfirmacoes.*, documentostratados.preco as precododocumento, documentostratados.desconto as descontododocumento, documentostratados.valorpago as valorpagododocumento, documentostratados.* from matriculaseconfirmacoes, documentostratados, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and  documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and documentostratados.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao");
                                

                               }

                         while($exibir = $lista->fetch_array()){

 

                  $divida_n=round(($exibir['precododocumento']-$exibir['valorpagododocumento']-$exibir['descontododocumento']),2);

                  $iddocumentotratado=$exibir["iddocumentotratado"];
                  
                 
                   $identrada=mysqli_fetch_array(mysqli_query($conexao,"SELECT  identrada  FROM entradas where idtipo='$iddocumentotratado' and tipo='Tratar Documento'"))[0]; 
 
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 

                     
                      <td><a href="turma.php?idturma=<?php echo $exibir['idturma']; ?>"><?php echo $exibir['turma']; ?></a></td>  
                      <td><?php echo $exibir['tipodedocumento']; ?></td>
                      <td  title="<?php  $preco=number_format($exibir["precododocumento"],2,",", "."); echo $precododocumento; ?>"><?php echo $exibir['precododocumento']; ?></td> 
                      <td title="<?php  $desconto=number_format($exibir["desconto"],2,",", "."); echo $desconto; ?>"><?php echo $exibir['desconto']; ?></td>
                      <td  title="<?php  $valorpago=number_format($exibir["valorpago"],2,",", "."); echo $valorpago; ?>"><?php echo $exibir['valorpago']; ?></td>
                      <td title="<?php  $divida=number_format($divida_n,2,",", "."); echo $divida; ?>"><?php echo $divida_n; ?></td> 
                      <td><?php echo $exibir['datadeentrada']; ?></td>
                      <td><?php echo $exibir['datadolevantamento']; ?> (<?php echo $exibir['jalevantado']; ?>)</td>

                      <td align="center" title="Veja mais opções sobre esse curso">
                         <a  href="detalhestratardocumentos.php?identrada=<?php echo $identrada; ?>"><i  class="fas fa-eye" ></i> </a>
                      </td>
 
                    </tr> 
                    <?php } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 
      <script>


                                                        $(document).on("blur", ".update", function(){
                                                                var id=$(this).data("id");
                                                                var nomedacoluna=$(this).data("column");
                                                                var valor=$(this).text();
                                                                 

                                                                $.ajax({
                                                                    url:'cadastro/updateagenda.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id, 
                                                                        nomedacoluna:nomedacoluna,
                                                                         valor:valor
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                                    }

                                                                })
                                                            })


                                                            $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esssa actividade?")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deleteagenda.php',
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



      </script>
      
   
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