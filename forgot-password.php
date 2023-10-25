<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

include('config.php');
if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
   $email = $_POST["email"];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $email = filter_var($email, FILTER_VALIDATE_EMAIL);
   if (!$email) {
      $error .= "<p>Endereço de email inválido!</p>";
   } else {
      $sel_query = "SELECT * FROM usuario WHERE usulogin ='" . $email . "'";
      $results = mysqli_query($conection_db, $sel_query);
      $row = mysqli_num_rows($results);
      if ($row == "") {
         $error .= "<p>Nehum usuário registrado com este email!</p>";
      }
   }
   if (@$error != "") {
      echo "<div class='error'>" . $error . "</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
   } else {
      $expFormat = mktime(
         date("H"),
         date("i"),
         date("s"),
         date("m"),
         date("d") + 1,
         date("Y")
      );
      $expDate = date("Y-m-d H:i:s", $expFormat);
      $key = md5($email);
      $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
      $key = $key . $addKey;

      mysqli_query(
         $conection_db,
         "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');"
      );
      header('Content-type: text/html; charset=utf-8');
      $output = '<p>Caro usuário,</p>';
      $output .= '<p>Clique no link abaixo para resetar a sua senha.</p>';
      $output .= '<p>-------------------------------------------------------------</p>';
      $output .= '<p><a href="https://logicom.com.br/reset_pass.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
      https://logicom.com.br/reset_pass.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
      $output .= '<p>-------------------------------------------------------------</p>';
      $output .= '<p>Copie o link inteiro para o seu navegador, ele irá expirar após 1 dia.</p>';
      $output .= '<p>Se você não fez essa requisição, nenhuma ação deve ser tomada. Porém, recomendamos que troque sua senha pois alguém acessou esta conta</p>';
      $output .= '<p>Atenciosamente,</p>';
      $output .= '<p>Logicom Tecnologia.</p>';
      $body = $output;
      $subject = "Recuperação de senha - Logicom.com.br";

      
      $email_to = $email;
      $fromserver = "recuperacao@logicom.com.br";
      require("vendor/autoload.php");
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->Host = "email-ssl.com.br"; 
      $mail->SMTPAutoTLS;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'ssl';
      $mail->Username = "recuperacao@logicom.com.br"; 
      $mail->Password = "29011967Log*"; 
      $mail->Port = 465;
      $mail->IsHTML(true);
      $mail->From = "recuperacao@logicom.com.br";
      $mail->CharSet = 'UTF-8';
      $mail->FromName = "Recuperação de senha";
      $mail->Sender = $fromserver;
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AddAddress($email_to);
      if (!$mail->Send()) {
         echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
         echo "<div class='error'>
<p>Foi enviado um email com instruções para resetar sua senha.</p>
</div><br /><br /><br />";
      }
   }
} else {
?>
   <form method="post" action="" name="reset"><br /><br />
      <label><strong>Enter Your Email Address:</strong></label><br /><br />
      <input type="email" name="email" placeholder="username@email.com" />
      <br /><br />
      <input type="submit" value="Reset Password" />
   </form>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<?php } ?>