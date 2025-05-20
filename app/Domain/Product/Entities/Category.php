<?php
namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?int $parent_id
    )
    {     
    }
    
    public function getCategoryName():string{return $this->name;}
    public function getParentId():?int{return $this->parent_id;}
    public function getCategoryId():?int {return $this->id;}


}