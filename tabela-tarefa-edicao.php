<?php


require 'config.php';

$sqlUpdate = "UPDATE tarefas SET tarcodigo = ?, empcodigo = ?,
tarrotina = ?, tarprioridade = ?, tarresumo = ?,
tardescricao_completa = ?, usucodigo_solicitante = ?,
tarsolicitacao = ?, tarstatus = ?, tarinicio_tarefa = ?,
tarfim_tarefa = ?, inclusao_usucodigo = ?,
ultatualizacao = CURDATE(), usucodigo_atualizacao = ? WHERE tarcodigo = ?";
$resumo = utf8_decode($_POST['tarresumo']);
$completa = utf8_decode($_POST['tardescricao_completa']);
$stmt = mysqli_prepare($conection_db, $sqlUpdate);
mysqli_stmt_bind_param(
  $stmt,
  'iissssissssiii',
  $_POST['tarcodigo'],
  $_POST['empcodigo'],
  $_POST['rotina'],
  $_POST['prioridade'],
  $resumo,
  $completa,
  $_POST['usucodigo_solicitante'],
  $_POST['tarsolicitacao'],
  $_POST['tarstatus'],
  $_POST['tarinicio_tarefa'],
  $_POST['tarfim_tarefa'],
  $_POST['inclusao_usucodigo'],
  $_POST['usucodigo_atualizacao'],
  $_POST['tarcodigo']
);
if (mysqli_stmt_execute($stmt) == true) {
  echo "<script>alert('Tarefa atualizada');
  window.location.href = 'https://logicom.com.br/tabela-tarefa.php'</script>";
} else {
  echo "<script>alert('TAREFA NÃO FOI ATUALIZADA: " . mysqli_error($conection_db) . "')</script>";
}



?>