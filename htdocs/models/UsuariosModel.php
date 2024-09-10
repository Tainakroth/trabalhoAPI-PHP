<?php
    require_once 'DAL/UsuariosDAO.php';

    class UsuariosModel {
        public ?int $id;
        public ?string $nome;
        public ?string $cpf;
        public ?string $senha;

        public function __construct(
            ?int $idUsuario = null,
            ?string $nome = null,
            ?string $cpf = null,
            ?string $senha = null
        ) {
            $this->id= $idUsuario;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->senha = $senha;
        }

        public function getUsuarios() {
            $usuarioDAO = new UsuariosDAO();

            $usuarios = $usuarioDAO->getUsuarios();

            foreach ($usuarios as &$usuario) {
                $usuario = new UsuariosModel(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['cpf'],
                    $usuario['senha']
                );
            }

            return $usuarios;
        }

        public function getUsuario($idUsuario) {
            $usuarioDAO = new UsuariosDAO;

            $usuario = $usuarioDAO->getUsuario($idUsuario);

            $usuario = new UsuariosModel(
                $usuario['id'],
                $usuario['nome'],
                $usuario['cpf'],
                $usuario['senha']
            );

            return $usuario;
        }

        public function create() {
            $usuarioDAO = new UsuariosDAO();

            return $usuarioDAO->createUsuario($this);
        }

        public function update() {
            $usuarioDAO = new UsuariosDAO();

            return $usuarioDAO->updateUsuario($this);
        }

        public function delete() {
            $usuarioDAO = new UsuariosDAO();

            return $usuarioDAO->deleteUsuario($this);
        }


        public function validarUsuario(string $cpf) {
            $usuarioDAO = new UsuariosDAO();

            return $usuarioDAO->getCpfUsuario($cpf);
        }
    }
?>