<?php 

namespace App\Domain\Product\Repositories;

use App\Application\DTO\ProductDTO;
use App\Application\DTO\ProductVariantDTO;
use App\Domain\Product\Entities\Product;
use App\Models\ProductVariant;

interface ProductRepositoryInterface
{
    public function create(ProductDTO $dto): Product;
    public function update(int $id, ProductDTO $dto): Product;
    public function delete(int $id): void;
    public function findById(int $id): ?Product;
    public function getAll(): array;
}
