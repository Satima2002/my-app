<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$baseUrl = 'https://www.mechta.kz';

// Step 1: Fetch main page HTML
$client = new Client();
$response = $client->get($baseUrl);
$html = (string) $response->getBody();

// Step 2: Load HTML into DomCrawler
$crawler = new Crawler($html);

// Step 3: Filter all product <article> blocks
$products = $crawler->filter('article.tw-rounded-xl');

foreach ($products as $productElement) {
    $productCrawler = new Crawler($productElement);

    // Product name
    $name = $productCrawler->filter('p.tw-text-sm.tw-font-normal')->text();

    // Price (final price, bold, with ₸ symbol)
    $priceRaw = $productCrawler->filter('section.tw-flex.tw-items-center.tw-justify-between p.tw-font-bold')->text();
    $price = trim(str_replace("\xc2\xa0", ' ', $priceRaw)); // clean nbsp

    // Discount (like "-10%")
    $discountNode = $productCrawler->filter('section.tw-flex.tw-items-center.tw-gap-1 p.tw-text-xs.tw-text-primary');
    $discount = $discountNode->count() ? $discountNode->text() : 'No discount';

    // Cashback (if available, in the first section near price or label "дейін")
    // This looks like the "дейін 11 395" inside a div with class "tw-text-primary"
    $cashbackNode = $productCrawler->filter('div.tw-text-primary');
    $cashback = $cashbackNode->count() ? trim(preg_replace('/\s+/', ' ', $cashbackNode->text())) : 'No cashback';

    echo "Name: $name\n";
    echo "Price: $price\n";
    echo "Discount: $discount\n";
    echo "Cashback: $cashback\n";
    echo "-------------------------\n";
}
