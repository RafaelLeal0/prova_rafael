<!-- Rafael Gustavo Leal dos Santos n°27 -->

<?php
$conn = new mysqli("localhost", "root", "", "TaskSync");

$id = $_POST["id"];
$novo_status = $_POST["novo_status"];

$sql = "UPDATE tarefas SET status = '$novo_status' WHERE id_tarefa = $id";
$conn->query($sql);

header("Location: gerenciar_tarefas.php");
?>