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

 
 
 

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Fazer relatório Diário de Alunos da Instituição <?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> | (<?php echo $anolectivo_escolhido; ?>) </h1>  
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
    <button id="myBtn" class="btn btn-success">  Escolher outra Mês</button>

  <button id="myBtnreclamacoes" class="btn btn-info" title="Cadastrar uma saida">Escolher outro Ano Lectivo</button> 

 <?php

 if($painellogado=='professor'){

  echo '<a href="relatoriodiario.php?idanolectivo='.$idanolectivo.'&anodevenda='.$anodevenda.'&mesdevenda='.$mesdevenda.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-user"></i> Lançar Relatórios </a> ';

 }else {

  echo '<a href="relatoriodiariogerallancar.php?idanolectivo='.$idanolectivo.'&anodevenda='.$anodevenda.'&mesdevenda='.$mesdevenda.'" class="d-sm-inline-block btn btn-sm btn-primary" ><i class="fas fa-fw fa-user"></i> Lançar Relatórios </a> ';

 }

  


  ?>
 
    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="">
                    <div class="form-group">

                                  <span>Ano</span>
                                    <select name="anodevenda" required  class="form-control"> 
                                      <?php
                                           $lista=mysqli_query($conexao,"SELECT DISTINCT(YEAR(data)) as ano from relatoriodiario order by YEAR(data) desc");
                                          while($exibir = $lista->fetch_array()){ ?>
                                          <option value="<?php echo $exibir["ano"]; ?>"><?php echo $exibir["ano"]; ?></option>
                                        <?php } ?> 
                                    </select> 
                        </div>
                    
                    
                     
                    <div class="form-group">
                          <select name="mesdevenda"  class="form-control">
                          <option <?php $mesactual=date('m'); if($mesactual==1) { ?> selected="" <?php }?> value="01">Janeiro</option>
                              <option <?php if($mesactual==2) { ?> selected="" <?php }?> value="02">Fevereiro</option>
                              <option <?php if($mesactual==3) { ?> selected="" <?php }?> value="03">março</option>
                              <option <?php if($mesactual==4) { ?> selected="" <?php }?> value="04">Abril</option>
                              <option <?php if($mesactual==5) { ?> selected="" <?php }?> value="05">Maio</option>
                              <option <?php if($mesactual==6) { ?> selected="" <?php }?> value="06">Junho</option>
                              <option <?php if($mesactual==7) { ?> selected="" <?php }?> value="07">Julho</option>
                              <option <?php if($mesactual==8) { ?> selected="" <?php }?> value="08">Agosto</option>
                              <option <?php if($mesactual==9) { ?> selected="" <?php }?> value="09" >Setembro</option>
                              <option <?php if($mesactual==10) { ?> selected="" <?php }?> value="10">Outubro</option>
                              <option <?php if($mesactual==11) { ?> selected="" <?php }?> value="11">Novembro</option>
                              <option <?php if($mesactual==12) { ?> selected="" <?php }?> value="12">Dezembro</option> 
                          </select>
                          <br>
                          <input type="hidden" name="idanolectivo" value="<?php echo "$idanolectivo"; ?>">
                       <input type="submit" value="Visualizar Relatório" class="btn btn-primary" style="float: rigth;">
                    </div>

          </form>
        </div>
    </div>


    


    <div id="myModalreclamacoes" class="modal"  >
        <div class="modal-content">
          <span id="closereclamacoes"> &times;</span>
          <form action="" method="get">
          <input type="hidden" name="anodevenda" value="<?php echo "$anodevenda"; ?>">
          <input type="hidden" name="mesdevenda" value="<?php echo "$mesdevenda"; ?>">
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

              <div class="alert alert-info">Se desejar editar um relatório pode o fazer clicando direitamente no compo do registro. <br> ATT: só pode editar ou eliminar relatório de aluno lançados por ti.</div>

                <span id="mensagemdealerta"></span>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                     <th>Nº</th>
                      <th>Nome Completo</th> 
                      <th>Turma</th>  
                      <th>Relatório</th>  
                      <th>Data</th>
                      <th>Opção</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "SELECT  matriculaseconfirmacoes.turma,matriculaseconfirmacoes.estatus, relatoriodiario.* from relatoriodiario, matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and relatoriodiario.idmatriculaeconfirmacao=matriculaseconfirmacoes.idmatriculaeconfirmacao  and YEAR(relatoriodiario.data)='$anodevenda' and MONTH(relatoriodiario.data)='$mesdevenda' order by relatoriodiario.data desc"); 
                        $n=0;
                         while($exibir = $lista->fetch_array()){

                          $n++;

                          $idaluno=$exibir["idaluno"];

                           $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao, "select nomecompleto from alunos where idaluno='$idaluno' limit 1"))[0];

                         
 
 
                    if($exibir["estatus"]!="activo"){
                      $estatus="($exibir[estatus])";

                    }else{
                      $estatus="";
                    }

                  ?>
                    <tr>  
                     <td><?php echo $n; ?></td>
                        <td> <a  href="aluno.php?idaluno=<?php echo $exibir["idaluno"]; ?>"> <?php echo $nomedoaluno; ?>  </a> <?php echo $estatus; ?></td> 
                        <td><?php echo $exibir['turma']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idrelatoriodiario"]; ?>" data-column="descricao" <?php if($exibir["idprofessor"]==$idlogado){?>  contenteditable <?php } ?>><?php echo $exibir['descricao']; ?></td>
                         <td class="update" data-id="<?php echo $exibir["idrelatoriodiario"]; ?>" data-column="data" <?php if($exibir["idprofessor"]==$idlogado){?>  contenteditable <?php } ?>><?php echo $exibir['data']; ?></td>

                      <td align="center" title="Eliminar Relatório"> 
                       <?php if($exibir["idprofessor"]==$idlogado){ ?>
                        <a href="" class="delete" id="<?php echo $exibir["idrelatoriodiario"]; ?>" ><i style="color:red" title="Eliminar esse relatório" class="fas fa-trash"></i></a>
                      <?php }  ?>
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
                                  url:'cadastro/updaterelatorio.php',
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
                        if(confirm("Tens certeza que queres eliminar esse registro? ")){
                            $(this).closest('tr').remove(); 
                            $.ajax({
                            url:'cadastro/deleterelatorio.php',
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