<?php
include_once "../configBD.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = htmlspecialchars($_POST["token"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql = "UPDATE cliente SET senha=?, token_recuperacao=NULL, expira_token=NULL WHERE token_recuperacao=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$senha, $token]);

    echo "✅ Senha alterada com sucesso! <a href='login.php'>Fazer login</a>";
}
?>
