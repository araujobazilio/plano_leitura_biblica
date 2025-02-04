<?php
header('Content-Type: application/json');

try {
    // Testar conexão com o banco
    require_once 'config.php';
    
    if ($conexao->ping()) {
        http_response_code(200);
        echo json_encode(['status' => 'healthy', 'database' => 'connected']);
    } else {
        throw new Exception('Database connection failed');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'unhealthy', 'error' => $e->getMessage()]);
}
