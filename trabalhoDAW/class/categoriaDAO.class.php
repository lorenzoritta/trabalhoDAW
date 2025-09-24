<?php

include_once "categoria.class.php";
class categoriaDAO
{
    private $conexao;
    public function __construct()
    {
        $this->conexao = new PDO(
            "mysql:host=localhost; dbname=mangamania",
            "root",
            ""
        );


    }
    public function listar()
    {
        $sql = $this->conexao->prepare(
            "SELECT * FROM categoria  "
        );
        $sql->execute();
        return $sql->fetchAll();
    }
    public function inserir(categoria $obj)
    {

        $sql = $this->conexao->prepare(
            "INSERT INTO categoria
    (nome)
    VALUES
    (:nome)"
        );
        $sql->bindValue(":nome", $obj->getNome(), );
        return $sql->execute();
    }
    public function excluir($id)
    {
        $sql = $this->conexao->prepare("
        DELETE FROM categoria WHERE
        id_categoria = :id
        ");

        $sql->bindValue(":id", $id);
        return $sql->execute();
    }
    public function retornarUm($id)
    {
        $sql = $this->conexao->prepare("
        SELECT * FROM categoria WHERE id_categoria=:id
        ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch();

    }

    public function editar(categoria $categoria)
    {
        $sql = $this->conexao->prepare("
        UPDATE categoria SET
        nome = :nome,
        WHERE id_categoria = :id_categoria
        ");
        $sql->bindValue(":id_categoria", $categoria->getId_categoria());
        $sql->bindValue(":nome", $categoria->getNome());
        return $sql->execute();

    }
}
?>