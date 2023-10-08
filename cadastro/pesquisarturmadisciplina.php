<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["idturma"])){
  
    $idturma=$_POST["idturma"];

$dadoslectivos= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 
 
                           $idperiodo=$dadoslectivos["idperiodo"];
                           $idcurso=$dadoslectivos["idcurso"]; 
                           $idclasse=$dadoslectivos["idclasse"]; 
 

                           $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                            $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0]; 

                            $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];


$htm='
                     <div class="form-group row"> 
                      <div class="col-sm-3">   
                           <p>Periodo</p> 
                                    <input type="text" disabled=""  class="form-control " value="'.$periodo.'" > 
                        </div> 
                  
                        <div class="col-sm-3"> 
                             <p>Classe</p> 
                                    <input type="text" disabled=""  class="form-control " value="'.$classe.'" >  
                            </div> 

                            <div class="col-sm-6"> 
                             <p>Curso</p> 
                                    <input type="text" disabled=""  class="form-control " value="'.$curso.'" >  
                            </div> 
                    </div>

 ';

 echo "$htm";
}


?>