 <?php  include("conexao.php"); 

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];


  if(!( $painellogado=="areapedagogica" || $painellogado=="professor" || $painellogado=="secretaria2"  || $painellogado=="administrador")){
   header('Location: login.php');
}

    if(isset($_POST['cadastrarsaida'])){
      
      $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
      $valorasair=mysqli_escape_string($conexao, trim($_POST['valorasair']));  
      $valorparaconsolidar=mysqli_escape_string($conexao, trim($_POST['valorparaconsolidar']));  
      $idtipo=mysqli_escape_string($conexao, trim($_POST['tipo'])); 
      $idanolectivo=mysqli_escape_string($conexao, trim($_POST['idanolectivo']));  
      $formadesaida=mysqli_escape_string($conexao, trim($_POST['formadesaida']));  

    
 
      $tipo=mysqli_fetch_array(mysqli_query($conexao,"SELECT tipo FROM `tipodesaidas` where idtipodesaida='$idtipo'"))[0];
      $updating=mysqli_query($conexao,"UPDATE `tipodesaidas` SET `numerodesaida` = `numerodesaida`+'1' WHERE `tipodesaidas`.`idtipodesaida` = '$idtipo'");

      

         $salvar1=mysqli_query($conexao,"INSERT INTO `saidas` (`idsaida`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `datadasaida`, `idtipo`, idanolectivo, formadesaida) VALUES (NULL, '$idlogado', '$descricao', '$tipo', '$valorasair', '$valorparaconsolidar', CURRENT_TIMESTAMP, '$idtipo', '$idanolectivo', '$formadesaida')");

       if($salvar1){

            $mes=Date('m'); $ano=Date('Y');

            if(mysqli_num_rows(mysqli_query($conexao,"SELECT identrada FROM `entradas` where YEAR(datadaentrada)='$ano' and MONTH(datadaentrada)='$mes' and idanolectivo='$idanolectivo'"))==0){

                 $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', 'Controlo', 'Outras', '0', '0', 0, CURRENT_TIMESTAMP, '', '$idanolectivo')");

            }
            
        $acertos[]="Registo de Saída cadastrado com sucesso!";
      }else{
        $erros[]="ocorreu algum erro!";
      } 

}
 
 
 $idanolectivo=mysqli_fetch_array(mysqli_query($conexao, "select idanolectivo from anoslectivos where vigor='Sim'"))['idanolectivo'];

    if(isset($_POST['cadastrarentrada'])){
      
      $descricao=mysqli_escape_string($conexao, trim($_POST['descricao']));  
      $valorapagar=mysqli_escape_string($conexao, trim($_POST['valorapagar']));  
      $valorpago=mysqli_escape_string($conexao, trim($_POST['valorpago']));   
      $formadepagamento=mysqli_escape_string($conexao, trim($_POST['formadepagamento']));   
      
       

      $divida=round(($valorapagar-$valorpago), 2);
         $salvar=mysqli_query($conexao,"INSERT INTO `entradas` (`identrada`, `idaluno`, `idfuncionario`, `descricao`, `tipo`, `valor`, `divida`, `idtipo`, `datadaentrada`, formadepagamento, idanolectivo) VALUES (NULL,0, '$idlogado', '$descricao', 'Outras', '$valorpago', '$divida', 0, CURRENT_TIMESTAMP, '$formadepagamento', '$idanolectivo')");

       if($salvar){
      $acertos[]="Registo de entrada cadastrado com sucesso!";
    }else{
      $erros[]="ocorreu algum erro!";
    } 

}
 
  
            $ano_escolhido=date('Y');
            $mes_escolhido=date('m');
            $dia_escolhido=date('d');
 
      
         
            $saidahoje = mysqli_fetch_array(mysqli_query($conexao,"select sum(valor) from saidas where Date(datadasaida)=DATE_SUB(CURDATE(), INTERVAL 0 DAY)"))[0];

            $totaldeaniversariantes=mysqli_num_rows(mysqli_query($conexao, "select idaluno FROM alunos where MONTH(datadenascimento)=MONTH(curdate())"));

            $totaldeActividades=mysqli_num_rows(mysqli_query($conexao, "select * from agenda where Week(datainicio)=Week(curdate())")); 


             $totaldelembretes=mysqli_num_rows(mysqli_query($conexao, "select * from lembretes where Week(datadolembrete)=Week(curdate())")); 
            
        
              
        

            $anodehoje=date('Y');
  $mesdehoje=date('m');


 


   include("cabecalho.php"); ?>
 
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-500"><?php echo date("d"); echo "/"; echo date("m"); echo "/"; echo date("Y") ;?></h1>

               
          </div>
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

            
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php 

                $numero_de_avaliacoes=mysqli_num_rows(mysqli_query($conexao, "SELECT  iddisciplina from avaliacoes where  YEAR(avaliacoes.data)='$ano_escolhido' and MONTH(avaliacoes.data)='$mes_escolhido'and DAY(avaliacoes.data)='$dia_escolhido' order by avaliacoes.data desc")); 

          ?>
          
    <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
         
      
          <!-- Earnings (Monthly) Card Example -->
          <?php 

                $numerode_relatoriosdiarios=mysqli_num_rows(mysqli_query($conexao, "SELECT  idmatriculaeconfirmacao from relatoriodiario where  YEAR(relatoriodiario.data)='$ano_escolhido' and MONTH(relatoriodiario.data)='$mes_escolhido'and DAY(relatoriodiario.data)='$dia_escolhido' order by relatoriodiario.data desc")); 


          ?>
          
          <div class="col-xl-3 col-md-6 mb-3">
          <a href="relatoriodiariogeral.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&diadevenda=<?php echo "$dia_escolhido"; ?>&mesdevenda=<?php echo "$mes_escolhido"; ?>&anodevenda=<?php echo "$ano_escolhido"; ?>">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Relatório diário de alunos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$numerode_relatoriosdiarios"; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>  </a>
            </div>
          

 


            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-3">
            <a href="disciplinasareapedagogica.php?idanolectivo=<?php echo $anolectivo_cabecalho['idanolectivo']; ?>&funcao=Lançar Faltas">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Lançar Falta</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div> <script>
 
                      </script> 
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>

 
 

        
 
        
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      </div>
      <!-- End of Main Content -->
            </div>
      <!-- End of Main Content -->
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
    
</body>

</html>


<?php

ini_set('display_errors',0); ini_set('display_startup_erros',0); error_reporting(E_ALL);//force php to show any error message
 
 
    backup_tables($hostname,$user,$password,$database);

 
function backup_tables($host,$user,$pass,$name)
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
    $handle = fopen('db_bkp/db-'.$name.'-'.date('Y-m-d').'.sql','w+');//Don' forget to create a folder to be saved, "db_bkp" in this case
    fwrite($handle, $return);
    fclose($handle); 
}?>



 


