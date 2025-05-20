<?php
namespace App\Domain\Product\UseCases;

use App\Domain\Product\Services\ProductService;
use App\Application\DTO\ProductDTO;

class CreateProductUseCase
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function execute(ProductDTO $dto)
    {
        return $this->productService->createProduct($dto);
    }
}
