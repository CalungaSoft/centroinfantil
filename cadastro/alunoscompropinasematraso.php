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

  $dadosdoanolectivo = mysqli_fetch_array(mysqli_query($conexao,"SELECT MONTH(datainicio) as mesinicio, MONTH(datafimexame) as mesfim, YEAR(datainicio) as anoinicio, YEAR(datafimexame) as anofim, anoslectivos.* from anoslectivos where  idanolectivo='$idanolectivo'"));

 $meses=[];
                $valormes=[];

                 $alunos_com_propinas_ematraso=[];
                 $alunos_com_propinas_pagas=[];
                 $alunos_inactivos=[];

                $listadeanos=[];

                   $anoactual=date('Y');
                   $mesactual=date('m');


                $mesinicio_anolectivo=$dadosdoanolectivo["mesinicio"];
                $mesfim_anolectivo=$dadosdoanolectivo["mesfim"];

                $anoinicio_anolectivo=$dadosdoanolectivo["anoinicio"];
                $anofim_anolectivo=$dadosdoanolectivo["anofim"];


                 $numero_de_meses_normal=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafim) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                 $numero_de_meses_exame=mysqli_fetch_array( mysqli_query($conexao,"SELECT TIMESTAMPDIFF(MONTH,datainicio,datafimexame) as numero  from anoslectivos where idanolectivo='$idanolectivo'"))[0];

               
                 $contador_normal=0;
                 $contador_exame=0;

                  for ($i=$mesinicio_anolectivo; $i <=12 ; $i++) { 
                        
                                    

                                   
                                    $mes=$i;
                                    $ano=$anoinicio_anolectivo;

  
                                   
 
                                 
                                    $data_de_cadastro_formada="$ano-$i-31"; //2021-08-31
                                    $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                                
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"));

                                    }


                                    $alunos_com_propinas_ematraso[]=$emfalta_normal+$emfalta_exame;




                                     $contador_normal++; $contador_exame++;

                                   

                                   if($mes==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($mes==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($mes==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($mes==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($mes==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($mes==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($mes==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($mes==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($mes==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($mes==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($mes==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($mes==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                          }



                               if($anoinicio_anolectivo!=$anofim_anolectivo){



                                    for ($i=1; $i <=$mesfim_anolectivo ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anofim_anolectivo;


                                     

                                     $data_de_cadastro_formada="$ano-$i-31"; //2022-01-31
                                      $data_de_propina_formada="$ano-$i-01"; // 2021-08-01

                                   
  
 
                                    
                                    $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim'"));

                                    }


                                    $alunos_com_propinas_ematraso[]=$emfalta_normal+$emfalta_exame;




                                     $contador_normal++; $contador_exame++;

                                   

                                       
                                   if($mes==1){
                                       
                                        if($ano!=$anoactual){
                                          $meses[]="Janeiro/".$ano."";
                                        }else{
                                          $meses[]="Janeiro";
                                        }
                                   }else  if($mes==2){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Fevereiro/".$ano."";
                                      }else{
                                           $meses[]="Fevereiro";
                                      }
                                  }else  if($mes==3){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Março/".$ano."";
                                      }else{
                                         $meses[]="Março";
                                      }
                                  } else if($mes==4){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Abril/".$ano."";
                                      }else{
                                          $meses[]="Abril";
                                      }
                                  } else if($mes==5){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Maio/".$ano."";
                                      }else{
                                         $meses[]="Maio";
                                      }
                                  } else if($mes==6){
                                    
                                      if($ano!=$anoactual){
                                          $meses[]="Junho/".$ano."";
                                      }else{
                                          $meses[]="Junho";
                                      }
                                  } else if($mes==7){
                                      
                                      if($ano!=$anoactual){
                                          $meses[]="Julho/".$ano."";
                                      }else{
                                        $meses[]="Julho";
                                      }
                                  } else if($mes==8){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Agosto/".$ano."";
                                      }else{
                                         $meses[]="Agosto";
                                      }
                                  } else if($mes==9){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Setembro/".$ano."";
                                      }else{
                                         $meses[]="Setembro";
                                      }
                                  } else if($mes==10){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Outubro/".$ano."";
                                      }else{
                                         $meses[]="Outubro";
                                      }
                                  } else if($mes==11){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Novembro/".$ano."";
                                      }else{
                                         $meses[]="Novembro";
                                      }
                                  } else if($mes==12){
                                     
                                      if($ano!=$anoactual){
                                          $meses[]="Dezembro/".$ano."";
                                      }else{
                                         $meses[]="Dezembro";
                                      }
                                  } 


                                    }

                            }
                              
                               


                              
                               

 $htm='

                <h2>Alunos Com Propinas Em atraso   <a href="pdf/pdfalunoscompropinasematraso.php?idanolectivo='.$idanolectivo.'" class="d-sm-inline-block btn btn-sm btn-info" ><i class="fas fa-fw fa-print"></i> Imprimir </a>  </h2> 

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>Ciclo</th>
                      <th>Turma</th>';
 

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
                              <td><a href="turma.php?idturma='.$idturma.'">'.$exibir["titulo"].'</a> -- <a title="Imprimir lista de devedores do mês de  '.$mesactual.'/'.$anoactual.'"  href="pdf/propinasematrasotodos.php?idturma='.$idturma.'&anodevenda='.$anoactual.'&mesdevenda='.$mesactual.'" ><i  class="fas fa-print" ></i> </a></td> '; 
                                 

                 $contador_normal=0;
                 $contador_exame=0;
                                for ($i=$mesinicio_anolectivo; $i <=12 ; $i++) { 

                                    
                                   
                                    $mes=$i;
                                    $ano=$anoinicio_anolectivo;

   

                                      $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31
                                      $data_de_propina_formada="$ano-$mes-01"; // 2021-08-01



                                        

                                             $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não' and matriculaseconfirmacoes.idturma='$idturma'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim' and matriculaseconfirmacoes.idturma='$idturma' "));

                                    }


                                    $numerodealunos=$emfalta_normal+$emfalta_exame;


                                    $contador_normal++; $contador_exame++; 
                                        

                                           
                                       $htm.='<td  >'.$numerodealunos.'</td>'; 

 
                                          

                                       
                                  }



                           if($anoinicio_anolectivo!=$anofim_anolectivo){

                          
                                    for ($i=1; $i <=$mesfim_anolectivo ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anofim_anolectivo;


                                     $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31
                                      $data_de_propina_formada="$ano-$mes-01"; // 2021-08-01



                                        

                                             $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não' and matriculaseconfirmacoes.idturma='$idturma'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim' and matriculaseconfirmacoes.idturma='$idturma' "));

                                    }


                                    $numerodealunos=$emfalta_normal+$emfalta_exame;


                                    $contador_normal++; $contador_exame++;
 
          
          
                                             

                                          

                                        

                                           
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
 
                             $contador_normal=0;
                 $contador_exame=0;
                                for ($i=$mesinicio_anolectivo; $i <=12 ; $i++) { 

                                    $previsao_normal=0; $previsao_exame=0;
                        
                                    

                                   
                                    $mes=$i;
                                    $ano=$anoinicio_anolectivo;

   

                                      $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31
                                      $data_de_propina_formada="$ano-$mes-01"; // 2021-08-01



                                        

                                             $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não' and idciclo='$idciclo'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim' and idciclo='$idciclo'"));

                                    }


                                    $numerodealunos=$emfalta_normal+$emfalta_exame;


                                    $contador_normal++; $contador_exame++;
 
          
           

                                          

                                        

                                           
                                       $htm.='<td  >'.$numerodealunos.'</td>'; 

 
                                          

                                       
                                  }



                           if($anoinicio_anolectivo!=$anofim_anolectivo){
 

                                    for ($i=1; $i <=$mesfim_anolectivo ; $i++) { 
                                 

                                    $mes=$i;
                                    $ano=$anofim_anolectivo;


                                     $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31
                                      $data_de_propina_formada="$ano-$mes-01"; // 2021-08-01



                                        

                                             $emfalta_exame=0;  $emfalta_normal=0;

                                     if($contador_normal<=$numero_de_meses_normal){

                                       $emfalta_normal=mysqli_num_rows( mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Não' and idciclo='$idciclo'"));

                                    }


                                     if($contador_exame<=$numero_de_meses_exame){

                                       $emfalta_exame=mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and   matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and matriculaseconfirmacoes.estatus='activo' and matriculaseconfirmacoes.ultimomespago<'$data_de_propina_formada' and matriculaseconfirmacoes.tipodealuno!='Bolseiro' and turmas.eclassedeexame='Sim' and idciclo='$idciclo' "));

                                    }


                                    $numerodealunos=$emfalta_normal+$emfalta_exame;


                                    $contador_normal++; $contador_exame++;
 
          
          
                                             

                                          

                                        

                                           
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


                                foreach ($alunos_com_propinas_ematraso as $key => $value) {
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
