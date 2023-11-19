<?php 

include("conexao.php");


    
session_start();

if(!isset($_SESSION['logado'])  || $_SESSION['painel']!="administrador"):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

$erros=[];
$acertos=[];

if(isset($_POST['backup'])){

  $unidade=mysqli_escape_string($conexao, trim($_POST['unidade']));  
  
    backup_tables($hostname,$user,$password,$database,$unidade);
  
 
  
  
}


function backup_tables($host,$user,$pass,$name,$unidade)
  {
      $link = mysqli_connect($host,$user,$pass);
      mysqli_select_db($link, $name);
          $tables = array();
          $result = mysqli_query($link, 'SHOW TABLES');
          $i=0;
          while($row = mysqli_fetch_row($result))
          {
              $tables[$i] = $row[0];
              $i++;
          }
      $return = "";
      foreach($tables as $table)
      {
          $result = mysqli_query($link, 'SELECT * FROM '.$table);
          $num_fields = mysqli_num_fields($result);
          $return .= 'DROP TABLE IF EXISTS '.$table.';';
          $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
          $return.= "\n\n".$row2[1].";\n\n";
          for ($i = 0; $i < $num_fields; $i++)
          {
              while($row = mysqli_fetch_row($result))
              {
                  $return.= 'INSERT INTO '.$table.' VALUES(';
                  for($j=0; $j < $num_fields; $j++)
                  {
                      $row[$j] = addslashes($row[$j]);
                      if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                      if ($j < ($num_fields-1)) { $return.= ','; }
                  }
                  $return.= ");\n";
              }
          }
          $return.="\n\n\n";
      }
      //save file
      $handle = fopen(''.$unidade.':/db-'.$name.'-'.date('Y-m-d').'.sql','w+');//Don' forget to create a folder to be saved, "db_bkp" in this case
      
      if(fwrite($handle, $return) && fclose($handle)){
        echo "backup efetuado com sucesso <br>";//Sucessfuly message
      }else{
        echo "Ocorreu um erro ao efetuar o backup, verifique se a pen-drive está na unidade que você escolheu e tente novamente.";
      }
      
  }

 
  $total_ocupado = mysqli_fetch_array(mysqli_query($conexao,'SELECT TABLE_NAME "nomedatabela", sum(data_length /1024) "tamanhoKB", sum(index_length /1024) "tamanhoINDEX" FROM information_schema.TABLES WHERE  TABLE_NAME="alunos" or TABLE_NAME="matriculaseconfirmacoes" or TABLE_NAME="desistencias" or TABLE_NAME="entradas" or  TABLE_NAME="historico" or TABLE_NAME="pessoaldosservicos" or TABLE_NAME="saidas" or TABLE_NAME="salario"'));
   
 

include("cabecalho.php") ; ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">
     <!-- Content Row -->
     <div class="row">  
        <?php

        $tamanho_total=$total_ocupado["tamanhoINDEX"]+$total_ocupado["tamanhoKB"];
       
       $espaco=number_format($tamanho_total,2,",", ".");
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tamanho total do banco de dados<?php if(isset($_GET['mesdevenda'])){ echo "| $mesdevenda/$anodevenda"; }?> <?php if(isset($_GET['tipomarcado'])){ echo "($nomedotipo)"; }?>   </h1>
          <h1 style="font-size: 70px; text-align: center"><?php echo $espaco; ?> KB</h1>
           
<br><br>
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


          <?php  include("estilocarde.php"); ?>
    <button id="myBtn" class="btn btn-success" title="Guardar uma cópias de todos os dados do sistema em uma pen-drive" ><i class="fas fa-fw fa-save"></i>Fazer Backup do Banco de Dados</button>
 
                           
                             
 

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
          <form class="user" action="" method="POST">
          <div class="alert alert-success">O nosso sistema já faz um backup automatizado do seu banco de dados, mas você pode sempre que poderes fazer esse backup para que todos os seus dados esteja guardado, em um possível mal funcionamento deste computador, você terá como recuperar todos os dados mais tarde</div>
          <div class="alert alert-danger">Um arquivo com nome "bd-cyber-'DATA-de-Hoje'" será criado e guardado em sua pen-drive, não permita que esse arquivo seja aberto por qualquer pessoa, pois quem o fizer terá acesso a todos os seus dados e poderá até mesmo fazer alterações no mesmo.</div>
                       
          <div class="alert alert-info">De preferência guardares esses arquivos em uma pen-drive que sirva apenas para isso, não use essa pen-drive para outros fins, ou então esconda bem o arquivo mensionado acima</div>
              
<span>Escolha a Unidade onde será guardado o aquivo de backup</span>
          <select name="unidade"  class="form-control" title="Escolha aqui a unidade onde será guardado o arquivo do backup"  >
                          <option  value="A">A</option> 
                          <option  value="B">B</option> 
                          <option  value="C">C</option> 
                          <option  value="D">D</option> 
                          <option  value="E">E</option> 
                          <option  value="F">F</option> 
                          <option selected=""  value="G">G</option> 
                          <option  value="H">H</option> 
                          <option  value="I">I</option> 
                          <option  value="J">J</option> 
                          <option  value="K">K</option> 
                          <option  value="L">L</option> 
                          <option  value="M">M</option> 
                          <option  value="N">N</option> 
                          <option  value="O">O</option> 
                          <option  value="P">P</option> 
                          <option  value="Q">Q</option> 
                          <option  value="R">R</option> 
                          <option  value="S">S</option> 
                          <option  value="T">T</option> 
                          <option  value="U">U</option> 
                          <option  value="V">V</option> 
                          <option  value="X">X</option> 
                          <option  value="W">W</option>
                          <option  value="Y">Y</option> 
                          <option  value="Z">Z</option> 
                      </select>
