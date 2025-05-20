<?php

namespace App\Application\DTO;

class AttributeValueDTO
{
    public function __construct(
        public ?int $id,
        public int $attributeId,
        public string $value
    ) {}
}
