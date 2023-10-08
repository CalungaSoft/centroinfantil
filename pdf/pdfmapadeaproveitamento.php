 
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
   
$idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"0"; 
 
 
     
 
    $dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from trimestres where idtrimestre='$idtrimestre'"));
    $nomedotrimestre=$dadosdotrimestre["titulo"];

 
                           $idanolectivo=$dadosdotrimestre["idanolectivo"];
 
                         
                           $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from anoslectivos where idanolectivo='$idanolectivo'"));

                           $anolectivo=$dadosdoanolectivo["titulo"];
 
 



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
        $minipauta=' 
        <style>#assinatura {text-align:center;}  #centro{text-align: center;} figure {margin-top:-20px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div> 
                <figure>
                    <img src="img/logo.png"> 
                </figure>
            </div>
                <p style="font-size: 20px; margin-left:70px">
                República de Angola <br>
                Ministério da Educação <br>
                 <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                </p> 
                <hr><hr> 
               
                <span style="font-size: 20px; margin-left:50px"> Mapa de Aproveitamento Da Escola   |   <strong>'.$nomedotrimestre.' Trimestre |  Ano Lectivo: <strong>'.$anolectivo.'</strong></span>
        <br> <br>  ';

       
           
        $minipauta.='

        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
              <th width="auto" style="border: 1px solid; border-spacing:0px" rowspan="2">Ciclo</th>
              <th width="auto" style="border: 1px solid; border-spacing:0px" rowspan="2">Turma</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="2">Matriculados</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="2">Desistentes</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="2">Avaliados</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="3" title="Com Aproveitamento">C/Aproveitamento</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="3" title="Sem Aproveitamento">S/Aproveitamento</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" colspan="2">Nº de Prof.</th>
            </tr>
             <tr>
               
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino + Femenino" >MF</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Femenino">F</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino + Femenino">MF</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Femenino">F</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino + Femenino">MF</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Femenino">F</th>  
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino + Femenino">MF</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Femenino">F</th>  
              <th width="auto" style="border: 1px solid; border-spacing:0px">%</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino + Femenino">MF</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px" title="Femenino">F</th>  
              <th width="auto" style="border: 1px solid; border-spacing:0px">%</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px">Nº</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px">Aux</th>    
            </tr>
          </thead> 
          <tbody>';

                $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
                
                $arredondarmedia=mysqli_fetch_array(mysqli_query($conexao," SELECT arredondarmedia FROM mediasdoano where idanolectivo='$idanolectivo' and idtrimestre='$idtrimestre' limit 1 "))[0];




                $numero_de_ciclos=0;

          $litadeciclos=mysqli_query($conexao,"SELECT * from ciclos order by idciclo desc");
              
            
           $listade_ciclos=[];

           $total_ciclo_matriculado=0;
           $total_ciclo_matriculado_femenino=0;

           $total_ciclo_desistente=0;
           $total_ciclo_desistente_femenino=0;

           $total_ciclo_avaliado=0;
           $total_ciclo_avaliado_femenino=0;

           $total_ciclo_com_aproveitamento=0;
           $total_ciclo_com_aproveitamento_femenino=0;
           $total_ciclo_com_aproveitamento_percentagem=0;


           $total_ciclo_sem_aproveitamento=0;
           $total_ciclo_sem_aproveitamento_femenino=0;
           $total_ciclo_sem_aproveitamento_percentagem=0;

          while($exibir_ciclo = $litadeciclos->fetch_array()){

            $numero_de_ciclos++;

           $ciclo_matriculado=0;
           $ciclo_matriculado_femenino=0;

           $ciclo_desistente=0;
           $ciclo_desistente_femenino=0;

           $ciclo_avaliado=0;
           $ciclo_avaliado_femenino=0;

           $ciclo_com_aproveitamento=0;
           $ciclo_com_aproveitamento_femenino=0;
           $ciclo_com_aproveitamento_percentagem=0;


           $ciclo_sem_aproveitamento=0;
           $ciclo_sem_aproveitamento_femenino=0;
           $ciclo_sem_aproveitamento_percentagem=0;


            $idciclo=$exibir_ciclo["idciclo"];
            $titulo_do_ciclo=$exibir_ciclo["titulo"];

            $listade_ciclos[$idciclo]=$titulo_do_ciclo;

             
             $total_alunos_por_ciclo=0;

           

                $alunoscadastrados_nas_turmas=mysqli_query($conexao,"SELECT * from turmas where  idanolectivo='$idanolectivo' and idciclo='$idciclo'");

                $numero_de_turmas=0;
                

                   

                   while($exibir_turma = $alunoscadastrados_nas_turmas->fetch_array()){

                    $numero_de_turmas++;

                        $idturma=$exibir_turma["idturma"];

                         $minimoparapositiva=$exibir_turma["minimoparapositiva"];  

                        $numerodepositivasdaturma_masculino=0;
                        $numerodenegativasdaturma_femenino=0;

                        $numerodepositivasdaturma_femenino=0;
                        $numerodenegativasdaturma_masculino=0;


                        $numerode_nao_avaliados=0;
                        $numerode_nao_avaliados_femenino=0;



                        $matriculados=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));

                        $matriculados_femeninos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(matriculaseconfirmacoes.idaluno) from matriculaseconfirmacoes, alunos where alunos.idaluno=matriculaseconfirmacoes.idaluno and alunos.sexo='Femenino' and idturma='$idturma' and idanolectivo='$idanolectivo'"));

                        $matriculados_masculino=$matriculados-$matriculados_femeninos;

                        $ciclo_matriculado+=$matriculados;
                        $ciclo_matriculado_femenino+=$matriculados_femeninos;


                        $desistentes=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus!='activo'"));

                         $desistentes_femeninos=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(matriculaseconfirmacoes.idaluno) from matriculaseconfirmacoes, alunos where alunos.idaluno=matriculaseconfirmacoes.idaluno and alunos.sexo='Femenino' and idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus!='activo'"));

                         $ciclo_desistente+=$desistentes;
                         $ciclo_desistente_femenino+=$desistentes_femeninos;



                             

                                   $lista=mysqli_query($conexao, "select alunos.sexo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' and matriculaseconfirmacoes.estatus='activo' order by alunos.nomecompleto"); 

                              

             


                                    while($exibir = $lista->fetch_array()){ 

                                      $idaluno=$exibir["idaluno"];
                                      $sexo=$exibir["sexo"];
                                      $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];


                                             $contadordenegativa=0;
                                             $disciplinas_em_atraso=[];
                                             $disciplinas_em_atraso_nota=[];

                                        $lista_disciplinas=mysqli_query($conexao, "SELECT disciplinas.* from disciplinas where disciplinas.idturma='$idturma'"); 

                                        $notaacumulada=0;

                                             while($mostrar = $lista_disciplinas->fetch_array()){ 

                                              $iddisciplina=$mostrar['iddisciplina'];
                                              $tipodedisciplina=$mostrar['tipodedisciplina'];


                                                

                                                 $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT avg((notas.valordanota)) as media FROM notas, notasdoano where notasdoano.idnotadoano=notas.idnotadoano and notasdoano.idtrimestre='$idtrimestre' and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia);

                                                  $notaacumulada+=$mediadostrimestres;

                                                   
                                                    $nota_final=$mediadostrimestres;
                                                  

                                                                   if ($nota_final<$minimoparapositiva){
                                                                    
                                                                    
                                                                    $contadordenegativa++;

                                                                  

                                                                        if($tipodedisciplina=='Chave'){
                                                                          $contadordenegativa+=100; //não pode ter negativa nas diciplinas chaves se não reprova
                                                                        } 
                                                                  }



                                                }



                                                if($contadordenegativa<=2){ //se tiver menos de duas negativas
                                                   
                                                      
                                                        
                                                    
                                                    if(mysqli_num_rows($lista_disciplinas)!=0){

                                                      if($sexo='Masculino'){
                                                          $numerodepositivasdaturma_masculino++;
                                                        }else{
                                                          $numerodepositivasdaturma_femenino++;
                                                        }
                                                    }


                                                }else{ //se tiver mais de duas negativas reprova direito

                                                    if($notaacumulada!=0){

                                                       if($sexo='Masculino'){
                                                          $numerodenegativasdaturma_masculino++;
                                                        }else{
                                                          $numerodenegativasdaturma_femenino++;
                                                        }
                                                    

                                                   }



                                              }


                                           

                                               

                                  }

                                 
                                   $numerode_avaliados_femenino=$numerodenegativasdaturma_femenino+$numerodepositivasdaturma_femenino;

                                  $numerode_avaliado=$numerodenegativasdaturma_masculino+$numerodepositivasdaturma_masculino+$numerode_avaliados_femenino;

                                                $ciclo_avaliado+=$numerode_avaliado;
                                                $ciclo_avaliado_femenino+=$numerode_avaliados_femenino;

                                  $com_aproveitamento=$numerodepositivasdaturma_masculino+$numerodepositivasdaturma_femenino;

                                                $ciclo_com_aproveitamento+=$com_aproveitamento;


                                  $sem_aproveitamento=$numerodenegativasdaturma_masculino+$numerodenegativasdaturma_femenino;

                                                $ciclo_sem_aproveitamento+=$sem_aproveitamento;

                                  $com_aproveitamento_femenino=$numerodepositivasdaturma_femenino;
                                  $sem_aproveitamento_femenino=$numerodenegativasdaturma_femenino;

                                                $ciclo_com_aproveitamento_femenino+=$com_aproveitamento_femenino;
                                                $ciclo_sem_aproveitamento_femenino+=$sem_aproveitamento_femenino;

                                  if($numerode_avaliado==0){
                                    $percentagem_com_aproveitamento=round($com_aproveitamento*100/0.001);
                                    $percentagem_sem_aproveitamento=round($sem_aproveitamento*100/0.001);
                                  }else{
                                    $percentagem_com_aproveitamento=round($com_aproveitamento*100/$numerode_avaliado);
                                    $percentagem_sem_aproveitamento=round($sem_aproveitamento*100/$numerode_avaliado);
                                  }

                                  
                                              $ciclo_com_aproveitamento_percentagem+=$percentagem_com_aproveitamento;
                                              $ciclo_sem_aproveitamento_percentagem+=$percentagem_sem_aproveitamento;

                                $numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessor) from disciplinas where disciplinas.idturma='$idturma'")); 

                                $numerodeprofessores_auxiliares=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessorauxiliar) from disciplinas where disciplinas.idturma='$idturma' and idprofessorauxiliar!='0'")); 

                                $total_professores=$numerodeprofessores+$numerodeprofessores_auxiliares;

                       
                     $minipauta.='

                    <tr>
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir_ciclo["titulo"].'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir_turma["titulo"].'</td> 


                      <td width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino='.$matriculados_masculino.' | Femenino='.$matriculados_femeninos.'">'.$matriculados.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px" title="Masculino='.$matriculados_masculino.' | Femenino='.$matriculados_femeninos.'" >'.$matriculados_femeninos.'</td> 

                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$desistentes.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$desistentes_femeninos.'</td> 

                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$numerode_avaliado.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$numerode_avaliados_femenino.'</td>

                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$com_aproveitamento.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$com_aproveitamento_femenino.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$percentagem_com_aproveitamento.'%</td> 

                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$sem_aproveitamento.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$sem_aproveitamento_femenino.'</td> 
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$percentagem_sem_aproveitamento.'%</td> 


                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$total_professores.'</td>  
                      <td width="auto" style="border: 1px solid; border-spacing:0px">'.$numerodeprofessores_auxiliares.'</td>  
               
            </tr> 
            ';

          }   


                  if($ciclo_com_aproveitamento==0){$ciclo_com_aproveitamento_percentagem=0;}else{
                 $ciclo_com_aproveitamento_percentagem=round($ciclo_com_aproveitamento*100/$ciclo_avaliado);
               }
               if($ciclo_sem_aproveitamento==0){$ciclo_sem_aproveitamento_percentagem=0;}else{
                 $ciclo_sem_aproveitamento_percentagem=round($ciclo_sem_aproveitamento*100/$ciclo_avaliado);
               }
                     


           $total_ciclo_matriculado+=$ciclo_matriculado;
           $total_ciclo_matriculado_femenino+=$ciclo_matriculado_femenino;

           $total_ciclo_desistente+=$ciclo_desistente;
           $total_ciclo_desistente_femenino+=$ciclo_desistente_femenino;

           $total_ciclo_avaliado+=$ciclo_avaliado;
           $total_ciclo_avaliado_femenino+=$ciclo_avaliado_femenino;

           $total_ciclo_com_aproveitamento+=$ciclo_com_aproveitamento;
           $total_ciclo_com_aproveitamento_femenino+=$ciclo_com_aproveitamento_femenino;
           $total_ciclo_com_aproveitamento_percentagem+=$ciclo_com_aproveitamento_percentagem;


           $total_ciclo_sem_aproveitamento+=$ciclo_sem_aproveitamento;
           $total_ciclo_sem_aproveitamento_femenino+=$ciclo_sem_aproveitamento_femenino;
           $total_ciclo_sem_aproveitamento_percentagem+=$ciclo_sem_aproveitamento_percentagem;


             
                     


              $ciclo_numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessor) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idciclo='$idciclo' and turmas.idanolectivo='$idanolectivo'")); 

                                $ciclo_numerodeprofessores_auxiliares=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessorauxiliar) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idciclo='$idciclo' and turmas.idanolectivo='$idanolectivo' and idprofessorauxiliar!='0'")); 

                                $ciclo_total_professores=$ciclo_numerodeprofessores+$ciclo_numerodeprofessores_auxiliares;



          $minipauta.='

                  <tr>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir_ciclo["titulo"].'  - </th>
                    <th width="auto" style="border: 1px solid; border-spacing:0px">Total</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_matriculado.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_matriculado_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_desistente.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_desistente_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_avaliado.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_avaliado_femenino.'</th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_com_aproveitamento.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_com_aproveitamento_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_com_aproveitamento_percentagem.'%</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_sem_aproveitamento.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_sem_aproveitamento_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_sem_aproveitamento_percentagem.'%</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_total_professores.'</th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$ciclo_numerodeprofessores_auxiliares.'</th>    
                  
            </tr> ';

            }  

                    
                        if($total_ciclo_com_aproveitamento==0){$total_ciclo_com_aproveitamento_percentagem=0;}else{
                         $total_ciclo_com_aproveitamento_percentagem=round($total_ciclo_com_aproveitamento*100/$total_ciclo_avaliado);
                       }
                       if($total_ciclo_sem_aproveitamento==0){$total_ciclo_sem_aproveitamento_percentagem=0;}else{
                         $total_ciclo_sem_aproveitamento_percentagem=round($total_ciclo_sem_aproveitamento*100/$total_ciclo_avaliado);
                       }
                     




                       $total_ciclo_numerodeprofessores=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessor) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idanolectivo='$idanolectivo'")); 

                                $total_ciclo_numerodeprofessores_auxiliares=mysqli_num_rows(mysqli_query($conexao, "SELECT distinct(idprofessorauxiliar) from disciplinas, turmas where disciplinas.idturma=turmas.idturma and turmas.idanolectivo='$idanolectivo' and idprofessorauxiliar!='0'")); 

                                $total_ciclo_total_professores=$total_ciclo_numerodeprofessores+$total_ciclo_numerodeprofessores_auxiliares;
            $minipauta.='
           </tbody> 

           <tfoot>
                    <tr>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Total </th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">Todos Cíclos</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_matriculado.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_matriculado_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_desistente.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_desistente_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_avaliado.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_avaliado_femenino.'</th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_com_aproveitamento.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_com_aproveitamento_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_com_aproveitamento_percentagem.'%</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_sem_aproveitamento.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_sem_aproveitamento_femenino.'</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_sem_aproveitamento_percentagem.'%</th> 
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_total_professores.'</th>
                      <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_ciclo_numerodeprofessores_auxiliares.'</th>   
                    </tr>
           </tfoot>
        </table>';
 
  $minipauta.=" 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>


<br><br><br>

             <p id=assinatura>A Direcção <br>
___________________________ <br>
    
</p>
        </div>
        ";


        $gerador->load_html($minipauta); 
        //$gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Mapa de aproveitamento Geral -  ".$nomedotrimestre." de ".$anolectivo." - CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 
 