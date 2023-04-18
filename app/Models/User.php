<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function code(){
        return $this->hasMany(UserVerification::class, 'user_id');
    }

    public function wishList(){
        return $this->belongsToMany(Product::class, 'wish_lists')->withTimestamps();
    }

    public function wishListHas($product_id){
        return self::wishList()->where('product_id', $product_id)->exists();
    }

}
