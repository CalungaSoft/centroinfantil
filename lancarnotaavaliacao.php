<?php 
include("conexao.php");

    
session_start();

if(!isset($_SESSION['logado'])):
   header('Location: login.php');
endif;

$nome=$_SESSION['nomedofuncionariologado'];
 
$idlogado=$_SESSION['funcionariologado'] ;
$nomelogado=$_SESSION['nomedofuncionariologado'];
$painellogado=$_SESSION['painel']; 

 


$iddisciplina=isset($_GET['iddisciplina'])?$_GET['iddisciplina']:"";

    $dadosdadisciplina= mysqli_fetch_array(mysqli_query($conexao, "select * from disciplinas where iddisciplina='$iddisciplina' limit 1")); 

    $idanolectivo=$dadosdadisciplina["idanolectivo"];


$idtrimestre_padrao=mysqli_fetch_array(mysqli_query($conexao, "select idtrimestre from trimestres where idanolectivo='$idanolectivo' order by titulo desc"))[0]; 

  $idtrimestre=isset($_GET['idtrimestre'])?$_GET['idtrimestre']:"$idtrimestre_padrao";
$idtrimestre=mysqli_escape_string($conexao, $idtrimestre); 
 
   $nome_do_trimestre=mysqli_fetch_array(mysqli_query($conexao, "select titulo from trimestres where idtrimestre='$idtrimestre' limit 1"))[0]; 
 


 

 if(!(($dadosdadisciplina["idprofessor"]==$idlogado || $dadosdadisciplina["idprofessorauxiliar"]==$idlogado ) || $painellogado=="areapedagogica" || $painellogado=="administrador")){
   header('Location: login.php');
}

 $idnota_vinculada=mysqli_fetch_array(mysqli_query($conexao," SELECT   notavinculada FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' order by idavaliacao asc limit 1 "))[0];
  $nome_da_notavinculada=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM notasdoano where idnotadoano='$idnota_vinculada' limit 1"))[0];


if(isset($_POST['criaravaliacao'])){
  
  if(!empty(trim($_POST['titulodaavaliacao']))){ 
   
      $titulodaavaliacao=mysqli_escape_string($conexao,$_POST['titulodaavaliacao']); 
      $data=mysqli_escape_string($conexao,$_POST['data']); 

      $idnotadoano=mysqli_escape_string($conexao,$_POST['idnotadoano']); 

        $existe=mysqli_num_rows(mysqli_query($conexao, "select idavaliacao from avaliacoes where titulo='$titulodaavaliacao' and idtrimestre='$idtrimestre' and iddisciplina='$iddisciplina'"));
      
          if($existe==0){


            $idturma=$dadosdadisciplina["idturma"];

                
                $salvar= mysqli_query($conexao,"INSERT INTO `avaliacoes` (titulo, data, idtrimestre, iddisciplina, notavinculada, idturma) VALUES ('$titulodaavaliacao',  STR_TO_DATE('$data', '%d/%m/%Y'), '$idtrimestre', '$iddisciplina', '$idnotadoano', '$idturma')");
                 
               if($salvar){

                $acertos[]="$titulodaavaliacao foi Cadastrado com sucesso";

            }else{

              $erros[]="Ocorreu um erro Ao Cadastrar a avaliação";

            } 
          }else{

        $erros[]="Já existe uma avaliação com esse título nesse trimestre e disciplina";
      }

    }  else{
    $erros[]=" O campo título não pode ir vazio";
  }
   

}



