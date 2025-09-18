<?php
include '../configBD.php';
if (empty($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT mv.*, m.nome FROM mangas_has_vendas mv JOIN mangas m ON mv.id_mangas = m.id_manga WHERE mv.id_vendas = ?');
$stmt->execute([$id]);
$itens = $stmt->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Itens Venda</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<main class="container"><h2>Itens da Venda #<?php echo $id ?></h2>
<table class="table"><thead><tr><th>Produto</th><th>Qtd</th><th>Preço</th></tr></thead><tbody>
<?php foreach($itens as $it): ?>
  <tr><td><?php echo htmlspecialchars($it['nome']) ?></td><td><?php echo $it['quantidade'] ?></td><td>R$ <?php echo number_format($it['preco'],2,',','.') ?></td></tr>
<?php endforeach; ?>
</tbody></table></main></body></html>
