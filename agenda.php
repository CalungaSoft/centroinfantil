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

 

if(isset($_POST['cadastrar'])){
  
  $nomedaactividade=mysqli_escape_string($conexao,$_POST['nomedaactividade']);
  $obs=mysqli_escape_string($conexao,$_POST['obs']);
  $horainicio=mysqli_escape_string($conexao,$_POST['horainicio']);
  $horadofim=mysqli_escape_string($conexao,$_POST['horadofim']);
  $datainicio=mysqli_escape_string($conexao,$_POST['datainicio']);
  $datafim=mysqli_escape_string($conexao,$_POST['datafim']);

  $salvar= mysqli_query($conexao,"INSERT INTO `agenda` (`idagenda`, `nomedaactividade`, `datainicio`, `datafim`, `obs`, `horainicio`, `horafim`) VALUES (NULL, '$nomedaactividade', STR_TO_DATE('$datainicio', '%d/%m/%Y'), STR_TO_DATE('$datafim', '%d/%m/%Y'), '$obs', '$horainicio', '$horadofim')");
   
  
if(!$salvar){
  echo "Ocorreu um ERRO, verifique se todos os campos foram devidamente preenchidos!";
  
}else{
  header('Location: agenda.php');
}

}


$cardeeditar="";

if(isset($_GET['idservico'])){ 
  $idservico=$_GET['idservico'];
  $cardeeditar="aberto";
  $servicoasereditado=mysqli_fetch_array(mysqli_query($conexao, "select * from servicos where idservico='$idservico'")); 

}

 

 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Agenda da Empresa</h1>
          <p class="mb-4">A seguir vai as actividades agendadas na Empresa <?php  if(isset($_GET['todos'])){ echo "| Todos os registros"; }else{echo "| Apenas registros desta semana";}


          ?></p>
 
          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-primary">Agendar actividade</button>

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="post" action=""> 
                    <div class="form-group">
                    <?php
                          $listadeservicos=mysqli_query($conexao, "select * from agenda"); 
                  
                    ?>
                      <input type="text" name="nomedaactividade" list="datalist2" class="form-control"  title="Digite o nome da actividade a se realizar" placeholder="Actividade" required="">
                      <datalist id="datalist2">
                        <?php  while($exibir = $listadeservicos->fetch_array()){ ?>
                         <option value="<?php echo $exibir['nomedaactividade']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 
                     
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" name="datainicio" class="form-control js-datepicker" title="Data de início da actividade" autocomplete="off" placeholder="Data de início">
                      </div>
                      <div class="col-sm-6">
                      <input type="text" name="horainicio" list="horai" class="form-control" title="Digite a hora no formato (hora:minuto) obrigatoriamente" placeholder="Horário de início (H:m)">
                      <datalist id="horai">
                        <?php 
                        $listadeservicos=mysqli_query($conexao, "select distinct(horainicio) from agenda"); 
                         while($exibir = $listadeservicos->fetch_array()){ ?>
                         <option value="<?php echo $exibir['horainicio']; ?>"> 
                        <?php } ?>
                    </datalist>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" name="datafim" class="form-control js-datepicker" title="Digite a data de término da actividade" autocomplete="off" placeholder="Data final">
                      </div>
                      <div class="col-sm-6">
                      <input type="text" name="horadofim" list="horaf" class="form-control" title="Digite a hora no formato (hora:minuto) obrigatoriamente" placeholder="Horário de término (H:m)">
                      <datalist id="horaf">
                        <?php $listadeservicos=mysqli_query($conexao, "select distinct(horafim) from agenda"); 
                         while($exibir = $listadeservicos->fetch_array()){ ?>
                         <option value="<?php echo $exibir['horafim']; ?>"> 
                        <?php } ?>
                    </datalist>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" name="obs" class="form-control " title="Se tiver alguma informação que queiras agregar a essa inscrição, digite-a aqui" placeholder="Observações">
                    </div>  
                    <br>
                       <input type="submit" name="cadastrar" value="Agendar" class="btn btn-success" style="float: rigth;">
                    
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
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Actividades agendadas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <?php

              if(isset($_GET['todos'])){ ?>
                             
                    <a href="agenda.php" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-eye"></i> Ver Apenas desta semana</a> 

                      <?php  }else{ ?>
                        

                    <a href="agenda.php?todos=true" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-eye"></i> Ver Todos</a> 
                               

                       <?php  } ?>


               <br><br>

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Actividade</th>
                      <th>Início(Data)</th>
                      <th>Início(Hora)</th>
                      <th>Fim(Data)</th> 
                      <th>Fim(Hora)</th>
                      <th title="Observação">OBS</th> 
                      <th>Cadastro</th> 
                      <th>Opção</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        
                        if(isset($_GET['todos'])){
                             
                              $listadeservicos=mysqli_query($conexao, "select * from agenda"); 

                        }else{
                        

                              $listadeservicos=mysqli_query($conexao, "select * from agenda where Week(datainicio)=Week(curdate())"); 

                        }

                         while($exibir = $listadeservicos->fetch_array()){
                       
                        
                  ?>
                    <tr> 
                      <td class="update" data-id="<?php echo $exibir["idagenda"]; ?>" data-column="nomedaactividade"  contenteditable><?php echo $exibir['nomedaactividade']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idagenda"]; ?>" data-column="datainicio"  contenteditable><?php echo $exibir['datainicio']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idagenda"]; ?>" data-column="horainicio"  contenteditable><?php echo $exibir['horainicio']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idagenda"]; ?>" data-column="datafim"  contenteditable><?php echo $exibir['datafim']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idagenda"]; ?>" data-column="horafim"  contenteditable><?php echo $exibir['horafim']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idagenda"]; ?>" data-column="obs"  contenteditable><?php echo $exibir['obs']; ?></td>
                      <td><?php echo $exibir['data']; ?></td>
                      <td align="center">
                         <a class="delete" href="" id="<?php echo $exibir["idagenda"]; ?>" ><i style="color:red" title="eliminar servico" class="fas fa-trash" ></i> </a>
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