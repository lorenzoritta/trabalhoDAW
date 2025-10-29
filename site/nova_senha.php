<?php
include_once "../configBD.php";

if (isset($_GET["token"])) {
    $token = htmlspecialchars($_GET["token"]);

    $sql = "SELECT * FROM cliente WHERE token_recuperacao=? AND expira_token > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);

    if ($stmt->rowCount() > 0) {
        echo '
        <form action="salva_nova_senha.php" method="post">
          <input type="hidden" name="token" value="'.$token.'">
          <label>Nova senha:</label><br>
          <input type="password" name="senha" required><br><br>
          <button type="submit">Salvar nova senha</button>
        </form>';
    } else {
        echo "❌ Token inválido ou expirado.";
    }
}
?>
