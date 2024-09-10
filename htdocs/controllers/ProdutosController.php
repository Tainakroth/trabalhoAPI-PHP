<?php
    require_once './models/ProdutosModel.php';

    class ProdutosModel{
        public function getProdutos() {
            $produtoModel = new ProdutosModel();

            $response = $produtoModel->getProdutos();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function getProdutosPorId() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id!');

            $response = (new ProdutosModel())->getProdutosPorId($dados['id']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }


        public function createProdutos() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['descricao']))
                return $this->mostrarErro('Você deve informar o descricao!');

            if (empty($dados['preco']))
                return $this->mostrarErro('Você deve informar o preco!');

            $produto = new ProdutosModel(
                null,
                $dados['descricao'],
                $dados['preco']);

            $validacao = $produto->validarProduto($dados['descricao']);

            if ($validacao['descricao'] >= 1) {
                return $this->mostrarErro("já existe um produto com esta descricao");
            }
    
                $produto->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateProdutos() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_produto']))
                return $this->mostrarErro('Você deve informar o idproduto!');

            if (empty($dados['descricao'])) 
                return $this->mostrarErro('Você deve informar o descricao!');

            if (empty($dados['preco']))
                return $this->mostrarErro('Você deve informar o preco!');
        
            $produto = new ProdutosModel(
                $dados['id_produto'],
                $dados['descricao'],
                $dados['preco']
            );

            $validacao = $produto->validarProduto($dados['descricao']);

            if ($validacao['descricao'] >= 1) {
                return $this->mostrarErro("já existe um produto com esta descricao");
            }

            $produto->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteProdutos() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id!');

            $produto = new ProdutosModel($dados['id']);

            $response = $produto->delete();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>