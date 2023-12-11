 
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

 

$diav=date('d');
$mesv=date('m');
$anov=date('Y'); 


$hoje=date('d');
 


                   $anoactual=date('Y');
                   $mesactual=date('Y');

$idanolectivo=mysqli_escape_string($conexao, trim($_GET['idanolectivo'])); 



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
                              
                               

 



$dia=date('d');  
    $mes_actual=date('m');  
    $ano_actual=date('Y'); 
    if($mes_actual==1) 
    $mes_actual="Janeiro"; 
    else if($mes_actual==2) 
    $mes_actual="Fevereiro"; 
    else if($mes_actual==3) 
    $mes_actual="Março"; 
    else if($mes_actual==4) 
    $mes_actual="Abril"; 
    else if($mes_actual==5) 
    $mes_actual="Maio"; 
    else if($mes_actual==6) 
    $mes_actual="Junho"; 
    else if($mes_actual==7) 
    $mes_actual="Julho"; 
    else if($mes_actual==8) 
    $mes_actual="Agosto"; 
    else if($mes_actual==9) 
    $mes_actual="Setembro"; 
    else if($mes_actual==10) 
    $mes_actual="Outubro"; 
    else if($mes_actual==11) 
    $mes_actual="Novembro"; 
    else if($mes_actual==12) 
    $mes_actual="Dezembro"; 


    $dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

       $gerador=new DOMPDF(["chroot" => __DIR__]);  
        $htm=' 
        <style>#assinatura {text-align:center;}  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div>
                <p style="font-size: 20px; margin-left:70px">
                República de Angola <br>
                Ministério da Educação <br>
                 <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                </p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> Alunos Com Propinas Em Atraso | <strong>'.$dadosdoanolectivo["titulo"].'</strong> </span>
            <br> <br>   ';

            $htm.=' 

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">Ciclo</th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">Turma</th>';
 

                        foreach ($meses as $key => $value) {
                               $htm.='<th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$value.'</th>';  
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
                              <td width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$exibir_ciclo["titulo"].'</td> 
                              <td width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$exibir["titulo"].'</td> '; 
                                 

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
                                        

                                           
                                       $htm.='<td  width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$numerodealunos.'</td>'; 

 
                                          

                                       
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
 
          
          
                                             

                                          

                                        

                                           
                                       $htm.='<td  width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$numerodealunos.'</td>'; 

 
                                          

                                       
                                  }
                                }
                                   
                            $htm.='
                            
                       
                    </tr> 
                    ';

                  }  

                  $htm.='

                          <tr>
                            <th width="auto" style="border: 1px solid; border-spacing:0px" align="center"> Total </th>
                            <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$exibir_ciclo["titulo"].'</th>   
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
 
          
           

                                          

                                        

                                           
                                       $htm.='<td  width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$numerodealunos.'</td>'; 

 
                                          

                                       
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
 
          
          
                                             

                                          

                                        

                                           
                                       $htm.='<td  width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$numerodealunos.'</td>'; 

 
                                          

                                       
                                  }
                                }
                                  
 

                     $htm.='
                      
                    </tr> ';

                    }  

                    $htm.='
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">Total  </th>
                              <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">Todos Ciclos</th>   
                               ';


                                foreach ($alunos_com_propinas_ematraso as $key => $value) {
                                       $htm.='<th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$value.'</th>';  
                                    } 

                             $htm.='
                                       
                            </tr>
                   </tfoot>
                </table>';
 
  $htm.=" 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes_actual."  de  ".$ano_actual." .</b>
             </p>


<br> 

             <p id=assinatura>O Director Geral <br>
___________________________ <br>
    ".$dadosdainstituicao['nomedodireitor']."
</p>
        </div>
        ";

   $gerador->load_html($htm); 
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Alunos com propinas Pagas - CalungaSOFT.pdf",
            array(
                "attachment" => true
            )
        );
    ?>