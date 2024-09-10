<?php
    require_once 'Conexao.php';

    class UsuariosDAO {
        public function getUsuarios() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createUsuario(UsuariosModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO usuario VALUES (:id,:nome, :cpf, :senha);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':nome', $usuario->nome);
            $stmt->bindValue(':cpf', $usuario->cpf);
            $stmt->bindValue(':senha', $usuario->senha);

            return $stmt->execute();
        }

        public function updateUsuario(UsuariosModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE usuario SET id = :id, nome = :nome, cpf = :cpf, senha = :senha WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->id);
            $stmt->bindValue(':nome', $usuario->nome);
            $stmt->bindValue(':cpf', $usuario->cpf);
            $stmt->bindValue(':senha', $usuario->senha);

            return $stmt->execute();
        }

        public function deleteUsuario(UsuariosModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM usuario WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->id);

            return $stmt->execute();
        }

        public function getUsuario($idUsuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE id = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getCpfUsuario(string $cpf) {
            $conexao = (new conexao)->getConexao();

            $sql = "SELECT count(cpf) as cpf From usuario WHERE cpf = :cpf";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam("cpf",$cpf);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        
    }
?>