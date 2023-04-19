<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SliderImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home(){
        $data = [];
        $data['sliders']    = SliderImage::get(['photo']);
        $data['categories'] = Category::parent()->select('id', 'slug')->with(['children' => function($query){
            $query -> select('id', 'parent_id', 'slug');
            $query->with(['children' => function($query2){
                $query2 -> select('id', 'parent_id', 'slug');
            }]);
        }])->get();
        return view('front.home', $data);
    }

}
