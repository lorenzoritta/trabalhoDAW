<?php
    class mangas_has_vendas{
        private $id_mangas;
        private $id_vendas;
        private $preco;
        private $quantidade;

        public function getId_mangas(){
            return $this->id_mangas;
        }

        public function setId_mangas($valor){
            $this->id_mangas = $valor;
        }
        public function getId_vendas(){
            return $this->id_vendas;
        }
        public function setId_vendas($valor){
            $this->id_vendas = $valor;
        }
        public function getPreco(){
            return $this->preco;
        }
        public function setPreco($valor){
            $this->preco = $valor;
        }
        public function getQuantidade(){
            return $this->quantidade;
        }
        public function setQuantidade($valor){
            $this->quantidade = $valor;
        }
        
        
    }

?>