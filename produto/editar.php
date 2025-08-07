<?php
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";
$id = $_GET["id"];
$objDAO = new ProdutoDAO();
$retorno = $objDAO->retornarUm($id);

include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";
$objcategoria = new categoriaDAO();
$categoria = $objcategoria->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>

<body>
    <form action="editar_produto_ok.php" method="post">
        <input type="hidden" name="id_manga" value="<?= $retorno["id_manga"] ?>" />

        Nome:
        <input type="text" name="nome" value="<?= $retorno["nome"] ?>" />
        <br>
        
        Categoria:
        <select name="idcategoria">
        <?php
            foreach($categoria as $linha){
                if($linha["id"] == $retorno["idcategoria"])
                echo "<option selected value='".$linha["id"]."'>".$linha["nome"]."</option>";
            else
            echo "<option value='".$linha["id"]."'>".$linha["nome"]."</option>";
            
        }
        ?>
        <br>
        Editora:
        <input type="text" name="editora" value="<?= $retorno["editora"] ?>" />
        <br>

        Descrição:
        <input type="text" name="descricao" value="<?= $retorno["descricao"] ?>" />
        <br>

        Autor:
        <input type="text" name="autor" value="<?= $retorno["autor"] ?>" />
        <br>

        Preço:
        <input type="text" name="preco" value="<?= $retorno["preco"] ?>" />
        <br>

        Data de Lançamento:
        <input type="date" name="data_lancamento" value="<?= $retorno["data_lancamento"] ?>" />
        <br>

        País de Origem:
        <input type="text" name="pais_origem" value="<?= $retorno["pais_origem"] ?>" />
        <br>

        Número de Volumes:
        <input type="number" name="num_volumes" value="<?= $retorno["num_volumes"] ?>" />
        <br>

        <button type="submit">Salvar</button>
    </form>
</body>

</html>