<!-- Rafael Gustavo Leal dos Santos n°27 -->

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
    <link rel="icon" type="image/png" href="../img/logo_top.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 24px 18px 18px 18px;
        margin-bottom: 18px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: box-shadow 0.2s;
        position: relative;
    }
    .card strong {
        font-size: 1.18rem;
        margin-bottom: 2px;
    }
    .card small {
        color: #555;
        font-size: 0.98rem;
    }
    .card-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        align-items: center;
    }
    .card-actions a, .card-actions button {
        background: none;
        border: none;
        color: #3b3bff;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 6px;
        transition: background 0.15s;
        display: flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
    }
    .card-actions a:hover, .card-actions button:hover {
        background: #f0f2ff;
    }
    .card-actions .delete-btn {
        color: #e74c3c;
    }
    .card-actions .delete-btn:hover {
        background: #ffeaea;
    }
    .card-actions select {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 3px 8px;
        font-size: 1rem;
        margin-left: 8px;
    }
    @media (max-width: 900px) {
        .kanban {
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }
        .coluna {
            min-width: 90vw;
            max-width: 98vw;
        }
    }
    @media (max-width: 600px) {
        .navbar {
            flex-direction: column;
            align-items: stretch;
            gap: 4px;
        }
        .kanban {
            padding: 0 2vw;
        }
        .card {
            padding: 16px 8px 12px 8px;
        }
    }
</style>
<body>
    <div class="navbar">
         <a href="index.php">Início</a>
        <a href="cadastro_usuario.php">Cadastrar usuários</a>
        <a href="cadastro_tarefa.php">Cadastrar tarefa</a>
        <a href="gerenciar_tarefas.php" class="active">Gerenciar tarefas</a>
    </div>
    <main>
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
                        <strong><?= $t['descricao'] ?></strong>
                        <small>Responsável: <?= $t['nome'] ?></small>
                        <small>Prioridade: <?= $t['prioridade'] ?></small>
                        <div class="card-actions">
                            <a href="editar_tarefas.php?id=<?= $t['id_tarefa'] ?>" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form method="post" action="excluir_tarefas.php" onsubmit="return confirm('Excluir tarefa?')" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $t['id_tarefa'] ?>">
                                <button type="submit" class="delete-btn" title="Excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <form method="post" action="alterar_status.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $t['id_tarefa'] ?>">
                                <select name="novo_status" onchange="this.form.submit()">
                                    <?php foreach ($statusList as $s): ?>
                                        <option <?= $t['status'] == $s ? 'selected' : '' ?> value="<?= $s ?>"><?= ucfirst($s) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
