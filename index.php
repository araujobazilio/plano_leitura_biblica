<?php
require_once 'config.php';

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
