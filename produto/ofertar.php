<?php
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";

$id = $_GET["id"];
$objDAO = new ProdutoDAO();
$retorno = $objDAO->retornarUm($id);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oferta</title>
</head>

<body>
    <h1>Editar Produto em Oferta</h1>
    
    <form action="ofertar_ok.php" method="post">
        
        <input type="hidden" name="id_manga" value="<?= $retorno["id_manga"] ?>" />

        oferta:
        <input type="number" name="ofertar" value="<?=$retorno["ofertar"] ?>" />
        <br>

        <button type="submit">Salvar Oferta</button>
    </form>
</body>

</html>
