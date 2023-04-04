<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller{

    public function index(){

        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));

    }

    public function create(){
        return view('dashboard.tags.create');
    }

    public function store(TagRequest $request){
        try {
            DB::beginTransaction();


            $tag = Tag::create($request->except('_token', 'id'));
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('admin/messages.created successfully')]);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function edit($tag_id){

        $tag = Tag::orderBy('id', 'DESC')->find($tag_id);

        if (!$tag){
            return redirect()->route('admin.tags')->with(['error' => __('admin/messages.tag not found')]);
        }

        return view('dashboard.tags.edit', compact('tag'));

    }

    public function update(TagRequest $request, $tag_id){

        try {

            DB::beginTransaction();

            $tag = Tag::find($tag_id);

            if (!$tag){
                return redirect()->back()->with(['error' => __('admin/messages.tag not found')]);
            }

            $tag->update($request->except('_token'));

            $tag->name = $request->name;
            $tag->save();

            DB::commit();

            return redirect()->route('admin.tags')->with(['success' => __('admin/messages.success')]);

        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

    public function destroy($tag_id){
        try {
            $tag = Tag::find($tag_id);

            if (!$tag){
                return redirect()->route('admin.tags')->with(['error' => __('admin/messages.tag not found')]);
            }

            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
