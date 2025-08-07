<?php

include_once "mangas_has_vendas.class.php";

class mangas_has_vendaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new PDO(
            "mysql:host=localhost;dbname=mangamania",
            "root",
            ""
        );
    }
    public function inserir(mangas_has_vendas $obj)
    {
        $sql = $this->conexao->prepare("
        INSERT INTO mangas_has_vendas
        (id_vendas, id_mangas, preco, quantidade)
        VALUES
        (:id_vendas, :id_mangas, :preco, :quantidade)
        ");
        $sql->bindValue(":id_vendas", $obj->getId_vendas());
        $sql->bindValue(":id_mangas", $obj->getId_mangas());
        $sql->bindValue(":preco", $obj->getPreco());
        $sql->bindValue(":quantidade", $obj->getQuantidade());
        $sql->execute();
        return $this->conexao->lastInsertId();
    }

}  
?>