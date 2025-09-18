<?php
include 'configBD.php';
// catálogo público - listagem de mangas com imagens
$stmt = $pdo->query('SELECT m.*, c.nome AS categoria FROM mangas m LEFT JOIN categoria c ON m.id_categoria = c.id_categoria');
$mangas = $stmt->fetchAll();
?>
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
<main class="container">
  <h2>Catálogo de Mangás</h2>
  <div class="grid">
    <?php foreach($mangas as $m): 
      $img = $pdo->prepare('SELECT * FROM imagem WHERE id_manga=?'); $img->execute([$m['id_manga']]);
      $imgRow = $img->fetch();
      $src = $imgRow ? 'assets/uploads/'.$imgRow['nome'] : 'assets/placeholder.png';
    ?>
      <article class="card">
        <img src="<?php echo $src ?>" alt="">
        <h3><?php echo htmlspecialchars($m['nome']) ?></h3>
        <p class="meta"><?php echo htmlspecialchars($m['categoria']) ?> • <?php echo htmlspecialchars($m['autor']) ?></p>
        <p class="price">R$ <?php echo number_format($m['preco'],2,',','.') ?></p>
        <p><?php echo nl2br(htmlspecialchars($m['descricao'])) ?></p>
        <form method="post" action="add_to_cart.php">
          <input type="hidden" name="id_manga" value="<?php echo $m['id_manga'] ?>">
          <label>Qtd: <input type="number" name="q" value="1" min="1" style="width:60px"></label>
          <button type="submit" class="btn">Adicionar ao carrinho</button>
        </form>
      </article>
    <?php endforeach; ?>
  </div>
</main>
<footer class="brand">Mangamania &copy; <?php echo date('Y') ?></footer>
</body>
</html>
