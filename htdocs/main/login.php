<?php$host = "calma ai ";$dbname = "qual foi";$username = "eu sei que não é um grande serviço";$password = "mas eu não vou deixar vazar";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST["username"]); 
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row["password"])) {
            echo "Login bem-sucedido!";
            setcookie("user_email", $email, time() + (7 * 24 * 60 * 60), "/"); 

        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Método de solicitação inválido.";
}

$conn->close();
?>
