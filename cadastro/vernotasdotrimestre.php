 <?php
include("../conexao.php");

$idtrimestre=$_POST['id']; 
 
 $dados_do_trimestre=mysqli_fetch_array(mysqli_query($conexao, "select * from trimestres where idtrimestre='$idtrimestre'")); 
                    
                    $idanolectivo=$dados_do_trimestre["idanolectivo"];
                    $titulo=$dados_do_trimestre["titulo"];   



$htm='


 <form action="" method="post">
   <input type="hidden" name="idtrimestre" value="'.$idtrimestre.'"  >

                      <br>
                    <h3>Cadastrando um novo Tipo de nota para o '.$titulo.' trimestre </h3>

                     <div class="form-group">
                           ';

                            $lista=mysqli_query($conexao, "select distinct(titulo) from tiposdenotas"); 
                        
                          $htm.='
                          <span>Título do tipo de nota</span>
                      <input type="text" name="titulo" autocomplete="off" list="tipo" class="form-control"  placeholder="Título para o tipo de nota" required="">
                      <datalist id="tipo">
                        ';  while($exibir = $lista->fetch_array()){ $htm.='
                         <option value="'.$exibir['titulo'].'"> 
                        '; } $htm.='
                    </datalist>
                    </div> 

                    

                     <div class="form-group"> 
                          <span>Percentagem da nota na média do trimestre</span>
                      <input type="number" step="0.05" min="0" max="1" name="percentagemnotrimestre"  class="form-control"  placeholder="Percentagem da nota na média do trimestre" required="" value="0.5"> 
                    </div>

 
                     <div class="form-group">
                          ';

                           $posicao=mysqli_num_rows(mysqli_query($conexao, "select * from tiposdenotas where idtrimestre='$idtrimestre'"))+1; 
                        
                         $htm.='
                          <span>Posição do Trimestre no trimestre</span>
                      <input type="number" step="1" min="0" max="6" name="posicao"  class="form-control"  placeholder="Percentagem da Nota no trimestre" required="" value="'.$posicao.'"> 
                    </div> 


 


                     

                          <br>
                            <input type="submit" name="cadastrarnota" value="Cadastrar Tipo de nota no trimestre"  class="btn btn-success" style="float: rigth;">
            

          </form>







';
 echo "$htm";
                   
?>