<?php
// Habilitar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tentar usar a URL interna do MySQL primeiro
$mysql_url = getenv('MYSQL_URL');
if (!$mysql_url) {
    error_log("MYSQL_URL não encontrada, tentando variáveis individuais");
    // Fallback para variáveis individuais
    $DB_HOST = getenv('MYSQLHOST') ?: 'localhost';
    $DB_PORT = getenv('MYSQLPORT') ?: '3306';
    $DB_USER = 'root';
    $DB_PASSWORD = getenv('MYSQL_ROOT_PASSWORD') ?: '';
    $DB_DATABASE = getenv('MYSQLDATABASE') ?: 'railway';
} else {
    error_log("Usando MYSQL_URL para conexão");
    $url_parts = parse_url($mysql_url);
    $DB_HOST = $url_parts['host'];
    $DB_PORT = $url_parts['port'];
    $DB_USER = $url_parts['user'];
    $DB_PASSWORD = $url_parts['pass'];
    $DB_DATABASE = substr($url_parts['path'], 1); // remove leading /
}

// Debug - mostrar variáveis (remover em produção)
error_log("DB_HOST: " . $DB_HOST);
error_log("DB_PORT: " . $DB_PORT);
error_log("DB_USER: " . $DB_USER);
error_log("DB_DATABASE: " . $DB_DATABASE);

// Criar conexão
try {
    $conexao = new mysqli(
        $DB_HOST,
        $DB_USER,
        $DB_PASSWORD,
        $DB_DATABASE,
        intval($DB_PORT)
    );

    // Verificar conexão
    if ($conexao->connect_error) {
        error_log("Erro de conexão: " . $conexao->connect_error);
        die("Erro de conexão com o banco de dados. Por favor, tente novamente mais tarde.");
    }

    // Configurar charset
    $conexao->set_charset("utf8mb4");
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
