<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

                   $anoactual=date('Y');
                   $mesactual=date('m');

$idanolectivo=mysqli_escape_string($conexao, trim($_POST['idanolectivo'])); 


 $htm='

                <h2>Alunos Activos   <a href="pdf/pdfalunosactivos.php?idanolectivo='.$idanolectivo.'" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir </a>  </h2> 

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Ciclo</th>
                      <th>Turma</th>';

                      $listadeanos=[];
                      $meses=[];
                      $valormes_total=[];

                      $lista_anos=mysqli_query($conexao,"SELECT DISTINCT(YEAR(data)), YEAR(data) as ano from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and estatus='activo' order by data asc"); 
                            
                            while($mostrarano = $lista_anos->fetch_array()){ 

                                $ano=$mostrarano['ano'];

                                  $listadeanos[]=$ano;

                                  $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano'and estatus='activo'  order by data asc ");
                            
                                        while($exibir = $lista->fetch_array()){ 
                                    

                                                          $mes=$exibir["mes"];

                                    $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 


                                      $valormes_total[] = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and matriculaseconfirmacoes.data<='$data_de_cadastro_formada'  and estatus='activo'"));

                                                          if($exibir['mes']==1){
                                                             
                                                              if($ano!=$anoactual){
                                                                $meses[]="Janeiro/".$ano."";
                                                              }else{
                                                                $meses[]="Janeiro";
                                                              }
                                                         }else  if($exibir['mes']==2){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Fevereiro/".$ano."";
                                                            }else{
                                                                 $meses[]="Fevereiro";
                                                            }
                                                        }else  if($exibir['mes']==3){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Março/".$ano."";
                                                            }else{
                                                               $meses[]="Março";
                                                            }
                                                        } else if($exibir['mes']==4){
                                                          
                                                            if($ano!=$anoactual){
                                                                $meses[]="Abril/".$ano."";
                                                            }else{
                                                                $meses[]="Abril";
                                                            }
                                                        } else if($exibir['mes']==5){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Maio/".$ano."";
                                                            }else{
                                                               $meses[]="Maio";
                                                            }
                                                        } else if($exibir['mes']==6){
                                                          
                                                            if($ano!=$anoactual){
                                                                $meses[]="Junho/".$ano."";
                                                            }else{
                                                                $meses[]="Junho";
                                                            }
                                                        } else if($exibir['mes']==7){
                                                            
                                                            if($ano!=$anoactual){
                                                                $meses[]="Julho/".$ano."";
                                                            }else{
                                                              $meses[]="Julho";
                                                            }
                                                        } else if($exibir['mes']==8){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Agosto/".$ano."";
                                                            }else{
                                                               $meses[]="Agosto";
                                                            }
                                                        } else if($exibir['mes']==9){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Setembro/".$ano."";
                                                            }else{
                                                               $meses[]="Setembro";
                                                            }
                                                        } else if($exibir['mes']==10){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Outubro/".$ano."";
                                                            }else{
                                                               $meses[]="Outubro";
                                                            }
                                                        } else if($exibir['mes']==11){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Novembro/".$ano."";
                                                            }else{
                                                               $meses[]="Novembro";
                                                            }
                                                        } else if($exibir['mes']==12){
                                                           
                                                            if($ano!=$anoactual){
                                                                $meses[]="Dezembro/".$ano."";
                                                            }else{
                                                               $meses[]="Dezembro";
                                                            }
                                                        } 


                                  }

                           }

                       

                        foreach ($meses as $key => $value) {
                               $htm.='<th>'.$value.'</th>';  
                            } 

                     $htm.='    
                    </tr>
                  </thead> 
                  <tbody>';


                  $litadeciclos=mysqli_query($conexao,"SELECT * from ciclos order by idciclo desc");
                      
                    
                   $listade_ciclos=[];
                   while($exibir_ciclo = $litadeciclos->fetch_array()){

                    $idciclo=$exibir_ciclo["idciclo"];
                    $titulo_do_ciclo=$exibir_ciclo["titulo"];

                    $listade_ciclos[$idciclo]=$titulo_do_ciclo;

                     
                     $total_alunos_por_ciclo=0;

                   

                        $alunoscadastrados_nas_turmas=mysqli_query($conexao,"SELECT * from turmas where  idanolectivo='$idanolectivo' and idciclo='$idciclo'");
                        

                           
  
                           while($exibir = $alunoscadastrados_nas_turmas->fetch_array()){

                                $idturma=$exibir["idturma"];

                                $total=0;
 
                               
                             $htm.='

                            <tr>
                              <td><a href="ciclo.php?idciclo='.$exibir_ciclo["idciclo"].'">'.$exibir_ciclo["titulo"].'</a></td> 
                              <td><a href="turma.php?idturma='.$idturma.'">'.$exibir["titulo"].'</a></td> '; 
                                 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and estatus='activo' order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                             $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 



                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and  matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and idturma='$idturma' and estatus='activo'"));
 
          
          
                                            $total+=$numerodealunos;

                                            $total_alunos_por_ciclo+=$numerodealunos;

                                        

                                           
                                       $htm.='<td  >'.$numerodealunos.'</td>'; 


                                    } 

                                          

                                       
                                  }

                                   
                            $htm.='
                            
                       
                    </tr> 
                    ';

                  }  

                  $htm.='

                          <tr>
                            <th>'.$exibir_ciclo["titulo"].' - Total </th>
                            <th></th>   
                         ';
 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and estatus='activo'  order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                                $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 




                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo' and matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and turmas.idciclo='$idciclo' and estatus='activo'"));

                                          
           
                                         
                                          
                                       $htm.='<td  >'.$numerodealunos.'</td>'; 


                                    } 

                                          

                                       
                                  }
 

                     $htm.='
                      
                    </tr> ';

                    }  

                    $htm.='
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th>Total todos Cíclos</th>
                              <th></th>   
                               ';


                                foreach ($valormes_total as $key => $value) {
                                       $htm.='<th>'.$value.'</th>';  
                                    } 

                             $htm.='
                                       
                            </tr>
                   </tfoot>
                </table>


  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>';


  

                echo "$htm";

                ?>
