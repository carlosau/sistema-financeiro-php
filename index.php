<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Contas Pessoais</title>
    <link rel="stylesheet" href="style.css">
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
</body>
</html>
