<?php
require '../config.php';

if (isset($_GET['idTarefa'])) {
  $codigo = $_GET['idTarefa'];
} else {
  echo "Acesso inválido";
}
$sqlKanbanCompleto = "SELECT * FROM Tarefas_Kanban WHERE idTarefa = '" . $codigo . "'";
$stmt = $conection_db->query($sqlKanbanCompleto);
$data = $stmt->fetch_assoc();
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
      <h1>
        <?php echo $data['Titulo']; ?>
      </h1>
      <p>
        <?php echo $data['idTarefa']; ?>
      </p>
      <h3>
        <?php echo $data['Requerente']; ?>
      </h3>
      <span>
        <?php echo utf8_encode($data['Legenda']); ?>
      </span>
      <p>
        <?php echo utf8_encode($data['Descricao']); ?>
      </p>
      <p>
        <?php echo $data['UltimaEdicao']; ?>
      </p>
      <a href="logicom-tarefas.php"><button class="button-submit">Retornar</button></a>
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