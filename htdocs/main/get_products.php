<?php
header('Content-Type: application/json');

$host = "calma ai ";
$dbname = "qual foi";
$username = "eu sei que não é um grande serviço";
$password = "mas eu não vou deixar vazar";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Erro ao conectar ao banco de dados: " . $conn->connect_error]));
}

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

$categorias = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categoria = $row['categoria'];
        if (!isset($categorias[$categoria])) {
            $categorias[$categoria] = [];
        }
        $categorias[$categoria][] = $row;
    }
}

echo json_encode($categorias);

$conn->close();
?>
