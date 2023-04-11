<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller{

    public function index(){

        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));

    }

    public function create(){
        return view('dashboard.attributes.create');
    }

    public function store(AttributeRequest $request){
        try {
            DB::beginTransaction();

            $attribute = Attribute::create($request->only('name'));
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => __('admin/messages.created successfully')]);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function edit($attribute_id){

        $attribute = Attribute::orderBy('id', 'DESC')->find($attribute_id);

        if (!$attribute){
            return redirect()->route('admin.attributes')->with(['error' => __('admin/messages.attribute not found')]);
        }

        return view('dashboard.attributes.edit', compact('attribute'));

    }

    public function update(AttributeRequest $request, $attribute_id){

        try {

            $attribute = Attribute::find($attribute_id);

            if (!$attribute){
                return redirect()->back()->with(['error' => __('admin/messages.attribute not found')]);
            }

            $attribute->update($request->only('name'));

            $attribute->save();

            return redirect()->route('admin.attributes')->with(['success' => __('admin/messages.success')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function destroy($attribute_id){
        try {
            $attribute = Attribute::find($attribute_id);

            if (!$attribute){
                return redirect()->route('admin.attributes')->with(['error' => __('admin/messages.attribute not found')]);
            }

            $attribute->delete();

            return redirect()->route('admin.attributes')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
