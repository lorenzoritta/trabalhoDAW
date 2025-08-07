<?php
session_start();
include_once "../class/vendas.class.php";
include_once "../class/vendasDAO.class.php";
include_once "../class/mangasDAO.class.php";
include_once "../class/mangas_has_vendas.class.php";
include_once "../class/mangas_has_vendasDAO.class.php";
$objVendas = new Vendas();
$objVendas->setId_cliente($_SESSION["id"]);
$objVendas->setData_venda(date("y-m-d"));
$objVendas->setForma_pagamento($_POST["pagamento"]);
$objVendas->setEntrega($_POST["endereco"]);
$objVendas->setStatus_venda("processando");
$objDAO = new VendaDAO();
$retorno = $objDAO->inserir($objVendas);
if ($retorno > 0) {
    echo "venda inserida";
    $objVP = new mangas_has_vendas();
    $objProdutosDAO = new ProdutoDAO();
    $objVPDAO = new mangas_has_vendasDAO();

    $objVP->setId_vendas($retorno);
    foreach ($_SESSION["carrinho"] as $linha) {
        $objVP->setId_mangas($linha);
        $objProduto = $objProdutosDAO->retornarUm($linha);
        $objVP->setPreco($objProduto["preco"]);
        $objVP->setQuantidade($_POST["quantidade$linha"]);

        $objVPDAO->inserir($objVP);

    }
} else {
    echo "erro";
}
?>