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

  $mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
    $anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);
    


   $anolectivo_escolhido=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

   $idturma_padrao=mysqli_fetch_array(mysqli_query($conexao, "select turmas.idturma from turmas where turmas.idanolectivo='$idanolectivo' and idcoordenador='$idlogado' limit 1"))[0];
 
 
   $idturma=isset($_GET['idturma'])?$_GET['idturma']:"$idturma_padrao";
$idturma=mysqli_escape_string($conexao, $idturma); 

 $nome_do_turma=mysqli_fetch_array(mysqli_query($conexao, "select titulo from turmas where idturma='$idturma' limit 1"))[0];

if(isset($_POST['cadastrar'])){
  
  if(!empty(trim($_POST['idmatriculaeconfirmacao']))){ 
   
      $idmatriculaeconfirmacao=mysqli_escape_string($conexao,$_POST['idmatriculaeconfirmacao']); 
      $idaluno=mysqli_escape_string($conexao,$_POST['idaluno']); 
      $descricao=mysqli_escape_string($conexao,$_POST['descricao']);  
      $data=mysqli_escape_string($conexao,$_POST['data']); 
      
      
                $salvar= mysqli_query($conexao,"INSERT INTO `relatoriodiario` (`idrelatoriodiario`, `idaluno`, `idmatriculaeconfirmacao`, `descricao`, `data`, idprofessor) VALUES (NULL, '$idaluno', '$idmatriculaeconfirmacao', '$descricao',STR_TO_DATE('$data', '%d/%m/%Y'), '$idlogado')");

                 
               if($salvar){
 
 
                   $acerto[]="Registro  feito com sucesso!<br>  "; 

              }else{

                $erros[]="Ocorreu um erro";

              }
 
    }  else{
    $erros[]="Nenhum estudante escolhido";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Fazer relatório Diário de Alunos da Turma: <a href="turma.php?idturma=<?php echo "$idturma"; ?>"> <?php echo $nome_do_turma; ?> </a> (<?php echo $anolectivo_escolhido; ?>) </h1>  
          <p>A seguir vai a lista dos alunos matriculados</p> <br>
     
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
    <button id="myBtn" class="btn btn-success">  Escolher outra Turma</button>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

 <?php

  echo '<a href="relatoriodiariogeral.php?idanolectivo='.$idanolectivo.'&anodevenda='.$anodevenda.'&mesdevenda='.$mesdevenda.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-eye"></i> Ver Relatórios </a> ';


  ?>
 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="get" action=""> 
                <h3>Escolha uma Turma e Trimestre</h3> <br> 

                 <div class="form-group">
                 <span>Escolha a Turma</span>
                    <select name="idturma" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT turmas.idturma, turmas.titulo from turmas where turmas.idanolectivo='$idanolectivo' and idcoordenador='$idlogado' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idturma"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                       <input type="hidden" name="anodevenda" value="<?php echo $anodevenda; ?>" >
                    <input type="hidden" name="mesdevenda" value="<?php echo $mesdevenda; ?>" >

                    
                     <input type="hidden" name="idanolectivo" value="<?php echo "$idanolectivo"; ?>">


                    <br>
                       <input type="submit" name="ver" value="Ver Mapa de Aproveitamento" class="btn btn-success" style="float: rigth;">
                    
          </form>
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

                    <input type="hidden" name="anodevenda" value="<?php echo $anodevenda; ?>" >
                    <input type="hidden" name="mesdevenda" value="<?php echo $mesdevenda; ?>" >

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
                      <th>Periodo</th>   
                      <th>Relatório</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "SELECT  matriculaseconfirmacoes.* from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma  and turmas.idturma='$idturma' "); 

                         while($exibir = $lista->fetch_array()){

                          $idaluno=$exibir["idaluno"];

                           $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao, "select nomecompleto from alunos where idaluno='$idaluno' limit 1"))[0];
        
 
                    if($exibir["estatus"]!="activo"){
                      $estatus="($exibir[estatus])";

                    }else{
                      $estatus="";
                    }

                  ?>
                    <tr>  
                        <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $nomedoaluno; ?>  </a> <?php echo $estatus; ?></td> 
 
                      <td><?php echo $exibir['turma']; ?></td> 
                      <td><?php echo $exibir['periodo']; ?></td> 

                      <td align="center" title="Registrar algum acontecimento do aluno">
                         <a class="pagarpropina" data-id="<?php echo $exibir['idmatriculaeconfirmacao']; ?>"  href="reconfirmacao.php?idmatriculaeconfirmacao=<?php echo $exibir["idmatriculaeconfirmacao"]; ?>"> <button class="btn btn-success"> <i  class="fas fa-edit" ></i> Registrar</button> </a>
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

 
    <div id="myModalrelatorio" class="modal"  >
        <div class="modal-content">
          <span id="closerelatorio">&times;</span>
          <div id="formularioresposta"></div>
        </div>
    </div>
    
      <script>
                     var modalrelatorio=document.getElementById("myModalrelatorio");

                      

                    var span=document.getElementById("closerelatorio");

                    $(document).on("click",  ".pagarpropina", function(event){
                              event.preventDefault(); 
                              
                              modalrelatorio.style.display="block"; 
                              var id=$(this).data('id')
                              
                               
                                            $.ajax({
                              url:'cadastro/darrelatoriogeral.php',
                              method:'POST',
                              data: {
                                id: id  
                            },
                              success:function(data){ 
                                $('#formularioresposta').html(data);  
                              }
                            })

         
                            })
                            
                    span.addEventListener("click", ()=>{
                      modalrelatorio.style.display="none";
                                                  })
                    window.onclick =(event)=>{
                        if(event.target == modalrelatorio){
                          modalrelatorio.style.display="none";
                        }
                    }

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