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

   $id=mysqli_escape_string($conexao, $_POST['id']);

        $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM entradas where identrada='$id'"));
        
            $descricaonaentrada=$dados["descricao"];
            $valorantigo=$dados["valor"]; 

            $tipo=$dados["tipo"];
            $idtipo=$dados["idtipo"];

 
           $idfuncionario=$idlogado;


         
         $outro_id=mysqli_fetch_array(mysqli_query($conexao," SELECT identrada FROM entradas where idtipo='$idtipo' and tipo='$tipo' and identrada!='$id' limit 1"))[0];
 
           $valorantigoh=number_format($valorantigo,2,",", ".");  

           $antigo="$descricaonaentrada | Valor: $valorantigoh KZ <a href=entradamatricula.php?identrada=$outro_id>Clique para ver</a>";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");





            $actualizandopagamentos=mysqli_query($conexao,"UPDATE `matriculaseconfirmacoes` SET `valorpago` =`valorpago`-'$valorantigo'  WHERE `matriculaseconfirmacoes`.`idmatriculaeconfirmacao` = '$idtipo'");

             $insirindo_dividas=mysqli_query($conexao, "Delete from entradas where identrada='$id'");

             $zerando_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='0' WHERE tipo='$tipo' and idtipo='$idtipo'");

             $preco=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(preco-desconto) as preco FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$idtipo' "))['preco'];

             $valorpago=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valorpago FROM entradas where  tipo='$tipo' and idtipo='$idtipo' "))['valorpago'];

                   $divida_nova=round(($preco-$valorpago),2);


             $insirindo_dividas=mysqli_query($conexao,"UPDATE `entradas` SET  `divida` ='$divida_nova' WHERE tipo='$tipo' and idtipo='$idtipo' order by identrada desc limit 1");




  
        if($insirindo_dividas){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso | Os cálcos com os novos valores serão feitos após a actualização da página, <a href="entradamatricula.php?identrada='.$outro_id.'">Clique aqui para actualizar a página!</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 

}


?>