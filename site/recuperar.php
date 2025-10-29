<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="../assets/site.css">
</head>
<body>
  <h2>Recuperar Senha</h2>

  <form action="processa_recuperacao.php" method="post">
    <label for="email">Digite seu e-mail cadastrado:</label><br>
    <input type="email" name="email" id="email" required><br><br>

    <!-- CAPTCHA simples -->
    <?php
      $n1 = rand(1, 9);
      $n2 = rand(1, 9);
      $_SESSION['captcha'] = $n1 + $n2;
    ?>
    <label>Resolva: <?php echo $n1 . " + " . $n2 . " = ?"; ?></label><br>
    <input type="number" name="captcha" required><br><br>

    <button type="submit">Enviar link de recuperação</button>
  </form>

  <p><a href="login.php">Voltar ao login</a></p>
</body>
</html>
