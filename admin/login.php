<?php
include '../configBD.php';
// credenciais simples (pode ser alterado)
$ADMIN_USER = 'admin';
$ADMIN_PASS = 'admin123';
if (isset($_POST['user'])) {
    if ($_POST['user']===$ADMIN_USER && $_POST['pass']===$ADMIN_PASS) {
        $_SESSION['admin_logged'] = true;
        header('Location: index.php'); exit;
    } else {
        $err='Credenciais incorretas';
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Login Admin</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<main class="container">
  <h2>Login Administrador</h2>
  <?php if(!empty($err)) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
  <form method="post">
    <label>Usuário: <input name="user"></label><br><label>Senha: <input name="pass" type="password"></label><br>
    <button class="btn">Entrar</button>
  </form>
</main>
</body></html>
