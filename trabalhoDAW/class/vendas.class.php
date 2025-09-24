<?php
class Vendas
{
    private $id_vendas;

    private $id_cliente;

    private $status_venda;
    
    private $forma_pagamento;

    private $data_venda;

    private $entrega;

    public function getId_vendas()
    {
        return $this->id_vendas;
    }
    public function setId_vendas($valor)
    {
        $this->id_vendas = $valor;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }
    public function setId_cliente($valor)
    {
        $this->id_cliente = $valor;
    }

    public function getForma_pagamento()
    {
        return $this->forma_pagamento;
    }
    public function setForma_pagamento($valor)
    {
        $this->forma_pagamento = $valor;
    }
    public function getStatus_venda()
    {
        return $this->status_venda;
    }
    public function setStatus_venda($valor)
    {
        $this->status_venda = $valor;
    }

    public function getData_venda()
    {
        return $this->data_venda;
    }
    public function setData_venda($valor)
    {
        $this->data_venda = $valor;
    }

    public function getEntrega()
    {
        return $this->entrega;
    }
    public function setEntrega($valor)
    {
        $this->entrega = $valor;
    }

}
?>