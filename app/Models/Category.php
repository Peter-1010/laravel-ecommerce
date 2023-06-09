<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    use Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable =  ['parent_id', 'slug', 'is_active'];

    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean'
    ];


    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query){
        return $query->whereNotNull('parent_id');
    }

    public function scopeActive($query){
        return $query -> where('is_active', 1);
    }

    public function getActive(){
        return $this->is_active == 0 ? __('admin/categories.not active') : __('admin/categories.active');
    }

    public function _parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_categories');
    }

}
