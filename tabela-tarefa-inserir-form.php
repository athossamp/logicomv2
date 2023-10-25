<?php
include 'config.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["id"] > 0) {

  header('location: bem-vindo.php');
  exit;
}

$sql = 'SELECT usucodigo, usunome FROM usuario WHERE usulogin  = "' . $_SESSION['email'] . '"';

$result = $conection_db->query($sql);
$data = $result->fetch_assoc();
$sqlSelect = 'SELECT * FROM LOGICOM_ROTINA ORDER BY LGRROTINA';
$resultSelect = $conection_db->query($sqlSelect);
if ($resultSelect->num_rows > 0) {
  $dataSelect = mysqli_fetch_all($resultSelect, MYSQLI_ASSOC);
}
$sqlEmpresa = 'SELECT empresa.empcodigo, empresa.empfantasia FROM empresa';
$resultEmpresa = $conection_db->query($sqlEmpresa);
if ($resultEmpresa->num_rows > 0) {
  $dataEmpresa = mysqli_fetch_all($resultEmpresa, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesTable.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <title>Inserção de Tabela</title>
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
    <div class="titulo-inserir">
      <h1>Inserir Tarefa</h1>
    </div>

    <form class="form-insercao" action="tabela-tarefa-inserir.php" method="post" name="submitDB">
      <label>Empresa</label>
      <div class="select">
        <select id="standard-select" name="empCod" id="filtroStatus">
          <?php
          foreach ($dataEmpresa as $resultSelectEmpresa) {
            ?>
            <option value=<?php echo $resultSelectEmpresa['empcodigo'] ?> required><?php echo $resultSelectEmpresa['empcodigo'], ' - ', utf8_encode($resultSelectEmpresa['empfantasia']) ?></option>
          <?php } ?>
        </select>
        <span class="focus"></span>
      </div>

      </select><br />
      <label>Selecione a rotina</label>

      <div class="select">
        <select id="standard-select" name="rotina" id="filtroStatus">
          <?php
          foreach ($dataSelect as $resultSelectData) {
            ?>
            <option value=<?php echo $resultSelectData['LGRROTINA'] ?> required><?php echo $resultSelectData['LGRROTINA'], ' - ', utf8_encode($resultSelectData['LGRDESCRICAO']) ?></option>
          <?php } ?>
        </select>
        <span class="focus"></span>
      </div>

      </select><br />
      <label>Prioridade</label>

      <div class="select">
        <select id="standard-select" name="prioridade" id="filtroStatus">
          <option value="Baixa" selected="selected">Baixa</option>
          <option value="Media">Média</option>
          <option value="Alta">Alta</option>
        </select>
        <span class="focus"></span>
      </div>

      </select><br />
      <label>Resumo</label>
      <textarea class="usuario-solicitante" rows="2" name="resumo" maxlength="200" required> </textarea><br />
      <label>Descrição Completa</label>
      <textarea class="usuario-solicitante" rows="10" name="descricaoCompleta" required></textarea><br />
      <label>Usuário Solicitante</label>
      <input type="text" class="usuario-solicitante" name="usucodSolicitante" value="<?php echo $data['usunome'] ?>"
        readonly><br />
      <label>Solicitação de tarefa</label> <!--data-->
      <input type="date" name="tarSolicitacao" class="usuario-solicitante" max="<?php echo date("Y-m-d") ?>"
        value="<?php echo date("Y-m-d") ?>" required><br />
      <input name="tarStatus" value="A" type="hidden" required>
      <input type="date" name="tarInicio" style="display:none">
      <input type="date" name="tarFim" style="display:none">
      <input class="button-submit" id="submitDB" type="submit" value="Inserir no banco" name="submitDB" /><br />
    </form>
    <div style="display: flex; justify-content:center;">

      <u><a href="tabela-tarefa.php" style="color:whitesmoke; padding-bottom: 24px;">Voltar à lista de tarefas</a></u>
    </div>
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
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="script.js"></script>
  </body>

</html>
