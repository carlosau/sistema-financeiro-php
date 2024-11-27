<?php
include('db.php'); // Certifique-se de que está incluindo o arquivo de conexão com o banco

// Variáveis de data (mês e ano) para filtrar as entradas e saídas
$mes = date('m'); // Mês atual
$ano = date('Y'); // Ano atual

// Consultar o total de entradas
$sql_entradas = "SELECT SUM(valor) AS total_entradas FROM lancamentos WHERE tipo = 'receita' AND MONTH(data) = $mes AND YEAR(data) = $ano";
$result_entradas = $conn->query($sql_entradas);
$entradas = $result_entradas->fetch_assoc()['total_entradas'];

// Consultar o total de saídas
$sql_saidas = "SELECT SUM(valor) AS total_saidas FROM lancamentos WHERE tipo = 'despesa' AND MONTH(data) = $mes AND YEAR(data) = $ano";
$result_saidas = $conn->query($sql_saidas);
$saidas = $result_saidas->fetch_assoc()['total_saidas'];

// Fechar a conexão
$conn->close();

// Retornar os valores no formato JSON para o JavaScript
echo json_encode(['entradas' => $entradas, 'saidas' => $saidas]);
?>
