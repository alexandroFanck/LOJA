<?php
header('Content-Type: application/json');

$host = "calma ai ";
$dbname = "qual foi";
$username = "eu sei que não é um grande serviço";
$password = "mas eu não vou deixar vazar";

$conn = new mysqli($host, $username, $password, $dbname);

$conn->set_charset("utf8");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $imagem = 'uploads/' . basename($_FILES['imagem']['name']);
    move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao enviar a imagem.']);
    exit;
}

$sql = "INSERT INTO produtos (nome, preco, categoria, descricao, imagem) VALUES ('$nome', '$preco', '$categoria', '$descricao', '$imagem')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao adicionar produto.']);
}

$conn->close();
?>
