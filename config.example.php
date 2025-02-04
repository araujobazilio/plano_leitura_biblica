<?php
// Configurações do banco de dados
$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASSWORD = getenv('DB_PASSWORD') ?: '';
$DB_DATABASE = getenv('DB_DATABASE') ?: 'plano_leitura_biblica';

try {
    // Criar conexão
    $conexao = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
    
    // Verificar conexão
    if ($conexao->connect_error) {
        throw new Exception("Falha na conexão: " . $conexao->connect_error);
    }
    
    // Configurar charset
    $conexao->set_charset("utf8mb4");
} catch (Exception $e) {
    // Log do erro ou tratamento adequado
    error_log($e->getMessage());
    die("Erro de conexão. Verifique as configurações do banco de dados.");
}
