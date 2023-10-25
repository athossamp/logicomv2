<?php
require_once "../config.php";
session_start();
$paramTituloKanban = utf8_decode($_POST['paramTitulo']);
$paramDescricaoKanban = utf8_decode($_POST['paramDescricao']);
$paramAtribuicaoKanban = $_POST['paramAtribuicao'];
$combinedValue = $_POST['paramRotina'];
$paramIdEstadoKanban = $_POST['paramEstado'];
$paramRequerenteKanban = $_SESSION['usunome'];
$paramIdPrioridadeKanban = $_POST['paramIdPrioridade'];
$paramIdCategoriaKanban = $_POST['paramIdCategoria'];
$paramIdProjetoKanban = $_POST['paramIdProjeto'];
$paramLegendaKanban = utf8_decode($_POST['paramLegenda']);
$paramUltimaEdicao = $_SESSION['usunome'];
$sqlInsertTarefa = "INSERT INTO Tarefas_Kanban(Titulo, Descricao,
 Data, idAtribuicao, Rotina, idEstado, Requerente,
  idPrioridade, idCategoria, idProjeto, Legenda, UltimaEdicao, UltimaEdicaoData)
VALUES(?, ?, CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE())";
$stmt = mysqli_prepare($conection_db, $sqlInsertTarefa);
mysqli_stmt_bind_param(
  $stmt,
  'sssssssssss',
  $paramTituloKanban,
  $paramDescricaoKanban,
  $paramAtribuicaoKanban,
  $combinedValue,
  $paramIdEstadoKanban,
  $paramRequerenteKanban,
  $paramIdPrioridadeKanban,
  $paramIdCategoriaKanban,
  $paramIdProjetoKanban,
  $paramLegendaKanban,
  $paramUltimaEdicao
);
if (mysqli_stmt_execute($stmt) == true) {
  echo "<script>alert('Tarefa adicionada')
  window.location.href = 'http://localhost/servico-interno/logicom-tarefas.php'</script>";
} else {
  echo "Não inseriu no banco de dados. <a href='tabela-tarefa-inserir-form.php'>Retornar ao formulário</a>" . mysqli_stmt_error($stmt);
}
?>