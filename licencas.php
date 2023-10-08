<?php 
include("conexao.php");

    
session_start();

 

$nome='Esmael Calunga | CalungaSoft';
 
$idlogado='0';
$nomelogado='';
$painellogado='123';

 
 
if(isset($_POST['cadastrar'])){
  
  
      $titulo=mysqli_escape_string($conexao, $_POST['titulo']);
      $posicao=mysqli_escape_string($conexao, $_POST['posicao']);
      $fim=mysqli_escape_string($conexao, $_POST['fim']);
      $preco=$posicao*10000;
      $codigo=mysqli_escape_string($conexao, $_POST['codigo']);
 
 

       
        if(!empty(trim($codigo))){
        $codigo=password_hash($codigo, PASSWORD_DEFAULT);

       
              if(mysqli_num_rows(mysqli_query($conexao," SELECT idbq FROM bq where posicao='$posicao'"))==0){ 

                $guardar=mysqli_query($conexao,"INSERT INTO `bq` (`titulo`, `posicao`, `codigo`, `fim`, `vigor`, `aberto`, `preco`) VALUES ('$titulo', '$posicao', '$codigo',  STR_TO_DATE('$fim', '%d/%m/%Y'), 'Não', 'Não', '$preco')");
  
                if($guardar){
          
                  $acertos[]="Cadastrado com Sucesso! ";
                    
                }else{
                  $erros[]="Ocorreu um erro ao cadastrar!";
                    
                }


              }else{
                $erros[]="Já Existe uma licenca com essa posicao, por favor, use outro nome";
              }

            }else{

              $erros[]="As Senhas não podem ser campos vazios!";

            }

       
   
}




 
if(isset($_GET['permition'])){
  
  
  $idbq=mysqli_escape_string($conexao, $_GET['idbq']); 
 
  

  $estaaberto=mysqli_fetch_array(mysqli_query($conexao,"SELECT aberto from bq where idbq='$idbq'"))[0];

      if(!($estaaberto=='Sim')){

          $erros[]="Você ainda não comprou essa licença";


      }else{


        $totaldedias=mysqli_fetch_array(mysqli_query($conexao,"SELECT  TIMESTAMPDIFF(DAY,CURDATE(),fim) as dias from bq where idbq='$idbq'"))[0];

          if($totaldedias<1){

             $erros[]="A Licença que pretendes usar, já expirou";

          }else{


              $alterar=mysqli_query($conexao,"UPDATE `bq` SET `vigor` = 'Sim' WHERE `bq`.`idbq` = '$idbq'");
              $alterar=mysqli_query($conexao,"UPDATE `bq` SET `vigor` = 'Não' WHERE `bq`.`idbq` != '$idbq'");

                if($alterar){
          
                  $acertos[]="Nova Licença em vigor";
                    
                }else{
                  $erros[]="Ocorreu um erro!";
                    
                }
 



          }


      }
          

              


}






if(isset($_GET['painel'])){
  
  
  $idadministrador=mysqli_escape_string($conexao, $_GET['idadministrador']);
  $painel=mysqli_escape_string($conexao, $_GET['painel']); 


 
    
            $guardar=mysqli_query($conexao,"UPDATE `administradores` SET `painel` = '$painel' WHERE `administradores`.`idadministrador` = '$idadministrador'");

            if($guardar){
      
              $acertos[]="Funcionário mudado para acesso de  $painel com Sucesso! ";
                
            }else{
              $erros[]="Ocorreu um erro!";
                
            }
 
 


}



include("cabecalho.php") ; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Licenças do sistema</h1>
          <p class="mb-4">Abaixo vai a lista de licencenças que podem ser compradas</p>




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



               <?php 

    $totaldedias=mysqli_fetch_array(mysqli_query($conexao,"SELECT  TIMESTAMPDIFF(DAY,CURDATE(),fim) as dias from bq where vigor='Sim'"))[0];

    if($totaldedias<0){

      $totaldedias=$totaldedias*(-1);

        $info[]='<h2>A Licença do software está expirada há '.$totaldedias.' dias</h2>'; 

    }else{

          $info[]='<h2>Faltam '.$totaldedias.' dias para o software expirar</h2>'; 

    }

