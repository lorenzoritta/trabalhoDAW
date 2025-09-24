<?php
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";
$id = $_GET["id"];
$objDAO = new produtoDAO();
$retorno = $objDAO->excluir($id);
?>