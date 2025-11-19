<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:../site/login.php");
include_once "../class/cliente.class.php";
include_once "../class/clienteDAO.class.php";

$objclienteDAO = new clienteDAO();
$retorno = $objclienteDAO->listar();

/*
echo "<pre>";
print_r($retorno);
*/
if (isset($_POST["editarOK"]))
    echo "<h2>Editado com sucesso!</h2>";
if (isset($_POST["editarErro"]))
    echo "<h2>Erro ao editar!</h2>";

echo "<a href= 'inserir.php'>Inserir</a><br />";
foreach ($retorno as $linha) {
    echo "nome: " . $linha["nome"];
    echo "<br/ >email:" . $linha["email"];
    echo "<br/ >senha:" . $linha["senha"];
    echo "<br/>
    <a href='editar.php?id=" . $linha["id_cliente"] . "'>
    editar</a>
    <a href='excluir.php?id=" . $linha["id_cliente"] . "'>
    excluir</a>

    <br  /><br  />";
}


?>
