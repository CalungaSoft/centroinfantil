<?php


include("../conexao.php");

$idtipodedisciplina = $_POST['idtipodedisciplina'];
$idanolectivo = $_POST['idanolectivo'];

$dados_da_disciplina = mysqli_fetch_array(mysqli_query($conexao, "select * from tipodedisciplinas where idtipodedisciplina='$idtipodedisciplina' limit 1"));

$titulo = $dados_da_disciplina["titulo"];
$abreviatura = $dados_da_disciplina["abreviatura"];
$tipodedisciplina = $dados_da_disciplina["tipodedisciplina"];
$agrupamento = $dados_da_disciplina["agrupamento"];

$dadoslectivos = mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idanolectivo='$idanolectivo' order by idturma desc limit 1"));

$idperiodo = $dadoslectivos["idperiodo"];
 
$idclasse = $dadoslectivos["idclasse"];


$periodo = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

$curso = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from cursos where idcurso='$idcurso'"))[0];

$classe = mysqli_fetch_array(mysqli_query($conexao, "SELECT titulo from classes where idclasse='$idclasse'"))[0];

$ultimosalarioportempo_efectivo = mysqli_fetch_array(mysqli_query($conexao, "SELECT salarioportempo from disciplinas order by iddisciplina desc limit 1"))[0]+0;
$ultimosalarioportempo_auxiliar = mysqli_fetch_array(mysqli_query($conexao, "SELECT salarioportempoauxiliar from disciplinas order by iddisciplina desc limit 1"))[0]+0;





$htm = '
                                       
                   
   <form action="" method="post"> <hr><hr><hr><hr> <br>
                    <div class="form-group"> 
                          <input type="hidden" name="titulo"  class="form-control " placeholder="Nome da Disciplina" value="' . $titulo . '" >
                      </div>

            <input type="hidden" name="idtipodedisciplina" value="' . $idtipodedisciplina . '"  >
            <input type="hidden" name="idanolectivo" value="' . $idanolectivo . '"  >

                <div class="form-group row"> 
                      <div class="col-sm-3">   
                        <span>Abreviatura</span> 
                                <input type="text"  name="abreviatura" class="form-control " value="' . $abreviatura . '" > 
                        </div>

                        <div class="col-sm-4"> 
                        <span>Tipo de Disciplina</span>
                                  <select name="tipodedisciplina" required  class="form-control">
                                    <option value="Normal" ';
if ($tipodedisciplina == "Normal") {
  $htm .= 'selected="" ';
}
$htm .= '>Normal</option> 
                                    <option value="Chave" ';
if ($tipodedisciplina == "Chave") {
  $htm .= 'selected="" ';
}
$htm .= '>Chave</option> 
                                  </select> 
                        </div> 

                         <div class="col-sm-5">  
                          <span>Agrupamento</span>
                          <select name="agrupamento" required  class="form-control">
                            <option value="Formação Geral" ';
if ($agrupamento == "Formação Geral") {
  $htm .= 'selected="" ';
}
$htm .= '>Formação Geral</option> 
                            <option value="Formação Específica" ';
if ($agrupamento == "Formação Específica") {
  $htm .= 'selected="" ';
}
$htm .= '>Formação Específica</option> 
                             <option value="Opção" ';
if ($agrupamento == "Opção") {
  $htm .= 'selected="" ';
}
$htm .= '>Opção</option> 
                          </select> 
                        </div> 


                    </div>

                     

                  
                  <div class="form-group row"> 
                      <div class="col-sm-5">   
                        <span>Professor Efectivo</span> 
                                 <select name="idprofessor" required  class="form-control">

                                  ';

$lista = mysqli_query($conexao, "select nomedofuncionario, idfuncionario from funcionarios");
while ($exibir = $lista->fetch_array()) {
  $htm .= '
                                    <option value="' . $exibir["idfuncionario"] . '">' . $exibir["nomedofuncionario"] . '</option>
                                    ';
}
$htm .= '
                                  </select> 
                        </div>
                        <div class="col-sm-7"> 
                        <span>Professor Auxiliar</span>
                                  <select name="idprofessorauxiliar" required  class="form-control">
                                    <option value="0">Sem Professor Auxiliar</option>
                                  ';

