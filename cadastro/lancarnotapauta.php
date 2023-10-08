<?php 
include("../conexao.php");


$iddisciplina=mysqli_escape_string($conexao, $_POST['iddisciplina']);
$idturma=mysqli_escape_string($conexao, $_POST['idturma']);
$idanolectivo=mysqli_escape_string($conexao, $_POST['idanolectivo']);

    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
     $percentagemrestante=round(1-$dadosdoanolectivo["percentagemdamediadostrimestres"],2);

    $dadosdaturma=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM turmas where idturma='$idturma' "));

    $eclassedeexame=$dadosdaturma['eclassedeexame'];
    
    if($eclassedeexame=='Sim'){  $colspan_do_anolectivo=5; }else{ $colspan_do_anolectivo=4;  }


$htm='
<table class="table table-bordered"  width="100%" id="dataTable" cellspacing="0">
                  <thead>


                    <tr>  
                      <th rowspan="2" align="center">Nº</th>
                      <th rowspan="2" align="center">Nome do Estudante</th>
                      <th colspan="'.$colspan_do_anolectivo.'" align="center">Ano Lectivo: '.$dadosdoanolectivo["titulo"].'</th>
                    </tr>

                     <tr>    
                      <th align="center">'.$dadosdoanolectivo["nomedamediadostrimestres"].'('.$dadosdoanolectivo["percentagemdamediadostrimestres"].')</th>
                      <th align="center">'.$dadosdoanolectivo["nomedaprovadeescola"].'('.$percentagemrestante.')</th> ';

                      if($eclassedeexame=='Sim'){ 
                        $htm.='
                      <th align="center">'.$dadosdoanolectivo["nomedaprovadeexame"].'(100%)</th> '; }

                      $htm.='
                         <th align="center">'.$dadosdoanolectivo["nomedamediaanual"].'(100%)</th>
                         <th align="center">Classificação</th>
                    </tr>

                  </thead>
                  <tbody> 
                      
                      ';  $n=1;
                       $lista=mysqli_query($conexao, "select alunos.nomecompleto, matriculaseconfirmacoes.* from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' order by alunos.nomecompleto"); 

                        $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));


                        $nome_da_provadeescola=$dadosdoanolectivo["nomedaprovadeescola"];
                        $nome_da_provaderecurso=$dadosdoanolectivo["nomedaprovadeexame"];
                        $arredondarmedia_anolectivo=$dadosdoanolectivo["arredondarmedia"]; 
                        $minimoparapositiva=$dadosdaturma["minimoparapositiva"]; 



                       $idprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provadeescola' and idanolectivo='$idanolectivo'"))[0];
                       $idprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT idtipodenota FROM tiposdenotas where titulo='$nome_da_provaderecurso' and idanolectivo='$idanolectivo'"))[0];


                        while($exibir = $lista->fetch_array()){ 

                          $idaluno=$exibir["idaluno"];
                          $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                           $notadaprovadeescola=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovadeescola'"))[0];

                           $notadaprovaderecurso=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  iddisciplina='$iddisciplina' and idtipodenota='$idprovaderecurso'"))[0];

                             $mediadostrimestres=round(mysqli_fetch_array(mysqli_query($conexao," SELECT sum((notas.valordanota*tiposdenotas.percentagemnotrimestre)*trimestres.percentagemnoanolectivo) as media FROM notas, tiposdenotas, trimestres where tiposdenotas.idtipodenota=notas.idtipodenota and tiposdenotas.idtrimestre=trimestres.idtrimestre and notas.idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and notas.iddisciplina='$iddisciplina'"))[0],$arredondarmedia_anolectivo);

                             if ($mediadostrimestres>=$minimoparapositiva) {
                                 $cor_trimestre="Blue";
                              }else{
                                $cor_trimestre="red";
                              }


                             if ($notadaprovadeescola>=$minimoparapositiva) {
                                 $cor_provadeescola="Blue";
                              }else{
                                $cor_provadeescola="red";
                              }


                             if ($notadaprovaderecurso>=$minimoparapositiva) {
                                 $cor_provaderecurso="Blue";
                              }else{
                                $cor_provaderecurso="red";
                              }



                            

                          $htm.='
                          <tr>  
                          <td>'.$n.'</td> 
                          <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'"> '.$exibir['nomecompleto'].' </a></td> 
                          <td style="color: '.$cor_trimestre.'">'.$mediadostrimestres.'</td>
                          <td style="color: '.$cor_provadeescola.'">'.$notadaprovadeescola.'</td>
                          ';
                            if($eclassedeexame=='Sim'){ 
                        $htm.='
                          <td style="color: '.$cor_provaderecurso.'">'.$notadaprovaderecurso.'</td> 
                              '; 
                            }

                              if($notadaprovaderecurso!=''){
                                $nota_final=$notadaprovaderecurso;
                              }else{

                                 $nota_final=round((($dadosdoanolectivo["percentagemdamediadostrimestres"]*$mediadostrimestres)+($notadaprovadeescola*$percentagemrestante)), $arredondarmedia_anolectivo);  
                              }

                               if ($nota_final>=$minimoparapositiva) {

                                 $cor_classificacaofinal="Blue";
                                 $classificacaofinal=$dadosdaturma['classificacaopositiva'];
                              }else{
                                $cor_classificacaofinal="red";
                                $classificacaofinal=$dadosdaturma['classificacaonegativa'];
                              }


                            $htm.='
                            <td style="color: '.$cor_classificacaofinal.'">'.$nota_final.'</td> 
                             <td style="color: '.$cor_classificacaofinal.'">'.$classificacaofinal.'</td> 


                      </tr> '; $n++;
                      }

                      $htm.='
 
                          
                  </tbody>
                </table>



                  <a href="lancarnota.php?iddisciplina='.$iddisciplina.'" class="d-sm-inline-block btn btn-sm btn-success" ><i class="fas fa-fw fa-users"></i> Lançar, editar ou eliminar nota da Pauta</a> <br><br>
                   
                  
                                    <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
 
 ';
echo "$htm";
?>