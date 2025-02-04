<?php
header('Content-Type: application/json');

// Função para registrar logs de erro
function logError($message) {
    error_log($message);
}

try {
    // Verificar variáveis de ambiente
    $requiredEnvVars = ['DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_DATABASE'];
    $missingVars = [];
    
    foreach ($requiredEnvVars as $var) {
        if (!getenv($var)) {
            $missingVars[] = $var;
        }
    }
    
    if (!empty($missingVars)) {
        throw new Exception('Missing environment variables: ' . implode(', ', $missingVars));
    }

    // Tentar conexão com o banco de dados
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASSWORD');
    $db = getenv('DB_DATABASE');

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Teste simples de consulta
    $result = $conn->query("SELECT 1");
    
    if ($result === false) {
        throw new Exception('Simple query test failed');
    }

    $conn->close();

    // Resposta de sucesso
    http_response_code(200);
    echo json_encode([
        'status' => 'healthy', 
        'database' => 'connected',
        'message' => 'All systems operational'
    ]);

} catch (Exception $e) {
    // Log do erro
    logError($e->getMessage());

    // Resposta de erro
    http_response_code(500);
    echo json_encode([
        'status' => 'unhealthy', 
        'error' => $e->getMessage()
    ]);
    exit(1);
}
