<?php
namespace App\Domain\Product\UseCases;

use App\Domain\Product\Services\ProductService;
use App\Domain\Product\Entities\Product;

class GetProductByIdUseCase
{
    public function __construct(private ProductService $productService) {}

    public function execute(int $id): ?Product
    {
        return $this->productService->getProductById($id);
    }
}
