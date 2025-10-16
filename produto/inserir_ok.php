<?php
// echo "<pre>";
// print_r($_POST);
include_once "../class/produto.class.php";
include_once "../class/produtoDAO.class.php";
//print_r($_POST);
include_once "../class/imagem.class.php";
include_once "../class/imagemDAO.class.php";

$obj = new Produto();
$obj->setNome($_POST["nome"]);
$obj->setEditora($_POST["editora"]);
$obj->setDescricao($_POST["descricao"]);
$obj->setAutor($_POST["autor"]);
$obj->setPreco($_POST["preco"]);
$obj->setData_lancamento($_POST["data_lancamento"]);
$obj->setPais_origem($_POST["pais_origem"]);
$obj->setNum_volumes($_POST["num_volumes"]);
$obj->setOfertar(0);
$obj->setId_categoria( $_POST["id_categoria"]);

$objDAO = new ProdutoDAO();
$retorno = $objDAO->inserir($obj);
$obj = new imagem();
$obj->setId_manga($retorno);
$objDAO = new imagemDAO();

for ($i = 0; $i < count($_FILES["imagem"]["name"]); $i++) {
    $nome = $_FILES["imagem"]["name"][$i];
    $nomeTmp = $_FILES["imagem"]["tmp_name"][$i];
    $diretorio = "../img/" . $nome;
    if (move_uploaded_file($nomeTmp, $diretorio)) {
        $obj->setNome($nome);
        $objDAO->inserir($obj);
    }

}

if ($retorno)
    echo "Adicionado com sucesso";
else
    echo "Erro! Por favor, consulte um adm";
?>