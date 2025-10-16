<?php
class imagem {
    private $id_manga;
    private $nome;
    private $idimagem;

    public function getId_manga() {
        return $this->id_manga;
    }
    public function setId_manga($valor) {
        $this->id_manga = $valor;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($valor) {
        $this->nome = $valor;
    }

    public function getIdimagem() {
        return $this->idimagem;
    }
    public function setIdimagem($valor) {
        $this->idimagem = $valor;
    }
}
?>
