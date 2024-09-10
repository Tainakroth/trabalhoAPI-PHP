<?php

    require_once 'DAL/ProdutosDAO.php';

    class ProdutosModel{
        public ?int $id;
        public ?string $descricao;
        public ?string $preco;

        public function __construct(
            ?int $id = null,
            ?string $descricao = null,
            ?string $preco = null,
        ) {
            $this->id = $id;
            $this->descricao = $descricao;
            $this->preco = $preco;
        }

        public function getProdutos() {
            $produtoDAO = new ProdutosDAO();

            $produto= $produtoDAO->getProdutos();

            foreach ($produto as $chave => $produto) {
                $produto[$chave] = new ProdutosModel(
                    $produto['id'],
                    $produto['descricao'],
                    $produto['preco'],
                );
            }

            return $produto;
        }

        public function getProdutosPorId($id_produto) {
            $produtoDAO = new ProdutosDAO;

            $produto = $produtoDAO->getProdutosPorId($id_produto);

            $produto = new produtosModel(
                $produto['id'],
                $produto['descricao'],
                $produto['preco']
            );
            return $produto;
            
        }


        public function create() {
            $produtoDAO = new ProdutosDAO();

            return $produtoDAO->createProdutos($this);
        }

        public function update() {
            $produtoDAO = new ProdutosDAO();

            return $produtoDAO->updateProdutos($this);
        }

        public function delete() {
            $produtoDAO = new ProdutosDAO();

            return $produtoDAO->deleteProdutos($this);
        }

        public function validarProduto(string $descricao) {
            $produtoDAO = new ProdutosDAO();

            return $produtoDAO->getNomeProdutos($descricao);
        }
    }
?>



    