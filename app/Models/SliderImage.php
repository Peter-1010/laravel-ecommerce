<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{

    protected $table = 'slider_images';

    protected $fillable = ['photo'];

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/sliders/' . $val) : "";
    }

}
