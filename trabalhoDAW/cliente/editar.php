<?php
include_once "../class/cliente.class.php";
include_once "../class/clienteDAO.class.php";
$id = $_GET["id"];
$objDAO = new clienteDAO();
$retorno = $objDAO->retornarUm($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="editar_ok.php" method="post">
        <input type="hidden" name="id_cliente" value="<?= $retorno["id_cliente"] ?>" />
        nome:
        <input type="text" name="nome" value="<?= $retorno["nome"] ?>" />
        <br>
        email:
        <input type="email" name="email" value="<?= $retorno["email"] ?>" />
        <br>
        senha:
        <input type="password" name="senha" value="<?= $retorno["senha"] ?>" />
        <br>
        endereco:
        <input type="text" name="endereco" value="<?= $retorno["endereco"] ?>" />
        <br>
        usuario:
        <input type="text" name="usuario" value="<?= $retorno["usuario"] ?>" />
        <button type="submit">enviar</button>
        <br>
</body>

</html>