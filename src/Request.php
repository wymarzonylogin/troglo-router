<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloRouter;

class Request
{   
    public $server;
    public $get;
    public $post;
    public $cookie;
    public $files;
    public $method;
    
    public function __construct()
    {
        $this->server = $_SERVER;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->cookie = $_COOKIE;
        $this->files = $_FILES;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
}
