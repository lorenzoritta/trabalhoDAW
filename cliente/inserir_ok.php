<?php
//echo"<pre>";
//print_r($_POST);
include_once "../class/cliente.class.php";
include_once "../class/clienteDAO.class.php";

$obj = new cliente();
$obj->setNome($_POST["nome"]);
$obj->setEmail($_POST["email"]);
$obj->setsenha($_POST["senha"]);
$obj->setendereco($_POST["endereco"]);
$obj->setUsuario($_POST["usuario"]);
$objDAO = new clienteDAO();
$retorno = $objDAO->inserir($obj);
if ($retorno)
    echo "adicionado com succeso";
else
    echo "erro! por favor,consulte um adm";
?>