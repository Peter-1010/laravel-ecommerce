<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller{

    public function index(){

        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));

    }

    public function create(){
        return view('dashboard.brands.create');
    }

    public function store(MainCategoryRequest $request){
        try {
            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $brand = Brand::create($request->except('_token'));
            $brand->name = $request->name;
            $brand->save();

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin/messages.created successfully')]);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function edit($brand_id){

        $brand = Brand::orderBy('id', 'DESC')->find($brand_id);

        if (!$brand){
            return redirect()->route('admin.brands')->with(['error' => __('admin/messages.brand not found')]);
        }

        return view('dashboard.brands.edit', compact('brand'));

    }

    public function update(MainCategoryRequist $request, $brand_id){

        try {

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $brand = Brand::find($brand_id);

            if (!$brand){
                return redirect()->back()->with(['error' => __('admin/messages.brand not found')]);
            }

            $brand->update($request->all());
            $brand->name = $request->name;
            $brand->save();

            return redirect()->route('admin.brands')->with(['success' => __('admin/messages.success')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function destroy($brand_id){
        try {
            $brand = Brand::find($brand_id);

            if (!$brand){
                return redirect()->route('admin.brands')->with(['error' => __('admin/messages.brand not found')]);
            }

            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
