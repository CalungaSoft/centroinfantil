<?php

include("../conexao.php");

session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;
$idcaixa=isset($_SESSION['idcaixa']);

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel'];

 

if(isset($_POST["id"])){

    $valor=mysqli_real_escape_string($conexao, $_POST["valor"]);
    $id=mysqli_escape_string($conexao, trim($_POST['id']));

    if($valor!=""){
        $query="UPDATE saidas set ".$_POST["nomedacoluna"]."='".$valor."' where idsaida='$id'";

        if($_POST["nomedacoluna"]=="valor"){
            $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT valor, descricao FROM saidas where idsaida='$id'"));
            
            $descricaonasaida=$dados["descricao"];
            $valorantigo=$dados["valor"];

           $totalpago=$valor-$valorantigo;

           if($totalpago!=0){
                
               $idfuncionario=$idlogado;

               $valorantigoh=number_format($valorantigo,2,",", "."); 
               $totalpagoh=number_format($valor,2,",", "."); 

               $antigo="$descricaonasaida | $valorantigoh KZ";
               $novo="$descricaonasaida | $totalpagoh KZ";
               
               $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");

               if(mysqli_query($conexao, $query)){
                echo '<div class="alert alert-success"> '.$_POST["nomedacoluna"].'  Alterado para '.$valor.' | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="">Clique aqui para actualizar a página!</a> </div>';
                }
             }

            

            }

            if($_POST["nomedacoluna"]=="divida"){
                $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT divida, descricao FROM saidas where idsaida='$id'"));
                
                $descricaonasaida=$dados["descricao"];
                $dividaantigo=$dados["divida"];
    
               $totalpago=$valor-$dividaantigo;
    
               if($totalpago!=0){
                    
                   $idfuncionario=$idlogado;
    
                   $valorantigoh=number_format($dividaantigo,2,",", "."); 
                   $totalpagoh=number_format($valor,2,",", "."); 
    
                   $antigo="$descricaonasaida |Por Consolidadar $valorantigoh KZ";
                   $novo="$descricaonasaida |Por Consolidadar $totalpagoh KZ";
                   
                   $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");

                            if(mysqli_query($conexao, $query)){
                                echo '<div class="alert alert-success"> '.$_POST["nomedacoluna"].'  Alterado para '.$valor.' </div>';
                        }
    

                 }
    
              
                }

                
            if($_POST["nomedacoluna"]=="descricao"){
                $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT valor, descricao FROM saidas where idsaida='$id'"));
                
                $descricaonasaida=$dados["descricao"];
                $valorantigo=$dados["valor"];
     
    
               if($descricaonasaida!=$valor){
                    
                   $idfuncionario=$idlogado;
    
                   $valorantigoh=number_format($valorantigo,2,",", ".");  
    
                   $antigo="$descricaonasaida | $valorantigoh KZ";
                   $novo="$valor | $valorantigoh KZ";
                   
                   $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'edição', '$antigo', '$novo', CURRENT_TIMESTAMP)");

                   if(mysqli_query($conexao, $query)){
                    echo '<div class="alert alert-success"> '.$_POST["nomedacoluna"].'  Alterado para "'.$valor.'"</div>';
               }

                 } 

                }

    

    }else{
        echo '<div class="alert alert-danger">Campo Vazio não pode ser alterado!</div>';
    }
    
    
}







?>