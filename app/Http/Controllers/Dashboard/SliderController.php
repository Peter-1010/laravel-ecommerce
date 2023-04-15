<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImagesRequest;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller{


    public function addImages()
    {
        $images = SliderImage::get(['photo']);
        return view('dashboard.sliderImages.create', compact('images'));
    }

    //to save images to folder only
    public function saveSliderImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveSliderImagesDB(SliderImagesRequest $request)
    {

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    SliderImage::create([
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->back()->with(['success' => __('admin/messages.success')]);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
