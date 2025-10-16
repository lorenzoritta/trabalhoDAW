<?php
include_once "../class/cliente.class.php";
include_once "../class/clienteDAO.class.php";
$id = $_GET["id"];
$objDAO = new clienteDAO();
$retorno = $objDAO->excluir($id);
?>