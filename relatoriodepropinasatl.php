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
    
if(!($painellogado=="administrador" || $painellogado=="secretaria1" || $painellogado=="secretaria2")){ 

    header('Location: login.php');
}

 
$mesespecifico=isset($_GET['mesespecifico'])?$_GET['mesespecifico']:"";


 if(isset($_GET['mesespecifico'])){

  
      $total_cobrado_semmulta=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(preco) from propinasdoatl where idanolectivo='$idanolectivo' and mespago='$mesespecifico'"))[0];

      $total_em_multa=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(multa) from propinasdoatl where idanolectivo='$idanolectivo' and mespago='$mesespecifico'"))[0];

      $total_cobrado_commulta=$total_em_multa+$total_cobrado_semmulta;

      $total_em_desconto=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(desconto) from propinasdoatl where idanolectivo='$idanolectivo' and mespago='$mesespecifico'"))[0];
      $total_em_valorpago=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from propinasdoatl where idanolectivo='$idanolectivo' and mespago='$mesespecifico'"))[0];
      $total_em_divida=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(preco+multa-desconto-valorpago) from propinasdoatl where idanolectivo='$idanolectivo' and mespago='$mesespecifico'"))[0];

 }else{


    $total_cobrado_semmulta=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(preco) from propinasdoatl where idanolectivo='$idanolectivo'"))[0];

      $total_em_multa=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(multa) from propinasdoatl where idanolectivo='$idanolectivo'"))[0];

      $total_cobrado_commulta=$total_em_multa+$total_cobrado_semmulta;

      $total_em_desconto=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(desconto) from propinasdoatl where idanolectivo='$idanolectivo'"))[0];
      $total_em_valorpago=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(valorpago) from propinasdoatl where idanolectivo='$idanolectivo'"))[0];
      $total_em_divida=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(preco+multa-desconto-valorpago) from propinasdoatl where idanolectivo='$idanolectivo'"))[0];



 }



  $total_cobrado_semmulta=number_format($total_cobrado_semmulta,2,",", "."); 
  $total_cobrado_commulta=number_format($total_cobrado_commulta,2,",", "."); 
  $total_em_multa=number_format($total_em_multa,2,",", "."); 
  $total_em_desconto=number_format($total_em_desconto,2,",", "."); 
  $total_em_valorpago=number_format($total_em_valorpago,2,",", "."); 
  $total_em_divida=number_format($total_em_divida,2,",", "."); 


 
$nomedoanolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