if(isset($_POST['criarvinculo'])){ 
   
      $idnotadoano=mysqli_escape_string($conexao,$_POST['idnotadoano']); 
        

                $salvar= mysqli_query($conexao,"UPDATE `avaliacoes` SET `notavinculada` = '$idnotadoano' WHERE iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre'");
                 
               if($salvar){

                $acertos[]="Vínculo criado com sucesso!";

            }else{

              $erros[]="Ocorreu um erro Ao vincular a média com essa nota";

            } 
           
    

}


 if(isset($_GET['del'])){
      
      $iddanota=mysqli_escape_string($conexao, trim($_GET['id']));  
      
      if(isset($_GET['id']) || $_GET['id']>0){



 

         $dadosdanota_sendoeliminad=mysqli_fetch_array(mysqli_query($conexao,"SELECT * FROM notasavaliacao where idnotaavaliacao='$iddanota' limit 1"));

         $idmatriculaeconfirmacao=$dadosdanota_sendoeliminad["idmatriculaeconfirmacao"];
         $idavaliacao_eliminada=$dadosdanota_sendoeliminad["idavaliacao"];
         $valordanota=$dadosdanota_sendoeliminad["valordanota"];

          $iddisciplina_eliminada=mysqli_fetch_array(mysqli_query($conexao," SELECT iddisciplina FROM avaliacoes where idavaliacao='$idavaliacao_eliminada' limit 1"))[0];



         $dadosdadisciplina_sendoeliminada=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo, idprofessor, idprofessorauxiliar FROM disciplinas where iddisciplina='$iddisciplina_eliminada'"));

         $nomedadisciplina_s_eliminada=$dadosdadisciplina_sendoeliminada["titulo"];
          

               $idaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT idaluno FROM matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'"))[0];

      
             

              $nomedoaluno=mysqli_fetch_array(mysqli_query($conexao,"SELECT nomecompleto FROM alunos where idaluno='$idaluno'"))[0];



                      $antigo="Foi eliminada a nota do aluno <a href=aluno.php?idaluno=$idaluno>$nomedoaluno</a> da disciplina de $nomedadisciplina_s_eliminada |Valor da Nota: $valordanota ";
                     $novo="Eliminada";

                      $guardar=mysqli_query($conexao,"INSERT INTO `historico` (`idhistorico`, `idfuncionario`, `descricao`, `antigo`, `novo`, `data`) VALUES (NULL, '$idlogado', 'Eliminação', '$antigo', '$novo', CURRENT_TIMESTAMP)"); 

                     $salvar=mysqli_query($conexao,"DELETE FROM `notasavaliacao` WHERE idnotaavaliacao='$iddanota'");

                if($salvar){
                  $acertos[]="Nota do Aluno Eliminada com Sucesso!";
                }else{
                  $erros[]="ocorreu algum erro!";
                } 
 
        
  }else{
 $erros[]="Nenhuma Nota selecionada";
  }

}



       $idnota_vinculada=mysqli_fetch_array(mysqli_query($conexao," SELECT   notavinculada FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' order by idavaliacao asc limit 1 "))[0];
  $nome_da_notavinculada=mysqli_fetch_array(mysqli_query($conexao," SELECT titulo FROM notasdoano where idnotadoano='$idnota_vinculada' limit 1"))[0];

       $numerodeavaliacoes=mysqli_num_rows(mysqli_query($conexao, "select idavaliacao from avaliacoes where idtrimestre='$idtrimestre' and iddisciplina='$iddisciplina' ")); 
 


       $idturma=$dadosdadisciplina["idturma"];
       $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 


   include("cabecalho.php") ; ?>

<?php
                                   
                  
                  $idprofessor=$dadosdadisciplina["idprofessor"];
                  $idprofessorauxiliar=$dadosdadisciplina["idprofessorauxiliar"];
                  $idanolectivo=$dadosdadisciplina["idanolectivo"];
 
                           $professor=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessor' limit 1"))[0];

                           $professorauxiliar=mysqli_fetch_array(mysqli_query($conexao, "select nomedofuncionario from funcionarios where idfuncionario='$idprofessorauxiliar' limit 1"))[0];

                              ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Lançando Notas no Sistema - Avaliação Contínua  | <?php echo $nome_do_trimestre; ?> Trimestre </h1>
     
          <?php 
            if(!empty($erros)):
                        foreach($erros as $erros):
                          echo '<div class="alert alert-danger">'.$erros.'</div>';
                        endforeach;
                      endif;
            ?>

<?php 
            if(!empty($acertos)):
                        foreach($acertos as $acertos):
                          echo '<div class="alert alert-success">'.$acertos.'</div>';
                        endforeach;
                      endif;
            ?>

 <?php  include("estilocarde.php"); ?>
    <button id="myBtntrimestre" class="btn btn-info">Escolher outro Trimestre</button>
    <button id="myBtnavaliacao" class="btn btn-success"> Criar Nova Avaliação Contínua </button>

    <button id="myBtn" class="btn btn-primary">Lançar Outro tipo de Nota</button>
