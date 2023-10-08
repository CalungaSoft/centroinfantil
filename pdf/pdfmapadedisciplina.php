 
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
 
$idturma=isset($_GET['idturma'])?$_GET['idturma']:"0"; 
$idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"0"; 

 
     

    $dados_da_turma=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from turmas where idturma='$idturma'"));
    $dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from trimestres where idtrimestre='$idtrimestre'"));
    $nomedotrimestre=$dadosdotrimestre["titulo"];


                           $idperiodo=$dados_da_turma["idperiodo"];
                           $idcurso=$dados_da_turma["idcurso"];
                           $idsala=$dados_da_turma["idsala"];
                           $idclasse=$dados_da_turma["idclasse"];
                           $idanolectivo=$dados_da_turma["idanolectivo"];
 
                          $turma=$dados_da_turma["titulo"];
                          $minimoparapositiva=$dados_da_turma["minimoparapositiva"];


                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                            if($curso=='Nenhum'){
                              $curso='';
                            }

                            $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

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
                    <img src="img/'.$dadosdainstituicao["caminhodologo"].'"> 
                </figure>
            </div>
                <p style="font-size: 20px; margin-left:70px">
                República de Angola <br>
                Ministério da Educação <br>
                 <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                </p> 
                <hr><hr> 
               
                <span style="font-size: 20px; margin-left:50px"> Mapa de aproveitamento Da  - '.$classe.'  </strong> <strong>'.$curso.'</strong>   |   <strong>'.$nomedotrimestre.' Trimestre</span>
        <br> <br> ';

            $minipauta.="
           <p id='centro' style='font-size: 15px;'> Sala: <strong>".$sala."</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|  Turma: <strong>".$turma."</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Período: <strong>".$periodo."</strong>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ano Lectivo: <strong>".$anolectivo."</strong></p></p>";


    
$minimoparapositiva= mysqli_fetch_array(mysqli_query($conexao, "select minimoparapositiva from turmas where idturma='$idturma' limit 1"))[0]; 

 
$dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 
 
if($dadosdaturma["eclassedeexame"]=='sim'){$tipodeturma="exame";}else{ $tipodeturma='transição';}

$minipauta.='

 
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
  <tr>
      
      <th width="auto" style="border: 1px solid; border-spacing:0px">Disciplina</th> 
      <th width="auto" style="border: 1px solid; border-spacing:0px">Matriculados</th> 
      <th width="auto" style="border: 1px solid; border-spacing:0px">Desistentes</th> 
      <th width="auto" style="border: 1px solid; border-spacing:0px">Avaliados</th> 
      <th width="auto" style="border: 1px solid; border-spacing:0px">Nº de Positivas</th> 
      <th width="auto" style="border: 1px solid; border-spacing:0px">Perc. %</th>  
    </tr> 
  </thead> 
  <tbody>';

        $dadosdotrimestre=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));

         $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM turmas where idturma='$idturma' "));


        $arredondarmedia_anolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT arredondarmedia FROM mediasdoano where idanolectivo='$idanolectivo' and idtrimestre='$idtrimestre' limit 1 "))[0];

        $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 



  $listadedisciplina=mysqli_query($conexao,"SELECT * from disciplinas where idanolectivo='$idanolectivo' and idturma='$idturma' order by titulo desc");



  $soma_percentagem=0;

  while($exibir_disciplina = $listadedisciplina->fetch_array()){

   
   

    $iddisciplina=$exibir_disciplina["iddisciplina"];
    $nome_da_disciplina=$exibir_disciplina["titulo"];
    $tipodedisciplina=$exibir_disciplina['tipodedisciplina'];

     

                $numerodepositivasdaturma=0;
                $numerode_avaliado=0; 
                $maior_avalidado=0;



                $matriculados=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo'"));


                $desistentes=mysqli_num_rows(mysqli_query($conexao,"SELECT distinct(idaluno) from matriculaseconfirmacoes where idturma='$idturma' and idanolectivo='$idanolectivo' and matriculaseconfirmacoes.estatus!='activo'"));

               
                  $lista=mysqli_query($conexao, "select alunos.sexo, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' and matriculaseconfirmacoes.estatus='activo' order by alunos.nomecompleto"); 

                      

     


                            while($exibir = $lista->fetch_array()){ 

                              $idaluno=$exibir["idaluno"]; 
                              $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];






                                      


                                        

                                         $mediatrimestral=round(mysqli_fetch_array(mysqli_query($conexao," SELECT avg(valordanota) as media FROM notas, notasdoano where notasdoano.idnotadoano=notas.idnotadoano and notasdoano.idtrimestre='$idtrimestre' and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);

                                           
                                             
                                                    if($mediatrimestral>=$minimoparapositiva) {

                                                      $numerodepositivasdaturma++;

                                                    }

                                                    if($mediatrimestral>0) {

                                                      $numerode_avaliado++;

                                                    }       


                                      }



                                       


                                    if($numerode_avaliado>0){

                                      $percentagem_por_disciplina=round($numerodepositivasdaturma*100/$numerode_avaliado);
                                    }else{

                                      $percentagem_por_disciplina=round($numerodepositivasdaturma*100/0.0001);

                                    }
                                       

             $minipauta.='

            <tr>
              <td width="auto" style="border: 1px solid; border-spacing:0px"> '.$nome_da_disciplina.'</td>  

              <td width="auto" style="border: 1px solid; border-spacing:0px">'.$matriculados.'</td> 
              <td width="auto" style="border: 1px solid; border-spacing:0px">'.$desistentes.'</td> 

              <td width="auto" style="border: 1px solid; border-spacing:0px">'.$numerode_avaliado.'</td> 
              <td width="auto" style="border: 1px solid; border-spacing:0px">'.$numerodepositivasdaturma.'</td> 

              <td width="auto" style="border: 1px solid; border-spacing:0px">'.$percentagem_por_disciplina.'%</td> 
              
       
    </tr> 
    ';
                    if($maior_avalidado<$numerode_avaliado){
                      $maior_avalidado=$numerode_avaliado;
                    }

                    $soma_percentagem+=$percentagem_por_disciplina;

  }   


                    $numero_de_disciplinas=mysqli_num_rows($listadedisciplina);

                    if($numero_de_disciplinas==0){
                      $numero_de_disciplinas=0.0001;
                    }

                    $total_percentagem=round($soma_percentagem/$numero_de_disciplinas);
    $minipauta.='
   </tbody>  
   <tfoot>
            <tr>
              <th width="auto" style="border: 1px solid; border-spacing:0px">Total </th>
              <th width="auto" style="border: 1px solid; border-spacing:0px">'.$matriculados.'</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px">'.$desistentes.'</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px">-</th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px"> - </th> 
              <th width="auto" style="border: 1px solid; border-spacing:0px">'.$total_percentagem.' %</th>     
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
       // $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Mapa de aproveitamento por turma - ".$turma." - CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 
 