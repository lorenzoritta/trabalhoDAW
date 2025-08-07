<?php
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";

$objclientesDAO = new categoriaDAO();
$retorno = $objclientesDAO->listar();

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
    echo "<br/>
    <a href='editar.php?id=" . $linha["id_categoria"] . "'>
    editar</a>
    <a href='excluir.php?id=" . $linha["id_categoria"] . "'>
    excluir</a>

    <br  /><br  />";
}

?>