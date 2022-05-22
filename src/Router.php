<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloRouter;

class Router
{   
    public $routes;
    
    public function __construct()
    {
        $this->routes = [];
    }
    
    public function addRoute(string $method, string $path, array $exec)
    {
        $this->routes[] = new Route($method, $path, $exec);
    }
    
    public function handle(Request $request): Response
    {
        $uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $method = $request->server['REQUEST_METHOD'];
        $route = $this->matchRoute($uri, $method);
        
        if (!$route) {
            throw new \Exception("NOT FOUND");
        }

        $instance = new $route->exec[0];

        return call_user_func_array([$instance, $route->exec[1]], [$request, $route->params]);
    }
    
    public function emit(Response $response)
    {
        $status = sprintf(
            'HTTP/%s %d',
            $response::PROTOCOL_VERSION,
            $response->statusCode,
        );
        
        header($status, true, $response->statusCode);
        
        echo $response->body;
    }
    
    public function matchRoute($uri, $method): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->method === $method && preg_match($route->path, $uri, $matches)) {
                $route->params = $matches;
                return $route;
            }
        }
        
        return null;
    }
}