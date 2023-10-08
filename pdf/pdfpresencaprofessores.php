 
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

    
 
$servico=isset($_GET['servico'])?$_GET['servico']:"todos";
 
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
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Funcionário</th> 
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Disciplina</th> 
                       ';

                         $salario_portempo=mysqli_fetch_array(mysqli_query($conexao,"SELECT salarioportempo FROM anoslectivos where idanolectivo='$idanolectivo'"))[0]; 
 

                          

                      $totaldedias=cal_days_in_month(CAL_GREGORIAN, $mesdevenda, $anodevenda);

                        for ($i=1; $i <=$totaldedias; $i++) {  

                          $htm.='
                            <th  width="auto" style="border: 1px solid; border-spacing:0px">'.$i.'</th>';
                         } 

                         $htm.='
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">Tempos</th>
                      <th  width="auto" style="border: 1px solid; border-spacing:0px">salário</th>
                    </tr> 
                  </thead> 
                  <tbody>

                  ';

                  $listadefuncionários=mysqli_query($conexao,"SELECT  disciplinas.idprofessor, disciplinas.titulo, disciplinas.iddisciplina, funcionarios.nomedofuncionario FROM funcionarios, disciplinas where (funcionarios.idfuncionario=disciplinas.idprofessor) and idanolectivo='$idanolectivo' order by funcionarios.nomedofuncionario");
                  $salariodetodos=0; 
                   while($exibir = $listadefuncionários->fetch_array()){ 

                     $idfuncionario=$exibir['idprofessor'];
                     $iddisciplina=$exibir['iddisciplina'];
                     
                     $salariototal=0; 
                     $tempos_total=0;

                      
 

                   $htm.='
                    <tr>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir['nomedofuncionario'].'</td>
 
                      <td  width="auto" style="border: 1px solid; border-spacing:0px">'.$exibir['titulo'].'</td>';

                       for ($i=1; $i <=$totaldedias; $i++) { 

                      $data="$i-$mesdevenda-$anodevenda";

                      $dia_da_presenca="$anodevenda-$mesdevenda-$i";
                     
                        $cor="red";
                        $imprimir="";

                        $dados=mysqli_fetch_array(mysqli_query($conexao,"SELECT totaldetempos, salarioportempo FROM presencaprofessores where idprofessor='$idfuncionario' and diadapresenca='$dia_da_presenca' and iddisciplina='$iddisciplina' limit 1")); 

                        $tempos=$dados["totaldetempos"];


                        $valorporreceber=$tempos*$dados["salarioportempo"];
                         

                          $salariototal+=$valorporreceber;
                          $tempos_total+=$tempos;
 
 
 

                          $imprimir="$tempos";

                         if(date('N', strtotime($data))==6){$cor="yellow";}else if(date('N', strtotime($data))==7){$cor='rgb(255,135,135)';}else{$cor='';}
                       
                         
                          $salariototal_f=number_format($salariototal,2,",", ".");

                        $htm.='
                          <td  width="auto" style="border: 1px solid; border-spacing:0px" style="background-color: '.$cor.'" ><strong>'.$imprimir.'</strong></td>';
                       }  


                       $htm.='
                      <td  width="auto" style="border: 1px solid; border-spacing:0px" >'.$tempos_total.'</td> 
                      <td  width="auto" style="border: 1px solid; border-spacing:0px" >'; $salariodetodos+=$salariototal; $n=number_format($salariototal,2,",", "."); $htm.=''.$n.'Kz</td>
                    </tr>';

                     } 

                     $htm.='
                      
                  </tbody>
                      <tfoot>
                      <tr>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px"><strong>Total</strong></td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px"></td> ';

                      for ($i=1; $i <=$totaldedias; $i++) { 

                        $htm.='
                         <td  width="auto" style="border: 1px solid; border-spacing:0px"></td>';
                       }  

                       $htm.='
                      <td  width="auto" style="border: 1px solid; border-spacing:0px"></td>
                      <td  width="auto" style="border: 1px solid; border-spacing:0px"><strong>';

                      $n=number_format($salariodetodos,2,",", "."); $htm.=''.$n.' Kz</strong></td>
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
        $gerador->setPaper('A4', 'landscape');
        $gerador->render();
    
        $gerador->stream(
            "Presenca de ".$mesdevenda." - ".$anodevenda." | CalungaSoft.pdf",
            array(
                "attachment" => true
            )
        );
    ?>
 