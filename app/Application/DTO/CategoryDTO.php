<?php
namespace App\Application\DTO;

class CategoryDTO
{
    public function __construct(
        public ?int $id,
        public string $name
    ) {}
}
