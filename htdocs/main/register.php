<?php
$host = "calma ai ";
$dbname = "qual foi";
$username = "eu sei que não é um grande serviço";
$password = "mas eu não vou deixar vazar";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($conn->real_escape_string($_POST["password"]), PASSWORD_DEFAULT); // Hash da senha

    // Verifica se o usuário já existe
    $sql_check = "SELECT * FROM login WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "O nome de usuário já existe.";
    } else {
        // Insere novo usuário
        $sql = "INSERT INTO login (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            setcookie("user_email", $email, time() + (7 * 24 * 60 * 60), "/");
            
            echo "Conta criada com sucesso!";
        } else {
            echo "Erro ao criar a conta: " . $conn->error;
        }
    }
}

$conn->close();
?>
