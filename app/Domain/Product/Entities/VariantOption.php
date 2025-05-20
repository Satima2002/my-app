<?php

namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{

    public function __construct(
        public int $id,
        public int $product_variant_id,
        public int $attribute_id,
        public int $attribute_value_id
    )
    {       
    }
}