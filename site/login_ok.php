<?php
//echo"<pre>";
//print_r($_POST);
include_once "../class/cliente.class.php";
include_once "../class/clienteDAO.class.php";

$obj = new cliente();
$obj->setEmail($_POST["email"]);
$obj->setsenha($_POST["senha"]);
$objDAO = new clienteDAO();
$retorno = $objDAO->login($obj);
if ($retorno == 2)
    echo "email n cadastrado";
else if ($retorno == 1)
    echo "senha incorreta";
else {
    session_start();
    $_SESSION["id"] = $retorno["id_cliente"];
    $_SESSION["login"] = true;
    header("location:index.php?loginOK");
}
?>