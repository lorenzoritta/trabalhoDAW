<?php
include '../configBD.php';
if (empty($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }
// listagem de mangas
$stmt = $pdo->query('SELECT m.*, c.nome AS categoria FROM mangas m LEFT JOIN categoria c ON m.id_categoria = c.id_categoria');
$mangas = $stmt->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin - Mangas</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<header class="brand"><h1>Admin - Mangamania</h1><nav><a href="manga_add.php">Novo mangá</a> | <a href="vendas.php">Vendas</a> | <a href="../index.php">Ver site</a></nav></header>
<main class="container">
  <h2>Gerenciar Mangás</h2>
  <table class="table"><thead><tr><th>ID</th><th>Nome</th><th>Preço</th><th>Categoria</th><th>Ações</th></tr></thead><tbody>
  <?php foreach($mangas as $m): ?>
    <tr>
      <td><?php echo $m['id_manga'] ?></td>
      <td><?php echo htmlspecialchars($m['nome']) ?></td>
      <td>R$ <?php echo number_format($m['preco'],2,',','.') ?></td>
      <td><?php echo htmlspecialchars($m['categoria']) ?></td>
      <td>
        <a href="manga_edit.php?id=<?php echo $m['id_manga'] ?>">Editar</a> |
        <a href="manga_delete.php?id=<?php echo $m['id_manga'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody></table>
</main></body></html>
