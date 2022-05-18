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
        $this->routes[$path] = new Route($method, $path, $exec);
    }
    
    public function handle(Request $request): Response
    {
        $uri = $request->server['REQUEST_URI'];
        $method = $request->server['REQUEST_METHOD'];
        $route = $this->matchRoute($uri, $method);
        
        if (!$route) {
            throw new Exception("NOT FOUND");
        }

        $instance = new $route->exec[0];

        return call_user_func_array([$instance, $route->exec[1]], []);
    }
    
    public function matchRoute($uri, $method): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->method === $method && $route->path === $uri) {
                return $route;
            }
        }
        
        return null;
    }
}