<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class WishlistController extends Controller
{

    public function index(){
        $products = auth()->user()
            ->wishlist()
            ->latest()
            ->get();

        return view('front.wishlist', compact('products'));

    }

    public function store(){
        if (!auth()->user()->wishListHas(request('product_id'))){
            auth()->user()->wishList()->attach(request('product_id'));
            return response()->json(['status' => true, 'wished' => true]);
        }
        return response()->json(['status' => true, 'wished' => false]);

    }

    public function destroy(){
        auth()->user()->wishlist()->detach(request('product_id'));
    }


}
