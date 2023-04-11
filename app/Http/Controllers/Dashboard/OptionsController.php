<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Image;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller{

    public function index(){

        $options = Option::with(['product' => function($product){
            $product -> select('id');
        }, 'attribute' => function($attribute){
            $attribute -> select('id');
        }])->select('id', 'product_id', 'attribute_id', 'price')
            ->paginate(PAGINATION_COUNT);

        return view('dashboard.options.index', compact('options'));

    }

    public function create(){
        $data = [];
        $data['products']   = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.create', compact('data'));
    }

    public function store(OptionRequest $request){
        try {
            DB::beginTransaction();

            $option = Option::create([
                'price'        => $request->price,
                'product_id'   => $request->product_id,
                'attribute_id' => $request->attribute_id,
            ]);
            $option->name = $request->name;
            $option->save();

            DB::commit();
            return redirect()->route('admin.options')->with(['success' => __('admin/messages.created successfully')]);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function getPrice($option_id){
        return view('dashboard.options.prices.create') -> with('id', $option_id);
    }

    public function storePrice(OptionRequest $request){

        try {

            $option = Option::find($request->option_id);
            $option->update($request->only([
                'price',
                'special_price',
                'special_price_type',
                'special_price_start',
                'special_price_end'
            ]));

            return redirect()->route('admin.options')->with(['success' => __('admin/messages.created successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }

    }

    public function getStock($option_id){
        return view('dashboard.options.stock.create') -> with('id', $option_id);
    }

    public function storeStock(StockOptionRequest $request){

        try {

            $option = Option::find($request->option_id);
            $option->update($request->except(['_token', 'option_id']));

            return redirect()->route('admin.options')->with(['success' => __('admin/messages.created successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }

    }

    public function addImages($option_id){
        return view('dashboard.options.images.create') -> withId( $option_id);
    }

    public function saveImage(Request $request){

        $file  = $request -> file('dzfile');
        $fileName = uploadImage('options', $file);

        return response()->json([
            'name' => $fileName,
            'original_name' => $file->getClientOriginalName()
        ]);

    }

    public function saveImageDB(ImagesOptionRequest $request){

        try {

            if ($request->has('document') && count($request->document) > 0){
                foreach ($request->document as $image){
                    Image::create([
                        'option_id' => $request->option_id,
                        'photo'      => $image
                    ]);
                }

                return redirect()->route('admin.options')->with(['success' => __('admin/messages.created successfully')]);

            }

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }

    }

    public function destroy($option_id){
        try {
            $option = Option::find($option_id);

            if (!$option){
                return redirect()->route('admin.options')->with(['error' => __('admin/messages.option not found')]);
            }

            $option->delete();

            return redirect()->route('admin.options')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
