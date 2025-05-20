<?php

namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    public function __construct(
        public int $id,
        public string $name
    )
    {}

    
}