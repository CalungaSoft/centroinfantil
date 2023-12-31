<?php
 



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

 


function sincronizarBancos($data_referencia)
{
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

    $query_tables = "SHOW TABLES";
    $result_tables = mysqli_query($conn_local, $query_tables);

    while ($row_table = mysqli_fetch_row($result_tables)) {
        $table_name = $row_table[0];

        // Sincronizar registros atualizados e novos
        $query_changes = "SELECT * FROM $table_name WHERE data_modificacao >= '$data_referencia'";
        $result_changes = mysqli_query($conn_local, $query_changes);

        while ($row_change = mysqli_fetch_assoc($result_changes)) {
            $set_values = [];
            foreach ($row_change as $column => $value) {
                if ($column !== 'data_modificacao') {
                    $set_values[] = "`$column` = '" . mysqli_real_escape_string($conn_online, $value) . "'";
                }
            }
            $set_clause = implode(", ", $set_values);

            $primary_key_name = array_keys($row_change)[0];
            $primaryKeyValue = $row_change[$primary_key_name];

            // Verificar se o registro existe no banco de dados online
            $query_check_exists = "SELECT 1 FROM `$table_name` WHERE `$primary_key_name` = '" . mysqli_real_escape_string($conn_online, $primaryKeyValue) . "'";
            $result_check_exists = mysqli_query($conn_online, $query_check_exists);

            if ($result_check_exists !== false) {
                if (mysqli_num_rows($result_check_exists) > 0) {
                    // O registro existe no banco de dados online, então atualize
                    $query_update = "UPDATE `$table_name` SET $set_clause WHERE `$primary_key_name` = '" . mysqli_real_escape_string($conn_online, $primaryKeyValue) . "'";
                    $result_update = mysqli_query($conn_online, $query_update);

                    if ($result_update) {
                        echo "Registro atualizado com sucesso na tabela '$table_name'!<br>";
                    } else {
                        echo "Erro ao atualizar registro na tabela '$table_name': " . mysqli_error($conn_online) . "<br>";
                    }
                } else {
                    // O registro não existe no banco de dados online, então insira
                    $columns = implode(", ", array_keys($row_change));
                    $values = "'" . implode("', '", array_map(function ($value) use ($conn_online) {
                        return mysqli_real_escape_string($conn_online, $value);
                    }, $row_change)) . "'";
                    $query_insert = "INSERT INTO `$table_name` ($columns) VALUES ($values)";

                    $result_insert = mysqli_query($conn_online, $query_insert);

                    if ($result_insert) {
                        echo "Novo registro inserido com sucesso na tabela '$table_name'!<br>";
                    } else {
                        echo "Erro ao inserir novo registro na tabela '$table_name': " . mysqli_error($conn_online) . "<br>";
                    }
                }
            } else {
                echo "Erro na verificação de existência na tabela '$table_name': " . mysqli_error($conn_online) . "<br>";
            }
        }

       
    }

  
}

$data_referencia_padrao=mysqli_fetch_array(mysqli_query($conn_local,"SELECT datadasicronizacao FROM `historico_sincronizacao` order by id desc limit 1"))[0];

$data_referencia = isset($_GET['data'])?$_GET['data']:"$data_referencia_padrao";
 

sincronizarBancos($data_referencia);

$query_update = "INSERT INTO `historico_sincronizacao` (`id`, `datadasicronizacao`, `numeroderegistrossicronizados`, `data_modificacao`) VALUES (NULL,current_timestamp() , 0, current_timestamp())";
$result_update = mysqli_query($conn_local, $query_update);

mysqli_close($conn_local);
mysqli_close($conn_online);

header('Location: sicronizacaopage.php?sms=yes');
?>
    