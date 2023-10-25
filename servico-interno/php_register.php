<!--TODO: AJUSTAR QUERIES-->
<?php
// Define as variáves que iniciam com valores vazios;
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processa a informação do formulário quando for instanciada;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["nome"]))) {
    $nome_err = "Digite seu nome";
  }
  // Valida o e-mail;
  if (empty(trim($_POST["email"]))) {
    $email_err = "Digite seu email.";
  } else {
    // Prepara uma query de select;
    $sql = "SELECT idUsuario FROM Usuario_Kanban WHERE Email = ?";

    if ($stmt = mysqli_prepare($conection_db, $sql)) {
      // Binda as variáveis para preenchimento das querys, $stmt é a variavel statment, "s" para string, $param_email é a variável que irá bindar;
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // Seta parametros
      $param_email = trim($_POST["email"]);
      @$param_nome = trim($_POST["nome"]);


      // Tenta executar o parâmetro
      if (mysqli_stmt_execute($stmt)) {
        /* guarda resultado */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "Este email ja está cadastrado.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        echo "Algo deu errado, tente novamente mais tarde.";
      }

      // fecha o statement
      mysqli_stmt_close($stmt);
    }
  }

  // Valida a senha ignorando espaço entre os caractéres
  if (empty(trim($_POST["password"]))) {
    $password_err = "Por favor entre com a senha.";
  } elseif
  (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Senha deve ter pelo menos 6 caracteres.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Valida a confirmação de senha
  if (empty(trim(@$_POST["confirm_password"]))) {
    $confirm_password_err = "Favor confirmar a senha.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Senhas não coincidiram.";
    }
  }

  // Checa os erros de input antes de inserir no DB
  if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
    // Prepara um statemente de insert
    $sql = "INSERT INTO Usuario_Kanban (Nome, Email, Senha) VALUES(?, ?, ?)";

    if ($stmt = mysqli_prepare($conection_db, $sql)) {
      // Binda as variáveis para preparar os statements como parametros
      mysqli_stmt_bind_param($stmt, "sss", $param_nome, $param_email, $param_password);

      // Seta parametros
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Tenta executar os parametros
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Usuário registrado');
  window.location.href = 'http://localhost/servico-interno/login.php'</script>";
        // SUCESSO Redireciona para pagina de login
      } else {
        // FALHA
        echo "Algo deu errado. Tente novamente mais tarde.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }
  // Close connection
  mysqli_close($conection_db);
}