<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Domain\Product\Services\ProductService;
use App\Domain\Product\UseCases\GetProductUseCase;
use App\Infrastructure\Repositories\ProductRepository;

class GetProductCommand extends Command
{
    protected $signature = 'product:get {id}';
    protected $description = 'Get product details by id';

    public function handle()
    {
        $id = $this->argument('id');

        $repository = new ProductRepository();
        $service = new ProductService($repository);
        $useCase = new GetProductUseCase($service);

        $result = $useCase->execute($id);

        if (!$result) {
            $this->error("Product with code {$id} not found.");
            return 1; // error exit code
        }

        $this->info("Product details:");
        foreach ($result as $key => $value) {
            $this->line("{$key}: {$value}");
        }

        return 0; // succes
    }
}
