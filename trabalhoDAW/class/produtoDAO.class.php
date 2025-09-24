<?php

include_once "produto.class.php";

class ProdutoDAO
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

    public function listar($complemento = "")
    {
        $sql = $this->conexao->prepare("SELECT mangas.*, categoria.nome as categoria FROM mangas 
        INNER JOIN categoria on mangas.id_categoria = categoria.id_categoria ". $complemento);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function inserir(Produto $produto)
    {
        $sql = $this->conexao->prepare("
            INSERT INTO mangas 
            (nome, editora, descricao, autor, preco, data_lancamento, pais_origem, num_volumes, ofertar, id_categoria)
            VALUES
            (:nome, :editora, :descricao, :autor, :preco, :data_lancamento, :pais_origem, :num_volumes, :ofertar, :id_categoria)
        ");



        $sql->bindValue(":nome", $produto->getNome());
        $sql->bindValue(":editora", $produto->getEditora());
        $sql->bindValue(":descricao", $produto->getDescricao());
        $sql->bindValue(":autor", $produto->getAutor());
        $sql->bindValue(":preco", $produto->getPreco());
        $sql->bindValue(":data_lancamento", $produto->getData_lancamento());
        $sql->bindValue(":pais_origem", $produto->getPais_origem());
        $sql->bindValue(":num_volumes", $produto->getNum_volumes());
        $sql->bindValue(":ofertar", $produto->getOfertar());
        $sql->bindValue(":id_categoria", $produto->getId_categoria());


        $sql->execute();
        return $this->conexao->lastInsertId();
    }

    public function excluir($id)
    {
        $sql = $this->conexao->prepare("
            DELETE FROM mangas WHERE id_manga = :id
        ");

        $sql->bindValue(":id", $id);
        return $sql->execute();
    }

    public function retornarUm($id)
    {
        $sql = $this->conexao->prepare("
            SELECT * FROM mangas WHERE id_manga = :id
        ");

        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch();
    }

    public function editar(Produto $produto)
    {
        $sql = $this->conexao->prepare("
            UPDATE mangas SET
                nome = :nome,
                editora = :editora,
                descricao = :descricao,
                autor = :autor,
                preco = :preco,
                data_lancamento = :data_lancamento,
                pais_origem = :pais_origem,
                num_volumes = :num_volumes
                ofertar = :ofertar,
                id_categoria = :id_categoria
                WHERE id_manga = :id_manga
        ");

        $sql->bindValue(":id_manga", $produto->getId_manga());
        $sql->bindValue(":nome", $produto->getNome());
        $sql->bindValue(":editora", $produto->getEditora());
        $sql->bindValue(":descricao", $produto->getDescricao());
        $sql->bindValue(":autor", $produto->getAutor());
        $sql->bindValue(":preco", $produto->getPreco());
        $sql->bindValue(":data_lancamento", $produto->getData_lancamento());
        $sql->bindValue(":pais_origem", $produto->getPais_origem());
        $sql->bindValue(":num_volumes", $produto->getNum_volumes());
        $sql->bindValue(":ofertar", $produto->getOfertar());
        $sql->bindValue(":id_categoria", $produto->getId_categoria());

        return $sql->execute();
    }

    public function ofertar(Produto $obj)
    {

        $sql = $this->conexao->prepare("
            UPDATE mangas SET
                ofertar = :ofertar
                WHERE id_manga = :id_manga
        ");

        $sql->bindValue(":id_manga", $obj->getId_manga());
        $sql->bindValue(":ofertar", $obj->getOfertar());

        return $sql->execute();
    }
}
?>