<?php

require 'config.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["id"] > 0) {

  header('location: bem-vindo.php');
  exit;
}

$sql = 'SELECT tarefas.tarcodigo, tarefas.empcodigo,
tarefas.tarrotina, tarefas.tarprioridade,
tarefas.tarresumo, tarefas.tardescricao_completa,
tarefas.usucodigo_solicitante, tarefas.tarsolicitacao,
tarefas.tarstatus, tarefas.tarinicio_tarefa,
tarefas.tarfim_tarefa, tarefas.inclusao,
tarefas.inclusao_usucodigo, tarefas.ultatualizacao,
tarefas.usucodigo_atualizacao, usuario.usucodigo,
status_tarefa.tarstatusdescricao, LOGICOM_ROTINA.LGRROTINA, empresa.empfantasia, usuario.usunome, LOGICOM_ROTINA.LGRDESCRICAO
FROM tarefas INNER JOIN usuario ON usuario.usucodigo = tarefas.usucodigo_atualizacao
INNER JOIN status_tarefa ON tarefas.tarstatus = status_tarefa.tarstatus
INNER JOIN LOGICOM_ROTINA ON tarefas.tarrotina = LOGICOM_ROTINA.LGRROTINA
INNER JOIN empresa ON tarefas.empcodigo = empresa.empcodigo
WHERE tarcodigo = "' . $_GET['codigo'] . '"';

$result = $conection_db->query($sql);
$data = $result->fetch_assoc();
if ($data['tarstatusdescricao'] == 'Finalizada' || $data['tarstatusdescricao'] == 'Cancelada') {
  echo "<script>alert('Não é possível atualizar uma tarefa finalizada ou cancelada.')</script>";
  echo "<script>window.location.href = 'https://site.logicom.net.br/tabela-tarefa.php'</script>";
}

$sqlStatus = "SELECT status_tarefa.tarstatusdescricao, tarefas.tarstatus FROM status_tarefa INNER JOIN tarefas WHERE status_tarefa.tarstatus = tarefas.tarstatus";
$statusResult = $conection_db->query($sqlStatus);
$dataStatus = $statusResult->fetch_assoc();

$sqlSelect = 'SELECT * FROM LOGICOM_ROTINA ORDER BY LGRROTINA';
$resultSelect = $conection_db->query($sqlSelect);
if ($resultSelect->num_rows > 0) {
  $dataSelect = mysqli_fetch_all($resultSelect, MYSQLI_ASSOC);
}
$sqlCondition = 'SELECT * FROM status_tarefa';
$resultCondition = $conection_db->query($sqlCondition);
if ($resultCondition->num_rows > 0) {
  $dataCondition = mysqli_fetch_all($resultCondition, MYSQLI_ASSOC);
}


$options = array("Baixa", "Media", "Alta");
$chosens = array($data['tarprioridade']);



