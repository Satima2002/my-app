<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Application\DTO\ProductDTO;
use App\Domain\Product\Entities\Product;
use App\Models\Product as ProductModel;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(ProductDTO $dto): Product
    {
        $model = new ProductModel();
        $model->name = $dto->name;
        $model->category_id = $dto->categoryId;
        $model->save();

        return new Product($model->id, $model->name, $model->category_id);
    }

    public function update(int $id, ProductDTO $dto): Product
    {
        $model = ProductModel::findOrFail($id);
        $model->name = $dto->name;
        $model->category_id = $dto->categoryId;
        $model->save();

        return new Product($model->id, $model->name, $model->category_id);
    }

    public function delete(int $id): void
    {
        ProductModel::destroy($id);
    }

    public function findById(int $id): ?Product
    {
        $model = ProductModel::find($id);
        if (!$model) return null;
        return new Product($model->id, $model->name, $model->category_id);
    }

    public function getAll(): array
    {
        return ProductModel::all()->toArray();
    }
}