$lista = mysqli_query($conexao, "select nomedofuncionario, idfuncionario from funcionarios");
while ($exibir = $lista->fetch_array()) {
  $htm .= '
                                    <option value="' . $exibir["idfuncionario"] . '">' . $exibir["nomedofuncionario"] . '</option>
                                    ';
}
$htm .= '
                                  </select> 
                        </div> 
                    </div>

                    <div class="form-group row"> 
                    <div class="col-sm-5">   
                      <span>Salário/Tempo Efectivo</span> 
                      <input type="number"  name="salarioportempo" class="form-control " placeholder="Salário por tempo efectivos" value="'.$ultimosalarioportempo_efectivo.'" > 
                      </div>
                      <div class="col-sm-7"> 
                      <span>Salário/Tempo Auxiliar</span>
                       <input type="number"  name="salarioportempoauxiliar" class="form-control " placeholder="Salário por tempo auxiliares"  value="'.$ultimosalarioportempo_auxiliar.'" > 
                      </div> 
                  </div>
                  
                      <hr> <hr>    <br> 
 
                      <div class="form-group">    
                            <span>Turma 1</span> 
                                 <select name="idturma" id="idturma" required  class="form-control">

                                  ';

$lista = mysqli_query($conexao, "select idturma, titulo from turmas where idanolectivo='$idanolectivo' order by idturma desc ");
while ($exibir = $lista->fetch_array()) {
  $htm .= '
                                    <option value="' . $exibir["idturma"] . '">' . $exibir["titulo"] . '</option>
                                    ';
}
$htm .= '
                                  </select> 
                        </div> 
                  
                     
                    
                        <span id="dadosdaturma">
                     
                        <div class="form-group row"> 
                                  <div class="col-sm-3">   
                                       <p>Periodo</p> 
                                                <input type="text" disabled=""  class="form-control " value="' . $periodo . '" > 
                                    </div> 
                              
                                    <div class="col-sm-3"> 
                                         <p>Classe</p> 
                                                <input type="text" disabled=""  class="form-control " value="' . $classe . '" >  
                                        </div> 

                                        <div class="col-sm-6"> 
                                         <p>Curso</p> 
                                                <input type="text" disabled=""  class="form-control " value="' . $curso . '" >  
                                        </div> 
                                </div>

                    </span>

                    <div class="form-group">    
                            <span>Turma 2</span> 
                                 <select name="idturma2" id="idturma2" required  class="form-control">
                                 <option value="0">Nenhuma 2ª Turma</option>

                                  ';

$lista = mysqli_query($conexao, "select idturma, titulo from turmas where idanolectivo='$idanolectivo' order by idturma desc ");
while ($exibir = $lista->fetch_array()) {
  $htm .= '
                                    <option value="' . $exibir["idturma"] . '">' . $exibir["titulo"] . '</option>
                                    ';
}
$htm .= '
                                  </select> 
                        </div> 
                  
                     
                    
                        <span id="dadosdaturma2"></span>


                        <div class="form-group">    
                            <span>Turma 3</span> 
                                 <select name="idturma3" id="idturma3" required  class="form-control">
                                 <option value="0">Nenhuma 3ª Turma</option>

                                  ';

$lista = mysqli_query($conexao, "select idturma, titulo from turmas where idanolectivo='$idanolectivo' order by idturma desc ");
while ($exibir = $lista->fetch_array()) {
  $htm .= '
                                    <option value="' . $exibir["idturma"] . '">' . $exibir["titulo"] . '</option>
                                    ';
}
$htm .= '
                                  </select> 
                        </div> 
                  
                     
                    
                        <span id="dadosdaturma3"></span>



 
                    <div class="form-group">
                         <span>Observações sobre a Disciplina</span>
                        <textarea name="obs" rows="2" class="form-control " title="Alguma observação?" ></textarea>
                    </div>

                     <br>
                    <input type="submit" name="cadastrar"  value="Cadastrar Disciplina Nova" class="btn btn-success" style="float: rigth;">

                     </form>


                        <script>

                            var idturma=document.getElementById("idturma"); 
 

                           idturma.addEventListener("change", function(){
          
                                   var idturma=this.value;

                               $.ajax({
                                url:"cadastro/pesquisarturmadisciplina.php",
                                method:"POST",
                                data:{idturma},
                                success:function(data){

                                $("#dadosdaturma").html(data) 

                                  }
                                })

           
                          })
 
            

                        var idturma2=document.getElementById("idturma2"); 
 

                           idturma2.addEventListener("change", function(){
          
                                   var idturma=this.value;

                               $.ajax({
                                url:"cadastro/pesquisarturmadisciplina.php",
                                method:"POST",
                                data:{idturma},
                                success:function(data){

                                $("#dadosdaturma2").html(data) 

                                  }
                                })

           
                          })
 

                     var idturma3=document.getElementById("idturma3"); 
 

                           idturma3.addEventListener("change", function(){
          
                                   var idturma=this.value;

                               $.ajax({
                                url:"cadastro/pesquisarturmadisciplina.php",
                                method:"POST",
                                data:{idturma},
                                success:function(data){

                                $("#dadosdaturma3").html(data) 

                                  }
                                })

           
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

echo "$htm";
