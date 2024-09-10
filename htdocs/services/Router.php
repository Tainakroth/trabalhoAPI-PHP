<?php
    class Router {
        private array $routes;
        
        public function __construct(){
            $this->routes = [
                'GET' => [
                    '/usuarios'  => [
                        'controller' => 'UsuariosController',
                        'function' => 'getUsuario'

                    ],
                    '/status' =>[
                        'controller' => 'StatusController',
                        'function'  => 'getStatus'
                    ],
                    '/produtos' => [
                        'controller' => 'ProdutosController',
                        'function' => 'getProduto'
                    ],
                    '/itens-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'getItensPedido'
                    ],
                    '/pedidos' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedido'
                    ],
                ],
                'POST' =>  [

                    '/usuario' => [
                        'controller' => 'UsuariosController',
                        'function' => 'getUsuario'
                    ],

                    '/criar-usuario' =>[
                        'controller' => 'UsuariosController',
                        'function' => 'createUsuario'
                    ],
                    '/buscar-usuario-id' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatusPorId'
                    ], 
                    '/buscar-produto-id' => [
                        'controller' => 'ProdutoController', 
                        'function' => 'getProdutoPorId'
                    ],
                    
                    '/criar-produto' =>  [
                        'controller' => 'ProdutosController',
                        'function' => 'createProduto'
                    ],
                    '/itens-pedido' => [
                        'controller' => 'itensPedidoController',
                        'function' => 'createItensPedido'
                    ],

                    '/criar-item-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'createItensPedido'
                    ],
                    '/buscar-pedido-pessoa' => [ 
                        'controller' => 'PedidoController',
                        'function' => 'getPedidoPessoa'
                    ],

                    '/valor-total-pedido' => [ 
                        'controller' => 'PedidoController',
                        'function' => 'buscarValorTotalPedido'
                    ],
                    '/cadastrar-pedido' => [ 
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ],
                   
                    '/buscar-status' => [
                        'controller'=>'StatusController',
                        'function' => 'getStatus'
                    ],
                ],
                'PUT' => [
                    '/atualizar-usuario'=> [
                        'controller' => 'UsuariosController',
                        'function' => 'updateUsuario'
                    ],
                    '/atualizar-produto' => [
                        'controller' => 'ProdutosController',
                        'functioon' => 'updateProduto'
                    ],
                    '/editar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updatePedido'
                    ],
                    '/editar-status-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updateStatusPedido'
                    ],
                    '/atualizar-item-pedido'=>[
                        'controller' => 'itensPedidoController',
                        'function' => 'updateItemPedido'
                    ]
                ],
                'DELETE' => [
                    '/excluir-usuario' => [
                        'controller' => 'UsuariosController',
                        'function' =>'deleteUsuario'
                    ],
                    '/excluir-produto'=> [
                        'controller' => 'ProdutosController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'deletePedido'
                    ],
                    '/excluir-item-pedido' => [
                        'controller' => 'ItensPedidoController',
                        'function' => 'deleteItensPedido'
                    ]

                ]
        ];

    }

    public function handleRequest(string $method, string $route): string {
        $routeExists = !empty($this->routes[$method][$route]);

        if (!$routeExists) {
            return json_encode([
                'error' => 'Essa rota não existe!',
                'result' => null
            ]);
        }

        $routeInfo = $this->routes[$method][$route];

        $controller = $routeInfo['controller'];
        $function = $routeInfo['function'];

        require_once __DIR__ . '/../controllers/' . $controller . '.php';

        return (new $controller)->$function();
    }






    }
?>