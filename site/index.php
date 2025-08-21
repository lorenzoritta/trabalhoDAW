<?php
session_start();

if (isset($_GET["carrinho"])) {
    if (!isset($_SESSION["carrinho"])) {
        $_SESSION["carrinho"] = [];
    }
    if (!in_array($_GET["id"], $_SESSION["carrinho"])) {
        $_SESSION["carrinho"][] = $_GET["id"];
        echo "<h2>Adicionado ao carrinho</h2>";
    } else {
        echo "<h2>Produto já foi adicionado antes</h2>";
    }
}

include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";
include_once "../class/imagem.class.php";
include_once "../class/imagemDAO.class.php";

// Listar categorias
$objcategoriaDAO = new categoriaDAO();
$categoria = $objcategoriaDAO->listar();
?>
<ul>
    <?php foreach ($categoria as $linha) { ?>
        <li><a href="listar.php?id=<?= $linha["id_categoria"] ?>"><?= $linha["nome"] ?></a></li>
    <?php } ?>
    <li><a href="carrinho.php"><button>Carrinho de Compras</button></a></li>
</ul>

<!-- Formulário de busca -->
<form method="get" action="">
    <input type="text" name="busca" placeholder="Buscar produto..." value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
    <button type="submit">Buscar</button>
</form>

<?php
// Buscar produtos
$objProdutosDAO = new ProdutoDAO();
$where = "";

if (!empty($_GET['busca'])) {
    $busca = $_GET['busca'];
    $where = "WHERE mangas.nome LIKE '%$busca%' OR mangas.descricao LIKE '%$busca%'";
}

$retorno = $objProdutosDAO->listar("$where ORDER BY id_manga DESC LIMIT 3");
$objImagemDAO = new imagemDAO();

foreach ($retorno as $linha) {
    ?>
    <div>
        <h3><?= $linha["nome"] ?></h3>
        <h4><?= $linha["preco"] ?></h4>
        <h5><?= $linha["categoria"] ?></h5>
        <?php
        $retornoImg = $objImagemDAO->retornarUm($linha["id_manga"]);
        if ($retornoImg > 0)
            echo "<img src='../img/" . $retornoImg["nome"] . "'/>";
        ?>
        <a href="?id=<?= $linha['id_manga']; ?>&carrinho">
            <button>Adicionar ao Carrinho</button>
        </a>
    </div>
<?php } ?>
