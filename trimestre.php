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

 


$idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"";
    
$dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre' "));

$idanolectivo=$dadosdotrimestre["idanolectivo"];

if(isset($_POST['editardadosdotrimestre'])){

  $titulo=mysqli_escape_string($conexao, $_POST['titulo']);  
  $idanolectivo=mysqli_escape_string($conexao, $_POST['idanolectivo']); 
  $posicao=mysqli_escape_string($conexao, $_POST['posicao']); 
  $nomedamedia=mysqli_escape_string($conexao, $_POST['nomedamedia']); 
  $percentagemnoanolectivo=mysqli_escape_string($conexao, $_POST['percentagemnoanolectivo']); 
   
  if(mysqli_num_rows(mysqli_query($conexao," SELECT * FROM trimestres where titulo='$titulo' and idtrimestre!='$idtrimestre' and idanolectivo='$idanolectivo'"))==0){ 
 
    $salvar= mysqli_query($conexao,"UPDATE `trimestres` SET titulo='$titulo', idanolectivo='$idanolectivo', posicao='$posicao', nomedamedia='$nomedamedia', percentagemnoanolectivo='$percentagemnoanolectivo'  WHERE `trimestres`.`idtrimestre` = '$idtrimestre'");

    
    if($salvar){
      $acertos[]="Alterações salvas com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

   
  }else {
      $erros[]="Já Existe um Outro Trimestre com esse Nome";
   }


  }


   $anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM anoslectivos where idanolectivo='$idanolectivo' "));

$dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM trimestres where idtrimestre='$idtrimestre' "));

$idanolectivo=$dadosdotrimestre["idanolectivo"];


        include("cabecalho.php"); ?>

<?php
                                      
                                    
                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dados do Trimestre</h1>
     
          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

<?php 
            if(!empty($acertos)):
                        foreach($acertos as $acertos):
                          echo '<div class="alert alert-success">'.$acertos.'</div>';
                        endforeach;
                      endif;
            ?>
 

          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados do trimestre</h6>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Trimestre</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="trimestre.php?idtrimestre=<?php echo $dadosdotrimestre["idtrimestre"] ; ?>"><?php echo $dadosdotrimestre["titulo"] ; ?> Trimestre </a></div> <br>
                                                   Ano Lectivo: <strong><a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"><?php echo $anolectivo[0]; ?></a>  </strong><br>
                                                   Numero de Notas: <strong> <?php echo $dadosdotrimestre["posicao"]; ?> </strong><br>
                                                   Nome da Média: <strong> <?php echo $dadosdotrimestre["nomedamedia"]; ?> (   <?php if($dadosdotrimestre["arredondarmedia"]=="2"){ echo "Arredondar Pra duas casas decimal";} 
                                                     if($dadosdotrimestre["arredondarmedia"]=="1"){ echo "Arredondar Pra Uma casa decimal";} 

                                                      if($dadosdotrimestre["arredondarmedia"]=="0"){ echo "Para o Número inteiro mais próximo";}  ?></strong> )<br>


                                                   Peso da Média no ano lectivo: <strong> <?php echo $dadosdotrimestre["percentagemnoanolectivo"]; ?> </strong><br>
                                                   Posição <strong> <?php echo $dadosdotrimestre["posicao"]; ?> </strong><br>
                                             <br>
                                                </div>

                                              <!-- Collapsable Card Example -->
                                              <div class="card shadow mb-6">
                                              <!-- Card Header - Accordion -->
                                              <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Editar Informações</h6>
                                              </a>
                                              <!-- Card Content - Collapse -->
                                              <div class="collapse in" id="collapseCardExample">
                                                <div class="card-body">
                                                <form action="" method="post" class="user">
                                                      
                                                      <div class="form-group">
                                                          <label>Título:</label>
                                                        <input type="text" name="titulo" class="form-control  "  value="<?php echo $dadosdotrimestre["titulo"] ; ?>">
                                                      </div> 

                                                       <span>Ano Lectivo</span>
                                                        <div class="form-group">
                                                        <select name="idanolectivo"  id="anolectivo" required  class="form-control"> 
                                                          <?php
                                                               $lista=mysqli_query($conexao,"SELECT * from anoslectivos");
                                                              while($exibir = $lista->fetch_array()){ ?>
                                                              <option <?php if($dadosdotrimestre["idanolectivo"]==$exibir["idanolectivo"]){ echo "selected";} ?> value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                                            <?php } ?> 
                                                        </select> 
                                                        </div>

                                                      <div class="form-group">
                                                          <label>Posição:</label>
                                                        <input type="number" name="posicao" min="0" max="300" class="form-control  "  value="<?php echo $dadosdotrimestre["posicao"] ; ?>">
                                                      </div>

                                                      <div class="form-group">
                                                          <label>Nome da Média</label>
                                                        <input type="text" name="nomedamedia"   class="form-control  "  value="<?php echo $dadosdotrimestre["nomedamedia"] ; ?>">
                                                      </div> 


                                                      <div class="form-group">
                                                          <label>Peso da Nota no ano lectivo</label>
                                                       <input type="text" min="0" max="1" name="percentagemnoanolectivo" class="form-control  "  value="<?php echo $dadosdotrimestre["percentagemnoanolectivo"] ; ?>">
                                                      </div> 
 
                                                      <div class="form-group">
                                                          <input type="submit" name="editardadosdotrimestre" value="Guardar Novas Informações" class="btn btn-success" title="Guardar dados novos">
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
   
                                                      
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Outros Dados</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1"> 
                                       <?php

                                          
                                          $numerodeestudantes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo'")); 

                                          $numerodematriculas=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Matrícula' or tipo='Rematrícula'")); 

                                          $numerodereconfirmacoes=mysqli_num_rows(mysqli_query($conexao, "select idanolectivo FROM matriculaseconfirmacoes where idanolectivo='$idanolectivo' and tipo='Confirmação'")); 

  
                                      ?>   
                                              

                                        <br>  Número de Estudantes:  <?php echo $numerodeestudantes; ?> <br> 
                                               Número de Matrículas:  <?php echo $numerodematriculas; ?>  <br> 
                                               Número de Confimações:  <?php echo $numerodereconfirmacoes; ?> <br>


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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tipo de Notas</h6>
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
               
                    
                         <span id="mensagemdealerta"></span> 
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>


                    <tr>  
                      <th>Posição</th> 
                      <th>Tipo de Notas</th>
                      <th>Peso no trimestre</th>
                      <th>Eliminar</th>
                     
                    </tr> 

                  </thead>
                  <tbody> 

                  <?php 

                  $somadaspercentagens=0;
                   $lista= mysqli_query($conexao, "select * from tiposdenotas where idtrimestre='$idtrimestre'"); 

                    while($exibir = $lista->fetch_array()){

                      $somadaspercentagens+=$exibir['percentagemnotrimestre'];
  


                  ?>
                    <tr>  
                      <td contenteditable class="update" data-id="<?php echo $exibir["idtipodenota"]; ?>" data-column="posicao"><?php echo $exibir['posicao']; ?></td> 
                      <td contenteditable class="update" data-id="<?php echo $exibir["idtipodenota"]; ?>" data-column="titulo"> <?php echo $exibir['titulo']; ?>   </td>
                      <td contenteditable class="update" data-id="<?php echo $exibir["idtipodenota"]; ?>" data-column="percentagemnotrimestre"><?php echo $exibir['percentagemnotrimestre']; ?></td>
                      <td><a href="" class="delete" id="<?php echo $exibir["idtipodenota"]; ?>" ><i style="color:red" title="Eliminar esse tipo de nota" class="fas fa-trash"></i></a></td>
                
                    </tr> 
                    <?php } 

                    $somadaspercentagens=$somadaspercentagens*100; ?> 
                    
                    <tfoot>
                    <tr>  
                      <th>--</th> 
                      <th> <?php echo $dadosdotrimestre['nomedamedia']; ?>   </th>
                      <th>Média - <?php echo $somadaspercentagens; ?> % </th>
                      <th></th>
                
                    </tr> 
                    </tfoot>

 
                  </tbody>
                </table>  

                <?php if($somadaspercentagens!=100){?>
                <div class="alert alert-danger">OBS: O valor da média tem de atingir 100% - NÃO DEVE ULTRAPASSAR NEM PARAR EM MENOS DE 100%</div>
                <?php }?>
                  
                  
                
                
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
      <!-- End of Main Content -->
        <br><br><br>
    
  <script type="text/javascript">
     
     $(document).on("blur", ".update", function(){
            var id=$(this).data("id");
            var nomedacoluna=$(this).data("column");
            var valor=$(this).text();
             

            $.ajax({
                url:'cadastro/updatetipodenotas.php',
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
                if(confirm("Tens certeza que queres eliminar Esse tipo de Nota?")){
                    $(this).closest('tr').remove(); 
                    $.ajax({
                    url:'cadastro/deletetipodenota.php',
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
