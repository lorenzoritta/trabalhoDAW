<?php
session_start();

include_once "../class/vendasDAO.class.php";
include_once "../class/mangas_has_vendasDAO.class.php";
include_once "../class/produtoDAO.class.php";

// Instanciar DAOs
$objVendasDAO = new VendasDAO();
$objItensDAO = new mangas_has_vendasDAO();
$objProdutoDAO = new ProdutoDAO();

// Buscar todas as vendas
$vendas = $objVendasDAO->listar();

echo "<h1>Painel de Administração - Vendas</h1>";

if (empty($vendas)) {
    echo "<p>Nenhuma venda cadastrada.</p>";
    exit;
}

foreach ($vendas as $venda) {
    echo "<hr>";
    echo "<h3>Venda ID: {$venda['id_vendas']}</h3>";
    echo "<p><strong>Cliente:</strong> {$venda['id_cliente']}</p>";
    echo "<p><strong>Status:</strong> {$venda['status_venda']}</p>";
    echo "<p><strong>Data e Hora:</strong> {$venda['data_venda']}</p>";
    echo "<p><strong>Forma de Pagamento:</strong> {$venda['forma_pagamento']}</p>";
    echo "<p><strong>Endereço de Entrega:</strong> {$venda['entrega']}</p>";

    // Listar itens da venda
    $itens = $objItensDAO->listarPorVenda($venda['id_vendas']);

    if (!empty($itens)) {
        $total = 0;
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th></tr>";

        foreach ($itens as $item) {
            $produto = $objProdutoDAO->retornarUm($item['id_mangas']);
            $preco = $item['preco'];
            $quantidade = $item['quantidade'];
            $subtotal = $preco * $quantidade;
            $total += $subtotal;

            echo "<tr>";
            echo "<td>{$produto['nome']}</td>";
            echo "<td>R$ " . number_format($preco, 2, ',', '.') . "</td>";
            echo "<td>{$quantidade}</td>";
            echo "<td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='3'><strong>Total</strong></td><td><strong>R$ " . number_format($total, 2, ',', '.') . "</strong></td></tr>";
        echo "</table>";
    } else {
        echo "<p>Nenhum item cadastrado para esta venda.</p>";
    }

    // Formulário para atualizar status da venda
    echo "<form method='post' action='admin_atualizar_status.php'>";
    echo "<input type='hidden' name='id_vendas' value='{$venda['id_vendas']}'>";
    echo "<label for='status_vendas'><strong>Atualizar Status:</strong></label> ";
    echo "<select name='status_venda' id='status_venda'>";

    $statusOptions = ['Pendente', 'Processando', 'Enviada', 'Concluída'];
    foreach ($statusOptions as $status) {
        $selected = ($venda['status_venda'] === $status) ? "selected" : "";
        echo "<option value='{$status}' {$selected}>{$status}</option>";
    }

    echo "</select> ";
    echo "<button type='submit'>Atualizar Status</button>";
    echo "</form>";
}
?>
