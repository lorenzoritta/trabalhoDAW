<?php

include_once "vendas.class.php";

class VendasDAO
{
    private $conexao;

    public function __construct()
    {
        try {
            $this->conexao = new PDO(
                "mysql:host=localhost;dbname=mangamania",
                "root",
                ""
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    // Método listar corrigido para usar id_vendas e status_vendas
    public function listar()
    {
        $sql = $this->conexao->prepare("SELECT * FROM vendas ORDER BY data_venda DESC");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir(Vendas $obj)
    {
        $sql = $this->conexao->prepare("
            INSERT INTO vendas (id_cliente, status_venda, forma_pagamento, data_venda, entrega)
            VALUES (:id_cliente, :status_venda, :forma_pagamento, :data_venda, :entrega)
        ");
        $sql->bindValue(":id_cliente", $obj->getId_cliente());
        $sql->bindValue(":status_venda", $obj->getStatus_venda());
        $sql->bindValue(":forma_pagamento", $obj->getForma_pagamento());
        $sql->bindValue(":data_venda", $obj->getData_venda());
        $sql->bindValue(":entrega", $obj->getEntrega());
        $sql->execute();
        return $this->conexao->lastInsertId();
    }
    
    public function listarItens($id_venda)
{
    $sql = $this->conexao->prepare("
        SELECT mhv.*, m.nome, m.preco 
        FROM mangas_has_vendas mhv
        INNER JOIN mangas m ON mhv.id_mangas = m.id_manga
        WHERE mhv.id_vendas = :id_venda
    ");
    $sql->bindValue(':id_venda', $id_venda, PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function atualizarStatus($id_vendas, $status_venda)
{
    $sql = $this->conexao->prepare("
        UPDATE vendas 
        SET status_venda = :status_venda
        WHERE id_vendas = :id_vendas
    ");
    $sql->bindParam(':status_venda', $status_venda);
    $sql->bindParam(':id_vendas', $id_vendas, PDO::PARAM_INT);
    return $sql->execute();
}

}
?>
