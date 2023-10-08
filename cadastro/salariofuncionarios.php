<?php 
include("../conexao.php");

        $funcionarioescolhido=$_POST['funcionarioescolhido'];
        $anoescolhido=$_POST['anoescolhido'];
        $mesescolhido=$_POST['mesescolhido'];
        $datadehoje=date("d/m/Y");
        $totaldehoras=0;
        $salariototal=0;
        $totaldediassemremuneracao=0;
        $totaldediascomremuneracao=0;
        $diferentessalarios="esmael";
        $contadordesalario=0;
        $horassuplementares=0;
        $salariosuplementar=0;

       
        $dadosdofuncionario=mysqli_fetch_array(mysqli_query($conexao,"SELECT  TIMESTAMPDIFF(YEAR,datadeentrada,CURDATE()) as anosnaempresa, salarioporhora, salario, nomedofuncionario FROM funcionarios where idfuncionario='$funcionarioescolhido'")); 
        $salariosemhorasextras=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(salariopordia) FROM presenca where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and mes='$mesescolhido'"))[0]+0; 
        $salariodashorasextras=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(salariopelahorasextras) FROM presenca where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and mes='$mesescolhido'"))[0]+0; 

        $salariobruto=$salariosemhorasextras+$salariodashorasextras;
        $numerodefalta=mysqli_num_rows(mysqli_query($conexao,"SELECT idfalta FROM presenca where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and mes='$mesescolhido' and remunerar=0"))+0; 
        $horasdetrabalho=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(horastrabalhadas) FROM presenca where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and mes='$mesescolhido'"))[0]+0; 
        $horasextras=mysqli_fetch_array(mysqli_query($conexao,"SELECT sum(horasextras) FROM presenca where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and mes='$mesescolhido'"))[0]+0; 

        $totaldehoras=$horasdetrabalho+$horasextras;
       
          $salariosemhorasextras_f=number_format($salariosemhorasextras,2,",", ".");  
          $salariodashorasextras_f=number_format($salariodashorasextras,2,",", "."); 
          $salariobruto_f=number_format($salariobruto,2,",", "."); 
         
           $salsupl=number_format($salariosuplementar,2,",", "."); 
           $nomedofuncionario=$dadosdofuncionario["nomedofuncionario"];
           $anosnaescola=$dadosdofuncionario["anosnaempresa"];

           $jatemsubsidiodefeiras=mysqli_num_rows(mysqli_query($conexao,"SELECT idsalario FROM salario where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and subsidiodeferias!='0'"))+0; 
           $jatemsubsidiodenatal=mysqli_num_rows(mysqli_query($conexao,"SELECT idsalario FROM salario where idfuncionario='$funcionarioescolhido' and ano='$anoescolhido' and mes='12' and subsidiodenatal!='0'"))+0; 


           $salarioactual=number_format($dadosdofuncionario["salario"],2,",", "."); 
           $salarioactualporhora=number_format($dadosdofuncionario["salarioporhora"],2,",", "."); 

            $html=" 
            <strong>Nº Faltas</strong>: ".$numerodefalta." <br>
            <strong>Total de horas trabalhadas</strong>: ".$totaldehoras." H (Horas Normais: ".$horasdetrabalho." | Horas Extras: ".$horasextras." H) <br>
            <strong>Salário (actual) </strong>: Base: ".$salarioactual." KZ  | Por Hora ".$salarioactualporhora." KZ <br> 
            <strong>Salário Mensal (sem horas extras)</strong>: ".$salariosemhorasextras_f." KZ <br> 
            <strong>Horas Extras</strong>: ".$horasextras." H | ".$salariodashorasextras_f." KZ<br> 
            <strong>Salario Mensal (com horas extras)</strong>: ".$salariobruto_f." KZ<br> 
            <strong>Data de Fecho</strong>: ".$datadehoje." <br>
            <br>
           
            <input type='hidden' name='funcionarioescolhido'  value='".$funcionarioescolhido."'>  
            <input type='hidden' name='anoescolhido'  value='".$anoescolhido."'>  
            <input type='hidden' name='mesescolhido'  value='".$mesescolhido."'>  
            <input type='hidden' name='nomedofuncionario'  value='".$nomedofuncionario."'>    
            <input type='hidden' name='faltas'  value='".$numerodefalta."'>  
            <input type='hidden' name='horastrabalhadas'  value='".$horasdetrabalho."'>  
            <input type='hidden' name='salarioactual'  value='".$dadosdofuncionario["salario"]."'>  
            <input type='hidden' name='salarioactualporhora'  value='".$dadosdofuncionario["salarioporhora"]."'>  
            <input type='hidden' name='horasextras'  value='".$horasextras."'>  
            <input type='hidden' name='salarioextra'  value='".$salariodashorasextras."'>  
            <input type='hidden' id='valorporreceber' name='valorporreceber'  value='".$salariobruto."'>  <br>

            <span> Abono de Família </span>
            <input type='number' id='abonodefamilia' name='abonodefamilia' class='form-control' placeholder='Abono de Família' title='insira a percentagem do IRT'> <br> 

            <hr><hr><hr>  Descontos:<br><br>
            <span> IRT </span>
              <input type='number' id='irt' name='irt' class='form-control' placeholder='IRT(%) | D02' title='insira a percentagem do IRT'> <br> 
              <span> Segurança Social </span>
              <input type='number' id='segurancasocial' name='segurancasocial' class='form-control' placeholder='Seguranca Social(%)' title='insira a percentagem que vai para segurança social (%)'> <br> 
             <span> Outros Descontos</span>
              <input type='number' id='outrosdescontos' name='outrosdescontos' class='form-control' placeholder='Outros descontos' title='Outro desconto não específico que o funcionário ficou sugeito'> <br> 
           

            <hr><hr><hr>  Acrescimos:<br><br>
         
            <input "; if($jatemsubsidiodefeiras==0 && $anosnaescola>0){ $html.="number"; } else { $html.=" type='hidden' "; } $html.=" id='subsidiodeferias' name='subsidiodeferias' class='form-control' placeholder='Subsidio de Férias' > <br> 
            <input "; if($jatemsubsidiodenatal==0 && $mesescolhido==12){ $html.="number"; } else { $html.=" type='hidden' "; } $html.=" id='subsidiodenatal' name='subsidiodenatal' class='form-control' placeholder='Percentagem para subsídio de Natal(%)' > <br> 
           
            <h2> <button id='calcular' class='btn btn-primary'>Calcular Salário Líquido</button>  = <span id='resultado'> </span></h2> <br><br>
            
          
            <hr><hr><hr>  Pagamento:<br><br>

            <span>Ano Lectivo</span>
                    <div class='form-group'>
                    <select name='idanolectivo'  id='anolectivo' required  class='form-control'> 
                      ";
                           $lista=mysqli_query($conexao,"SELECT * from anoslectivos");
                          while($exibir = $lista->fetch_array()){  

                            $html.='
                          <option '; if($exibir["vigor"]=='Sim'){ $html.='selected';} $html.=' value="'.$exibir["idanolectivo"].'">'.$exibir["titulo"].'</option>
                        '; } 

                        $html.=" 
                    </select> 
                    </div>


            <span> Valor a ser Entregue ao Funcionário </span>
            <input type='number' name='valoraserpago' class='form-control' title='O valor que o funcionário vai receber nesse exacto momento' placeholder='Valor a Ser pago'><br>";
 

                     $html.='

                        <div class="form-group"> 

                            <span>Forma de Pagamento</span>
                                  <select name="formadepagamento" required  class="form-control" title="Forma de pagamento"  > 
                                  <option disabled="">Formas de Pagamentos</option>
                                 ';
                                      $formasdepagamento=mysqli_query($conexao, "select * from formasdepagamento"); 
                                      while($exibir = $formasdepagamento->fetch_array()){ 
                                        $html.='
                                      <option  value="'.$exibir["formadepagamento"].'">'.$exibir["formadepagamento"].'</option>
                                    ';}

                                    $html.='
                                </select> 
       
                      
                        </div> ';

                      


            $html.="
            <input type='text' name='obs' class='form-control' placeholder='Observações'><br><br>

             <input type='submit' name='pagarsalario' value='Fazer o Pagamento' class='btn btn-success' style='float: rigth;'>
            
             <script> 

             var valorporreceber=Number(document.getElementById('valorporreceber').value);
             var abonodefamilia=document.getElementById('abonodefamilia');
             var subsidiodeferias=document.getElementById('subsidiodeferias');
             var subsidiodenatal=document.getElementById('subsidiodenatal');
             var segurancasocial=document.getElementById('segurancasocial');
             var outrosdescontos=document.getElementById('outrosdescontos');
             
             var irt=document.getElementById('irt');
             
             
             var botao=document.getElementById('calcular');
             var resultado=document.getElementById('resultado');
          

             botao.addEventListener('click', function(){
              event.preventDefault();

              var abonodefamilia_f=Number(abonodefamilia.value);
              var subsidiodeferias_f=Number(subsidiodeferias.value);
              var subsidiodenatal_f=Number(subsidiodenatal.value);
              var segurancasocial_f=Number(segurancasocial.value);
              var outrosdescontos_f=Number(outrosdescontos.value);
            
              var irt_f=Number(irt.value);

              var salariobruto=valorporreceber+abonodefamilia_f;
              var salariobrutocomirt=salariobruto-salariobruto*(irt_f/100);
              var salariobrutocomirtsgsocial=salariobrutocomirt-salariobrutocomirt*(segurancasocial_f/100);
              var calculo=salariobrutocomirtsgsocial+salariobrutocomirtsgsocial*(subsidiodeferias_f/100)+salariobrutocomirtsgsocial*(subsidiodenatal_f/100)-outrosdescontos_f; 
             
              resultado.innerHTML=calculo;
             })
          
             

             
             </script>
        
             
       "; 

       echo $html;

?>
