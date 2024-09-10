<?php
    require_once 'Conexao.php';


    class StatusDAO {
        public function getStatus(){
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM status;";

            $stmt = $conexao->prepare($sql);
            $stmt -> execute();

            return $stmt ->fetchAll(PDO::FETCH_ASSOC);
        }


        public function getStatusPorId($id_pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM item_pedido WHERE id = :id_status;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id_pedido);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    }





?>