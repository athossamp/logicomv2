<!--TODO: AJUSTAR QUERIES-->
<?php

$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["email"]))) {
    $email_err = "Digite o seu e-mail.";
  } else {
    $email = trim($_POST["email"]);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "Digite a sua senha.";
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty($email_err) && empty($password_err)) {

    $sql = "SELECT Usunivel,Email, Senha, Nome FROM Usuario_Kanban WHERE Email = ?";
    if ($stmt = @mysqli_prepare($conection_db, $sql)) {

      mysqli_stmt_bind_param($stmt, "s", $param_email);


      $param_email = $email;

      if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {

          mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $usunome);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {

              session_start();

              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["email"] = $email;
              $_SESSION["usunome"] = $usunome;


              header("location:logicom-tarefas.php");
            } else {

              echo '<script>alert("Nenhuma conta foi encontrada com estas credenciais")</script>';
            }
          }
        } else {

          echo '<script>alert("Nenhuma conta foi encontrada com estas credenciais")</script>';
        }
      } else {
        echo "Opa! Algo deu errado, tente novamente mais tarde.";
      }

      mysqli_stmt_close($stmt);
    }
  }

}