<?php

namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    public function __construct(
        public int $id,
        public int $product_id,
        public string $sku,
        public ?float $price,
        public int $stock,
    )
    { }
    public function getVariantPrice():?float{return $this->price;}
    public function getProductId():int{return $this->product_id;}
}