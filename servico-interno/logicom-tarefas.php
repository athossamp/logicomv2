<?php

require_once "../config.php";
require_once "../php_login.php";



$sqlSelectKanbanAberto = "SELECT * FROM Tarefas_Kanban WHERE idEstado = 1 ORDER BY idTarefa DESC";

$resultKanban = $conection_db->query($sqlSelectKanbanAberto);
$kanbanTitulosAbertos = array();

$sqlSelectKanbanDesenvolvimento = "SELECT * FROM Tarefas_Kanban WHERE idEstado = 2 ORDER BY idTarefa DESC";

$resultKanbanDesenvolvimento = $conection_db->query($sqlSelectKanbanDesenvolvimento);
$kanbanTitulosDesenvolvimento = array();

$sqlSelectKanbanFechados = "SELECT * FROM Tarefas_Kanban WHERE idEstado = 3 ORDER BY idTarefa DESC";

$resultKanbanFechados = $conection_db->query($sqlSelectKanbanFechados);
$kanbanTitulosFechados = array();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="logicom-tarefas.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet" />
  </head>

  <body>
    <header>
      <div class="header">
        <div class="header-left">
          <a href="index.html"><img src="../images/logo.svg" style="height: 90px" /></a>
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
              <a class="cliente" href="login.php">Area do cliente
                <hr class="selected-link" />
              </a>
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
    <main>
      <div class="tarefas-filtro">
        <h3 class="tarefas-filtro-titulo">Filtro</h3>
        <select class="tarefas-filtro-select">
          <!-- todo: atrelar isso ao banco de dados, foreach (verificar os codigos nas tabelas tarefa, criar campo pra filtrar por rotina?)-->
          <option>Funcionario</option>
          <option>Funcionario</option>
          <option>Funcionario</option>
          <option>Funcionario</option>
          <option>Funcionario</option>
          <option>Funcionario</option>
        </select>
        <button class="button-submit">Filtrar</button>
      </div>
      <div class="tarefas-wrapper">

        <div>
          <div class="tarefas-titulo">
            <h1>Abertas</h1>
          </div>
          <div class="tarefas-abertas">
            <?php
            if ($resultKanban->num_rows > 0) {

              while ($data = $resultKanban->fetch_array()) {
                $kanbanTitulosAbertos[] = array(
                  'titulo' => $data['Titulo'],
                  'idTarefa' => $data['idTarefa'],
                  'resumo' => $data['Legenda'],
                  'usuario' => $data['idAtribuicao'],
                  'rotina' => $data['Rotina']
                );

              }

              foreach ($kanbanTitulosAbertos as $item) {
                $titulo = $item['titulo'];
                $resumo = $item['resumo'];
                $rotina = $item['rotina'];
                $editar = $item['idTarefa'];
                $atribuicao = $item['usuario'];
                $sqlSelectKanbanUser = "SELECT * FROM Usuario_Kanban WHERE idUsuario = '" . $atribuicao . "'";


                $resultSelect = $conection_db->query($sqlSelectKanbanUser);
                $dataSelect = $resultSelect->fetch_assoc();
                $sqlSelectRotinaKanban = "SELECT * FROM LOGICOM_ROTINA WHERE LGRROTINA = '" . $rotina . "'";
                $resultRotina = $conection_db->query($sqlSelectRotinaKanban);
                $dataSelectRotina = $resultRotina->fetch_assoc();
                echo '<div>';
                echo '<div class="kanban-titulo-wrapper">';
                echo '<p class="kanban-titulo">' . utf8_encode($editar), ' ', utf8_encode($titulo) . '</p>';
                echo '</div>';
                echo '<p class="kanban-titulo">Resumo: ' . utf8_encode($resumo) . '</p>';
                echo '<p class="kanban-titulo">Rotina: ' . utf8_encode($rotina), ' - ', utf8_encode($dataSelectRotina['LGRDESCRICAO']) . ' </p>';
                echo '<p class="kanban-titulo">Funcionário: ' . utf8_encode($dataSelect['Nome']) . '</p>';
                echo '<div class="button-submit-wrapper">';
                echo '<a href="logicom-editor.php?idTarefa=' . $editar . '"><button class="button-submit tarefas">Editar</button></a>';
                echo '<a href="logicom-tarefa-completa.php?idTarefa=' . $editar . '"><button class="button-submit tarefas">Acessar</button></a>';
                echo '</div>';

                echo '</div>';

              }

            }
            ?>
          </div>

        </div>
        <div>
          <div class="tarefas-titulo">
            <h1>Em Desenvolvimento</h1>
          </div>
          <div class="tarefas-desenvolvimento">
            <?php
            if ($resultKanbanDesenvolvimento->num_rows > 0) {

              while ($data = $resultKanbanDesenvolvimento->fetch_array()) {
                $kanbanTitulosDesenvolvimento[] = array(
                  'titulo' => $data['Titulo'],
                  'resumo' => $data['Legenda'],
                  'idTarefa' => $data['idTarefa'],
                  'usuario' => $data['idAtribuicao'],
                  'rotina' => $data['Rotina']
                );
              }

              foreach ($kanbanTitulosDesenvolvimento as $item) {
                $titulo = $item['titulo'];
                $editar = $item['idTarefa'];
                $resumo = $item['resumo'];
                $atribuicao = $item['usuario'];
                $rotina = $item['rotina'];
                $sqlSelectKanbanUser = "SELECT * FROM Usuario_Kanban WHERE idUsuario = '" . $atribuicao . "'";
                $resultSelect = $conection_db->query($sqlSelectKanbanUser);
                $dataSelect = $resultSelect->fetch_assoc();
                $sqlSelectRotinaKanban = "SELECT * FROM LOGICOM_ROTINA WHERE LGRROTINA = '" . $rotina . "'";
                $resultRotina = $conection_db->query($sqlSelectRotinaKanban);
                $dataSelectRotina = $resultRotina->fetch_assoc();
                echo '<div>';
                echo '<div class="kanban-titulo-wrapper">';
                echo '<p class="kanban-titulo">' . utf8_encode($editar), ' ', utf8_encode($titulo) . '</p>';
                echo '</div>';
                echo '<p class="kanban-titulo">Resumo: ' . utf8_encode($resumo) . '</p>';
                echo '<p class="kanban-titulo">Rotina: ' . utf8_encode($rotina), ' - ', utf8_encode($dataSelectRotina['LGRDESCRICAO']) . ' </p>';
                echo '<p class="kanban-titulo">Funcionário: ' . utf8_encode($dataSelect['Nome']) . '</p>';
                echo '<div class="button-submit-wrapper">';
                echo '<a href="logicom-editor.php?idTarefa=' . $editar . '"><button class="button-submit tarefas">Editar</button></a>';
                echo '<a href="logicom-tarefa-completa.php?idTarefa=' . $editar . '"><button class="button-submit tarefas">Acessar</button></a>';
                echo '</div>';
                echo '</div>';

              }
            }
            ?>
          </div>
        </div>
        <div>
          <div class="tarefas-titulo">
            <h1>Finalizadas</h1>
          </div>
          <div class="tarefas-finalizadas">
            <?php

            if ($resultKanbanFechados->num_rows > 0) {

              while ($data = $resultKanbanFechados->fetch_array()) {
                $kanbanTitulosFechados[] = array(
                  'titulo' => $data['Titulo'],
                  'resumo' => $data['Legenda'],
                  'idTarefa' => $data['idTarefa'],
                  'rotina' => $data['Rotina'],
                  'usuario' => $data['idAtribuicao']
                );
              }

              foreach ($kanbanTitulosFechados as $item) {
                $titulo = $item['titulo'];
                $resumo = $item['resumo'];
                $atribuicao = $item['usuario'];
                $editar = $item['idTarefa'];
                $rotina = $item['rotina'];
                $sqlSelectKanbanUser = "SELECT * FROM Usuario_Kanban WHERE idUsuario = '" . $atribuicao . "'";
                $resultSelect = $conection_db->query($sqlSelectKanbanUser);
                $dataSelect = $resultSelect->fetch_assoc();
                $sqlSelectRotinaKanban = "SELECT * FROM LOGICOM_ROTINA WHERE LGRROTINA = '" . $rotina . "'";
                $resultRotina = $conection_db->query($sqlSelectRotinaKanban);
                $dataSelectRotina = $resultRotina->fetch_assoc();
                echo '<div>';
                echo '<div class="kanban-titulo-wrapper">';
                echo '<p class="kanban-titulo">' . utf8_encode($editar), ' ', utf8_encode($titulo) . '</p>';
                echo '</div>';
                echo '<p class="kanban-titulo">Resumo: ' . utf8_encode($resumo) . '</p>';
                echo '<p class="kanban-titulo">Rotina: ' . utf8_encode($rotina), ' - ', utf8_encode($dataSelectRotina['LGRDESCRICAO']) . ' </p>';
                echo '<p class="kanban-titulo">Funcionário: ' . utf8_encode($dataSelect['Nome']) . '</p>';
                echo '<div class="button-submit-wrapper">';
                echo '<a href="logicom-editor.php?idTarefa=' . $editar . '"><button class="button-submit tarefas">Editar</button></a>';
                echo '<a href="logicom-tarefa-completa.php?idTarefa=' . $editar . '"><button class="button-submit tarefas">Acessar</button></a>';
                echo '</div>';
                echo '</div>';
              }
            }
            ?>
          </div>
        </div>


      </div>
      <div class="logicom-cadastro-button">
        <a href="logicom-cadastro.php"><button class="button-submit">Cadastrar tarefa</button></a>
      </div>

    </main>
    <img class="onda-logicom" src="../../images/Logicom ondas.png" />
    <footer>
      <div class="footer">
        <div class="left-footer"><a href="index.html"><img src="../images/logo.svg" style="height: 60px" /></a></div>
        <div class="middle-footer">
          <a href="https://www.linkedin.com/company/logicom-tecnologia/mycompany/"><img
              src="../images/footer-linkedin.png" style="height: 60px" /></a>
          <a href="https://www.instagram.com/logicomtec/"><img src="../images/instagram-header.png"
              style="height: 60px" /></a>
          <a href="https://www.facebook.com/logicomtec"><img src="../images/facebook-header.png"
              style="height: 60px" /></a>
        </div>
        <div class="right-footer">Logicom © 2023</div>
      </div>
    </footer>
  </body>

</html>