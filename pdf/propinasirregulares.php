 
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
$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"$mesv";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 
$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"$anov";
$anodevenda=mysqli_escape_string($conexao, $anodevenda); 
  
$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"$anov";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo); 
  



 if(isset($_GET['mesdevenda'])){

   $mes_em_questao="$anodevenda-$mesdevenda-01";

 }else{   $mes_em_questao=date("Y-m-01"); }

 

                      
                           $anolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from anoslectivos where idanolectivo='$idanolectivo'"))[0];

                            $numero_de_devedores=mysqli_num_rows(mysqli_query($conexao, "SELECT  matriculaseconfirmacoes.idaluno from matriculaseconfirmacoes where matriculaseconfirmacoes.idanolectivo='$idanolectivo' and (ultimomespago<'$mes_em_questao' and tipodealuno!='Bolseiro') "));


                              $numero_de_alunos=mysqli_num_rows(mysqli_query($conexao, "SELECT idaluno from matriculaseconfirmacoes where idanolectivo='$idanolectivo' "));
                             
                               $numero_pagas=mysqli_num_rows(mysqli_query($conexao, "SELECT matriculaseconfirmacoes.idaluno from matriculaseconfirmacoes where matriculaseconfirmacoes.idanolectivo='$idanolectivo' and (ultimomespago>='$mes_em_questao' or tipodealuno='Bolseiro')  "));

 


                            $indice_de_pagamento=round(($numero_pagas*100)/$numero_de_alunos);


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
               
                    <span style="font-size: 15px; margin-left:30px"> Lista nominal dos <strong> alunos Com Propinas em atraso </strong>  do mês de <strong>'.$mesdevenda.'/'.$anodevenda.' </strong>    | <strong> Toda instituição </strong> | Ano Lectivo: <strong> '.$anolectivo.' </span>
            <br> <br>   ';

            $htm.=" <br>

     | Total de Alunos na instituição ".$numero_de_alunos." : Com Propinas em atraso ".$numero_de_devedores." |  Com Propinas Pagas ".$numero_pagas." (".$indice_de_pagamento."%)
    <table style='border:0px solid; border-spacing:0px;    padding:10px' width='95%' align=center>
    <thead>
    <thead>
    <tr>
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Nome completo</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Turma</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Curso</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Período</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Classe</th> 
      <th  width='auto' style='border: 1px solid; border-spacing:0px'>Ultimo Mês pago</th>   
    </tr>    
  </thead> 
  <tbody> 
       "; 
       
        $lista=mysqli_query($conexao, "SELECT alunos.nomecompleto, YEAR(matriculaseconfirmacoes.ultimomespago) as ano, MONTH(matriculaseconfirmacoes.ultimomespago) as mes, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idanolectivo='$idanolectivo' and (ultimomespago<'$mes_em_questao' and tipodealuno!='Bolseiro')   order by idturma"); 

     
     while($exibir = $lista->fetch_array()){
 
       
                          $anoactual=date('Y');
                          $ultimopagamento=$exibir['mes'];

                     if($exibir['mes']==1){
                          $ultimopagamento="Janeiro";
                          if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Janeiro/".$exibir['ano']."";
                          }
                     }else  if($exibir['mes']==2){
                        $ultimopagamento="Fevereiro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Fevereiro/".$exibir['ano']."";
                        }
                    }else  if($exibir['mes']==3){
                        $ultimopagamento="Março";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Março/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==4){
                        $ultimopagamento="Abril";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Abril/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==5){
                        $ultimopagamento="Maio";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Maio/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==6){
                        $ultimopagamento="Junho";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Junho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==7){
                        $ultimopagamento="Julho";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Julho/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==8){
                        $ultimopagamento="Agosto";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Agosto/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==9){
                        $ultimopagamento="Setembro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Setembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==10){
                        $ultimopagamento="Outubro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Outubro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==11){
                        $ultimopagamento="Novembro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Novembro/".$exibir['ano']."";
                        }
                    } else if($exibir['mes']==12){
                        $ultimopagamento="Dezembro";
                        if($exibir['ano']!=$anoactual){
                            $ultimopagamento="Dezembro/".$exibir['ano']."";
                        }
                    } 

                     if($exibir["estatus"]!="activo"){
                      $estatus="($exibir[estatus])";

                    }else{
                      $estatus="";
                    }
                    
            $htm.=" 
          <tr> 
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomecompleto"]." ".$estatus."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["turma"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["curso"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["periodo"]."</td>
              <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["classe"]."</td>
               <td width='auto' style='border: 1px solid; border-spacing:0px'>".$ultimopagamento."</td> 
         </tr>  
           "; 
          } 
          
              $htm.="
         
      </tbody>
</table> 


";
 
  $htm.=" 
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>


<br><br><br>

             <p id=assinatura>O Director Geral <br>
___________________________ <br>
    ".$dadosdainstituicao['nomedodireitor']."
</p>
        </div>
        ";


        $gerador->load_html($htm); 
       // $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "propinasirregularCalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 
 