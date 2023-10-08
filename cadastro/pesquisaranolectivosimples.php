<?php
 
 
include("../conexao.php");

$idanolectivo=$_POST['idanolectivo'];

$turmas= mysqli_query($conexao, "select * from turmas where idanolectivo='$idanolectivo'"); 

                           


 $htm='
<span>Turma</span>
                    <div class="form-group">
                    <select name="turma" id="turma" required  class="form-control">
                        <option>Escolha a Turma</option> 
              ';

                   
                          while($exibir = $turmas->fetch_array()){ 
                            $htm.='
                          <option value="'.$exibir["idturma"].'">'.$exibir["titulo"].'</option>
                        ';}

               $htm.='
                    </select> 
                    </div>


                    <script>


                    var turma=document.getElementById("turma"); 


                     turma.addEventListener("change", function(){
    
                    var idturma=this.value;
                     $.ajax({
                          url:"cadastro/pesquisarturmasimples.php",
                          method:"POST",
                          data:{idturma},
                          success:function(data){

                          $("#dadoslectivos").html(data)
 

                          }
                        })
                    

               
                })


                    </script>

 ';

if(mysqli_num_rows($turmas)==0){
    echo "<div class='alert alert-danger'>Não Existem turmas nesse ano lectivo</div>

     <script> 

     var dadoslectivos=document.getElementById('dadoslectivos');
        dadoslectivos.innerHTML='';
 </script>";
}else{
    echo "$htm";    
}

?>