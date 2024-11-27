<?php
include('db.php');

// Inserção de um novo lançamento (despesa ou receita)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria_id'];

    // Verificar se o categoria_id existe na tabela categorias
    $sql = "SELECT id FROM categorias WHERE id = $categoria_id LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "Erro: Categoria não encontrada.";
    } else {
        // Se a categoria for válida, inserir o lançamento
        $sql = "INSERT INTO lancamentos (tipo, valor, data, descricao, categoria_id)
                VALUES ('$tipo', '$valor', '$data', '$descricao', '$categoria_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo lançamento registrado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>