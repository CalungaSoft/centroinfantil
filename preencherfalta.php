<?php 
   $dia=$_GET['dia'];
   $mes=$_GET['mes'];
   $ano=$_GET['ano']; 
   
   include("conexao.php");
   
       
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

   
if(isset($_GET['comecaracontar'])){ 
  $idfuncionario=$_GET['idfuncionario']; 
   $guardar=mysqli_query($conexao,"INSERT INTO `contador` (`idfuncionario`,`inicio`) VALUES ('$idfuncionario', CURRENT_TIMESTAMP)");

  if($guardar){
    header("location:preencherfalta.php?dia=$dia&mes=$mes&ano=$ano");
  }
}

   
if(isset($_GET['eliminarfalta'])){ 
  $idfalta=$_GET['idfalta']; 
  $idcontador=$_GET['idcontador']; 
  $editando=mysqli_query($conexao, "DELETE FROM `presenca` WHERE `presenca`.`idfalta` = '$idfalta'"); 
  $editando=mysqli_query($conexao, "DELETE FROM `contador` WHERE idcontador = '$idcontador'"); 
  if($editando){
    header("location:preencherfalta.php?dia=$dia&mes=$mes&ano=$ano");
  }
}

   if(isset($_POST['marcarfalta'])){
    $ano= $_POST['ano'];
    $mes= $_POST['mes'];
    $dia= $_POST['dia']; 
    $remunerar= $_POST['remunerar']; 
    $idfuncionario= $_POST['idfuncionario']; 
    $horasdetrabalho= $_POST['horasdetrabalho'];
    $falta= $_POST['falta'];  
    $salario= $_POST['salario']; 
    $idcontador= $_POST['idcontador']; 

    $enviar =mysqli_query($conexao,"INSERT INTO `presenca` (`idfalta`, `idfuncionario`, `ano`, `dia`, `mes`, `horasdetrabalho`, `falta`, `remunerar`, `salario`,`idcontador`) VALUES (NULL, '$idfuncionario', '$ano', '$dia', '$mes', '$horasdetrabalho', '$falta', '$remunerar', '$salario', '$idcontador')");
                 

}

