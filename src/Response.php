<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloRouter;

class Response
{   
    public const PROTOCOL_VERSION = 1.1;
    
    public function __construct(
        public string $body,
        public int $statusCode = 200,
        public array $headers = [],
    ){}
}