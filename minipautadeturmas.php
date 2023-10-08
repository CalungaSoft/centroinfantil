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

if(isset($_POST['cadastrar'])){
  
  if(!empty(trim($_POST['titulo']))){ 
   
      $titulo=mysqli_escape_string($conexao,$_POST['titulo']);
      $idanolectivo=mysqli_escape_string($conexao,$_POST['idanolectivo']);
      $idperiodo=mysqli_escape_string($conexao,$_POST['idperiodo']); 
      $idcurso=mysqli_escape_string($conexao,$_POST['idcurso']);
      $idsala=mysqli_escape_string($conexao,$_POST['idsala']);
      $idclasse=mysqli_escape_string($conexao,$_POST['idclasse']);
      $matricula=mysqli_escape_string($conexao,$_POST['matricula']);
      $reconfirmacao=mysqli_escape_string($conexao,$_POST['reconfirmacao']);
      $propina=mysqli_escape_string($conexao,$_POST['propina']);
      $eclassedeexame=mysqli_escape_string($conexao,$_POST['eclassedeexame']);
      $classificacaopositiva=mysqli_escape_string($conexao,$_POST['classificacaopositiva']);
      $classificacaonegativa=mysqli_escape_string($conexao,$_POST['classificacaonegativa']);

      $minimoparapositiva=mysqli_escape_string($conexao,$_POST['minimoparapositiva']);
      $valorminimo=mysqli_escape_string($conexao,$_POST['valorminimo']);
      $valormaximo=mysqli_escape_string($conexao,$_POST['valormaximo']);
       
        $existe=mysqli_num_rows(mysqli_query($conexao, "select idturma from turmas where titulo='$titulo' and idanolectivo='$idanolectivo' and idperiodo='$idperiodo' and idcurso='$idcurso' and idsala='$idsala' and idclasse='$idclasse'"));
      
          if($existe==0){
 

              $idciclo=mysqli_fetch_array(mysqli_query($conexao, "SELECT idciclo FROM classes  where  idclasse='$idclasse'"))[0]; 

                                                


                $salvar= mysqli_query($conexao,"INSERT INTO `turmas` (titulo, idanolectivo, idperiodo, idcurso, idsala, idclasse, matricula, reconfirmacao, propina, eclassedeexame, classificacaopositiva, classificacaonegativa, minimoparapositiva, valormaximo, valorminimo, idciclo) VALUES ('$titulo', '$idanolectivo', '$idperiodo', '$idcurso', '$idsala', '$idclasse', '$matricula', '$reconfirmacao', '$propina', '$eclassedeexame', '$classificacaopositiva', '$classificacaonegativa', '$minimoparapositiva', '$valormaximo', '$valorminimo', '$idciclo')");
                 
               if($salvar){

                $acerto[]="Turma $titulo foi Cadastrada com sucesso";

            }else{

              $erros[]="Ocorreu um erro Ao Cadastrar a turma";

            } 
          }else{

        $erros[]="Essa turma já existe";
      }

    }  else{
    $erros[]=" O campo título não pode ir vazio";
  }
   

}


 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista de turmas no ano lectivo (<?php echo $anolectivo_escolhido; ?>)</h1>
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
 
      <?php if($painellogado=="administrador" ||  $painellogado=="areapedagogica"){ ?>
   <button id="myBtn" class="btn btn-success">  <i class="fas fa-fw fa-plus"></i> Acrescentar uma nova turma</button>

 

<?php }else { ?>

<span id="myBtn"></span>
<?php  } ?>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" method="post" action=""> 
                <h3>Cadastrando uma nova turma</h3> <br>
                    <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "select * from turmas"); 
                        
                          ?>
                      <input type="text" name="titulo" autocomplete="off" list="datalist2" class="form-control"  placeholder="Título para a turma" required="">
                      <datalist id="datalist2">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['titulo']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 

                      <div class="form-group row">
                        <div class="col-sm-4">  
                                  <span>Ano Lectivo</span>
                                    <select name="idanolectivo" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos order by titulo desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option value="<?php echo $exibir["idanolectivo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                        <?php } ?> 
                                    </select> 
                        </div>
                        <div class="col-sm-4"> 
                                <span>Período</span>
                                  <select name="idperiodo" required  class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from periodos order by titulo desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option value="<?php echo $exibir["idperiodo"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                        </div> 

                         <div class="col-sm-4"> 
                             <span>Sala</span>
                              <select name="idsala" required  class="form-control"> 
                                <?php
                                     $lista=mysqli_query($conexao,"SELECT * from salas order by titulo desc");
                                    while($exibir = $lista->fetch_array()){ ?>
                                    <option value="<?php echo $exibir["idsala"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                  <?php } ?> 
                              </select> 
                        </div> 

                    </div>



                     
                     <div class="form-group row">
                        <div class="col-sm-6">  
                                  <span>Curso</span>
                                    <select name="idcurso" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT * from cursos order by titulo desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option value="<?php echo $exibir["idcurso"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                        <?php } ?> 
                                    </select> 
                        </div>
                        <div class="col-sm-3"> 
                               <span>Classe</span>
                                  <select name="idclasse" required  class="form-control"> 
                                    <?php
                                         $lista=mysqli_query($conexao,"SELECT * from classes order by titulo desc");
                                        while($exibir = $lista->fetch_array()){ ?>
                                        <option value="<?php echo $exibir["idclasse"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                                      <?php } ?> 
                                  </select> 
                        </div> 

                         <div class="col-sm-3"> 
                            <span>Classe de exame</span>
                              <select name="eclassedeexame" required  class="form-control"> 
                                  <option value="Não">Não</option>
                                  <option value="Sim">Sim</option> 
                              </select> 
                        </div> 

                    </div>


                   
  



                  <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(matricula) from turmas"); 
                        
                          ?>
                      <input type="number" name="matricula" min="0" autocomplete="off" list="listamatricula" class="form-control"  placeholder="Preço da Matrícula" required="">
                      <datalist id="listamatricula">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['matricula']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 

                    <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(reconfirmacao) from turmas"); 
                        
                          ?>
                      <input type="number" name="reconfirmacao" min="0" autocomplete="off" list="listareconfirmacao" class="form-control"  placeholder="Preço da Confirmação" required="">
                      <datalist id="listareconfirmacao">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['reconfirmacao']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 


                       <div class="form-group">
                          <?php

                                $lista=mysqli_query($conexao, "SELECT distinct(propina) from turmas"); 
                        
                          ?>
                      <input type="number" name="propina" min="0" autocomplete="off" list="listapropina" class="form-control"  placeholder="Preço da Propina" required="">
                      <datalist id="listapropina">
                        <?php  while($exibir = $lista->fetch_array()){ ?>
                         <option value="<?php echo $exibir['propina']; ?>"> 
                        <?php } ?>
                    </datalist>
                    </div> 


                      <div class="form-group row">
                        <div class="col-sm-6">  
                                  <span>Classificação Positiva</span>

                                    <input type="text" name="classificacaopositiva"  list="clap" class="form-control"  placeholder="Classificação Positiva" required="">

                                      <datalist id="clap"> 
                                         <option value="Apto"> 
                                         <option value="Transita"> 
                                    </datalist>
                        </div>
                        <div class="col-sm-6"> 
                                <span>Classificação Negativa</span>
                                
                                    <input type="text" name="classificacaonegativa"  list="clan" class="form-control"  placeholder="Classificação Negativa" required="">

                                      <datalist id="clan"> 
                                         <option value="N/ Apto"> 
                                         <option value="N/ Transita"> 
                                    </datalist>
                        </div>  
                    </div>
<span> «««««««««« Notas dos Alunos »»»»»»»»»»»</span>
                    <div class="form-group row">
                     <div class="col-sm-4"> 
                                <span>Valor mínimo da Nota</span>
                                
                                    <input type="number" name="valorminimo" max="20" min="0" list="clan1" class="form-control"  placeholder="Valor mínimo" required="" value="0">

                                       
                        </div> 
                         <div class="col-sm-4"> 
                                <span>Mínimo Para Positiva</span>
                                
                                    <input type="number" name="minimoparapositiva" max="20" min="0" list="clan1" class="form-control"  placeholder="Nota mínima para Positiva" required="" value="10">

                                       
                        </div> 
                        <div class="col-sm-4">  
                                  <span>Valor máximo da Nota</span>

                                    <input type="number" name="valormaximo" max="20" min="0" class="form-control"  placeholder="Valor máximo" required="" value="20"> 
                        </div> 
                    </div>

                     
                    <br>
                       <input type="submit" name="cadastrar" value="Dar abertura a nova turma" class="btn btn-success" style="float: rigth;">
                    
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
                      <th>Período</th> 
                      <th>Curso</th> 
                      <th>Sala</th> 
                      <th>Classe</th> 
                      <th>Nº de Alunos</th> 
                      <th>Ver Mais</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from turmas where idanolectivo='$idanolectivo'"); 
                         while($exibir = $lista->fetch_array()){

                           $idturma=$exibir["idturma"];

                           $idperiodo=$exibir["idperiodo"];
                           $idcurso=$exibir["idcurso"];
                           $idsala=$exibir["idsala"];
                           $idclasse=$exibir["idclasse"];

                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];
 
                            $alunos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus='activo'"));

                  ?>
                    <tr>  
                      <td> <a  href="turma.php?idturma=<?php echo $exibir["idturma"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td> 

                      <td><a  href="periodo.php?idperiodo=<?php echo $exibir["idperiodo"]; ?>"><?php echo $periodo; ?></a></td>
                      <td><a  href="curso.php?idcurso=<?php echo $exibir["idcurso"]; ?>"><?php echo $curso; ?></a></td>  
                      <td><a  href="sala.php?idsala=<?php echo $exibir["idsala"]; ?>"><?php echo $sala; ?></a></td> 
                      <td><a  href="classe.php?idclasse=<?php echo $exibir["idclasse"]; ?>"><?php echo $classe; ?></a></td>  
                      <td><?php echo $alunos; ?></td>  
                      <td align="center" title="Veja mais opções sobre esse turma">
                      <a  href="turmaminipauta.php?idturma=<?php echo $exibir["idturma"]; ?>"> <button class="btn btn-success">Ver Minipauta </button> </a>
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