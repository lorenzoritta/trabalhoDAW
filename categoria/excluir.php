<?php
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";
$id = $_GET["id"];
$objDAO = new categoriaDAO();
$retorno = $objDAO->excluir($id);
?>