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

 $mes=date('m');
 $ano=date('Y');
$anoescolhido=isset($_GET['anoescolhido'])?$_GET['anoescolhido']:"$ano";
$mesescolhido=isset($_GET['mesescolhido'])?$_GET['mesescolhido']:"$mes";


 if(isset($_GET['mesescolhido'])){

   $mes_em_questao="$anoescolhido-$mesescolhido-01";

 }else{


     $mes_em_questao=date("Y-m-01");


 }
 

 
$nomedoanolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

$nomedomes=str_replace('-01', '', $mesespecifico);
$nomedomes=str_replace('-', '/', $nomedomes);

include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Alunos com propinas Em Atraso no ano lectivo <a href="anolectivo.php?idanolectivo=<?php echo "$idanolectivo"; ?>"><?php echo "$nomedoanolectivo"; ?></a><?php  echo " ( $mesescolhido/$anoescolhido )"; ?></h1>
           

     
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
                <?php 

                 $anoactual=date('Y');
                  $mesactual=date('m');
                   $htm='
                       <div class="form-group"> 
                      <input type="number" name="anoescolhido" min="2010" max="2100" class="form-control"   placeholder="Ano" value="'.$anoactual.'">
                    </div>


                     
                    <div class="form-group">
                          <select name="mesescolhido"  class="form-control">
                          <option '; if($mesactual==1) {  $htm.=' selected="" '; } $htm.=' value="01">Janeiro</option>
                              <option '; if($mesactual==2) {  $htm.=' selected="" '; } $htm.=' value="02">Fevereiro</option>
                              <option '; if($mesactual==3) {  $htm.=' selected="" '; } $htm.=' value="03">Março</option>
                              <option '; if($mesactual==4) {  $htm.=' selected="" '; } $htm.=' value="04">Abril</option>
                              <option '; if($mesactual==5) {  $htm.=' selected="" '; } $htm.=' value="05">Maio</option>
                              <option '; if($mesactual==6) {  $htm.=' selected="" '; } $htm.=' value="06">Junho</option>
                              <option '; if($mesactual==7) {  $htm.=' selected="" '; } $htm.=' value="07">Julho</option>
                              <option '; if($mesactual==8) {  $htm.=' selected="" '; } $htm.=' value="08">Agosto</option>
                              <option '; if($mesactual==9) {  $htm.=' selected="" '; } $htm.=' value="09" >Setembro</option>
                              <option '; if($mesactual==10) {  $htm.=' selected="" '; } $htm.=' value="10">Outubro</option>
                              <option '; if($mesactual==11) {  $htm.=' selected="" '; } $htm.=' value="11">Novembro</option>
                              <option '; if($mesactual==12) {  $htm.=' selected="" '; } $htm.=' value="12">Dezembro</option> 
                          </select> 
                     </div>';

                     echo "$htm";

                     ?>

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
 

               <a href="alunoscompropinasirregulares.php?idanolectivo=<?php echo "$idanolectivo"; ?>"   class="d-sm-inline-block btn btn-sm btn-info"><i class="fas fa-fw fa-user"></i>Ver todos os alunos </a>  <br><br>
              

                <span id="mensagemdealerta"></span>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>  
                      <th>Turma</th> 
                      <th>Período</th>  
                      <th>Alunos</th> 
                      <th>Com Dívida</th> 
                      <th>Ver Lista</th>
                      <th>Imprimir</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $lista=mysqli_query($conexao, "select * from turmas where idanolectivo='$idanolectivo'"); 
                         while($exibir = $lista->fetch_array()){

                           $idturma=$exibir["idturma"];

                           $idperiodo=$exibir["idperiodo"]; 
                           $idsala=$exibir["idsala"]; 

                            $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                          
                            $alunos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));

                            $naopagaram=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM matriculaseconfirmacoes where  (ultimomespago<'$mes_em_questao' and tipodealuno!='Bolseiro') and idanolectivo='$idanolectivo' and idturma='$idturma'")); 


                            if($alunos==0){$percentagem=0;}else{
                              $percentagem=round($naopagaram*100/$alunos);
                            }
                            

                  ?>
                    <tr>  
                      <td> <a  href="turma.php?idturma=<?php echo $exibir["idturma"]; ?>"> <?php echo $exibir['titulo']; ?> </a></td> 

                      <td><a  href="periodo.php?idperiodo=<?php echo $exibir["idperiodo"]; ?>"><?php echo $periodo; ?></a></td> 
                      <td><?php echo $alunos; ?></td>  
                      <td title="<?php echo $percentagem; ?> % dos alunos na turma <?php echo $exibir['titulo']; ?> ainda não pagaram as propinas desse mês"><?php echo $naopagaram; ?></td>  
                      <td align="center" title="Veja a listas dos alunos desta turma com esse mês em atraso">
                         <a class="btn btn-info" href="alunoscompropinasirregulareslista.php?idturma=<?php echo $exibir["idturma"]; ?>&anodevenda=<?php echo $anoescolhido; ?>&mesdevenda=<?php echo $mesescolhido; ?>" <?php echo $exibir["idturma"]; ?>><i  class="fas fa-eye" ></i> </a>
                      </td>
                      <td align="center" title="Imprima a lista de alunos com esse mês em atraso">
                         <a class="btn btn-sm btn-success" href="pdf/propinasematrasotodos.php?idturma=<?php echo $exibir["idturma"]; ?>&anodevenda=<?php echo $anoescolhido; ?>&mesdevenda=<?php echo $mesescolhido; ?>" ><i  class="fas fa-print" ></i> </a>
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