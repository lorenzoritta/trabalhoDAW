<?php
include 'configBD.php';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']=='checkout') {
    // checkout rápido: cria venda e itens
    if (empty($_SESSION['cart'])) { $msg='Carrinho vazio'; }
    else {
        // usamos cliente 1 por padrão (pode ser adaptado)
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('INSERT INTO vendas (id_cliente,status_venda,forma_pagamento,data_venda,entrega) VALUES (?,?,?,?,?)');
            $stmt->execute([1,'Processando','PIX',date('Y-m-d'),'Endereço de teste']);
            $id_venda = $pdo->lastInsertId();
            $stmt2 = $pdo->prepare('INSERT INTO mangas_has_vendas (id_mangas,id_vendas,preco,quantidade) VALUES (?,?,?,?)');
            foreach($_SESSION['cart'] as $item) {
                $stmt2->execute([$item['id'],$id_venda,$item['preco'],$item['q']]);
            }
            $pdo->commit();
            $_SESSION['cart'] = [];
            $msg = 'Compra finalizada. ID da venda: '.$id_venda;
        } catch (Exception $e) {
            $pdo->rollBack();
            $msg = 'Erro no checkout: '.$e->getMessage();
        }
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Carrinho - Mangamania</title><link rel="stylesheet" href="assets/style.css"></head><body>
<header class="brand"><a href="index.php">Voltar ao catálogo</a></header>
<main class="container">
  <h2>Seu Carrinho</h2>
  <?php if(!empty($msg)): ?><p class="info"><?php echo htmlspecialchars($msg) ?></p><?php endif; ?>
  <?php if(empty($_SESSION['cart'])): ?>
    <p>Seu carrinho está vazio.</p>
  <?php else: ?>
    <table class="table">
      <thead><tr><th>Produto</th><th>Qtd</th><th>Preço</th><th>Subtotal</th></tr></thead>
      <tbody>
      <?php $total=0; foreach($_SESSION['cart'] as $c): $subtotal = $c['q']*$c['preco']; $total += $subtotal; ?>
        <tr>
          <td><?php echo htmlspecialchars($c['nome']) ?></td>
          <td><?php echo $c['q'] ?></td>
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
