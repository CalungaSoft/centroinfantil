 <?php


$htm='  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Funcionário</th>  
                      <th>Aluno</th>  
                      <th>Descrição</th>  
                      <th>Categoria</th>
                      <th>Valor</th>
                      <th>Dívida</th>
                      <th>Data</th>
                      <th>Opção</th> 
                    </tr>
                  </thead> 
                  <tbody>
                  <?php
             
                        if(!isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado'])){
                          $registrosdeentradas=mysqli_query($conexao, "select entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios where funcionarios.idfuncionario=entradas.idfuncionario order by entradas.identrada desc");
                        }
                       else if(isset($_GET['mesdevenda']) && isset($_GET['tipomarcado'])){ 
                        $registrosdeentradas=mysqli_query($conexao, "select  entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios  where '$anodevenda'=YEAR(entradas.datadaentrada) AND '$mesdevenda'=MONTH(entradas.datadaentrada) and entradas.tipo='$tipomarcado' and funcionarios.idfuncionario=entradas.idfuncionario order by entradas.identrada desc");
                      }
                       else if(!isset($_GET['mesdevenda']) && isset($_GET['tipomarcado'])){
                        $registrosdeentradas=mysqli_query($conexao, "select  entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios  where entradas.tipo='$tipomarcado' and funcionarios.idfuncionario=entradas.idfuncionario order by entradas.identrada desc");
                      }
                       else  if(isset($_GET['mesdevenda']) && !isset($_GET['tipomarcado'])){
                        $registrosdeentradas=mysqli_query($conexao, "select  entradas.*, funcionarios.nomedofuncionario from entradas, funcionarios  where '$anodevenda'=YEAR(entradas.datadaentrada) AND '$mesdevenda'=MONTH(entradas.datadaentrada) and funcionarios.idfuncionario=entradas.idfuncionario order by entradas.identrada desc");
                      }
                      
 
                   while($exibir = $registrosdeentradas->fetch_array()){
                   
                    $idaluno=$exibir["idaluno"];
                  
                 
                   $nomecompleto=mysqli_fetch_array(mysqli_query($conexao,"SELECT  nomecompleto  FROM alunos where idaluno='$idaluno'"))[0]; 

                      ?>

                    <tr>
                      <td><a href="funcionario.php?idfuncionario=<?php echo $exibir['idfuncionario']; ?>"><?php echo $exibir['nomedofuncionario']; ?></a></td> 
                      <td><a href="aluno.php?idaluno=<?php echo $exibir['idaluno']; ?>"><?php echo $nomecompleto; ?></a></td> 
                      
                      <td  <?php if($exibir["tipo"]=="Outras"){?>  contenteditable <?php } ?> ><?php echo $exibir["descricao"]; ?></td> 
                      <td><?php echo $exibir["tipo"]; ?></td>
                      <td  <?php if($exibir["tipo"]=="Outras"){?>  contenteditable <?php } ?>  title="<?php  $valor=number_format($exibir["valor"],2,",", ".");  echo $valor; ?>"><?php echo $exibir["valor"]; ?></td>
                      <td <?php if($exibir["tipo"]=="Outras"){?>  contenteditable <?php } ?>  title="<?php  $divida=number_format($exibir["divida"],2,",", "."); echo $divida; ?>"><?php echo $exibir["divida"]; ?></td>
                      <td><?php echo $exibir["datadaentrada"]; ?></td>
                      <td>
                      <?php  
                        if (($exibir["tipo"]=="Propina") && $exibir["idtipo"]==0) { ?>
                          <a href="entradapropina.php?=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php }  
                        if ($exibir["tipo"]=="Confirmação") { ?>
                          <a href="entradareconfirmacao.php?identrada=<?php echo $exibir["identrada"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php }
                        if ($exibir["tipo"]=="Matrícula") { ?>
                          <a href="entradamatricula.php?identrada=<?php echo $exibir["identrada"]; ?>&idaluno=<?php echo $exibir["idaluno"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                        if ($exibir["tipo"]=="Material Escolar") { ?>
                          <a href="detalhesdacompra.php?idtipo=<?php echo $exibir["idtipo"]; ?>&idaluno=<?php echo $exibir["idaluno"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 

                       if ($exibir["tipo"]=="Inserção no Sistema") { ?>
                          <a href="insercao.php?identrada=<?php echo $exibir["identrada"]; ?>&idaluno=<?php echo $exibir["idaluno"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 


                       if ($exibir["tipo"]=="Outras") { ?>
                          <a href="entradasoutras.php?identrada=<?php echo $exibir["identrada"]; ?>&idaluno=<?php echo $exibir["idaluno"]; ?>"><i title="Visualizar essa Entrada" class="fas fa-eye"></i></a>
                       <?php } 
                        ?>
                           
                     
                      
                     </td>
                    </tr> 
                   <?php }    ?>
                   </tbody> 
                </table>



                ';


                echo $htm;


        ?>