<?php
include_once "../configBD.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = htmlspecialchars($_POST["token"]);
    $senha = hash('md4',$_POST["senha"].$_POST["salt"]);

    $sql = "UPDATE cliente SET senha=?, token_recuperacao=NULL, expira_token=NULL WHERE token_recuperacao=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$senha, $token]);

    echo "✅ Senha alterada com sucesso! <a href='login.php'>Fazer login</a>";
}
?>
