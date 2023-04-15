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

    public function edit($option_id){

        $data = [];
        $data['option'] = Option::find($option_id);

        if (!$data['option']){
            return redirect()->route('admin.options')->with(['error' => __('admin/messages.option not found')]);
        }

        $data['products']   = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.edit', $data);

    }

    public function update(OptionRequest $request, $option_id){

        try {

            $options = Option::find($option_id);

            if (!$options){
                return redirect()->back()->with(['error' => __('admin/messages.options not found')]);
            }

            $options->update($request->only(['price', 'product_id', 'attribute_id']));
            $options->name = $request->name;
            $options->save();

            return redirect()->route('admin.options')->with(['success' => __('admin/messages.success')]);

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
