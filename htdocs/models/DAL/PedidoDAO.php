<?php
    require_once 'Conexao.php';

    class PedidoDAO {
        public function getPedido() {
            $conexao = (new conexao())->getConexao();

            $sql = "SELECT * FROM pedido;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createPedido(PedidoModel $pedido) {
            $conexao = (new conexao())->getConexao();

            $sql = "INSERT INTO pedido VALUES (:id, :id_usuario, :id_status)";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':id_usuario', $pedido->idUsuario);
            $stmt->bindValue(':id_status', $pedido->idStatus);

            return $stmt->execute();
        }

        public function updatePedido(PedidoModel $pedido) {
            $conexao = (new conexao())->getConexao();

            $sql = "UPDATE pedido SET id_usuario = :id_usuario, id_status = :id_status WHERE id_pedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $pedido->idPedido);
            $stmt->bindValue(':id_usuario', $pedido->idUsuario);
            $stmt->bindValue(':id_status', $pedido->idStatus);

            return $stmt->execute();
        }

        public function deletePedido(PedidoModel $pedido) {
            $conexao = (new conexao())->getConexao();

            $sql = "DELETE FROM pedido WHERE id_pedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $pedido->idPedido);

            return $stmt->execute();
        }

        public function getPedidoByIdUsuario($idUsuario) {
            $conexao = (new conexao)->getConexao();

            $sql = "SELECT * FROM pedido WHERE id_usuario = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id",$idUsuario);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateStatusPedido(PedidoModel $pedido) {
            $conexao = (new conexao())->getConexao();

            $sql = "UPDATE pedido SET id_status = :id_status WHERE id_pedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$pedido->idPedido);
            $stmt->bindValue(":id_status",$pedido->idStatus);

            return $stmt->execute();
        }
    }
?>