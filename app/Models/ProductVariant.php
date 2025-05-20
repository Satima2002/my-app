<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'sku', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variantOptions()
    {
        return $this->hasMany(VariantOption::class);
    }

    // Get attributes of this variant through variant options
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'variant_options')
                    ->withPivot('attribute_value_id');
    }
}