$evitalico=mysqli_num_rows(mysqli_query($conexao,"SELECT posicao from bq where aberto='Sim' and posicao='15'"));           

 
            if(!empty($info) && $evitalico==0):
                        foreach($info as $info):
                          echo '<div class="alert alert-danger">'.$info.' <br> </div>';
                        endforeach;
                      endif;
            ?>


          <h2>Central CalungaSoft: +244 941 45 21 53</h2>



            

   <div class="row">
        <div class="col-xl-6 col-lg-6"></div> 
          <div class="col-xl-5 col-lg-6">
            <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
              <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Cadastrar Licença</h6>
              </a>
          <!-- Card Content - Collapse -->
                      <div class="collapse mb-4" id="collapseCardExample">
                          <div class="card-body">

                              <form   method="POST" action="">
                              
                                  

                                <div class="form-group">
                                  <input type="text" name="titulo"  required=""   class="form-control"  placeholder="Título">
                                </div> 

                                <div class="form-group">
                                  <input type="number" name="posicao" autocomplete="on"  required=""   class="form-control"  placeholder="posicao">
                                </div> 

                                 <div class="form-group">
                                    <input type="text" name="fim" autocomplete="off" class="form-control js-datepicker" placeholder="Fim">
                                </div> 
                                
                                 


                                 <div class="form-group">
                                  <input type="text" name="codigo" autocomplete="off" required=""   class="form-control"  placeholder="codigo">
                                </div> 

                              <div class="form-group">
                                  <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"  >
                              </div> 

                              <div id="info"> </div> 

                              <div  id="sms">   </div> 

                  </form>

                          </div>
                    </div>
            </div>
          </div>
</div> 

 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de licenças</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

               <span id="mensagemdealerta"></span> 

               <div class="alert alert-info"> Para Desbloquear uma licença: Clique no campo código, apaga os dois traços "--", insira o código da licença fornecido pela empresa CalungaSoft, depois retire o cursor sobre campo clicado.</div>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr> 
                      <th>Nº</th>
                      <th>Licença</th>
                      <th>Código</th> 
                      <th>Preço</th> 
                      <th>Data Final</th> 
                      <th>Usar</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php



                  $numerodelicencascompradas=mysqli_num_rows(mysqli_query($conexao,"SELECT idbq FROM `bq` where aberto='Sim'"));

                  $maiorlicenca=mysqli_fetch_array(mysqli_query($conexao,"SELECT posicao FROM bq where aberto='Sim' order by posicao desc limit 1"))[0];

                  $listadelicenca=mysqli_query($conexao, "select * from bq"); 
                   while($exibir = $listadelicenca->fetch_array()){ 

                        if($exibir['aberto']=='Sim'){
                          $codigo='<i title="Licença Aberta" class="fas fa-unlock"></i>';
                        }else{
                          $codigo='--';
                        }

                        if($exibir['posicao']==15){
                          $exibir['fim']="Vitaliço";
                        }  

                        $preco=number_format($exibir['preco']-(10000*$numerodelicencascompradas),2,",", ".");

                         if($exibir['posicao']<$maiorlicenca){
                          $preco=0;
                         } 

                        
                    ?>
                    <tr>   
                      <td><?php echo $exibir['posicao']; ?></td>
                      <td><?php echo $exibir['titulo']; ?></td>
                      <td class="update" data-id="<?php echo $exibir["idbq"]; ?>"  <?php if($exibir['aberto']!="Sim"){echo "contenteditable";}?>><?php echo $codigo; ?></td>
                      <td><?php echo $preco; ?></td>
                      <td><?php echo $exibir['fim']; ?></td>
                      <td>

                      <?php if($exibir['aberto']=='Sim' ){?>
                         <?php if($exibir['vigor']!='Sim' ){?>
                            <a href="licencas.php?idbq=<?php echo $exibir['idbq']; ?>&permition=usar">Usar</a>
                          <?php }else{
                            echo 'Em Uso';
                            } ?>
                       <?php }else { ?>
                          <i title="Licença Aberta" class="fas fa-lock"></i> 
                       <?php  } ?>
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
              var valor=$(this).text();
               

              $.ajax({
                  url:'cadastro/licenciar.php',
                  method:'POST',
                  data:{
                       id,valor 
                  },
                  success: function(data){
                      $("#mensagemdealerta").html(data);
                  }

              })
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