$conection_db->close();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesTable.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Seleção de tarefa</title>
  </head>
  <header>
    <div class="header">
      <div class="header-left">
        <a href="index.html"><img src="images/logo.svg" style="height: 90px" /></a>
        <div class="header-right">
          <a class="inicio" href="index.html">Home</a>
          <a class="inicio" href="produtos.html">Produtos</a>
          <div class="dropdown">
            <button class="inicio dropbtn">
              Segmentos
            </button>
            <div class="dropdown-content">
              <a href="mercado.html">Mercado</a>
              <a href="hotelaria.html">Hotelaria</a>
              <a href="restaurante.html">Restaurante</a>
            </div>
          </div>
          <a class="inicio" href="gestao.html">Gestão</a>
          <a class="inicio" href="contato.html">Contato</a>
          <div class="highlight-inicio">
          <a class="cliente" href="login.php">Area do cliente <hr class="selected-link" /></a>
          </div>
        </div>
      </div>
    </div>
    <button id="burgerButton" class="burger-button" type="button">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </button>

    <div id="burgerMenu" class="burger-menu hidden">
      <ul class="nav-items">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="produtos.html">Produtos</a></li>
        <li class="nav-item"><a class="nav-link" href="mercado.html">Mercado</a></li>
        <li class="nav-item"><a class="nav-link" href="hotelaria.html">Hotelaria</a></li>
        <li class="nav-item"><a class="nav-link" href="restaurante.html">Restaurante</a></li>
        <li class="nav-item"><a class="nav-link" href="gestao.html">Gestão</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Registro</a></li>
    </div>
  </header>

  <body>
    <div class="editor-titulo">
    <h1>Editor de tarefas</h1> <br />
    </div>

    <form class="form-insercao" method="post" action="tabela-tarefa-edicao.php">
      <input type="text" name="tarcodigo" value="<?php echo $data['tarcodigo'] ?>" readonly hidden>
      <label>Empresa</label>
      <input class="usuario-solicitante" type="text" name="empcodigo"
        value="<?php echo $data['empcodigo'], ' - ', utf8_encode($data['empfantasia']) ?>" readonly><br />
      <label>Rotina</label>
      <div class="select">
        <select id="standard-select" name="rotina" id="filtroStatus" required>
        <option value=<?php echo $data['LGRROTINA'] ?> selected><?php echo $data['LGRROTINA'], ' - ', utf8_encode($data['LGRDESCRICAO']) ?></option>
        <?php

        foreach ($dataSelect as $resultSelectData) {
          ?>
          <option>
            <?php echo $resultSelectData['LGRROTINA'], ' - ', utf8_encode($resultSelectData['LGRDESCRICAO']) ?>
          </option>
        <?php } ?>
      </select></div><br />

      <label>Prioridade</label>
      <?php foreach ($chosens as $chosen): ?>
        <div class="select">
        <select id="standard-select" name="prioridade" id="filtroStatus">
          <?php foreach ($options as $option): ?>
            <option value="<?php echo $option; ?>" <?php echo ($option == $chosen) ? 'selected' : ''; ?>><?php echo $option; ?></option>
          <?php endforeach; ?>
        </select>
          </div>


        <br />
      <?php endforeach; ?>
      <label>Resumo</label>
      <textarea type="text" name="tarresumo" rows="2" class="usuario-solicitante" value="<?php echo utf8_encode($data['tarresumo']) ?>"
        maxlength="200" required><?php echo utf8_encode($data['tarresumo']) ?></textarea><br />
      <label>Descrição completa</label>
      <textarea type="text" name="tardescricao_completa" rows="10"class="usuario-solicitante"
        value="<?php echo utf8_encode($data['tardescricao_completa']) ?>"
        required><?php echo utf8_encode($data['tardescricao_completa']) ?></textarea><br />
      <label>Usuário solicitante</label>
      <input type="text" name="usucodigo_solicitante"class="usuario-solicitante"
        value="<?php echo $data['usucodigo_solicitante'], ' - ', $data['usunome'] ?>" readonly><br />
      <label>Solicitação da tarefa</label> 
      <input type="date" id="day" name="tarsolicitacao" class="usuario-solicitante" value="<?php echo $data['tarsolicitacao'] ?>" readonly><br />
      <label>Status da tarefa</label>
      <div class="select">
        
      <select id="filtroStatus" class="filtro-select" name="tarstatus" onchange="showHide()" required><br />
        <?php
        foreach ($dataCondition as $resultConditionData) {
          $resultConditionDataTarStatus = $resultConditionData['tarstatus'];
          $resultConditionDataTarStatusDesc = $resultConditionData['tarstatusdescricao'];
          if ($data['tarstatus'] == $resultConditionData['tarstatus']) {
            echo "<option selected='selected' value='$resultConditionDataTarStatus'>$resultConditionDataTarStatusDesc</option>";
          } else {
            echo "<option value='$resultConditionDataTarStatus' required>$resultConditionDataTarStatusDesc</option>";
          }
          ?>

        <?php } ?>
      </select></div><br />
      <div id="dateTask" style="display: none;">
        <label>Início da tarefa</label><br /> 
        <input type="date" class="filtro-data" id="start" name="tarinicio_tarefa"
          value="<?php echo $data['tarinicio_tarefa'] ?>" min=<?php echo $data['tarsolicitacao'] ?>><br />
        <label>Fim da tarefa</label><br /> 
        <input type="date" class="filtro-data" id="end" name="tarfim_tarefa"
          value="<?php echo $data['tarfim_tarefa'] ?>" min=<?php echo $data['tarinicio_tarefa'] ?>><br />

      </div>
      <input type="text" name="inclusao_usucodigo" value="<?php echo $data['inclusao_usucodigo'] ?>"
        style="display: none;">
      <input type="text" name="usucodigo_atualizacao" value="<?php echo $data['usucodigo']; ?>"
        style="display: none;"><br /> <br />
      <input class="button-submit" type="submit" value="Salvar alterações" /><br />
      <u><a href="bem-vindo.php" style="color:whitesmoke; padding-bottom: 24px;">Voltar à pagina inicial</a></u> <br />
      <u><a href="tabela-tarefa.php" style="color:whitesmoke; padding-bottom: 24px;">Voltar à lista de tarefas</a></u>
    </form>
    <footer>
      <div class="footer">
        <div class="left-footer"><a href="index.html"><img src="images/logo.svg" style="height: 60px" /></a></div>
        <div class="middle-footer">
          <a href="https://www.linkedin.com/company/logicom-tecnologia/mycompany/"><img src="images/footer-linkedin.png" style="height: 60px" /></a>
        <a href="https://www.instagram.com/logicomtec/"><img src="images/instagram-header.png" style="height: 60px" /></a>
        <a href="https://www.facebook.com/logicomtec"><img src="images/facebook-header.png" style="height: 60px" /></a>
        </div>
        <div class="right-footer">Logicom © 2023</div>
      </div>
    </footer>
  </body>
  <script src="select.js"></script>
  <script>
    const start = document.getElementById('start');
    const end = document.getElementById('end');
    function showHide() {
      const selectStatus = document.getElementById('filtroStatus')
      const dateTaskStatus = document.getElementById('dateTask')

      dateTaskStatus.style.display = selectStatus.value == 'A' ? "none" : "block"
    }



    start.addEventListener('change', function () {
      if (start.value)
        end.min = start.value;
    }, false);
    end.addEventLiseter('change', function () {
      if (end.value)
        start.max = end.value;
    }, false);



  </script>

</html>
