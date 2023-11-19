<?php

 
$nomedatabela=isset($_POST['nomedatabela'])?$_POST['nomedatabela']:"0";



function sincronizarBancos($nomedatabela)
{

    $cont=0;
    $hostname_local = "localhost";
    $username_local = "root";
    $password_local = "";
    $database_local = "escola";
    $port_local = 3333;

    $hostname_online = "srv872.hstgr.io";
    $username_online = "u491042513_sicronizacao2";
    $password_online = "5:CzdqWa";
    $database_online = "u491042513_sicronizacao";

    $conn_local = mysqli_connect($hostname_local, $username_local, $password_local, $database_local, $port_local);
    $conn_online = mysqli_connect($hostname_online, $username_online, $password_online, $database_online);

    if (!$conn_local || !$conn_online) {
        die("Erro na conexão com o banco de dados.");
    }
 
    $table_name = $nomedatabela;

        

 // Sincronizar registros excluídos
 $query_deleted = "SELECT * FROM $table_name";
 $result_deleted = mysqli_query($conn_online, $query_deleted);

 while ($row_deleted = mysqli_fetch_assoc($result_deleted)) {
     $primary_key_name = array_keys($row_deleted)[0];
     $primaryKeyValue = $row_deleted[$primary_key_name];

     // Verificar se o registro existe no banco de dados online
     $query_check_exists = "SELECT 1 FROM `$table_name` WHERE `$primary_key_name` = '" . mysqli_real_escape_string($conn_online, $primaryKeyValue) . "'";
     $result_check_exists = mysqli_query($conn_local, $query_check_exists);
 
         if (mysqli_num_rows($result_check_exists) == 0) {
     // O registro nao existe no banco de dados offline, então exclua no online
             $query_delete = "DELETE FROM `$table_name` WHERE `$primary_key_name` = '" . mysqli_real_escape_string($conn_online, $primaryKeyValue) . "'";
             $result_delete = mysqli_query($conn_online, $query_delete);

             if ($result_delete) { 
                 $cont++;
             } else {
                 echo "Erro ao excluir registro na tabela '$table_name': " . mysqli_error($conn_online) . "<br>";
             }
         }  
             
 }
     
 echo "$cont Registros eliminados Sicronizados";
    mysqli_close($conn_local);
    mysqli_close($conn_online);
}
 
sincronizarBancos($nomedatabela);


?>

