<?php
    require_once './models/StatusModel.php';

    class StatusController {
            public function getStatus() {
                $statusModel = new StatusModel();
    
                $status = $statusModel->getStatus();
    
                return json_encode([
                    'error' => null,
                    'result' => $status
                ]);
            }
    
            public function getStatusPorId() {
                $dados = json_decode(file_get_contents('php://input'), true);
    
                if (empty($dados['id']))
                    return $this->mostrarErro('Você deve informar o id!');
    
                $response = (new StatusModel())->getStatusPorId($dados['id']);
    
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