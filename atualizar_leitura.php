<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = intval($_POST['dia']);
    $status = intval($_POST['status']);

    // Preparar statement para evitar injeção de SQL
    $stmt = $conexao->prepare("UPDATE leituras SET lido = ?, data_leitura = NOW() WHERE dia = ?");
    $stmt->bind_param("ii", $status, $dia);
    
    if ($stmt->execute()) {
        echo json_encode(['sucesso' => true]);
    } else {
        echo json_encode(['sucesso' => false, 'erro' => $stmt->error]);
    }
    
    $stmt->close();
}

$conexao->close();
