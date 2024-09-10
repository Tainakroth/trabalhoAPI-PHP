<<?php

require_once 'DAL/itensPedidoDAO.php';

class itensPedidoModel{
    public ?int $id;
    public ?string $id_pedido;
    public ?string $id_produto;
    public ?string $quantidade;
    public ?string $id_status;

    public function __construct(
        ?int $id = null,
        ?string $id_pedido = null,
        ?string $id_produto = null,
        ?string $quantidade = null,
        ?string $id_status = null,

    ) {
        $this->id = $id;
        $this->id_pedido = $id_pedido;
        $this->id_produto = $id_produto;
        $this->quantidade = $quantidade;
        $this->id_status = $id_status;
    }


    public function getItensPedidos() {
        $itensPedidoDAO = new itensPedidoDAO();

        $itenspedidos = $itensPedidoDAO->getItensPedidos();

        foreach ($itenspedidos as $chave => $itenspedido) {
            $itenspedido[$chave] = new itensPedidoModel(
                $itenspedido['id_pedido'],
                $itenspedido['id_produto'],
                $itenspedido['quantidade'],
                $itenspedido['id_status'],
            );
        }

        return $itenspedidos;
    }


    
    public function create() {
        $itensPedidoDAO = new itensPedidoDAO();

        return $itensPedidoDAO->createItensPedidos($this);
    }

    public function update() {
        $itensPedidoDAO = new itensPedidoDAO();

        return $itensPedidoDAO->updateItensPedidos($this);
    }

    public function delete() {
        $itensPedidoDAO = new itensPedidoDAO();

        return $itensPedidoDAO->deleteItensPedidos($this);
    }

    public function verifyOrderItem(){
        $orderItemDAO = new itensPedidoDAO();

        return $orderItemDAO->verifyOrderItem($this);
    }

    public function AddProductQuantity(){
        $orderItemDAO = new itensPedidoDAO();

        return $orderItemDAO->AddProductQuantity($this);
    }

    public function getValorTotalPedidos($idPedido) {
        $itemPedidoDAO = new itensPedidoDAO;

        return $itemPedidoDAO->getValorTotalFromPedidosById($idPedido);

        
        foreach ($itens as &$item) {
            $item = new itensPedidoModel(
                $item['id_item_pedido'],
                $item['idProduto'],
                $item['idPedido'],
                $item['quantidade'],
                $item['valorTotal']
            );
        }
        return $itens;
    }
}
  
?>



