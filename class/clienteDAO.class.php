<?php

include_once "cliente.class.php";
class clienteDAO
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
            "SELECT * FROM cliente  "
        );
        $sql->execute();
        return $sql->fetchAll();
    }
    public function inserir(cliente $obj)
    {
        $sql = $this->conexao->prepare("SELECT * FROM cliente where email = :email");
        $sql->bindValue(":email", $obj->getEmail());
        $sql->execute();
        if ($sql->rowCount() == 0) {
            $sql = $this->conexao->prepare(
                "INSERT INTO cliente
    (nome, email, senha)
    VALUES
    (:nome, :email, :senha)"
            );
            $sql->bindValue(":nome", $obj->getNome(), );
            $sql->bindValue(":email", $obj->getEmail(), );
            $sql->bindValue(":senha", $obj->getSenha(), );
            return $sql->execute();
        } else {
            return 2;
        }
    }
    public function excluir($id)
    {
        $sql = $this->conexao->prepare("
        DELETE FROM cliente WHERE
        id_cliente = :id
        ");

        $sql->bindValue(":id", $id);
        return $sql->execute();
    }
    public function retornarUm($id)
    {
        $sql = $this->conexao->prepare("
        SELECT * FROM cliente WHERE id_cliente=:id
        ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch();

    }
    public function login(cliente $cliente)
    {
        $sql = $this->conexao->prepare("
        SELECT * FROM cliente WHERE email = :email OR usuario = :usuario");
        $sql->bindValue(":email", $cliente->getEmail());
        $sql->bindValue(":usuario", $cliente->getEmail());

        $sql->execute();
        if ($sql->rowCount() > 0) {
            while ($retorno = $sql->fetch()) {
                if ($retorno["senha"] == $cliente->getSenha()) {

                    return $retorno; //tudo ok! faça o login
                }
            }
            return 1; // senha incorreta
        } else {
            return 2; //email n cadastrado
        }
    }

    public function editar(cliente $cliente)
    {
        $sql = $this->conexao->prepare("
        UPDATE cliente SET
        nome = :nome, email = :email, senha =:senha, endereco
        =:endereco, usuario =:usuario
        WHERE id_cliente = :id_cliente
        ");
        $sql->bindValue(":id_cliente", $cliente->getId_cliente());
        $sql->bindValue(":email", $cliente->getEmail());
        $sql->bindValue(":nome", $cliente->getNome());
        $sql->bindValue(":senha", $cliente->getSenha());
        $sql->bindValue(":endereco", $cliente->getEndereco());
        $sql->bindValue(":usuario", $cliente->getUsuario());
        return $sql->execute();

    }
}
?>