<br><br>
    

    <div id="myModal" class="modal"  >
        <div class="modal-content">
          <span id="close">&times;</span>
           
           <h2>Qual tipo de Nota Você quer lançar?</h2>


                    <span id="escolheu"   class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Avaliação Contínua</span> <br>

              
               <a href="lancarnota.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Minipauta</a> <br>

              
         
              <a href="lancarnotapauta.php?iddisciplina=<?php echo $iddisciplina; ?>" class="d-sm-inline-block btn btn-sm btn-info" >Lançar Notas da Pauta</a> 

        </div>
    </div>


      <div id="myModaltrimestre" class="modal"  >
        <div class="modal-content">
          <span id="closetrimestre">&times;</span>
                <form class="user" method="get" action=""> 
           <h2>Escolha o trimestre</h2>


                    <div class="form-group">
                    <select name="idtrimestre" required  class="form-control"> 
                      <?php
                           $lista=mysqli_query($conexao,"SELECT * from trimestres where idanolectivo='$idanolectivo' order by titulo desc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option value="<?php echo $exibir["idtrimestre"]; ?>"><?php echo $exibir["titulo"]; ?></option>
                        <?php } ?> 
                    </select> 
                    </div> 

                    <input type="hidden" name="iddisciplina" value="<?php echo $iddisciplina; ?>"> 
                    <br>
                       <input type="submit" name="ver" value="Ver ou lançar Avaliações deste trimestre" class="btn btn-success" style="float: rigth;">
                    </form>
        </div>
    </div>


  <div id="myModalavaliacao" class="modal"  >
        <div class="modal-content">
          <span id="closeavaliacao">&times;</span>
                <form class="user" method="POST" action=""> 
           <h2>Criando Nova Avaliação contínua</h2>

            <?php if($numerodeavaliacoes==0){?>



            <div class="alert alert-info">Você não tem nenhum tipo de avaliação nessa disciplina para esse trimestre, crie uma agora mesmo</div>

             <script type="text/javascript">  var modalavaliacao=document.getElementById("myModalavaliacao"); modalavaliacao.style.display="block"; </script>

          <?php  } ?>

                  <div class="form-group">
                    <span>Título</span>
                        <input type="text" name="titulodaavaliacao" class="form-control " required=""  title="Qual Título terá essa avaliação" placeholder="Título da avaliação" >
                    </div>


                      <div class="form-group">
                      <span>Data</span>
                          <input type="text" name="data" autocomplete="off" class="form-control js-datepicker" title="Digite data de Confirmação" placeholder="Data em que se realisou a avaliação" value="<?php  $diadehoje=date("d/m/Y"); echo $diadehoje; ?>">
                      </div>

                        <?php if($numerodeavaliacoes==0){?>
                      <div class="alert alert-info"><p> Você pode atribuir a média dessas avaliações contínuas a uma nota na minipauta como por exemplo o MAC</p> <br> Todas as alterações que se fizerem aqui, serão refletidas na minipauta</div>

                      <span>Escolha a nota</span>
                    <div class="form-group">
                    <select name="idnotadoano"  required  class="form-control"> 
                      <?php
                    $tipodeturma=$dadosdaturma["eclassedeexame"]; if($tipodeturma=="Sim"){$tipodeturma="Exame";}else{$tipodeturma="Transição";}
                    $lista=mysqli_query($conexao,"SELECT * from notasdoano where idtrimestre='$idtrimestre' and tipodeturma='$tipodeturma'  order by posicao asc");
                  while($exibir = $lista->fetch_array()){ ?>
                          <option  value="<?php echo $exibir["idnotadoano"]; ?>"><?php echo $exibir["titulo"]; ?> </option>
                        <?php } ?> 
                    </select> 
                    </div>     <?php  } else {?>

                    <input type="hidden" name="idnotadoano" value="<?php echo $idnota_vinculada; ?>">
                     <span>Essa nota será vinculada a <?php echo $nome_da_notavinculada; ?></span>
                     <?php  } ?>
   <input type="submit" name="criaravaliacao" value="Criar avaliação" class="btn btn-success" style="float: rigth;">


                    </form>
        </div>
    </div>


                <script>
                    var btn=document.getElementById("myBtn");
                    
                    var modal=document.getElementById("myModal");
                    
                    var span=document.getElementById("close");

                    var btntrimestre=document.getElementById("myBtntrimestre");
                    
                    var modaltrimestre=document.getElementById("myModaltrimestre");
                    
                    var spantrimestre=document.getElementById("closetrimestre");

                     var btnavaliacao=document.getElementById("myBtnavaliacao");
                    
                    var modalavaliacao=document.getElementById("myModalavaliacao");
                    
                    var spanavaliacao=document.getElementById("closeavaliacao");


                     var escolheu=document.getElementById("escolheu");

                           
                    
                    btn.addEventListener("click", ()=>{
                      modal.style.display="block";
                                                  })
                    span.addEventListener("click", ()=>{
                      modal.style.display="none";
                                                  })


                     btntrimestre.addEventListener("click", ()=>{
                      modaltrimestre.style.display="block";
                                                  })
                    spantrimestre.addEventListener("click", ()=>{
                      modaltrimestre.style.display="none";
                                                  })

                       btnavaliacao.addEventListener("click", ()=>{
                      modalavaliacao.style.display="block";
                                                  })
                    spanavaliacao.addEventListener("click", ()=>{
                      modalavaliacao.style.display="none";
                                                  })



                     escolheu.addEventListener("click", ()=>{
 
                      modal.style.display="none";
                                                  })

                    window.onclick =(event)=>{
                        if(event.target == modal){
                          modal.style.display="none";
                        }
                    }

                    window.onclick =(event)=>{
                        if(event.target == modaltrimestre){
                          modaltrimestre.style.display="none";
                        }
                    }

                     window.onclick =(event)=>{
                        if(event.target == modalavaliacao){
                          modalavaliacao.style.display="none";
                        }
                    }

                    
                  </script>



          <div class="col-lg">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Dados da disciplina</h6>
                  <div class="dropdown no-arrow">
                     
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">


                            
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">disciplina</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="text-decoraction:none;" href="disciplina.php?iddisciplina=<?php echo $dadosdadisciplina["iddisciplina"] ; ?>"><?php echo $dadosdadisciplina["titulo"] ; ?></a></div> <br>

                                            Abreviatura: <strong> <?php echo $dadosdadisciplina["abreviatura"]; ?> </strong> <br>

                                            Tipo de Disciplina: <strong> <?php echo $dadosdadisciplina["tipodedisciplina"]; ?> </strong> <br> 
                                        
                                           <?php
 
                                             $anolectivo=mysqli_fetch_array(mysqli_query($conexao, "select   titulo, idanolectivo from anoslectivos where idanolectivo='$idanolectivo'"));

                                             $idanolectivo=$anolectivo["idanolectivo"];
 

                                                    $idturma=$dadosdadisciplina["idturma"];
                                           $dadosdaturma= mysqli_fetch_array(mysqli_query($conexao, "select * from turmas where idturma='$idturma' limit 1")); 

                                               $turma=$dadosdaturma["titulo"]; 
                                               $idperiodo=$dadosdaturma["idperiodo"];
                                               $idcurso=$dadosdaturma["idcurso"];
                                               $idsala=$dadosdaturma["idsala"];
                                               $idclasse=$dadosdaturma["idclasse"];
                                              


                                               $periodo=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from periodos where idperiodo='$idperiodo'"))[0];

                                                $curso=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from cursos where idcurso='$idcurso'"))[0];

                                                $sala=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from salas where idsala='$idsala'"))[0];

                                                $classe=mysqli_fetch_array(mysqli_query($conexao,"SELECT titulo from classes where idclasse='$idclasse'"))[0];

                                                ?>

                                                 Ano Lectivo: <a href="anolectivo.php?idanolectivo=<?php echo $idanolectivo; ?>"> <?php echo $anolectivo["titulo"]; ?> </a><br>
                                                   
                                                  Turma: <a href="turma.php?idturma=<?php echo $idturma; ?>"> <?php echo $turma; ?> </a><br>

                                                  Curso: <a href="curso.php?idcurso=<?php echo $idcurso; ?>"> <?php echo $curso; ?> </a><br>

                                                 Classe: <a href="classe.php?idclasse=<?php echo $idclasse; ?>"> <?php echo $classe; ?> </a><br>

                                                  Período: <a href="periodo.php?idperiodo=<?php echo $idperiodo; ?>"> <?php echo $periodo; ?> </a><br>

                                                    Sala: <a href="sala.php?idsala=<?php echo $idsala; ?>"> <?php echo $sala; ?> </a>
                                                      <br><br>


                                                    Porfessor: <strong> <a href="idfuncionario.php?idfuncionario=<?php echo $idprofessor; ?>"><?php echo $professor; ?></a>  </strong> <br>

                                             Porfessor Auxiliar: <strong> <a href="idfuncionario.php?idfuncionario=<?php echo $idprofessorauxiliar; ?>"><?php echo $professorauxiliar; ?></a>  </strong> <br>
 
                                                </div>
 
                                    </div>
                                    </div> 
                                </div>
                                </div>
                            </div>
                            </div>
   
                                                      
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lista de Avaliações Existentes</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></a></div>
                                        <p id="mostra1">  <br>
                                        OBS: se desejar mudar o nome ou a data de alguma avaliação podes editar direitamente na tabela abaixo.
                                        
    <span id="mensagemdealertaavaliacao"></span>

                                            
     <?php
 
 

