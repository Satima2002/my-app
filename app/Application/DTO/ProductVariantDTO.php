<?php
namespace App\Application\DTO;

class ProductVariantDTO
{
    public string $sku;
    public float $price;
    public int $stock;
    public array $attributes; 

    public function __construct(string $sku, float $price, int $stock, array $attributes = [])
    {
        $this->sku = $sku;
        $this->price = $price;
        $this->stock = $stock;
        $this->attributes = $attributes;
    }
}

