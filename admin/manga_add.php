<?php
session_start();
include '../configBD.php';

if (empty($_SESSION['admin_logged'])) {
    header('Location: login.php');
    exit;
}

$cats = $pdo->query('SELECT * FROM categoria')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $descricao = $_POST['descricao'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $id_categoria = $_POST['id_categoria'] ?? null;

    $stmt = $pdo->prepare('INSERT INTO mangas (nome,preco,descricao,autor,id_categoria) VALUES (?,?,?,?,?)');
    $stmt->execute([$nome, $preco, $descricao, $autor, $id_categoria]);
    $id_manga = $pdo->lastInsertId();

    // Upload da imagem
    if (!empty($_FILES['imagem']['name'])) {

        $dir = __DIR__ . '/../assets/uploads/';

        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $fname = $id_manga . '-' . time() . '-' . basename($_FILES['imagem']['name']);
        $target = $dir . $fname;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $target)) {
            $stmt2 = $pdo->prepare('INSERT INTO imagem (nome, id_manga) VALUES (?,?)');
            $stmt2->execute([$fname, $id_manga]);
        }

    } else {
        // Se não enviou imagem, salva placeholder
        $stmt2 = $pdo->prepare('INSERT INTO imagem (nome,id_manga) VALUES (?,?)');
        $stmt2->execute(['placeholder.png', $id_manga]);
    }

    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Novo Mangá - Admin</title>
    <link rel="stylesheet" href="../assets/style.css">

<style>
/* CORREÇÃO DOS CAMPOS QUE FICAVAM TORTOS */
.form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 6px;
    max-width: 400px;
    width: 100%;
}
</style>

</head>

<body>

<header class="brand">
    <img src="../assets/logo.png" alt="logo" class="logo">
    <h1>Admin • Mangamania</h1>
    <nav>
        <a href="index.php">Gerenciar Mangás</a>
        <a href="categorias.php">Categorias</a>
        <a href="../index.php">Voltar ao Site</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>

<main class="container">

    <h2>Adicionar Novo Mangá</h2>

    <form method="post" enctype="multipart/form-data" class="form-card">

        <div class="form-group">
            <label>Nome</label>
            <input name="nome" required>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input name="preco" type="number" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Autor</label>
            <input name="autor">
        </div>

        <div class="form-group">
            <label>Categoria</label>
            <select name="id_categoria">
                <?php foreach ($cats as $c): ?>
                    <option value="<?= $c['id_categoria'] ?>">
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <button class="btn">Salvar</button>

    </form>

</main>

<footer class="brand">
    Mangamania &copy; <?= date('Y') ?>
</footer>

</body>
</html>
