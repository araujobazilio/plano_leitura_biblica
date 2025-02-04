<?php
// Configurações do banco de dados
$host = getenv('MYSQL_HOST') ?: 'localhost';
$usuario = getenv('MYSQL_USER') ?: 'root';
$senha = getenv('MYSQL_PASSWORD') ?: '';
$banco = getenv('MYSQL_DATABASE') ?: 'plano_leitura_biblica';

// Criar conexão
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verificar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Configurar charset
$conexao->set_charset("utf8mb4");