$nomedomes=str_replace('-01', '', $mesespecifico);
$nomedomes=str_replace('-', '/', $nomedomes);

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Relatório de Propinas do ATL do ano lectivo <a href="anolectivo.php?idanolectivo=<?php echo "$idanolectivo"; ?>"><?php echo "$nomedoanolectivo"; ?></a> <?php if(isset($_GET['mesespecifico'])){ echo "($nomedomes)"; }?> </h1>
          
            <div class="alert alert-info">

             <h3>Total Valor Pago : <strong><?php echo "$total_em_valorpago"; ?> KZ</strong></h3>  <br>

             <h4>Total cobrado sem multa : <strong><?php echo "$total_cobrado_semmulta"; ?> KZ</strong></h4> 
             <h4>Total em Multa : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo "$total_em_multa"; ?> KZ</strong></h4> 
             <h4>Total cobrado com multa : <strong><?php echo "$total_cobrado_commulta"; ?> KZ</strong></h4> 
             <h4>Total de desconto : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo "$total_em_desconto"; ?> KZ</strong></h4> 
             <h4>Total Valor Pago : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo "$total_em_valorpago"; ?> KZ</strong></h4> 
             <h4>Total em Dívida : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo "$total_em_divida"; ?> KZ</strong></h4> 
            
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
                                         $lista=mysqli_query($conexao,"SELECT distinct(mespago), YEAR(propinasdoatl.mespago) as ano, MONTH(propinasdoatl.mespago) as mes from propinasdoatl where idanolectivo='$idanolectivo' order by mespago desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option value="<?php echo $exibir["mespago"]; ?>"><?php echo $exibir["ano"]; ?>/<?php echo $exibir["mes"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                        </div> 
                    <br>

                       <input type="hidden" name="idanolectivo" value="<?php echo $idanolectivo; ?>">
                       <input type="submit" name="verrelatorio" value="Ver Relatório do mês escolhido" class="btn btn-success" style="float: rigth;">
                    
          </form>
        </div>
    </div>


    

  <button id="myBtnreclamacoes" class="btn btn-primary" >Escolher outro ano lectivo</button>   
 

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
                      <th>ATL</th>  
                      <th>Preço</th>
                      <th>Multa</th> 
                      <th title="Desconto">Desc.</th> 
                      <th>Valor Pago</th> 
                      <th>Dívida</th> 
                      <th>Mês Pago</th> 
                      <th>Código</th> 
                      <th>Data</th> 
                      <th>Ver</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      


                         if(isset($_GET['mesespecifico'])){

                             $lista=mysqli_query($conexao, "SELECT alunos.nomecompleto,  YEAR(propinasdoatl.mespago) as ano, MONTH(propinasdoatl.mespago) as mes, matriculaatl.*, propinasdoatl.* from matriculaatl, propinasdoatl, alunos where matriculaatl.idaluno=alunos.idaluno and propinasdoatl.idanolectivo='$idanolectivo' and propinasdoatl.idmatriculaatl=matriculaatl.idmatriculaatl and mespago='$mesespecifico'");
 
                               }else{

                              $lista=mysqli_query($conexao, "SELECT alunos.nomecompleto,  YEAR(propinasdoatl.mespago) as ano, MONTH(propinasdoatl.mespago) as mes, matriculaatl.*, propinasdoatl.* from matriculaatl, propinasdoatl, alunos where matriculaatl.idaluno=alunos.idaluno and propinasdoatl.idanolectivo='$idanolectivo' and propinasdoatl.idmatriculaatl=matriculaatl.idmatriculaatl");
                                

                               }

                         while($exibir = $lista->fetch_array()){


                          $anoactual=date('Y');
                          $mespago=$exibir['mes'];
                     if($exibir['mes']==1){
                          $mespago="Janeiro";
                          if($exibir['ano']!=$anoactual){
                            $mespago="Janeiro/".$exibir['ano']."";
                          }
                     }else  if($exibir['mes']==2){
                        $mespago="Fevereiro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Fevereiro/".$exibir['ano']."";
                        }
                    }else  if($exibir['mes']==3){
                        $mespago="Março";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Março/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==4){
                        $mespago="Abril";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Abril/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==5){
                        $mespago="Maio";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Maio/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==6){
                        $mespago="Junho";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Junho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==7){
                        $mespago="Julho";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Julho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==8){
                        $mespago="Agosto";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Agosto/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==9){
                        $mespago="Setembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Setembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==10){
                        $mespago="Outubro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Outubro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==11){
                        $mespago="Novembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Novembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==12){
                        $mespago="Dezembro";
                        if($exibir['ano']!=$anoactual){
                            $mespago="Dezembro/".$exibir['ano']."";
                        }
                    } 



                  $divida_n=round(($exibir['preco']+$exibir['multa']-$exibir['valorpago']-$exibir['desconto']),2);
 
 

                  ?>
                    <tr>  
                      <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $exibir['nomecompleto']; ?> </a></td> 

                     
                      <td><?php echo $exibir['atl']; ?></td>  
                      <td  title="<?php  $preco=number_format($exibir["preco"],2,",", "."); echo $preco; ?>"><?php echo $exibir['preco']; ?></td>
                      <td title="<?php  $multa=number_format($exibir["multa"],2,",", "."); echo $multa; ?>"><?php echo $exibir['multa']; ?></td>
                      <td title="<?php  $desconto=number_format($exibir["desconto"],2,",", "."); echo $desconto; ?>"><?php echo $exibir['desconto']; ?></td>
                      <td  title="<?php  $valorpago=number_format($exibir["valorpago"],2,",", "."); echo $valorpago; ?>"><?php echo $exibir['valorpago']; ?></td>
                      <td title="<?php  $divida=number_format($divida_n,2,",", "."); echo $divida; ?>"><?php echo $divida_n; ?></td>
                      <td><?php echo $mespago; ?></td>
                      <td><?php echo $exibir['codigodepropina']; ?></td>
                      <td><?php echo $exibir['datadopagamento']; ?></td>
                      <td align="center" title="Veja mais opções sobre esse curso">
                         <a  href="entradapropinadoatl.php?idpropinadoatl=<?php echo $exibir["idpropinadoatl"]; ?>"><i  class="fas fa-eye" ></i> </a>
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