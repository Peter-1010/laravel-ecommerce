<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceProductRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StockProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller{

    public function index(){

        $products = Product::select('id', 'slug', 'price', 'created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index', compact('products'));

    }

    public function create(){
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();

        return view('dashboard.products.general.create', compact('data'));
    }

    public function store(ProductRequest $request){
        try {
            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $product = Product::create([
                'slug' => $request->slug,
                'brand_id' => $request->brand_id,
                'is_active' => $request->is_active,
            ]);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            $product->categories()->attach($request->categories);


            DB::commit();
            return redirect()->route('admin.products')->with(['success' => __('admin/messages.created successfully')]);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function getPrice($product_id){
        return view('dashboard.products.prices.create') -> with('id', $product_id);
    }

    public function storePrice(PriceProductRequest $request){

        try {

            $product = Product::find($request->product_id);
            $product->update($request->only([
                'price',
                'special_price',
                'special_price_type',
                'special_price_start',
                'special_price_end'
            ]));

            return redirect()->route('admin.products')->with(['success' => __('admin/messages.created successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }

    }

    public function getStock($product_id){
        return view('dashboard.products.stock.create') -> with('id', $product_id);
    }

    public function storeStock(StockProductRequest $request){

        try {

            $product = Product::find($request->product_id);
            $product->update($request->except(['_token', 'product_id']));

            return redirect()->route('admin.products')->with(['success' => __('admin/messages.created successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }

    }

    public function edit($product_id){

        $product = Product::orderBy('id', 'DESC')->find($product_id);

        if (!$product){
            return redirect()->route('admin.products')->with(['error' => __('admin/messages.product not found')]);
        }

        return view('dashboard.products.prices.edit', compact('product'));

    }

    public function update(ProductRequest $request, $product_id){

        try {

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $product = Product::find($product_id);

            if (!$product){
                return redirect()->back()->with(['error' => __('admin/messages.product not found')]);
            }

            $product->update($request->all());
            $product->name = $request->name;
            $product->save();

            return redirect()->route('admin.products')->with(['success' => __('admin/messages.success')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function destroy($product_id){
        try {
            $product = Product::find($product_id);

            if (!$product){
                return redirect()->route('admin.products')->with(['error' => __('admin/messages.product not found')]);
            }

            $product->delete();

            return redirect()->route('admin.products')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
