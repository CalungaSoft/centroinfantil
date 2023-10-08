 
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

$dia=date('d');  
    $mes=date('m');  
    $ano=date('Y'); 
    if($mes==1) 
    $mes="Janeiro"; 
    else if($mes==2) 
    $mes="Fevereiro"; 
    else if($mes==3) 
    $mes="Março"; 
    else if($mes==4) 
    $mes="Abril"; 
    else if($mes==5) 
    $mes="Maio"; 
    else if($mes==6) 
    $mes="Junho"; 
    else if($mes==7) 
    $mes="Julho"; 
    else if($mes==8) 
    $mes="Agosto"; 
    else if($mes==9) 
    $mes="Setembro"; 
    else if($mes==10) 
    $mes="Outubro"; 
    else if($mes==11) 
    $mes="Novembro"; 
    else if($mes==12) 
    $mes="Dezembro"; 


    $dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));

        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php'; 

        $gerador=new DOMPDF(); 
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
               
                    <span style="font-size: 15px; margin-left:30px"> Alunos Activos| <strong>'.$dadosdoanolectivo["titulo"].'</strong> </span>
            <br> <br>   ';

           $htm.='

              
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px" >Ciclo</th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px" >Turma</th>';

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
                              <td width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir_ciclo["titulo"].'</td> 
                              <td width="auto" style="border: 1px solid; border-spacing:0px"> '.$exibir["titulo"].'</td> '; 
                                 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and estatus='activo' order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                             $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 



                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and  matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and idturma='$idturma' and estatus='activo'"));
 
          
          
                                            $total+=$numerodealunos;

                                            $total_alunos_por_ciclo+=$numerodealunos;

                                        

                                           
                                       $htm.='<td width="auto" style="border: 1px solid; border-spacing:0px" align="center" >'.$numerodealunos.'</td>'; 


                                    } 

                                          

                                       
                                  }

                                   
                            $htm.='
                            
                       
                    </tr> 
                    ';

                  }  

                  $htm.='

                          <tr>
                            <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$exibir_ciclo["titulo"].' - Total </th>
                            <th width="auto" style="border: 1px solid; border-spacing:0px" align="center"></th>   
                         ';
 

                                  foreach ($listadeanos as $key => $value) {
                                   

                                        $ano=$value;

                                      $lista=mysqli_query($conexao,"SELECT DISTINCT(MONTH(data)), MONTH(data) as mes  from matriculaseconfirmacoes where  idanolectivo='$idanolectivo' and YEAR(data)='$ano' and estatus='activo'  order by data asc ");

                                       
                                    
                                    while($exibir_mes = $lista->fetch_array()){ 
                                            

                                            $mes=$exibir_mes["mes"];

                                                $data_de_cadastro_formada="$ano-$mes-31"; //2021-08-31 




                                            $numerodealunos = mysqli_num_rows(mysqli_query($conexao,"SELECT idmatriculaeconfirmacao from matriculaseconfirmacoes, turmas where matriculaseconfirmacoes.idturma=turmas.idturma and   matriculaseconfirmacoes.idanolectivo='$idanolectivo' and matriculaseconfirmacoes.data<='$data_de_cadastro_formada' and turmas.idciclo='$idciclo' and estatus='activo'"));

                                          
           
                                         
                                          
                                       $htm.='<td width="auto" style="border: 1px solid; border-spacing:0px" align="center" >'.$numerodealunos.'</td>'; 


                                    } 

                                          

                                       
                                  }
 

                     $htm.='
                      
                    </tr> ';

                    }  

                    $htm.='
                   </tbody> 

                   <tfoot>
                            <tr>
                              <th width="auto" style="border: 1px solid; border-spacing:0px" align="center">Total todos Cíclos</th>
                              <th width="auto" style="border: 1px solid; border-spacing:0px" align="center"></th>   
                               ';


                                foreach ($valormes_total as $key => $value) {
                                       $htm.='<th width="auto" style="border: 1px solid; border-spacing:0px" align="center">'.$value.'</th>';  
                                    } 

                             $htm.='
                                       
                            </tr>
                   </tfoot>
                </table>
 ';
 
  $htm.=" 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
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
            "Alunos Activos - CalungaSOFT.pdf",
            array(
                "attachment" => true
            )
        );
    ?>