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

<?php
session_start();
include_once "../class/produtoDAO.class.php";
include_once "../class/vendas.class.php"; // classe para vendas
include_once "../class/vendasDAO.class.php";

if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    echo "Carrinho vazio!";
    exit;
}

$total = 0;
$objProdutoDAO = new ProdutoDAO();
foreach ($_SESSION['carrinho'] as $idProduto) {
    $produto = $objProdutoDAO->listar("WHERE id_manga = $idProduto")[0];
    $total += $produto['preco'];
}

// Inserir venda
$objVendasDAO = new VendasDAO();
$idVenda = $objVendasDAO->inserir($_SESSION['id_cliente'], $total, 'Pendente', 'Não definido'); // status e entrega iniciais

// Inserir itens da venda (assumindo que você tenha uma tabela itens_venda)
foreach ($_SESSION['carrinho'] as $idProduto) {
    $produto = $objProdutoDAO->listar("WHERE id_manga = $idProduto")[0];
    $objVendasDAO->inserirItem($idVenda, $idProduto, 1, $produto['preco']);
}

// Limpar carrinho
unset($_SESSION['carrinho']);
echo "Compra finalizada com sucesso!";
?>
