<?php
 
 
include("../conexao.php");

$idanolectivo=$_POST['idanolectivo'];

$atl= mysqli_query($conexao, "select * from atl where idanolectivo='$idanolectivo'"); 

   						   


 $htm='
<span>ATL</span>
                    <div class="form-group">
                    <select name="atl" id="atl" required  class="form-control">
                        <option>Escolha a atl</option> 
              '; 

                   
                          while($exibir = $atl->fetch_array()){ 
                          	$htm.='
                          <option value="'.$exibir["idatl"].'">'.$exibir["titulo"].'</option>
                        ';}

               $htm.='
                    </select> 
                    </div>


                    <script>


 					var atl=document.getElementById("atl"); 


            		 atl.addEventListener("change", function(){
    
                    var idatl=this.value;
                     $.ajax({
                          url:"cadastro/pesquisaratl.php",
                          method:"POST",
                          data:{idatl},
                          success:function(data){

                          $("#dadoslectivos").html(data)
 

                          }
                        })
                    

               
                })


                    </script>

 ';

if(mysqli_num_rows($atl)==0){
	echo "<div class='alert alert-danger'>Não Existem ATL nesse ano lectivo</div>

	 <script> 

	 var dadoslectivos=document.getElementById('dadoslectivos');
	 	dadoslectivos.innerHTML='';
 </script>";
}else{
	echo "$htm"; 	
}

?>