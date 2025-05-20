<!-- Rafael Gustavo Leal dos Santos n°27 -->

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
        header("Location: cadastro_tarefa.php?msg=" . urlencode("Tarefa cadastrada com sucesso!"));
        exit();
    } else {
        header("Location: cadastro_tarefa.php?msg=" . urlencode("Erro ao cadastrar tarefa: " . $conn->error));
        exit();
    }
}

$usuarios = $conn->query("SELECT * FROM usuarios");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Tarefa</title>
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
        <h2>Cadastrar Tarefa</h2>
        <form method="post">
            <label>Usuário:</label><br>
            <select name="id_usuario" required style="width:100%;">
                <?php while($u = $usuarios->fetch_assoc()): ?>
                    <option value="<?= $u['id_usuario'] ?>"><?= $u['nome'] ?></option>
                <?php endwhile; ?>
            </select><br><br>

            <label>Descrição:</label><br>
            <textarea name="descricao" required style="width:100%;"></textarea><br><br>

            <label>Setor:</label><br>
            <input type="text" name="setor" required style="width:100%;"><br><br>

            <label>Prioridade:</label><br>
            <select name="prioridade" required style="width:100%;">
                <option value="baixa">Baixa</option>
                <option value="média">Média</option>
                <option value="alta">Alta</option>
            </select><br><br>

            <input type="submit" value="Cadastrar" style="width:100%;">
        </form>
    </main>
</body>
</html>