$htm='

 
<table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>


                    <tr>  
                      <th> Nº </th>
                      <th   align="center">Título</th>
                      <th   align="center">Data</th>
                      <th  align="center">Opção</th>
                    </tr>

                     <tr>    
                      ';

                      $avaliacoes=mysqli_query($conexao," SELECT * FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' ");

                      $n=0;

                        while($exibir = $avaliacoes->fetch_array()){ 
                          $n++;
                          
                      $htm.='
 
                         


                     <tr>     
                          <th>'.$n.'</th> 
                          <th align="center" class="updatetipodeavaliaca" data-id="'.$exibir["idavaliacao"].'" data-column="titulo"  contenteditable >'.$exibir["titulo"].'</th> 
                          <th align="center" class="updatetipodeavaliaca" data-id="'.$exibir["idavaliacao"].'" data-column="data"  contenteditable  >'.$exibir["data"].'</th> 
                          <th align="center" >  <a href="" class="delete" id="'.$exibir["idavaliacao"].'" ><i style="color:red" title="Eliminar essa avaliação" class="fas fa-trash"></i></a></th> 
                    </tr>';

                  }

                  $htm.='


                  </thead>
                   
                </table>
 
                   ';

echo "$htm";



                   ?>

                                          
                                        </div>

                            
                                        </div>
                                        </div> 
                                </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>



                 
      </div>
      <!-- End of Main Content -->
 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Avaliações continuas
            </div>
            <div class="card-body"> 
              <div class="table-responsive">
                     <?php if($numerodeavaliacoes!=0){?>
               <button id="myBtnvincular" class="btn btn-primary"> Alterar o vínculo da média da avaliação com nota da minipauta</button> <br> <br>
<?php } ?> 
               <div id="myModalvincular" class="modal"  >
        <div class="modal-content">
          <span id="closevincular">&times;</span>
                <form class="user" method="POST" action=""> 
           <h2>Vincular Média da Avaliação contínua</h2>

          

                   <div class="alert alert-info"><p> Você pode atribuir a média dessas avaliações contínuas a uma nota na minipauta como por exemplo o MAC</p> <br> Todas as alterações que se fizerem aqui, serão refletidas na minipauta</div>

                      <span>Escolha a nota</span>
                    <div class="form-group">
                    <select name="idnotadoano"  required  class="form-control"> 
                      <?php
                            $tipodeturma=$dadosdaturma["eclassedeexame"]; if($tipodeturma=="Sim"){$tipodeturma="Exame";}else{$tipodeturma="Transição";}
                            $lista=mysqli_query($conexao,"SELECT * from notasdoano where idtrimestre='$idtrimestre' and tipodeturma='$tipodeturma'  order by posicao asc");
                          while($exibir = $lista->fetch_array()){ ?>
                          <option  value="<?php echo $exibir["idnotadoano"]; ?>"><?php echo $exibir["titulo"]; ?>  </option>
                        <?php } ?> 
                    </select> 
                    </div>

                    <input type="submit" name="criarvinculo" value="Criar Vínculo" class="btn btn-success" style="float: rigth;">


                    </form>
        </div>
    </div>


                <script> 

                     var btnvincular=document.getElementById("myBtnvincular");
                    
                    var modalvincular=document.getElementById("myModalvincular");
                    
                    var spanvincular=document.getElementById("closevincular");

 

                       btnvincular.addEventListener("click", ()=>{
                      modalvincular.style.display="block";
                                                  })
                    spanvincular.addEventListener("click", ()=>{
                      modalvincular.style.display="none";
                                                  })
 
                    window.onclick =(event)=>{
                        if(event.target == modalvincular){
                          modalvincular.style.display="none";
                        }
                    }

                    
                    
                  </script>


      
              <span id="mensagemdealerta"></span>
              <span id="resultado">


                  <?php
 



    $dadosdoanolectivo=mysqli_fetch_array(mysqli_query($conexao," SELECT * FROM anoslectivos where idanolectivo='$idanolectivo' "));
     

 

 $minimoparapositiva=$dadosdaturma["minimoparapositiva"];

