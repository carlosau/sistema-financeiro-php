<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Contas Pessoais</title>
    <link rel="stylesheet" href="css/style.css">
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
