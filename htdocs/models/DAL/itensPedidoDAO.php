<?php
    require_once 'Conexao.php';

class itensPedidoDAO{
    public function getItensPedidos() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM item_pedido;";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createItensPedidos(itensPedidoModel $itenspedido) {

        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO item_pedido VALUES(:id,:id_pedido,:id_produto,:quantidade,:id_status);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', null);
        $stmt->bindValue(':id_pedido', $itenspedido->id_pedido);
        $stmt->bindValue(':id_produto', $itenspedido->id_produto);
        $stmt->bindValue(':quantidade', $itenspedido->quantidade);
        $stmt->bindValue(':id_status', $itenspedido->id_status);
        return $stmt->execute();
    }
        
        public function updateItensPedidos(itensPedidoModel $itenspedido) {
            
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE item_pedido SET id = id:,:id_pedido,:id_pedido,:quantidade,:id_status";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id',null);
            $stmt->bindValue(':id_pedido', $itenspedido->id_pedido);
            $stmt->bindValue(':id_produto', $itenspedido->id_produto);
            $stmt->bindValue(':quantidade', $itenspedido->quantidade);
            $stmt->bindValue(':id_status', $itenspedido->id_status);
            return $stmt->execute();
        }

        public function deleteItensPedidos(itensPedidoModel $itenspedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM item_pedido WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $itenspedido->id);

            return $stmt->execute();
        }

        public function verifyOrderItem(itensPedidoModel $orderItemId){
            $connection = (new Conexao)->getConexao();

            $sql = "SELECT * FROM item_pedido WHERE id_pedido = :orderId AND id_produto = :productId";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':orderId', $orderItemId->id_pedido);
            $stmt->bindValue(':productId', $orderItemId->id_produto);
            $stmt->execute();

            return  $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function AddProductQuantity(itensPedidoModel $orderItemId){
            $connection = (new Conexao)->getConexao();

            $sql = "UPDATE item_pedido
                    SET quantidade = quantidade + :quantidade
                    WHERE id_pedido = :id AND id_produto    = :id_produto;";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $orderItemId->id_pedido);
            $stmt->bindValue(':id_produto', $orderItemId->id_produto);
            $stmt->bindValue(':quantidade', $orderItemId->quantidade);
            
            return $stmt->execute();
        }
    }

?>