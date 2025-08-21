<?php
session_start();
include_once "../class/vendas.class.php";
include_once "../class/vendasDAO.class.php";
include_once "../class/produtoDAO.class.php";
include_once "../class/mangas_has_vendas.class.php";
include_once "../class/mangas_has_vendasDAO.class.php";

// Criar objeto venda
$objVendas = new Vendas();
$objVendas->setId_cliente($_SESSION["id"]);
$objVendas->setData_venda(date("Y-m-d H:i:s"));
$objVendas->setForma_pagamento($_POST["pagamento"]);
$objVendas->setEntrega($_POST["endereco"]);
$objVendas->setStatus_venda("processando");

$objDAO = new VendasDAO();
$idVendas = $objDAO->inserir($objVendas);

if ($idVendas > 0) {
    echo "<h2>Compra realizada com sucesso!</h2>";

    // Exibir dados da compra
    echo "<h3>Dados da Compra</h3>";
    echo "<p><strong>Cliente:</strong> ID {$_SESSION['id']}</p>";
    echo "<p><strong>Status da Venda:</strong> {$objVendas->getStatus_venda()}</p>";
    echo "<p><strong>Data e Hora da Venda:</strong> {$objVendas->getData_venda()}</p>";
    echo "<p><strong>Endereço de Entrega:</strong> {$objVendas->getEntrega()}</p>";
    echo "<p><strong>Forma de Pagamento:</strong> {$objVendas->getForma_pagamento()}</p>";

    $objVP = new mangas_has_vendas();
    $objProdutosDAO = new ProdutoDAO();
    $objVPDAO = new mangas_has_vendasDAO();

    $total = 0;

    echo "<h3>Resumo dos Produtos</h3>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th></tr>";

    foreach ($_SESSION["carrinho"] as $id_manga) {
        // Verifica se o produto existe
        $produto = $objProdutosDAO->retornarUm($id_manga);

        if (!$produto || !isset($produto["id_manga"])) {
            echo "<tr><td colspan='4'>Produto com ID $id_manga não encontrado. Ignorado.</td></tr>";
            continue; // pula para o próximo produto
        }

        $objVP->setId_vendas($idVendas);
        $objVP->setId_mangas($id_manga);

        // Verifica se quantidade foi enviada via POST
        $quantidade = isset($_POST["quantidade$id_manga"]) && is_numeric($_POST["quantidade$id_manga"])
            ? intval($_POST["quantidade$id_manga"])
            : 1;

        // Verifica se o preço é válido
        $preco = isset($produto["preco"]) && is_numeric($produto["preco"])
            ? floatval($produto["preco"])
            : 0;

        $subtotal = $preco * $quantidade;

        // Preenche objeto e insere na tabela de ligação
        $objVP->setPreco($preco);
        $objVP->setQuantidade($quantidade);
        $objVPDAO->inserir($objVP);

        echo "<tr>";
        echo "<td>{$produto['nome']}</td>";
        echo "<td>R$ " . number_format($preco, 2, ',', '.') . "</td>";
        echo "<td>{$quantidade}</td>";
        echo "<td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>";
        echo "</tr>";

        $total += $subtotal;
    }

    echo "<tr><td colspan='3'><strong>Total</strong></td><td><strong>R$ " . number_format($total, 2, ',', '.') . "</strong></td></tr>";
    echo "</table>";

    // Limpar carrinho após a compra
    unset($_SESSION["carrinho"]);

    echo "<br><a href='index.php'><button>Voltar à loja</button></a>";
} else {
    echo "<h2>Erro ao realizar a compra. Tente novamente.</h2>";
}
?>
