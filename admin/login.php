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
<html>
<head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<!-- 🔹 MESMO MENU DO CARRINHO -->
<header class="brand">
    <a href="../index.php">Voltar ao catálogo</a> | <a href="../login.php">Area usuario</a>
</header>

<main class="container">
    <h2>Login Administrador</h2>

    <?php if (!empty($err)) : ?>
        <p class="error"><?php echo htmlspecialchars($err); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Usuário:
            <input name="user" required>
        </label>
        <br><br>

        <label>Senha:
            <input name="pass" type="password" required>
        </label>
        <br><br>

        <button class="btn">Entrar</button>
    </form>
</main>
</body>
</html>
