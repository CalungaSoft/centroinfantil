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

$idmatriculaeconfirmacao=isset($_GET['idmatriculaeconfirmacao'])?$_GET['idmatriculaeconfirmacao']:"";
$anoEscolhido=isset($_GET['ano'])?$_GET['ano']:"";
$mesEscolhido=isset($_GET['mes'])?$_GET['mes']:"";


$dados_da_matricula=mysqli_fetch_array(mysqli_query($conexao, "select * from  matriculaseconfirmacoes where idmatriculaeconfirmacao='$idmatriculaeconfirmacao'")); 

$idturma=$dados_da_matricula["idturma"];
$idaluno=$dados_da_matricula["idaluno"];


$dados_da_turma=mysqli_fetch_array(mysqli_query($conexao, "select * from  turmas where idturma='$idturma'")); 
$nome_do_aluno=mysqli_fetch_array(mysqli_query($conexao, "select nomecompleto from  alunos where idaluno='$idaluno'"))[0]; 
  
$propina=number_format($dados_da_turma["propina"],2,",", "."); 

$dadosdainstituicao=mysqli_fetch_array(mysqli_query($conexao,"select * from dadosdaempresa"));

$coordenadasbancariascompletas=$dadosdainstituicao["coordenadasbancariascompletas"];


$dia = date('d');
$mes = date('m');
$ano = date('Y');
$meses = array(
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
);

?>

<?php

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

$gerador = new DOMPDF(["chroot" => __DIR__]);

$html = '
<!DOCTYPE html>
<html>

<head>
    <title>Recibo de Cobrança</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            background-image: url("img/fundo.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center; /* Ajuste a posição vertical conforme necessário */
        }

        #conteudo {
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            position: relative; /* Adiciona esta propriedade para que os elementos dentro de conteudo fiquem posicionados corretamente */
        }

        .container {
            position: relative;
        }

        #topo img {
            position: absolute;
            top: -46px;
            margin-left: -50px;
        }

        #base img {
            position: absolute;
            bottom: 92px;
            margin-left: 50px;
            z-index: 0; /* Define a ordem de empilhamento para a imagem de fundo */
        }

        .negrito {
            font-weight: bold;
        }

        .textojustificado {
            text-align: justify;
        }

        .textojustificadoealinhadoaesquerda {
            text-align: justify;
            text-align: left; 
            z-index: 2; /* Coloca o parágrafo acima de outros elementos */
        }

        .vermelho {
            color: red;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="topo">
            <img src="img/cima.jpg" alt="">
        </div>
        <div id="conteudo">
            <img src="img/insignia.jpg" alt="" style="margin-top:20px">  <br>
            REPÚBLICA DE ANGOLA <br>
            <span class="negrito">ACADEMIA REOBOTE - PRESTAÇÃO DE SERVIÇOS, SU, LDA.<br>
                NIF: 50000490393</span> <br><br>

            <h1>  NOTA DE COBRANÇA</h1>

            Excelência, <br>
            <p class="textojustificado" style="text-indent: 30px;">
                De acordo com as informações do setor financeiro, constatamos que o pagamento de Propina do(a) Estudante <span class="vermelho">'.$nome_do_aluno.'</span> referente ao mês de <span class="vermelho">' . $meses[intval($mesEscolhido)] . '</span> no valor de <span class="vermelho">'.$propina.' KZ</span> ainda não consta nos nossos registros.
            </p>
            <p class="textojustificado" style="text-indent: 30px;">
                Considerando a Vossa pontualidade até então, nos utilizamos desta nota para cientificá-la da prestação em aberto de modo que o débito possa ser regularizado.
            </p> 

            <p class="textojustificado" style="text-indent: 30px;">
                Na hipótese de que o pagamento ter sido efetuado, pedimos que nos envie o comprovativo, para que possamos atualizar o nosso cadastro.
            </p>
            <br> <br> 
            <p class="textojustificadoealinhadoaesquerda">
                '.$coordenadasbancariascompletas.'
            </p>
        </div>
        <center>
            Luanda, ' . $dia . ' de ' . $meses[intval($mes)] . ' de ' . $ano . '<br><br>

            O(A) Responsável do setor financeiro,  '.$dadosdainstituicao["direitorfinanceiro"].' <br><br> 
         <br>
           
            <br><br> 
        </center>
       
        <div class="textojustificadoealinhadoaesquerda">
            '.$dadosdainstituicao["redesocial"].'<br> 
            Email: '.$dadosdainstituicao["email"].'<br> 
            Telefones: '.$dadosdainstituicao["telefone"].'<br> 
            Endereço: '.$dadosdainstituicao["localizacaoprecisa"].'<br> 
        </div>
        <div id="base">
            <img src="img/baixo.jpg" class="fundo" alt="">
        </div>
    </div>
</body>

</html>
';

$gerador->load_html($html);
$gerador->render();

$gerador->stream(
  "Recibo de cobranca ".$nome_do_aluno." - CalungaSoft.pdf",
  array(
    "attachment" => true
  )
);
?>
