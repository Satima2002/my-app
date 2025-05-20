<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Categories
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Smartphones'],
        ]);

        // Products
        DB::table('products')->insert([
            ['id' => 1, 'name' => 'iPhone 14 Pro', 'category_id' => 1],
        ]);

        // Attributes
        DB::table('attributes')->insert([
            ['id' => 1, 'name' => 'Color'],
            ['id' => 2, 'name' => 'Storage'],
        ]);

        // Attribute Values
        DB::table('attribute_values')->insert([
            ['id' => 1, 'attribute_id' => 1, 'value' => 'Silver'],
            ['id' => 2, 'attribute_id' => 1, 'value' => 'Space Black'],
            ['id' => 3, 'attribute_id' => 2, 'value' => '128GB'],
            ['id' => 4, 'attribute_id' => 2, 'value' => '256GB'],
        ]);

        // Product Variants
        DB::table('product_variants')->insert([
            ['id' => 1, 'product_id' => 1, 'sku' => 'IP14P-SLV-128', 'price' => 999.99, 'stock' => 15],
            ['id' => 2, 'product_id' => 1, 'sku' => 'IP14P-BLK-256', 'price' => 1199.99, 'stock' => 8],
        ]);

        // Variant Options
        DB::table('variant_options')->insert([
            // Varit 1 - silver + 128GB
            ['product_variant_id' => 1, 'attribute_id' => 1, 'attribute_value_id' => 1],
            ['product_variant_id' => 1, 'attribute_id' => 2, 'attribute_value_id' => 3],

            // Variant 2: Space Black + 256GB
            ['product_variant_id' => 2, 'attribute_id' => 1, 'attribute_value_id' => 2],
            ['product_variant_id' => 2, 'attribute_id' => 2, 'attribute_value_id' => 4],
        ]);
    }
}
