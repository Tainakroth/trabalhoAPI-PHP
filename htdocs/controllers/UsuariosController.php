<?php
    require_once './models/UsuariosModel.php';

    class UsuariosController {
        public function getUsuarios() {
            $usuarioModel = new UsuariosModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['nome']))
                return $this->mostrarErro('Você deve informar o nome!');

            if (empty($dados['cpf']))
                return $this->mostrarErro('Você deve informar  o cpf!');

            if (empty($dados['senha']))
                return $this->mostrarErro('Você deve informar a senha!');
        
            $usuario = new UsuariosModel(
                null,
                $dados['nome'],
                $dados['cpf'],
                md5($dados['senha'])
            );

            $validacao = $usuario->validarUsuario($dados['cpf']);

            if ($validacao['cpf'] >= 1) {
                return $this->mostrarErro("já existe um usuario com este CPF");
            }

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id!');

            if (empty($dados['nome']))
                return $this->mostrarErro('Você deve informar o nome!');

            if (empty($dados['cpf']))
                return $this->mostrarErro('Você deve informar o cpf!');

            if (empty($dados['senha']))
                return $this->mostrarErro('Você deve informar o senha!');
        
            $usuario = new UsuariosModel(
                $dados['id'],
                $dados['nome'],
                $dados['cpf'],
                md5($dados['senha'])
            );


            $validacao = $usuario->validarUsuario($dados['cpf']);

            if ($validacao['cpf'] >= 1) {
                return $this->mostrarErro("já existe um usuario com este CPF");
            }
            $usuario->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id');

            $usuario = new UsuariosModel($dados['id']);

            $usuario->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id!');

            $response = (new UsuariosModel())->getUsuario($dados['id']);

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