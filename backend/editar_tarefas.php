<!-- Rafael Gustavo Leal dos Santos n°27 -->

<?php
$conn = new mysqli("localhost", "root", "", "TaskSync");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"], $_POST["descricao"], $_POST["prioridade"])) {
        $id = (int)$_POST["id"];
        $descricao = $_POST["descricao"];
        $prioridade = $_POST["prioridade"];
        $stmt = $conn->prepare("UPDATE tarefas SET descricao = ?, prioridade = ? WHERE id_tarefa = ?");
        $stmt->bind_param("ssi", $descricao, $prioridade, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: gerenciar_tarefas.php?msg=" . urlencode("Tarefa editada com sucesso!"));
        exit();
    } else {
        echo "Parâmetros do formulário ausentes.";
        exit();
    }
}

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
    $stmt = $conn->prepare("SELECT * FROM tarefas WHERE id_tarefa = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tarefa = $result->fetch_assoc();
    $stmt->close();
    if (!$tarefa) {
        echo "Tarefa não encontrada.";
        exit();
    }
} else {
    echo "ID da tarefa não fornecido.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarefa</title>
    <script>
        window.onload = function() {
            const params = new URLSearchParams(window.location.search);
            if (params.has('msg')) {
                alert(params.get('msg'));
            }
        }
    </script>
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    form {
        width: 300px;
        margin: 0 auto;
        margin-top: 60px;
        padding: 24px;
        background: #f5f6fa;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    h2 {
        text-align: center;
        margin-top: 60px;
    }
    @media (max-width: 600px) {
        form {
            width: 98vw;
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
        <h2>Editar Tarefa</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $tarefa['id_tarefa'] ?>">
            <label>Descrição:</label><br>
            <textarea name="descricao" style="width:100%;"><?= $tarefa['descricao'] ?></textarea><br><br>
            <label>Prioridade:</label><br>
            <select name="prioridade" style="width:100%;">
                <option value="baixa" <?= $tarefa['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
                <option value="média" <?= $tarefa['prioridade'] == 'média' ? 'selected' : '' ?>>Média</option>
                <option value="alta" <?= $tarefa['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
            </select><br><br>
            <input type="submit" value="Salvar" style="width:100%;">
        </form>
    </main>
</body>
</html>
