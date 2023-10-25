<?php

require_once "../config.php";
session_start();
if (!isset($_SESSION["loggedin"])) {
  exit;
}
$sqlSelect = 'SELECT * FROM LOGICOM_ROTINA ORDER BY LGRROTINA';
$resultSelect = $conection_db->query($sqlSelect);
if ($resultSelect->num_rows > 0) {
  $dataSelect = mysqli_fetch_all($resultSelect, MYSQLI_ASSOC);
}

$sqlSelectUsuario = 'SELECT * FROM Usuario_Kanban';
$resultSelectUsuario = $conection_db->query($sqlSelectUsuario);
if($resultSelectUsuario->num_rows > 0) {
  $dataSelectUsuario = mysqli_fetch_all($resultSelectUsuario, MYSQLI_ASSOC);
}

$sqlSelectProjeto = 'SELECT * FROM Projeto_Kanban';
$resultSelectProjeto = $conection_db->query($sqlSelectProjeto);
if($resultSelectProjeto->num_rows > 0) {
  $dataSelectProjeto = mysqli_fetch_all($resultSelectProjeto, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="logicom-cadastro.css" />
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
      <div class="main-form">
        <h1>Cadastro de atividades</h1>
        <form method="post" action="logicom-cadastro-insert.php">
          <label class="cadastro-input-title">Titulo</label>
          <input name="paramTitulo" class="cadastro-input" />
          <label class="cadastro-input-title">Resumo</label>
          <textarea name="paramLegenda" class="cadastro-input"></textarea>
          <label class="cadastro-input-title">Descrição</label>
          <textarea name="paramDescricao" class="cadastro-input"></textarea>
          <!--Escolher nome do funcionario p/ atribuicao-->

          <label class="cadastro-input-title">Atribuição</label>
          <select name="paramAtribuicao" class="tarefas-filtro-select">
            <?php foreach($dataSelectUsuario as $resultUsuario) {
                ?> <option value=<?php echo $resultUsuario['IdUsuario'] ?> >
                  <?php echo $resultUsuario['Nome']?>
                </option>
              <?php } ?>
          </select>
          <label class="cadastro-input-title">Rotina</label>
          <select id="standard-select" name="paramRotina" id="filtroStatus" class="tarefas-filtro-select">
            <?php
            foreach ($dataSelect as $resultSelectData) {
              $combinedValue = $resultSelectData['LGRROTINA'] . ' - ' . utf8_encode($resultSelectData['LGRDESCRICAO']);
              ?>
              <option value=<?php echo $combinedValue ?> required>
                <?php echo $combinedValue ?>
              </option>
            <?php } ?>
          </select>
          <label class="cadastro-input-title">Estado de Desenvolvimento</label>
          <select id="selectOption" name="paramEstado" class="tarefas-filtro-select">
            <option value='1'>Aberto</option>
            <option value='2'>Desenvolvimento</option>
            <option value='3'>Finalizada</option>
          </select>
          <!--Requerente = usuario que cadastrou-->
          <label class="cadastro-input-title">Prioridade</label>
          <select name="paramIdPrioridade" class="tarefas-filtro-select">
            <option value='1'>Alta</option>
            <option value='2'>Media</option>
            <option value='3'>Baixa</option>
          </select>
          <label class="cadastro-input-title">Categoria</label>
          <select name="paramIdCategoria" class="tarefas-filtro-select">
            <option value='1'>Desktop</option>
            <option value='2'>Mobile</option>
            <option value='3'>Web</option>
          </select>
          <label class="cadastro-input-title">Projeto</label>
          <select name="paramIdProjeto" class="tarefas-filtro-select">
            <?php foreach($dataSelectProjeto as $resultProjeto) { ?>
                <option value=<?php echo $resultProjeto['idProjeto'] ?> >
                  <?php echo $resultProjeto['Titulo'] ?>
                </option>
              <?php }?>
          </select>

          <button type="submit" class="button-submit tarefas">Salvar</button>
        </form>
      </div>
      <div class="ver-tarefas">
        <a href="logicom-tarefas.php"><button class="button-submit">Ver Tarefas</button></a>
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
  <script src="script.js"></script>

</html>