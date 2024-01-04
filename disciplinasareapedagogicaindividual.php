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
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo); 

   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

   $funcao=isset($_GET['funcao'])?$_GET['funcao']:"";
$funcao=mysqli_escape_string($conexao, $funcao); 


 
 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista de turmas no ano lectivo (<?php echo $anolectivo_escolhido; ?>) | <?php echo $funcao; ?></h1>
          <p class="mb-4">A seguir vai a lista de turmas disponíveis na instituição</p>
     
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
    <span id="myBtn" >   </span>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          
        </div>
    </div>


    


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

                       <input type="hidden" name="funcao" value="<?php echo "$funcao"; ?>">
                          
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
                      <th>Turma</th> 
                      <th>Educador(a)</th> 
                      <th>Período</th> 
                      <th>Sala</th>  
                      <th>Nº de Alunos</th> 
                      <th>Opção</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from turmas where idanolectivo='$idanolectivo' and idcoordenador='$idlogado' order by titulo asc"); 
                         while($exibir = $lista->fetch_array()){

                           $idturma=$exibir["idturma"];

                           $idperiodo=$exibir["idperiodo"];
                         $idsala=$exibir["idsala"];
                          
                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                             $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                           
                            $alunos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));

                            $idcoordenador=$exibir["idcoordenador"];

                            $buscaCordenador=mysqli_query($conexao,"SELECT nomedofuncionario from funcionarios where idfuncionario='$idcoordenador'");
                           
                            
                            if (mysqli_num_rows($buscaCordenador)!=0) {
                              $nomedocoordenador=mysqli_fetch_array($buscaCordenador)[0];
 
                            }else {
                              $nomedocoordenador='';
                            }
                          


                  ?>
                    <tr>  
                      <td> <a  href="turma.php?idturma=<?php echo $exibir["idturma"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td> 
                      <td> <a  href="funcionario.php?idfuncionario=<?php echo $exibir["idcoordenador"]; ?>"> <?php echo $nomedocoordenador ?> </a></td> 
                      <td><a  href="periodo.php?idperiodo=<?php echo $exibir["idperiodo"]; ?>"><?php echo $periodo; ?></a></td> 
                      <td><a  href="sala.php?idsala=<?php echo $exibir["idsala"]; ?>"><?php echo $sala; ?></a></td>   
                      <td><?php echo $alunos; ?></td>  
                      <td align="center" >
                           
                            <?php if($funcao=='Ver Pauta'){?>
                               <a  href="turmapauta.php?idturma=<?php echo $exibir["idturma"]; ?>"> <button class="btn btn-success"> <?php echo "$funcao"; ?> </button> </a>

                        <?php } ?>

                          <?php if($funcao=='Ver Disciplinas'){?>
                               <a  href="turmapauta.php?idturma=<?php echo $exibir["idturma"]; ?>"> <button class="btn btn-success"> <?php echo "$funcao"; ?> </button> </a>

                        <?php }
                         if ($funcao == 'Lançar Presença') { ?>
                          <a href="presencaalunopordia.php?idturma=<?php echo $exibir["idturma"]; ?>"> <button class="btn btn-success">Lançar Presença </button> </a>
    
                      <?php } if ($funcao == 'Avaliar Aluno') { ?>
                          <a href="avaliarturma.php?idturma=<?php echo $exibir["idturma"]; ?>"> <button class="btn btn-success">Avaliar</button> </a>
    
                      <?php }
                        
                        ?>
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
            <span>Copyright &copy; CalungaSOFT 2024</span>
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