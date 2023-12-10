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

 
 

  
    $ano=mysqli_escape_string($conexao,$_POST['ano']);
    $mes=mysqli_escape_string($conexao,$_POST['mes']);
    $dia=mysqli_escape_string($conexao,$_POST['dia']); 
    $tipoderefeicao=mysqli_escape_string($conexao,$_POST['tipoderefeicao']);
    $descricaodarefeicao=mysqli_escape_string($conexao,$_POST['descricaodarefeicao']);  

     
    
        $data="$ano-$mes-$dia";
        
    
    
                            if (trim($descricaodarefeicao)!='') {
                     
                             
    
                                    $dadosdanota=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM ementamensal where dia='$data' and tipoderefeicao='$tipoderefeicao' limit 1"));
     
                                    $descricaodarefeicao_antiga=$dadosdanota["descricaodarefeicao"];
                                    $idementa=$dadosdanota["id"];
    
                                    if($descricaodarefeicao!=$descricaodarefeicao_antiga){
    
                                        $actualizar=mysqli_query($conexao,"UPDATE `ementamensal` SET `descricaodarefeicao` = '$descricaodarefeicao' WHERE id = '$idementa'");
    
                                        if($actualizar){ 
    
                                            echo '<div class="alert alert-success">'.$descricaodarefeicao.' - Ementa Mensal Actualizada com sucesso!</div>';
                                        }
    
                                    }
                        
                  
                                    
    
                             
    
                           
                     }else{

                        
                        echo '<div class="alert alert-danger">O campo está vazio</div>';
                       
                     }
                
    
     
     
             
                    
                
                
    