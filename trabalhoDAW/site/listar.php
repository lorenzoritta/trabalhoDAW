<?php

session_start();
if (isset($_GET["carrinho"])) {
    if (!isset($_SESSION["carrinho"])) {
        $_SESSION["carrinho"] = [];
    }
    if (!in_array($_GET["id"], $_SESSION["carrinho"])) {
        array_push($_SESSION["carrinho"], $_GET["id"]);
        echo "<h2>Adicionado ao carrinho</h2>";



    } else {
        echo "<h2>Produto ja foi adicionado antes";
    }
}
print_r($_SESSION["carrinho"]);
//session_destroy();
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";
include_once "../class/imagem.class.php";
include_once "../class/imagemDAO.class.php";

$objcategoriaDAO = new categoriaDAO();
$categoria = $objcategoriaDAO->listar();
?>
<ul>
    <?php
    foreach ($categoria as $linha) {
        echo "<li><a href = 'listar.php?id = " .
            $linha["id_categoria"] . "'>" . $linha["nome"] . "</a></li>";
    }
    ?>
    <li><a href="carrinho.php">
            <button>Carrinho de Compras</button>
        </a>
    </li>

</ul>
<?php
$id = $_GET["id"];
$objProdutosDAO = new ProdutoDAO();
$retorno = $objProdutosDAO->listar("WHERE mangas.id_categoria = $id");
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
