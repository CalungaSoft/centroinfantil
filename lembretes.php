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
  
  $descricao=mysqli_escape_string($conexao,$_POST['descricao']);
  $datadolembrete=mysqli_escape_string($conexao,$_POST['datadolembrete']);
   
  $salvar= mysqli_query($conexao,"INSERT INTO `lembretes` (`idlembrete`, `descricao`, `datadolembrete`, `datadecadastro`) VALUES (NULL, '$descricao', STR_TO_DATE('$datadolembrete', '%d/%m/%Y'), CURRENT_TIMESTAMP)");
   
   if($salvar){

        $acerto[]="Lembrete Cadastrado com Sucesso";
 

        }else{

          $erros[]="Ocorreu um erro Ao Cadastrar o(a) aluno(a)";

        } 

}

 
 

 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lembrete da Empresa</h1>
          <p class="mb-4">A seguir vai a lista de lembretes marcados <?php  if(isset($_GET['todos'])){ echo "| Todos os registros"; }else{echo "| Apenas registros desta semana";} ?></p>


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
    <button id="myBtn" class="btn btn-primary">Criar um novo Lembrete</button>

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="post" action=""> 
                     
                    <?php
                          $listadeservicos=mysqli_query($conexao, "select * from lembretes"); 
                  
                    ?>
                      
                     <div class="form-group">
                         <span>Descreva aqui o que te queres lembrar</span>
                        <textarea name="descricao" rows="3" required="" class="form-control " ></textarea>
                    </div> 
                     
                     
                      <div class="form-group">
                          <input type="text" name="datadolembrete" required="" class="form-control js-datepicker"   autocomplete="off" placeholder="Data da qual desejas ser lembrado">
                      </div> 
                    <br>
                       <input type="submit" name="cadastrar" value="Cadastrar Lembrete" class="btn btn-success" style="float: rigth;">
                    
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
              <h6 class="m-0 font-weight-bold text-primary">Actividades lembretedas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <?php

              if(isset($_GET['todos'])){ ?>
                             
                    <a href="lembretes.php" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-eye"></i> Ver Apenas desta semana</a> 

                      <?php  }else{ ?>
                        

                    <a href="lembretes.php?todos=true" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-eye"></i> Ver Todos</a> 
                               

                       <?php  } ?>


               <br><br>

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Data</th>
                      <th>Lembrar de</th>
                      <th>Cadastrado em</th> 
                      <th>Opção</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        
                        if(isset($_GET['todos'])){
                             
                              $listadeservicos=mysqli_query($conexao, "select * from lembretes"); 

                        }else{
                        

                              $listadeservicos=mysqli_query($conexao, "select * from lembretes where Week(datadolembrete)=Week(curdate())"); 

                        }

                         while($exibir = $listadeservicos->fetch_array()){
                       
                        
                  ?>
                    <tr> 
                      <td class="update" data-id="<?php echo $exibir["idlembrete"]; ?>" data-column="datadolembrete"  contenteditable><?php echo $exibir['datadolembrete']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idlembrete"]; ?>" data-column="descricao"  contenteditable><?php echo $exibir['descricao']; ?></td> 
                      <td><?php echo $exibir['datadecadastro']; ?></td>
                      <td align="center">
                         <a class="delete" href="" id="<?php echo $exibir["idlembrete"]; ?>" ><i style="color:red" title="eliminar servico" class="fas fa-trash" ></i> </a>
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
                                                                    url:'cadastro/updatelembrete.php',
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
                                                                    url:'cadastro/deletelembrete.php',
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