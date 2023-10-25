<?php
require 'config.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["id"] > 5) {

  header('location: bem-vindo.php');
  exit;
}

header('Content-Type: text/html; charset=utf-8');


if (isset($_POST['filtroStatus'])) {
  $sql = 'SELECT tarefas.tarcodigo, tarefas.empcodigo,
        tarefas.tarrotina, tarefas.tarprioridade,
        tarefas.tarresumo, tarefas.tardescricao_completa,
        tarefas.usucodigo_solicitante, tarefas.tarsolicitacao,
        status_tarefa.tarstatusdescricao, tarefas.tarinicio_tarefa,
        tarefas.tarfim_tarefa, tarefas.inclusao,
        tarefas.inclusao_usucodigo, tarefas.ultatualizacao,
        tarefas.usucodigo_atualizacao, usuario.usunome, LOGICOM_ROTINA.LGRROTINA
        FROM tarefas
        INNER JOIN usuario ON usuario.usucodigo = tarefas.usucodigo_solicitante
        INNER JOIN status_tarefa ON tarefas.tarstatus = status_tarefa.tarstatus
        INNER JOIN LOGICOM_ROTINA ON tarefas.tarrotina = LOGICOM_ROTINA.LGRROTINA
    WHERE status_tarefa.tarstatus ' . $_POST['filtroStatus'] . ' ORDER BY tarcodigo';
} else {
  $sql = "SELECT tarefas.tarcodigo, tarefas.empcodigo,
    tarefas.tarrotina, tarefas.tarprioridade,
    tarefas.tarresumo, tarefas.tardescricao_completa,
    tarefas.usucodigo_solicitante, tarefas.tarsolicitacao,
    status_tarefa.tarstatusdescricao, tarefas.tarinicio_tarefa,
    tarefas.tarfim_tarefa, tarefas.inclusao,
    tarefas.inclusao_usucodigo, tarefas.ultatualizacao,
    tarefas.usucodigo_atualizacao, usuario.usunome, LOGICOM_ROTINA.LGRROTINA
    FROM tarefas
    INNER JOIN usuario ON usuario.usucodigo = tarefas.usucodigo_solicitante
    INNER JOIN status_tarefa ON tarefas.tarstatus = status_tarefa.tarstatus
    INNER JOIN LOGICOM_ROTINA ON tarefas.tarrotina = LOGICOM_ROTINA.LGRROTINA
    WHERE status_tarefa.tarstatus IN ('A', 'D', 'F', 'C') ORDER BY tarcodigo";
}



$result = $conection_db->query($sql);


?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>

    <link rel="stylesheet" href="stylesTable.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
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
    <main>
      <div class="tabela-titulo">
        <h1>LISTA DE TAREFAS</h1>

        <form action="tabela-tarefa.php" method="post">
          <div class="select">
            <select id="standard-select" name="filtroStatus" id="filtroStatus">
              <option value="IN ('A', 'D', 'F', 'C')" selected="selected">Todos</option>
              <option value="= 'A'">Aberta</option>
              <option value="= 'D'">Em Desenvolvimento</option>
              <option value="= 'F'">Finalizada</option>
              <option value="= 'C'">Cancelada</option>
            </select>
            <span class="focus"></span>
          </div>
          <script>
            type="text/javascript"> document.getElementById("filtroStatus").value = <?php echo $_GET['filtroStatus']; ?></script>
          <div>
            <input class="button-submit" name="search" type="submit" value="Filtrar" />
          </div>
          <div>
            <a href="tabela-tarefa-inserir-form.php"><input class="button-submit" name="search"
                value="Inserir nova tarefa" /></a>
          </div><br />
          <div>
            <u><a href="bem-vindo.php">Voltar à pagina inicial</a></u>
          </div>


        </form><br />
      </div>
      <div class="center-table">
        <table border="1" cellspacing="0" cellpadding="0" class="tarefa-tabela">
          <tbody>
            <tr>
              <th style="width: 4vw;">Código</th>
              <th style="width: 4vw;">Rotina</th>
              <th style="width: 6vw;">Prioridade</th>
              <th style="width:16vw;">Resumo</th>
              <th style="width: 8vw;">Informações adicionais</th>
              <th style="width:8vw;">Solicitação</th>
              <th style="width: 10vw;">Status</th>
              <th style="width: 8vw;">Inclusão</th>
              <th style="width: 8vw;">Usuário</th>
              <th style="width: 8vw;">Última atualização</th>
              <th style="width: 4vw;">Editor</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {

              while ($data = $result->fetch_assoc()) {
                $dataSolicitacao = str_replace('-', '/', $data['tarsolicitacao']);
                $dataSolicitacaoFormatada = date('d/m/Y', strtotime($dataSolicitacao));
                $dataInclusao = str_replace('-', '/', $data['inclusao']);
                $dataInclusaoFormatada = date('d/m/Y', strtotime($dataInclusao));
                $dataAtualizacao = str_replace('-', '/', $data['ultatualizacao']);
                $dataAtualizacaoFormatada = date('d/m/Y', strtotime($dataAtualizacao));
                $dataStatus = $data['tarstatusdescricao'];
                $dataResumo = utf8_encode($data['tarresumo']);
                if ($data['tarstatusdescricao'] == 'Finalizada' && @($_POST['editSubmit'])) {
                  echo "<script>alert('JLASJDKLA')</script>";
                }

                ?>

                <tr id="targetTable">
                  <td>
                    <?php echo utf8_encode($data['tarcodigo']); ?>
                  </td>

                  <td>
                    <?php echo ($data['LGRROTINA']); ?>
                  </td>
                  <td>
                    <?php echo utf8_encode($data['tarprioridade']); ?>
                  </td>
                  <td class="td-resumo" style="width: 510px">
                    <?php echo $dataResumo; ?>
                  </td>
                  <td class="td-leia-mais"><a href="tabela-tarefa-completa.php?tarcodigo=<?php echo $data['tarcodigo'] ?>"><u class="td-leia-mais-link">Leia mais</u></a>
                  </td>
                  <td class="td-data">
                    <?php echo utf8_encode($dataSolicitacaoFormatada); ?>
                  </td> 
                  <td id="tdStatus" class="td-status" style="width: 300px;">
                    <?php echo utf8_encode($data['tarstatusdescricao']); ?>
                  </td>
                  <td class="td-data">
                    <?php echo $dataInclusaoFormatada ?>
                  </td>
                  <td class="td-data">
                    <?php echo utf8_encode($data['usunome']); ?>
                  </td>
                  <td class="td-data">
                    <?php echo $dataAtualizacaoFormatada; ?>
                  </td>
                  <td class="td-data"><a name="editSubmit" id="editButton"
                      href="tabela-tarefa-edicao-select.php?codigo=<?php echo $data['tarcodigo']; ?>"><button
                        name="editSubmit" onchange="disableButton()" class="edit-button">Editar</button></a> </td>

                <tr>
                  <?php

              }
            } else { ?>
              <td style="font-weight: bolder;" colspan="20">Não há campos com este filtro.</td>
            </tr>
            <?php } ?>
          </tbody>
        </table ?>
      </div>

    </main>
    <img class="onda-logicom" src="images/Logicom ondas.png" />
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
  <script src="script.js"></script>
  <script>
      let myTable = document.getElementById('targetTable');
    let cells = myTable.querySelectorAll('td');
    cells.forEach((cell) => console.log(cell.innerHTML));


  </script>

</html>
