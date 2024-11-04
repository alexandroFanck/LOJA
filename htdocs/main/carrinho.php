<?php$host = "calma ai ";$dbname = "qual foi";$username = "eu sei que não é um grande serviço";$password = "mas eu não vou deixar vazar";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT produto, quantidade, preco FROM carrinho";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Produto: " . $row["produto"] . " - Quantidade: " . $row["quantidade"] . " - Preço: R$ " . $row["preco"] . "</p>";
    }
} else {
    echo "<p>O carrinho está vazio.</p>";
}

$conn->close();
?>
