<?php
namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        public function __construct(
            public int $id,
            public string $name,
            public int $category_id     

        ) {
        }


    public function getName(): string { return $this->name; }
    public function getCategoryId(): ?int { return $this->category_id; }
    public function getProductId(): ?int { return $this->id; }
    

}
