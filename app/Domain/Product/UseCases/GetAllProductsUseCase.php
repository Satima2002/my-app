<?php
namespace App\Domain\Product\UseCases;

use App\Domain\Product\Services\ProductService;

class GetAllProductsUseCase
{
    public function __construct(private ProductService $productService) {}

    public function execute(): array
    {
        return $this->productService->getAllProducts();
    }
}
