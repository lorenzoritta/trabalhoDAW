<?php

include_once "vendas.class.php";

class VendaDAO
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

    public function listar()
    {
        $sql = $this->conexao->prepare("SELECT * FROM vendas");
        $sql->execute();
        return $this->conexao->lastInsertId();

    }

    public function inserir(Vendas $obj)
    {
        $sql = $this->conexao->prepare("
            INSERT INTO vendas (id_cliente,status_venda, forma_pagamento,data_venda, entrega)
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

}
?>