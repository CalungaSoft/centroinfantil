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

 
        
          
          $tipo=$dados["tipo"];
          $idtipo=$dados["idtipo"];

          $primeiroid=mysqli_fetch_array(mysqli_query($conexao," SELECT identrada FROM entradas where idtipo='$idtipo' and tipo='$tipo' order by identrada asc limit 1"))[0];

           $dados=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(valor) as valor, sum(divida) as divida, descricao  FROM entradas where idtipo='$idtipo' and tipo='$tipo'"));

            $descricaonaentrada=$dados["descricao"];
            $valorantigo=$dados["valor"];
            $dividaantigo=$dados["divida"];

 
 
           $idfuncionario=$idlogado;

           $valorantigoh=number_format($valorantigo,2,",", "."); 
           $dividaantigoh=number_format($dividaantigo,2,",", ".");  

           $antigo="Todos  os dados de($descricaonaentrada) | Valor: $valorantigoh KZ | Por Consolidar $dividaantigo KZ | <a href=entradapropina.php?identrada=$primeiroid>Clique para ver</a>";
           $novo="Eliminado";
           
           $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idfuncionario', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");

  
 
 





        $dadosdapropinas=mysqli_fetch_array(mysqli_query($conexao," SELECT YEAR(mespago) as ano, MONTH(mespago) as mes, propinasdoatl.* FROM propinasdoatl where idpropinadoatl='$idtipo'"));
   
            $mes=$dadosdapropinas["mes"];
            $ano=$dadosdapropinas["ano"];

            $idpropinadoatl=$dadosdapropinas["idpropinadoatl"];
            $idaluno=$dadosdapropinas["idaluno"];

            $idmatriculaatl=$dadosdapropinas["idmatriculaatl"];

            $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao, "select nomecompleto from alunos where idaluno='$idaluno'"))[0];
        
        $pagamentoanterior=mysqli_num_rows(mysqli_query($conexao," SELECT * FROM propinasdoatl where idmatriculaatl='$idmatriculaatl'"));
    
        if($pagamentoanterior==1){

            $Actualizando=mysqli_query($conexao,"UPDATE `matriculaatl` SET `ultimomespago` = '0000-00-00' WHERE `matriculaatl`.`idmatriculaatl` = '$idmatriculaatl'");

              if ($Actualizando) {
                
                $elimindo=mysqli_query($conexao, "Delete from propinasdoatl where idpropinadoatl='$idtipo'");

                    if ($elimindo) {
                         
                        $antigo="Eliminado o pagamento de propinas do atl do aluno  <a href=aluno.php?idaluno=$idaluno>$nomedoaluno </a> do mês de 0$mes/$ano";
                        $novo="Eliminado";
                        
                        $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                        
                            if($guardar){

                                $elimindodasentradas=mysqli_query($conexao, "Delete from entradas where idtipo='$idtipo' and tipo='$tipo' and idaluno='$idaluno'");

                                    if ($elimindodasentradas) {
                                        echo '<div class="alert alert-success"> Todos  os registros relacionados com essa propinasdoatl foram elimanadas com sucesso!  </div>';
                                    }else{
                                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu elimanar os dados financeiros dessa propina.</div>';
                                    }

                            }else{
                                echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu guardar o registro nos históricos</div>';
                            }
                        
                    }else{

                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu aliminar o registro de propinas</div>';
                    }

              }else{

                echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não consegui actualizar o último pagamento.</div>';

              }

        }else if($pagamentoanterior>1){

        
                $elimindo=mysqli_query($conexao, "Delete from propinasdoatl where idpropinadoatl='$idtipo'");

                    if ($elimindo) {
                         
                        $antigo="Eliminado o pagamento de propina do aluno  <a href=aluno.php?idaluno=$idaluno>$nomedoaluno </a> do mês de 0$mes/$ano";
                        $novo="Eliminado";
                        
                        $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)");
                        
                            if($guardar){ 

                                $elimindodasentradas=mysqli_query($conexao, "Delete from entradas where idtipo='$idtipo' and tipo='$tipo' and idaluno='$idaluno'");

                                    if ($elimindodasentradas){

                                        $maiorano=mysqli_fetch_array(mysqli_query($conexao," SELECT YEAR(mespago) FROM propinasdoatl where idmatriculaatl='$idmatriculaatl' order by YEAR(mespago) desc limit 1"))[0];
                                        $maiormes=mysqli_fetch_array(mysqli_query($conexao," SELECT MONTH(mespago) FROM propinasdoatl where idmatriculaatl='$idmatriculaatl'  and YEAR(mespago)='$maiorano' order by MONTH(mespago) desc limit 1"))[0];

                                        $mespago=$maiormes;
                                        $anopago=$maiorano;
                                        
                                        $ultimopagamentodoaluno="1/".$mespago."/".$anopago."";
          
  
                                        $Actualizando=mysqli_query($conexao,"UPDATE `matriculaatl` SET `ultimomespago` = STR_TO_DATE('$ultimopagamentodoaluno', '%d/%m/%Y') WHERE `matriculaatl`.`idmatriculaatl` = '$idmatriculaatl'");
      
                                        if ($Actualizando) {
                                            
                                            echo '<div class="alert alert-success">Todos  os registros relacionados com essa propinasdoatl foram elimanadas com sucesso! <a href=index.php> clique aqui para actualizar a página</a></div>';

                                          }else{

                                            echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu elimanar os dados financeiros dessa propinas.</div>';

                                          }
                                        
                                    }else{
                                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu elimanar os dados financeiros dessa propinas.</div>';
                                    }

                            }else{
                                echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu guardar o registro nos históricos</div>';
                            }
                        
                    }else{

                        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro! o sistema não conseguiu aliminar o registro de propinas</div>';
                    }
 
                }


 
  
        if(mysqli_query($conexao, "Delete from entradas where idtipo='$idtipo' and tipo='$tipo'")){
            echo '<div class="alert alert-success"> Registro Eliminado com Sucesso   <a href="index.php">Clique aqui para ir a página inicial</a> </div>';
       }
       else{
        echo '<div class="alert alert-danger">Ocorreu um erro ao eliminar registro!</div>';
     
    }
 


}

?>