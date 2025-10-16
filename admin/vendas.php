<?php
include '../configBD.php';
if (empty($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }
// listar vendas
$stmt = $pdo->query('SELECT v.*, c.nome as cliente FROM vendas v LEFT JOIN cliente c ON v.id_cliente = c.id_cliente ORDER BY v.data_venda DESC');
$vendas = $stmt->fetchAll();
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['status']) && isset($_POST['id_venda'])) {
    $pdo->prepare('UPDATE vendas SET status_venda = ? WHERE id_vendas = ?')->execute([$_POST['status'],$_POST['id_venda']]);
    header('Location: vendas.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Vendas</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<main class="container"><h2>Vendas</h2>
<table class="table"><thead><tr><th>ID</th><th>Cliente</th><th>Data</th><th>Status</th><th>Ações</th></tr></thead><tbody>
<?php foreach($vendas as $v): ?>
  <tr>
    <td><?php echo $v['id_vendas'] ?></td>
    <td><?php echo htmlspecialchars($v['cliente']) ?></td>
    <td><?php echo $v['data_venda'] ?></td>
    <td><?php echo htmlspecialchars($v['status_venda']) ?></td>
    <td>
      <form method="post" style="display:inline">
        <input type="hidden" name="id_venda" value="<?php echo $v['id_vendas'] ?>">
        <select name="status"><option>Processando</option><option>Enviado</option><option>Entregue</option><option>Cancelado</option></select>
        <button class="btn">Atualizar</button>
      </form>
      <a href="venda_itens.php?id=<?php echo $v['id_vendas'] ?>">Ver Itens</a>
    </td>
  </tr>
<?php endforeach; ?>
</tbody></table></main></body></html>
