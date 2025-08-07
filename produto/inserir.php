<?php
    include_once "../class/categoria.class.php";
    include_once "../class/categoriaDAO.class.php";
    $objcategoria = new categoriaDAO();
    $categoria = $objcategoria->listar();

?>  

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
</head>

<body>
    <form action="inserir_ok.php" method="post" enctype="multipart/form-data">
        Nome do Manga:
        <input type="text" name="nome" required />
        <br>
        Editora:
        <input type="text" name="editora" required />
        <br>
        Descrição:
        <input name="descricao" required></input>
        <br>
        Autor:
        <input type="text" name="autor" required />
        <br>
        Preço:
        <input type="text" name="preco" required />
        <br>
        Data de Lançamento:
        <input type="date" name="data_lancamento" required />
        <br>
        País de Origem:
        <input type="text" name="pais_origem" required />
        <br>
        Número de Volumes:
        <input type="number" name="num_volumes" required />
        <br>
        Categoria:
        <select name="id_categoria">
        <?php
            foreach($categoria as $linha){
                echo "<option value='".$linha["id_categoria"]."'>".$linha["nome"].    "</option>";
            }
        ?>
        </select>
        <br>
        imagem:
        <input type="file" name="imagem[]" multiple />
        <button type="submit">Enviar</button>
    </form>
</body>

</html>