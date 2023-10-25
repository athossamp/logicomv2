<?php

require_once 'config.php';
// Inicializa a sessão;
session_start();

// Checa se o usuario está logado, caso contrário vai para pagina de login;
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {

  header("location: register.php");

  exit;
}
@$paramCNPJ = $_POST['CNPJ'];
@$paramModule = $_POST['servicos'];

if (isset($_POST['btnCNPJ'])) {
  header("Location: https://localhost/SiteLogicomBoletoInterCompleto/docs/API_COBRANCA/boleto.php?CNPJ={$paramCNPJ}&MODULE={$paramModule}");
}
if (isset($_POST['btnTarefa'])) {
  header("Location: tabela-tarefa.php");
}

//Query para alimentar select/option com modulos do DB
$query = mysqli_query($conection_db, "SELECT DISTINCT emp_mod FROM boleto_inter");


$conection_db->close();

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesCliente.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <title>Seleção de tarefa</title>
  </head>

  <body>
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
              <a href="mercado.html">Supermercadista</a>
              <a href="hotelaria.html">Hotelaria e serviços</a>
              <a href="restaurante.html">Restaurante</a>
            </div>
          </div>
          <a class="inicio" href="gestao.html">Gestão</a>
          <div class="highlight-inicio">
          <a class="cliente" href="login.php">Area do cliente <hr class="selected-link" /></a>
          </div>
        </div>
      </div>
    </div>
  </header>
    <main>
      <div class="bem-vindo">
        <div class="bem-vindo-texto">
          <div>
            <h1>Área do cliente</h1><br/>
            <hr /> <br/>
          </div>
          <div>
            <p>A área do cliente, é um espaço reservado para clientes Logicom. Para conseguir um serviço Web personalizado,
              é necessário entrar em contato com a empresa via e-mail ou telefone.
            </p> <br/>
          </div>
        </div>
        <br />
        <div class="bem-vindo-button">
          <a href="tabela-tarefa.php"><button class="login__submit">Lista de tarefas</button></a>
        </div> <br />
      </div>
    </main>


    <!-- Required Js -->
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
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="script.js"></script>
  </body>



</html>
