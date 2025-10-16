<?php
// echo "<pre>";
// print_r($_POST);
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";

$obj = new Produto();
$obj->setId_manga($_POST["id_manga"]);
$obj->setOfertar($_POST["ofertar"]);


$objDAO = new ProdutoDAO();

$retorno = $objDAO->ofertar($obj);

if ($retorno)
    header("Location: listar.php?ofertaEditada=ok");
else
    header("Location: listar.php?erroOferta=1");
?>