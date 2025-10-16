<?php
include_once "imagem.class.php";

class imagemDAO
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

    public function inserir(imagem $obj)
    {
        $sql = $this->conexao->prepare("
            INSERT INTO imagem (nome, id_manga)
            VALUES (:nome, :id_manga)
        ");

        $sql->bindValue(":nome", $obj->getNome());
        $sql->bindValue(":id_manga", $obj->getId_manga());

        return $sql->execute();
    }
    public function retornarUm($id)
    {
        $sql = $this->conexao->prepare("
        SELECT * FROM imagem WHERE id_manga=:id LIMIT 1
        ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch();

    }
}
?>