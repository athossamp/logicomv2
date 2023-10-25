<?php

session_start();
require_once '../config.php';

include "php_register.php";
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
          <a href="index.html"><a href="index.html"><img src="../images/logo.svg" style="height: 60px" /></a></a>
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
      <br /><br /><br />
      <div class="cont">
        <div class="form sign-in">
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Registre sua conta</h2>
            <label>
              <br />
              <span>Nome</span>
              <div class="login__field userpwd" <?= (!empty($nome_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="nome" />
              </div>
              <span class="help-block">
                <?= @$nome_err; ?>
              </span>

            </label>
            <label>
              <span>Email</span>
              <div class="login__field userpwd" <?= (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" value="<?= $email; ?>" />
              </div>
              <span class="help-block">
                <?= $email_err; ?>
              </span>
            </label>
            <label>
              <span>Senha</span>
              <div class="login__field userpwd" <?= (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" value="<?= $password; ?>" />
              </div>
              <span class="help-block">
                <?= $password_err; ?>
              </span>
            </label>
            <label>
              <span>Confirme sua senha</span>
              <div class="login__field userpwd" <?= (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" value="<?= $confirm_password; ?>" />
              </div>
              <span class="help-block">
                <?= $confirm_password_err; ?>
              </span>
            </label>
            <button type="submit" class="submit">Registre-se</button>
          </form>

        </div>
        <div class="sub-cont">
          <div class="img">
            <div class="img__text m--up">
              <h3>Já possui uma conta? <h3>
                  <button class="button-register"><a class="link__text" href="login.php">Acesse</a></button>
                  <div class="logo-form">
                    <img src="../images/logo.svg" />
                  </div>
            </div>
          </div>
        </div>
      </div>
      </div>


    </main>
    <img class="onda-logicom" src="../images/Logicom ondas.png" />
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

    <!-- Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>



  </body>
  <script src="script.js"></script>

</html>