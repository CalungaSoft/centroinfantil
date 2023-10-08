 
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
    ~
   $idanolectivo=isset($_GET['idanolectivo'])?$_GET['idanolectivo']:"0";
   
       $dados_do_anolectivo=mysqli_fetch_array(mysqli_query($conexao,"SELECT * from anoslectivos where idanolectivo='$idanolectivo'"));
   
   
    
                              $idanolectivo=$dados_do_anolectivo["idanolectivo"];
    
                             $anolectivo=$dados_do_anolectivo["titulo"];
   
    
   
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
                  
                       <span style="font-size: 15px; margin-left:30px"> LISTA NOMINAL DOS ALUNOS DO ATL  <strong>'.$anolectivo.'</strong> </span>
               <br> <br>   ';
   
               $htm.=" 
   
       <table style='border:0px solid; border-spacing:0px; margin-top:-20px;  padding:20px' width='95%' align=center>
       <thead> 
       <tr>
         <th  width='auto' style='border: 1px solid; border-spacing:0px' align=center>Nº</th> 
         <th  width='auto' style='border: 1px solid; border-spacing:0px' align=center>Nome completo</th>  
         <th  width='auto' style='border: 1px solid; border-spacing:0px' align=center>Nº de Proc.</th> 
         <th  width='auto' style='border: 1px solid; border-spacing:0px' align=center>ATL</th> 
         <th  width='auto' style='border: 1px solid; border-spacing:0px' align=center>Sexo</th>    
         <th  width='auto' style='border: 1px solid; border-spacing:0px'align=center>Idade</th>   
       </tr>    
     </thead> 
     <tbody> 
          "; 
          
              $lista=mysqli_query($conexao, "select TIMESTAMPDIFF(YEAR,datadenascimento,CURDATE()) as idade, alunos.nomecompleto, alunos.numerodeprocesso, alunos.sexo,  matriculaatl.* from matriculaatl, alunos where matriculaatl.idaluno=alunos.idaluno and matriculaatl.idanolectivo='$idanolectivo' order by alunos.nomecompleto "); 
       
       $n=0;
        while($exibir = $lista->fetch_array()){
   
         $n++;
          
               $htm.=" 
             <tr>
                 <td width='auto' style='border: 1px solid; border-spacing:0px' align=center>".$n."</td>
                 <td width='auto' style='border: 1px solid; border-spacing:0px'>".$exibir["nomecompleto"]."</td> 
                 <td width='auto' style='border: 1px solid; border-spacing:0px' align=center>".$exibir["numerodeprocesso"]."</td> 
                 <td width='auto' style='border: 1px solid; border-spacing:0px' >".$exibir["atl"]."</td> 
                 <td width='auto' style='border: 1px solid; border-spacing:0px' align=center>".$exibir["sexo"]."</td> 
                 <td width='auto' style='border: 1px solid; border-spacing:0px'  >".$exibir["idade"]." Anos</td> 
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
               "listaDosalunosDoATLCalungaSoft.pdf",
               array(
                   "attachment" => true
               )
           );
       ?>
    
    