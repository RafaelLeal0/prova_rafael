<?php
$conn = new mysqli("localhost", "root", "", "TaskSync");
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"];
    $descricao = $_POST["descricao"];
    $setor = $_POST["setor"];
    $prioridade = $_POST["prioridade"];
    $data_cadastro = date("Y-m-d");
    
    $sql = "INSERT INTO tarefas (id_usuario, descricao, setor, prioridade, data_cadastro)
            VALUES ('$id_usuario', '$descricao', '$setor', '$prioridade', '$data_cadastro')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Tarefa cadastrada com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$usuarios = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Tarefa</title>
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
        <a href="cadastro_usuario.php">Cadastrar usuários</a>
        <a href="cadastro_tarefa.php" class="active">Cadastrar tarefa</a>
        <a href="gerenciar_tarefas.php">Gerenciar tarefas</a>
    </div>
    <h2>Cadastrar Tarefa</h2>
    <form method="post">
        <label>Usuário:</label><br>
        <select name="id_usuario" required>
            <?php while($u = $usuarios->fetch_assoc()): ?>
                <option value="<?= $u['id_usuario'] ?>"><?= $u['nome'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" required></textarea><br><br>

        <label>Setor:</label><br>
        <input type="text" name="setor" required><br><br>

        <label>Prioridade:</label><br>
        <select name="prioridade" required>
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
