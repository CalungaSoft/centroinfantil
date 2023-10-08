 
    <?php 
 include("../conexao.php");
 session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);
 

$hoje=date('d');

$mesdevenda=isset($_GET['mesdevenda'])?$_GET['mesdevenda']:"01";
$mesdevenda=mysqli_escape_string($conexao, $mesdevenda); 

$anodevenda=isset($_GET['anodevenda'])?$_GET['anodevenda']:"2022";
$anodevenda=mysqli_escape_string($conexao, $anodevenda);

$idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"2";
$idanolectivo=mysqli_escape_string($conexao, $idanolectivo);

    
  
 
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
        <style>  #centro{text-align: center;} figure {margin-top:-45px; margin-left:-30px; float: left; position:relative} body {font-size: 12px; color:#000; font-family:Arial; font-family:Arial; }</style> 
      
        <div>
            <div>
                <figure>
                    <img src="img/logo.png"> 
                </figure>
            </div>
                <p style="font-size: 36px; margin-left:70px"> <span style="text-transform: uppercase;"> '.$dadosdainstituicao["nome"].' </span> <br> 
                <span style="font-size: 22px; font-family: forte"> '.$dadosdainstituicao["servicos"].'  </span></p> 
                <hr><hr>
               
                    <span style="font-size: 15px; margin-left:30px"> |Presença Mensal dos Professores: '.$mesdevenda.' / '.$anodevenda.'</span>
            <br> <br> <br> ';
         

            $htm.='  <table style="border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px" width="98%"  >
                
                <thead>
                     <tr>  
                         <th width="auto" style="border: 1px solid; border-spacing:0px">Funcionário</th> 
                         <th width="auto" style="border: 1px solid; border-spacing:0px">Nº de Disciplinas</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px">Salário Básico</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px">Dias trabalhados</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px">Total de tempos</th>
                        <th width="auto" style="border: 1px solid; border-spacing:0px">Salário Acumulado</th> 
                    </tr> 
                  </thead> 
                  <tbody>

                  ';

                  $listadefuncionários=mysqli_query($conexao,"SELECT distinct(idprofessor) FROM  disciplinas where idanolectivo='$idanolectivo'");

                  $listadefuncionários_auxiliares=mysqli_query($conexao,"SELECT distinct(idprofessorauxiliar) FROM  disciplinas where idanolectivo='$idanolectivo' and idprofessorauxiliar!='NULL'");
  

                    
                    $vetor_de_professor=[];
 
                   while($exibir = $listadefuncionários->fetch_array()){ 

                            $vetor_de_professor[]=$exibir["idprofessor"];
                       }

                  while($exibir = $listadefuncionários_auxiliares->fetch_array()){ 

                            $vetor_de_professor[]=$exibir["idprofessorauxiliar"];
                       }

                       $vetor_de_professor=array_unique($vetor_de_professor);

                       $total_geral_salariobase=0;
                       $total_geral_detempos=0;
                       $total_geral_salarioacumulado=0;
                    foreach ($vetor_de_professor as $key => $value) {
                              

                          $idfuncionario=$value;

                          $dados_do_funcionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomedofuncionario, salario FROM  funcionarios where idfuncionario='$idfuncionario'"));


                           $numero_de_disciplinas=mysqli_num_rows(mysqli_query($conexao,"SELECT iddisciplina FROM  disciplinas where idprofessor='$idfuncionario' or idprofessorauxiliar='$idfuncionario'"));

                           $numero_de_dias=mysqli_num_rows(mysqli_query($conexao,"SELECT DISTINCT(DAY(diadapresenca)) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo'  and presencaprofessores.idprofessor='$idfuncionario' and YEAR(diadapresenca)='$ano' and MONTH(diadapresenca)='$mes_escolhido'"));



                           $total_de_tempos=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and presencaprofessores.idprofessor='$idfuncionario' and YEAR(diadapresenca)='$ano' and MONTH(diadapresenca)='$mes_escolhido'"))[0];



                           $salario_acumulado=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(totaldetempos*salarioportempo) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo' and presencaprofessores.idprofessor='$idfuncionario' and YEAR(diadapresenca)='$ano' and MONTH(diadapresenca)='$mes_escolhido'"))[0];

 
                              $total_geral_detempos+=$total_de_tempos;
                              $total_geral_salarioacumulado+=$salario_acumulado;
                              $total_geral_salariobase+=$dados_do_funcionario["salario"];

                               $salario_base_f=number_format($dados_do_funcionario["salario"],2,",", ".");
                        
                               $salario_acumulado_F=number_format($salario_acumulado,2,",", ".");
                      
 

                   $htm.=' 
                    <tr>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir['nomedofuncionario'].'</td>
 
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$numero_de_disciplinas.'</td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$salario_base_f.'</td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$numero_de_dias.'</td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$total_de_tempos.'</td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$salario_acumulado_F.'</td>';


 
                     } 

                     $htm.='

                     </tr>

                     </tbody>'; } 



                     $total_geral_dias=mysqli_num_rows(mysqli_query($conexao,"SELECT DISTINCT(DAY(diadapresenca)) FROM  presencaprofessores, disciplinas where  presencaprofessores.iddisciplina=disciplinas.iddisciplina and disciplinas.idanolectivo='$idanolectivo'  and YEAR(diadapresenca)='$ano' and MONTH(diadapresenca)='$mes_escolhido'"));

                         $percentagem=round($total_geral_salarioacumulado*100/$total_geral_salariobase);

                        $total_geral_salariobase=number_format($total_geral_salariobase,2,",", ".");
                        $total_geral_salarioacumulado=number_format($total_geral_salarioacumulado,2,",", ".");
                        

                     $htm.=' 
                      <tfoot>
                      <tr>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px"><strong>Total</strong></td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px"></td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$total_geral_salariobase.'</td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$total_geral_dias.'</td>  
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$total_geral_detempos.'</td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$percentagem.'%</td> 
 
                    </tr>
                      </tfoot>
                  </table>';

             $htm."
             <p id=centro>
                     ".$dadosdainstituicao['nome']." aos  ".$dia."  de   ".$mes."  de  ".$ano." .</b>
             </p>
        </div>
        ";

         $gerador->load_html($htm); 
       // $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Presenca de ".$mesdevenda." - ".$anodevenda." | CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 