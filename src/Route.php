<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloRouter;

class Route
{       
    public function __construct(
        public string $method,
        public string $path,
        public array $exec
    ){}
}