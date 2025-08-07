<?php
//echo"<pre>";
//print_r($_POST);
include_once "../class/cliente.class.php";
include_once "../class/clienteDAO.class.php";

$obj = new cliente();
$obj->setId_cliente($_POST["cliente"]);
$obj->setNome($_POST["nome"]);
$obj->setEmail($_POST["email"]);
$obj->setsenha($_POST["senha"]);
$obj->setendereco($_POST["endereco"]);
$obj->setUsuario($_POST["usuario"]);
$objDAO = new clienteDAO();
$retorno = $objDAO->editar($obj);
if ($retorno)
    header("location:listar.php?editarOK");
else
    header("location:listar.php?editarErro");
?>