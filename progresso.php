<?php
require_once 'config.php';

// Função para obter o progresso geral
function getProgressoGeral($conexao) {
    $sqlTotal = "SELECT COUNT(*) as total FROM leituras";
    $sqlLidos = "SELECT COUNT(*) as lidos FROM leituras WHERE lido = 1";
    
    $resultTotal = mysqli_query($conexao, $sqlTotal);
    $resultLidos = mysqli_query($conexao, $sqlLidos);
    
    $total = mysqli_fetch_assoc($resultTotal)['total'];
    $lidos = mysqli_fetch_assoc($resultLidos)['lidos'];
    
    return [
        'total' => $total,
        'lidos' => $lidos,
        'porcentagem' => $total > 0 ? round(($lidos / $total) * 100, 1) : 0
    ];
}

// Função para obter leituras por mês
function getLeiturasPorMes($conexao, $mes) {
    $sql = "SELECT dia, passagem, lido FROM leituras WHERE mes = ? ORDER BY dia";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $mes);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $leituras = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $leituras[] = $row;
    }
    
    return $leituras;
}

// Processar marcação de leitura
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_lido'])) {
    $dia = $_POST['dia'];
    $sql = "UPDATE leituras SET lido = NOT lido, data_leitura = CASE WHEN lido = 0 THEN NOW() ELSE NULL END WHERE dia = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $dia);
    mysqli_stmt_execute($stmt);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$progressoGeral = getProgressoGeral($conexao);
$meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 
          'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de Leitura Bíblica</title>
    <style>
        :root {
            --primary-color: #1a73e8;
            --secondary-color: #f8f9fa;
            --border-color: #ddd;
            --text-color: #202124;
            --success-color: #0f9d58;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f8f9fa;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
        }
        
        .progress-section {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background: var(--secondary-color);
            border-radius: 8px;
        }
        
        .progress-bar {
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            margin: 15px 0;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: var(--primary-color);
            width: <?php echo $progressoGeral['porcentagem']; ?>%;
            transition: width 0.3s ease;
        }
        
        .month-section {
            margin-top: 20px;
        }
        
        .month-header {
            background: var(--primary-color);
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .month-content {
            display: none;
            padding: 15px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            margin-bottom: 15px;
        }
        
        .reading-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .reading-item:last-child {
            border-bottom: none;
        }
        
        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }
        
        .checkbox-wrapper input[type="checkbox"] {
            margin-right: 10px;
        }
        
        .btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .completed {
            color: var(--success-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Plano de Leitura Bíblica</h1>
        
        <div class="progress-section">
            <h2>Seu Progresso</h2>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
            <p>
                <strong><?php echo $progressoGeral['lidos']; ?></strong> de 
                <strong><?php echo $progressoGeral['total']; ?></strong> leituras concluídas 
                (<strong><?php echo $progressoGeral['porcentagem']; ?>%</strong>)
            </p>
        </div>

        <h2>Todas as Leituras</h2>
        <?php foreach ($meses as $mes): 
            $leituras = getLeiturasPorMes($conexao, $mes);
            if (empty($leituras)) continue;
            
            $lidos = array_filter($leituras, function($l) { return $l['lido']; });
            $porcentagem = round((count($lidos) / count($leituras)) * 100, 1);
        ?>
            <div class="month-section">
                <div class="month-header" onclick="toggleMonth(this)">
                    <span><?php echo $mes; ?></span>
                    <span>Progresso do mês: <?php echo count($lidos); ?> de <?php echo count($leituras); ?> (<?php echo $porcentagem; ?>%)</span>
                </div>
                <div class="month-content">
                    <?php foreach ($leituras as $leitura): ?>
                        <div class="reading-item">
                            <span>Dia <?php echo $leitura['dia']; ?>: <?php echo $leitura['passagem']; ?></span>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="dia" value="<?php echo $leitura['dia']; ?>">
                                <button type="submit" name="toggle_lido" class="btn" style="margin: 0;">
                                    <?php echo $leitura['lido'] ? '✓ Concluído' : 'Marcar como lido'; ?>
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        
        <a href="index.php" class="btn">Voltar para Leitura do Dia</a>
    </div>

    <script>
    function toggleMonth(header) {
        const content = header.nextElementSibling;
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    }
    
    // Abrir o mês atual por padrão
    document.addEventListener('DOMContentLoaded', function() {
        const currentMonth = new Date().toLocaleString('pt-BR', { month: 'long' });
        const monthHeaders = document.querySelectorAll('.month-header');
        monthHeaders.forEach(header => {
            if (header.textContent.includes(currentMonth)) {
                header.click();
            }
        });
    });
    </script>
</body>
</html>
<?php $conexao->close(); ?>
