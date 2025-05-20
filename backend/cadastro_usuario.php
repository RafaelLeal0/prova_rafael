<?php
$conn = new mysqli("localhost", "root", "", "TaskSync");
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $setor = $_POST["setor"];

    $sql = "INSERT INTO usuarios (nome, email, setor) VALUES ('$nome', '$email', '$setor')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>
    h2 {
        text-align: center;
        margin-top: 20px;
    }
</style>
<body>
    <div class="navbar">
        <a href="cadastro_usuario.php" class="active">Cadastrar de usuário</a>
        <a href="cadastro_tarefa.php">Cadastrar tarefa</a>
        <a href="gerenciar_tarefas.php">Gerenciar tarefas</a>
    </div>
    <h2>Cadastro de Usuário</h2>
    <form method="post" action="">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Setor:</label><br>
        <input type="text" name="setor" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
