<?php
    require_once './models/PedidoModel.php';

    class PedidoController {
        public function getPedido() {
            $pedidoModel = new PedidoModel();

            $pedido = $pedidoModel->getPedido();

            return json_encode([
                'error' => null,
                'result' => $pedido
            ]);
        }

        public function createPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id_usuario']))
                return $this->mostrarErro('Você deve informar o id_usuario');
            if (empty($dados['id_status']))
                return $this->mostrarErro('Você deve informar o id_status');

            $pedido = new PedidoModel(
                null,
                $dados['id_usuario'],
                $dados['id_status']
            );

            

            $pedido->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updatePedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['id_pedido']))
                return $this->mostrarErro('Você deve informar o id_pedido');
            if (empty($dados['id_usuario']))
                return $this->mostrarErro('Você deve informar o id_usuario');
            if (empty($dados['id_status']))
                return $this->mostrarErro('Você deve informar o id_status');

            $pedido = new PedidoModel(
                $dados['id_pedido'],
                $dados['id_usuario'],
                $dados['id_status']
            );

            $pedido->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deletePedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['id_pedido']))
                return $this->mostrarErro('BRUXO, INFORMA O id_pedido, BLZ');

            $pedido = new PedidoModel(
                $dados['id_pedido'],
            );

            $pedido->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);   
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }

        public function getPedidoPessoa(){
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idUsuario'])) {
                return $this->mostrarErro('Você deve informar o idUsuario');
            }
            $pedidoModel = new PedidoModel();

            $result = $pedidoModel->getPedidoUsuario($dados['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }

        public function updateStatusPedido() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['id_pedido'])) {
                return $this->mostrarErro('Você deve informar o id_pedido');
            }
            if(empty($dados['id_status'])){
                return $this->mostrarErro('Você deve mostar o idUsuario');
            }

            $usuario = new PedidoModel (
                $dados['id_pedido'],
                null,
                $dados['id_status']
            );

            $usuario->updateStatus();

            return json_encode([
                'error' => null,
                'result' => true
            ]);

        }
    }
?>