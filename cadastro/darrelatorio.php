<?php



session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

include("../conexao.php"); 

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["id"])){ 

$idmatriculaeconfirmacao=isset($_POST['id'])?$_POST['id']:"";
$idmatriculaeconfirmacao=mysqli_escape_string($conexao, $idmatriculaeconfirmacao); 

   $dadoslectivos_confirmacao=mysqli_fetch_array(mysqli_query($conexao, "SELECT YEAR(matriculaseconfirmacoes.ultimomespago) as ano, MONTH(matriculaseconfirmacoes.ultimomespago) as mes, matriculaseconfirmacoes.* from matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"));

      $idaluno=$dadoslectivos_confirmacao['idaluno'];
      $idanolectivo=$dadoslectivos_confirmacao['idanolectivo'];
      $idturma=$dadoslectivos_confirmacao['idturma'];
      $descontoparapropinas=$dadoslectivos_confirmacao['descontoparapropinas'];

    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));

       $diadehoje=date("d/m/Y");

$dados_do_anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select * from anoslectivos where idanolectivo='$idanolectivo' limit 1"));
        
   $titulo_do_ano_lectivo=$dados_do_anolectivo["titulo"];
   $precodamulta=$dados_do_anolectivo["precodamulta"]; 
   $diadamulta=$dados_do_anolectivo["diadamulta"];
 
   $anoactual=date('Y');
   $mesactual=date('m');
   $diaactual=date('d');



 $datadecontagem=date('Y-m-d'); 
 $diassemmultas=date('Y-m-d', strtotime('+'.$diadamulta.' DAYS', strtotime($datadecontagem)));

 
 $prazodepagamento=date('Y-m-d', strtotime('-'.$diadamulta.' DAYS', strtotime($datadecontagem)));
 
$html="";
          
                              
    $nomecompleto=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno' limit 1"))[0];

     $anoactual=date('Y');
               
                    

    $html.='
    
    
    <form class="user" action="" method="post">
    Dar Relatório do Aluno <h2>'.$nomecompleto.'</h2>

       <div class="alert alert-info">
  
             Ano Lectivo: <strong>'.$titulo_do_ano_lectivo.'</strong> | Turma: <strong>'.$dadoslectivos_confirmacao["turma"].'  </strong> <br>
             Classe: <strong>'.$dadoslectivos_confirmacao["classe"].'</strong>
              | Curso: <strong>'.$dadoslectivos_confirmacao["curso"].'</strong> <br>
             Período: <strong>'.$dadoslectivos_confirmacao["periodo"].'</strong>
              | Sala: <strong>'.$dadoslectivos_confirmacao["sala"].'</strong>


          
           </div>

           

                     <div class="form-group">
                         <span>Descreva aqui o Relatório</span>
                        <textarea name="descricao" rows="2" class="form-control " title="Alguma observação?" ></textarea>
                    </div>

                      <div class="form-group"> 
                      <span>Disciplina</span>
                                  <select name="iddisciplina" required  class="form-control" title="Disciplina"  > 
                                  <option disabled="">Escolha a Disciplina</option>
                                 ';
                                      $disciplinas=mysqli_query($conexao, "select * from disciplinas where (idprofessor='$idlogado' or idprofessorauxiliar='$idlogado') and idturma='$idturma'"); 
                                      while($exibir = $disciplinas->fetch_array()){ 
                                        $html.='
                                      <option  value="'.$exibir["iddisciplina"].'">'.$exibir["titulo"].'</option>
                                    ';}

                                    $html.='
                                </select> 
                    </div>


                     <div class="form-group">
                     <span>Data</span>
                          <input type="text" name="data" autocomplete="off" class="form-control js-datepicker"  placeholder="Data do Relatório" value="'.$diadehoje.'">
                      </div>
                      

                     <input type="hidden" name="idmatriculaeconfirmacao"    value='.$idmatriculaeconfirmacao.'>
                  <input type="hidden" name="idaluno"    value='.$idaluno.'>
            


   <br>
                    <input type="submit" name="cadastrar"  value="Registrar Relatório" class="btn btn-success" style="float: rigth;">



                     </form>




 

                         <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
        '; 


echo $html;

}




?>