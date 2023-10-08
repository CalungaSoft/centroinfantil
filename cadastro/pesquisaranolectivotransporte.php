<?php
 
 
include("../conexao.php");

$idanolectivo=$_POST['idanolectivo'];

$transporte= mysqli_query($conexao, "select * from transportes where idanolectivo='$idanolectivo'"); 

   						   


 $htm='
<span>transporte</span>
                    <div class="form-group">
                    <select name="transporte" id="transporte" required  class="form-control">
                        <option>Escolha a transporte</option> 
              '; 

                   
                          while($exibir = $transporte->fetch_array()){ 
                          	$htm.='
                          <option value="'.$exibir["idtransporte"].'">'.$exibir["titulo"].'</option>
                        ';}

               $htm.='
                    </select> 
                    </div>


                    <script>


                    var escolhetransporte=document.getElementById("escolhetransporte"); 


            
                    escolhetransporte.addEventListener("change", function(){
          
                          var idtransporte=this.value;
       
                            if(idtransporte=="0"){
      
                               
                                var dadoslectivos=document.getElementById("dadoslectivos");
                                  dadoslectivos.innerHTML="";
      
                            }else{
      
      
                               $.ajax({
                                url:"cadastro/pesquisartransporte.php",
                                method:"POST",
                                data:{idtransporte},
                                success:function(data){
      
                                $("#dadoslectivos").html(data)
       
      
                                }
                              })
      
      
                            }
                          
                          
                          
      
                     
                      })
      


                    </script>

 ';

if(mysqli_num_rows($transporte)==0){
	echo "<div class='alert alert-danger'>Não Existem transporte nesse ano lectivo</div>

	 <script> 

	 var dadoslectivos=document.getElementById('dadoslectivos');
	 	dadoslectivos.innerHTML='';
 </script>";
}else{
	echo "$htm"; 	
}

?>