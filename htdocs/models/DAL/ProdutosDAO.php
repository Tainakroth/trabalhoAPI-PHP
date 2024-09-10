<?php
    require_once 'Conexao.php';

class ProdutosDAO{
    public function getProdutos() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM produto;";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutosPorId($id_pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM item_pedido WHERE id = :id_produto;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id_pedido);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createProdutos(ProdutosModel $produto) {

        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO produto VALUES(:id,:descricao,:preco);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', null);
        $stmt->bindValue(':descricao', $produto->descricao);
        $stmt->bindValue(':preco', $produto->preco);
        
        return $stmt->execute();
    }
        
        public function updateProdutos(ProdutosModel $produto) {
            
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE produto SET id = :id, descricao = :descricao, preco = :preco  WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->id);
            $stmt->bindValue(':descricao', $produto->descricao);
            $stmt->bindValue(':preco', $produto->preco);
            return $stmt->execute();
        }

        public function deleteProdutos(ProdutosModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM produto WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->id);

            return $stmt->execute();
        }

        public function getNomeProdutos(string $descricao) {
            $conexao = (new conexao)->getConexao();

            $sql = "SELECT count(descricao) as descricao From produto WHERE descricao = :descricao";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam("descricao",$descricao);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
          
}

?>