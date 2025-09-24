<?php
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";
$id = $_GET["id"];
$objDAO = new categoriaDAO();
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
        <input type="hidden" name="id_categoria" value="<?= $retorno["id_categoria"] ?>" />
        nome:
        <input type="text" name="nome" value="<?= $retorno["nome"] ?>" />
        <br>
        <button type="submit">enviar</button>
        <br>
</body>

</html>