<?php
namespace App\Domain\Product\UseCases;

use App\Application\DTO\ProductDTO;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Services\ProductService;

class UpdateProductUseCase
{
    public function __construct(private ProductService $productService) {}

    public function execute(int $id, ProductDTO $dto): Product
    {
        return $this->productService->updateProduct($id, $dto);
    }
}
