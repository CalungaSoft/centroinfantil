<?php 
include("../conexao.php");


 $idanolectivo=$_POST['idanolectivo'];

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
     $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);


$htm='
<table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>


                    <tr>  
                      <th rowspan="2" align="center">Nome do Estudante</th>
                      <th colspan="4" align="center">Disciplina</th>
                    </tr>

                     <tr>    
                      <th align="center">'.$dadosdoanolectivo["nomedamediadostrimestres"].'('.$dadosdoanolectivo["percentagemdamediadostrimestres"].')</th>
                      <th align="center">'.$dadosdoanolectivo["nomedaprovadeescola"].'('.$percentagemrestante.')</th>
                      <th align="center">'.$dadosdoanolectivo["nomedaprovadeexame"].'(100%) (Caso aplicavel)</th>
                         <th align="center">'.$dadosdoanolectivo["nomedamediaanual"].'(100%)</th>
                    </tr>

                  </thead>
                  <tbody> 
                    <tr>  
                      <td> Estudante 1</td> 

                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>


                    </tr> 

                    <tr>  
                      <td> Estudante 2</td> 

                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>


                    </tr> 

                    <tr>  
                      <td> Estudante 3</td> 

                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>


                    </tr> 

                  </tbody>
                </table>';
echo "$htm";
?>