<br>
                      <input type="submit" value="Salvar os dados na Pen-drive"  name="backup" class="btn btn-success" style="float: rigth;">
              
                    </div> 
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

                    window.onclick =(event)=>{
                        if(event.target == modalsaida){
                          modalsaida.style.display="none";
                        }
                    }

                    window.onclick =(event)=>{
                        if(event.target == modalreclamacoes){
                          modalreclamacoes.style.display="none";
                        }
                    }
 
 
                


                  </script>

<br><br> 
                    <!-- Content Row -->
                    <div class="row">  
               
 <?php

$total_ocupado_aluno = mysqli_fetch_array(mysqli_query($conexao,'SELECT  sum((data_length /1024)+(index_length /1024)) "tamanhoKB" FROM information_schema.TABLES WHERE  TABLE_NAME="alunos"'))[0];
$quantidade_de_registros=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM alunos"));
$percentagem=round($total_ocupado_aluno*100/$tamanho_total);
$total_ocupado_aluno=number_format($total_ocupado_aluno,2,",", ".");
 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> alunos | <?php echo $total_ocupado_aluno; ?> KB | <br><br> <?php  echo $quantidade_de_registros; ?> Registros</div>
                          <div class="row no-gutters align-items-center">  
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">  
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
                      <!-- Earnings (Monthly) Card Example -->
              
          



                     
 <?php

$total_ocupado_compra = mysqli_fetch_array(mysqli_query($conexao,'SELECT  sum((data_length /1024)+(index_length /1024)) "tamanhoKB" FROM information_schema.TABLES WHERE  TABLE_NAME="matriculaseconfirmacoes" '))[0];
$quantidade_de_registros=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM matriculaseconfirmacoes"));
$percentagem=round($total_ocupado_compra*100/$tamanho_total);
$total_ocupado_compra=number_format($total_ocupado_compra,2,",", ".");
 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Matrícula| <?php echo $total_ocupado_compra; ?> KB | <br><br> <?php  echo $quantidade_de_registros; ?> Registros</div>
                          <div class="row no-gutters align-items-center">  
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">  
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
                      <!-- Earnings (Monthly) Card Example -->
              
          

                         
 <?php

$total_ocupado_entrada = mysqli_fetch_array(mysqli_query($conexao,'SELECT  sum((data_length /1024)+(index_length /1024)) "tamanhoKB" FROM information_schema.TABLES WHERE  TABLE_NAME="entradas"'))[0];
$quantidade_de_registros=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM entradas"));
$percentagem=round($total_ocupado_entrada*100/$tamanho_total);
$total_ocupado_entrada=number_format($total_ocupado_entrada,2,",", ".");
 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> entradas | <?php echo $total_ocupado_aluno; ?> KB | <br><br> <?php  echo $quantidade_de_registros; ?> Registros</div>
                          <div class="row no-gutters align-items-center">  
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">  
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
                      <!-- Earnings (Monthly) Card Example -->
              
          


                         
 <?php

$total_ocupado_saida = mysqli_fetch_array(mysqli_query($conexao,'SELECT  sum((data_length /1024)+(index_length /1024)) "tamanhoKB" FROM information_schema.TABLES WHERE  TABLE_NAME="saidas"'))[0];
$quantidade_de_registros=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM saidas"));
$percentagem=round($total_ocupado_saida*100/$tamanho_total);
$total_ocupado_saida=number_format($total_ocupado_saida,2,",", ".");
 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"> saidas | <?php echo $total_ocupado_aluno; ?> KB | <br><br> <?php  echo $quantidade_de_registros; ?> Registros</div>
                          <div class="row no-gutters align-items-center">  
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">  
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
                      <!-- Earnings (Monthly) Card Example -->
              
          




                         
                      <?php

$total_ocupado_historico = mysqli_fetch_array(mysqli_query($conexao,'SELECT  sum((data_length /1024)+(index_length /1024)) "tamanhoKB" FROM information_schema.TABLES WHERE  TABLE_NAME="historico"'))[0];
$quantidade_de_registros=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM historico"));
$percentagem=round($total_ocupado_historico*100/$tamanho_total);
$total_ocupado_historico=number_format($total_ocupado_historico,2,",", ".");
 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"> Registros de Alterações | <?php echo $total_ocupado_aluno; ?> KB | <br><br> <?php  echo $quantidade_de_registros; ?> Registros</div>
                          <div class="row no-gutters align-items-center">  
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">  
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
                      <!-- Earnings (Monthly) Card Example -->
              
          




                         
                      <?php

$total_ocupado_presenca = mysqli_fetch_array(mysqli_query($conexao,'SELECT  sum((data_length /1024)+(index_length /1024)) "tamanhoKB" FROM information_schema.TABLES WHERE  TABLE_NAME="presenca"'))[0];
$quantidade_de_registros=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM presenca"));
$percentagem=round($total_ocupado_presenca*100/$tamanho_total);
$total_ocupado_presenca=number_format($total_ocupado_presenca,2,",", ".");
 ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4"> 
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Registros de Presença | <?php echo $total_ocupado_aluno; ?> KB | <br><br> <?php  echo $quantidade_de_registros; ?> Registros</div>
                          <div class="row no-gutters align-items-center">  
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "$percentagem";  ?>%</div>
                            </div>
                            <div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo "$percentagem";  ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">  
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> 
                      <!-- Earnings (Monthly) Card Example -->
              
          


                  </div>    
 
                  </div>  
        </div>
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

</body>

</html>
