<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mangamania - Catálogo</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="brand">
  <img src="assets/logo.png" alt="logo" class="logo">
  <h1>Mangamania</h1>
  <nav>
    <a href="cart.php">Carrinho (<?php echo isset($_SESSION['cart'])? array_sum(array_column($_SESSION['cart'],'q')):0 ?>)</a>
    <a href="admin/login.php">Área do Administrador</a>
  </nav>
</header>

<?php
include 'configBD.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'checkout') {
    // checkout rápido: cria venda e itens
    if (empty($_SESSION['cart'])) {
        $msg = 'Carrinho vazio';
    } else {
        $pdo->beginTransaction();
        try {
            // usamos cliente 1 por padrão (pode ser adaptado)
            $stmt = $pdo->prepare('INSERT INTO vendas (id_cliente,status_venda,forma_pagamento,data_venda,entrega) VALUES (?,?,?,?,?)');
            $stmt->execute([1, 'Processando', 'PIX', date('Y-m-d H:i:s'), 'Endereço de teste']);
            $id_venda = $pdo->lastInsertId();

            $stmt2 = $pdo->prepare('INSERT INTO mangas_has_vendas (id_mangas,id_vendas,preco,quantidade) VALUES (?,?,?,?)');
            foreach ($_SESSION['cart'] as $item) {
                $stmt2->execute([$item['id'], $id_venda, $item['preco'], $item['q']]);
            }

            $pdo->commit();

            // Guardar produtos para exibir o resumo
            $produtosCompra = $_SESSION['cart'];

            // Limpar carrinho
            $_SESSION['cart'] = [];

            // --- MOSTRAR NOTA FISCAL ---
            echo "<!doctype html><html><head><meta charset='utf-8'><title>Nota Fiscal</title>
            <link rel='stylesheet' href='assets/style.css'>
            <style>
                body {font-family: Arial, sans-serif; background: #fafafa; color: #333;}
                .nota {max-width: 800px; margin: 40px auto; background: #fff; border: 2px solid #ccc; border-radius: 10px; padding: 25px;}
                table {width: 100%; border-collapse: collapse; margin-top: 15px;}
                th, td {padding: 8px; border: 1px solid #ccc; text-align: center;}
                th {background: #eee;}
                .total {background: #f3f3f3; font-weight: bold;}
                .btn-voltar {display:inline-block;margin-top:20px;padding:10px 15px;background:#007bff;color:#fff;border-radius:5px;text-decoration:none;}
                .btn-voltar:hover {background:#0056b3;}
            </style></head><body>";

            echo "<div class='nota'>";
            echo "<h2 style='text-align:center;'>🧾 Nota Fiscal / Resumo da Compra</h2>";
            echo "<p><strong>ID da Venda:</strong> $id_venda</p>";
            echo "<p><strong>Data:</strong> " . date('d/m/Y H:i') . "</p>";
            echo "<hr>";

            echo "<table><tr><th>Produto</th><th>Quantidade</th><th>Preço Unitário</th><th>Total</th></tr>";
            $totalGeral = 0;
            foreach ($produtosCompra as $p) {
                $subtotal = $p['preco'] * $p['q'];
                $totalGeral += $subtotal;
                echo "<tr>
                        <td>" . htmlspecialchars($p['nome']) . "</td>
                        <td>{$p['q']}</td>
                        <td>R$ " . number_format($p['preco'], 2, ',', '.') . "</td>
                        <td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
                      </tr>";
            }
            echo "<tr class='total'><td colspan='3'>Total Geral</td><td>R$ " . number_format($totalGeral, 2, ',', '.') . "</td></tr>";
            echo "</table>";

            echo "<hr><p style='text-align:center;'>Obrigado por comprar conosco! 💙</p>";
            echo "<div style='text-align:center;'><a href='index.php' class='btn-voltar'>Voltar ao Catálogo</a></div>";
            echo "</div></body></html>";

            exit; // impede de mostrar o resto do HTML abaixo

        } catch (Exception $e) {
            $pdo->rollBack();
            $msg = 'Erro no checkout: ' . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Carrinho - Mangamania</title><link rel="stylesheet" href="assets/style.css"></head><body>
<main class="container">
  <h2>Seu Carrinho</h2>
  <?php if(!empty($msg)): ?><p class="info"><?php echo htmlspecialchars($msg) ?></p><?php endif; ?>
  <?php if(empty($_SESSION['cart'])): ?>
    <p>Seu carrinho está vazio.</p>
  <?php else: ?>
    <table class="table">
      <thead><tr><th>Produto</th><th>Qtd</th><th>forma_pagamento</th><th>Preço</th><th>Subtotal</th></tr></thead>
      <tbody>
      <?php $total=0; foreach($_SESSION['cart'] as $c): $subtotal = $c['q']*$c['preco']; $total += $subtotal; ?>
        <tr>
          <td><?php echo htmlspecialchars($c['nome']) ?></td>
          <td><?php echo $c['q'] ?></td>
                 <td>
                  <strong>
            <select name="pagamento">
              <option value="1" selected>PIX</option>
              <option value="2">Cartão</option>
            </select>
          </td>
          <td>R$ <?php echo number_format($c['preco'],2,',','.') ?></td>
          <td>R$ <?php echo number_format($subtotal,2,',','.') ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot><tr><th colspan="3">Total</th><th>R$ <?php echo number_format($total,2,',','.') ?></th></tr></tfoot>
    </table>
    <form method="post"><input type="hidden" name="action" value="checkout"><button class="btn">Finalizar Compra (checkout)</button></form>
  <?php endif; ?>
</main>
</body></html>
