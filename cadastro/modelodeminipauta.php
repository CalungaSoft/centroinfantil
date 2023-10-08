<?php 
include("../conexao.php");


 $idanolectivo=$_POST['idanolectivo'];

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
     
$listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");
$numero_total_de_notas=mysqli_fetch_array(mysqli_query($conexao," SELECT sum(numerodenotas) FROM trimestres where idanolectivo='$idanolectivo' "))[0];
   $colspan=mysqli_num_rows($listadetrimestre)+$numero_total_de_notas;
$htm='

 
<table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>


                    <tr>  
                      <th rowspan="3" align="center">Nome do Estudante</th>
                      <th colspan="'.$colspan.'" align="center">Trimestres (Disciplina XYZ)</th>
                    </tr>

                     <tr>    
                      ';
                        while($exibir = $listadetrimestre->fetch_array()){
                        	$colspan_do_trimestre=$exibir["numerodenotas"]+1;
                        	$htm.='
                      <th align="center" colspan="'.$colspan_do_trimestre.'" >'.$exibir["titulo"].'('.$exibir["percentagemnoanolectivo"].')</th>';
                  		}

                  		$htm.='
 
                         
                    </tr>


                     <tr>    
                      ';

                      $listadetrimestre=mysqli_query($conexao," SELECT * FROM trimestres where idanolectivo='$idanolectivo' order by posicao ");

                      while($exibir = $listadetrimestre->fetch_array()){

                      		$idtrimestre=$exibir["idtrimestre"];

                      		$listadenotas=mysqli_query($conexao," SELECT * FROM tiposdenotas where idtrimestre='$idtrimestre' order by posicao ");



		                        while($mostrar = $listadenotas->fetch_array()){ 
		                        	$htm.='
		                      <th align="center" >'.$mostrar["titulo"].'('.$mostrar["percentagemnotrimestre"].')</th>';
		                  		}

		                  		$htm.='
		                  		<th align="center" >'.$exibir["nomedamedia"].'(100%)</th>
		                  		';
                  		}

                  		$htm.='
 
                         
                    </tr>


                  </thead>
                  <tbody> 

                  '; 

                  for ($i=1; $i <4 ; $i++) { 
                  	 $htm.='
                   

                    <tr>  
                      <td> Estudante '.$i.'</td> 

                     ';

                     for ($j=1; $j <=$colspan; $j++) { 
                     	 $htm.='
                     	  <td></td> ';
                     }
                     $htm.='</tr>';

                    }

                    $htm.='

 

                  </tbody>
                </table>';
echo "$htm";
?>