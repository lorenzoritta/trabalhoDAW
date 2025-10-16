<?php
class cliente
{
    private $id_cliente;
    private $nome;
    private $email;
    private $senha;

    private $endereco;

    private $usuario;

    public function getId_cliente()
    {
        return $this->id_cliente;
    }
    public function setId_cliente($valor)
    {
        $this->idcliente = $valor;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($valor)
    {
        $this->nome = $valor;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($valor)
    {
        $this->senha = $valor;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($valor)
    {
        $this->endereco = $valor;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($valor)
    {
        $this->usuario = $valor;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($valor)
    {
        $this->email = $valor;

    }
}
?>