<?php
//echo"<pre>";
//print_r($_POST);
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";

$obj = new categoria();
$obj->setNome($_POST["nome"]);
$objDAO = new categoriaDAO();
$retorno = $objDAO->inserir($obj);
if ($retorno)
    echo "adicionado com succeso";
else
    echo "erro! por favor,consulte um adm";
?>