include("cabecalho.php") ;
 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Presença Diária| <?php echo "$dia / $mes / $ano";  ?></h1>
          <p class="mb-4">Abaixo vai lista dos funcionários</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Presença diária | <a href="editarfalta.php?dia=<?php echo  $dia; ?>&mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>"><i title="Editar dados da tabela de presença|falta" class="fas fa-edit text-primary-300" > EDITAR</i> </a> <a href="presenca.php?dia=<?php echo  $dia; ?>&mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>"><i title="Voltar para a página anterior (Mapa de Presença)" class="fas fa- text-primary-300" > Voltar</i> </a></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <p>Escolha a opção e em seguida clique em guardar</p>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr> 
                      <th>Funcionário</th> 
                      <th>Ausência</th>
                      <th>Hora de Trabalho</th>
                      <th href="Deixe a caixa selecionada caso o funcionário será remunerado, caso contrário, desselecione-a.">Remunerar?</th>
                      <th>Salário/horas</th>
                      <th>Guardar</th>
                    </tr> 
                  </thead> 
                  <tbody>
                  <?php
                  $listadefuncionários=mysqli_query($conexao,"SELECT * FROM funcionarios"); 
                   while($exibir = $listadefuncionários->fetch_array()){ 
                     $idfuncionario=$exibir['idfuncionario'];
                     $salariodofuncionario=$exibir['salario'];
                     $falta=mysqli_fetch_array(mysqli_query($conexao,"SELECT idfalta, falta, horasdetrabalho, remunerar, salario, idcontador FROM presenca where idfuncionario='$idfuncionario' and ano='$ano' and dia='$dia' and mes='$mes' limit 1")); 
                    ?>
                    <tr>
                          <td><a href="funcionario.php?id=<?php echo $idfuncionario; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td>
                      
                          <td>  <?php if($falta==null) { ?>
                              <form class="user" action="" method="post"> 
                                    <select name="falta"   title="Escolha aqui o tipo de ausência que quer aplicar para cada funcionário, caso o funcionário esteja presente, então não precisa alterar essse"  >
                                        <option selected="" value="P">Presente</option>
                                        <option value=02>02| Doença Especial c/ remuneração</option>
                                        <option  value=12>12| Licença s/vencimento</option>
                                        <option value=13>13| Falta por doença c/remuneração</option>
                                        <option value=21>21| Falta justificada c/remuneração</option>
                                        <option value=22>22| Licença de Materninadade</option>
                                        <option value=67>67| Falta Justificada s/remuneração</option>
                                        <option value=68>68| Falta injustificada s/remuneraçao</option>
                                        <option value=69>69| Falta por Doença s/ remuneração</option>
                                        <option value=70>70| Dias de férias c/remuneração</option>
                                        <option value=72>72| Meia falta justificada s/ remuneração</option>
                                        <option value=73>73| Meia Falta injustificada s/remuneração</option>
                                        <option value=79>79| Dia de interrupção de serviço</option>
                                </select>   <?php } else echo $falta["falta"] ; ?>
                        </td>
                        <td>  <?php 
                        $reservarvaga=mysqli_fetch_array(mysqli_query($conexao, "select idcontador from contador where idfuncionario='$idfuncionario' and '$ano'=YEAR(inicio) AND '$mes'=MONTH(inicio) and '$dia'=DAY(inicio) limit 1"))[0]; 
                         $totaldehoras=0;
                        if($falta==null && $reservarvaga!="") {
                          $hoje=date("Y-m-d H:i:s");
                          $totaldehoras=mysqli_fetch_array(mysqli_query($conexao," SELECT TIMESTAMPDIFF(HOUR,inicio,'$hoje') FROM contador where idcontador='$reservarvaga'"))[0]-1;
                          echo "$totaldehoras Hora(s) Trabalhadas";
                          ?> 
                             <input type="hidden" name="horasdetrabalho" value="<?php echo $totaldehoras; ?>">
                             <input type="hidden" name="idcontador" value="<?php echo $reservarvaga; ?>">
                        <?php } else if($falta==null && $reservarvaga==""){?>
                          <input type="hidden" name="horasdetrabalho" value="0">
                          <input type="hidden" name="idcontador" value="0">
                          <?php $anodehoje=date('Y'); $mesdehoje=date('m'); $diadehoje=date('d'); if($dia==$diadehoje && $ano==$anodehoje && $mes==$mesdehoje){?>
                          <a href="preencherfalta.php?dia=<?php echo  $dia; ?>&mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>&comecaracontar=sim&idfuncionario=<?php echo $idfuncionario; ?>" title="Pôr o cronômetro de presença a contar"><i style="color:green;" class="fas fa-fw fa-play"></i></a>
                          <?php } ?>
                        <?php } else if($falta!=null) echo $falta["horasdetrabalho"] ;  ?>
                        </td>
                        <td> <?php if($falta==null) { ?>
                              <select name="remunerar"   title="Escolha ser que ou não remunerar esse funcionário por esse dia"  >
                                  <option value=1>Remunerar</option>
                                  <option  value=0>Não Remunerar</option> 
                              </select> <?php } else { if($falta["remunerar"]==0){ echo "Não" ;}else{ echo "Sim";} } ?>
                        </td>
                        <input type="hidden" name="idfuncionario" value="<?php echo $idfuncionario; ?>">
                        <input type="hidden" name="salario" value="<?php echo $salariodofuncionario; ?>">
                        <input type="hidden" name="dia" value="<?php echo $dia; ?>">
                        <input type="hidden" name="mes" value="<?php echo $mes; ?>">
                        <input type="hidden" name="ano" value="<?php echo $ano; ?>">
                        <td><strong><?php $n=number_format($salariodofuncionario,2,",", "."); echo $n; ?> Kz</strong></td>
                        <td><?php if($falta==null) { ?><button type="submit" name="marcarfalta"><i title="Guardar registro de presença" class="fas fa-fw fa-save"></i></button><?php } 
                        else { ?><a href="editarfalta.php?dia=<?php echo  $dia; ?>&mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>" title="Editar Registro de Presença"><i style="color:green;"  class="fas fa-edit"></i></a>
                                 <a href="preencherfalta.php?dia=<?php echo  $dia; ?>&mes=<?php echo  $mes; ?>&ano=<?php echo  $ano; ?>&idfalta=<?php echo  $falta["idfalta"]; ?>&idcontador=<?php echo  $falta["idcontador"]; ?>&eliminarfalta=calungaSOFT" title="Eliminar Registro de Presença"><i style="color:red;" class="fas fa-fw fa-trash"></i></a>
                                  <?php } ?></td>
                            
                   </form>
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
