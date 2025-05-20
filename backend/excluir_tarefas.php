<?php
$conn = new mysqli("localhost", "root", "", "TaskSync");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = (int)$_POST["id"];
    $conn->query("DELETE FROM tarefas WHERE id_tarefa = $id");
    header("Location: gerenciar_tarefas.php");
    exit();
} else {
    echo "Parâmetro 'id' não fornecido ou método inválido.";
    exit();
}
?>