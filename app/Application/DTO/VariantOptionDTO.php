<?php
namespace App\Application\DTO;

class VariantOptionDTO
{
    public function __construct(
        public ?int $id,
        public int $productVariantId,
        public int $attributeId,
        public int $attributeValueId
    ) {}
}
