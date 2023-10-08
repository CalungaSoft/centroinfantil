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

      $estatus=$dadoslectivos_confirmacao['estatus'];

    $Dados_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select * from alunos where idaluno='$idaluno' order by idaluno desc limit 1"));

       $preco_da_propina=mysqli_fetch_array(mysqli_query($conexao, "select propina from turmas where idturma='$idturma' limit 1"))[0];
 

$titulo_do_ano_lectivo=mysqli_fetch_array(mysqli_query($conexao, "select titulo from anoslectivos where idanolectivo='$idanolectivo' limit 1"))[0];
        
 
   $anoactual=date('Y');
   $mesactual=date('m');

$html="";
          
                              
    $nomecompleto=mysqli_fetch_array(mysqli_query($conexao," SELECT nomecompleto FROM alunos where idaluno='$idaluno' limit 1"))[0];

     $anoactual=date('Y');
      $diadehoje=date("d/m/Y");
                          
    $html.='
        <input type="submit" name="eliminar"  id="'.$idmatriculaeconfirmacao.'"   title="Essa Ação apagara todas informações da matrícula desse aluno, incluindo os dados financeiros, será como se nunca tivesse tido feito a matrícula" value="Eliminar Todos dados dessa matricula" class="btn btn-danger eliminarmatricula" style="float: rigth;"> <br><br>
       <span id="mensagemdealerta"></span> 
                    
          
    <h4>Se não quiseres eliminar podes apenas lhe tornar Inactivo preenchendo o formulário a baixo</h4>
    <form class="user" action="" method="post">
    Descadastramento do Aluno <h2>'.$nomecompleto.'</h2>

       <div class="alert alert-info">
 
             Ano Lectivo: <strong>'.$titulo_do_ano_lectivo.'</strong> | Turma: <strong>'.$dadoslectivos_confirmacao["turma"].'  </strong> <br>
             Classe: <strong>'.$dadoslectivos_confirmacao["classe"].'</strong>
              | Curso: <strong>'.$dadoslectivos_confirmacao["curso"].'</strong> <br>
             Período: <strong>'.$dadoslectivos_confirmacao["periodo"].'</strong>
              | Sala: <strong>'.$dadoslectivos_confirmacao["sala"].'</strong>



           </div>

           <h4 align="center">Status actual: <strong> '.$estatus.' </strong></h4> <br>
             
             <div class="form-group">
                          ';

                                $lista=mysqli_query($conexao, "SELECT distinct(tipo) from descadastrados"); 
                        
                         $html.='
                         <span>Tipo de Descadastramento</span>
                      <input type="text" name="tipo" min="0" list="lista" class="form-control"  placeholder="Tipo" required="">
                      <datalist id="lista">
                      <option value="Inactivo">
                      <option value="Faleceu">
                      <option value="Desistiu">
                      <option value="Trancou o Ano">
                      <option value="Expulso">
                         ';

                          while($exibir = $lista->fetch_array()){ 
                            $html.='
                         <option value="'.$exibir['tipo'].'"> 
                        '; }
                        $html.='
                    </datalist>
                    </div> 
 
 
               <div class="form-group">
                   <span>Descrição</span>
                  <textarea name="descricao" rows="2" class="form-control " title="Descreva  o que aconteceu" ></textarea>
              </div>


              <div class="form-group">
                 <span>Data</span>
                <input type="text" name="data" autocomplete="off" class="form-control js-datepicker" title="Digite data" placeholder="Data" value="'.$diadehoje.'">
              </div>


                     <input type="hidden" name="idmatriculaeconfirmacao"    value='.$idmatriculaeconfirmacao.'>
                      <input type="hidden" name="idaluno"    value='.$idaluno.'>
          

   <br>

                             <div class="alert alert-danger">


                                  Se mudares o Status do aluno de activo para qualquer um outro o aluno não aparecerá nas listas das turmas.
                             </div>
                              <div class="alert alert-success"> 
                                  Todos  dados do aluno serão guardados no sistema, e a qualquer momento pode voltar o aluno a activo
                             </div>


                    <input type="submit" name="cadastrar"  value="Tornar Inactivo o Aluno" class="btn btn-secondary" style="float: rigth;"> <br><br>
    </form>
 
 
                
 

                 




<script>


 $(document).on("click", ".eliminarmatricula", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                              console.log(id)
                                                                if(confirm("Tens certeza que queres eliminar esse registro? Serão eliminados todos os dados relacionados com esse registro!")){
                                                                     $.ajax({
                                                                    url:"cadastro/deletematricula.php",
                                                                    method:"POST",
                                                                    data:{
                                                                        id
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealerta").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })


</script>
                       

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