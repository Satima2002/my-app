<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Application\DTO\ProductDTO;
use App\Domain\Product\UseCases\CreateProductUseCase;
use App\Domain\Product\UseCases\GetAllProductsUseCase;
use App\Domain\Product\UseCases\GetProductByIdUseCase;
use App\Domain\Product\UseCases\UpdateProductUseCase;
use App\Domain\Product\UseCases\DeleteProductUseCase;

class ProductApiController extends Controller
{
    public function store(Request $request, CreateProductUseCase $createUseCase)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        $dto = new ProductDTO(null, $data['name'], $data['category_id']);
        $product = $createUseCase->execute($dto);

        return response()->json($product, 201);
    }

    public function index(GetAllProductsUseCase $getAllUseCase)
    {
        $products = $getAllUseCase->execute();
        return response()->json(['products' => $products]);
    }

    public function show(int $id, GetProductByIdUseCase $getByIdUseCase)
    {
        $product = $getByIdUseCase->execute($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json(['product' => $product]);
    }

    public function update(Request $request, int $id, UpdateProductUseCase $updateUseCase)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $dto = new ProductDTO(null, $data['name'], $data['category_id']);
        $updated = $updateUseCase->execute($id, $dto);

        if (!$updated) {
            return response()->json(['error' => 'Product not found or not updated'], 404);
        }

        return response()->json(['message' => 'Product updated']);
    }

    public function destroy(int $id, DeleteProductUseCase $deleteUseCase)
    {
        $deleted = $deleteUseCase->execute($id);

        if (!$deleted) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['message' => 'Product deleted']);
    }
}
