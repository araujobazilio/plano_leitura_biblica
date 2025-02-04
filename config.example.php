<?php
// Configurações do banco de dados
$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASSWORD = getenv('DB_PASSWORD') ?: '';
$DB_DATABASE = getenv('DB_DATABASE') ?: 'railway';

try {
    // Criar conexão
    $conexao = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
    
    // Verificar conexão
    if ($conexao->connect_error) {
        error_log("Erro de conexão: " . $conexao->connect_error);
        die("Erro de conexão com o banco de dados. Por favor, tente novamente mais tarde.");
    }
    
    // Configurar charset
    $conexao->set_charset("utf8mb4");
} catch (Exception $e) {
    // Log do erro ou tratamento adequado
    error_log($e->getMessage());
    die("Erro de conexão. Verifique as configurações do banco de dados.");
}
