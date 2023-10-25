<?php

session_start();

require_once "../config.php";
require_once "php_login.php";
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logicom Tecnologia</title>
    <link rel="stylesheet" href="stylesRegister.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">

  </head>

  <body>
    <header>
      <div class="header">
        <div class="header-left">
          <a href="index.html"><img src="../images/logo.svg" style="height: 60px" /></a>
          <div class="header-right">
            <a class="inicio" href="index.html">Home</a>
            <a class="inicio" href="produtos.html">Produtos</a>
            <div class="dropdown">
              <button class="inicio dropbtn">Segmentos</button>
              <div class="dropdown-content">
                <a href="mercado.html">Supermercadista</a>
                <a href="hotelaria.html">Hotelaria e serviços</a>
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
          <li class="nav-item"><a class="nav-link" href="mercado.html">Supermercadista</a></li>
          <li class="nav-item"><a class="nav-link" href="restaurante.html">Restaurante</a></li>
          <li class="nav-item"><a class="nav-link" href="hotelaria.html">Hotelaria e Serviços</a></li>
          <li class="nav-item"><a class="nav-link" href="gestao.html">Gestão</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Registro</a></li>
      </div>
    </header>
    <main>
      <br />
      <br />
      <br />
      <div class="cont">
        <div class="form sign-in">
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class='login'>
            <h2>Bem-vindo!</h2>
            <label>
              <span>Email</span>
              <input type="email" name="email" title="Entre com um endereço de e-mail válido"
                requiredvalue="<?= $email; ?>" required />
            </label>
            <label>
              <span>Senha</span>
              <input type="password" name="password" />
            </label>
            <p class="forgot-pass">Esqueceu sua senha? <a href="forgot-password.php">Resetar senha</a></p>
            <button type="submit" class="submit">Acessar</button>
          </form>

        </div>
        <div class="sub-cont">
          <div class="img">
            <div class="img__text m--up">
              <h3>Não tem uma conta?<h3>
                  <button class="button-register"><a class="link__text" href="register.php">Registre-se</a></button>
                  <div class="logo-form">
                    <img src="../images/logo.svg" />
                  </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <img class="onda-logicom" src="../images/Logicom ondas.png" />
    </main>
    <!-- -----------------------------conteúdo -------------------------- -->

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

    <!-- Required Js -->
    <script src="script.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>