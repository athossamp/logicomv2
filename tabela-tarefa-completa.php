<?php
require 'config.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["id"] > 5) {

  header('location: bem-vindo.php');
  exit;
}

if (isset($_GET['tarcodigo'])) {
  $codigo = $_GET['tarcodigo'];
} else {
  echo "Acesso inválido";
  die;
}
$stmt = $conection_db->query('SELECT tarefas.tarresumo, tarefas.tarrotina, tarefas.tardescricao_completa, tarefas.tarinicio_tarefa, tarefas.tarfim_tarefa, usuario.usunome, LOGICOM_ROTINA.LGRDESCRICAO  FROM tarefas INNER JOIN usuario ON tarefas.usucodigo_solicitante = usuario.usucodigo INNER JOIN LOGICOM_ROTINA ON tarefas.tarrotina = LOGICOM_ROTINA.LGRROTINA WHERE tarcodigo = ' . $codigo);
$data = $stmt->fetch_assoc();
$tarefaResumo = $data['tarresumo'];
$tarefaRotina = $data['tarrotina'];
$tarefaRotinaCompleta = $data['LGRDESCRICAO'];
$tarefaCompleta = $data['tardescricao_completa'];
$usuarioSolicitante = $data['usunome'];
$tarInicio = str_replace('-', '/', $data['tarinicio_tarefa']);
$tarInicioFormatada = date('d/m/Y', strtotime($tarInicio));
$tarFim = str_replace('-', '/', $data['tarfim_tarefa']);
$tarFimFormatada = date('d/m/Y', strtotime($tarFim));

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>

    <link rel="stylesheet" href="stylesTableCompleta.css">
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
  <main>

    <div class="tabela-completa">
      <h1>Tarefa completa</h1>
      <table>

        <td class="tabela-completa-left">Usuário solicitante:
          <?php echo utf8_encode($usuarioSolicitante); ?>
        </td>

        <td>Rotina da tarefa:
          <?php echo $tarefaRotina ?>
        </td>

        <td>Inicio da tarefa:
          <?php echo $tarInicioFormatada ?>
        </td>

        <td>Fim da tarefa:
          <?php echo $tarFimFormatada ?>
        </td>
      </table> <br>
      <table>
        <tr>
          <td class="tabela-completa-left">Resumo da tarefa</td>
          <td>
            <?php echo utf8_encode($tarefaResumo) ?>
          </td>
        </tr>
        <tr>
          <td class="tabela-completa-left">Tarefa Completa</td>
          <td>
            <?php echo utf8_encode($tarefaCompleta) ?>
          </td>
        </tr>
      </table>
    </div>
    <div style="display:flex; justify-content:center;">
      <a href="tabela-tarefa.php"><button style="width: 200px;" class="button-submit">Retornar</button></a>
    </div>

  </main>
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

</html>
