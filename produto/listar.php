<?php
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";
include_once "../class/imagem.class.php";
include_once "../class/imagemDAO.class.php";

$objProdutosDAO = new ProdutoDAO();
$retorno = $objProdutosDAO->listar();

/*
echo "<pre>";
print_r($retorno);
*/

if (isset($_POST["editarOK"]))
    echo "<h2>Editado com sucesso!</h2>";
if (isset($_POST["editarErro"]))
    echo "<h2>Erro ao editar!</h2>";

echo "<a href='inserir.php'>Inserir</a><br />";

$objImagemDAO = new imagemDAO();

foreach ($retorno as $linha) {
    echo "Nome: " . $linha["nome"];
    echo "<br />Categoria:" . $linha["categoria"];
    echo "<br/>Preço: R$" . $linha["preco"];   
    echo "<br/>Autor: " . $linha["autor"];
    echo "<br/>Editora: " . $linha["editora"];
    echo "<br/>Data de Lançamento: " . $linha["data_lancamento"];
    $retornoImg = $objImagemDAO->retornarUm($linha["id_manga"]);
    if ($retornoImg > 0)
    echo "<br/><img src='../img/" . $retornoImg["nome"] . "'/>";

    echo "<br/>
        <a href='editar.php?id=" . $linha["id_manga"] . "'>Editar</a>
        <a href='excluir.php?id=" . $linha["id_manga"] . "'>Excluir</a>
        <a href='ofertar.php?id=" . $linha["id_manga"] . "'>Ofertar</a>
    <br /><br />";
}
?>