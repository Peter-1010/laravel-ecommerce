<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller{

    public function index(){

        $categories = Category::orderBy('id', 'DESC')->parent()->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));

    }

    public function create(){
        return view('dashboard.categories.create');
    }

    public function store(MainCategoryRequest $request){
        try {
            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $category = Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();

            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => __('admin/messages.created successfully')]);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function edit($category_id){

        $category = Category::orderBy('id', 'DESC')->find($category_id);

        if (!$category){
            return redirect()->route('admin.maincategories')->with(['error' => __('admin/messages.category not found')]);
        }

        return view('dashboard.categories.edit', compact('category'));

    }

    public function update(MainCategoryRequest $request, $category_id){

        try {

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $category = Category::find($category_id);

            if (!$category){
                return redirect()->back()->with(['error' => __('admin/messages.category not found')]);
            }

            $category->update($request->all());
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.maincategories')->with(['success' => __('admin/messages.success')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function destroy($category_id){
        try {
            $category = Category::find($category_id);

            if (!$category){
                return redirect()->route('admin.maincategories')->with(['error' => __('admin/messages.category not found')]);
            }

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
