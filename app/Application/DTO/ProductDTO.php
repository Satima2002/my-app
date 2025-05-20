<?php

namespace App\Application\DTO;

class ProductDTO 
{
    public function __construct(
        public ?int $id,
        public string $name,
        public int $categoryId
    ) {}
}
