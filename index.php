<?php
include('db.php'); // Certifique-se de que está incluindo o arquivo de conexão com o banco
// Consultar os dados de entradas e saídas por mês/ano
$sql = "SELECT YEAR(data) AS ano, MONTH(data) AS mes, 
               SUM(CASE WHEN tipo = 'receita' THEN valor ELSE 0 END) AS entradas,
               SUM(CASE WHEN tipo = 'despesa' THEN valor ELSE 0 END) AS saidas
        FROM lancamentos
        GROUP BY YEAR(data), MONTH(data)
        ORDER BY ano DESC, mes DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Contas Pessoais</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Controle de Contas Pessoais</h1>

        <form action="cadastro.php" method="POST">
            <label for="tipo">Tipo de Lançamento:</label>
            <select name="tipo" id="tipo">
                <option value="receita">Receita</option>
                <option value="despesa">Despesa</option>
            </select><br>

            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" required><br>

            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required><br>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao"><br>

            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id">
                <option value="1">Moradia</option>
                <option value="2">Alimentação</option>
                <option value="3">Transporte</option>
                <option value="4">Lazer</option>
            </select><br>

            <button type="submit">Cadastrar Lançamento</button>
        </form>
    
    <!-- Seção de Cards de Entradas e Saídas por Mês/Ano -->
    <div class="cards-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <div class="card-header">
                            <h3><?= $row['mes'] ?>/<?= $row['ano'] ?></h3>
                                 <!-- Ícones de Editar e Excluir -->
                            <div class="card-icons">
                                <button class="btn-edit"><i class="fas fa-edit"></i></button>
                                <button class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><strong>Entradas:</strong> R$ <?= number_format($row['entradas'], 2, ',', '.') ?></p>
                            <p><strong>Saídas:</strong> R$ <?= number_format($row['saidas'], 2, ',', '.') ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Não há lançamentos registrados.</p>
            <?php endif; ?>
        </div>
    
    </div>



 <!-- Gráficos dinâmicos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="graficoFluxo"></canvas>

<script>
// Usar o fetch() para pegar os dados do PHP
fetch('dados.php')
    .then(response => response.json())
    .then(data => {
        // Agora temos os dados do PHP (entradas e saídas)
        var entradas = data.entradas || 0;  // Definindo 0 caso o valor seja NULL ou undefined
        var saidas = data.saidas || 0;      // Definindo 0 caso o valor seja NULL ou undefined

        // Criar o gráfico com Chart.js
        var ctx = document.getElementById('graficoFluxo').getContext('2d');
        var graficoFluxo = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Entradas', 'Saídas'],
                datasets: [{
                    label: 'Fluxo de Caixa',
                    data: [entradas, saidas],  // Dados dinâmicos de entradas e saídas
                    backgroundColor: ['#4caf50', '#f44336'],  // Cor de fundo dos itens
                    borderColor: ['#4caf50', '#f44336'],      // Cor das bordas
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => console.error('Erro ao carregar os dados: ', error));
</script>


</body>

</html>
