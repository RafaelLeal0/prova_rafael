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
        header("Location: gerenciar_tarefas.php");
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

<form method="post">
    <input type="hidden" name="id" value="<?= $tarefa['id_tarefa'] ?>">
    <label>Descrição:</label><br>
    <textarea name="descricao"><?= $tarefa['descricao'] ?></textarea><br><br>
    <label>Prioridade:</label><br>
    <select name="prioridade">
        <option value="baixa" <?= $tarefa['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
        <option value="média" <?= $tarefa['prioridade'] == 'média' ? 'selected' : '' ?>>Média</option>
        <option value="alta" <?= $tarefa['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
    </select><br><br>
    <input type="submit" value="Salvar">
</form>
