<?php

require 'config.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["id"] > 5) {

    header('location: bem-vindo.php');
    exit;
}


//Parametros para inserção no DB;
$sqlSelect = 'SELECT usucodigo FROM usuario WHERE usunome = "'.$_POST["usucodSolicitante"].'"';
$result = $conection_db->query($sqlSelect);
$data = $result->fetch_assoc();


$paramEmpCod = utf8_encode($_POST['empCod']);
$paramRotina = $_POST['rotina'];
$paramPrioridade = utf8_encode($_POST['prioridade']);
$paramResumo = utf8_decode($_POST['resumo']);
$paramDescricaoCompleta = utf8_decode($_POST['descricaoCompleta']);
$paramUsuCodigoSol = utf8_encode($data['usucodigo']);
$paramTarSolicitacao = utf8_encode( $_POST['tarSolicitacao']);
$paramTarStatus = $_POST['tarStatus'];
$paramTarInicio = $_POST['tarInicio'];
$paramTarFim = $_POST['tarFim'];
$paramInclusaoUsuCod = $data['usucodigo']; //Codigo de inserção e o solicitante são o mesmo, tendo em vista que apenas o usuário de maior nível consegue usar esta tela;
$paramUsuCodAtt = $data['usucodigo'];


$sqlInsert = "INSERT INTO tarefas (empcodigo,
 tarrotina, tarprioridade, tarresumo,
  tardescricao_completa, usucodigo_solicitante,
    tarsolicitacao, tarstatus, tarinicio_tarefa,
     tarfim_tarefa, inclusao, inclusao_usucodigo,
      ultatualizacao, usucodigo_atualizacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), ?, CURDATE(), ?)";
$stmt = mysqli_prepare($conection_db, $sqlInsert);
mysqli_stmt_bind_param($stmt, 'ssssssssssss', $paramEmpCod, $paramRotina, $paramPrioridade,
 $paramResumo, $paramDescricaoCompleta,
 $paramUsuCodigoSol, $paramTarSolicitacao, $paramTarStatus, $paramTarInicio,
 $paramTarFim, $paramInclusaoUsuCod, $paramUsuCodAtt);
if(mysqli_stmt_execute($stmt) == true) {
    echo  "<script>alert('Tarefa adicionada');
    window.location.href = 'https://logicom.com.br/tabela-tarefa.php'</script>"; 
} else {
    echo "Não inseriu no banco de dados. <a href='tabela-tarefa-inserir-form.php'>Retornar ao formulário</a>";
}
