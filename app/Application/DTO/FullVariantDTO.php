<?php
namespace App\Application\DTO;

class FullVariantDTO
{
    public function __construct(
        public ProductVariantDTO $variant,
        // @var VariantOptionDTO[]
        public array $options
    ) {}
}
