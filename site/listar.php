<?php
session_start();

include_once "../class/categoriaDAO.class.php";
include_once "../class/produtoDAO.class.php";
include_once "../class/imagemDAO.class.php";

// Verifica categoria selecionada
$idCategoria = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Classes
$objcategoriaDAO = new categoriaDAO();
$objProdutosDAO = new ProdutoDAO();
$objImagemDAO = new imagemDAO();

// Lista categorias (menu lateral)
$categorias = $objcategoriaDAO->listar();

// Obtém nome da categoria atual
$nomeCategoria = "Categoria";
foreach ($categorias as $c) {
    if ($c["id_categoria"] == $idCategoria) {
        $nomeCategoria = $c["nome"];
    }
}

// Busca produtos apenas dessa categoria
$retorno = $objProdutosDAO->listar("WHERE mangas.id_categoria = '$idCategoria' ORDER BY id_manga DESC");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mangamania - <?= htmlspecialchars($nomeCategoria) ?></title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<header class="brand">
    <img src="../assets/logo.png" class="logo" alt="logo">
    <h1>Mangamania</h1>

    <nav>
        <a href="../cart.php">Carrinho (<?= isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0 ?>)</a>
        <a href="../admin/login.php">Área do Administrador</a>
        <a href="index.php">Voltar ao Catálogo</a>
    </nav>
</header>

<main class="container">

    <section class="side-menu">
        <h3>Categorias</h3>
        <ul>
            <?php foreach ($categorias as $linha): ?>
                <li><a href="listar.php?id=<?= $linha['id_categoria'] ?>">
                    <?= htmlspecialchars($linha['nome']) ?>
                </a></li>
            <?php endforeach; ?>
        </ul>

        <h3>Buscar</h3>
        <form method="get" action="../site/index.php">
            <input type="text" name="busca" placeholder="Buscar mangá...">
            <button class="btn">Buscar</button>
        </form>
    </section>

    <section class="catalog">
        <h2><?= htmlspecialchars($nomeCategoria) ?></h2>

        <div class="grid">
            <?php foreach ($retorno as $linha): ?>

                <?php
                // Pega imagem
                $img = $objImagemDAO->retornarUm($linha["id_manga"]);
                $src = $img ? "../img/" . $img["nome"] : "../assets/placeholder.png";
                ?>

                <article class="card">

                    <img src="<?= $src ?>" alt="Capa do mangá">

                    <h3><?= htmlspecialchars($linha["nome"]) ?></h3>
                    <p class="meta"><?= htmlspecialchars($linha["categoria"]) ?></p>
                    <p class="price">R$ <?= number_format($linha["preco"], 2, ',', '.') ?></p>

                    <a href="index.php?id=<?= $linha['id_manga'] ?>&carrinho">
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
