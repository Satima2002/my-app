<?php

namespace App\Application\DTO;

class AttributeDTO{
    public function __construct(
        public ?int $id,
        public string $name
    )
    {
        
    }
}