<?php

// Conexão com o banco de dados local (onde as alterações foram feitas)
$conn = new mysqli("localhost", "root", "", "escola");

// Verificando se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados local: " . $conn->connect_error);
} 

// Obter a lista de tabelas no banco de dados
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $tableName = $row[0];
        
        // Verificar se a tabela já possui a coluna data_modificacao
        $checkColumnQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName' AND COLUMN_NAME = 'data_modificacao'";
        $checkColumnResult = $conn->query($checkColumnQuery);
        
        if ($checkColumnResult->num_rows === 0) {
            $alterQuery = "ALTER TABLE $tableName ADD COLUMN data_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
            
            if ($conn->query($alterQuery) === TRUE) {
                echo "Coluna data_modificacao adicionada à tabela $tableName com sucesso!<br>";
            } else {
                echo "Erro ao adicionar coluna à tabela $tableName: " . $conn->error . "<br>";
            }
        } else {
            echo "A tabela $tableName já possui a coluna data_modificacao.<br>";
        }
    }
} else {
    echo "Nenhuma tabela encontrada na base de dados.";
}

$conn->close();
?>
