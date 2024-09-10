<?php

    require_once 'DAL/StatusDAO.php';

    class StatusModel{
        public?int $id;
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
    
        public function getStatus() {
            $statusDAO = new StatusDAO();

            $statuses = $statusDAO ->getStatus();

        foreach($statuses as $chave => $status){
            $statuses[$chave] = new StatusModel(
                $status['id'],
                $status['id_pedido'],
                $status['id_produto'],
                $status['quantidade'],
                $status['id_status']
            );
        }

        return $statuses;
    }

    
    
    public function getStatusPorId($id_status) {
        $statusDAO = new StatusDAO;

        $status = $statusDAO->getStatusPorId($id_status);

        $status = new StatusModel(
            $status['id'],
            $status['id_pedido'],
            $status['id_produto'],
            $status['quantidade']
        );
        return $status;
        
    }

}

?>














?>