<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloRouter;

class Route
{       
    public $params;
    
    public function __construct(
        public string $method,
        public string $path,
        public array $exec,
    ){
        $this->params = [];
    }
}