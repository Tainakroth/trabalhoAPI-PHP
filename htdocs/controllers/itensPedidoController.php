<?php
     require_once './models/itensPedidoModel.php';

     class itensPedidoController {
         public function getItensPedidos() {
             $itensPedidoModel = new itensPedidoModel();
 
             $itensPedido = $itensPedidoModel->getItensPedidos();
 
             return json_encode([
                 'error' => null,
                 'result' => $itensPedido
             ]);
         }
 
         public function createItensPedidos() {
             $dados = json_decode(file_get_contents('php://input'), true);
 
             if (empty($dados['id_pedido']))
                 return $this->mostrarErro('Você deve informar o id_pedido!');
 
             if (empty($dados['id_produto']))
                 return $this->mostrarErro('Você deve informar o id_produto!');
 
             if (empty($dados['quantidade']))
                 return $this->mostrarErro('Você deve informar a quantidade!');
 
             if (empty($dados['id_status']))
                 return $this->mostrarErro('Você deve informar o id_status!');
         
             $orderItemData = new itensPedidoModel(
                 null,
                 $dados['id_pedido'],
                 $dados['id_produto'],
                 $dados['quantidade'],
                 $dados['id_status']);
 
                 $orderItemModel = new itensPedidoModel();
 
                 if(($orderItemData->verifyOrderItem())){
                     $orderItem = $orderItemData->AddProductQuantity();
                 }
                 else{
                     $orderItem = $orderItemData->create();
                 }
 
             return json_encode([
                 'error' => null,
                 'result' => $orderItem
             ]);
         }
    
        public function updateItensPedidos() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_pedido']))
                return $this->mostrarErro('Você deve informar o idpedido!');

            if (empty($dados['id_produto']))
                return $this->mostrarErro('Você deve informar o idproduto!');

            if (empty($dados['quantidade']))
                return $this->mostrarErro('Você deve informar o quantidade!');

            if (empty($dados['id_status']))
                return $this->mostrarErro('Você deve informar a id_status!');
        
            $pedido = new itensPedidoModel(
                $dados['id_pedido'],
                $dados['id_produto'],
                $dados['quantidade'],
                $dados['id_status']);

            $pedido->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteItensPedidos() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id');

            $itenspedido = new itensPedidoModel($dados['id']);

            $itenspedido->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getValorTotalFromPedidosById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['id_pedido'])) {
                return $this->mostrarErro('Você deve informar o idPedido');
            }
            $itemPedidoModel = new itensPedidoModel();

            $result = $itemPedidoModel->getValorTotalPedidos($dados['id_pedido']);

            return json_encode([
                'error' => null,
                'result' => $result
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