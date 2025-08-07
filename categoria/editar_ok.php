<?php
//echo"<pre>";
//print_r($_POST);
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";

$obj = new categoria();
$obj->setId_categoria($_POST["categoria"]);
$obj->setNome($_POST["nome"]);
$objDAO = new categoriaDAO();
$retorno = $objDAO->editar($obj);
if ($retorno)
    header("location:listar.php?editarOK");
else
    header("location:listar.php?editarErro");
?>      