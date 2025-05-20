<?php

namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    
    public function __construct(
        public int $id,
        public int $attribute_id,
        public string $value
    )
    {   
    }
}