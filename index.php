<?php
// Habilitar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obter URL de conexão do MySQL
$mysql_url = getenv('MYSQL_URL');
if (!$mysql_url) {
    error_log("Erro: MYSQL_URL não encontrada");
    die("Erro: Configuração do banco de dados incompleta");
}

error_log("MYSQL_URL encontrada: " . preg_replace('/(:.*@)/', ':****@', $mysql_url));

// Parse da URL
$db_parts = parse_url($mysql_url);
if (!$db_parts) {
    error_log("Erro: URL do MySQL inválida");
    die("Erro: URL do banco de dados inválida");
}

error_log("Informações do banco:");
error_log("Host: " . $db_parts['host']);
error_log("Port: " . ($db_parts['port'] ?? '3306'));
error_log("User: " . $db_parts['user']);
error_log("Path: " . trim($db_parts['path'], '/'));

// Criar conexão usando URL
try {
    $conexao = new mysqli(
        $db_parts['host'],
        $db_parts['user'],
        $db_parts['pass'],
        trim($db_parts['path'], '/'),
        $db_parts['port'] ?? 3306
    );

    // Verificar conexão
    if ($conexao->connect_error) {
        error_log("Erro de conexão: " . $conexao->connect_error);
        die("Erro de conexão com o banco de dados. Por favor, tente novamente mais tarde.");
    }

    // Configurar charset
    $conexao->set_charset("utf8mb4");
    
    error_log("Conexão com o banco estabelecida com sucesso!");
} catch (Exception $e) {
    error_log("Erro ao conectar: " . $e->getMessage());
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

// Calcular o dia do ano
$dia_do_ano = date('z') + 1;

// Buscar a leitura do dia
$sql = "SELECT * FROM leituras WHERE dia = $dia_do_ano";
$resultado = $conexao->query($sql);
$leitura = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Plano de Leitura Bíblica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">Plano de Leitura Bíblica</h2>
            </div>
            <div class="card-body">
                <h3>Leitura do Dia: <?= date('d/m/Y') ?></h3>
                <?php if ($leitura): ?>
                    <div class="alert alert-info">
                        <strong>Passagem:</strong> <?= htmlspecialchars($leitura['passagem']) ?>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="leitura-checkbox" 
                               data-dia="<?= $dia_do_ano ?>" 
                               <?= $leitura['lido'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="leitura-checkbox">
                            Marcar leitura como concluída
                        </label>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Nenhuma leitura encontrada para hoje.
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <a href="progresso.php" class="btn btn-success">Ver Progresso</a>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('leitura-checkbox')?.addEventListener('change', function() {
        const dia = this.getAttribute('data-dia');
        const status = this.checked ? 1 : 0;

        fetch('atualizar_leitura.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `dia=${dia}&status=${status}`
        });
    });
    </script>
</body>
</html>
<?php $conexao->close(); ?>
