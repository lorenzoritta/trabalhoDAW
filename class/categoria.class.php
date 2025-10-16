<?php
class categoria
{
    private $id_categoria;
    private $nome;

    public function getId_categoria()
    {
        return $this->id_categoria;
    }
    public function setId_categoria($valor)
    {
        $this->id_categoria = $valor;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($valor)
    {
        $this->nome = $valor;
    }
}''
?>