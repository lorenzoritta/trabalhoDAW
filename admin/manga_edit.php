<?php
include '../configBD.php';
if (empty($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM mangas WHERE id_manga = ?'); $stmt->execute([$id]); $m = $stmt->fetch();
$cats = $pdo->query('SELECT * FROM categoria')->fetchAll();
$img = $pdo->prepare('SELECT * FROM imagem WHERE id_manga=?'); $img->execute([$id]); $imgRow=$img->fetch();
if (!$m) { echo 'Registro não encontrado'; exit; }
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $stmt = $pdo->prepare('UPDATE mangas SET nome=?,preco=?,descricao=?,autor=?,id_categoria=? WHERE id_manga=?');
    $stmt->execute([$_POST['nome'],$_POST['preco'],$_POST['descricao'],$_POST['autor'],$_POST['id_categoria'],$id]);
    // upload nova imagem
    if (!empty($_FILES['imagem']['name'])) {
        $dir = __DIR__.'/../assets/uploads/';
        if (!is_dir($dir)) mkdir($dir,0777,true);
        $fname = $id.'-'.time().'-'.basename($_FILES['imagem']['name']);
        $target = $dir.$fname;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'],$target)) {
            $pdo->prepare('DELETE FROM imagem WHERE id_manga=?')->execute([$id]);
            $stmt2 = $pdo->prepare('INSERT INTO imagem (nome,id_manga) VALUES (?,?)');
            $stmt2->execute([$fname,$id]);
        }
    } elseif (!$imgRow) {
        // se ainda não tem imagem e não mandou nenhuma → usar placeholder
        $stmt2 = $pdo->prepare('INSERT INTO imagem (nome,id_manga) VALUES (?,?)');
        $stmt2->execute(['placeholder.png',$id]);
    }
    header('Location: index.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Editar Mangá</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<main class="container"><h2>Editar Mangá</h2>
<form method="post" enctype="multipart/form-data">
  <label>Nome<br><input name="nome" value="<?php echo htmlspecialchars($m['nome']) ?>" required></label><br>
  <label>Preço<br><input name="preco" value="<?php echo htmlspecialchars($m['preco']) ?>" required></label><br>
  <label>Autor<br><input name="autor" value="<?php echo htmlspecialchars($m['autor']) ?>"></label><br>
  <label>Categoria<br><select name="id_categoria">
    <?php foreach($cats as $c): $sel = $c['id_categoria']==$m['id_categoria']?'selected':''; ?><option <?php echo $sel ?> value="<?php echo $c['id_categoria'] ?>"><?php echo htmlspecialchars($c['nome']) ?></option><?php endforeach; ?>
  </select></label><br>
  <label>Descrição<br><textarea name="descricao"><?php echo htmlspecialchars($m['descricao']) ?></textarea></label><br>
  <label>Imagem<br><input type="file" name="imagem" accept="image/*"></label><br>
  <?php if($imgRow): ?><p>Imagem atual: <img src="../assets/uploads/<?php echo htmlspecialchars($imgRow['nome']) ?>" style="max-height:100px"></p><?php endif; ?>
  <button class="btn">Salvar</button>
</form></main></body></html>
