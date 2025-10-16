<?php
include '../configBD.php';
if (empty($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }
$cats = $pdo->query('SELECT * FROM categoria')->fetchAll();
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $descricao = $_POST['descricao'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $id_categoria = $_POST['id_categoria'] ?? null;
    $stmt = $pdo->prepare('INSERT INTO mangas (nome,preco,descricao,autor,id_categoria) VALUES (?,?,?,?,?)');
    $stmt->execute([$nome,$preco,$descricao,$autor,$id_categoria]);
    $id_manga = $pdo->lastInsertId();
    // upload da imagem
    if (!empty($_FILES['imagem']['name'])) {
        $dir = __DIR__.'/../assets/uploads/';
        if (!is_dir($dir)) mkdir($dir,0777,true);
        $fname = $id_manga.'-'.time().'-'.basename($_FILES['imagem']['name']);
        $target = $dir.$fname;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'],$target)) {
            $stmt2 = $pdo->prepare('INSERT INTO imagem (nome,id_manga) VALUES (?,?)');
            $stmt2->execute([$fname,$id_manga]);
        }
    } else {
        // se não enviou imagem, salva placeholder
        $stmt2 = $pdo->prepare('INSERT INTO imagem (nome,id_manga) VALUES (?,?)');
        $stmt2->execute(['placeholder.png',$id_manga]);
    }
    header('Location: index.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Novo Mangá</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<main class="container"><h2>Adicionar Mangá</h2>
<form method="post" enctype="multipart/form-data">
  <label>Nome<br><input name="nome" required></label><br>
  <label>Preço<br><input name="preco" required></label><br>
  <label>Autor<br><input name="autor"></label><br>
  <label>Categoria<br><select name="id_categoria">
    <?php foreach($cats as $c): ?><option value="<?php echo $c['id_categoria'] ?>"><?php echo htmlspecialchars($c['nome']) ?></option><?php endforeach; ?>
  </select></label><br>
  <label>Descrição<br><textarea name="descricao"></textarea></label><br>
  <label>Imagem<br><input type="file" name="imagem" accept="image/*"></label><br>
  <button class="btn">Salvar</button>
</form></main></body></html>
