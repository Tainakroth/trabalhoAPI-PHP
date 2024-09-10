<?php
    class Conexao {
        private PDO $conexao;

        public function  __construct(){
            $this->conexao = new PDO('mysql:host=localhost;dbname=loja','root','');
        }

        public function getConexao(): PDO {
            return $this->conexao;
        }
    }






?>