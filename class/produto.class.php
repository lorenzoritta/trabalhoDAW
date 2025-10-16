<?php
class Produto
{
    private $id_manga;
    private $nome;
    private $editora;
    private $descricao;
    private $autor;
    private $preco;
    private $data_lancamento;
    private $pais_origem;
    private $num_volumes;
    private $ofertar;
    private $id_categoria;

    public function getId_manga()
    {
        return $this->id_manga;
    }

    public function setId_manga($valor)
    {
        $this->id_manga = $valor;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($valor)
    {
        $this->nome = $valor;
    }

    public function getEditora()
    {
        return $this->editora;
    }

    public function setEditora($valor)
    {
        $this->editora = $valor;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($valor)
    {
        $this->descricao = $valor;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($valor)
    {
        $this->autor = $valor;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($valor)
    {
        $this->preco = $valor;
    }

    public function getData_lancamento()
    {
        return $this->data_lancamento;
    }

    public function setData_lancamento($valor)
    {
        $this->data_lancamento = $valor;
    }

    public function getPais_origem()
    {
        return $this->pais_origem;
    }

    public function setPais_origem($valor)
    {
        $this->pais_origem = $valor;
    }

    public function getNum_volumes()
    {
        return $this->num_volumes;
    }

    public function setNum_volumes($valor)
    {
        $this->num_volumes = $valor;
    }

    public function getOfertar()
    {
        return $this->ofertar;
    }

    public function setOfertar($valor)
    {
        $this->ofertar = $valor;
    }

    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    public function setId_categoria($valor)
    {
        $this->id_categoria = $valor;
    }
}
?>