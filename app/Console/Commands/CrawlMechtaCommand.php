<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Application\DTO\ProductDTO;
use App\Application\Mappers\ProductMapper;
use App\Domain\Product\Repositories\ProductRepositoryInterface;

class CrawlMechtaCommand extends Command
{
    protected $signature = 'crawl:mechta';
    protected $description = 'Crawl mechta.kz and parse product details';

    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://www.mechta.kz',
            'headers' => [
                'User-Agent' => 'Mozilla/5.0',
                'Accept'     => 'text/html,application/xhtml+xml',
            ],
        ]);

        try {
            $response = $client->get('/kk/section/igry-konsoli-i-razvlecheniya/');
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            $crawler->filter('a.text-decoration-none')->each(function (Crawler $node) {
                $name = $node->filter('p')->first()->count() ? trim($node->filter('p')->first()->text()) : 'NA';
                $price = $node->filter('div.tw-text-xl.tw-font-bold')->count()
                    ? trim($node->filter('div.tw-text-xl.tw-font-bold')->text())
                    : 'NA';

                $discount = 'NA';
                if ($node->filter('p.tw-text-primary, div.tw-text-primary')->count()) {
                    $node->filter('p.tw-text-primary, div.tw-text-primary')->each(function ($discountNode) use (&$discount) {
                        if (str_contains($discountNode->text(), '%')) {
                            $discount = trim($discountNode->text());
                        }
                    });
                }

                $cashback = 'NA';
                $node->filter('div.tw-text-primary')->each(function ($cashbackNode) use (&$cashback) {
                    if (str_contains($cashbackNode->text(), 'дейін')) {
                        $cashback = trim($cashbackNode->text());
                    }
                });

                $dto = new ProductDTO(
                    $name !== 'NA' ? $name : '',
                    $price !== 'NA' ? $price : '',
                    $discount !== 'NA' ? $discount : null,
                    $cashback !== 'NA' ? $cashback : null
                );

                $product = ProductMapper::dtoToEntity($dto);

                $this->repository->save($product);

                $this->info("Saved: {$product->getName()}");
            });

        } catch (\Exception $e) {
            $this->error('Failed to crawl: ' . $e->getMessage());
        }
    }
}
