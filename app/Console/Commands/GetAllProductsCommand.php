<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Domain\Product\Services\ProductService;
use App\Domain\Product\UseCases\GetAllProductsUseCase;
use App\Infrastructure\Repositories\ProductRepository;

class GetAllProductsCommand extends Command
{
    protected $signature = 'product:all';
    protected $description = 'Get catalog of all products';

    public function handle()
    {
        $repository = new ProductRepository();
        $service = new ProductService($repository);
        $useCase = new GetAllProductsUseCase($service);

        $products = $useCase->execute();

        if (empty($products)) {
            $this->info('No products found.');
            return 0;
        }

        foreach ($products as $product) {
            $this->line('---------------------');
            foreach ($product as $key => $value) {
                $this->line("{$key}: {$value}");
            }
        }

        return 0;
    }
}
