<?php
header('Content-Type: application/json');

// Função para registrar logs de erro
function logError($message) {
    error_log($message);
}

try {
    // Verificar se MYSQL_URL está definida
    $mysql_url = getenv('MYSQL_URL');
    if (!$mysql_url) {
        throw new Exception('Missing MYSQL_URL environment variable');
    }

    // Extrair informações da URL
    $db_parts = parse_url($mysql_url);
    if (!$db_parts) {
        throw new Exception('Invalid MYSQL_URL format');
    }

    // Criar conexão
    $conn = new mysqli(
        $db_parts['host'],
        $db_parts['user'],
        $db_parts['pass'],
        trim($db_parts['path'], '/'),
        $db_parts['port'] ?: 3306
    );

    // Verificar conexão
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Testar uma query simples
    $result = $conn->query('SELECT 1');
    if (!$result) {
        throw new Exception('Database query failed');
    }

    // Fechar conexão
    $conn->close();

    // Resposta de sucesso
    http_response_code(200);
    echo json_encode([
        'status' => 'healthy',
        'message' => 'Application is running and database connection is working'
    ]);

} catch (Exception $e) {
    // Log do erro
    logError('Health check failed: ' . $e->getMessage());

    // Resposta de erro
    http_response_code(500);
    echo json_encode([
        'status' => 'unhealthy',
        'message' => $e->getMessage()
    ]);
}
