<?php
$captcha_user = $_POST["captcha"] ?? null;

if ($captcha_user === null) {
    echo "❌ Acesso inválido. Use o formulário de recuperação.";
    exit;
}
session_start();
include_once "../configBD.php"; // caminho corrigido

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $captcha_user = $_POST["captcha"] ?? 0;

    // Verifica captcha
    if ($captcha_user != $_SESSION['captcha']) {
        echo "❌ Captcha incorreto! <a href='recuperar.php'>Tente novamente</a>";
        exit;
    }

    // Verifica se o e-mail existe
    $sql = "SELECT * FROM cliente WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // Gera token e data de expiração
        $token = bin2hex(random_bytes(50));
        $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Salva no banco
        $sql = "UPDATE cliente SET token_recuperacao=?, expira_token=? WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token, $expira, $email]);

        $link = "http://localhost/LorenzoDAW/site/nova_senha.php?token=" . $token;

        // Envio do email — simples (ideal usar PHPMailer)
        echo "<p>Simulação: e-mail seria enviado para <strong>$email</strong></p>";
        echo "<p>Link de recuperação: <a href='$link'>$link</a></p>";

        echo "✅ Um link de recuperação foi enviado para seu e-mail.";
    } else {
        echo "❌ E-mail não encontrado.";
    }
}
?>