$htm='

 
<table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                  <thead>


                    <tr>  
                      <th   align="center">Nº</th>
                      <th   align="center">Nome do Estudante</th>
                      ';
                        $listadeavaliacoes=mysqli_query($conexao," SELECT titulo, notavinculada FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' order by data asc ");

                      while($exibir = $listadeavaliacoes->fetch_array()){

                        $idnota_vinculada=$exibir["notavinculada"];

                          $htm.='
                      <th  align="center" >'.$exibir["titulo"].'</th>';
                      }

                     

                      $htm.='

                      <th  align="center">Média</th>
                      <th  align="center">Vínculo ('.$nome_da_notavinculada.')</th>
                      <th  align="center" title="Essa acção vai tornar a nota do '.$nome_da_notavinculada.' igual a Media das avaliações contínuas para todos os alunos"><a  class="sincronizartodos"  href=""> <button class="btn btn-primary"> <i  class="fas fa-sync" ></i> Sincronizar Todos  </button> </a></th>

                    </tr>

                  </thead>

                  <tbody>
                       
                      ';

                      $lista=mysqli_query($conexao, "select alunos.nomecompleto, alunos.idaluno, matriculaseconfirmacoes. idmatriculaeconfirmacao  from matriculaseconfirmacoes, alunos where matriculaseconfirmacoes.idaluno=alunos.idaluno and matriculaseconfirmacoes.idturma='$idturma' and matriculaseconfirmacoes.estatus='activo' order by alunos.nomecompleto"); 

                      $n=0;
                        while($exibir = $lista->fetch_array()){

                           

                          $n++;

                          $idmatriculaeconfirmacao=$exibir["idmatriculaeconfirmacao"];

                          $valordanota_vinculada=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notas where idmatriculaeconfirmacao='$idmatriculaeconfirmacao' and  idnotadoano='$idnota_vinculada'  and iddisciplina='$iddisciplina' limit 1"))[0];

                          $htm.='
                          <tr>
                              <td  align="center" >'.$n.'</td>
                            <td> <a  href="aluno.php?idaluno='.$exibir["idaluno"].'"> '.$exibir['nomecompleto'].' </a></td> 

                            ';


                              $listadeavaliacoes=mysqli_query($conexao," SELECT idavaliacao FROM avaliacoes where iddisciplina='$iddisciplina' and idtrimestre='$idtrimestre' order by data asc ");

                                 $soma_nota=0;

                                  while($exibir_tipodeavaliacao = $listadeavaliacoes->fetch_array()){

                                    $idavaliacao=$exibir_tipodeavaliacao["idavaliacao"];

                                    $valordanota=mysqli_fetch_array(mysqli_query($conexao," SELECT valordanota FROM notasavaliacao where idavaliacao='$idavaliacao' and idmatriculaeconfirmacao='$idmatriculaeconfirmacao' limit 1"))[0];

                                    $soma_nota+=$valordanota;

                                    if ($valordanota>=$minimoparapositiva) {
                                         $cor="Blue";
                                      }else{
                                        $cor="red";
                                      }

                                      $htm.='
                                        

                                        <td align="center" style="color: '.$cor.'" contenteditable class="update" data-id="'.$idmatriculaeconfirmacao.'" data-column="'.$idavaliacao.'"  >'.$valordanota.'</td>';


                                  }  

                                    $media=round(($soma_nota/$numerodeavaliacoes),2);

                                    if ($media>=$minimoparapositiva) {
                                         $cor_media="Blue";
                                      }else{
                                        $cor_media="red";
                                      }

                                      if ($valordanota_vinculada>=$minimoparapositiva) {
                                         $cor_vinculada="Blue";
                                      }else{
                                        $cor_vinculada="red";
                                      }



                            $htm.='

                             <td  align="center" style="color: '.$cor_media.'" >'.$media.'</td>
                             <td  align="center"  style="color: '.$cor_vinculada.'"  >'.$valordanota_vinculada.'</td>
                             <td  align="center"> ';

                                if($media!=$valordanota_vinculada){ 

                                  $htm.='

                                  <a title="Essa acção vai tornar a nota do '.$nome_da_notavinculada.' igual a Media das avaliações contínuas para o(a)  '.$exibir['nomecompleto'].' " data-column="'.$media.'" class="sincronizar" data-id="'.$idmatriculaeconfirmacao.'"  href=""> <button class="btn btn-success"> <i  class="fas fa-sync" ></i> Sincronizar </button> </a>';
                              }

                                $htm.='

                              </td>

                          </tr>
                      '; } 


                      $htm.='
                     
 

                  </tbody>
                </table>
 
                   ';

echo "$htm";



                   ?>


               </span>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        

       
      </div>
      <!-- End of Main Content -->
     
     <script>


                                  $(document).on("blur", ".update", function(){

                                        var idmatriculaeconfirmacao=$(this).data("id");
                                        var idavaliacao=$(this).data("column");
                                        var valordanota=$(this).text();

                                        var iddisciplina=<?php echo $iddisciplina; ?>; 
                                        var idtrimestre=<?php echo $idtrimestre; ?>; 
                                         
                                        
                                        $.ajax({
                                              url:'cadastro/lancanotadaavaliacao.php',
                                              method:'POST',

                                              data:{idmatriculaeconfirmacao, idavaliacao, valordanota, iddisciplina, idtrimestre},

                                              success: function(data){
                                                  $("#mensagemdealerta").html(data); 
                                              }

                                          })

                                    })


                                   $(document).on("click", ".sincronizar", function(){

                                          event.preventDefault();

                                        var idmatriculaeconfirmacao=$(this).data("id");
                                        var valordamedia=$(this).data("column");
                                         

                                        var iddisciplina=<?php echo $iddisciplina; ?>; 
                                        var idtrimestre=<?php echo $idtrimestre; ?>; 
                                         
                                           this.remove();
                                        
                                        $.ajax({
                                              url:'cadastro/sincronizarnota.php',
                                              method:'POST',

                                              data:{idmatriculaeconfirmacao, iddisciplina, idtrimestre, valordamedia},

                                              success: function(data){
                                                  $("#mensagemdealerta").html(data); 
                                              }

                                          })

                                    })


                                     $(document).on("click", ".sincronizartodos", function(){

                                          event.preventDefault();

                                        

                                        var iddisciplina=<?php echo $iddisciplina; ?>; 
                                        var idtrimestre=<?php echo $idtrimestre; ?>; 
                                        var idturma=<?php echo $idturma; ?>; 
                                         
                                           this.remove();
                                        
                                        $.ajax({
                                              url:'cadastro/sincronizartodasnotas.php',
                                              method:'POST',

                                              data:{iddisciplina, idtrimestre, idturma},

                                              success: function(data){
                                                  $("#mensagemdealerta").html(data); 
                                              }

                                          })

                                    })



                                      $(document).on("blur", ".updatetipodeavaliaca", function(){
                                            var id=$(this).data("id");
                                            var nomedacoluna=$(this).data("column");
                                            var valor=$(this).text();
                                             

                                            $.ajax({
                                                url:'cadastro/updateavaliacoes.php',
                                                method:'POST',
                                                data:{
                                                    id:id, 
                                                    nomedacoluna:nomedacoluna,
                                                     valor:valor
                                                },
                                                success: function(data){
                                                    $("#mensagemdealertaavaliacao").html(data);
                                                }

                                            })
                                        })




                                                            $(document).on("click", ".delete", function(event){
                                                                event.preventDefault();
                                                                var id=$(this).attr("id");
                                                                
                                                                if(confirm("Tens certeza que queres eliminar esssa avaliação contínua?   TODAS AS NOTAS DESSA AVALIAÇÃO SERÃO JUNTAMENTE ELIMINADAS")){
                                                                    $(this).closest('tr').remove(); 
                                                                    $.ajax({
                                                                    url:'cadastro/deleteavaliacao.php',
                                                                    method:'POST',
                                                                    data:{
                                                                        id:id
                                                                    },
                                                                    success: function(data){
                                                                        $("#mensagemdealertaavaliacao").html(data);
                                                          
                                                                    }

                                                                })
                                                                }
                                                               
                                                            })


       

     </script> 
       <!-- Footer -->
       <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CalungaSOFT 2022</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

   <!-- Jquery JS--> 
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
