<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,
        softDeletes;

    protected $with = ['translations'];

    protected $fillable =  [
        'brand_id',
        'slug',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'viewed',
        'is_active',
    ];

    protected $hidden = ['translations'];

    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',

    ];

    protected $dates = [
        'special_price_start',
        'special_price_end',
        'deleted_at'
    ];

    protected $translatedAttributes = ['name', 'description', 'short_description'];

    public function brand(){
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function options(){
        return $this->hasMany(Option::class, 'product_id');
    }

    public function images(){
        return $this->hasMany(Image::class, 'product_id');
    }

    public function getActive(){
        return $this->is_active == 0 ? __('admin/products.not active') : __('admin/products.active');
    }

    public function scopeActive($query){
        return $query->where('is_active', 1);
    }

}
