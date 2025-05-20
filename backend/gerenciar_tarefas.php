<?php
$conn = new mysqli("localhost", "root", "", "TaskSync");

function getTarefas($status, $conn) {
    $stmt = $conn->prepare("SELECT t.*, u.nome FROM tarefas t JOIN usuarios u ON t.id_usuario = u.id_usuario WHERE status = ?");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    return $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Tarefas</title>
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
        <a href="cadastro_tarefa.php">Cadastrar tarefa</a>
        <a href="gerenciar_tarefas.php" class="active">Gerenciar tarefas</a>
    </div>
    <h2>Gerenciamento de Tarefas</h2>
    <div class="kanban">
        <?php
        $statusList = ["a fazer", "fazendo", "concluído"];
        foreach ($statusList as $status):
            $tarefas = getTarefas($status, $conn);
        ?>
        <div class="coluna">
            <h3><?= ucfirst($status) ?></h3>
            <?php while($t = $tarefas->fetch_assoc()): ?>
                <div class="card">
                    <strong><?= $t['descricao'] ?></strong><br>
                    <small>Responsável: <?= $t['nome'] ?></small><br>
                    <small>Prioridade: <?= $t['prioridade'] ?></small><br>
                    <a href="edtar_tarefas.php?id=<?= $t['id_tarefa'] ?>">Editar</a> |
                    <form method="post" action="excluir_tarefas.php" style="display:inline;" onsubmit="return confirm('Excluir tarefa?')">
                        <input type="hidden" name="id" value="<?= $t['id_tarefa'] ?>">
                        <button type="submit" style="background:none;border:none;color:#007bff;cursor:pointer;padding:0;">Excluir</button>
                    </form> |
                    <form method="post" action="alterar_status.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $t['id_tarefa'] ?>">
                        <select name="novo_status" onchange="this.form.submit()">
                            <?php foreach ($statusList as $s): ?>
                                <option <?= $t['status'] == $s ? 'selected' : '' ?> value="<?= $s ?>"><?= ucfirst($s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
