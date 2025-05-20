<!-- Rafael Gustavo Leal dos Santos n°27 -->

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
        header("Location: cadastro_usuario.php?msg=" . urlencode("Usuário cadastrado com sucesso!"));
        exit();
    } else {
        header("Location: cadastro_usuario.php?msg=" . urlencode("Erro ao cadastrar usuário: " . $conn->error));
        exit();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../img/logo_top.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.onload = function() {
            const params = new URLSearchParams(window.location.search);
            if (params.has('msg')) {
                alert(params.get('msg'));
            }
        }
    </script>
</head>
<style>
    h2 {
        text-align: center;
        margin-top: 20px;
    }
    form {
        max-width: 400px;
        margin: 32px auto;
        padding: 24px;
        background: #f5f6fa;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    @media (max-width: 600px) {
        form {
            max-width: 98vw;
            padding: 12px;
        }
        .navbar {
            flex-direction: column;
            align-items: stretch;
            gap: 4px;
        }
    }
</style>
<body>
    <div class="container">
    <div class="navbar">
        <a href="index.php">Início</a>
        <a href="cadastro_usuario.php">Cadastrar usuários</a>
        <a href="cadastro_tarefa.php">Cadastrar tarefa</a>
        <a href="gerenciar_tarefas.php" class="active">Gerenciar tarefas</a>
    </div>
</div>
    <main>
        <h2>Cadastro de Usuário</h2>
        <form method="post" action="">
            <label>Nome:</label><br>
            <input type="text" name="nome" required style="width:100%;"><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required style="width:100%;"><br><br>

            <label>Setor:</label><br>
            <input type="text" name="setor" required style="width:100%;"><br><br>

            <input type="submit" value="Cadastrar" style="width:100%;">
        </form>
    </main>
</body>
</html>
