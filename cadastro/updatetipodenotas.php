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

 

if(isset($_POST["id"])){

    $valor=mysqli_real_escape_string($conexao, $_POST["valor"]);
    if($valor!=""){
        if($_POST["nomedacoluna"]=='percentagemnotrimestre'){

            if($valor>=0 && $valor<=1) {

                $query="UPDATE tiposdenotas set ".$_POST["nomedacoluna"]."='".$valor."' where idtipodenota='".$_POST["id"]."'";
 
                    if(mysqli_query($conexao, $query)){
                        echo '<div class="alert alert-success"> '.$_POST["nomedacoluna"].'  Alterado para '.$valor.' | <a  href=""> Clique aqui para actualizar os cálculos </a>  </div>';
                   }

            }else{
                 echo '<div class="alert alert-danger">A Percentagem deve estar entre 0 e 1</div>';
            }

             

        }else{
             $query="UPDATE tiposdenotas set ".$_POST["nomedacoluna"]."='".$valor."' where idtipodenota='".$_POST["id"]."'";
 
        if(mysqli_query($conexao, $query)){
            echo '<div class="alert alert-success"> '.$_POST["nomedacoluna"].'  Alterado para '.$valor.'  </div>';
       }

        }
       

    }else{
        echo '<div class="alert alert-danger">Campo Vazio não pode ser alterado!</div>';
    }
    
    
}







?>