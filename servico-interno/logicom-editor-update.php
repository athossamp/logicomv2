<?php
require '../config.php';
session_start();
if (!isset($_SESSION["loggedin"])) {
  exit;
}
$idTarefa = $_POST['paramIdTarefa'];
$sqlUpdateKanban = 'UPDATE Tarefas_Kanban SET idTarefa=?,Titulo = ?, Descricao = ?,
  idAtribuicao = ?, Rotina = ?, idEstado = ?,
   idPrioridade = ?, idCategoria = ?,
    idProjeto = ?, Legenda = ?, UltimaEdicao = ?, UltimaEdicaoData = CURDATE() WHERE idTarefa = ?';
$paramTituloKanbanEdicao = utf8_decode($_POST['paramTitulo']);
$paramDescricaoKanbanEdicao = utf8_decode($_POST['paramDescricao']);
$paramLegendaKanbanEdicao = utf8_decode($_POST['paramLegenda']);
$stmt = mysqli_prepare($conection_db, $sqlUpdateKanban);
mysqli_stmt_bind_param(
  $stmt,
  'issisisiissi',
  $_POST['paramIdTarefa'],
  $paramTituloKanbanEdicao,
  $paramDescricaoKanbanEdicao,
  $_POST['paramAtribuicao'],
  $_POST['paramRotina'],
  $_POST['paramEstado'],
  $_POST['paramIdPrioridade'],
  $_POST['paramIdCategoria'],
  $_POST['paramIdProjeto'],
  $paramLegendaKanbanEdicao,
  $_SESSION['usunome'],
  $_POST['paramIdTarefa']
);
if (mysqli_stmt_execute($stmt) == true) {
  echo "<script>alert('Tarefa atualizada');
   window.location.href = 'http://localhost/servico-interno/logicom-tarefas.php'</script>";
} else {
  echo "<script>alert('TAREFA NÃO FOI ATUALIZADA: " . mysqli_error($conection_db) . "')</script>";
}

?>