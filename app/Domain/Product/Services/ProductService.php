<?php
namespace App\Domain\Product\Services;

use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Application\DTO\ProductDTO;
use App\Domain\Product\Entities\Product;

class ProductService
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function createProduct(ProductDTO $dto): Product
    {
        // You can add business rules validation here, e.g. check category exists

        return $this->productRepo->create($dto);
    }

    public function updateProduct(int $id, ProductDTO $dto): Product
    {
        return $this->productRepo->update($id, $dto);
    }

    public function deleteProduct(int $id): void
    {
        $this->productRepo->delete($id);
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepo->findById($id);
    }

    /**
     * @return Product[]
     */
    public function getAllProducts(): array
    {
        return $this->productRepo->getAll();
    }
}
