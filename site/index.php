<?php
session_start();

// Carrinho
if (isset($_GET["carrinho"])) {
    if (!isset($_SESSION["carrinho"])) {
        $_SESSION["carrinho"] = [];
    }
    if (!in_array($_GET["id"], $_SESSION["carrinho"])) {
        $_SESSION["carrinho"][] = $_GET["id"];
        $msg = "Adicionado ao carrinho!";
    } else {
        $msg = "Produto já foi adicionado antes.";
    }
}

// Classes (ajustadas para caminho correto)
include_once "../class/categoriaDAO.class.php";
include_once "../class/produtoDAO.class.php";
include_once "../class/imagemDAO.class.php";

// Categorias
$objcategoriaDAO = new categoriaDAO();
$categoria = $objcategoriaDAO->listar();

// Busca
$objProdutosDAO = new ProdutoDAO();
$where = "";

if (!empty($_GET['busca'])) {
    $busca = $_GET['busca'];
    $where = "WHERE mangas.nome LIKE '%$busca%' OR mangas.descricao LIKE '%$busca%'";
}

$retorno = $objProdutosDAO->listar("$where ORDER BY id_manga DESC LIMIT 20");
$objImagemDAO = new imagemDAO();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mangamania - Catálogo</title>

    <!-- Caminho CORRETO do CSS -->
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<header class="brand">
    <img src="../assets/logo.png" class="logo" alt="logo">
    <h1>Mangamania</h1>

    <nav>
        <a href="../cart.php">Carrinho (<?= isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0 ?>)</a>
        <a href="../admin/login.php">Área do Administrador</a>
    </nav>
</header>

<main class="container">

    <?php if (isset($msg)): ?>
        <p class="alert"><?= $msg ?></p>
    <?php endif; ?>

    <section class="side-menu">
        <h3>Categorias</h3>
        <ul>
            <?php foreach ($categoria as $linha): ?>
                <li><a href="listar.php?id=<?= $linha['id_categoria'] ?>">
                    <?= htmlspecialchars($linha['nome']) ?>
                </a></li>
            <?php endforeach; ?>
        </ul>

        <h3>Buscar Mangá</h3>
        <form method="get">
            <input type="text" name="busca" placeholder="Buscar..."
                   value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
            <button class="btn">Buscar</button>
        </form>
    </section>

    <section class="catalog">
        <h2>Catálogo de Mangás</h2>

        <div class="grid">
            <?php foreach ($retorno as $linha): ?>

                <?php 
                    $img = $objImagemDAO->retornarUm($linha["id_manga"]);
                    $src = $img ? "../img/" . $img["nome"] : "../assets/placeholder.png";
                ?>

                <article class="card">
                    <img src="<?= $src ?>" alt="Capa">

                    <h3><?= htmlspecialchars($linha["nome"]) ?></h3>
                    <p class="meta"><?= htmlspecialchars($linha["categoria"]) ?></p>
                    <p class="price">R$ <?= number_format($linha["preco"], 2, ',', '.') ?></p>

                    <a href="?id=<?= $linha['id_manga'] ?>&carrinho">
                        <button class="btn">Adicionar ao Carrinho</button>
                    </a>
                </article>

            <?php endforeach; ?>
        </div>

    </section>

</main>

<footer class="brand">
    Mangamania &copy; <?= date('Y') ?>
</footer>
</body>
</html>
